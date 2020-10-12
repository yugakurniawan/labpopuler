@extends('layouts.base')

@section('title', 'Edit Pasien - ' . config('app.name'))

@section('page-title-heading')
<div class="page-title-icon">
    <i class="pe-7s-add-user icon-gradient bg-mean-fruit"></i>
</div>
<div>Edit Pasien
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
<a href="{{ route('diagnosa.create', $pasien) }}" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Diagnosa</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-2 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <div class="form-group text-center">
                        <label for="fhoto">Foto Profil</label> <br>
                        <img id="display-fhoto" width="100" class="rounded-circle mb-3" src="{{ $pasien->fhoto != null && $pasien->fhoto != $pasien->noreg . '.jpg' ? url(Storage::url($pasien->fhoto)) : '/storage/noavatar.png'}}" alt="Foto Profil">
                        <input disabled type="file" name="fhoto" id="fhoto" accept="image/*" style="display: none">
                        @error('fhoto') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 mb-3">
            <div class="card shadow">
                <div class="card-body">
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
                                <td>{{ $pasien->tmp_lahir ? $pasien->tmp_lahir . ", " : "" }} {{ date('d/m/Y',strtotime($pasien->tgl_lhr)) }}</td>
                            </tr>
                            <tr>
                                <td width="150px" style="vertical-align: top">Alamat</td>
                                <td width="10px" style="vertical-align: top">:</td>
                                <td>{{ $pasien->alamat }}{{ $pasien->kelurahan ? ', ' . $pasien->kelurahan : '' }}{{ $pasien->kota ? ', ' . App\Kota::find($pasien->kota)->kota : '' }}{{ $pasien->negara ? ', ' . App\Negara::find($pasien->negara)->nama : '' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
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
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header">
                    <div class="h5 mb-0">Riwayat Diagnosa Pasien</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="85px">#</th>
                                    <th>Nomor Lab</th>
                                    <th>Tanggal Diagnosa</th>
                                    <th>Saran</th>
                                    <th>Kesimpulan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pasien->pasienDokter as $item)
                                    <tr>
                                        <td>
                                            <a href="{{ route('diagnosa.edit', $item->nolab) }}" class="btn btn-sm btn-success" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>
                                            <a href="#hapus" class="btn btn-sm btn-danger hapus" data-nama="Diagnosa" data-toggle="tooltip" title="Hapus"><i class="fas fa-trash hapus-data"></i></a>
                                            <form action="{{ route("diagnosa.destroy", $item->nolab) }}" method="post">
                                                @csrf @method('delete')
                                            </form>
                                        </td>
                                        <td>{{ $item->nolab }}</td>
                                        <td>{{ date('d/m/Y' ,strtotime($item->tgl_tran)) }}</td>
                                        <td>{!! $item->pasienSaran ? nl2br($item->pasienSaran->saran) : '-' !!}</td>
                                        <td>{!! $item->pasienSaran ? nl2br($item->pasienSaran->kesimpulan) : '-' !!}</td>
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
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('hapus')) {
            event.preventDefault();
            if (confirm('Apakah anda yakin ingin menghapus pasien ' + event.target.dataset.nama + ' ini ?')) {
                event.target.nextSibling.nextElementSibling.submit();
            }
        }

        if (event.target.classList.contains('hapus-data')) {
            event.preventDefault();
            if (confirm('Apakah anda yakin ingin menghapus pasien ' + event.target.parentElement.dataset.nama + ' ini ?')) {
                event.target.parentElement.nextSibling.nextElementSibling.submit();
            }
        }
    });
</script>
@endpush
