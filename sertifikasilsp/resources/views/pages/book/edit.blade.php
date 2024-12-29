@extends('layouts.app')

@section('title', 'Update Book')

@section('content')
    <form action="{{ route('buku.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Book Title</label>
            <input type="text" class="form-control @error('title')
      is-invalid
      @enderror" name="title"
                value="{{ $book->title }}">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Author</label>
            <input type="text" class="form-control @error('author')
        is-invalid
        @enderror" name="author"
                value="{{ $book->author }}">
            @error('author')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Publisher</label>
            <input type="text" class="form-control @error('publisher')
        is-invalid
        @enderror"
                name="publisher" value="{{ $book->publisher }}">
            @error('publisher')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Published Date</label>
            <input type="date" class="form-control @error('published_date') is-invalid @enderror" name="published_date"
                value="{{ old('published_date', $book->published_date) }}">
            @error('published_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Book Category</label>
            <div>
                <select class="form-select @error('category_id') is-invalid @enderror" aria-label="Book Category" name="category_id">
                    <option selected disabled>Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" 
                            {{ old('category_id', $book->categories->first()->id ?? '') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @error('category_id')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="status_available" value="available" 
                        {{ old('status', $book->status) == 'available' ? 'checked' : '' }}>
                    <label class="form-check-label" for="status_available">
                        Available
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="status_unavailable" value="unavailable" 
                        {{ old('status', $book->status) == 'unavailable' ? 'checked' : '' }}>
                    <label class="form-check-label" for="status_unavailable">
                        Unavailable
                    </label>
                </div>
            </div>
            @error('status')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('buku.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
