<?php

namespace App\Http\Controllers;

use App\Models\Background;
use App\Models\Klasifikasi;
use App\Models\Urusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class KlasifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $backgrounds = Background::all();
            $klasifikasis = Klasifikasi::all();
            return view ('admin.klasifikasi-urusan', compact('klasifikasis', 'backgrounds'));
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
        $validator = Validator::make($request->all(), [
            'nama'     => 'required|unique:klasifikasis',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $klasifikasi = Klasifikasi::create([
            'nama'     => $request->nama,
            'status'   => 'active',
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $klasifikasi 
        ]);
    }

    /**
     * change status of klasifikasi
     */
    public function toggleStatus(Klasifikasi $klasifikasi)
    {
        $currentStatus = request('currentStatus');

    // Toggle the status
        $newStatus = ($currentStatus === 'active') ? 'inactive' : 'active';
        $klasifikasi->update(['status' => $newStatus]);

        return response()->json(['newStatus' => $newStatus]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Klasifikasi $klasifikasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Klasifikasi $klasifikasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Klasifikasi $klasifikasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Klasifikasi $klasifikasi)
    {
        if (Auth::user()->role == 'admin') {
            $klasifikasi->delete();
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menghapus data',
            ]); 
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized to delete data'
            ], 403);
        }
    }
}
