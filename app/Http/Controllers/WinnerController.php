<?php

namespace App\Http\Controllers;

use App\Models\Background;
use App\Models\Proposal;
use App\Models\Winner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;

class WinnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::user()->role === 'admin') {
            $backgrounds = Background::all();
            $proposals = Proposal::whereIn('updated_at', [
                Carbon::now()->year,
                Carbon::now()->subYear()->year
            ])->get();

            if ($request->header('HX-Request')) {
                return view('admin.winners', compact('backgrounds', 'proposals'))->fragment('winner');
            }
            return view('admin.winners', compact('backgrounds', 'proposals'));
        } else {
            return view('cukrukuk');
        }
    }

    /**
     * Show the resource in json.
     */
    public function loadWinner()
    {
        if (Auth::user()->role === 'admin') {
            $winners = Winner::with('proposal')->get();
            return response()->json([
                'success' => true,
                'data' => $winners
            ])->header('HX-Trigger', 'reloadWinner');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'pengusul' => 'required|min:10',
            'proposal' => 'required|exists:proposals,id|unique:winners,proposal_id',
            'kategori' => 'required',
        ]);

        $winner = new Winner();
        $winner->pengusul = $request->pengusul;
        $winner->proposal_id = $request->proposal;
        $winner->kategori = $request->kategori;
        $winner->tahun = Carbon::now()->year;
        $winner->save();
        $proposal = $winner->proposal;
        return response()->json([
            'success' => true,
            'message' => 'Winner data stored',
            'data' => $winner,
            'proposal' => $proposal
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Winner $winner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $winner = Winner::findOrFail($id);
        $winner->delete();

        return response()->json(['success' => 'Winner deleted successfully']);
    }
}
