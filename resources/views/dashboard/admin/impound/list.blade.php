@extends('layouts.dashboard')

@section('title', 'Pets')

@section('content')
<section class="content-header">
    <h1>
        Impound List
        <small>List</small>
	</h1>	
    <ol class="breadcrumb">
        <li>Dashboard</li>
        <li class="active">Impound List</li>
    </ol>
	</section>	
	<br>
    <!-- Main content -->
    
    <section class="content">
    <!-- <a href="{{ url('dashboard/admin/pets/pdf/impoundAll/dogs') }}" target="_blank" class="btn btn-primary btn-sm pull-right">Print All Dogs</a>
    <a href="{{ url('dashboard/admin/pets/pdf/impoundAll/cats') }}" target="_blank" class="btn btn-primary btn-sm pull-right" style="margin-right: 10px;">Print All Cats</a>
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
                            <th>Impounded By</th>
							<th>Status</th>
                            <th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($impounds as $impound)
                            <tr>
                                <td><img src="{{ asset('/images/' . $impound['pet']['image'])}}" width="50" height="auto"></td>
                                <td><a href="{{ url('/dashboard/pets/'. $impound['pet']['id']) }}">{{ $impound['pet']['name'] }}</a></td>
                                <td>{{ $impound['pet']['age'] }}</td>
                                <td>{{ $impound['pet']['gender'] }}</td>
                                <td>{{ $impound['pet']['breed']['name'] }}</td>
                                <td>{{ $impound['pet']['color'] }}</td>
                                <td>{{ $impound['pet']['type']['name'] }}</td>
                                <td>{{ $impound['pet']['user']['first_name'] }}</td>
                                @if($impound['is_accepted'] == 0) 
                                    <td><button class="btn btn-warning btn-xs" disabled="true">Pending</button><td>
                                @elseif($impound['is_accepted'] == 1)
                                    <td><small class="label label-primary"><i class="fa fa-thumbs-o-up"></i> Accepted</small></td>
                                @elseif($impound['is_accepted'] == 2)
                                    <td><small class="label label-danger"><i class="fa fa-thumbs-o-down"></i> Declined</small></td>
                                @endif		
                                <td><a href="{{ url('dashboard/admin/pets/pdf/impound/'. $impound['id']) }}" target="_blank" class="btn btn-primary btn-xs">Print</a></td>
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
		// function impound (id) {
		// 	$.ajax({
		// 		type: "GET",
		// 		url: '/dashboard/pets/impound/' + id,
		// 		success: function(response) {
		// 			if(response.status){
		// 				toastr.success('Your pet was successfully impounded. Thank you!');
		// 				location.reload();
		// 			} else {
		// 				toastr.error('Something went wrong!');
		// 				location.reload();
		// 			}
		// 		},
		// 		error: function(error) {
		// 			console.log(error)
		// 		}
		// 	});
		// }
	</script>
@stop