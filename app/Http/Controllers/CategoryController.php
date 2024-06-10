<?php

namespace App\Http\Controllers;

use App\Models\Background;
use App\Models\Category;
use Illuminate\Http\Request;
use Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function index(Request $request)
    {
        if (Auth::user()->role == 'admin') {
            $backgrounds = Background::all();
            $categories = Category::all();
            if ($request->header('HX-Request')) {
                return view ('admin.category', compact('categories', 'backgrounds'))->fragment('jenis');
            }
            return view ('admin.category', compact('categories', 'backgrounds'));
        } else {
            abort(403, 'Not Permitted');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->status = 'active';
        $category->save();

        return redirect()->back()->with('success','Berhasil menambah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $jeni)
    {
        if (Auth::user()->role == 'admin') {
            $jeni->delete();
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menghapus data'
            ]);
        } else{
            return response()->json(['message' => 'Gagal menghapus data']);
        }
        
    }

    public function changeStatus($id)
    {
        $jenis = Category::find($id);

        if (!$jenis) {
            return response()->json(['success' => false, 'message' => 'jenis tidak ditemukan']);
        }
        $jenis->status = $jenis->status === 'active' ? 'inactive' : 'active';
        $jenis->save();

        return response()->json([
            'success' => true, 
            'newStatus' => $jenis->status,
            'message' => 'Berhasil merubah status'
        ]);
    }

}
