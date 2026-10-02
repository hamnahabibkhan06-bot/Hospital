@extends('layouts.patient')

@section('title','My Prescriptions')

@section('content')

<h3 class="mb-4">

My Prescriptions

</h3>

<div class="card shadow">

<div class="card-body">

<table class="table table-hover">

<thead>

<tr>

<th>#</th>

<th>Doctor</th>

<th>Date</th>

<th></th>

</tr>

</thead>

<tbody>

@forelse($prescriptions as $prescription)

<tr>

<td>

{{ $prescription->id }}

</td>

<td>

Dr.

{{ $prescription->appointment->doctor->name }}

</td>

<td>

{{ $prescription->created_at->format('d M Y') }}

</td>

<td>

<a

class="btn btn-primary btn-sm"

href="{{ route('patient.prescriptions.show',$prescription) }}">

View

</a>

</td>

</tr>

@empty

<tr>

<td colspan="4">

No prescriptions.

</td>

</tr>

@endforelse

</tbody>

</table>

{{ $prescriptions->links() }}

</div>

</div>

@endsection