@extends('layouts.dashboard')

@section('title', 'Pets')

@section('content')
<section class="content-header">
	<h1>
		Pets
		<small>List</small>
	</h1>
	@if(session()->has('message'))
    <div class="alert alert-primary">
        {{ session()->get('message') }}
    </div>
    @endif
    <ol class="breadcrumb">
        <li>Dashboard</li>
        <li class="active">Pet List</li>
    </ol>
	</section>	
    <!-- Main content -->
    <section class="content">
	<!-- <a href="{{ url('dashboard/admin/pets/pdf/registeredAll/dogs') }}" target="_blank" class="btn btn-primary btn-sm pull-right">Print All Dogs</a>
	<a href="{{ url('dashboard/admin/pets/pdf/registeredAll/cats') }}" target="_blank" class="btn btn-primary btn-sm pull-right">Print All Cats</a>
	<br> -->
	<br>	
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
							<th>Category</th>
							<th>Owner</th>
							<!-- <th>Action</th> -->
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						@foreach($pets as $pet)
						<tr>
							<td>
								<img src="{{ asset('/images/' . $pet['image'])}}" width="50" height="auto">
							</td>
							<td><a href="{{ url('/dashboard/admin/pets/'. $pet['id'])}}">{{ $pet['name'] }}</td>
							<td>{{ $pet['age'] }}</td>
							<td>{{ $pet['gender'] }}</td>
							<td>{{ $pet['breed']['name'] }}</td>
							<td>{{ $pet['color'] }}</td>
							<td>{{ $pet['type']['name'] }}</td>	
							<td>{{ $pet['category']['name'] }}</td>
							<td>{{ $pet['user']['last_name'] }} {{ $pet['user']['first_name'] }}</td>
							@if($pet['is_accepted'] == 1)
								@if(isset($pet['impound']) && $pet['impound']['is_accepted'] == 1)
								<td><small class="label label-primary"><i class="fa fa-thumbs-o-up"></i> Impounded</small><td>
								@elseif(isset($pet['adopt']) && $pet['adopt']['is_accepted'] == 1)
								<td><small class="label label-warning"><i class="fa fa-thumbs-o-up"></i> Adopted</small></td>
								@else	
								<td><small class="label label-primary"><i class="fa fa-thumbs-o-up"></i> Registered</small></td>
								@endif
							@elseif($pet['is_accepted'] == 2)
								<td><small class="label label-danger"><i class="fa fa-thumbs-o-down"></i> Declined</small></td>
							@elseif($pet['is_accepted'] == 0)
								<td><button class="btn btn-warning btn-xs" disabled="true">Pending</button><td>
							@endif
							<!-- <td><a href="{{ url('dashboard/admin/pets/pdf/registered/'. $pet['id']) }}" target="_blank" class="btn btn-primary btn-xs">Print</a></td> -->
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