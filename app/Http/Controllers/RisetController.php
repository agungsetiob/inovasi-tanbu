<?php

namespace App\Http\Controllers;

use App\Models\Riset;
use App\Models\Background;
use Illuminate\Http\Request;

class RisetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $backgrounds = Background::all();
        if ($request->header('HX-Request')) {
            return view('riset.riset', compact('backgrounds'))->fragment('riset');
        }
        return view('riset.riset', compact('backgrounds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $backgrounds = Background::all();
        if ($request->header('HX-Request')) {
            return view('riset.create', compact('backgrounds'))->fragment('create-riset');
        }
        return view('riset.create', compact('backgrounds'));
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
    public function show(Riset $riset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Riset $riset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Riset $riset)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Riset $riset)
    {
        //
    }
}
