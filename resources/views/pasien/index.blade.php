@extends('layouts.base')

@section('title', 'Manajemen Pasien - ' . config('app.name'))

@section('page-title-heading')
<div class="page-title-icon">
    <i class="pe-7s-users icon-gradient bg-mean-fruit"></i>
</div>
<div>Manajemen Pasien
    <div class="page-title-subheading">
        Ini adalah halaman untuk mengelola Pasien yang ada pada {{ config('app.name') }}
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
                    @foreach ($pasien as $item)
                        <tr>
                            <td>
                                <a href="{{ route('pasien.edit', $item) }}" class="btn btn-sm btn-success" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>
                                <a href="#hapus" class="btn btn-sm btn-danger hapus" data-nama="{{ $item->nama }}" data-toggle="tooltip" title="Hapus"><i class="fas fa-trash hapus-data"></i></a>
                                <form action="{{ route("pasien.destroy", $item) }}" method="post">
                                    @csrf @method('delete')
                                </form>
                            </td>
                            <td>{{ $item->noreg }}</td>
                            <td>{{ $item->title->nama }} {{ $item->nama }}</td>
                            <td>{{ date('d/m/Y',strtotime($item->tgl_tran)) }}</td>
                            <td>{{ $item->tmp_lahir ? $item->tmp_lahir . ", " : "" }} {{ date('d/m/Y',strtotime($item->tgl_lhr)) }}</td>
                            <td>{{ $item->alamat }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $pasien->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('hapus')) {
            event.preventDefault();
            if (confirm('Apakah anda yakin ingin menghapus pasien ' + event.target.dataset.nama + ' ini ?')) {
                event.target.nextSibling.nextElementSibling.submit();
            }
        }

        if (event.target.classList.contains('hapus-data')) {
            event.preventDefault();
            if (confirm('Apakah anda yakin ingin menghapus pasien ' + event.target.parentElement.dataset.nama + ' ini ?')) {
                event.target.parentElement.nextSibling.nextElementSibling.submit();
            }
        }
    });
</script>
@endpush
