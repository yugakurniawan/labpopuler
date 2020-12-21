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
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-body">
                <div class="form-group text-center">
                    <img id="display-fhoto" width="100" class="rounded-circle mb-3" src="{{ url(Storage::url($user->avatar)) }}" alt="Foto Profil">
                </div>
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
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header font-weight-bold d-flex justify-content-between">
                <span>Jawaban Kuisioner</span>
                <span>{{ date('F Y' ,strtotime($bulan)) }}</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-sm">
                        @foreach ($kuisioner as $item)
                            <tr>
                                <td width="150px" style="vertical-align: top">{{ $item->pertanyaan }}</td>
                                <td width="10px" style="vertical-align: top">:</td>
                                <td>-</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
</script>
@endpush
