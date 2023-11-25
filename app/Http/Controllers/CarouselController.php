<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Background;
use App\Models\User;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin'){
            $backgrounds = Background::all();
            $carousels = Carousel::all();
            return view ('setting.carousel', compact('carousels', 'backgrounds'));
        } else{
            return ('cukrukuk');
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|mimes:jpg,png|max:3072',
        ]);
        $image = $request->file('image');
        $image->storeAs('public/carousels', $image->hashName());
            
        Carousel::create([
            'image'    => $image->hashName()
        ]);
        return redirect()->back()->with('success', 'Berhasil upload gambar');
    }

    public function destroy(Carousel $carousel)
    {
        Storage::delete('public/carousels/'. $carousel->image);
        $carousel->delete();
        return response()->json([
            'success' => true,
            'message' => 'Berhasil menghapus gambar',
        ]);
    }
}
