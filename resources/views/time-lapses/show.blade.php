@extends('layouts.app')

@section('title', \Carbon\Carbon::createFromTimestamp($timelapse)->format('l, jS F Y, H:i:s T'))

@section('content')
    <div class="mb-4 text-right">
        <button type="button" class="btn btn-primary">Make Video</button>
        <button type="button" class="btn btn-primary">Download Video</button>
        <button type="button" class="btn btn-warning">Stop Time-lapse</button>
        <button type="button" class="btn btn-danger">Delete</button>
    </div>

    <div class="row">
        @for ($i = 0; $i < 10; $i++)
        <div class="col-6 col-md-4 col-lg-3">
            <a href="https://cdn.shopify.com/s/files/1/1057/6184/articles/budgies_1024x1024.jpg">
                <img class="shadow rounded w-100 mb-2" src="https://cdn.shopify.com/s/files/1/1057/6184/articles/budgies_1024x1024.jpg" alt="">
            </a>
            <p class="mb-4 text-center">19 Apr, 14:24:20</p>
        </div>
        @endfor
    </div>
@endsection
