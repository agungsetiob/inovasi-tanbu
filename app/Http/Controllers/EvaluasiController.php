<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Background;
use App\Models\Evaluasi;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EvaluasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $backgrounds = Background::all();
        if (Auth::user()->role == 'admin') {
            if ($request->header('HX-Request')) {
                return view('evaluasi.index', compact('backgrounds'))->fragment('evaluasi');
            }
            return view('evaluasi.index', compact('backgrounds'));
        } else {
            abort(403, 'You destroy the world');
        }
    }

    /**
     * Display all evaluasi
     */
    public function loadEvaluasi()
    {
        $evaluasis = Evaluasi::all();
        //sleep(1);
        return response()->json([
            'data' => $evaluasis,
            'message' => 'success',
        ])->header('HX-Trigger', 'reloadTable');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if (Auth::user()->role == 'admin') {
            $backgrounds = Background::all();
            $view = 'evaluasi.create';
            $viewData = compact('backgrounds');
            if ($request->header('HX-Request')) {
                return view($view, $viewData)->fragment('create-evaluasi');
            }
            return view($view, $viewData);
        } else {
            abort(403, 'forbidden access');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255|unique:evaluasis',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'link' => 'nullable|url',
        ]);

        $data = $request->only(['judul', 'deskripsi', 'link']);
        $data['user_id'] = Auth::id();
        $data['skpd_id'] = Auth::user()->skpd_id;
        $data['slug'] = Str::slug($request->judul, '-');

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('evaluasi', 'public');
            $data['foto'] = $fotoPath;
        }

        Evaluasi::create($data);

        return redirect()->route('evaluasi.index')->with('success', 'Evaluasi created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Evaluasi $evaluasi)
    {
        $skpd = $evaluasi->skpd->nama;
        $slug = $evaluasi->slug;
        $slugUrl = url("/list/evaluasi/{$slug}");
        return response()->json([
            'success' => true,
            'data' => $evaluasi,
            'skpd' => $skpd,
            'slugUrl' => $slugUrl
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function showSlug($slug)
    {
        $evaluasi = Evaluasi::where('slug', $slug)->firstOrFail();
        $settings = Setting::all();
        return view('evaluasi.show', compact('evaluasi', 'settings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Evaluasi $evaluasi)
    {
        if (Auth::user()->role == 'admin') {
            $backgrounds = Background::all();
            if ($request->header('HX-Request')) {
                return view('evaluasi.edit', compact('evaluasi', 'backgrounds'))->fragment('edit-evaluasi');
            }
            return view('evaluasi.edit', compact('evaluasi', 'backgrounds'));
        } else {
            abort(403, 'Forbidden access');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evaluasi $evaluasi)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'link' => 'nullable|url',
        ]);

        $evaluasi->judul = $request->judul;
        $evaluasi->deskripsi = $request->deskripsi;
        if ($request->hasFile('foto')) {
            // Delete the old photo if a new one is uploaded
            if ($evaluasi->foto) {
                Storage::delete('public/' . $evaluasi->foto);
            }
            $fotoPath = $request->file('foto')->store('evaluasi', 'public');
            $evaluasi->foto = $fotoPath;
        }
        $evaluasi->link = $request->link;
        $evaluasi->slug = Str::slug($request->judul, '-'); // Update slug based on judul
        $evaluasi->save();

        return redirect()->route('evaluasi.index')->with('success', 'Evaluasi updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evaluasi $evaluasi)
    {
        if (Auth::user()->role == 'admin') {
            $evaluasi->delete();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil menghapus data'
            ]);
        } else {
            return response()->json([
                'message' => 'Not authorized!'
            ]);
        }
    }
}
