@extends('layouts.base')

@section('title', 'Pasien Saya - ' . config('app.name'))

@section('page-title-heading')
<div class="page-title-icon">
    <i class="pe-7s-users icon-gradient bg-mean-fruit"></i>
</div>
<div>Pasien Saya
    <div class="page-title-subheading">
        Ini adalah halaman untuk mengelola Pasien Saya yang ada pada {{ config('app.name') }} dengan jumlah {{ $total }} Pasien
    </div>
</div>
@endsection

@section('search')
<div class="search-wrapper {{ request('cari') != '' ? 'active' : '' }}">
    <div class="input-holder">
        <form action="{{ URL::current() }}" method="GET">
            <input name="cari" type="text" class="search-input" placeholder="Cari pasien ..." value="{{ request('cari') }}">
        </form>
        <button class="search-icon"><span></span></button>
    </div>
    <button class="close"></button>
</div>
@endsection

@section('content')
<div class="card shadow">
    <div class="card-body text-center">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th width="100px">Opsi</th>
                        <th>Noreg</th>
                        <th>Nama</th>
                        <th>Tgl Tran</th>
                        <th>TTL</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pasien as $key => $item)
                        @php
                            if ($key > 0) {
                                if ($item->noreg == $pasien[$key - 1]->noreg) {
                                    continue;
                                }
                            }
                        @endphp
                        <tr>
                            <td>
                                <a href="{{ route('pasien.show', $item) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Detail Pasien"><i class="fas fa-eye"></i></a>
                            </td>
                            <td>{{ $item->noreg }}</td>
                            <td>{{ $item->pasien->title->nama }} {{ $item->pasien->nama }}</td>
                            <td>{{ date('d/m/Y',strtotime($item->pasien->tgl_tran)) }}</td>
                            <td>{{ $item->pasien->tmp_lahir ? $item->pasien->tmp_lahir . ", " : "" }} {{ date('d/m/Y',strtotime($item->pasien->tgl_lhr)) }}</td>
                            <td>{{ $item->pasien->alamat }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $pasien->links() }}
    </div>
</div>
@endsection
