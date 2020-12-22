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
                <div class="card shadow mb-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <textarea title="Pertanyaan" type="text" name="pertanyaan[]" class="form-control" placeholder="Pertanyaan ...">{{ old('pertanyaan', $item->pertanyaan) }}</textarea>
                                </div>
                                <div id="opsi">
                                    <input type="hidden" name="banyak_opsi[]" value="{{ count($item->pilih_jawaban_kuisioner) }}">
                                    @if ($item->jenis_pertanyaan->jenis == 'Skala Linier')
                                        <div class="form-group">
                                            <input type="number" min="0" max="1" class="form-control-sm" name="opsi[]" placeholder="Opsi ..." value="{{ $item->pilih_jawaban_kuisioner[0]->opsi }}">
                                            <label>Sampai</label>
                                            <input type="number" min="2" max="10" class="form-control-sm" name="opsi[]" placeholder="Opsi ..." value="{{ $item->pilih_jawaban_kuisioner[1]->opsi }}">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="opsi[]" placeholder="Label (opsional)" value="{{ $item->pilih_jawaban_kuisioner[2]->opsi }}">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="opsi[]" placeholder="Label (opsional)" value="{{ $item->pilih_jawaban_kuisioner[3]->opsi }}">
                                        </div>
                                    @else
                                        @foreach ($item->pilih_jawaban_kuisioner as $pilihan)
                                            <div class="form-group">
                                                <div class="input-group input-group-alternative mb-3">
                                                    <input type="text" class="form-control" name="opsi[]" placeholder="Opsi ..." value="{{ $pilihan->opsi }}">
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-outline-success atas-opsi" title="Pindah Ke Atas"><i class="fas fa-arrow-up"></i></button>
                                                        <button type="button" class="btn btn-outline-success bawah-opsi" title="Pindah Ke Bawah"><i class="fas fa-arrow-down"></i></button>
                                                        <button type="button" class="btn btn-outline-primary tambah-opsi" title="Tambah"><i class="fas fa-plus"></i></button>
                                                        <button type="button" class="btn btn-outline-danger hapus-opsi" title="Hapus"><i class="fas fa-trash"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
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
                </div>
            @empty
                <div class="card shadow mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <textarea type="text" name="pertanyaan[]" class="form-control" placeholder="Pertanyaan ..."></textarea>
                                </div>
                                <div id="opsi"><input type="hidden" name="banyak_opsi[]" value="0"></div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <select name="jenis_pertanyaan_id[]" class="form-control">
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

        if (event.target.localName == 'input') {
            event.target.setAttribute('value', event.target.value);
        }

        if (event.target.localName == 'select') {
            let card = event.target.parentElement.parentElement.parentElement.children[0];

            if (event.target.value == 3 || event.target.value == 4 || event.target.value == 5) {
                if (card.children[1].querySelectorAll('.form-group').length == 0) {
                    let banyak = parseInt(card.querySelector('input[name="banyak_opsi[]"]').value) + 1;
                    card.querySelector('input[name="banyak_opsi[]"]').value = banyak;
                    card.children[1].innerHTML += `
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative mb-3">
                                            <input type="text" class="form-control" name="opsi[]" placeholder="Opsi ...">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-outline-success atas-opsi" title="Pindah Ke Atas"><i class="fas fa-arrow-up"></i></button>
                                                <button type="button" class="btn btn-outline-success bawah-opsi" title="Pindah Ke Bawah"><i class="fas fa-arrow-down"></i></button>
                                                <button type="button" class="btn btn-outline-primary tambah-opsi" title="Tambah"><i class="fas fa-plus"></i></button>
                                                <button type="button" class="btn btn-outline-danger hapus-opsi" title="Hapus"><i class="fas fa-trash"></i></button>
                                            </div>
                                        </div>
                                    </div>`;
                }
            } else if (event.target.value == 6) {
                card.children[1].innerHTML = `
                                    <input type="hidden" name="banyak_opsi[]" value="4">
                                    <div class="form-group">
                                        <input type="number" min="0" max="1" class="form-control-sm" name="opsi[]" placeholder="Opsi ..." value="1">
                                        <label>Sampai</label>
                                        <input type="number" min="2" max="10" class="form-control-sm" name="opsi[]" placeholder="Opsi ..." value="5">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="opsi[]" placeholder="Label (opsional)">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="opsi[]" placeholder="Label (opsional)">
                                    </div>
                                    `;
            } else {
                card.children[1].innerHTML = `<input type="hidden" name="banyak_opsi[]" value="0">`;
            }

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
            let card = event.target.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement;
            card.insertAdjacentHTML('afterend', card.outerHTML);
            let nextCard = card.nextElementSibling;
            nextCard.querySelector("#opsi").innerHTML = `<input type="hidden" name="banyak_opsi[]" value="0">`;
            nextCard.querySelector('textarea').innerHTML = '';
            nextCard.querySelector('select').value = 1;
        }

        if (event.target.classList.contains('hapus')) {
            let card = event.target.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement;
            if (card.previousElementSibling.classList.contains('card') || card.nextElementSibling.classList.contains('card')) {
                card.remove();
            } else {
                alert('Satu-satunya pertanyaan yang ada tidak dapat dihapus');
            }
        }

        if (event.target.classList.contains('atas')) {
            let change = event.target.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.previousElementSibling;
            let current = event.target.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement;
            if (change.classList.contains('card')) {
                changePosition(change, current);
            }
        }

        if (event.target.classList.contains('bawah')) {
            let change = event.target.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.nextElementSibling;
            let current = event.target.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement;
            if (change.classList.contains('card')) {
                changePosition(change, current);
            }
        }

        if (event.target.classList.contains('tambah-opsi')) {
            let card = event.target.parentElement.parentElement.parentElement;
            let banyak = parseInt(card.parentElement.querySelector('input[name="banyak_opsi[]"]').value) + 1;
            card.parentElement.querySelector('input[name="banyak_opsi[]"]').value = banyak;
            card.insertAdjacentHTML('afterend', card.outerHTML);
            let nextCard = card.nextElementSibling;
            nextCard.querySelector('input').setAttribute('value','');
        }

        if (event.target.classList.contains('hapus-opsi')) {
            let card = event.target.parentElement.parentElement.parentElement;
            if (card.parentElement.children.length > 2) {
                let banyak = parseInt(card.parentElement.querySelector('input[name="banyak_opsi[]"]').value) - 1;
                card.parentElement.querySelector('input[name="banyak_opsi[]"]').value = banyak;
                card.remove();
            } else {
                alert('Satu-satunya opsi yang ada tidak dapat dihapus');
            }
        }

        if (event.target.parentElement.classList.contains('tambah-opsi')) {
            let card = event.target.parentElement.parentElement.parentElement.parentElement;
            let banyak = parseInt(card.parentElement.querySelector('input[name="banyak_opsi[]"]').value) + 1;
            card.parentElement.querySelector('input[name="banyak_opsi[]"]').value = banyak;
            card.insertAdjacentHTML('afterend', card.outerHTML);
            let nextCard = card.nextElementSibling;
            nextCard.querySelector('input').setAttribute('value','');
        }

        if (event.target.parentElement.classList.contains('hapus-opsi')) {
            let card = event.target.parentElement.parentElement.parentElement.parentElement;
            if (card.parentElement.children.length > 2) {
                let banyak = parseInt(card.parentElement.querySelector('input[name="banyak_opsi[]"]').value) - 1;
                card.parentElement.querySelector('input[name="banyak_opsi[]"]').value = banyak;
                card.remove();
            } else {
                alert('Satu-satunya opsi yang ada tidak dapat dihapus');
            }
        }

        if (event.target.classList.contains('atas-opsi')) {
            let change = event.target.parentElement.parentElement.parentElement.previousElementSibling;
            let current = event.target.parentElement.parentElement.parentElement;
            if (change) {
                changePosition(change, current);
            }
        }

        if (event.target.parentElement.classList.contains('bawah-opsi')) {
            let change = event.target.parentElement.parentElement.parentElement.parentElement.nextElementSibling;
            let current = event.target.parentElement.parentElement.parentElement.parentElement;
            if (change) {
                changePosition(change, current);
            }
        }

        if (event.target.parentElement.classList.contains('atas-opsi')) {
            let change = event.target.parentElement.parentElement.parentElement.parentElement.previousElementSibling;
            let current = event.target.parentElement.parentElement.parentElement.parentElement;
            if (change) {
                changePosition(change, current);
            }
        }

        if (event.target.classList.contains('bawah-opsi')) {
            let change = event.target.parentElement.parentElement.parentElement.nextElementSibling;
            let current = event.target.parentElement.parentElement.parentElement;
            if (change) {
                changePosition(change, current);
            }
        }
    });

    function changePosition(change, current) {
        const dataChange = change.innerHTML;
        const dataCurrent = current.innerHTML;
        change.innerHTML = dataCurrent;
        current.innerHTML = dataChange;
    }
</script>
@endpush
