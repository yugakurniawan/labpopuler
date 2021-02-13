@extends('layouts.base')

@section('title', 'Manajemen Kuisioner - ' . config('app.name'))

@section('page-title-heading')
<div class="page-title-icon">
    <i class="pe-7s-users icon-gradient bg-mean-fruit"></i>
</div>
<div>Manajemen Kuisioner
    <div class="page-title-subheading">
        Ini adalah halaman untuk mengelola kuisioner yang ada pada {{ config('app.name') }}
    </div>
</div>
@endsection

@section('page-title-actions')
<form id="form-bulan" action="{{ URL::current()}}" method="GET">
    <input type="month" name="bulan" id="bulan" class="form-control-sm" value="{{ request('bulan') ? request('bulan') : date('Y-m') }}" style="width: 175px">
</form>
@endsection

@section('search')
<div class="search-wrapper {{ request('cari') != '' ? 'active' : '' }}">
    <div class="input-holder">
        <form action="{{ url()->full() }}" method="GET">
            <input type="hidden" name="bulan" value="{{ request('bulan') }}">
            <input name="cari" type="text" class="search-input" placeholder="Cari dokter ..." value="{{ request('cari') }}">
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
                        <th>Nama</th>
                        <th>No. Hp / Telepon</th>
                        <th>Alamat</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dokter as $item)
                        <tr>
                            <td>
                                <a href="{{ route('kuisioner.show', ['user' => $item->user_id, 'bulan' => request('bulan')]) }}" class="btn btn-sm btn-info" data-toggle="tooltip" title="Detail"><i class="fas fa-eye"></i></a>
                            </td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->hp ? ($item->telp ? $item->hp . ' / ' . $item->telp : $item->hp) : '-'}}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>
                                @php
                                    $hasil_kuisioner = App\HasilKuisioner::where('user_id', $item->user_id)->get();
                                    $count = 0;
                                    foreach ($hasil_kuisioner as $item) {
                                        if (date('Y-m',strtotime($item->tanggal_mengisi_kuisioner)) == date('Y-m',strtotime(request('bulan')))) {
                                            $count++;
                                        }
                                    }
                                @endphp
                                @if ($count > 1)
                                    <i class="fas fa-check text-success"></i>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $dokter->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script>
    const bulan = document.querySelector("#bulan");
    bulan.addEventListener('change', function (event) {
        this.parentElement.submit();
    });
</script>
@endpush
