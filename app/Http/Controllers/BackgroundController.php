<?php

namespace App\Http\Controllers;


use Auth;
use App\Models\Background;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BackgroundController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $backgrounds = Background::all();
            $dataExist = $backgrounds->count() > 0;
            //dd($dataExist);
            return view ('setting.background', compact('backgrounds', 'dataExist'));
        } else {
            return ('cukrukuk');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'background' => 'required|mimes:jpg,png,svg|max:3072',
        ]);
        $background = $request->file('background');
        $background->storeAs('public/backgrounds', $background->hashName());
            
        Background::create([
            'background'    => $background->hashName()
        ]);
        return redirect()->back()->with('success', 'Berhasil upload gambar');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Background $background)
    {
        Storage::delete('public/backgrounds/'. $background->background);
        $background->delete();
        return response()->json([
            'success' => true,
            'message' => 'Berhasil menghapus gambar',
        ]);
    }

}
