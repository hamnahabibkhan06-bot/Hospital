@extends('layouts.admin')

@section('title', 'Edit Doctor')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3>Edit Doctor</h3>
        </div>

        <div class="card-body">
            <!-- FIXED: Added admin. prefix to update route -->
            <form action="{{ route('admin.doctors.update', $doctor) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $doctor->name) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $doctor->email) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Password (Leave blank to keep current)</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $doctor->phone) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Department</label>
                        <select name="department_id" class="form-control" required>
                            <option value="">Select Department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ old('department_id', $doctor->department_id) == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Gender</label>
                        <select name="gender" class="form-control" required>
                            <option value="Male" {{ old('gender', $doctor->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender', $doctor->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Age</label>
                        <input type="number" name="age" class="form-control" value="{{ old('age', $doctor->age) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Qualification</label>
                        <input type="text" name="qualification" class="form-control" value="{{ old('qualification', $doctor->qualification) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Specialization</label>
                        <input type="text" name="specialization" class="form-control" value="{{ old('specialization', $doctor->specialization) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Experience (Years)</label>
                        <input type="number" name="experience" class="form-control" value="{{ old('experience', $doctor->experience) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Consultation Fee</label>
                        <input type="number" name="consultation_fee" class="form-control" value="{{ old('consultation_fee', $doctor->consultation_fee) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Shift</label>
                        <select name="shift" class="form-control" required>
                            <option value="Morning" {{ old('shift', $doctor->shift) == 'Morning' ? 'selected' : '' }}>Morning</option>
                            <option value="Evening" {{ old('shift', $doctor->shift) == 'Evening' ? 'selected' : '' }}>Evening</option>
                            <option value="Night" {{ old('shift', $doctor->shift) == 'Night' ? 'selected' : '' }}>Night</option>
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Address</label>
                        <textarea name="address" rows="3" class="form-control" required>{{ old('address', $doctor->address) }}</textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Doctor Photo</label>
                        <input type="file" name="image" class="form-control" id="image">
                    </div>

                    <div class="col-md-12 mb-3 text-center">
                        <img id="preview" src="{{ $doctor->image ? asset('doctor-images/'.$doctor->image) : 'https://via.placeholder.com/180' }}" style="width:180px;height:180px;border-radius:50%;object-fit:cover;">
                    </div>

                    <div class="col-md-6 mb-4">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ old('status', $doctor->status) == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $doctor->status) == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success">Update Doctor</button>
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
