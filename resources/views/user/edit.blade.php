@extends('layouts.base')

@section('title', 'Edit Pengguna - ' . config('app.name'))

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
<div>Edit Pengguna
    <div class="page-title-subheading">
        Ini adalah halaman untuk mengubah pengguna pada {{ config('app.name') }}
    </div>
</div>
@endsection

@section('page-title-actions')
<a href="/user" type="button" class="btn-shadow mr-3 btn btn-dark">
    <i class="fas fa-arrow-left"></i> Kembali
</a>
@endsection

@section('content')
<form autocomplete="off" action="{{ route('user.update', $user) }}" method="post" enctype="multipart/form-data">
    @csrf @method('patch')
    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <div class="form-group text-center">
                        <label for="avatar">Foto Profil</label> <br>
                        <img title="Klik untuk ganti foto profil" data-toggle="tooltip" id="display-avatar" width="100" class="rounded-circle mb-3" src="{{ asset(Storage::url($user->avatar)) }}" alt="Foto Profil">
                        <input type="file" name="avatar" id="avatar" accept="image/*" style="display: none">
                        @error('avatar') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <div class="form-group">
                        <label for="peran_id">Peran</label> <span class="text-danger">*</span>
                        <select name="peran_id" id="peran_id" class="form-control @error('peran_id') is-invalid @enderror">
                            <option value="" disabled selected>Pilih peran</option>
                            @foreach ($peran as $item)
                                <option value="{{ $item->id }}" {{ old('peran_id', $user->peran_id ) == $item->id ? 'selected':'' }} >{{ $item->nama }}</option>
                            @endforeach
                        </select>
                        @error('peran_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label> <span class="text-danger">*</span>
                        <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan Nama ..." value="{{ old('nama', $user->nama ) }}">
                        @error('nama') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label> <span class="text-danger">*</span>
                        <input type="text" onkeypress="return hanyaHuruf(event);" name="username" id="username" class="form-control @error('username') is-invalid @enderror" placeholder="Masukkan Username ..." value="{{ old('username', $user->username ) }}">
                        @error('username') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label> <span class="text-danger">*</span>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email ..." value="{{ old('email', $user->email ) }}">
                        @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
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
