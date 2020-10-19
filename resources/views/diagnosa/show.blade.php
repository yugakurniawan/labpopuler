@extends('layouts.base')

@section('title', 'Detail Hasil Lab - ' . config('app.name'))

@section('page-title-heading')
<div class="page-title-icon">
    <i class="pe-7s-add-user icon-gradient bg-mean-fruit"></i>
</div>
<div>Detail Hasil Lab
    <div class="page-title-subheading">
        Ini adalah halaman untuk melihat detail hasil lab pada {{ config('app.name') }}
    </div>
</div>
@endsection

@section('page-title-actions')
<a href="{{ route('pasien.show', $diagnosa->pasienDokter->noreg) }}" type="button" class="btn-shadow mr-3 mb-3 btn btn-dark">
    <i class="fas fa-arrow-left"></i> Kembali
</a>
@endsection

@section('content')
<form autocomplete="off" action="{{ route('diagnosa.update', $diagnosa->nolab) }}" method="post" enctype="multipart/form-data">
    @csrf @method('patch')
    <input type="hidden" name="nolab" value="{{ $diagnosa->nolab }}">
    @if ($diagnosa->tambah)
        <input type="hidden" name="tambah" value="1">
    @endif
    <div class="card shadow">
        <div class="card-body">
            <div class="form-group">
                <label for="diagnosa">Diagnosa</label>
                <textarea rows="5" name="diagnosa" id="diagnosa" class="form-control @error('diagnosa') is-invalid @enderror" placeholder="Masukkan Diagnosa ...">{{ old('diagnosa', $diagnosa->diagnosa) }}</textarea>
                @error('diagnosa') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </div>
    </div>
</form>
@endsection
