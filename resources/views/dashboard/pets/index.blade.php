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
							<th>Schedule</th>
							<th>Status</th>
						</tr>
					</thead>
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
							<td>
								@if(isset($pet->impound->surrendered_at)  && $pet->impound->surrendered_at != NULL) 
									{{ $pet->impound->surrendered_at }}
								@else
									N/A
								@endif
							</td>
							@if(isset($pet->impound) && $pet->impound->is_accepted == 0) 
								<td>
									<small class="label label-warning"><i class="fa fa-thumbs-o-up"></i> Pending</small>
								<td>
							@elseif(isset($pet->impound) && $pet->impound->is_accepted == 1)
								<td>
									<small class="label label-primary"><i class="fa fa-thumbs-o-up"></i> Impounded</small>
								</td>
							@elseif(isset($pet->impound) && $pet->impound->is_accepted == 2)
								<td>
									<small class="label label-danger"><i class="fa fa-thumbs-o-up"></i> Declined</small>
								<td>
							@else 
								<td><button class="btn btn-info btn-xs click-modal" data-toggle="modal" data-id="{{ $pet->id }}" data-target="#modal-default">Proceed to impound</button>
							@endif		
							@if(isset($pet->adopt) && $pet->adopt->is_accepted == 1)
								<td>
									<small class="label label-warning"><i class="fa fa-thumbs-o-up"></i> Adopted</small>
								</td>
							@elseif(isset($pet->impound) && $pet->impound->is_accepted == 1)
								<td>
									<small class="label label-primary"><i class="fa fa-thumbs-o-up"></i> Impounded</small>
								<td>
							@elseif($pet->is_accepted == 0)
								<td>
									<small class="label label-warning"><i class="fa fa-thumbs-o-up"></i> Pending</small>
								</td>
							@else
								<td>
									<small class="label label-danger"><i class="fa fa-thumbs-o-up"></i> Registered</small>
								</td>
							@endif
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="modal fade" id="modal-default">
			<div class="modal-dialog">
				<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Services List</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" name="pet_id" id="pet_id" value="">
					<p>Select service</p>
					<input id="schedule" type="datetime-local">
					<div class="form-group">
					<label for="exampleInputFile">Reason</label>
					<textarea name="reason" id="reason" cols="10" rows="10" class="form-control"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" id="submitRequest">Request</button>
				</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
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
		$(document).on("click", ".click-modal", function () {
			var pet_id = $(this).data('id');
			$('#pet_id').val(pet_id);
		});
		$('#submitRequest').click(function() {
			$.ajax({
				type: "POST",
				url: '/dashboard/pets/impound',
				data: {
					_token: "{{ csrf_token() }}",
					pet_id: $('#pet_id').val(),
					schedule: $('#schedule').val(),
					reason: $('#reason').val()
				},
				success: function(response) {
					console.log(response);
					if(response.status == 2) {
						toastr.error('Schedule date is empty. Please input schedule date...');
					}
					else if(response.status == 1){
						toastr.success('Your pet was successfully impounded. Thank you!');
						location.reload();
					} 	else {
						toastr.error('Something went wrong!');
						location.reload();
					}
				},
				error: function(error) {
					console.log(error)
				}
			});
		});
	</script>
@stop