<?php

namespace App\Http\Controllers;

use App\Models\Background;
use App\Models\Tematik;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;

class TematikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $backgrounds = Background::all();
            return view('admin.tematik', compact('backgrounds'));
        } else {
            return redirect()->back()->with(['error' => 'Where there is a will there is a way']);
        }
    }

    /**
     * load tematik in json format.
     */
    public function loadTematiks()
    {
        $tematiks = Tematik::all();
        return response()->json([
            'success' => true,
            'data' => $tematiks
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'     => 'required|unique:tematiks',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $tematik = Tematik::create([
            'nama'     => $request->nama,
            'status'   => 'active',
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Berhasil Disimpan!',
            'data'    => $tematik
        ]);
    }

    /**
     * change status of klasifikasi
     */
    public function toggleStatus(Tematik $tematik)
    {
        $currentStatus = request('currentStatus');

    // Toggle the status
        $newStatus = ($currentStatus === 'active') ? 'inactive' : 'active';
        $tematik->update(['status' => $newStatus]);

        return response()->json(['newStatus' => $newStatus, 'message' => 'Berhasil merubah status', 'nama' => $tematik->nama]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tematik $tematik)
    {
        if (Auth::user()->role == 'admin') {
            $tematik->delete();
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menghapus data',
            ]); 
        }
    }
}
