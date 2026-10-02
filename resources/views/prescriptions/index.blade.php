@extends('layouts.admin')

@section('title', 'Prescriptions')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Prescription Management</h3>
            <a href="{{ route('admin.prescriptions.create') }}" class="btn btn-primary">
                <i class="las la-plus-circle"></i> Create Prescription
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <input type="text" id="searchPrescription" class="form-control"
                            placeholder="Search Patient or Doctor...">
                    </div>
                </div>

                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Patient</th>
                            <th>Doctor</th>
                            <th>Date</th>
                            <th width="220">Actions</th>
                        </tr>
                    </thead>
                    <!-- FIXED: Added prescriptionTable container attribute ID here -->
                    <tbody id="prescriptionTable">
                        @forelse($prescriptions as $prescription)
                            <tr id="row{{ $prescription->id }}">
                                <td>{{ $prescription->id }}</td>
                                <td>{{ $prescription->appointment?->patient?->name ?? 'Deleted Patient' }}</td>
                                <td>Dr. {{ $prescription->appointment?->doctor?->name ?? 'Deleted Doctor' }}</td>
                                <td>{{ $prescription->created_at?->format('d M Y') ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('admin.prescriptions.edit', $prescription->id) }}"
                                        class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <a href="{{ route('admin.prescriptions.show', $prescription->id) }}"
                                        class="btn btn-info btn-sm">
                                        Print
                                    </a>

                                    <button class="btn btn-danger btn-sm deletePrescription" data-id="{{ $prescription->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No Prescriptions Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $prescriptions->links() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function () {
            // FIXED: Event delegation syntax to monitor newly generated AJAX table rows
            $(document).on('click', '.deletePrescription', function () {
                if (!confirm("Delete this prescription?"))
                    return;

                let id = $(this).data('id');

                $.ajax({
                    url: '/admin/prescriptions/' + id,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'DELETE'
                    },
                    success: function () {
                        $('#row' + id).fadeOut(400, function () {
                            $(this).remove();
                        });
                    },
                    error: function () {
                        alert('Delete Failed');
                    }
                });
            });

            // FIXED: Added real-time keyup query lookup handler
            $('#searchPrescription').keyup(function () {
                let search = $(this).val();

                $.ajax({
                    url: "{{ route('admin.prescriptions.index') }}",
                    type: "GET",
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest' // ⚠️ Add this line to force $request->ajax() to be true
                    },
                    data: {
                        search: search
                    },
                    success: function (data) {
                        let rows = '';

                        if (data.length === 0) {
                            rows = '<tr><td colspan="5" class="text-center">No Prescriptions Found</td></tr>';
                        } else {
                            $.each(data, function (index, item) {
                                // Safely handles possible nested structure dependencies if records are empty
                                let patientName = item.appointment && item.appointment.patient ? item.appointment.patient.name : 'Deleted Patient';
                                let doctorName = item.appointment && item.appointment.doctor ? item.appointment.doctor.name : 'Deleted Doctor';
                                let formattedDate = item.created_at ? item.created_at.substring(0, 10) : 'N/A';

                                rows += `
                                        <tr id="row${item.id}">
                                            <td>${item.id}</td>
                                            <td>${patientName}</td>
                                            <td>Dr. ${doctorName}</td>
                                            <td>${formattedDate}</td>
                                            <td>
                                                <a href="/admin/prescriptions/${item.id}/edit" class="btn btn-warning btn-sm">Edit</a>
                                                <a href="/admin/prescriptions/${item.id}" class="btn btn-info btn-sm">Print</a>
                                                <button class="btn btn-danger btn-sm deletePrescription" data-id="${item.id}">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                        `;
                            });
                        }
                        $('#prescriptionTable').html(rows);
                    }
                });
            });
        });
    </script>
@endpush