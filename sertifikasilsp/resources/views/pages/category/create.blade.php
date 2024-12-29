@extends('layouts.app')

@section('title', 'Add Category')

@section('content')
    <form action="{{ route('kategori.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="shelf_number" class="form-label">Shelf Number</label>
            <input type="text" name="shelf_number" id="shelf_number" 
                   class="form-control @error('shelf_number') is-invalid @enderror" 
                   value="{{ old('shelf_number') }}">
            @error('shelf_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection