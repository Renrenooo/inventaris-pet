@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3>Daftar Pet</h3>
        <a href="{{ route('pets.create') }}" class="btn btn-success">Tambah Pet Baru</a>
    </div>
    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="GET" action="{{ route('pets.index') }}" class="mb-3 d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari nama pet..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Cari</button>
            <a href="{{ route('pets.index') }}" class="btn btn-secondary ms-2">Reset</a>
        </form>


        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Pet</th>
                    <th>Berat</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pets as $pet)
                <tr>
                    <td>{{ $pet->id }}</td>
                    <td>{{ $pet->nama_pet }}</td>
                    <td>{{ $pet->berat }}</td>
                    <td>{{ $pet->jumlah }}</td>
                    <td>
                        <a href="{{ route('pets.edit', $pet->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ route('pets.delete', $pet->id) }}" class="btn btn-danger btn-sm"
                           onclick="return confirm('Yakin ingin menghapus pet ini?')">Hapus</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data pet</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

