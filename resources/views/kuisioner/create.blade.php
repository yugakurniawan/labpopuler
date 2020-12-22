@extends('layouts.base')

@section('title', 'Kuisioner - ' . config('app.name'))

@section('page-title-heading')
<div class="page-title-icon">
    <i class="pe-7s-settings icon-gradient bg-mean-fruit"></i>
</div>
<div>Kuisioner
    <div class="page-title-subheading">
        Ini adalah halaman kuisioner pada {{ config('app.name') }}
    </div>
</div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-10">
        <form autocomplete="off" action="{{ route('hasil-kuisioner.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            @foreach ($kuisioner as $key => $item)
                <div class="card shadow mb-2">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="{{ strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $key }}">{{ $item->pertanyaan }}</label>
                            <input type="hidden" name="jenis_pertanyaan_id[]" value="{{ $item->jenis_pertanyaan_id }}">
                            <input type="hidden" name="pertanyaan[]" value="{{ $item->pertanyaan }}">
                            @switch($item->jenis_pertanyaan->jenis)
                                @case('Jawaban Singkat')
                                    <input required type="text" class="form-control" name="{{ strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $key }}" id="{{ strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $key }}" value="{{ old(strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $key) }}" placeholder="Jawaban Anda">
                                    @break
                                @case('Paragraf')
                                    <textarea required class="form-control" name="{{ strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $key }}" id="{{ strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $key }}" value="{{ old(strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $key) }}" placeholder="Jawaban Anda">{{ old(strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $key) }}</textarea>
                                    @break
                                @case('Pilihan Ganda')
                                    @foreach ($item->pilih_jawaban_kuisioner as $i => $jawaban)
                                        <div class="custom-control custom-radio">
                                            <input required type="radio" id="{{ strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $i }}" name="{{ strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $key }}" class="custom-control-input" value="{{ $jawaban->opsi }}" {{ old(strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $key) == $jawaban->opsi ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="{{ strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $i }}">{{ $jawaban->opsi }}</label>
                                        </div>
                                    @endforeach
                                    @break
                                @case('Kotak Centang')
                                    @foreach ($item->pilih_jawaban_kuisioner as $i => $jawaban)
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" id="{{ strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $i }}" name="{{ strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $key }}[]" class="custom-control-input" value="{{ $jawaban->opsi }}" {{ old(strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $key) == $jawaban->opsi ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="{{ strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $i }}">{{ $jawaban->opsi }}</label>
                                        </div>
                                    @endforeach
                                    <input type="hidden" name="{{ strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $key }}_checkbox" value="{{ old(strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $key .'_checkbox') }}">
                                    @break
                                @case('Dropdown')
                                    <select required class="form-control" name="{{ strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $key }}" id="{{ strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $key }}" value="{{ old(strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $key) }}">
                                        @foreach ($item->pilih_jawaban_kuisioner as $jawaban)
                                            <option value="{{ $jawaban->opsi }}" {{ old(strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $key) == $jawaban->opsi ? 'selected' : '' }}>{{ $jawaban->opsi }}</option>
                                        @endforeach
                                    </select>
                                    @break
                                @case('Skala Linier')
                                    <div class="form-group text-center">
                                        <label class="mr-3 col-form-label">{{ $item->pilih_jawaban_kuisioner[2]->opsi }}</label>
                                        @for ($i = $item->pilih_jawaban_kuisioner[0]->opsi; $i <= $item->pilih_jawaban_kuisioner[1]->opsi; $i++)
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input required type="radio" id="{{ strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $i }}" name="{{ strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $key }}" class="custom-control-input" value="{{ $i }}" {{ old(strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $key) == $i ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="{{ strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $i }}">{{ $i }}</label>
                                            </div>
                                        @endfor
                                        <label>{{ $item->pilih_jawaban_kuisioner[3]->opsi }}</label>
                                    </div>
                                    @break
                                @case('Tanggal')
                                    <input required type="date" class="form-control" name="{{ strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $key }}" id="{{ strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $key }}" value="{{ old(strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $key) }}">
                                    @break
                                @case('Waktu')
                                    <input required type="time" class="form-control" name="{{ strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $key }}" id="{{ strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $key }}" value="{{ old(strtolower(str_replace(' ','_',$item->pertanyaan)) . '_' . $key) }}">
                                    @break
                            @endswitch
                        </div>
                    </div>
                </div>
            @endforeach
            <button type="submit" class="btn btn-block btn-success mb-5">Kirim</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('click', function (event) {
        if(event.target.type == 'checkbox') {
            let hidden = document.querySelector('input[name="'+ event.target.getAttribute('name').replace('[]','') +'_checkbox"]');
            if (event.target.checked) {
                hidden.value += event.target.value;
            } else {
                hidden.value = hidden.value.replace(event.target.value,'');
            }
        };
    });
</script>
@endpush
