@extends('layouts.dashboard')

@section('title', 'Pets')

@section('content')
<section class="content-header">
    <h1>
        Pets' Schedule 
        <small>List</small>
	</h1>	
    <ol class="breadcrumb">
        <li>Dashboard</li>
        <li class="active">Schedule List</li>
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
								<td>
									<img src="{{ asset('/images/' . $serviceRequest['pet']['image'])}}" width="50" height="auto">
								</td>
								<td><a href="{{ url('/dashboard/pets/'. $serviceRequest['pet']['id']) }}">{{ $serviceRequest['pet']['name'] }}</a></td>
								<td>{{ $serviceRequest['pet']['breed']['name'] }}</td>
								<td>{{ $serviceRequest['pet']['type']['name'] }}</td>
								<td>{{ $serviceRequest['pet']['user']['first_name'] }}</td>
								<td>{{ $serviceRequest['service']['name'] }}</td>
								<!-- <td>12/12/12 9:10 PM</td> -->
								<td>
								    <small class="label label-success"><i class="fa fa-thumbs-o-up"></i> Confirmed</small>
								</td>
								<td>
                                    {{ date('Y-m-d', strtotime($serviceRequest['schedule'])) }}
                                    <input id="schedule" type="date" value="{{$serviceRequest['schedule']}}">
								</td>
                                <td><button class="btn btn-xs btn-info pull-right" onclick="serviceRequest({{ $serviceRequest['id']}})">Save</button></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
    </section>
@endsection

@section('javascript')
	<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
	<script>
		$(document).ready(function() {
			$('#example').DataTable();
			$('#datetimepicker1').datepicker(function(){
				console.log('aw');
			});

			var dtToday = new Date();
    
			var month = dtToday.getMonth() + 1;
			var day = dtToday.getDate();
			var year = dtToday.getFullYear();
			if(month < 10)
				month = '0' + month.toString();
			if(day < 10)
				day = '0' + day.toString();
			
			var maxDate = year + '-' + month + '-' + day;
			$('#schedule').attr('min', maxDate);	

			// $('#submit').click(function(e) {
            //     e.preventDefault();
            //     var id = $(this).data("id");
            // });
		});
		function serviceRequest(id)
			{
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
			}
	</script>
@stop