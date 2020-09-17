<?php

namespace App\Http\Controllers;

use App\Peran;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::latest()->paginate(15);

        if ($request->cari) {
            $users = User::where(function ($user) use ($request) {
                $user->Where('nama','like',"%$request->cari%");
                $user->orWhere('email','like',"%$request->cari%");
                $user->orWhere('username','like',"%$request->cari%");
                $user->orWherehas('peran', function ($peran) use ($request) {
                    $peran->where('nama','like',"%$request->cari%");
                });
            })->latest()->paginate(15);
        }

        $users->appends(request()->input())->links();

        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create', ['peran' => Peran::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'      => ['required','string','max:128'],
            'peran_id'  => ['required'],
            'username'  => ['required','string','max:32', 'unique:users,username'],
            'email'     => ['required','email','max:64'],
            'avatar'    => ['nullable','image','max:2048']
        ],[
            'peran_id.required' => 'peran wajib diisi'
        ]);

        if ($request->avatar) {
            $data['avatar'] = $request->avatar->store('public/avatar');
        }

        User::create($data);
        return redirect('/user')->with('success','User berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $peran = Peran::all();
        return view('user.edit', compact('user','peran'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('user.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function gantiPassword()
    {
        return view('user.ganti-password');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'nama'      => ['required','string','max:128'],
            'peran_id'  => ['required'],
            'username'  => ['required','string','max:32', Rule::unique('users','username')->ignore($user)],
            'email'     => ['required','email','max:64', Rule::unique('users','email')->ignore($user)],
            'avatar'    => ['nullable','image','max:2048']
        ],[
            'peran_id.required' => 'peran wajib diisi'
        ]);

        $user->update($data);
        return redirect()->back()->with('success','User berhasil diperbarui');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateProfil(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $data = $request->validate([
            'nama'      => ['required','string','max:128'],
            'username'  => ['required','string','max:32', Rule::unique('users','username')->ignore($user)],
            'email'     => ['required','email','max:64', Rule::unique('users','email')->ignore($user)],
            'avatar'    => ['nullable','image','max:2048']
        ]);

        $user->update($data);
        return redirect()->back()->with('success','Profil berhasil diperbarui');
    }

    public function updatePassword(Request $request)
    {
        $user = User::find(auth()->user()->id);

        $request->validate([
            'password_lama'         => ['required','string','min:8'],
            'password_baru'         => ['required','string','min:8'],
            'ulangi_password_baru'  => ['required','string','same:password_baru'],
        ]);

        if (Hash::check($request->password_lama, $user->password)) {
            $user->password = Hash::make($request->password_baru);
            $user->save();
            return redirect()->back()->with('success','Password berhasil diperbarui');
        } else {
            return redirect()->back()->with('error','Password lama yang anda masukkan salah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->avatar != 'public/noavatar.png') {
            File::delete(storage_path('app/'. $user->avatar));
        }

        $user->delete();
        return redirect()->back()->with('success','User berhasil dihapus');
    }
}
