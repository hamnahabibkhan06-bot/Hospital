@extends('layouts.admin')

@section('title','Edit Patient')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-warning">
            <h3>Edit Patient: {{ $patient->patient_code }}</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.patients.update', $patient) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $patient->name) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $patient->email) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $patient->phone) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Gender</label>
                        <select name="gender" class="form-control">
                            <option value="Male" {{ old('gender', $patient->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender', $patient->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Age</label>
                        <input type="number" name="age" class="form-control" value="{{ old('age', $patient->age) }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>DOB</label>
                        <input type="date" name="dob" class="form-control" value="{{ old('dob', $patient->dob) }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Blood Group</label>
                        <select name="blood_group" class="form-control">
                            @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $bg)
                                <option value="{{ $bg }}" {{ old('blood_group', $patient->blood_group) == $bg ? 'selected' : '' }}>{{ $bg }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Address</label>
                        <textarea name="address" class="form-control">{{ old('address', $patient->address) }}</textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Guardian Name</label>
                        <input type="text" name="guardian_name" class="form-control" value="{{ old('guardian_name', $patient->guardian_name) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Guardian Phone</label>
                        <input type="text" name="guardian_phone" class="form-control" value="{{ old('guardian_phone', $patient->guardian_phone) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Occupation</label>
                        <input type="text" name="occupation" class="form-control" value="{{ old('occupation', $patient->occupation) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Marital Status</label>
                        <select name="marital_status" class="form-control">
                            <option value="Single" {{ old('marital_status', $patient->marital_status) == 'Single' ? 'selected' : '' }}>Single</option>
                            <option value="Married" {{ old('marital_status', $patient->marital_status) == 'Married' ? 'selected' : '' }}>Married</option>
                            <option value="Widowed" {{ old('marital_status', $patient->marital_status) == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Patient Image</label>
                        <input type="file" id="image" name="image" class="form-control">
                    </div>

                    <div class="col-md-12 text-center mb-3">
                        <img id="preview" src="{{ $patient->image ? asset('patient-images/'.$patient->image) : 'https://via.placeholder.com/180' }}" style="width:180px;height:180px;border-radius:50%;object-fit:cover;">
                    </div>

                    <div class="col-md-6 mb-4">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ old('status', $patient->status) == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $patient->status) == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Update Patient</button>
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
