@extends('layouts.base')

@section('title', 'Detail Kuisioner - ' . config('app.name'))

@section('page-title-heading')
<div class="page-title-icon">
    <i class="pe-7s-settings icon-gradient bg-mean-fruit"></i>
</div>
<div>Detail Kuisioner
    <div class="page-title-subheading">
        Ini adalah halaman detail kuisioner pada {{ config('app.name') }}
    </div>
</div>
@endsection

@section('page-title-actions')
<a href="{{ route('kuisioner.index') }}" type="button" class="btn-shadow mr-3 mb-3 btn btn-dark">
    <i class="fas fa-arrow-left"></i> Kembali
</a>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-10">
        <div class="card shadow mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="text-center">
                            <img id="display-fhoto" width="100" class="rounded-circle mb-3" src="{{ url(Storage::url($user->avatar)) }}" alt="Foto Profil">
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-sm">
                                <tr>
                                    <td width="150px" style="vertical-align: top">Nama</td>
                                    <td width="10px" style="vertical-align: top">:</td>
                                    <td>{{ $user->nama }}</td>
                                </tr>
                                <tr>
                                    <td width="150px" style="vertical-align: top">Nomor Telepon</td>
                                    <td width="10px" style="vertical-align: top">:</td>
                                    <td>{{ $user->dokter->telp ?? '-'}}</td>
                                </tr>
                                <tr>
                                    <td width="150px" style="vertical-align: top">Nomor Handphone</td>
                                    <td width="10px" style="vertical-align: top">:</td>
                                    <td>{{ $user->dokter->hp ? $user->dokter->hp : '-'}}</td>
                                </tr>
                                <tr>
                                    <td width="150px" style="vertical-align: top">Alamat</td>
                                    <td width="10px" style="vertical-align: top">:</td>
                                    <td>{{ $user->dokter->alamat }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-header font-weight-bold d-flex justify-content-between">
                <span>Jawaban Kuisioner</span>
                <span>{{ date('F Y' ,strtotime($bulan)) }}</span>
            </div>
            @foreach ($user->hasil_kuisioner as $key => $item)
                @if (date('Y-m' ,strtotime($item->tanggal_mengisi_kuisioner)) == $bulan)
                    <div class="card shadow mb-2">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="{{ strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $key }}">{{ $item->pertanyaan }}</label>
                                <input type="hidden" name="jenis_pertanyaan_id[]" value="{{ $item->jenis_pertanyaan_id }}">
                                <input type="hidden" name="pertanyaan[]" value="{{ $item->pertanyaan }}">
                                @switch($item->jenis_pertanyaan->jenis)
                                    @case('Paragraf')
                                        <textarea disabled class="form-control" name="{{ strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $key }}" id="{{ strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $key }}">{{ $item->jawaban }}</textarea>
                                        @break
                                    @case('Tanggal')
                                        <input disabled type="text" class="form-control" name="{{ strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $key }}" id="{{ strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $key }}" value="{{ date('d F Y',strtotime($item->jawaban)) }}">
                                        @break
                                    @case('Waktu')
                                        <input disabled type="time" class="form-control" name="{{ strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $key }}" id="{{ strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $key }}" value="{{ $item->jawaban }}">
                                        @break
                                    @default
                                        <input disabled type="text" class="form-control" name="{{ strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $key }}" id="{{ strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $key }}" value="{{ $item->jawaban }}">
                                        @break
                                @endswitch
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
</script>
@endpush
