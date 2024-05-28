<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Proposal;
use App\Models\Setting;
use App\Models\Riset;
use App\Models\Winner;
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
        return view('visitor.evaluasi', compact('carousels', 'settings'));
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
