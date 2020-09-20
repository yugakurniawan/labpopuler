@extends('layouts.base')

@section('title', 'Tambah Pengguna - ' . config('app.name'))

@section('styles')
<style>
    #display-avatar:hover{
        cursor: pointer;
        opacity: 0.7;
    }
</style>
@endsection

@section('page-title-heading')
<div class="page-title-icon">
    <i class="pe-7s-add-user icon-gradient bg-mean-fruit"></i>
</div>
<div>Tambah Pengguna
    <div class="page-title-subheading">
        Ini adalah halaman untuk menambah pengguna pada {{ config('app.name') }}
    </div>
</div>
@endsection

@section('content')
<form autocomplete="off" action="/user" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <div class="form-group text-center">
                        <label for="avatar">Foto Profil</label> <br>
                        <img title="Klik untuk ganti foto profil" data-toggle="tooltip" id="display-avatar" width="100" class="rounded-circle mb-3" src="/storage/noavatar.png" alt="Foto Profil">
                        <input type="file" name="avatar" id="avatar" accept="image/*" style="display: none">
                        @error('avatar') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6 user">
                            <label for="peran_id">Peran</label> <span class="text-danger">*</span>
                            <select name="peran_id" id="peran_id" class="form-control @error('peran_id') is-invalid @enderror">
                                <option value="" disabled selected>Pilih peran</option>
                                @foreach ($peran as $item)
                                    <option value="{{ $item->id }}" {{ old('peran_id') == $item->id ? 'selected':'' }} >{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('peran_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-6 user">
                            <label for="nama">Nama</label> <span class="text-danger">*</span>
                            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan Nama ..." value="{{ old('nama') }}">
                            @error('nama') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4 dokter" style="display: none">
                            <label for="spesial">Spesial</label>
                            <input type="text" name="spesial" id="spesial" class="form-control @error('spesial') is-invalid @enderror" placeholder="Masukkan Spesial ..." value="{{ old('spesial') }}">
                            @error('spesial') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4 dokter" style="display: none">
                            <label for="Tgl_lahir">Tanggal Lahir</label>
                            <input type="date" name="Tgl_lahir" id="Tgl_lahir" class="form-control @error('Tgl_lahir') is-invalid @enderror" placeholder="Masukkan Tanggal Lahir ..." value="{{ old('Tgl_lahir') }}">
                            @error('Tgl_lahir') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-6 user">
                            <label for="username">Username</label> <span class="text-danger">*</span>
                            <input type="text" onkeypress="return hanyaHuruf(event);" name="username" id="username" class="form-control @error('username') is-invalid @enderror" placeholder="Masukkan Username ..." value="{{ old('username') }}">
                            @error('username') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-6 user">
                            <label for="email">Email</label> <span class="text-danger">*</span>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email ..." value="{{ old('email') }}">
                            @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-6 dokter" style="display: none">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan Alamat ...">{{ old('alamat') }}</textarea>
                            @error('alamat') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-6 dokter" style="display: none">
                            <label for="alamat_p">Alamat Praktek</label>
                            <textarea name="alamat_p" id="alamat_p" class="form-control @error('alamat_p') is-invalid @enderror" placeholder="Masukkan Alamat Praktek ...">{{ old('alamat_p') }}</textarea>
                            @error('alamat_p') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4 dokter" style="display: none">
                            <label for="kota">Kota</label>
                            <input type="text" name="kota" id="kota" class="form-control @error('kota') is-invalid @enderror" placeholder="Masukkan Kota ..." value="{{ old('kota') }}">
                            @error('kota') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4 dokter" style="display: none">
                            <label for="telp">Nomor Telepon</label>
                            <input type="text" onkeypress="return hanyaAngka(event);" name="telp" id="telp" class="form-control @error('telp') is-invalid @enderror" placeholder="Masukkan Nomor Telepon ..." value="{{ old('telp') }}">
                            @error('telp') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4 dokter" style="display: none">
                            <label for="hp">Nomor Hp</label>
                            <input type="text" onkeypress="return hanyaAngka(event);" name="hp" id="hp" class="form-control @error('hp') is-invalid @enderror" placeholder="Masukkan Nomor Hp ..." value="{{ old('hp') }}">
                            @error('hp') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
    const avatar = document.querySelector("#avatar");
    const displayAvatar = document.querySelector("#display-avatar");
    const peran = document.querySelector("#peran_id");
    const dokter = document.querySelectorAll('.dokter');
    const user = document.querySelectorAll('.user');

    displayAvatar.addEventListener('click', function () {
        avatar.click();
    });

    avatar.addEventListener('change', function (event){
        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                displayAvatar.src = e.target.result
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    if (peran.value == 2) {
        for (let i = 0; i < dokter.length; i++) {
            dokter[i].style.display = "";
        }

        for (let i = 0; i < user.length; i++) {
            user[i].classList.remove('col-md-6');
            user[i].classList.add('col-md-4');
        }
    } else {
        for (let i = 0; i < dokter.length; i++) {
            dokter[i].style.display = "none";
        }

        for (let i = 0; i < user.length; i++) {
            user[i].classList.remove('col-md-4');
            user[i].classList.add('col-md-6');
        }
    }

    peran.addEventListener('change', function (event) {
        if (event.target.value == 2) {
            for (let i = 0; i < dokter.length; i++) {
                dokter[i].style.display = "";
            }

            for (let i = 0; i < user.length; i++) {
                user[i].classList.remove('col-md-6');
                user[i].classList.add('col-md-4');
            }
        } else {
            for (let i = 0; i < dokter.length; i++) {
                dokter[i].style.display = "none";
            }

            for (let i = 0; i < user.length; i++) {
                user[i].classList.remove('col-md-4');
                user[i].classList.add('col-md-6');
            }
        }
    });
</script>
@endpush
