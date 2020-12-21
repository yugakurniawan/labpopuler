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
        <div class="card shadow">
            <div class="card-body">
                <form autocomplete="off" action="{{ route('hasil-kuisioner.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <button type="submit" class="btn btn-block btn-success mb-5">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
