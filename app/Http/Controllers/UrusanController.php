<?php

namespace App\Http\Controllers;

use App\Models\Background;
use App\Models\Urusan;
use App\Models\Klasifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class UrusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $backgrounds = Background::all();
            $klasifikasis = Klasifikasi::where('status', 'active')->get();
            return view ('admin.urusan', compact('klasifikasis', 'backgrounds'));
        } else {
            return redirect()->back()->with(['error' => 'Where there is a will there is a way']);
        }
    }

    /*
    * load klasifikasi data in json format
    */
    public function klasifikasi()
    {
        $urusans = Urusan::with('klasifikasi')->get();
        return response()->json([
            'success' => true,
            'data'    => $urusans
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'     => 'required|unique:urusans',
            'klasifikasi_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $urusan = Urusan::create([
            'nama'     => $request->nama,
            'klasifikasi_id' => $request->klasifikasi_id,
            'status'   => 'active',
        ]);
        $klas = $urusan->klasifikasi;

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data',
            'data'    => $urusan,
            'klas' => $klas
        ]);
    }

    /**
     * change status of klasifikasi
     */
    public function toggleStatus(Urusan $urusan)
    {
        $currentStatus = request('currentStatus');
        $newStatus = ($currentStatus === 'active') ? 'inactive' : 'active';
        $urusan->update(['status' => $newStatus]);
        return response()->json(['newStatus' => $newStatus, 'message' => 'Berhasil merubah status']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Urusan $urusan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Urusan $urusan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Urusan $urusan)
    {
        if (Auth::user()->role == 'admin') {
            $urusan->delete();
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
