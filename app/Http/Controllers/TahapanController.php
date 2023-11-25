<?php

namespace App\Http\Controllers;

use App\Models\Background;
use App\Models\Tahapan;
use Illuminate\Http\Request;
use Auth;

class TahapanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $backgrounds = Background::all();
            $tahapans = Tahapan::all();
            return view ('admin.tahapan', compact('tahapans', 'backgrounds'));
        } else {
            return redirect()->back()->with(['error' => 'Where there is a will there is a way']);
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
        $this->validate($request, [
            'nama'     => 'required|unique:tahapans',

        ]);

        $tahapan = new Tahapan();
        $tahapan->nama = $request->nama;
        $tahapan->status = 'active';
        $tahapan->save();

        return redirect()->back()->with('success','Data added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tahapan $tahapan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tahapan $tahapan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tahapan $tahapan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tahapan $tahapan)
    {
        if (Auth::user()->role == 'admin') {
            $tahapan->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Berhasil menghapus data'
        ]);
        } else{
            return response()->json([
                'message' => 'This is unauthorized action',
            ]);
        }
    }

    public function changeStatus($id)
    {
        $tahapan = Tahapan::find($id);

        if (!$tahapan) {
            return response()->json(['success' => false, 'message' => 'Tahapan tidak ditemukan']);
        }
        $tahapan->status = $tahapan->status === 'active' ? 'inactive' : 'active';
        $tahapan->save();

        return response()->json([
            'success' => true, 
            'newStatus' => $tahapan->status,
            'message' => 'Berhasil merubah status'
        ]);
    }
}
