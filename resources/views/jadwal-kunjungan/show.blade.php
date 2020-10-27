@extends('layouts.base')

@section('title', 'Detail Jadwal Kunjungan Marketing - ' . config('app.name'))

@section('styles')
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
@endsection

@section('page-title-heading')
<div class="page-title-icon">
    <i class="pe-7s-add-user icon-gradient bg-mean-fruit"></i>
</div>
<div>Detail Jadwal Kunjungan Marketing
    <div class="page-title-subheading">
        Ini adalah halaman untuk melihat jadwal kunjungan pada {{ config('app.name') }}
    </div>
</div>
@endsection


@section('page-title-actions')
<a href="{{ route('jadwal-kunjungan.index') }}" type="button" class="btn-shadow mr-3 mb-3 btn btn-dark">
    <i class="fas fa-arrow-left"></i> Kembali
</a>
@endsection


@section('content')
<form autocomplete="off" action="{{ route('jadwal-kunjungan.update', $jadwal_kunjungan) }}" method="post" enctype="multipart/form-data">
    @csrf @method('patch')
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    @can('dokter-manager_marketing')
                        <div class="form-group">
                            <label for="marketing">Marketing</label>
                            <input readonly type="text" name="marketing" id="marketing" class="form-control" value="{{ $jadwal_kunjungan->user->nama }}">
                        </div>
                    @endcan
                    <div class="form-group">
                        <label for="dokter_id">Dokter</label>
                        <select readonly class="form-control" name="dokter_id" id="dokter_id">
                            <option value="{{ $jadwal_kunjungan->dokter->kode }}">{{ $jadwal_kunjungan->dokter->nama }} - {{ $jadwal_kunjungan->dokter->kode }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jadwal">Jadwal</label>
                        <input readonly type="datetime-local" name="jadwal" id="jadwal" class="form-control @error('jadwal') is-invalid @enderror" placeholder="Masukkan Jadwal ..." value="{{ date('Y-m-d\TH:i', strtotime(old('jadwal', $jadwal_kunjungan->jadwal)))  }}">
                    </div>
                    @can('dokter')
                        <div class="form-group">
                            <label for="status">Verifikasi</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" placeholder="Masukkan Jadwal ...">
                                <option value="0">Belum Disetujui</option>
                                <option value="1" {{ $jadwal_kunjungan->status == 1 ?'selected' :'' }}>Setujui</option>
                                <option value="2" {{ $jadwal_kunjungan->status == 2 ?'selected' :'' }}>Tidak Setujui</option>
                            </select>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    @elsecan('marketing-manager_marketing')
                        <div class="form-group">
                            <label for="status">Verifikasi</label>
                            <select disabled name="status" id="status" class="form-control @error('status') is-invalid @enderror" placeholder="Masukkan Jadwal ...">
                                <option value="">Belum Disetujui</option>
                                <option value="1" {{ $jadwal_kunjungan->status == 1 ?'selected' :'' }}>Setujui</option>
                                <option value="2" {{ $jadwal_kunjungan->status == 2 ?'selected' :'' }}>Tidak Setujui</option>
                            </select>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

