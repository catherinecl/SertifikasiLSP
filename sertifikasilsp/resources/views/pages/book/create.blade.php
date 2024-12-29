@extends('layouts.app')

@section('title', 'Add Book')

@section('content')
    <form action="{{ route('buku.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Book Title</label>
            <input type="text" class="form-control @error('title')
      is-invalid
      @enderror" name="title">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Author</label>
            <input type="text" class="form-control @error('author')
        is-invalid
        @enderror" name="author">
            @error('author')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Publisher</label>
            <input type="text" class="form-control @error('publisher')
        is-invalid
        @enderror"
                name="publisher">
            @error('publisher')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Published Date</label>
            <input type="date" class="form-control @error('published_date') is-invalid @enderror" 
                   name="published_date" 
                   value="{{ old('published_date') }}">
            @error('published_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Book Category</label>
            <div>
                @if ($categories->isEmpty())
                    <div class="alert alert-warning">
                        No category available. Please add some category first in Book Category.
                    </div>
                @else
                    <select class="form-select @error('categories') is-invalid @enderror" aria-label="Book Categories" name="categories">
                        <option selected disabled>Select a category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" 
                                {{ old('categories') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                @endif
            </div>
            @error('categories')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
 
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('buku.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
