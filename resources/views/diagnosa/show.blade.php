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
<div class="card shadow mb-3">
    <div class="card-body">
        <div class="text-center">
            <p>
                <b style="text-decoration: underline;">HASIL PEMERIKSAAN</b>
            </p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <tr>
                            <td width="150px" style="vertical-align: top">Nama</td>
                            <td width="10px" style="vertical-align: top">:</td>
                            <td>{{ $diagnosa->pasienDokter->pasien->title->nama }} {{ $diagnosa->pasienDokter->pasien->nama }}</td>
                        </tr>
                        <tr>
                            <td width="150px" style="vertical-align: top">Alamat</td>
                            <td width="10px" style="vertical-align: top">:</td>
                            <td>{{ $diagnosa->pasienDokter->pasien->alamat }}{{ $diagnosa->pasienDokter->pasien->kelurahan ? ', ' . $diagnosa->pasienDokter->pasien->kelurahan : '' }}{{ $diagnosa->pasienDokter->pasien->kota ? ', ' . App\Kota::find($diagnosa->pasienDokter->pasien->kota)->kota : '' }}{{ $diagnosa->pasienDokter->pasien->negara ? ', ' . App\Negara::find($diagnosa->pasienDokter->pasien->negara)->nama : '' }}</td>
                        </tr>
                        <tr>
                            <td width="150px" style="vertical-align: top">Jenis Kelamin</td>
                            <td width="10px" style="vertical-align: top">:</td>
                            <td>{{ $diagnosa->pasienDokter->pasien->jenis_kelamin == 1 ? "Laki - laki" : "Wanita"}}</td>
                        </tr>
                        <tr>
                            <td width="150px" style="vertical-align: top">Tanggal Lahir</td>
                            <td width="10px" style="vertical-align: top">:</td>
                            <td>{{ date('d-m-Y',strtotime($diagnosa->pasienDokter->pasien->tgl_lhr)) }} ({{ date('Y') - date('Y',strtotime($diagnosa->pasienDokter->pasien->tgl_lhr)) }} tahun)</td>
                        </tr>
                        <tr>
                            <td width="150px" style="vertical-align: top">Telepon / HP</td>
                            <td width="10px" style="vertical-align: top">:</td>
                            <td>{{ $diagnosa->pasienDokter->pasien->tlp ? $diagnosa->pasienDokter->pasien->tlp : '-'}} / {{ $diagnosa->pasienDokter->pasien->hp ? $diagnosa->pasienDokter->pasien->hp : '-'}}</td>
                        </tr>
                        <tr>
                            <td width="150px" style="vertical-align: top">Nomor Registrasi</td>
                            <td width="10px" style="vertical-align: top">:</td>
                            <td>{{ $diagnosa->pasienDokter->noreg }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <tr>
                            <td width="150px" style="vertical-align: top">No. Id</td>
                            <td width="10px" style="vertical-align: top">:</td>
                            <td>{{ $diagnosa->pasienDokter->noreg }}</td>
                        </tr>
                        <tr>
                            <td width="150px" style="vertical-align: top">No. Lab</td>
                            <td width="10px" style="vertical-align: top">:</td>
                            <td>{{ $diagnosa->pasienDokter->nolab }}</td>
                        </tr>
                        <tr>
                            <td width="150px" style="vertical-align: top">Dokter</td>
                            <td width="10px" style="vertical-align: top">:</td>
                            <td>{{ $diagnosa->pasienDokter->dokter->nama }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Pemeriksaaan</th>
                        <th>Hasil</th>
                        <th>Rujukan</th>
                        <th>Satuan</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pastest as $item)
                        <tr>
                            <th colspan="5" style="text-align: center">{{ $item[0]->test->nama }}</th>
                        </tr>
                        @foreach ($item as $data)
                            <tr>
                                <td>{{ $data->test1->nama }}</td>
                                <td>{{ $data->hasil_c }}</td>
                                <td>{{ $data->rujukan }}</td>
                                <td>{{ $data->test1->satuan }}</td>
                                <td>{{ $data->keterangan }}</td>
                            </tr>
                        @endforeach
                    @empty
                        <tr><th colspan="5" style="text-align: center">Data Tidak Tersedia</th></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card shadow mb-3">
    <div class="card-body">
        <form autocomplete="off" action="{{ route('diagnosa.update', $diagnosa->nolab) }}" method="post" enctype="multipart/form-data">
            @csrf @method('patch')
            <input type="hidden" name="nolab" value="{{ $diagnosa->nolab }}">
            @if ($diagnosa->tambah)
                <input type="hidden" name="tambah" value="1">
            @endif
            <div class="form-group">
                <label for="diagnosa">Diagnosa</label>
                <textarea rows="5" name="diagnosa" id="diagnosa" class="form-control @error('diagnosa') is-invalid @enderror" placeholder="Masukkan Diagnosa ...">{{ old('diagnosa', $diagnosa->diagnosa) }}</textarea>
                @error('diagnosa') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection
