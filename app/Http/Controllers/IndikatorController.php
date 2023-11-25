<?php

namespace App\Http\Controllers;

use App\Models\Background;
use App\Models\Indikator;
use Illuminate\Http\Request;
use Auth;

class IndikatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $backgrounds = Background::all();
            return view ('admin.indikator', compact('backgrounds'));
        } else {
            return redirect()->back()->with(['error' => 'Where there is a will there is a way']);
        }
    }

    /*
    * Load indikator data in json format
    */
    public function loadIndikators()
    {
        $indikators = Indikator::all();
        return response()->json([
            'success' => true,
            'data' => $indikators
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|unique:indikators',
            'jenis' => 'required'
        ]);
        $indikator = new Indikator();
        $indikator->nama = $request->nama;
        $indikator->status = 'active';
        $indikator->jenis = $request->jenis;
        $indikator->save();

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan',
            'data' => $indikator
        ]);

        //return redirect()->back()->with('success','Data added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Indikator $indikator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Indikator $indikator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Indikator $indikator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Indikator $indikator)
    {
        if (Auth::user()->role == 'admin') {
            $indikator->delete();
        
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menghapus data'
            ]);
        } else{
            return response()->json(['message' => 'Gagal menghapus data']);
        }
    }

    public function changeStatus($id)
    {
        $indikator = Indikator::find($id);

        if (!$indikator) {
            return response()->json(['success' => false, 'message' => 'Indikator tidak ditemukan']);
        }
        $indikator->status = $indikator->status === 'active' ? 'inactive' : 'active';
        $indikator->save();

        return response()->json([
            'success' => true, 
            'newStatus' => $indikator->status,
            'message' => 'Berhasil merubah status',
            'indikator' => $indikator->nama
        ]);
    }
}
