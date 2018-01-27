@extends('layouts.dashboard')

@section('title', 'Pets')

@section('content')
<section class="content-header">
	<h1>
		Pets
		<small>List</small>
	</h1>
	
    @if(Auth::user()->is_admin)
    <ol class="breadcrumb">
        <li>Dashboard</li>
        <li class="active">Pets</li>
    </ol>
    @else
    <ol class="breadcrumb">
        <li><a href="{{ url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Dashboard</li>
        <li class="active">Pets</li>
    </ol>
    @endif
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
					<tbody>
						@foreach($adopts as $adopt)
						<tr>
							<td>
								@if(isset($adopt->impound->pet->image_mobile) != NULL)
									<img src="{{ $adopt->impound->pet->image_mobile }}" width="50" height="auto">
								@else
									<img src="{{ asset('/images/' . $adopt->impound->pet->image)}}" width="50" height="auto">
								@endif
							</td>
							<td><a href="{{ url('/dashboard/pets/'. $adopt->impound->id) }}">{{ $adopt->impound->pet->name }}</a></td>
							<td>{{ $adopt->impound->pet->age }}</td>
							<td>{{ $adopt->impound->pet->gender }}</td>
							<td>{{ $adopt->impound->pet->breed->name }}</td>
							<td>{{ $adopt->impound->pet->color }}</td>
							<td>{{ $adopt->impound->pet->type->name }}</td>		
							<td>
                                @if($adopt->is_accepted) 
                                    <small class="label label-success"><i class="fa fa-thumbs-o-up"></i> Adopted</small>
                                @else
                                    <small class="label label-warning"><i class="fa fa-thumbs-o-down"></i> Pending</small>
                                @endif
                            <td>		
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	<!-- 	<div class="modal fade" id="modal-default">
			<div class="modal-dialog">
				<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Proceed to Impound:</h4>
				</div>
				<div class="modal-body">
                            <label for="exampleInputPassword1">Reason:</label>
                            <textarea name="address" id="reason" cols="3" rows="3" class="form-control" value="reason"></textarea><br>
					
					<label for="exampleInputPassword1">Set Schedule:</label><br>
					<input id="schedule" type="date">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" id="submitRequest">Request</button>
				</div>
				</div>
			</div>
		</div>
		<input type="hidden" id="pet_id" value=""> -->
    </section>
    <!-- /.content -->
@endsection

@section('javascript')
	<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
	<script>
		$(document).ready(function() {
			$('#example').DataTable();
		});
		// $(document).on("click", ".click-modal", function () {
		// 	var pet_id = $(this).data('id');
		// 	$('#pet_id').val(pet_id);
		// });

		// var dtToday = new Date();
    
		// var month = dtToday.getMonth() + 1;
		// var day = dtToday.getDate();
		// var year = dtToday.getFullYear();
		// if(month < 10)
		// 	month = '0' + month.toString();
		// if(day < 10)
		// 	day = '0' + day.toString();
		
		// var maxDate = year + '-' + month + '-' + day;
		// $('#schedule').attr('min', maxDate);

		// $('#submitRequest').click(function() {
		// 	$.ajax({
		// 		type: "POST",
		// 		url: '/dashboard/pets/impound',
		// 		data: {
		// 			_token: "{{ csrf_token() }}",
		// 			reason: $('#reason').val(),
		// 			pet_id: $('#pet_id').val(),
		// 			schedule: $('#schedule').val()
		// 		},
		// 		success: function(response) {
		// 			console.log(response);
		// 			if(response.status == 2) {
		// 				toastr.error('Schedule date is empty. Please input schedule date...');
		// 			}
		// 			else if(response.status == 1){
		// 				toastr.success('Your pet was successfully impounded. Thank you!');
		// 				location.reload();
		// 			} 	else {
		// 				toastr.error('Something went wrong!');
		// 				location.reload();
		// 			}
		// 		},
		// 		error: function(error) {
		// 			console.log(error)
		// 		}
		// 	});
		// });
	</script>
@stop