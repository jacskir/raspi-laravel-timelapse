<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HotspotController extends Controller
{
    public function __invoke()
    {
        return view('hotspot_settings');
    }

    public function update(Request $request)
    {
        return redirect()->route('home');
    }
}
