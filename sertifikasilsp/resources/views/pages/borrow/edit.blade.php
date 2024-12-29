@extends('layouts.app')

@section('title', 'Update Borrow')

@section('content')
    <form action="{{ route('pinjam.update', $borrow->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="book_id" class="form-label">Book</label>
            <select name="book_id" id="book_id" class="form-select @error('book_id') is-invalid @enderror">
                <option value="" disabled>Select a Book</option>
                @foreach ($books as $book)
                    <option value="{{ $book->id }}" {{ $book->id == $borrow->book_id ? 'selected' : '' }}>
                        {{ $book->title }}</option>
                @endforeach
            </select>
            @error('book_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if ($books->where('status', 'available')->isEmpty())
                <small class="text-warning">All books are unavailable.</small>
            @endif
        </div>

        <div class="mb-3">
            <label for="member_id" class="form-label">Member</label>
            <select name="member_id" id="member_id" class="form-select @error('member_id') is-invalid @enderror">
                <option value="" disabled>Select a Member</option>
                @foreach ($members as $member)
                    <option value="{{ $member->id }}" {{ $member->id == $borrow->member_id ? 'selected' : '' }}>
                        {{ $member->name }}</option>
                @endforeach
            </select>
            @error('member_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="borrow_date" class="form-label">Borrow Date</label>
            <input type="date" name="borrow_date" id="borrow_date"
                class="form-control @error('borrow_date') is-invalid @enderror"
                value="{{ old('borrow_date', $borrow->borrow_date) }}">
            @error('borrow_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="due_date" class="form-label">Due Date</label>
            <input type="date" name="due_date" id="due_date"
                class="form-control @error('due_date') is-invalid @enderror"
                value="{{ old('due_date', $borrow->due_date) }}">
            @error('due_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('pinjam.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
