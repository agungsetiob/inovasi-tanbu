<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Proposal;
use App\Models\Setting;
use App\Models\Riset;
use App\Models\Winner;
use App\Models\{Category, Contact, Bentuk, Skpd, Tematik, Tahapan};
use Illuminate\Http\Request;
use DB;
class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::all();
        return view('visitor.cover', compact('settings'));
    }

    /**
     * Display a listing of the inovation resource.
     */
    public function inovasi()
    {
        $carousels = Carousel::all();
        $settings = Setting::all();
        $totalProposals = Proposal::all()->count();
        //$currentYearProposals = Proposal::whereYear('created_at', Carbon::now()->year)->count();
        $masyarakatProposals = Proposal::whereHas('skpd', function ($query) {
            $query->where('nama', 'Non SKPD-Masyarakat-Sekolah');
        })->count();
        $skpdProposals = Proposal::whereHas('skpd', function ($query) {
            $query->where('nama', '<>', 'Non SKPD-Masyarakat-Sekolah');
        })->count();
        $inisiatif = Proposal::where('tahapan_id', 1)->count();
        $ujicoba = Proposal::where('tahapan_id', 2)->count();
        $implementasi = Proposal::where('tahapan_id', 3)->count();
        $years = DB::table('winners')
        ->distinct()
        ->get(['tahun']);
        $winners = Winner::select('tahun', 'kategori', 'pengusul', 'proposal_id')
        ->groupBy('tahun', 'kategori', 'pengusul', 'proposal_id')
        ->get();
        return view('visitor.index', compact(
            // 'proposals', 
            'carousels', 
            'settings', 
            'totalProposals',
            'inisiatif',
            'ujicoba',
            'implementasi',
            //'currentYearProposals',
            'masyarakatProposals',
            'skpdProposals',
            'years',
            'winners'
        ));
    }

    /**
     * Display a listing of the inovation resource.
     */
    public function evaluasi()
    {
        $carousels = Carousel::all();
        $settings = Setting::all();
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
        return view('visitor.evaluasi', compact(
            'carousels',
            'settings',
            'chartBentuk',
            'labelBentuk',
            'chartJenis',
            'labelJenis',
            'chartTematik',
            'labelTematik',
            'yearlyProposals',
            'years',
            'chartTahapan',
            'labelTahapan',
            'groupedData'
        ));
    }

    /**
    * Display all riset proposal
    */
    public function loadRiset()
    {
        $risets = Riset::with('skpd')->whereNotNull('url')->get();
        sleep(1);
        return response()->json([
            'data' => $risets,
            'message'=>'success',
        ])->header('HX-Trigger', 'reloadTable');;
    }

    /**
     * Display a listing of the inovation resource.
     */
    public function riset()
    {
        $carousels = Carousel::all();
        $settings = Setting::all();
        $risets = Riset::whereNotNull('url')->paginate(3);
        // if ($request->header('HX-Request')) {
        //     return view('visitor.partial.riset-item', compact('carousels', 'settings', 'risets'));
        // }
        return view('visitor.riset', compact('carousels', 'settings', 'risets'));
    }

    /**
    * Display all inovations
    */
    public function proposal()
    {
        $proposals = Proposal::where('status', 'sent')->get();
        $settings = Setting::all();
        return view('visitor.partial.proposal-item', compact('proposals', 'settings'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Proposal $proposal)
    {
        $skpd = $proposal->skpd->nama;
        return response()->json([
            'success' => true,
            'data' => $proposal,
            'skpd' => $skpd
        ]);
    }
}
