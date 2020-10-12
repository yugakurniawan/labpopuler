@extends('layouts.base')

@section('title', 'Edit Diagnosa - ' . config('app.name'))

@section('page-title-heading')
<div class="page-title-icon">
    <i class="pe-7s-add-user icon-gradient bg-mean-fruit"></i>
</div>
<div>Edit Diagnosa
    <div class="page-title-subheading">
        Ini adalah halaman untuk mengubah diagnosa pada {{ config('app.name') }}
    </div>
</div>
@endsection

@section('page-title-actions')
<a href="{{ route('pasien.show', $pasien->noreg) }}" type="button" class="btn-shadow mr-3 mb-3 btn btn-dark">
    <i class="fas fa-arrow-left"></i> Kembali
</a>
@endsection

@section('content')
<form autocomplete="off" action="{{ route('diagnosa.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="noreg" value="{{ $pasien->noreg }}">
    <div class="card shadow">
        <div class="card-body">
            <div class="form-group">
                <label for="nolab">Nomor Lab</label>
                <input type="number" onkeypress="return hanyaAngka(event);" name="nolab" id="nolab" class="form-control @error('nolab') is-invalid @enderror" placeholder="Masukkan Nomor Lab ...">{{ old('nolab') }}</textarea>
                @error('nolab') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="saran">Saran</label>
                <textarea rows="5" name="saran" id="saran" class="form-control @error('saran') is-invalid @enderror" placeholder="Masukkan Saran ...">{{ old('saran') }}</textarea>
                @error('saran') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="kesimpulan">Kesimpulan</label>
                <textarea rows="5" name="kesimpulan" id="kesimpulan" class="form-control @error('kesimpulan') is-invalid @enderror" placeholder="Masukkan Kesimpulan ...">{{ old('kesimpulan') }}</textarea>
                @error('kesimpulan') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </div>
    </div>
</form>
@endsection
