@extends('layouts.base')

@section('title', 'Manajemen Pengguna - ' . config('app.name'))

@section('page-title-heading')
<div class="page-title-icon">
    <i class="pe-7s-users icon-gradient bg-mean-fruit"></i>
</div>
<div>Manajemen Pengguna
    <div class="page-title-subheading">
        Ini adalah halaman untuk mengelola pengguna yang ada pada {{ config('app.name') }}
    </div>
</div>
@endsection

@section('search')
<div class="search-wrapper {{ request('cari') != '' ? 'active' : '' }}">
    <div class="input-holder">
        <form action="{{ URL::current() }}" method="GET">
            <input name="cari" type="text" class="search-input" placeholder="Cari pengguna ..." value="{{ request('cari') }}">
        </form>
        <button class="search-icon"><span></span></button>
    </div>
    <button class="close"></button>
</div>
@endsection

@section('content')
<div class="row">
    @foreach ($users as $user)
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card shadow">
                <div class="card-body text-center">
                    <img width="80" class="rounded-circle mb-3" src="{{ asset(Storage::url($user->avatar)) }}" alt="Foto Profil {{ $user->nama }}">
                    <h5>{{ $user->nama }}</h5>
                    <p>{{ $user->peran->nama }}</p>
                    <a href="{{ route('user.edit', $user) }}" class="btn btn-sm btn-success">Edit</a>
                    <a href="#hapus" data-nama="{{ $user->nama }}" class="btn btn-sm btn-danger hapus">Hapus</a>
                    <form action="{{ route('user.destroy', $user) }}" method="POST">
                        @csrf @method('delete')
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>
{{ $users->links() }}
@endsection

@push('scripts')
<script>
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('hapus')) {
            event.preventDefault();
            if (confirm('Apakah anda yakin ingin menghapus pengguna ' + event.target.dataset.nama + ' ini ?')) {
                event.target.nextSibling.nextElementSibling.submit();
            }
        }
    });
</script>
@endpush
