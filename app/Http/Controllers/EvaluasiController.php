<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Background;
use App\Models\Evaluasi;
use App\Models\Riset;
use Illuminate\Http\Request;

class EvaluasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $backgrounds = Background::all();
        if (Auth::user()->role == 'admin') {
            if ($request->header('HX-Request')) {
                return view('evaluasi.index', compact('backgrounds'))->fragment('evaluasi');
            }
            return view('evaluasi.index', compact('backgrounds'));
        } else{
            abort(403, 'You destroy the world');
        }
    }

    /**
    * Display all evaluasi
    */
    public function loadEvaluasi()
    {
        if(auth()->user()->role == 'admin'){
            $evaluasis = Evaluasi::all();
            return response()->json([
                'data' => $evaluasis,
                'message'=>'success',
            ])->header('HX-Trigger', 'reloadTable');
        } else {
            abort(403, 'Not Permitted');
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
    public function show(Evaluasi $evaluasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evaluasi $evaluasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evaluasi $evaluasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evaluasi $evaluasi)
    {
        //
    }
}
