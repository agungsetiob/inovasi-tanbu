<?php

namespace App\Http\Controllers;

use App\Models\Riset;
use App\Models\Background;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RisetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $backgrounds = Background::all();
        if ($request->header('HX-Request')) {
            return view('riset.riset', compact('backgrounds'))->fragment('riset');
        }
        return view('riset.riset', compact('backgrounds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $backgrounds = Background::all();
        if ($request->header('HX-Request')) {
            return view('riset.create', compact('backgrounds'))->fragment('create-riset');
        }
        return view('riset.create', compact('backgrounds'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'judul' => 'required',
            'latar' => 'required',
            'hukum' => 'required',
            'maksud' => 'required',
            'ruang_lingkup' => 'required',
            'target' => 'required',
            'output' => 'required',
            'manfaat' => 'required',
            'dana' => 'required',
            'anggaran' => 'required|file|mimes:pdf|max:2048',
            'peneliti' => 'required',
            'tahapan' => 'required',
            'jangka' => 'required',
            'jenis_sumber_data' => 'required',
            'analisa' => 'required',
            'teknik' => 'required',
        ];

        // Validate the request data
        $request->validate($rules);

        // Process 'anggaran' file upload
        $anggaranPath = $request->file('anggaran')->store('rab', 'public');

        // Create a new Riset instance
        $riset = new Riset([
            'judul' => $request->judul,
            'latar' => $request->latar,
            'hukum' => $request->hukum,
            'maksud' => $request->maksud,
            'ruang_lingkup' => $request->ruang_lingkup,
            'target' => $request->target,
            'output' => $request->output,
            'manfaat' => $request->manfaat,
            'dana' => $request->dana,
            'anggaran' => $anggaranPath,
            'peneliti' => $request->peneliti,
            'tahapan' => $request->tahapan,
            'jangka' => $request->jangka,
            'jenis_sumber_data' => $request->jenis_sumber_data,
            'analisa' => $request->analisa,
            'teknik' => $request->teknik,
            'skpd_id' => auth()->user()->skpd_id,
        ]);

        // Save the Riset instance to the database
        $riset->save();

        // Optionally, you can redirect the user or return a response
        return redirect()->route('pengajuan-riset.index')->with('success', 'Riset created successfully');
    }

    /**
    * Display all riset proposal
    */
    public function all()
    {
        $risets = Riset::with('skpd')->get();
        return response()->json([
            'data' => $risets,
            'message'=>'success',
        ])->header('HX-Trigger', 'reloadTable');;
    }

    /**
     * Display the specified resource.
     */
    public function show(Riset $riset)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Riset $riset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Riset $riset)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Riset $riset)
    {
        //
    }
}
