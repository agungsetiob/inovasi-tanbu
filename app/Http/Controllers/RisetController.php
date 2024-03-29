<?php

namespace App\Http\Controllers;

use App\Models\Riset;
use App\Models\Background;
use Barryvdh\DomPDF\Facade\PDF;
use GrahamCampbell\ResultType\Success;
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
            'judul' => 'required|unique:risets',
            'latar' => 'required',
            'hukum' => 'required',
            'maksud' => 'required',
            'ruang_lingkup' => 'required',
            'target' => 'required',
            'output' => 'required',
            'manfaat' => 'required',
            'dana' => 'required',
            'rab' => 'required|file|mimes:pdf|max:2048',
            'peneliti' => 'required',
            'tahapan' => 'required',
            'jangka' => 'required',
        ];

        // Validate the request data
        $request->validate($rules);

        // Process 'rab' file upload
        $rabPath = $request->file('rab')->store('rab', 'public');

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
            'rab' => $rabPath,
            'peneliti' => $request->peneliti,
            'tahapan' => $request->tahapan,
            'jangka' => $request->jangka,
            'jenis_sumber_data' => $request->jenis_sumber_data,
            'analisa' => $request->analisa,
            'teknik' => $request->teknik,
            'skpd_id' => auth()->user()->skpd_id,
            'user_id' => auth()->user()->id,
        ]);

        // Save the Riset instance to the database
        $riset->save();

        // Optionally, you can redirect the user or return a response
        return redirect()->route('riset.index')->with('success', 'Riset created successfully');
    }

    /**
    * Display all riset proposal
    */
    public function loadRiset()
    {
        if(auth()->user()->role == 'admin'){
            $risets = Riset::with('skpd')->get();
        } else {
            $risets = Riset::with('skpd')->where('user_id', auth()->user()->id)->get();
        }
        
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
    public function edit(Riset $riset, Request $request)
    {
        $backgrounds = Background::all();
        if(Auth::user()->id == $riset->user_id) {
            if($request->header('HX-Request')) {
                return view('riset.edit', compact(
                    'riset',
                    'backgrounds'
                ))->fragment('edit-riset');
            } else{
                return view('riset.edit', compact(
                    'riset',
                    'backgrounds'
                ));
            }
        } else {
            return redirect()->back()->with('error', 'kebaikan akan menghasilkan kebaikan');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Riset $riset)
    {
        $rules = [
            'judul' => 'required|unique:risets,judul,' . $riset->id,
            'latar' => 'required',
            'hukum' => 'required',
            'maksud' => 'required',
            'ruang_lingkup' => 'required',
            'target' => 'required',
            'output' => 'required',
            'manfaat' => 'required',
            'dana' => 'required',
            'rab' => 'nullable|file|mimes:pdf|max:2048',
            'peneliti' => 'required',
            'tahapan' => 'required',
            'jangka' => 'required',
        ];

        $request->validate($rules);

        $riset->judul = $request->judul;
        $riset->latar = $request->latar;
        $riset->hukum = $request->hukum;
        $riset->maksud = $request->maksud;
        $riset->ruang_lingkup = $request->ruang_lingkup;
        $riset->target = $request->target;
        $riset->output = $request->output;
        $riset->manfaat = $request->manfaat;
        $riset->dana = $request->dana;
        $riset->peneliti = $request->peneliti;
        $riset->tahapan = $request->tahapan;
        $riset->jangka = $request->jangka;
        $riset->jenis_sumber_data = $request->jenis_sumber_data;
        $riset->analisa = $request->analisa;
        $riset->teknik = $request->teknik;

        if ($request->hasFile('rab') && $request->file('rab')->isValid()) {
            Storage::disk('public')->delete($riset->rab);

            $riset->rab = $request->file('rab')->store('rab', 'public');
        }

        $riset->save(); //save can be used for creating new resource or update it, update is specially for updating

        return redirect()->route('riset.index')->with('success', 'Riset updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Riset $riset)
    {
        if(Auth::user()->id == $riset->user_id) {
            Storage::disk('public')->delete($riset->rab);
            $riset->delete();
            return response()->json([
                'success'=> true
            ]);
        } else {
            return response()->json([
                'success'=>false
            ]);
        }
    }

    /**
    * Print proposal
    */
    public function risetReport($id)
    {
        $riset = Riset::findOrFail($id);
        $pdf = PDF::loadview('riset.pengajuan-riset-report',compact('riset'))->setPaper('A4', 'portrait');
        set_time_limit(300);
        return $pdf->stream('proposal-riset'.$id.'.pdf');
    }

    public function updateUrl(Request $request, $id)
    {
        $request->validate([
            'url' => 'required|url',
        ]);

        try {
            if (Auth::user()->role == 'admin'){
                $riset = Riset::findOrFail($id);
                $riset->update([
                    'url' => $request->input('url'),
                ]);
            } else {
                return response()->json(['error' => 'omaigad'], 500);
            }

            return response()->json([
                'success' => true,
                'message' => 'URL updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success'=>false,
                'error' => $e->getMessage()], 500);
        }
    }

}
