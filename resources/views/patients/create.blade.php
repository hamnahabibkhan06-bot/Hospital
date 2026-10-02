@extends('layouts.admin')

@section('title','Add Patient')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h3>Add Patient</h3>
        </div>

        <div class="card-body">
            <!-- FIXED: Added admin. prefix to store route -->
            <form method="POST" action="{{ route('admin.patients.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Gender</label>
                        <select name="gender" class="form-control">
                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Age</label>
                        <input type="number" name="age" class="form-control" value="{{ old('age') }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>DOB</label>
                        <input type="date" name="dob" class="form-control" value="{{ old('dob') }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Blood Group</label>
                        <select name="blood_group" class="form-control">
                            @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $bg)
                                <option value="{{ $bg }}" {{ old('blood_group') == $bg ? 'selected' : '' }}>{{ $bg }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Address</label>
                        <textarea name="address" class="form-control">{{ old('address') }}</textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Guardian Name</label>
                        <input type="text" name="guardian_name" class="form-control" value="{{ old('guardian_name') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Guardian Phone</label>
                        <input type="text" name="guardian_phone" class="form-control" value="{{ old('guardian_phone') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Occupation</label>
                        <input type="text" name="occupation" class="form-control" value="{{ old('occupation') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Marital Status</label>
                        <select name="marital_status" class="form-control">
                            <option value="Single" {{ old('marital_status') == 'Single' ? 'selected' : '' }}>Single</option>
                            <option value="Married" {{ old('marital_status') == 'Married' ? 'selected' : '' }}>Married</option>
                            <option value="Widowed" {{ old('marital_status') == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Patient Image</label>
                        <input type="file" id="image" name="image" class="form-control">
                    </div>

                    <div class="col-md-12 text-center mb-3">
                        <img id="preview" src="https://via.placeholder.com/180" style="width:180px;height:180px;border-radius:50%;object-fit:cover;">
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success">Save Patient</button>
                        <a href="{{ route('admin.patients.index') }}" class="btn btn-secondary">Cancel</a>
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

    imageInput.onchange = e => {
        const [file] = imageInput.files;
        if (file) {
            previewImg.src = URL.createObjectURL(file);
        }
    }
</script>
@endpush
