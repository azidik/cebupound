@extends('layouts.dashboard')

@section('title', 'Pets')

@section('content')
<section class="content-header">
    <h1>
        Impound Request
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
						@foreach($serviceScheduleLists as $serviceRequest)
							<tr>
								<td><img src="{{ asset('/images/' . $serviceRequest->pet->image)}}" width="50" height="auto"></td>
								<td><a href="{{ url('/dashboard/pets/'. $serviceRequest->pet->id) }}">{{ $serviceRequest->pet->name }}</a></td>
								<td>{{ $serviceRequest->pet->breed }}</td>
								<td>{{ $serviceRequest->pet->type->name }}</td>
								<td>{{ $serviceRequest->pet->user->first_name }}</td>
								<td>{{ $serviceRequest->service->name }}</td>
								<!-- <td>12/12/12 9:10 PM</td> -->
								<td>
								    <small class="label label-success"><i class="fa fa-thumbs-o-up"></i> Confirmed</small>
								</td>
								<td>
									<div class='input-group date' id='datetimepicker1' style="width: 70%;" data-id="{{ $serviceRequest->id }}">
										<input type='text' class="form-control" id="schedule" value="{{ $serviceRequest->schedule }}"/>
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</td>
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
			$('#datetimepicker1').datepicker(function(){
				console.log('aw');
			});

			$("#datetimepicker1").change(function() {
				var scheduleDate = $(this).datepicker({ dateFormat: 'dd,MM,yyyy' }); 
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
                                // location.reload();    
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
	</script>
@stop