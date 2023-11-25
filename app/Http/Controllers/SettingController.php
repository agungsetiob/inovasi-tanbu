<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Background;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $backgrounds = Background::all();
            $settings = Setting::all();
            $dataExist = $settings->count() > 0;
            return view('setting.setting', compact(
                'settings',
                'dataExist',
                'backgrounds'
            ));
        } else {
            return view('cukrukuk');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->role == 'admin') {
            $this->validate($request, [
                'nama_sistem'   => 'required',
                'alamat'     => 'required',
                'tentang'   => 'required',
                'logo_cover' => 'mimes:png|max:300',
                'logo_sistem' => 'mimes:png|max:400'
            ]);
            if ($request->hasFile('logo_sistem')) {
                $sistem = $request->file('logo_sistem');
                $sistem->storeAs('public/system', $sistem->hashName());
            }
            if ($request->hasFile('logo_cover')) {
                $cover = $request->file('logo_cover');
                $cover->storeAs('public/system', $cover->hashName());
            }
            Setting::create([
                'logo_sistem' => $sistem->hashName(),
                'logo_cover' => $cover->hashName(),
                'nama_sistem' => $request->nama_sistem,
                'tentang' => $request->tentang,
                'alamat' => $request->alamat
            ]);
            return response()->json(['success' => true, 'message' => 'Berhasil gan uhuy']);
        } else {
            return redirect('/');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        return response()->json([
            'data' => $setting
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        if (Auth::user()->role == 'admin') {
            $this->validate($request, [
                'nama_sistem' => 'required',
                'alamat' => 'required',
                'tentang' => 'required',
                'logo_sistem' => 'mimes:png|max:300',
                'logo_cover' => 'mimes:png|max:300',
            ]);

            if ($request->hasFile('logo_sistem')) {
                Storage::delete('public/system/' . $setting->logo_sistem);
                $sistem = $request->file('logo_sistem');
                $sistem->storeAs('public/system', $sistem->hashName());
                $setting->logo_sistem = $sistem->hashName();
            }

            if ($request->hasFile('logo_cover')) {
                Storage::delete('public/system/' . $setting->logo_cover);
                $cover = $request->file('logo_cover');
                $cover->storeAs('public/system', $cover->hashName());
                $setting->logo_cover = $cover->hashName();
            }

            $setting->nama_sistem = $request->nama_sistem;
            $setting->tentang = $request->tentang;
            $setting->alamat = $request->alamat;
            $setting->save();

            return response()->json(['success' => true, 'message' => 'Berhasil update setting']);
        } else {
            return response()->json(['success' => false, 'message' => 'Permission denied']);
        }
    }
}
