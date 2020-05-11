@extends('layouts.app')

@section('title', \Carbon\Carbon::createFromTimestamp($timelapse)->format('l, jS F Y, H:i:s T'))

@section('content')
    <div class="mb-4 text-right">
        @if ($status === 'Ready to Process')
            <form class="d-inline-block" action="{{ route('time-lapses.process', $timelapse) }}" method="POST">
                @csrf

                <button type="submit" class="btn btn-primary">Make Video</button>
            </form>
        @endif

        @if ($status === 'Complete')
            <a href="{{ asset('storage/' . $timelapse . '/' . $timelapse . '.mp4') }}" class="btn btn-primary">Download Video</a>
        @endif

        @if ($status === 'Taking Stills')
            <form class="d-inline-block" action="{{ route('time-lapses.stop', $timelapse) }}" method="POST">
                @method('DELETE')
                @csrf

                <button type="submit" class="btn btn-warning">Stop Time-lapse</button>
            </form>
        @endif

        @if ($status === 'Complete' || $status === 'Ready to Process')
            <form class="d-inline-block" action="{{ route('time-lapses.destroy', $timelapse) }}" method="POST">
                @method('DELETE')
                @csrf

                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        @endif
    </div>

    <div class="row">
        @foreach ($images as $image)
            <div class="col-6 col-md-4 col-lg-3">
                <a href="{{ asset('/storage/' . $image) }}">
                    <img class="shadow rounded w-100 mb-2" src="{{ asset('/storage/' . $image) }}" alt="">
                </a>
                <p class="mb-4 text-center">{{ \Carbon\Carbon::createFromTimestamp(File::name($image))->format('d M, H:i:s') }}</p>
            </div>
        @endforeach
    </div>

@endsection
