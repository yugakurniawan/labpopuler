@extends('layouts.base')

@section('title', 'Profil Pengguna - ' . config('app.name'))

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
    <i class="pe-7s-user icon-gradient bg-mean-fruit"></i>
</div>
<div>Profil Pengguna
    <div class="page-title-subheading">
        Ini adalah halaman profil pengguna pada {{ config('app.name') }}
    </div>
</div>
@endsection

@section('content')
<form autocomplete="off" action="{{ route('update-profil') }}" method="post" enctype="multipart/form-data">
    @csrf @method('patch')
    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <div class="form-group text-center">
                        <label for="avatar">Foto Profil</label> <br>
                        <img title="Klik untuk ganti foto profil" data-toggle="tooltip" id="display-avatar" width="100" class="rounded-circle mb-3" src="{{ asset(Storage::url(auth()->user()->avatar)) }}" alt="Foto Profil">
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
                        <div class="form-group col-md-4">
                            <label for="nama">Nama</label> <span class="text-danger">*</span>
                            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan Nama ..." value="{{ old('nama', auth()->user()->nama ) }}">
                            @error('nama') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="username">Username</label> <span class="text-danger">*</span>
                            <input type="text" onkeypress="return hanyaHuruf(event);" name="username" id="username" class="form-control @error('username') is-invalid @enderror" placeholder="Masukkan Username ..." value="{{ old('username', auth()->user()->username ) }}">
                            @error('username') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="email">Email</label> <span class="text-danger">*</span>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email ..." value="{{ old('email', auth()->user()->email ) }}">
                            @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        @can('dokter')
                            <div class="form-group col-md-6">
                                <label for="spesial">Spesial</label>
                                <input type="text" name="spesial" id="spesial" class="form-control @error('spesial') is-invalid @enderror" placeholder="Masukkan Spesial ..." value="{{ old('spesial', auth()->user()->dokter ? auth()->user()->dokter->spesial : '') }}">
                                @error('spesial') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Tgl_lahir">Tanggal Lahir</label>
                                <input type="date" name="Tgl_lahir" id="Tgl_lahir" class="form-control @error('Tgl_lahir') is-invalid @enderror" placeholder="Masukkan Tanggal Lahir ..." value="{{ old('Tgl_lahir', auth()->user()->dokter ? auth()->user()->dokter->Tgl_lahir : '') }}">
                                @error('Tgl_lahir') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan Alamat ...">{{ old('alamat', auth()->user()->dokter ? auth()->user()->dokter->alamat : '') }}</textarea>
                                @error('alamat') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="alamat_p">Alamat Praktek</label>
                                <textarea name="alamat_p" id="alamat_p" class="form-control @error('alamat_p') is-invalid @enderror" placeholder="Masukkan Alamat Praktek ...">{{ old('alamat_p', auth()->user()->dokter ? auth()->user()->dokter->alamat_p : '') }}</textarea>
                                @error('alamat_p') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="kota">Kota</label>
                                <input type="text" name="kota" id="kota" class="form-control @error('kota') is-invalid @enderror" placeholder="Masukkan Kota ..." value="{{ old('kota', auth()->user()->dokter ? auth()->user()->dokter->kota : '') }}">
                                @error('kota') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="telp">Nomor Telepon</label>
                                <input type="text" onkeypress="return hanyaAngka(event);" name="telp" id="telp" class="form-control @error('telp') is-invalid @enderror" placeholder="Masukkan Nomor Telepon ..." value="{{ old('telp', auth()->user()->dokter ? auth()->user()->dokter->telp : '') }}">
                                @error('telp') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="hp">Nomor Hp</label>
                                <input type="text" onkeypress="return hanyaAngka(event);" name="hp" id="hp" class="form-control @error('hp') is-invalid @enderror" placeholder="Masukkan Nomor Hp ..." value="{{ old('hp', auth()->user()->dokter ? auth()->user()->dokter->hp : '') }}">
                                @error('hp') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        @endcan
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
</script>
@endpush
