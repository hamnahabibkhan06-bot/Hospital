@extends('layouts.admin')

@section('title','Edit Department')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-warning">
            <h4>Edit Department</h4>
        </div>

        <div class="card-body">
            
            <form action="{{ route('admin.departments.update', $department) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Department Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $department->name) }}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" rows="5" class="form-control">{{ old('description', $department->description) }}</textarea>
                </div>

                <button class="btn btn-primary">Update Department</button>
                
                <a href="{{ route('admin.departments.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
