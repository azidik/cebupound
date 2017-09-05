@extends('layouts.dashboard')

@section('title', 'Pets')

@section('content')
<section class="content-header">
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
                            <th>Impounded By</th>
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
                            <th>Impounded By</th>
							<th>Action</th>
						</tr>
					</tfoot>
					<tbody>
						@foreach($impounds as $impound)
						<tr>
							<td><img src="{{ asset('/images/' . $impound->pet->image)}}" width="50" height="auto"></td>
							<td><a href="{{ url('/dashboard/pets/'. $impound->pet->id) }}">{{ $impound->pet->name }}</a></td>
							<td>{{ $impound->pet->age }}</td>
							<td>{{ $impound->pet->gender }}</td>
							<td>{{ $impound->pet->breed }}</td>
							<td>{{ $impound->pet->color }}</td>
							<td>{{ $impound->pet->type->name }}</td>
                            <td>{{ $impound->pet->user->first_name }}</td>
							@if($impound->is_accepted == 1)
								<td><button class="btn btn-info btn-xs" disabled="true">Impounded</button></td>
                            @elseif($impound->is_accepted == 2)
                                <td><button class="btn btn-danger btn-xs" disabled="true">Declined</button></td>
                            @else
                                <td>
                                    <button class="btn btn-info btn-xs" onclick="accept('{{ $impound->id }}')">impound</button>
                                    <button class="btn btn-danger btn-xs" onclick="decline('{{ $impound->id }}')">Decline</button>
                                </td>  
							@endif		
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
                            toastr.success('Pet successfully accepted. Thank you!');
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