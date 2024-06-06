<?php

namespace App\Http\Controllers\Salat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Setting;

class SholatController extends Controller
{
    public function getJadwalSholat(Request $request)
    {
        $date = $request->input('date');
        $settings = Setting::all();  // Pastikan ini mendefinisikan settings

        if ($date) {
            $city_id = 2109; // Ganti dengan ID kota yang sesuai
            $url = "https://api.myquran.com/v2/sholat/jadwal/{$city_id}/{$date}";

            // Menonaktifkan verifikasi SSL
            $response = Http::withoutVerifying()->get($url);

            if ($response->successful()) {
                $jadwal = $response->json();
                if (isset($jadwal['data']) && isset($jadwal['data']['jadwal'])) {
                    if ($request->header('HX-Request')) {
                        return view('jadwal-sholat', ['jadwal' => $jadwal['data']['jadwal'], 'settings' => $settings])->fragment('jadwal');
                    }
                    return view('jadwal-sholat', ['jadwal' => $jadwal['data']['jadwal'], 'settings' => $settings]);
                } else {
                    if ($request->header('HX-Request')) {
                        return view('jadwal-sholat', ['error' => 'Data jadwal tidak tersedia', 'settings' => $settings])->fragment('jadwal');
                    }
                    return view('jadwal-sholat', ['error' => 'Data jadwal tidak tersedia', 'settings' => $settings]);
                }
            } else {
                return view('jadwal-sholat', ['error' => 'Unable to fetch data', 'settings' => $settings]);
            }
        }

        // Pastikan settings dikirimkan saat tidak ada tanggal yang dipilih
        return view('jadwal-sholat', ['settings' => $settings]);
    }
}
