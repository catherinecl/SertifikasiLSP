@extends('layouts.app')

@section('title', 'Add Borrow Book')

@section('content')
    <form action="{{ route('pinjam.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="book_id" class="form-label">Book</label>
            <select name="book_id" id="book_id" class="form-select @error('book_id') is-invalid @enderror">
                <option value="" disabled selected>Select a Book</option>
                @foreach ($books->where('status', 'available') as $book)
                    <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                        {{ $book->title }}</option>
                @endforeach
            </select>
            @error('book_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if ($books->isEmpty())
                <small class="text-danger">No book data found.</small>
            @elseif ($books->where('status', 'available')->isEmpty())
                <small class="text-warning">All books are unavailable.</small>
            @endif
        </div>

        <div class="mb-3">
            <label for="member_id" class="form-label">Member</label>
            <select name="member_id" id="member_id" class="form-select @error('member_id') is-invalid @enderror">
                <option value="" disabled selected>Select a Member</option>
                @foreach ($members as $member)
                    <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                        {{ $member->name }}</option>
                @endforeach
            </select>
            @error('member_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if ($members->isEmpty())
                <small class="text-danger">No member data found.</small>
            @endif
        </div>

        <div class="mb-3">
            <label for="borrow_date" class="form-label">Borrow Date</label>
            <input type="date" name="borrow_date" id="borrow_date"
                class="form-control @error('borrow_date') is-invalid @enderror" value="{{ old('borrow_date') }}">
            @error('borrow_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="due_date" class="form-label">Due Date</label>
            <input type="date" name="due_date" id="due_date"
                class="form-control @error('due_date') is-invalid @enderror" value="{{ old('due_date') }}" readonly>
            @error('due_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('pinjam.index') }}" class="btn btn-secondary">Cancel</a>
    </form>

    <script>
        document.getElementById('borrow_date').addEventListener('change', function() {
            const borrowDateInput = this.value;
            if (borrowDateInput) {
                const borrowDate = new Date(borrowDateInput);
                borrowDate.setDate(borrowDate.getDate() + 7);
                const dueDate = borrowDate.toISOString().split('T')[0];
                document.getElementById('due_date').value = dueDate;
            } else {
                document.getElementById('due_date').value = '';
            }
        });
    </script>
@endsection
