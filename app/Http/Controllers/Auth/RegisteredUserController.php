<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Background;
use App\Models\User;
use App\Models\Skpd;
use App\Models\Setting;
use App\Models\Profile;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $users = User::all();
            $backgrounds = Background::all();
            return view('admin.users', compact('users', 'backgrounds'));
        } else{
            return back()->with('error', 'Get out!');
        }
        
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $skpds = Skpd::all();
        $setting = Setting::latest()->value('logo_cover');
        return view ('auth.register', compact('skpds', 'setting'));       
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => 'active',
            'skpd_id' => $request->skpd_id,
            'avatar' => 'ava.png',
        ]);

        event(new Registered($user));

        //Auth::login($user);

        return redirect('users')->with('success', 'User registered successfully');
    }

    //registration form for user
    public function createUser()
    {
        $skpds = Skpd::all();
        $setting = Setting::latest()->value('logo_cover');
        $telp = Profile::latest()->value('telp');
        return view ('auth.user-register', compact('skpds', 'setting', 'telp'));
    }

    //handle user registration proses
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'status' => 'inactive',
            'skpd_id'=> $request->skpd_id,
            'avatar' => 'ava.png',
        ]);

        event(new Registered($user));
        //Auth::login($user);

        return redirect('user-register')->with('success', 'Registrasi selesai, hubungi admin untuk aktivasi akun');
    }

    public function activateUser($id, Request $request)
    {
        if (Auth::user()->role == 'admin') {
            $user = User::findOrFail($id);
            $user->update([
                'status'     => 'active'
            ]);
            return redirect()->back()->with('success', 'User is activated successfully');
        }
    }

    public function deactivateUser($id, Request $request)
    {
        if (Auth::user()->role == 'admin') {
            $user = User::findOrFail($id);
            $user->update([
                'status'     => 'inactive'
            ]);
            return redirect()->back()->with('success', 'User is deactivated successfully');
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        if (Auth::user()->id == $user->id ) {
            $setting = Setting::latest()->value('logo_cover');
            return view('auth.edit-profile', compact('user', 'setting'));
        }

    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'avatar'     => ['mimes:jpeg,png,jpg,gif,svg|max:2048'],
        ]);

        $user = User::findOrFail($id);
        if ($request->hasFile('avatar')) {

            Storage::delete('public/ava/'.$user->avatar);
            $image = $request->file('avatar');
            $image->storeAs('public/ava', $image->hashName());
            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'avatar' => $image->hashName(),
            ]);

        } else {
            $user->update([
                'name' => $request->name,
                'username' => $request->username,
            ]);
        }

        if (Auth::user()->role == 'admin') {
            return redirect()->intended(RouteServiceProvider::ADMIN)
            ->with('success', 'Profile update successfull');
        }else{
            return redirect()->intended(RouteServiceProvider::HOME)
            ->with('success', 'Profile update successfull');
        }
        
    }


}
