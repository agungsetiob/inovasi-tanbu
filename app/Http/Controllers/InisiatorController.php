<?php

namespace App\Http\Controllers;

use App\Models\Background;
use App\Models\Inisiator;
use Illuminate\Http\Request;
use Auth;

class InisiatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $backgrounds = Background::all();
            $inisiators = Inisiator::all();
            return view ('admin.inisiator', compact('inisiators', 'backgrounds'));
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
            'nama'     => 'required|unique:inisiators',

        ]);
        $inisiator = new Inisiator();
        $inisiator->nama = $request->nama;
        $inisiator->status = 'active';
        $inisiator->save();

        return redirect()->back()->with('success','Data added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Inisiator $inisiator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inisiator $inisiator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inisiator $inisiator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inisiator $inisiator)
    {
        if (Auth::user()->role == 'admin') {
            $inisiator->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Berhasil menghapus data'

        ]);
        } else{
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data'
            ]);
        }
    }

    public function changeStatus($id)
    {
        $inisiator = Inisiator::find($id);

        if (!$inisiator) {
            return response()->json(['success' => false, 'message' => 'inisiator tidak ditemukan']);
        }
        $inisiator->status = $inisiator->status === 'active' ? 'inactive' : 'active';
        $inisiator->save();

        return response()->json([
            'success' => true, 
            'newStatus' => $inisiator->status,
            'message' => 'Berhasil merubah status'
        ]);
    }
}
