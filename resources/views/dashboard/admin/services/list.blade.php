@extends('layouts.dashboard')

@section('title', 'Pets')

@section('content')
<section class="content-header">
<<<<<<< HEAD
	<h1>
		Pets
		<small>List</small>
	</h1>
	@if(session()->has('message'))
    <div class="alert alert-primary">
        {{ session()->get('message') }}
    </div>
    @endif

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
    @if(Auth::user()->is_admin)
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
							<th>Category</th>
							<th>Owner</th>
						</tr>
					</thead>
					<tbody>
						@foreach($pets as $pet)
						<tr>
							<td><img src="{{ asset('/images/' . $pet->image)}}" width="50" height="auto"></td>
							<td><a href="{{ url('/dashboard/admin/pets/'. $pet->id)}}">{{ $pet->name }}</td>
							<td>{{ $pet->age }}</td>
							<td>{{ $pet->gender }}</td>
							<td>{{ $pet->breed }}</td>
							<td>{{ $pet->color }}</td>
							<td>{{ $pet->type->name }}</td>	
							<th>{{ $pet->category->name}}</th>
							<th>{{ $pet->user->last_name . ', ' . $pet->user->first_name}}</th>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
    </section>
    @else
=======
    <h1>
        Impound Request
        <small>List</small>
	</h1>	
    <ol class="breadcrumb">
        <li><a href="{{ url('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Dashboard</li>
        <li class="active">Pets</li>
    </ol>
	</section>	
	<br>
    <!-- Main content -->
>>>>>>> 285dbd10e6ec897be9c592007055415f8dace665
    <section class="content">
		<div class="box box-primary">
            <div class="box-header">
				<table id="example" class="display" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Image</th>
							<th>Name</th>
<<<<<<< HEAD
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
								<td><button class="btn btn-info btn-xs" disabled="true">Impounded</button><td>
							@elseif(isset($pet->impound) && $pet->impound->is_accepted == 2)
							<td><button class="btn btn-danger btn-xs" disabled="true">Declined</button><td>
							@else 
								<td><button class="btn btn-info btn-xs" onclick="impound('{{$pet->id}}')">Proceed to impound</button>
							@endif		
						</tr>
=======
							<th>Breed</th>
							<th>Type</th>
                            <th>Owner Name</th>
							<th>Service Request</th>
							<th>Status</th>
							<th>Service Scheduled</th>
							<!-- <th>Status</th> -->
						</tr>
					</thead>
					<tbody>
						@foreach($serviceScheduleList as $list)
							<tr>
								<td><img src="{{ asset('/images/' . $list->pet->image)}}" width="50" height="auto"></td>
								<td><a href="{{ url('/dashboard/pets/'. $list->pet->id) }}">{{ $list->pet->name }}</a></td>
								<td>{{ $list->pet->breed }}</td>
								<td>{{ $list->pet->type->name }}</td>
								<td>{{ $list->pet->user->first_name }}</td>
								<td>{{ $list->service->name }}</td>
								<!-- <td>12/12/12 9:10 PM</td> -->
								<td>
									@if($list->status == 'Pending')
										<small class="label label-warning"><i class="fa fa-thumbs-o-down"></i> Pending</small>
									@else
										<small class="label label-success"><i class="fa fa-thumbs-o-up"></i> Confirmed</small>
									@endif
								</td>
								<td>
									<div class='input-group date' id='datetimepicker1' style="width: 70%;" data-id="{{ $list->id }}">
										<input type='text' class="form-control" id="schedule" value="{{ $list->schedule }}"/>
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</td>
							</tr>
>>>>>>> 285dbd10e6ec897be9c592007055415f8dace665
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
    </section>
<<<<<<< HEAD
    @endif
=======
>>>>>>> 285dbd10e6ec897be9c592007055415f8dace665
    <!-- /.content -->
@endsection

@section('javascript')
	<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<<<<<<< HEAD
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
=======



	<script>
		$(document).ready(function() {
			$('#example').DataTable();
			$('#datetimepicker1').datepicker(function(){
				console.log('aw');
			});

			$("#datetimepicker1").change(function() {
				var scheduleDate = $(this).datepicker("getDate");
				var id = $(this).data("id");
				$.ajax({
                    type: "POST",
                    url: '/dashboard/admin/serviceSchedule/setDate',
					data: {
						_token: '{{ csrf_token() }}',
						id: id,
						scheduleDate: scheduleDate
					},
                    success: function(response) {
                        if(response.status){
                            toastr.success('Pet successfully booked for services. Thank you!');
                            setTimeout(function() {
                                location.reload();    
                            }, 3000);
                        } else {
                            toastr.error('Something went wrong!');
                            setTimeout(function() {
                                location.reload();    
                            }, 3000);
                        }
                    },
                    error: function(error) {
                        console.log(error)
                    }
                });
			});
		});

        function accept (id) {
            if(confirm('Are you sure you want to accept this pet?')){
                $.ajax({
                    type: "GET",
                    url: '/dashboard/admin/impoundAccept/' + id,
                    success: function(response) {
                        if(response.status){
                            toastr.success('Pet successfully impounded. Thank you!');
                            setTimeout(function() {
                                location.reload();    
                            }, 3000);
                        } else {
                            toastr.error('Something went wrong!');
                            setTimeout(function() {
                                location.reload();    
                            }, 3000);
                        }
                    },
                    error: function(error) {
                        console.log(error)
                    }
                });
            }
        }

        function decline (id) {
            if(confirm('Are you sure you want to decline this pet?')){
                $.ajax({
                    type: "GET",
                    url: '/dashboard/admin/impoundDecline/' + id,
                    success: function(response) {
                        if(response.status){
                            toastr.success('Pet successfully declined. Thank you!');
                            setTimeout(function() {
                                location.reload();    
                            }, 3000);
                        } else {
                            toastr.error('Something went wrong!');
                            setTimeout(function() {
                                location.reload();    
                            }, 3000);
                        }
                    },
                    error: function(error) {
                        console.log(error)
                    }
                });
            }
        }
>>>>>>> 285dbd10e6ec897be9c592007055415f8dace665
	</script>
@stop