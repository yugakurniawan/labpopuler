@extends('layouts.base')

@section('title', 'Tambah Pasien - ' . config('app.name'))

@section('styles')
<style>
    #display-fhoto:hover{
        cursor: pointer;
        opacity: 0.7;
    }
</style>
@endsection

@section('page-title-heading')
<div class="page-title-icon">
    <i class="pe-7s-add-user icon-gradient bg-mean-fruit"></i>
</div>
<div>Tambah Pasien
    <div class="page-title-subheading">
        Ini adalah halaman untuk menambah pasien pada {{ config('app.name') }}
    </div>
</div>
@endsection

@section('content')
<form autocomplete="off" action="{{ route('pasien.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <div class="form-group text-center">
                        <label for="fhoto">Foto Profil</label> <br>
                        <img title="Klik untuk ganti foto profil" data-toggle="tooltip" id="display-fhoto" width="100" class="rounded-circle mb-3" src="/storage/noavatar.png" alt="Foto Profil">
                        <input type="file" name="fhoto" id="fhoto" accept="image/*" style="display: none">
                        @error('fhoto') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="nama">Nama</label> <span class="text-danger">*</span>
                            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan Nama ..." value="{{ old('nama') }}">
                            @error('nama') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="kelamin">Kelamin</label> <span class="text-danger">*</span>
                            <select name="kelamin" id="kelamin" class="form-control @error('kelamin') is-invalid @enderror">
                                <option value="" disabled selected>Pilih Kelamin</option>
                                <option value="Laki - laki" {{ old('kelamin') == "Laki - laki" ? 'selected':'' }} >Laki - laki</option>
                                <option value="Wanita" {{ old('kelamin') == 'Wanita' ? 'selected':'' }} >Wanita</option>
                            </select>
                            @error('kelamin') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tmp_lahir">Tempat Lahir</label>
                            <input type="text" name="tmp_lahir" id="tmp_lahir" class="form-control @error('tmp_lahir') is-invalid @enderror" placeholder="Masukkan Tempat Lahir ..." value="{{ old('tmp_lahir') }}">
                            @error('tmp_lahir') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tgl_lhr">Tanggal Lahir</label>
                            <input type="date" name="tgl_lhr" id="tgl_lhr" class="form-control @error('tgl_lhr') is-invalid @enderror" placeholder="Masukkan Tanggal Lahir ..." value="{{ old('tgl_lhr') }}">
                            @error('tgl_lhr') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan Alamat ..." value="{{ old('alamat') }}">
                            @error('alamat') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="kota">Kota</label> <span class="text-danger">*</span>
                            <select name="kota" id="kota" class="form-control @error('kota') is-invalid @enderror">
                                <option value="" disabled selected>Pilih Kota</option>
                                @foreach ($kota as $item)
                                    <option value="{{ $item->kode }}" {{ old('kota') == $item->kode ? 'selected':'' }} >{{ $item->kota }}</option>
                                @endforeach
                            </select>
                            @error('kota') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="agama">Agama</label> <span class="text-danger">*</span>
                            <select name="agama" id="agama" class="form-control @error('agama') is-invalid @enderror">
                                <option value="" disabled selected>Pilih Agama</option>
                                @foreach ($agama as $item)
                                    <option value="{{ $item->kode }}" {{ old('agama') == $item->kode ? 'selected':'' }} >{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('agama') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="darah">Golongan Darah</label> <span class="text-danger">*</span>
                            <select name="darah" id="darah" class="form-control @error('darah') is-invalid @enderror">
                                <option value="" disabled selected>Pilih Golongan Darah</option>
                                <option value="A" {{ old('darah') == "A" ? 'selected':'' }} >A</option>
                                <option value="B" {{ old('darah') == "B" ? 'selected':'' }} >B</option>
                                <option value="AB" {{ old('darah') == "AB" ? 'selected':'' }} >AB</option>
                                <option value="O" {{ old('darah') == "O" ? 'selected':'' }} >O</option>
                            </select>
                            @error('darah') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="ibu">Nama Ibu</label> <span class="text-danger">*</span>
                            <input type="text" name="ibu" id="ibu" class="form-control @error('ibu') is-invalid @enderror" placeholder="Masukkan Nama Ibu ..." value="{{ old('ibu') }}">
                            @error('ibu') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="tlp">Nomor Telepon</label>
                            <input type="text" onkeypress="return hanyaAngka(event);" name="tlp" id="tlp" class="form-control @error('tlp') is-invalid @enderror" placeholder="Masukkan Nomor Telepon ..." value="{{ old('tlp') }}">
                            @error('tlp') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="hp">Nomor Hp</label>
                            <input type="text" onkeypress="return hanyaAngka(event);" name="hp" id="hp" class="form-control @error('hp') is-invalid @enderror" placeholder="Masukkan Nomor Hp ..." value="{{ old('hp') }}">
                            @error('hp') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="pendidikan">Pendidikan</label> <span class="text-danger">*</span>
                            <select name="pendidikan" id="pendidikan" class="form-control @error('pendidikan') is-invalid @enderror">
                                <option value="" disabled selected>Pilih Pendidikan</option>
                                @foreach ($pendidikan as $item)
                                    <option value="{{ $item->kode }}" {{ old('pendidikan') == $item->kode ? 'selected':'' }} >{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('pendidikan') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="perusahaan">Perusahaan</label> <span class="text-danger">*</span>
                            <input type="text" name="perusahaan" id="perusahaan" class="form-control @error('perusahaan') is-invalid @enderror" placeholder="Masukkan Perusahaan ..." value="{{ old('perusahaan') }}">
                            @error('perusahaan') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="pekerjaan">Pekerjaan</label> <span class="text-danger">*</span>
                            <select name="pekerjaan" id="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror">
                                <option value="" disabled selected>Pilih Pekerjaan</option>
                                @foreach ($pekerjaan as $item)
                                    <option value="{{ $item->kode }}" {{ old('pekerjaan') == $item->kode ? 'selected':'' }} >{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('pekerjaan') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="pin">Pin</label> <span class="text-danger">*</span>
                            <input type="text" name="pin" id="pin" class="form-control @error('pin') is-invalid @enderror" placeholder="Masukkan Pin ..." value="{{ old('pin') }}">
                            @error('pin') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="bagian">Bagian</label> <span class="text-danger">*</span>
                            <input type="text" name="bagian" id="bagian" class="form-control @error('bagian') is-invalid @enderror" placeholder="Masukkan Bagian ..." value="{{ old('bagian') }}">
                            @error('bagian') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="no_jamsostek">Nomor Jamsostek</label>
                            <input type="text" onkeypress="return hanyaAngka(event);" name="no_jamsostek" id="no_jamsostek" class="form-control @error('no_jamsostek') is-invalid @enderror" placeholder="Masukkan Nomor Jamsostek ..." value="{{ old('no_jamsostek') }}">
                            @error('no_jamsostek') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
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
    const fhoto = document.querySelector("#fhoto");
    const displayAvatar = document.querySelector("#display-fhoto");

    displayAvatar.addEventListener('click', function () {
        fhoto.click();
    });

    fhoto.addEventListener('change', function (event){
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
