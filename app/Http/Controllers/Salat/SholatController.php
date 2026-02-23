<?php

namespace App\Http\Controllers\Salat;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;

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

    // public function publications(Request $request)
    // {
    //     // Fetch all settings
    //     $settings = Setting::all();
    //     $carousels = Carousel::all();

    //     // Fetch Kabupaten data from the first API
    //     $response = Http::withoutVerifying()->get('https://webapi.bps.go.id/v1/api/domain/type/kab/key/fdc28dc463144c072f113d02a5bf7aa5/');
    //     $kabupatenData = $response->json();
    //     $news = Http::withoutVerifying()->get('https://api.indeks.inovasi.litbang.kemendagri.go.id/v1/news');
    //     $newsData = $news->json()['data'];

    //     //Return the view with both sets of data
    //     if ($request->header('HX-Request')) {
    //         return view('visitor.pub', [
    //             'kabupatenData' => $kabupatenData,
    //             'settings' => $settings,
    //             'carousels' => $carousels,
    //             'newsData'=> $newsData
    //         ])->fragment('publications-section');
    //     }
    //     return view('visitor.pub', [
    //         'kabupatenData' => $kabupatenData,
    //         'settings' => $settings,
    //         'carousels' => $carousels,
    //         'newsData'=> $newsData
    //     ]);
    // }

    public function tablePub(Request $request)
    {
        $domain_id = $request->input('domain_id');
        $year = $request->input('year');
        $page = $request->input('page');

        // Fetch publication data from the second API
        $publicationResponse = Http::withoutVerifying()->get("https://webapi.bps.go.id/v1/api/list/model/publication/domain/{$domain_id}/page/{$page}/year/{$year}/key/fdc28dc463144c072f113d02a5bf7aa5/");
        $publicationData = $publicationResponse->json();

        // Extract publications and pagination info
        $publications = $publicationData['data'][1] ?? [];
        $total = $publicationData['data'][0]['total'] ?? 0;
        $perPage = $publicationData['data'][0]['per_page'] ?? 10;

        // Create a paginator
        $paginator = new LengthAwarePaginator($publications, $total, $perPage, $page, [
            'path' => url()->current(),
            'query' => $request->query()
        ]);

        // Return the partial view with the publications table
        return view('visitor.partial.publications-table', [
            'paginator' => $paginator
        ]);
    }

    // public function news(Request $request)
    // {
    //     $settings = Setting::all();
    //     $carousels = Carousel::all();
    //     $response = Http::get('https://api.indeks.inovasi.litbang.kemendagri.go.id/v1/news');
    //     $newsData = $response->json()['data'];

    //     if ($request->header('HX-Request')) {
    //         return view('visitor.news', [
    //             'settings' => $settings,
    //             'carousels' => $carousels,
    //             'newsData' => $newsData
    //         ])->fragment('news-section');
    //     }
    //     return view('visitor.news', [
    //         'settings'=> $settings,
    //         'carousels'=> $carousels,
    //         'newsData'=> $newsData
    //     ]);
    // }

    public function publications(Request $request)
    {
        $settings = Setting::all();
        $carousels = Carousel::all();

        // Fetch Kabupaten data
        $response = Http::withoutVerifying()->get('https://webapi.bps.go.id/v1/api/domain/type/kab/key/fdc28dc463144c072f113d02a5bf7aa5/');
        $kabupatenData = $response->json();

        // Fetch News Kemendagri dengan fallback
        try {
            $news = Http::withoutVerifying()->get('https://api.indeks.inovasi.litbang.kemendagri.go.id/v1/news');
            if ($news->successful()) {
                $newsData = $news->json()['data'];
            } else {
                $newsData = []; // fallback kosong
            }
        } catch (\Exception $e) {
            $newsData = []; // fallback kosong jika API down
        }

        if ($request->header('HX-Request')) {
            return view('visitor.pub', compact('kabupatenData', 'settings', 'carousels', 'newsData'))
                ->fragment('publications-section');
        }
        return view('visitor.pub', compact('kabupatenData', 'settings', 'carousels', 'newsData'));
    }

    public function news(Request $request)
    {
        $settings = Setting::all();
        $carousels = Carousel::all();

        // Fetch News Kemendagri dengan fallback
        try {
            $response = Http::withoutVerifying()->get('https://api.indeks.inovasi.litbang.kemendagri.go.id/v1/news');
            if ($response->successful()) {
                $newsData = $response->json()['data'];
            } else {
                $newsData = []; // fallback kosong
            }
        } catch (\Exception $e) {
            $newsData = []; // fallback kosong
        }

        if ($request->header('HX-Request')) {
            return view('visitor.news', compact('settings', 'carousels', 'newsData'))
                ->fragment('news-section');
        }
        return view('visitor.news', compact('settings', 'carousels', 'newsData'));
    }


}
