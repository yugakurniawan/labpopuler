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
                        <div class="form-group col-md-4">
                            <label for="noreg">Nomor Registrasi</label>
                            <input type="text" name="noreg" id="noreg" class="form-control @error('noreg') is-invalid @enderror" placeholder="Masukkan Nomor Registrasi ..." value="{{ old('noreg') }}">
                            @error('noreg') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-2">
                            <label for="title_id">Title</label>
                            <select name="title_id" id="title_id" class="form-control @error('title_id') is-invalid @enderror">
                                <option value="" disabled selected>Pilih Title</option>
                                @foreach ($title as $item)
                                    <option value="{{ ($item->kode) }}" {{ old('title_id') == $item->kode ? 'selected':'' }} >{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('title_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan Nama ..." value="{{ old('nama') }}">
                            @error('nama') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="kelamin">Kelamin</label>
                            <select name="kelamin" id="kelamin" class="form-control @error('kelamin') is-invalid @enderror">
                                <option value="" disabled selected>Pilih Kelamin</option>
                                <option value="Laki - laki" {{ old('kelamin') == "Laki - laki" ? 'selected':'' }} >Laki - laki</option>
                                <option value="Wanita" {{ old('kelamin') == 'Wanita' ? 'selected':'' }} >Wanita</option>
                            </select>
                            @error('kelamin') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="tmp_lahir">Tempat Lahir</label>
                            <input type="text" name="tmp_lahir" id="tmp_lahir" class="form-control @error('tmp_lahir') is-invalid @enderror" placeholder="Masukkan Tempat Lahir ..." value="{{ old('tmp_lahir') }}">
                            @error('tmp_lahir') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="tgl_lhr">Tanggal Lahir</label>
                            <input type="date" name="tgl_lhr" id="tgl_lhr" class="form-control @error('tgl_lhr') is-invalid @enderror" placeholder="Masukkan Tanggal Lahir ..." value="{{ old('tgl_lhr') }}">
                            @error('tgl_lhr') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="negara">Negara</label>
                            <select name="negara" id="negara" class="form-control @error('negara') is-invalid @enderror">
                                <option value="" disabled selected>Pilih Negara</option>
                                @foreach ($negara as $item)
                                    <option value="{{ ($item->kode) }}" {{ old('negara') == $item->kode ? 'selected':'' }} >{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('negara') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="kota">Kota</label>
                            <select name="kota" id="kota" class="form-control @error('kota') is-invalid @enderror">
                                <option value="" disabled selected>Pilih Kota</option>
                                @foreach ($kota as $item)
                                    <option value="{{ ($item->kode) }}" {{ old('kota') == $item->kode ? 'selected':'' }} >{{ $item->kota }}</option>
                                @endforeach
                            </select>
                            @error('kota') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="kelurahan">Kelurahan</label>
                            <input type="text" name="kelurahan" id="kelurahan" class="form-control @error('kelurahan') is-invalid @enderror" placeholder="Masukkan Alamat ..." value="{{ old('kelurahan') }}">
                            @error('kelurahan') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan Alamat ..." value="{{ old('alamat') }}">
                            @error('alamat') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="agama">Agama</label>
                            <select name="agama" id="agama" class="form-control @error('agama') is-invalid @enderror">
                                <option value="" disabled selected>Pilih Agama</option>
                                @foreach ($agama as $item)
                                    <option value="{{ ($item->kode) }}" {{ old('agama') == $item->kode ? 'selected':'' }} >{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('agama') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="darah">Golongan Darah</label>
                            <select name="darah" id="darah" class="form-control @error('darah') is-invalid @enderror">
                                <option value="" disabled selected>Pilih Golongan Darah</option>
                                @foreach ($darah as $item)
                                    <option value="{{ ($item->kode) }}" {{ old('darah') == $item->kode ? 'selected':'' }} >{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('darah') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="ibu">Nama Ibu</label>
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
                            <label for="pendidikan">Pendidikan</label>
                            <select name="pendidikan" id="pendidikan" class="form-control @error('pendidikan') is-invalid @enderror">
                                <option value="" disabled selected>Pilih Pendidikan</option>
                                @foreach ($pendidikan as $item)
                                    <option value="{{ ($item->kode) }}" {{ old('pendidikan') == $item->kode ? 'selected':'' }} >{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('pendidikan') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="perusahaan">Perusahaan</label>
                            <input type="text" name="perusahaan" id="perusahaan" class="form-control @error('perusahaan') is-invalid @enderror" placeholder="Masukkan Perusahaan ..." value="{{ old('perusahaan') }}">
                            @error('perusahaan') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="pekerjaan">Pekerjaan</label>
                            <select name="pekerjaan" id="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror">
                                <option value="" disabled selected>Pilih Pekerjaan</option>
                                @foreach ($pekerjaan as $item)
                                    <option value="{{ ($item->kode) }}" {{ old('pekerjaan') == $item->kode ? 'selected':'' }} >{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('pekerjaan') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="pin">Pin</label>
                            <input type="text" name="pin" id="pin" class="form-control @error('pin') is-invalid @enderror" placeholder="Masukkan Pin ..." value="{{ old('pin') }}">
                            @error('pin') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="npk">NPK</label>
                            <input type="text" name="npk" id="npk" class="form-control @error('npk') is-invalid @enderror" placeholder="Masukkan NPK ..." value="{{ old('npk') }}">
                            @error('npk') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="bagian">Bagian</label>
                            <select name="bagian" id="bagian" class="form-control @error('bagian') is-invalid @enderror">
                                <option value="" selected>Pilih Bagian</option>
                                @foreach ($bagian as $item)
                                    <option value="{{ ($item->kode) }}" {{ old('bagian') == $item->kode ? 'selected':'' }} >{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('bagian') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="no_jamsostek">Nomor Jamsostek</label>
                            <input type="text" onkeypress="return hanyaAngka(event);" name="no_jamsostek" id="no_jamsostek" class="form-control @error('no_jamsostek') is-invalid @enderror" placeholder="Masukkan Nomor Jamsostek ..." value="{{ old('no_jamsostek') }}">
                            @error('no_jamsostek') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" name="jabatan" id="jabatan" class="form-control @error('jabatan') is-invalid @enderror" placeholder="Masukkan Jabatan ..." value="{{ old('jabatan') }}">
                            @error('jabatan') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="dept">Dept</label>
                            <input type="text" name="dept" id="dept" class="form-control @error('dept') is-invalid @enderror" placeholder="Masukkan Dept ..." value="{{ old('dept') }}">
                            @error('dept') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="no_askes">Nomor Askes</label>
                            <input type="text" name="no_askes" id="no_askes" class="form-control @error('no_askes') is-invalid @enderror" placeholder="Masukkan Nomor Askes ..." value="{{ old('no_askes') }}">
                            @error('no_askes') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="pangkat">Pangkat</label>
                            <input type="text" name="pangkat" id="pangkat" class="form-control @error('pangkat') is-invalid @enderror" placeholder="Masukkan Pangkat ..." value="{{ old('pangkat') }}">
                            @error('pangkat') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="kesatuan">Kesatuan</label>
                            <input type="text" name="kesatuan" id="kesatuan" class="form-control @error('kesatuan') is-invalid @enderror" placeholder="Masukkan Kesatuan ..." value="{{ old('kesatuan') }}">
                            @error('kesatuan') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="masakerja">Masa Kerja</label>
                            <input type="text" name="masakerja" id="masakerja" class="form-control @error('masakerja') is-invalid @enderror" placeholder="Masukkan Masa Kerja ..." value="{{ old('masakerja') }}">
                            @error('masakerja') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="nrp">NRP</label>
                            <input type="text" name="nrp" id="nrp" class="form-control @error('nrp') is-invalid @enderror" placeholder="Masukkan NRP ..." value="{{ old('nrp') }}">
                            @error('nrp') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="paket">Paket</label>
                            <input type="text" name="paket" id="paket" class="form-control @error('paket') is-invalid @enderror" placeholder="Masukkan Paket ..." value="{{ old('paket') }}">
                            @error('paket') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="keydata">Keydata</label>
                            <input type="text" name="keydata" id="keydata" class="form-control @error('keydata') is-invalid @enderror" placeholder="Masukkan Keydata ..." value="{{ old('keydata') }}">
                            @error('keydata') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="reg_old">Reg Old</label>
                            <input type="text" name="reg_old" id="reg_old" class="form-control @error('reg_old') is-invalid @enderror" placeholder="Masukkan Reg Old ..." value="{{ old('reg_old') }}">
                            @error('reg_old') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="lokasi">Lokasi</label>
                            <input type="text" name="lokasi" id="lokasi" class="form-control @error('lokasi') is-invalid @enderror" placeholder="Masukkan Lokasi ..." value="{{ old('lokasi') }}">
                            @error('lokasi') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="no_rm">Nomor RM</label>
                            <input type="text" name="no_rm" id="no_rm" class="form-control @error('no_rm') is-invalid @enderror" placeholder="Masukkan Nomor RM ..." value="{{ old('no_rm') }}">
                            @error('no_rm') <span class="invalid-feedback">{{ $message }}</span> @enderror
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
