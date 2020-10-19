@extends('layouts.base')

@section('title', 'Manajemen Jadwal Kunjungan Marketing - ' . config('app.name'))

@section('page-title-heading')
<div class="page-title-icon">
    <i class="pe-7s-users icon-gradient bg-mean-fruit"></i>
</div>
<div>Manajemen Jadwal Kunjungan Marketing
    <div class="page-title-subheading">
        Ini adalah halaman untuk mengelola Jadwal Kunjungan Marketing yang ada pada {{ config('app.name') }}
    </div>
</div>
@endsection

@section('search')
<div class="search-wrapper {{ request('cari') != '' ? 'active' : '' }}">
    <div class="input-holder">
        <form action="{{ URL::current() }}" method="GET">
            <input name="cari" type="text" class="search-input" placeholder="Cari jadwal kunjungan ..." value="{{ request('cari') }}">
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
                        @can('dokter')
                            <th>Marketing</th>
                        @elsecan('marketing')
                            <th>Dokter</th>
                        @endcan
                        <th>Jadwal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwal_kunjungan as $item)
                        <tr>
                            <td>
                                @can('marketing')
                                    <a href="{{ route('jadwal-kunjungan.edit', $item) }}" class="btn btn-sm btn-success" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>
                                @elsecan('dokter')
                                    <a href="{{ route('jadwal-kunjungan.show', $item) }}" class="btn btn-sm btn-success" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>
                                @endcan
                                <a href="#hapus" class="btn btn-sm btn-danger hapus" data-nama="{{ date('d/m/Y H:i:s',strtotime($item->jadwal)) }}" data-toggle="tooltip" title="Hapus"><i class="fas fa-trash hapus-data"></i></a>
                                <form action="{{ route("jadwal-kunjungan.destroy", $item) }}" method="post">
                                    @csrf @method('delete')
                                </form>
                            </td>
                            @can('marketing')
                                <td>{{ $item->dokter->nama }} - {{ $item->dokter->kode }}</td>
                            @elsecan('dokter')
                                <td>{{ $item->user->nama }}</td>
                            @endcan
                            <td>{{ date('d/m/Y H:i:s',strtotime($item->jadwal)) }}</td>
                            <td>
                                @php
                                    switch ($item->status) {
                                        case 1:
                                            echo "Disetujui";
                                            break;
                                        case 2:
                                            echo "Tidak Disetujui";
                                            break;
                                        default:
                                            echo "Belum disetujui";
                                            break;
                                    }
                                @endphp
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $jadwal_kunjungan->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('hapus')) {
            event.preventDefault();
            if (confirm('Apakah anda yakin ingin menghapus jadwal kunjungan ' + event.target.dataset.nama + ' ini ?')) {
                event.target.nextSibling.nextElementSibling.submit();
            }
        }

        if (event.target.classList.contains('hapus-data')) {
            event.preventDefault();
            if (confirm('Apakah anda yakin ingin menghapus jadwal kunjungan ' + event.target.parentElement.dataset.nama + ' ini ?')) {
                event.target.parentElement.nextSibling.nextElementSibling.submit();
            }
        }
    });
</script>
@endpush
