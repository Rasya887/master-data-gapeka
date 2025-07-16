@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Import Data Jarak dari Excel</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('jarak.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="file" class="form-label">Pilih File Excel</label>
            <input type="file" name="file" class="form-control" required>
        </div>
        <button class="btn btn-primary">Import</button>
    </form>
</div>
@endsection
