@extends('layouts.dashboard')

@section('title', 'Pets')

@section('content')
<section class="content-header">
    <h1>
        Schedule Request
        <small>List</small>
	</h1>	
    <ol class="breadcrumb">
        <li>Dashboard</li>
        <li class="active">Schedule Request</li>
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
						@foreach($serviceRequests as $serviceRequest)
				
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