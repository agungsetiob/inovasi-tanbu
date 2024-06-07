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

    public function publications(Request $request)
    {
        // Fetch all settings
        $settings = Setting::all();
        $carousels = Carousel::all();

        // Fetch Kabupaten data from the first API
        $response = Http::withoutVerifying()->get('https://webapi.bps.go.id/v1/api/domain/type/kab/key/fdc28dc463144c072f113d02a5bf7aa5/');
        $kabupatenData = $response->json();

        // Define domain_id and year for the second API request
        $domain_id = $request->input('domain_id', '6310'); // Replace '6310' with an actual default value if necessary
        $year = $request->input('year', now()->year); // Default to the current year if not provided
        $page = $request->input('page', 1); // Default to the first page if not provided

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

        //Return the view with both sets of data
        if ($request->header('HX-Request')) {
            return view('visitor.pub', [
                'kabupatenData' => $kabupatenData,
                'paginator' => $paginator,
                'settings' => $settings,
                'carousels' => $carousels
            ])->fragment('publications-section');
        }
        return view('visitor.pub', [
            'kabupatenData' => $kabupatenData,
            'paginator' => $paginator,
            'settings' => $settings,
            'carousels' => $carousels
        ]);
    }

    public function tablePub(Request $request)
    {
        // Define domain_id and year for the second API request
        $domain_id = $request->input('domain_id', '6310'); // Replace '6310' with an actual default value if necessary
        $year = $request->input('year', now()->year); // Default to the current year if not provided
        $page = $request->input('page', 1); // Default to the first page if not provided

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

}
