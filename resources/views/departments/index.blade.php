@extends('layouts.admin')

@section('title', 'Departments')

@section('content')
    <div class="container-fluid mt-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Departments</h2>

            <a href="{{ route('admin.departments.create') }}" class="btn btn-primary">
                Add Department
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow rounded-4">
            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle mb-0">

                        <thead class="table-light">
                            <tr>
                                <th width="70">ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th width="180">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($departments as $department)
                                <tr>
                                    <td>{{ $department->id }}</td>

                                    <td>{{ $department->name }}</td>

                                    <td>{{ $department->description }}</td>

                                    <td>

                                        <a href="{{ route('admin.departments.edit', $department) }}"
                                            class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.departments.destroy', $department) }}" method="POST"
                                            class="d-inline">

                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Delete Department?')">

                                                Delete

                                            </button>

                                        </form>

                                    </td>
                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4" class="text-center py-4">

                                        No Departments Found

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{-- {{ $departments->links() }} --}}
                </div>

            </div>
        </div>

    </div>
@endsection