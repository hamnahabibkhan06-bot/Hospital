@extends('layouts.admin')

@section('title','Add Doctor')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3>Add Doctor</h3>
        </div>

        <div class="card-body">
            @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Please fix the following errors:</strong>

        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <!-- FIXED: Added admin. prefix to store route -->
            <form action="{{ route('admin.doctors.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Department</label>
                        <select name="department_id" class="form-control" required>
                            <option value="">Select Department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Gender</label>
                        <select name="gender" class="form-control">
                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Age</label>
                        <input type="number" name="age" class="form-control" value="{{ old('age') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Qualification</label>
                        <input type="text" name="qualification" class="form-control" value="{{ old('qualification') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Specialization</label>
                        <input type="text" name="specialization" class="form-control" value="{{ old('specialization') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Experience</label>
                        <input type="number" name="experience" class="form-control" value="{{ old('experience') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Consultation Fee</label>
                        <input type="number" name="consultation_fee" class="form-control" value="{{ old('consultation_fee') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Shift</label>
                        <select name="shift" class="form-control">
                            <option value="Morning" {{ old('shift') == 'Morning' ? 'selected' : '' }}>Morning</option>
                            <option value="Evening" {{ old('shift') == 'Evening' ? 'selected' : '' }}>Evening</option>
                            <option value="Night" {{ old('shift') == 'Night' ? 'selected' : '' }}>Night</option>
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Address</label>
                        <textarea name="address" rows="3" class="form-control">{{ old('address') }}</textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Doctor Photo</label>
                        <input type="file" name="image" class="form-control" id="image">
                    </div>

                    <div class="col-md-12 mb-3 text-center">
                        <img id="preview" src="https://via.placeholder.com/180" style="width:180px;height:180px;border-radius:50%;object-fit:cover;">
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success">Save Doctor</button>
                        <!-- FIXED: Added admin. prefix to index route -->
                        <a href="{{ route('admin.doctors.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const imageInput = document.getElementById('image');
    const previewImg = document.getElementById('preview');

    imageInput.onchange = evt => {
        const [file] = imageInput.files;
        if (file) {
            previewImg.src = URL.createObjectURL(file);
        }
    }
</script>
@endpush
