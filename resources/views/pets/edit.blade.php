@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Edit Pet</h3>
    </div>
    <div class="card-body">

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('pets.update', $pet->id) }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Pet</label>
                <input type="text" name="nama_pet" class="form-control" value="{{ old('nama_pet', $pet->nama_pet) }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Berat</label>
                <input type="number" name="berat" class="form-control" value="{{ old('berat', $pet->berat) }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Jumlah</label>
                <input type="number" name="jumlah" class="form-control" value="{{ old('jumlah', $pet->jumlah) }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('pets.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
