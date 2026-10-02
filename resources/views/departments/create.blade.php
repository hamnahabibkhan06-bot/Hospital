@extends('layouts.admin')

@section('title','Add Department')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Add New Department</h4>
        </div>

        <div class="card-body">
           
            <form action="{{ route('admin.departments.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Department Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="5" class="form-control">{{ old('description') }}</textarea>
                </div>

                <button class="btn btn-success">Save Department</button>
                
                <a href="{{ route('admin.departments.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
