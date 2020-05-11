<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CleanUpRunningProcesses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clean-up-running-processes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove raspistill and avconv files in timelapse directories';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $directories = Storage::disk('public')->directories();

        foreach ($directories as $directory) {
            if (Storage::disk('public')->exists($directory . '/raspistill')) {
                $pid = Storage::disk('public')->get($directory . '/raspistill');

                if ($pid === '' || ! file_exists("/proc/$pid")){
                    Storage::disk('public')->delete($directory . '/raspistill');
                }
            }

            if (Storage::disk('public')->exists($directory . '/avconv')) {
                $pid = Storage::disk('public')->get($directory . '/avconv');

                if ($pid === '' || ! file_exists("/proc/$pid")){
                    Storage::disk('public')->delete($directory . '/avconv');
                }
            }
        }
    }
}
