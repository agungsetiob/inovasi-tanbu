<?php

namespace App\Http\Controllers;

use App\Models\Background;
use App\Models\Skpd;
use Illuminate\Http\Request;
use Auth;

class SkpdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $backgrounds = Background::all();
            return view ('admin.skpd', compact('backgrounds'));
        } else {
            return redirect()->back()->with(['error' => 'Where there is a will there is a way']);
        }
    }

    /*
    * Load skpd data in json format
    */
    public function loadSkpds()
    {
        $skpds = Skpd::all();
        return response()->json([
            'success' => true,
            'data' => $skpds
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama'     => 'required|unique:skpds',
        ]);

        $skpd = new Skpd();
        $skpd->nama = $request->nama;
        $skpd->status = 'active';
        $skpd->save();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menyimpan data',
            'data' => $skpd
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skpd $skpd)
    {
        if (Auth::user()->role == 'admin') {
            $skpd->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Berhasil menghapus data'
        ]);
        } else{
            return response()->json([
                'message' => 'Not authorized!'
            ]);
        }
    }

    public function changeStatus($id)
    {
        $skpd = Skpd::find($id);

        if (!$skpd) {
            return response()->json(['success' => false, 'message' => 'skpd tidak ditemukan']);
        }
        $skpd->status = $skpd->status === 'active' ? 'inactive' : 'active';
        $skpd->save();

        return response()->json([
            'success' => true, 
            'newStatus' => $skpd->status,
            'message' => 'Berhasil merubah status',
            'nama' => $skpd->nama
        ]);
    }
}
