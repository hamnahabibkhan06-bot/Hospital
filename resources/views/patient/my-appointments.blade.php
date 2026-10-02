@extends('layouts.patient')

@section('title','My Appointments')

@section('content')

<h3 class="mb-4">

My Appointments

</h3>

@if(session('success'))

<div class="alert alert-success">

{{ session('success') }}

</div>

@endif

<div class="card shadow">

<div class="card-body">

<table class="table table-bordered">

<thead>

<tr>

<th>Token</th>

<th>Doctor</th>

<th>Date</th>

<th>Time</th>

<th>Problem</th>

<th>Status</th>

</tr>

</thead>

<tbody>

@forelse($appointments as $appointment)

<tr>

<td>

{{ $appointment->token_no }}

</td>

<td>

Dr. {{ $appointment->doctor->name }}

</td>

<td>

{{ $appointment->appointment_date }}

</td>

<td>

{{ $appointment->appointment_time }}

</td>

<td>

{{ $appointment->problem }}

</td>

<td>

@if($appointment->status=='Pending')

<span class="badge bg-warning">

Pending

</span>

@elseif($appointment->status=='Approved')

<span class="badge bg-primary">

Approved

</span>

@elseif($appointment->status=='Completed')

<span class="badge bg-success">

Completed

</span>

@else

<span class="badge bg-danger">

Cancelled

</span>

@endif

</td>

</tr>

@empty

<tr>

<td colspan="6">

No Appointments Found

</td>

</tr>

@endforelse

</tbody>

</table>

{{ $appointments->links() }}

</div>

</div>

@endsection