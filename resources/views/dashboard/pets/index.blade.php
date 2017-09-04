@extends('layouts.dashboard')

@section('title', 'Pets')

@section('content')
<section class="content-header">
    <h1>
        Pets
        <small>List</small>
	</h1>
	<br>
		<a href="{{ url('/dashboard/pets/create')}}" class="btn btn-info pull-left">Create</a>
	<br>
    <ol class="breadcrumb">
        <li><a href="{{ url('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
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
							<th>Image</th>
							<th>Name</th>
							<th>Age</th>
							<th>Gender</th>
							<th>Breed</th>
							<th>Color</th>
							<th>Type</th>
							<th>Action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>Image</th>
							<th>Name</th>
							<th>Age</th>
							<th>Gender</th>
							<th>Breed</th>
							<th>Color</th>
							<th>Type</th>
							<th>Action</th>
						</tr>
					</tfoot>
					<tbody>
						@foreach($pets as $pet)
						<tr>
							<td><img src="{{ asset('/images/' . $pet->image)}}" width="50" height="auto"></td>
							<td><a href="{{ url('/dashboard/pets/'. $pet->id) }}">{{ $pet->name }}</a></td>
							<td>{{ $pet->age }}</td>
							<td>{{ $pet->gender }}</td>
							<td>{{ $pet->breed }}</td>
							<td>{{ $pet->color }}</td>
							<td>{{ $pet->type->name }}</td>
							@if(isset($pet->impound) && $pet->impound->is_accepted == 0) 
								<td><button class="btn btn-warning btn-xs" disabled="true">Pending</button><td>
							@elseif(isset($pet->impound) && $pet->impound->is_accepted == 1)
								<td><button class="btn btn-info btn-xs" disabled="true">Accepted</button><td>
							@elseif(isset($pet->impound) && $pet->impound->is_accepted == 2)
							<td><button class="btn btn-danger btn-xs" disabled="true">Declined</button><td>
							@else 
								<td><button class="btn btn-info btn-xs" onclick="impound('{{$pet->id}}')">Proceed to impound</button>
							@endif		
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

		function impound (id) {
			$.ajax({
				type: "GET",
				url: '/dashboard/pets/impound/' + id,
				success: function(response) {
					if(response.status){
						toastr.success('Your pet was successfully impounded. Thank you!');
						location.reload();
					} else {
						toastr.error('Something went wrong!');
						location.reload();
					}
				},
				error: function(error) {
					console.log(error)
				}
			});
		}
	</script>
@stop