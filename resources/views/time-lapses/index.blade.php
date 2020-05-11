@extends('layouts.app')

@section('title', 'Time-lapses')

@section('content')
    @if (session('error'))
        <div class="alert alert-warning">
            {{ session('error') }}
        </div>
    @endif

    <div class="dropdown mb-4 text-right">
        <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Start new Time-lapse
        </a>

        <div class="dropdown-menu dropdown-menu-right text-right" aria-labelledby="dropdownMenuLink">
            <form action="{{ route('time-lapses.store') }}" method="POST">
                @csrf
                <input type="hidden" value="15" name="duration">
                <button class="dropdown-item" type="submit">15 minutes</button>
            </form>
            <form action="{{ route('time-lapses.store') }}" method="POST">
                @csrf
                <input type="hidden" value="30" name="duration">
                <button class="dropdown-item" type="submit">30 minutes</button>
            </form>
            <form action="{{ route('time-lapses.store') }}" method="POST">
                @csrf
                <input type="hidden" value="60" name="duration">
                <button class="dropdown-item" type="submit">1 hour</button>
            </form>
            <form action="{{ route('time-lapses.store') }}" method="POST">
                @csrf
                <input type="hidden" value="120" name="duration">
                <button class="dropdown-item" type="submit">2 hours</button>
            </form>
            <form action="{{ route('time-lapses.store') }}" method="POST">
                @csrf
                <input type="hidden" value="240" name="duration">
                <button class="dropdown-item" type="submit">4 hours</button>
            </form>
        </div>
    </div>

    @foreach ($timelapses as $directory => $details)
        <div class="card mb-3">
            <div class="row no-gutters">
                <div class="col-6 col-md-3 col-lg-3 col-xl-2">
                    <a href="{{ route('time-lapses.show', $directory) }}">
                        <img src="{{ asset('/storage/' . $details['latest']) }}" class="card-img" alt="">
                    </a>
                </div>
                <div class="col-6 col-md-9 col-lg-9 col-xl-10">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a class="stretched-link" href="{{ route('time-lapses.show', $directory) }}">{{ \Carbon\Carbon::createFromTimestamp($directory)->format('jS F Y, H:i') }}</a>
                        </h5>
                        <div>
                            @switch($details['status'])
                                @case('Taking Stills')
                                    <span class="badge badge-pill badge-warning">{{ $details['status'] }}</span>
                                    @break
                                @case('Processing Video')
                                    <span class="badge badge-pill badge-warning">{{ $details['status'] }}</span>
                                    @break
                                @case('Ready to Process')
                                    <span class="badge badge-pill badge-primary">{{ $details['status'] }}</span>
                                    @break
                                @case('Complete')
                                    <span class="badge badge-pill badge-success">{{ $details['status'] }}</span>
                                    @break
                            @endswitch
                            <i class="far fa-images text-muted ml-2"></i> {{ $details['count'] }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
