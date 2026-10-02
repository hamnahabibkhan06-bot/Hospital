@extends('layouts.doctor')

@section('title', 'Appointments')

@section('content')
    <h3 class="mb-4">My Appointments</h3>

    <div id="message"></div>

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Token</th>
                        <th>Patient</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Problem</th>
                        <th>Status</th>
                        <th width="220">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                        <tr id="row{{ $appointment->id }}">
                            <td>{{ $appointment->token_no }}</td>
                            <td>{{ $appointment->patient?->name ?? 'Deleted Patient' }}</td>
                            <td>{{ $appointment->appointment_date }}</td>
                            <td>{{ $appointment->appointment_time }}</td>
                            <td>{{ $appointment->problem }}</td>
                            <td>
                                <span class="badge bg-info status">
                                    {{ $appointment->status }}
                                </span>
                            </td>
                            <td>
                                @if($appointment->status == 'Pending')
                                    <button class="btn btn-success btn-sm update-status" data-id="{{ $appointment->id }}" data-status="Approved">
                                        Approve
                                    </button>
                                    <button class="btn btn-danger btn-sm update-status" data-id="{{ $appointment->id }}" data-status="Cancelled">
                                        Cancel
                                    </button>
                                @elseif($appointment->status == 'Approved')
                                    <button class="btn btn-primary btn-sm update-status" data-id="{{ $appointment->id }}" data-status="Completed">
                                        Complete
                                    </button>
                                    <button class="btn btn-danger btn-sm update-status" data-id="{{ $appointment->id }}" data-status="Cancelled">
                                        Cancel
                                    </button>
                                @elseif($appointment->status == 'Completed')
                                    <span class="badge bg-success">Completed</span>
                                    <br><br>
                                    <!-- FIXED: Explicitly named the parameter mapping to resolve UrlGenerationException -->
                                    <a href="{{ route('doctor.prescriptions.create', ['appointment' => $appointment->id]) }}" class="btn btn-warning btn-sm">
                                        Prescription
                                    </a>
                                @else
                                    <span class="badge bg-danger">Cancelled</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $appointments->links() }}
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function () {
            $('.update-status').click(function(){
                let button = $(this);
                let id = button.data('id');
                let status = button.data('status');

                $.ajax({
                    url: '/doctor/appointments/' + id + '/status',
                    type: 'PATCH',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: status
                    },
                    success: function(){
                        location.reload();
                    },
                    error: function() {
                        alert('Failed to update status.');
                    }
                });
            });
        });
    </script>
@endpush
