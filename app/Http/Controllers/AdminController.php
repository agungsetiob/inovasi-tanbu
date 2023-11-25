<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;
use App\Models\Background;
use App\Models\{Category, Contact, Bentuk, Skpd};
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Auth;
use DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $backgrounds = Background::all();
            $totalProposals = Proposal::all()->count();
            $totalSkpds = Skpd::all()->count();
            $chartBentuk = Proposal::select(DB::raw('bentuk_id, count(id) as total'))
            ->groupBy('bentuk_id')
            ->orderBy('bentuk_id','asc')
            ->get()
            ->pluck('total');

            $chartJenis = Proposal::select(DB::raw('category_id, count(id) as total2'))
            ->groupBy('category_id')
            ->orderBy('category_id', 'asc')
            ->get()
            ->pluck('total2');

            $messages = Contact::all()->count();
            $activeUsers = User::where('status', '=', 'active')->count();
            $inactiveUsers = User::where('status', '=', 'inactive')->count();
            $labelBentuk = Bentuk::whereHas('proposals')->pluck('nama')->unique();
            $labelJenis = Category::whereHas('proposals')->pluck('name')->unique();

            return view ('admin.index', compact(
                    'activeUsers', 
                    'inactiveUsers',
                    'totalProposals',
                    'messages',
                    'chartBentuk',
                    'labelBentuk',
                    'chartJenis',
                    'labelJenis',
                    'totalSkpds',
                    'backgrounds'
                ));
        } else {
            return view('cukrukuk');
        }
    }

    public function user()
    {
        if (Auth::user()->role == 'user') {
            $backgrounds = Background::all();
            $totalProposals = Proposal::all()->count();
            $totalSkpds = Skpd::all()->count();
            $chartBentuk = Proposal::select(DB::raw('bentuk_id, count(id) as total'))
            ->groupBy('bentuk_id')
            ->orderBy('bentuk_id','asc')
            ->get()
            ->pluck('total');

            $chartJenis = Proposal::select(DB::raw('category_id, count(id) as total2'))
            ->groupBy('category_id')
            ->orderBy('category_id', 'asc')
            ->get()
            ->pluck('total2');
            $labelBentuk = Bentuk::whereHas('proposals')->pluck('nama')->unique();
            $labelJenis = Category::whereHas('proposals')->pluck('name')->unique();
            return view('admin.index', compact('totalProposals', 'chartJenis', 'chartBentuk', 'labelJenis', 'labelBentuk', 'totalSkpds', 'backgrounds'));
        }else
        {
            return view('cukrukuk');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
