<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HotspotController extends Controller
{
    public function index()
    {
        $file = file_get_contents('/etc/hostapd/hostapd.conf');

        preg_match('/(?<=^ssid=)(.*)$/m', $file, $matches);

        $ssid = $matches[0];

        preg_match('/(?<=^wpa_passphrase=)(.*)$/m', $file, $matches);

        $password = $matches[0];

        return view('hotspot_settings', [
            'ssid' => $ssid,
            'password' => $password
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'ssid' => 'required|string|min:1|max:32|alpha_dash',
            'password' => 'required|string|min:12|max:63|alpha_dash'
        ]);

        $ssid = $request->ssid;
        $password = $request->password;

        $file = file_get_contents('/etc/hostapd/hostapd.conf');

        $file = preg_replace('/(?<=^ssid=)(.*)$/m', $ssid, $file);
        $file = preg_replace('/(?<=^wpa_passphrase=)(.*)$/m', $password, $file);

        file_put_contents('/etc/hostapd/hostapd.conf', $file);

        return redirect()->route('hotspot');
    }
}
