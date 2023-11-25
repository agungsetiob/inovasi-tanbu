<?php

namespace App\Http\Controllers;

use App\Models\Bentuk;
use App\Models\Background;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class BentukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $backgrounds = Background::all();
            $bentuks = Bentuk::all();
            return view ('admin.bentuk', compact('bentuks', 'backgrounds'));
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
            'nama'     => 'required|unique:bentuks',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $bentuk = new Bentuk();
        $bentuk->nama = $request->nama;
        $bentuk->status = 'active';
        $bentuk->save();

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan',
            'data'  => $bentuk
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Bentuk $bentuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bentuk $bentuk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bentuk $bentuk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bentuk $bentuk)
    {
        if (Auth::user()->role == 'admin') {
            $bentuk->delete();
            return response()->json([
            'success' => true,
            'message' => 'Berhasil menghapus data',
        ]); 
        } else{
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized to delete data'
            ], 403);
        }
    }

    public function changeStatus($id)
    {
        $bentuk = Bentuk::find($id);

        if (!$bentuk) {
            return response()->json(['success' => false, 'message' => 'Bentuk not found']);
        }
        $bentuk->status = $bentuk->status === 'active' ? 'inactive' : 'active';
        $bentuk->save();

        return response()->json([
            'success' => true, 
            'newStatus' => $bentuk->status,
            'message' => 'Berhasil merubah status bentuk'
        ]);
    }

    // public function disable($id, Request $request)
    // {
    //     if (Auth::user()->role == 'admin') {
    //         $cat = Bentuk::findOrFail($id);
    //         $cat->update([
    //             'status'     => 'inactive'
    //         ]);
    //         return redirect()->back()->with('success', 'Berhasil merubah status bentuk');
    //     }
    // }

    // public function enable($id, Request $request)
    // {
    //     if (Auth::user()->role == 'admin') {
    //         $cat = Bentuk::findOrFail($id);
    //         $cat->update([
    //             'status'     => 'active'
    //         ]);
    //         return redirect()->back()->with('success', 'Berhasil merubah status bentuk');
    //     }
    // }
}
