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
    public function index(Request $request)
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
            // sleep(2);
            if ($request->header('HX-Request')) {
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
                ))->fragment('dashboard');
            } else {
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
            }
        } else {
            return view('cukrukuk');
        }
    }

    public function user(Request $request)
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
            //sleep(1);
            if ($request->header('HX-Request')) {
                return view('admin.index', compact('totalProposals', 'chartJenis', 'chartBentuk', 'labelJenis', 'labelBentuk', 'totalSkpds', 'backgrounds'))->fragment('dashboard');
            }else{
                return view('admin.index', compact('totalProposals', 'chartJenis', 'chartBentuk', 'labelJenis', 'labelBentuk', 'totalSkpds', 'backgrounds'));
            }
        }else
        {
            return view('cukrukuk');
        }
    }

    public function dashboard(Request $request)
    {
        if (Auth::user()->role == 'admin') {
            $backgrounds = Background::all();
            if ($request->header('HX-Request')) {
                return view('riset.index', compact('backgrounds'))->fragment('dashboard');
            }else{
                return view('riset.index', compact('backgrounds'));
            }
        }else
        {
            return view('cukrukuk');
        }
    }

    public function dashboardUser(Request $request)
    {
        if (Auth::user()->role == 'user') {
            $backgrounds = Background::all();
            if ($request->header('HX-Request')) {
                return view('riset.index', compact('backgrounds'))->fragment('dashboard');
            }else{
                return view('riset.index', compact('backgrounds'));
            }
        }else
        {
            return view('cukrukuk');
        }
    }

}
