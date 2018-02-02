@extends('layouts.dashboard')

@section('title', 'Pets')

@section('content')
<section class="content-header">
	<h1>
		Pets
		<small>List</small>
	</h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
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
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						@foreach($pets as $pet)
							@if(!isset($pet['impound']))
								<tr>
									<td>
										@if(isset($pet['image_mobile']) != NULL)
											<img src="{{ $pet['image_mobile'] }}" width="50" height="auto">
										@else
											<img src="{{ asset('/images/' . $pet['image'])}}" width="50" height="auto">
										@endif
									</td>
									<td><a href="{{ url('/dashboard/pets/'. $pet['id']) }}">{{ $pet['name'] }}</a></td>
									<td>{{ $pet['age'] }}</td>
									<td>{{ $pet['gender'] }}</td>
									<td>{{ $pet['breed']['name'] }}</td>
									<td>{{ $pet['color'] }}</td>
									<td>{{ $pet['type']['name'] }}</td>
									@if($pet['is_accepted'] == 1)
										<td>
											<small class="label label-primary"><i class="fa fa-thumbs-o-up"></i> Registered</small>
										</td>
									@elseif($pet['is_accepted'] == 0)
										<td>
											<small class="label label-warning"><i class="fa fa-thumbs-o-up"></i> Pending for registration</small>
										</td>
									@else
										<td>
											<small class="label label-danger"><i class="fa fa-thumbs-o-up"></i> Declined for registration</small>
										</td>
									@endif
								</tr>
							@endif
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="box-footer">
            <a href="{{ url('dashboard/pets/create') }}" type="submit" class="btn btn-primary pull-right">Register a New Pet</a>
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