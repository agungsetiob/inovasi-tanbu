<?php

namespace App\Http\Controllers;

use App\Models\Background;
use App\Models\Profile;
use App\Models\File;
use App\Models\Proposal;
use App\Models\Bukti;
use App\Models\Indikator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $backgrounds = Background::all();
            $profiles = Profile::all();
            $dataExist = $profiles->count() > 0;
            return view('profile.index', compact(
                'profiles',
                'dataExist',
                'backgrounds'
            ));
        } else {
            return view('cukrukuk');
        }
    }

    public function show(Profile $profile)
    {
        if (Auth::user()->role == 'admin') {
            $backgrounds = Background::all();
            $profileId = $profile;
            $buktis = Bukti::where('status', 'active')->get();
            $indikators = Indikator::where('status', 'active')->get();
            $files = Indikator::all();
            return view('profile.detail-profil', compact(
                'files', 
                'profile', 
                'buktis', 
                'indikators', 
                'profileId',
                'backgrounds'
            ));
        } else {
            return redirect()->back()->with(['error' => 'ojo dibandingke!']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'nama'   => 'required',
            'alamat'     => 'required',
            'skpd'  => 'required',
            'email' => 'required|email',
            'telp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
            'admin' => 'required'
        ]);

        //create
        $profile = Profile::create($request->all());
        $indikatorIds = Indikator::where('status', 'active')->where('jenis', 'spd')->get()->pluck('id')->toArray();
        $profile->indikators()->sync($indikatorIds);

        //redirect to index
        return redirect()->back()->with(['success' => 'Profil berhasil disimpan']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        if (Auth::user()->role === 'admin') {
            return response()->json([
                'success' => true,
                'data' => $profile,
            ]);
        } else{
            return response()->json(['message' => 'Tolong jangan puh sepuh']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        $this->validate($request, [
            'nama'   => 'required',
            'alamat' => 'required',
            'skpd'   => 'required',
            'email'  => 'required|email',
            'admin' => 'required',
            'telp'   => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
        ]);
        if (Auth::user()->role == 'admin') {
            $profile->update($request->all());
            $indikatorIds = Indikator::where('status', 'active')->where('jenis', 'spd')->get()->pluck('id')->toArray();
            $profile->indikators()->sync($indikatorIds);
            return response()->json(['success' => true, 'message' => 'Berhasil update profil']);
        } else {
            return response()->json(['success' => false, 'message' => 'Something went wrong']);
        }
        
    }

}
