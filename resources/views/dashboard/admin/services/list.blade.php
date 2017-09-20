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
                            <th>Action</th>
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
                                    {{ $serviceRequest->schedule }}
                                    <input id="schedule" type="datetime-local" value="{{$serviceRequest->schedule}}">
								</td>
                                <td><button type="submit" class="btn btn-xs btn-info pull-right" id="submit" data-id="{{ $serviceRequest->id }}">Save</button></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
    </section>
    <!-- /.content -->
    <!-- <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/smoothness/jquery-ui.css" type="text/css" media="all" />
    <style>
        .ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }
        .ui-timepicker-div dl { text-align: left; }
        .ui-timepicker-div dl dt { height: 25px; margin-bottom: -25px; }
        .ui-timepicker-div dl dd { margin: 0 10px 10px 65px; }
        .ui-timepicker-div td { font-size: 90%; }
        .ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }
        .ui-timepicker-rtl{ direction: rtl; }
        .ui-timepicker-rtl dl { text-align: right; }
        .ui-timepicker-rtl dl dd { margin: 0 65px 10px 10px; }
    </style> -->
@endsection

@section('javascript')
	<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
	<script>
		$(document).ready(function() {
			$('#example').DataTable();
			$('#datetimepicker1').datepicker(function(){
				console.log('aw');
			});

			$('#submit').click(function(e) {
                e.preventDefault();
                var id = $(this).data("id");
				$.ajax({
                    type: "POST",
                    url: '/dashboard/admin/serviceSchedule/setDate',
					data: {
						_token: '{{ csrf_token() }}',
						id: id,
						scheduleDate: $('#schedule').val()
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
	</script>
@stop