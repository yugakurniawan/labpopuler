@extends('layouts.base')

@section('title', 'Edit Jadwal Kunjungan - ' . config('app.name'))

@section('styles')
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
@endsection

@section('page-title-heading')
<div class="page-title-icon">
    <i class="pe-7s-add-user icon-gradient bg-mean-fruit"></i>
</div>
<div>Edit Jadwal Kunjungan
    <div class="page-title-subheading">
        Ini adalah halaman untuk mengubah jadwal kunjungan pada {{ config('app.name') }}
    </div>
</div>
@endsection

@section('content')
<form autocomplete="off" action="{{ route('jadwal-kunjungan.update', $jadwal_kunjungan) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <div class="form-group">
                        <label for="dokter_id">Dokter</label>
                        <select name="dokter_id" id="dokter_id" class="form-control @error('dokter_id') is-invalid @enderror">
                            <option value="">Pilih Dokter</option>
                            @foreach ($dokter as $item)
                                <option value="{{ $item->kode }}" {{ old('dokter_id', $jadwal_kunjungan->dokter_id) == $item->kode ? 'selected' : '' }}>{{ $item->nama }} - {{ $item->kode }}</option>
                            @endforeach
                        </select>
                        @error('dokter_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="jadwal">Jadwal</label>
                        <input type="datetime-local" name="jadwal" id="jadwal" class="form-control @error('jadwal') is-invalid @enderror" placeholder="Masukkan Jadwal ..." value="{{ date('Y-m-d\TH:i', strtotime(old('jadwal', $jadwal_kunjungan->jadwal)))  }}">
                        @error('jadwal') <span class="invalid-feedback">{{ $message }}</span> @enderror
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
<script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#dokter_id').select2({
            placeholder: "Pilih Dokter",
            allowClear: true
        });
    });
</script>
@endpush
