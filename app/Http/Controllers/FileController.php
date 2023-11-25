<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Background;
use App\Models\File;
use App\Models\Proposal;
use App\Models\Bukti;
use App\Models\Indikator;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $backgrounds = Background::all();
        $proposalId = $id;
        $proposal = Proposal::findOrFail($id);
        $buktis = Bukti::where('status', 'active')->get();
        $indikators = Indikator::where('status', 'active')->get();
        $totalBobot = File::with('bukti')
        ->where('proposal_id', $id)
        ->get()
        ->pluck('bukti.bobot')
        ->sum();
        //$files = Indikator::all();
        return view('admin.file', compact(
            //'files', 
            'proposal', 
            'buktis', 
            'indikators', 
            'totalBobot', 
            'proposalId',
            'backgrounds'
        ));
    }

    public function bukti($id)
    {
        $files = File::with('bukti')->where('proposal_id', $id)->get()->pluck('bukti.bobot');
        return response()->json([
            'success' => true,
            'data'    => $files
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'informasi' => 'required',
            'bukti' => 'required',
            'file' => 'nullable|mimes:pdf,jpg,jpeg,png|max:3072',
        ]);

        $proposal = Proposal::find($request->proposal_id);

        if ($proposal && $proposal->status === 'draft' && auth()->user()->id === $proposal->user_id) {
            $fileData = [
                'informasi' => addslashes($request->informasi),
                'user_id' => auth()->user()->id,
                'proposal_id' => $request->proposal_id,
                'bukti_id' => $request->bukti,
                'indikator_id' => $request->indikator_id,
            ];

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $file->storeAs('public/docs', $file->hashName());
                $fileData['file'] = $file->hashName();
            }

            $buktiDukung = File::create($fileData);

            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Disimpan!',
                'data' => $buktiDukung
            ]);
        }
    }


    /**
     * Store a newly created resource for spd in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSpd(Request $request)
    {
        $this->validate($request, [
            'informasi' => 'required',
            'bukti' => 'required',
            'file' => 'nullable|mimes:pdf|max:3072',
        ]);

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $file->storeAs('public/docs', $file->hashName());
            }

            $file = File::create([
                'file' => $file->hashName() ?? null,
                'informasi' => addslashes($request->informasi),
                'user_id' => auth()->user()->id,
                'proposal_id' => $request->proposal_id,
                'bukti_id' => $request->bukti,
                'indikator_id' => $request->indikator_id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Disimpan!',
                'data' => $file
            ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(Indikator $indikator)
    {
        $bukti = $indikator->buktis->map(function ($bukti) {
            return [
                'id' => $bukti->id,
                'nama' => $bukti->nama,
                'bobot' => $bukti->bobot,
            ];
        });

        $files = $indikator->files;
        $fileData = [];
        foreach ($files as $file) {
            $fileData[] = [
                'informasi' => $file->informasi,
                'buktiId' => $file->bukti_id,
                'id'    =>$file->id
            ];
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Data Indikator',
            'data' => $indikator,
            'bukti' => $bukti,
            'files' => $fileData,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(Proposal $proposal, Indikator $indikator)
    {
        $bukti = $indikator->buktis->map(function ($bukti) {
            return [
                'id' => $bukti->id,
                'nama' => $bukti->nama,
                'bobot' => $bukti->bobot,
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'Detail Data Indikator',
            'data' => $proposal,
            'bukti' => $bukti,
        ]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        if ($file->user_id === Auth::user()->id && $file->proposal->status === 'draft') {
            $this->validate($request, [
                'informasi' => 'required',
                'bukti' => 'required',
                'file' => 'nullable|mimes:pdf,png,jpg,jpeg|max:3072',
            ]);

            if ($request->hasFile('file')) {
                Storage::delete('public/docs/' . $file->file);
                $newFile = $request->file('file');
                $newFileName = $newFile->hashName();
                $newFile->storeAs('public/docs', $newFileName);
                $file->file = $newFileName;
            }

            $file->informasi = $request->informasi;
            $file->bukti_id = $request->bukti;
            $file->save();

            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Diupdate!',
                'data' => $file,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function updateSpd(Request $request, File $file)
    {
        if (Auth::user()->role == 'admin') {
            $this->validate($request, [
                'informasi' => 'required',
                'bukti' => 'required',
                'file' => 'nullable|mimes:pdf|max:3072',
            ]);

            if ($request->hasFile('file')) {
                Storage::delete('public/docs/' . $file->file);
                $newFile = $request->file('file');
                $newFileName = $newFile->hashName();
                $newFile->storeAs('public/docs', $newFileName);
                $file->file = $newFileName;
            }

            $file->informasi = $request->informasi;
            $file->bukti_id = $request->bukti;
            $file->save();

            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Diupdate',
                'data' => $file,
            ]);
        } else {
            return response()->json([
                'error' => 'Gagal update data',
                'success' => false
        ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // public function update(Request $request, File $file)
    // {
    //     if ($file->user_id === Auth::user()->id && $file->proposal->status === 'draft') {
    //         $this->validate($request, [
    //             'informasi' => 'required',
    //             'bukti' => 'required',
    //             'file' => 'nullable|mimes:pdf,png,jpg,jpeg|max:3072',
    //         ]);

    //         if ($request->hasFile('file')) {
    //             // Check if the old file exists before deleting
    //             if (Storage::exists('public/docs/' . $file->file)) {
    //                 Storage::delete('public/docs/' . $file->file);
    //             }

    //             $newFile = $request->file('file');
    //             $newFileName = $newFile->hashName();
    //             $newFile->storeAs('public/docs', $newFileName);
                
    //             // Use update method for mass assignment
    //             $file->update([
    //                 'file' => $newFileName,
    //                 'informasi' => $request->informasi,
    //                 'bukti_id' => $request->bukti,
    //             ]);
    //         } else {
    //             // If no new file, only update other attributes
    //             $file->update([
    //                 'informasi' => $request->informasi,
    //                 'bukti_id' => $request->bukti,
    //             ]);
    //         }

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Data Berhasil Diupdate!',
    //             'data' => $file,
    //         ]);
    //     }
    // }

}
