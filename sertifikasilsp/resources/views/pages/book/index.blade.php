@extends('layouts.app')

@section('title', 'Book Data')

@section('content')
    <a href="{{ route('buku.create') }}">
        <button class="btn btn-primary">Add Book</button>
    </a>
    <br></br>

    <!-- Search Bar -->
    <form action="{{ route('buku.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by title or categories" 
                   value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Publisher</th>
                <th scope="col">Published Date</th>
                <th scope="col">Category</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($books->isEmpty())
                <tr>
                    <td colspan="8" class="text-center">No data found. Please add a book.</td>
                </tr>
            @else
                @foreach ($books as $books)
                    <tr>
                        <th scope="row">{{ $books->id }}</th>
                        <td>{{ $books->title }}</td>
                        <td>{{ $books->author }}</td>
                        <td>{{ $books->publisher }}</td>
                        <td>{{ $books->published_date }}</td>
                        <td>
                            @foreach ($books->categories as $category)
                                <span class="badge bg-info text-dark">{{ $category->name }}</span>
                            @endforeach
                        </td>
                        <td>{{ $books->status }}</td>
                        <td nowrap>
                            <a href="{{ route('buku.edit', $books->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('buku.destroy', $books->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection