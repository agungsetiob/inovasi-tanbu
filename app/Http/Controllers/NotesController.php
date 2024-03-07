<?php

namespace App\Http\Controllers;

use App\Models\Note;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $notes = Note::where('proposal_id' , $id)->select('desc', 'created_at')->distinct()->get();
        return response()->json($notes);
    }
}
