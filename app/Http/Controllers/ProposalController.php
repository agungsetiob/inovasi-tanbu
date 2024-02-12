<?php

namespace App\Http\Controllers;

use App\Models\Background;
use App\Models\Proposal;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Models\Skpd;
use App\Models\Bentuk;
use App\Models\Urusan;
use App\Models\File;
use App\Models\Indikator;
use App\Models\Tematik;
use App\Models\Klasifikasi;
use App\Models\Tahapan;
use App\Models\Inisiator;
use App\Models\Note;
use Barryvdh\DomPDF\Facade\PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $backgrounds = Background::all();
        if ($request->header('HX-Request')) {
            return view('inovasi.index', compact('backgrounds'))->fragment('inovasi');
        }
        return view('inovasi.index', compact('backgrounds'));
    }


    /*
    * load proposal in json format
    */
    public function loadProposals()
    {
        $proposals = Proposal::with(['files', 'tahapan', 'category'])
            ->where('user_id', Auth::user()->id)
            ->get();

        $results = $proposals->map(function ($proposal) {
            $skor = $proposal->files->sum(function ($file) {
                return $file->bukti->bobot;
            });

            return [
                'proposal' => $proposal,
                'skor' => $skor,
                'ujicoba' => optional(Carbon::parse($proposal->ujicoba))->format('d/m/Y'),
                'implementasi' => optional(Carbon::parse($proposal->implementasi))->format('d/m/Y'),
                'tahapan' => optional($proposal->tahapan)->nama,
                'category' => optional($proposal->category)->name,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $results,
        ])->header('HX-Trigger', 'reloadTable');
    }

    /*
    * all inovations/proposals
    */
    public function all(Request $request)
    {
        $backgrounds = Background::all();
        if ($request->header('HX-Request')) {
            return view('inovasi.all', compact('backgrounds'))->fragment('all-inovations');
        }
        return view('inovasi.all', compact('backgrounds'));
    }

    /*
    * load all proposal in json format
    */
    public function allProposals()
    {
        $proposals = Proposal::with(['files', 'tahapan', 'skpd'])
            ->where('status', 'draft')
            ->get();

        $results = $proposals->map(function ($proposal) {
            $skor = $proposal->files->sum(function ($file) {
                return $file->bukti->bobot;
            });

            return [
                'proposal' => $proposal,
                'skor' => $skor,
                'skpd' => $proposal->skpd->nama,
                'tahapan' => optional($proposal->tahapan)->nama,
                'category' => optional($proposal->category)->name,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $results,
        ])->header('HX-Trigger', 'reloadAll');
    }

    /**
    * Display proposal with status 'sent'
    *
    */
    public function database(Request $request)
    {
        if (Auth::user()->role == 'admin') {
            $backgrounds = Background::all();
            if ($request->header('HX-Request')) {
                return view ('inovasi.partial.database', compact('backgrounds'));
            } else {
                return view ('inovasi.database', compact('backgrounds'));
            }
            
        } else {
            return redirect()->back()->with(['error' => 'wong kongene kok dibandingke']);
        }
    }

    /*
    * load all sent proposal in json format
    */
    public function sentProposals()
    {
        $user = Auth::user();
        $year = now()->year;

        if ($user->role == 'admin') {
            $proposals = Proposal::with(['files', 'tahapan', 'skpd'])
                ->where('status', 'sent')
                ->whereYear('updated_at', $year)
                ->get();

            $results = $proposals->map(function ($proposal) {
                $skor = $proposal->files->sum(function ($file) {
                    return $file->bukti->bobot;
                });

                return [
                    'proposal' => $proposal,
                    'skor' => $skor,
                    'ujicoba' => Carbon::parse($proposal->ujicoba)->format('d/m/Y'),
                    'implementasi' => Carbon::parse($proposal->implementasi)->format('d/m/Y'),
                    'tahapan' => $proposal->tahapan->nama,
                    'skpd' => $proposal->skpd->nama,
                ];
            });

            return response()->json(['success' => true, 'data' => $results])->header('HX-Trigger', 'reloadDatabase');
        }

        return false;
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $backgrounds = Background::all();
        $categories = Category::where('status', 'active')->get();
        $skpds = Skpd::where('status', 'active')->get();
        $bentuks = Bentuk::where('status', 'active')->get();
        $urusans = Urusan::where('status', 'active')->get();
        $indikators = Indikator::where('status', 'active')->where('jenis', 'sid')->get()->pluck('id');
        $tematiks = Tematik::where('status', 'active')->orderBy('id')->get();
        $tahapans = Tahapan::where('status', 'active')->get();
        $inisiators = Inisiator::where('status', 'active')->get();
        $klasifikasis = Klasifikasi::with(['urusans' => function ($query) {
            $query->where('status', 'active');
        }])->whereHas('urusans', function ($query) {
            $query->where('status', 'active');
        })->get();
        // $options = [];
        // foreach ($klasifikasis as $klasifikasi) {
        //     $options[$klasifikasi->id] = [
        //         'label' => $klasifikasi->nama,
        //         'children' => [],
        //     ];
        //     foreach ($urusans as $urusan) {
        //         if ($urusan->klasifikasi_id === $klasifikasi->id) {
        //             $options[$klasifikasi->id]['children'][$urusan->id] = $urusan->nama;
        //         }
        //     }
        // }

        if($request->header('HX-Request')) {
            return view('inovasi.create', compact(
                'categories', 
                'skpds', 
                'bentuks', 
                'urusans',
                'tematiks',
                'klasifikasis',
                //'options',
                'indikators',
                'tahapans',
                'inisiators',
                'backgrounds'
            ))->fragment('create-proposal');
        }
        return view('inovasi.create', compact(
            'categories', 
            'skpds', 
            'bentuks', 
            'urusans',
            'tematiks',
            'klasifikasis',
            //'options',
            'indikators',
            'tahapans',
            'inisiators',
            'backgrounds'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'profil'     => 'required|mimes:pdf|max:5120',
            'nama'     => 'required|unique:proposals',
            'tahapan'   => 'required',
            'inisiator'      => 'required',
            'rancang_bangun' => 'required',
            'tujuan'    => 'required',
            'manfaat' => 'required',
            'hasil' => 'required',
            'ujicoba' => 'required',
            'implementasi' => 'required',
            'anggaran' => 'mimes:pdf|max:2048',
            'bentuk' => 'required',
            'category' => 'required',
            'urusans' => 'required',
            'tematik' => 'required'

        ]);

        $data = [
            'nama' => $request->nama,
            'tahapan_id'   => $request->tahapan,
            'inisiator_id'      => $request->inisiator,
            'rancang_bangun' => addslashes($request->rancang_bangun),
            'tujuan'    => $request->tujuan,
            'manfaat' => $request->manfaat,
            'hasil' => $request->hasil,
            'ujicoba' => $request->ujicoba,
            'implementasi' => $request->implementasi,
            'bentuk_id' => $request->bentuk,
            'category_id' => $request->category,
            'skpd_id' => $request->skpd,
            'tematik_id' => $request->tematik,
            'user_id' => auth()->user()->id,
            'status' => 'draft'
        ];
        if ($request->hasFile('profil')) {
            $profil = $request->file('profil');
            $profil->storeAs('public/profil', $profil->hashName());
            $data['profil'] = $profil->hashName();
        }
        if ($request->hasFile('anggaran')) {
            $anggaran = $request->file('anggaran');
            $anggaran->storeAs('public/anggaran', $anggaran->hashName());
            $data['anggaran'] = $anggaran->hashName();
        }
        // $proposal = Proposal::create($data);
        // $indikatorIds = Indikator::where('status', 'active')->where('jenis', 'sid')->get()->pluck('id')->toArray();
        // $proposal->urusans()->sync($request->urusans);
        // $proposal->indikators()->sync($indikatorIds);
        // return redirect()->intended('proyek/inovasi')->with(['success' => 'Berhasil simpan inovasi']);
        try {
            $proposal = Proposal::create($data);
            $indikatorIds = Indikator::where('status', 'active')->where('jenis', 'sid')->get()->pluck('id')->toArray();
            
            $proposal->urusans()->sync($request->urusans);
            $proposal->indikators()->sync($indikatorIds);

            return redirect()->intended('proyek/inovasi')->with(['success' => 'Berhasil simpan inovasi']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }   
    }

    /**
     * Display the specified resource.
     */
    public function show(Proposal $inovasi)
    {
        $files = $inovasi->files()->get();
        dd($files);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Proposal $inovasi)
    {
        $backgrounds = Background::all();
        $categories = Category::where('status', 'active')->get();
        $skpds = Skpd::where('status', 'active')->get();
        $bentuks = Bentuk::where('status', 'active')->get();
        $urusans = Urusan::where('status', 'active')->get();
        $tematiks = Tematik::where('status', 'active')->orderBy('id')->get();
        $tahapans = Tahapan::where('status', 'active')->get();
        $inisiators = Inisiator::where('status', 'active')->get();
        $klasifikasis = Klasifikasi::with(['urusans' => function ($query) {
            $query->where('status', 'active');
        }])->whereHas('urusans', function ($query) {
            $query->where('status', 'active');
        })->get();
        $selectedUrusans = $inovasi->urusans->pluck('id')->toArray();
        // $options = [];
        // foreach ($klasifikasis as $klasifikasi) {
        //     $options[$klasifikasi->id] = [
        //         'label' => $klasifikasi->nama,
        //         'children' => [],
        //     ];
        //     foreach ($urusans as $urusan) {
        //         if ($urusan->klasifikasi_id === $klasifikasi->id) {
        //             $options[$klasifikasi->id]['children'][$urusan->id] = $urusan->nama;
        //         }
        //     }
        // }
        if (auth()->user()->id == $inovasi->user_id && $inovasi->status === 'draft') {
            if($request->header('HX-Request')) {
                return view('inovasi.edit', compact(
                    'inovasi',
                    'categories', 
                    'skpds', 
                    'bentuks', 
                    'urusans',
                    'tematiks',
                    //'options',
                    'selectedUrusans',
                    'klasifikasis',
                    'tahapans',
                    'inisiators',
                    'backgrounds'
                ))->fragment('edit-proposal');
            } else{
                return view('inovasi.edit', compact(
                    'inovasi',
                    'categories', 
                    'skpds', 
                    'bentuks', 
                    'urusans',
                    'tematiks',
                    //'options',
                    'selectedUrusans',
                    'klasifikasis',
                    'tahapans',
                    'inisiators',
                    'backgrounds'
                ));
            }
        } else{
            return redirect()->back()->with('error', 'kebaikan akan menghasilkan kebaikan');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proposal $inovasi)
    {
        $this->validate($request, [
            'profil'     => 'mimes:pdf|max:1536',
            'nama'     => 'required',
            'tahapan'   => 'required',
            'inisiator'      => 'required',
            'rancang_bangun' => 'required',
            'tujuan'    => 'required',
            'manfaat' => 'required',
            'hasil' => 'required',
            'ujicoba' => 'required',
            'implementasi' => 'required',
            'anggaran' => 'mimes:pdf|max:1024',
            'bentuk' => 'required',
            'category' => 'required',
            'urusans' => 'required',
            'tematik' => 'required'
        ]);

        $data = [
            'nama' => $request->nama,
            'tahapan_id'   => $request->tahapan,
            'inisiator_id'      => $request->inisiator,
            'rancang_bangun' => addslashes($request->rancang_bangun),
            'tujuan'    => $request->tujuan,
            'manfaat' => $request->manfaat,
            'hasil' => $request->hasil,
            'ujicoba' => $request->ujicoba,
            'implementasi' => $request->implementasi,
            'bentuk_id' => $request->bentuk,
            'category_id' => $request->category,
            'skpd_id' => $request->skpd,
            'tematik_id' => $request->tematik,
            'user_id' => auth()->user()->id,
            'status' => 'draft'
        ];

        if ($request->hasFile('profil')) {
            Storage::delete('public/profil/' . $inovasi->profil);
            $profil = $request->file('profil');
            $profil->storeAs('public/profil', $profil->hashName());
            $data['profil'] = $profil->hashName();
        }

        if ($request->hasFile('anggaran')) {
            Storage::delete('public/anggaran/' . $inovasi->anggaran);
            $anggaran = $request->file('anggaran');
            $anggaran->storeAs('public/anggaran', $anggaran->hashName());
            $data['anggaran'] = $anggaran->hashName();
        }

        $inovasi->update($data);
        $inovasi->urusans()->sync($request->urusans);
        // $indikatorIds = Indikator::where('status', 'active')->where('jenis', 'sid')->get()->pluck('id')->toArray();
        // $inovasi->indikators()->sync($indikatorIds);

        return redirect()->intended('proyek/inovasi')->with(['success' => 'Berhasil update inovasi']);
    }


    /**
     * Send proposal to admin
     * 
     */
    public function sendProposal(Proposal $inovasi, Request $request)
    {
        if (Auth::user()->role == 'admin' || ($inovasi->user_id === Auth::user()->id)) {
            //sleep(2);
            $status = $inovasi->status === 'sent' ? 'draft' : 'sent';

            $inovasi->update(['status' => $status]);

            if ($status === 'draft' && $request->filled('desc')) {
                Note::create([
                    'proposal_id' => $inovasi->id,
                    'desc' => $request->desc,
                ]);
            }

            return response()->json(['success' => 'Berhasil mengirim proposal']);
        } else {
            return response()->json(['error' => 'Gagal mengirim proposal']);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proposal $inovasi)
    {
        if (auth()->user()->id == $inovasi->user_id && $inovasi->status === 'draft') {
            $files = $inovasi->files()->get();
            foreach ($files as $file) {
                $fullFilePath = 'public/docs/' . $file->file;
                Storage::delete($fullFilePath);
            }
            $inovasi->urusans()->detach();
            $inovasi->indikators()->detach();
            $inovasi->files()->delete();
            Storage::delete('public/profil/' . $inovasi->profil);
            Storage::delete('public/anggaran/' . $inovasi->anggaran);
            $inovasi->delete();

            return response()->json(['success' => true]);
        } else{
            return response()->json(['success' => false]);
        }

    }

    /**
    * Print proposal
    */
    public function proposalReport($id)
    {
        $proposal = Proposal::findOrFail($id);
        $files = Indikator::where('status', 'active')->get();
        $pdf = PDF::loadview('inovasi.proposal-report',compact('proposal', 'files'))->setPaper('A4', 'portrait');
        set_time_limit(300);
        return $pdf->stream('proposal-inovasi'.$id.'.pdf');
    }

    /**
    * Print proposals report
    */
    public function report($startdate, $enddate)
    {
        $inovations = Proposal::whereBetween('created_at',[$startdate, $enddate])
        ->orderBy('skpd_id')
        ->get();
        //$total = Proposal::all()->count();
        $pdf = PDF::loadview('admin.inovation-report',['inovations' => $inovations])->setPaper('A4', 'portrait');
        set_time_limit(300);
        return $pdf->stream(now().'-report.pdf');
    }
}
