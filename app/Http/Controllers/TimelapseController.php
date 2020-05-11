<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;

class TimelapseController extends Controller
{
    public function index()
    {
        $directories = array_reverse(Storage::disk('public')->directories());
        $timelapses = [];

        foreach ($directories as $directory) {
            $images = $this->getImages($directory);

            $timelapses[$directory] = [
                'count' => count($images),
                'latest' => end($images),
                'status' => $this->getStatus($directory)
            ];
        }

        return view('time-lapses.index', ['timelapses' => $timelapses]);
    }

    public function show(String $timelapse)
    {
        $images = $this->getImages($timelapse);

        return view('time-lapses.show', [
            'timelapse' => $timelapse,
            'images' => $images,
            'status' => $this->getStatus($timelapse)
        ]);
    }

    public function store(Request $request)
    {
        // Make sure no other time-lapse is running
        $directories = Storage::disk('public')->directories();
        foreach ($directories as $directory) {
            if ($this->getStatus($directory) === 'Taking Stills') {
                return redirect()
                    ->route('time-lapses.index')
                    ->with('error', 'A time-lapse is currently running');
            }

            if ($this->getStatus($directory) === 'Processing Video') {
                return redirect()
                    ->route('time-lapses.index')
                    ->with('error', 'A time-lapse is currently being processed');
            }
        }

        // Make Directory
        $directory = Carbon::now()->getTimestamp();

        if (Storage::disk('public')->exists($directory)) {
            return redirect()
                ->route('time-lapses.index')
                ->with('error', 'The time-lapse already exists: ' . $directory);
        }

        Storage::disk('public')->makeDirectory($directory);

        // // Start time-lapse
        $this->start($directory, $request->duration);

        return redirect()->route('time-lapses.index');
    }

    public function destroy(String $timelapse)
    {
        $status = $this->getStatus($timelapse);

        if ($status === 'Taking Stills' || $status === 'Processing Video') {
            return redirect()
                ->route('time-lapses.index')
                ->with('error', 'The time-lapse must not be running');
        }

        Storage::disk('public')->deleteDirectory($timelapse);

        return redirect()->route('time-lapses.index');
    }

    public function stop(string $timelapse)
    {
        if ($this->getStatus($timelapse) === 'Taking Stills') {
            return redirect()
                ->route('time-lapses.index')
                ->with('error', 'A time-lapse is currently running');
        }

        // get the process id
        $pid = Storage::get($timelapse . '/raspistill');

        // do command to stop the id
        if (! posix_kill($pid, SIGKILL)) {
            return redirect()
                ->route('time-lapses.index')
                ->with('error', 'Failed to stop time-lapse');
        }

        // delete raspistill file
        Storage::disk('public')->delete($timelapse . '/raspistill');

        return redirect()
            ->route('time-lapses.index')
            ->with('error', 'Time-lapse has stopped');
    }

    public function process(string $timelapse)
    {
        // make sure the time-lapse is ready to process
        if ($this->getStatus($timelapse) !== 'Ready to Process') {
            return redirect()
                ->route('time-lapses.index')
                ->with('error', 'This time-lapse isn\'t ready to process');
        }

        // Make sure no other time-lapse is running
        $directories = Storage::disk('public')->directories();
        foreach ($directories as $directory) {
            if ($this->getStatus($directory) === 'Taking Stills') {
                return redirect()
                    ->route('time-lapses.index')
                    ->with('error', 'An existing time-lapse needs to finish running');
            }

            if ($this->getStatus($directory) === 'Processing Video') {
                return redirect()
                    ->route('time-lapses.index')
                    ->with('error', 'An existing time-lapse needs to finish processing');
            }
        }

        $outputPath = storage_path('app/public/' . $timelapse . '/');

        $command = 'ffmpeg ' .
            '-pattern_type glob ' .
            '-i "' . $outputPath . '*.jpg" ' .
            '-r 10 ' .
            '-vcodec libx264 ' .
            '-vf scale=1280:720 ' .
            $outputPath . $timelapse . '.mp4 ' .
            '> /dev/null 2>&1 & echo $!; ';

        $pid = exec($command);

        Storage::disk('public')->put($timelapse . '/avconv', $pid);

        return redirect()->route('time-lapses.index');
    }

    private function start(string $directory, int $duration): void
    {
        $outputPath = storage_path('app/public/' . $directory . '/');
        $timeout = $duration * 60 * 1000; // how long the timelapse will run for (in ms)
        $interval = $timeout / 900; // how long between each image (in ms). 900 frames (30seconds * 30fps)

        $process = new Process([
            'raspistill',
            '--timestamp', // saves filename as unix timestamp
            '--output', $outputPath . '%d.jpg',
            '--timeout', $timeout,
            '--timelapse', $interval
        ]);

        $process->setTimeout(($timeout / 1000) + 60); // timeout the process 1 minute after raspistill is due to finish

        $process->start();

        Storage::disk('public')->put($directory . '/raspistill', $process->getPid());
    }

    private function getImages(string $directory): array
    {
        $files = Storage::disk('public')->files($directory);
        $images = [];

        foreach ($files as $file) {
            if (File::extension($file) === 'jpg') {
                array_push($images, $file);
            }
        }

        return $images;
    }

    private function getStatus(string $directory): string
    {
        if (Storage::disk('public')->exists($directory . '/raspistill')) {
            return 'Taking Stills';
        }

        if (Storage::disk('public')->exists($directory . '/avconv')) {
            return 'Processing Video';
        }

        if (! Storage::disk('public')->exists($directory . '/' . $directory . '.mp4')) {
            return 'Ready to Process';
        }

        return 'Complete';
    }
}
