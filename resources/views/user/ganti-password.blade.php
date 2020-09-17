@extends('layouts.base')

@section('title', 'Ganti Password - ' . config('app.name'))

@section('page-title-heading')
<div class="page-title-icon">
    <i class="pe-7s-key icon-gradient bg-mean-fruit"></i>
</div>
<div>Ganti Password
    <div class="page-title-subheading">
        Ini adalah halaman ganti password pengguna pada {{ config('app.name') }}
    </div>
</div>
@endsection

@section('content')
<form autocomplete="off" action="{{ route('update-password') }}" method="post" enctype="multipart/form-data">
    @csrf @method('patch')
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Password Lama</label> <span class="text-danger">*</span>
                        <input type="password" name="password_lama" id="password_lama" class="form-control @error('password_lama') is-invalid @enderror" placeholder="Masukkan Password Lama ..." value="{{ old('password_lama') }}">
                        @error('password_lama') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Password Baru</label> <span class="text-danger">*</span>
                        <input type="password" name="password_baru" id="password_baru" class="form-control @error('password_baru') is-invalid @enderror" placeholder="Masukkan Password Baru ..." value="{{ old('password_baru') }}">
                        @error('password_baru') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Ulangi Password Baru</label> <span class="text-danger">*</span>
                        <input type="password" name="ulangi_password_baru" id="ulangi_password_baru" class="form-control @error('ulangi_password_baru') is-invalid @enderror" placeholder="Ulangi Password Baru ..." value="{{ old('ulangi_password_baru') }}">
                        @error('ulangi_password_baru') <span class="invalid-feedback">{{ $message }}</span> @enderror
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
