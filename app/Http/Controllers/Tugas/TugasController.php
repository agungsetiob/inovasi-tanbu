<?php

namespace App\Http\Controllers\Tugas;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use App\Exports\ProposalsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Background;
use App\Models\{Category, Contact, Bentuk, Skpd, Riset, Tematik, Tahapan};
use App\Models\User;
use Auth;
use DB;

class TugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Fetch all necessary data
        $backgrounds = Background::all();
        $totalProposals = Proposal::count();
        $totalSkpds = Skpd::count();

        // Fetch chart data
        $chartBentuk = Proposal::select(DB::raw('bentuk_id, count(id) as total'))
            ->groupBy('bentuk_id')
            ->orderBy('bentuk_id', 'asc')
            ->get()
            ->pluck('total', 'bentuk_id');

        $chartJenis = Proposal::select(DB::raw('category_id, count(id) as total2'))
            ->groupBy('category_id')
            ->orderBy('category_id', 'asc')
            ->get()
            ->pluck('total2', 'category_id');

        $chartTematik = Proposal::select(DB::raw('tematik_id, count(id) as total3'))
            ->groupBy('tematik_id')
            ->orderBy('tematik_id', 'asc')
            ->get()
            ->pluck('total3', 'tematik_id');

        $chartYears = Proposal::select(DB::raw('YEAR(implementasi) as year'), DB::raw('count(id) as total4'))
            ->groupBy(DB::raw('YEAR(implementasi)'))
            ->orderBy(DB::raw('YEAR(implementasi)'), 'asc')
            ->get();

        $years = $chartYears->pluck('year');
        $yearlyProposals = $chartYears->pluck('total4');

        $chartTahapan = Proposal::select(DB::raw('tahapan_id, count(id) as total5'))
            ->groupBy('tahapan_id')
            ->orderBy('tahapan_id', 'desc')
            ->get()
            ->pluck('total5', 'tahapan_id');

        // Fetch labels
        $labelTahapan = Tahapan::whereHas('proposals')->pluck('nama')->unique();
        $labelBentuk = Bentuk::whereHas('proposals')->pluck('nama')->unique();
        $labelJenis = Category::whereHas('proposals')->pluck('name')->unique();
        $labelTematik = Tematik::whereHas('proposals')->pluck('nama')->unique();

        // Group data for tahapan
        $proposals = Proposal::all();
        $tahapan = Tahapan::all();
        $groupedData = $proposals->groupBy('tahapan_id')->map(function ($group) use ($tahapan) {
            $namaTahapan = $tahapan->where('id', $group->first()->tahapan_id)->first()->nama;
            return [
                'nama_tahapan' => $namaTahapan,
                'jumlah_proposal' => $group->count()
            ];
        });

        // Other data
        $messages = Contact::count();
        $activeUsers = User::where('status', 'active')->count();
        $inactiveUsers = User::where('status', 'inactive')->count();

        // Decide the view based on the request header
        $view = 'tugas.index';
        $viewData = compact(
            'activeUsers',
            'inactiveUsers',
            'totalProposals',
            'messages',
            'chartBentuk',
            'labelBentuk',
            'chartJenis',
            'labelJenis',
            'totalSkpds',
            'backgrounds',
            'chartTematik',
            'labelTematik',
            'yearlyProposals',
            'years',
            'chartTahapan',
            'labelTahapan',
            'groupedData'
        );

        if ($request->header('HX-Request')) {
            return view($view, $viewData)->fragment('dashboard');
        } else {
            return view($view, $viewData);
        }
    }

    public function export()
    {
        return Excel::download(new ProposalsExport, 'inovasi-tanah-bumbu.xlsx');
    }


}
