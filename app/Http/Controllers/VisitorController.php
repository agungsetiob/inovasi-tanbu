<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Proposal;
use App\Models\Setting;
use Illuminate\Http\Request;

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
        $proposals = Proposal::where('status', 'sent')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();
        return view('visitor.index', compact('proposals', 'carousels', 'settings'));
    }

    /**
     * Display a listing of the inovation resource.
     */
    public function litbang()
    {
        $carousels = Carousel::all();
        $settings = Setting::all();
        return view('visitor.litbang', compact('carousels', 'settings'));
    }

    /**
     * Display a listing of the inovation resource.
     */
    public function riset()
    {
        $carousels = Carousel::all();
        $settings = Setting::all();
        return view('visitor.riset', compact('carousels', 'settings'));
    }

    /**
    * Display all inovations
    */
    public function proposal()
    {
        $proposals = Proposal::latest()->paginate(9);
        $settings = Setting::all();
        return view('visitor.all-inovasi', compact('proposals', 'settings'));
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
