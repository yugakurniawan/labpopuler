@extends('layouts.base')

@section('title', 'Detail Pasien - ' . config('app.name'))

@section('page-title-heading')
<div class="page-title-icon">
    <i class="pe-7s-add-user icon-gradient bg-mean-fruit"></i>
</div>
<div>Detail Pasien
    <div class="page-title-subheading">
        Ini adalah halaman untuk mengubah pasien pada {{ config('app.name') }}
    </div>
</div>
@endsection

@section('page-title-actions')
@can('dokter')
    <a href="{{ route('pasien.dokter') }}" type="button" class="btn-shadow mr-3 mb-3 btn btn-dark">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
@endcan
@can('pengurus_lab')
    <a href="{{ route('pasien.index') }}" type="button" class="btn-shadow mr-3 mb-3 btn btn-dark">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
@endcan
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <div class="form-group text-center">
                        <img id="display-fhoto" width="100" class="rounded-circle mb-3" src="{{ $pasien->fhoto != null && $pasien->fhoto != $pasien->noreg . '.jpg' ? url(Storage::url($pasien->fhoto)) : '/storage/noavatar.png'}}" alt="Foto Profil">
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <tr>
                                <td width="150px" style="vertical-align: top">Nomor Registrasi</td>
                                <td width="10px" style="vertical-align: top">:</td>
                                <td>{{ $pasien->noreg }}</td>
                            </tr>
                            <tr>
                                <td width="150px" style="vertical-align: top">Nama</td>
                                <td width="10px" style="vertical-align: top">:</td>
                                <td>{{ $pasien->title->nama }} {{ $pasien->nama }}</td>
                            </tr>
                            <tr>
                                <td width="150px" style="vertical-align: top">Jenis Kelamin</td>
                                <td width="10px" style="vertical-align: top">:</td>
                                <td>{{ $pasien->jenis_kelamin == 1 ? "Laki - laki" : "Wanita"}}</td>
                            </tr>
                            <tr>
                                <td width="150px" style="vertical-align: top">Tempat, Tanggal Lahir</td>
                                <td width="10px" style="vertical-align: top">:</td>
                                <td>{{ $pasien->tmp_lahir ? $pasien->tmp_lahir . ", " : "" }} {{ date('d-m-Y',strtotime($pasien->tgl_lhr)) }}</td>
                            </tr>
                            <tr>
                                <td width="150px" style="vertical-align: top">Alamat</td>
                                <td width="10px" style="vertical-align: top">:</td>
                                <td>{{ $pasien->alamat }}{{ $pasien->kelurahan ? ', ' . $pasien->kelurahan : '' }}{{ $pasien->kota ? ', ' . App\Kota::find($pasien->kota)->kota : '' }}{{ $pasien->negara ? ', ' . App\Negara::find($pasien->negara)->nama : '' }}</td>
                            </tr>
                            <tr>
                                <td width="150px" style="vertical-align: top">Golongan Darah</td>
                                <td width="10px" style="vertical-align: top">:</td>
                                <td>{{ $pasien->darah ? $pasien->darah->nama : '-' }}</td>
                            </tr>
                            <tr>
                                <td width="150px" style="vertical-align: top">Agama</td>
                                <td width="10px" style="vertical-align: top">:</td>
                                <td>{{ $pasien->agama ? App\Agama::find($pasien->agama)->nama : "-"}}</td>
                            </tr>
                            <tr>
                                <td width="150px" style="vertical-align: top">Nama Ibu</td>
                                <td width="10px" style="vertical-align: top">:</td>
                                <td>{{ $pasien->ibu ? $pasien->ibu : '-'}}</td>
                            </tr>
                            <tr>
                                <td width="150px" style="vertical-align: top">Nomor Telepon</td>
                                <td width="10px" style="vertical-align: top">:</td>
                                <td>{{ $pasien->tlp ? $pasien->tlp : '-'}}</td>
                            </tr>
                            <tr>
                                <td width="150px" style="vertical-align: top">Nomor Handphone</td>
                                <td width="10px" style="vertical-align: top">:</td>
                                <td>{{ $pasien->hp ? $pasien->hp : '-'}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            <div class="card shadow">
                <div class="card-header">
                    <div class="h5 mb-0">Hasil LAB</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center" width="50px">#</th>
                                    <th class="text-center">Nomor Lab</th>
                                    <th class="text-center">Tanggal Transaksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pasien->pasienDokter as $item)
                                    <tr>
                                        <td>
                                            <a href="{{ route('diagnosa.show', $item->nolab) }}" class="btn btn-sm btn-info" data-toggle="tooltip" title="Detail"><i class="fas fa-eye"></i></a>
                                        </td>
                                        <td>{{ $item->nolab }}</td>
                                        <td>{{ date('d-m-Y' ,strtotime($item->tgl_tran)) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">Data Belum Tersedia</td>
                                    </tr>
                                @endforelse
                            </tbody>
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
