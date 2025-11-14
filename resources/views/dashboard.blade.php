@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h1 class="card-title">Dashboard</h1>
        <p class="card-text">Selamat datang, <strong>{{ auth()->user()->name }}</strong>!</p>
        <a href="{{ route('pets.index') }}" class="btn btn-primary">Kelola Pets</a>
    </div>
</div>
@endsection
