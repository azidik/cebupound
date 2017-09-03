@extends('layouts.dashboard')

@section('title', 'Pets')

@section('content')
<section class="content-header">
    <h1>
        Pets
        <small>List</small>
	</h1>
	<br>
		<a href="{{ url('/dashboard/pets/create')}}" class="btn btn-info pull-left">Create</button>
	<br>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Dashboard</li>
        <li class="active">Pets</li>
    </ol>
	</section>	
	<br>
    <!-- Main content -->
    <section class="content">
		<div class="box box-primary">
            <div class="box-header">
				<table id="example" class="display" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Name</th>
							<th>Age</th>
							<th>Gender</th>
							<th>Breed</th>
							<th>Color</th>
							<th>Type</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>Name</th>
							<th>Age</th>
							<th>Gender</th>
							<th>Breed</th>
							<th>Color</th>
							<th>Type</th>
						</tr>
					</tfoot>
					<tbody>
						@foreach($pets as $pet)
						<tr>
							<td>{{ $pet->name }}</td>
							<td>{{ $pet->age }}</td>
							<td>{{ $pet->gender }}</td>
							<td>{{ $pet->breed }}</td>
							<td>{{ $pet->color }}</td>
							<td>{{ $pet->type->name }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
    </section>
    <!-- /.content -->
@endsection

@section('javascript')
	<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
	<script>
		$(document).ready(function() {
			$('#example').DataTable();
		});
	</script>
@stop