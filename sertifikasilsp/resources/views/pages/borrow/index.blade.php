@extends('layouts.app')

@section('title', 'Borrow Data')

@section('content')
    <a href="{{ route('pinjam.create') }}">
        <button class="btn btn-primary">Add Data</button>
    </a>
    <br></br>

    <form action="{{ route('pinjam.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by member name or book title"
                value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Member Name</th>
                <th scope="col">Book Title</th>
                <th scope="col">Borrow Date</th>
                <th scope="col">Due Date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($borrows->isEmpty())
                <tr>
                    <td colspan="8" class="text-center">No data found.</td>
                </tr>
            @else
                @foreach ($borrows as $borrow)
                    <tr>
                        <td>{{ $borrow->id }}</td>
                        <td>{{ $borrow->member->name }}</td>
                        <td>{{ $borrow->book->title }}</td>
                        <td>{{ $borrow->borrow_date }}</td>
                        <td>{{ $borrow->due_date }}</td>
                        <td>
                            <a href="{{ route('pinjam.edit', $borrow->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('pinjam.destroy', $borrow->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection
