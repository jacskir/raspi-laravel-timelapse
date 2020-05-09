@extends('layouts.app')

@section('title', 'Time-lapses')

@section('content')
    <div class="dropdown mb-4 text-right">
        <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Start new Time-lapse
        </a>

        <div class="dropdown-menu dropdown-menu-right text-right" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="#">10 minutes</a>
            <a class="dropdown-item" href="#">20 minutes</a>
            <a class="dropdown-item" href="#">40 minutes</a>
            <a class="dropdown-item" href="#">1 hour 20 minutes</a>
            <a class="dropdown-item" href="#">2 hour 40 minutes</a>
        </div>
    </div>

    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col-6 col-md-3 col-lg-3 col-xl-2">
                <img src="https://cdn.shopify.com/s/files/1/1057/6184/articles/budgies_1024x1024.jpg?v=1567607864" class="card-img" alt="...">
            </div>
            <div class="col-6 col-md-9 col-lg-9 col-xl-10">
                <div class="card-body">
                    <h5 class="card-title">
                        <a class="stretched-link" href="{{ route('time-lapses.show', '0') }}">17th February 2020, 15:31</a>
                    </h5>
                    <p class="card-text"><span class="badge badge-pill badge-success">Complete</span><i class="far fa-images text-muted ml-3"></i> 372</p>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col-6 col-md-3 col-lg-3 col-xl-2">
                <img src="https://cdn.shopify.com/s/files/1/1057/6184/articles/budgies_1024x1024.jpg?v=1567607864" class="card-img" alt="...">
            </div>
            <div class="col-6 col-md-9 col-lg-9 col-xl-10">
                <div class="card-body">
                    <h5 class="card-title">
                        <a class="stretched-link" href="#">16th February 2020, 11:05</a>
                    </h5>
                    <p class="card-text"><span class="badge badge-pill badge-primary">Ready to Process</span><i class="far fa-images text-muted ml-3"></i> 841</p>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col-6 col-md-3 col-lg-3 col-xl-2">
                <img src="https://cdn.shopify.com/s/files/1/1057/6184/articles/budgies_1024x1024.jpg?v=1567607864" class="card-img" alt="...">
            </div>
            <div class="col-6 col-md-9 col-lg-9 col-xl-10">
                <div class="card-body">
                    <h5 class="card-title">
                        <a class="stretched-link" href="#">13th February 2020, 14:25</a>
                    </h5>
                    <p class="card-text"><span class="badge badge-pill badge-warning">Processing Video</span><i class="far fa-images text-muted ml-3"></i> 462</p>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col-6 col-md-3 col-lg-3 col-xl-2">
                <img src="https://cdn.shopify.com/s/files/1/1057/6184/articles/budgies_1024x1024.jpg?v=1567607864" class="card-img" alt="...">
            </div>
            <div class="col-6 col-md-9 col-lg-9 col-xl-10">
                <div class="card-body">
                    <h5 class="card-title">
                        <a class="stretched-link" href="#">11th February 2020, 16:46</a>
                    </h5>
                    <p class="card-text"><span class="badge badge-pill badge-warning">Taking Stills</span><i class="far fa-images text-muted ml-3"></i> 135</p>
                </div>
            </div>
        </div>
    </div>
@endsection
