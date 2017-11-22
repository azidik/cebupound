@extends('layouts.dashboard')

@section('title', 'Pets')

@section('content')
<section class="content-header">
	<h1>
		Medicine
		<small>List</small>
	</h1>
	@if(session()->has('message'))
    <div class="alert alert-primary">
        {{ session()->get('message') }}
    </div>
    @endif
    <ol class="breadcrumb">
        <li>Dashboard</li>
        <li class="active">Medicine List</li>
    </ol>
	</section>	
    <!-- Main content -->
    <section class="content">
	<a href="{{ url('dashboard/admin/pets/pdf/registeredAll') }}" target="_blank" class="btn btn-primary btn-sm pull-right">Print All</a>
	<br>
	<br>	
		<div class="box box-primary">
            <div class="box-header">
				<table id="example" class="display" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Type</th>
							<th>Category</th>
							<th>Name</th>
							<th>Description</th>
							<th>Quantity</th>
							<th>Expiry Date</th>
						</tr>
					</thead>
					<tbody>
						@foreach($inventories as $inventory)
						<tr>
							<td>{{ $inventory->type->name }}</td>
							<td>{{ $inventory->category->name }}</td>
							<td>{{ $inventory->name }}</td>
							<td>{{ $inventory->description }}</td>
							<td>{{ $inventory->quantity }}</td>	
							<td>{{ $inventory->expiry_date}}</td>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
    </section>
@endsection

