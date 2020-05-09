<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TimelapseController extends Controller
{
    public function index()
    {
        return view('time-lapses.index');
    }

    public function show(String $timelapse)
    {
        return view('time-lapses.show', ['timelapse' => $timelapse]);
    }
}
