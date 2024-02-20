<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $notes = Note::where('proposal_id' , $id)->select('desc')->distinct()->get();
        return response()->json($notes);
    }
}
