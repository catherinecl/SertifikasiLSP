@extends('layouts.app')

@section('title', 'Member Data')

@section('content')
    <a href="{{ route('member.create') }}">
        <button class="btn btn-primary">Add Member</button>
    </a>
    <br></br>

    <form action="{{ route('member.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by name"
                value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
    </form>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Member Number</th> 
                <th scope="col">Phone Number</th>
                <th scope="col">Join Date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($members->isEmpty())
                <tr>
                    <td colspan="8" class="text-center">No data found. Please add a member.</td>
                </tr>
            @else
                @foreach ($members as $members)
                    <tr>
                        <th scope="row">{{ $members->id }}</th>
                        <td>{{ $members->name }}</td>
                        <td>{{ $members->member_number }}</td>
                        <td>{{ $members->phone_number }}</td>
                        <td>{{ $members->join_date }}</td>
                        <td nowrap>
                            <a href="{{ route('member.edit', $members->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('member.destroy', $members->id) }}" method="POST" class="d-inline">
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
