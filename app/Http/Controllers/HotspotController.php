<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HotspotController extends Controller
{
    public function index()
    {
        $file = '/etc/hostapd/hostapd.conf';

        $ssid = substr(file($file)[2], strpos(file($file)[2], "=") + 1, -2);

        return view('hotspot_settings', ['ssid' => $ssid]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'ssid' => 'required|string|min:1|max:32|alpha_dash',
            'password' => 'required|string|min:12|max:63|alpha_dash'
        ]);

        $ssid = $request->ssid;
        $password = $request->password;

        $file = '/etc/hostapd/hostapd.conf';

        $fileLines = file($file);

        $fileLines[2] = "ssid=" . $ssid . "\r\n";
        $fileLines[10] = "wpa_passphrase=" . $password . "\r\n";

        file_put_contents($file, $fileLines);

        exec('/bin/systemctl restart hostapd');

        return redirect()->route('hotspot');
    }
}
