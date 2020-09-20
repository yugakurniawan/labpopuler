<?php

namespace App\Http\Controllers;

use App\Dokter;
use App\Peran;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use mysqli;

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
            'nama'      => ['required','string','max:50'],
            'peran_id'  => ['required'],
            'username'  => ['required','string','max:32', 'unique:users,username'],
            'email'     => ['required','email','max:64'],
            'avatar'    => ['nullable','image','max:2048']
        ],[
            'peran_id.required' => 'peran wajib diisi'
        ]);

        if ($request->peran_id == 2) {
            $dataDokter = $request->validate([
                'nama'      => ['required','string','max:50'],
                'spesial'   => ['nullable','string','max:50'],
                'alamat'    => ['nullable','string', 'max:60'],
                'alamat_p'  => ['nullable','string', 'max:60'],
                'kota'      => ['nullable','string', 'max:50'],
                'telp'      => ['nullable','digits_between:5,15'],
                'hp'        => ['nullable','digits_between:5,15'],
                'Tgl_lahir' => ['nullable','date','before:now'],
            ],[
                'alamat_p.max'          => 'alamat praktek mungkin tidak lebih besar dari 60 karakter.',
                'telp.digits_between'   => 'nomor telepon harus antara 5 dan 15 digit.',
                'hp.digits_between'     => 'nomor hp harus antara 5 dan 15 digit.',
                'Tgl_lahir.date'        => 'Tanggal Lahir bukan tanggal yang valid.',
                'Tgl_lahir.before'      => 'Tanggal Lahir harus berupa tanggal sebelumnya sekarang.',
            ]);
        }

        if ($request->avatar) {
            $data['avatar'] = $request->avatar->store('public/avatar');
        }

        $user = User::create($data);

        if ($request->peran_id == 2) {
            $dataDokter['user_id'] = $user->id;
            $dataDokter['kode'] = Dokter::orderBy('kode','desc')->first()->kode + 1;
            Dokter::create($dataDokter);
        }

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
            'nama'      => ['required','string','max:50'],
            'peran_id'  => ['required'],
            'username'  => ['required','string','max:32', Rule::unique('users','username')->ignore($user)],
            'email'     => ['required','email','max:64', Rule::unique('users','email')->ignore($user)],
            'avatar'    => ['nullable','image','max:2048']
        ],[
            'peran_id.required' => 'peran wajib diisi'
        ]);

        $user->update($data);

        if ($request->peran_id == 2) {
            $dataDokter = $request->validate([
                'nama'      => ['required','string','max:50'],
                'spesial'   => ['nullable','string','max:50'],
                'alamat'    => ['nullable','string', 'max:60'],
                'alamat_p'  => ['nullable','string', 'max:60'],
                'kota'      => ['nullable','string', 'max:50'],
                'telp'      => ['nullable','digits_between:5,15'],
                'hp'        => ['nullable','digits_between:5,15'],
                'Tgl_lahir' => ['nullable','date','before:now'],
            ],[
                'alamat_p.max'          => 'alamat praktek mungkin tidak lebih besar dari 60 karakter.',
                'telp.digits_between'   => 'nomor telepon harus antara 5 dan 15 digit.',
                'hp.digits_between'     => 'nomor hp harus antara 5 dan 15 digit.',
                'Tgl_lahir.date'        => 'Tanggal Lahir bukan tanggal yang valid.',
                'Tgl_lahir.before'      => 'Tanggal Lahir harus berupa tanggal sebelumnya sekarang.',
            ]);

            if ($user->dokter) {
                $this->setUpdateDokter($request, $user->dokter->kode);
            } else {
                $dataDokter['user_id'] = $user->id;
                $dataDokter['kode'] = Dokter::orderBy('kode','desc')->first()->kode + 1;
                Dokter::create($dataDokter);
            }
        } else {
            if ($user->dokter) {
                Dokter::find($user->dokter->kode)->delete();
            }
        }

        return redirect()->back()->with('success','User berhasil diperbarui');
    }

    private function setUpdateDokter($request, $kode)
    {
        $conn = new mysqli(env('DB_HOST'),env('DB_USERNAME'),env('DB_PASSWORD'),env('DB_DATABASE'));
        $sql = "UPDATE `tb_dokter` SET
            `nama`      = '$request->nama',
            `spesial`   = '$request->spesial',
            `alamat`    = '$request->alamat',
            `alamat_p`  = '$request->alamat_p',
            `kota`      = '$request->kota',
            `telp`      = '$request->telp',
            `hp`        = '$request->hp',
            `Tgl_lahir` = '$request->Tgl_lahir'
            WHERE `kode`= '$kode'
        ";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
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
            'nama'      => ['required','string','max:50'],
            'username'  => ['required','string','max:32', Rule::unique('users','username')->ignore($user)],
            'email'     => ['required','email','max:64', Rule::unique('users','email')->ignore($user)],
            'avatar'    => ['nullable','image','max:2048']
        ]);

        $user->update($data);

        if ($user->dokter) {
            $request->validate([
                'nama'      => ['required','string','max:50'],
                'spesial'   => ['nullable','string','max:50'],
                'alamat'    => ['nullable','string', 'max:60'],
                'alamat_p'  => ['nullable','string', 'max:60'],
                'kota'      => ['nullable','string', 'max:50'],
                'telp'      => ['nullable','digits_between:5,15'],
                'hp'        => ['nullable','digits_between:5,15'],
                'Tgl_lahir' => ['nullable','date','before:now'],
            ],[
                'alamat_p.max'          => 'alamat praktek mungkin tidak lebih besar dari 60 karakter.',
                'telp.digits_between'   => 'nomor telepon harus antara 5 dan 15 digit.',
                'hp.digits_between'     => 'nomor hp harus antara 5 dan 15 digit.',
                'Tgl_lahir.date'        => 'Tanggal Lahir bukan tanggal yang valid.',
                'Tgl_lahir.before'      => 'Tanggal Lahir harus berupa tanggal sebelumnya sekarang.',
            ]);
            $this->setUpdateDokter($request, $user->dokter->kode);
        }

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
