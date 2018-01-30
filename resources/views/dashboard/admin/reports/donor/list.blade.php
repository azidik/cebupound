@extends('layouts.dashboard')

@section('title', 'Pets')

@section('content')
<section class="content-header">
	<h1>
		Donor
		<small>List</small>
	</h1>
	@if(session()->has('message'))
    <div class="alert alert-primary">
        {{ session()->get('message') }}
    </div>
    @endif
    <ol class="breadcrumb">
        <li>Dashboard</li>
        <li class="active">Donor List</li>
    </ol>
	</section>	
    <!-- Main content -->
    <section class="content">
	<!-- <a href="{{ url('dashboard/admin/pets/pdf/registeredAll') }}" target="_blank" class="btn btn-primary btn-sm pull-right">Print All</a> -->
	<br>
	<br>	
		<div class="box box-primary">
            <div class="box-header">
				<table id="example" class="display" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Full name</th>
							<th>Contact no</th>
							<th>Company Name</th>
						</tr>
					</thead>
					<tbody>
						@foreach($donors as $donor)
						<tr>
							<td>{{ $donor['last_name'] }} {{ $donor['first_name'] }}</td>
							<td>{{ $donor->contact_no }}</td>
							<td>{{ $donor->company_name }}</td>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
    </section>
@endsection

@section('javascript')
	<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
	<script>
		$(document).ready(function() {
			$('#example').DataTable();
		});
	</script>
@stop
