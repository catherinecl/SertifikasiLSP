@extends('layouts.app')

@section('title', 'Edit Member')

@section('content')

    <form action="{{ route('member.update', $member->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="member_number" class="form-label">Member Number</label>
            <input type="text" name="member_number" id="member_number" 
                   class="form-control @error('member_number') is-invalid @enderror" 
                   value="{{ old('member_number', $member->member_number) }}"
                   pattern="[0-9]*" maxlength="15" 
                   title="Only numbers are allowed"
                   placeholder="Only numbers (e.g., 12345)">
            @error('member_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" 
                   class="form-control @error('name') is-invalid @enderror" 
                   value="{{ old('name', $member->name) }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="phone_number" class="form-label">Phone Number</label>
            <input type="tel" name="phone_number" id="phone_number" 
                   class="form-control @error('phone_number') is-invalid @enderror" 
                   value="{{ old('phone_number', $member->phone_number) }}" 
                   pattern="[0-9]*" maxlength="15" 
                   title="Only numbers are allowed"
                   placeholder="Only numbers (e.g., 081234567890)">
            @error('phone_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="join_date" class="form-label">Join Date</label>
            <input type="date" name="join_date" id="join_date" 
                   class="form-control @error('join_date') is-invalid @enderror" 
                   value="{{ old('join_date', $member->join_date) }}">
            @error('join_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('member.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
