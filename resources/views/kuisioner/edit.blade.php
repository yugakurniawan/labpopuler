@extends('layouts.base')

@section('title', 'Pengaturan Kuisioner - ' . config('app.name'))

@section('page-title-heading')
<div class="page-title-icon">
    <i class="pe-7s-settings icon-gradient bg-mean-fruit"></i>
</div>
<div>Pengaturan Kuisioner
    <div class="page-title-subheading">
        Ini adalah halaman untuk mengatur kuisioner pada {{ config('app.name') }}
    </div>
</div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-10">
        <form autocomplete="off" action="{{ route('kuisioner.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @forelse ($kuisioner as $item)
                <div class="card shadow mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-sm-8">
                                <textarea title="Pertanyaan" type="text" name="pertanyaan[]" class="form-control @error('pertanyaan') is-invalid @enderror" placeholder="Pertanyaan ...">{{ old('pertanyaan', $item->pertanyaan) }}</textarea>
                                @error('pertanyaan') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group col-sm-4">
                                <select name="jenis_pertanyaan_id[]" class="form-control @error('jenis_pertanyaan_id') is-invalid @enderror">
                                    @foreach ($jenis_pertanyaan as $jenis)
                                        <option value="{{ $jenis->id }}" {{ old('jenis_pertanyaan_id', $item->jenis_pertanyaan_id) == $jenis->id ? 'selected' : '' }}>{{ $jenis->jenis }}</option>
                                    @endforeach
                                </select>
                                <div class="text-right mt-3">
                                    <i title="Pindahkan Ke Atas" class="btn btn-success atas fas fa-arrow-up"></i>
                                    <i title="Pindahkan Ke Bawah" class="btn btn-success bawah fas fa-arrow-down"></i>
                                    <i title="Tambah Pertanyaan" class="btn btn-primary tambah fas fa-plus"></i>
                                    <i title="Hapus Pertanyaan Ini" class="btn btn-danger hapus fas fa-trash"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="card shadow mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-sm-8">
                                <textarea type="text" name="pertanyaan[]" class="form-control @error('pertanyaan') is-invalid @enderror" placeholder="Pertanyaan ...">{{ old('pertanyaan') }}</textarea>
                                @error('pertanyaan') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group col-sm-4">
                                <select name="jenis_pertanyaan_id[]" class="form-control @error('jenis_pertanyaan_id') is-invalid @enderror">
                                    @foreach ($jenis_pertanyaan as $item)
                                        <option value="{{ $item->id }}" {{ old('jenis_pertanyaan_id') == $item->id ? 'selected' : '' }}>{{ $item->jenis }}</option>
                                    @endforeach
                                </select>
                                <div class="text-right mt-3">
                                    <i title="Pindahkan Ke Atas" class="btn btn-success atas fas fa-arrow-up"></i>
                                    <i title="Pindahkan Ke Bawah" class="btn btn-success bawah fas fa-arrow-down"></i>
                                    <i title="Tambah Pertanyaan" class="btn btn-primary tambah fas fa-plus"></i>
                                    <i title="Hapus Pertanyaan Ini" class="btn btn-danger hapus fas fa-trash"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
            <button type="submit" class="btn btn-block btn-success mb-5">Simpan</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('change', function (event) {
        if (event.target.localName == 'textarea') {
            event.target.innerHTML = event.target.value;
        }

        if (event.target.localName == 'select') {
            for (let i = 0; i < event.target.options.length; i++) {
                option = event.target.options[i];
                if (option.value == event.target.value) {
                    option.setAttribute('selected', true);
                }
            }
        }
    });

    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('tambah')) {
            let card = event.target.parentElement.parentElement.parentElement.parentElement.parentElement;
            card.insertAdjacentHTML('afterend', card.outerHTML);
            let nextCard = card.nextElementSibling;
            nextCard.querySelector('textarea').innerHTML = '';
            nextCard.querySelector('select').value = 1;
        }

        if (event.target.classList.contains('hapus')) {
            let card = event.target.parentElement.parentElement.parentElement.parentElement.parentElement;
            card.remove();
        }

        if (event.target.classList.contains('atas')) {
            let change = event.target.parentElement.parentElement.parentElement.parentElement.parentElement.previousElementSibling;
            if (change.classList.contains('card')) {
                let current = event.target.parentElement.parentElement.parentElement.parentElement.parentElement;
                const dataChange = change.innerHTML;
                const dataCurrent = current.innerHTML;
                change.innerHTML = dataCurrent;
                current.innerHTML = dataChange;
            }
        }

        if (event.target.classList.contains('bawah')) {
            let change = event.target.parentElement.parentElement.parentElement.parentElement.parentElement.nextElementSibling;
            if (change.classList.contains('card')) {
                let current = event.target.parentElement.parentElement.parentElement.parentElement.parentElement;
                const dataChange = change.innerHTML;
                const dataCurrent = current.innerHTML;
                change.innerHTML = dataCurrent;
                current.innerHTML = dataChange;
            }
        }
    });
</script>
@endpush
