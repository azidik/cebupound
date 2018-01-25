@extends('layouts.dashboard')

@section('title', 'Pets')

@section('content')
<section class="content-header">
    <h1>
        Adoption Request
        <small>List</small>
	</h1>	
    <ol class="breadcrumb">
        <li>Dashboard</li>
        <li class="active">Adoption Request</li>
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
                            <th>Requested By</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($adopts as $adopt)
							@if($adopt->is_accepted == 0)
								<tr>
									<td>
										@if(isset($adopt->impound->pet->image_mobile) != NULL)
											<img src="{{ $adopt->impound->pet->image_mobile }}" width="50" height="auto">
										@else
											<img src="{{ asset('/images/' . $adopt->impound->pet->image) }}" width="50" height="auto">
										@endif
									</td>
									<td><a href="{{ url('/dashboard/pets/'. $adopt->impound->pet->id) }}">{{ $adopt->impound->pet->name }}</a></td>
									<td>{{ $adopt->impound->pet->age }}</td>
									<td>{{ $adopt->impound->pet->gender }}</td>
									<td>{{ $adopt->impound->pet->breed->name }}</td>
									<td>{{ $adopt->impound->pet->color }}</td>
									<td>{{ $adopt->impound->pet->type->name }}</td>
									<td>{{ $adopt->user->first_name }}</td>
									@if($adopt->is_accepted == 1)
										<td><button class="btn btn-info btn-xs" disabled="true">Adopted</button></td>
									@elseif($adopt->is_accepted == 2)
										<td><button class="btn btn-danger btn-xs" disabled="true">Declined</button></td>
									@else
										<td>
											<button class="btn btn-info btn-xs" onclick="accept('{{ $adopt->id }}')">Accept</button>
											<button class="btn btn-danger btn-xs" onclick="decline('{{ $adopt->id }}')">Decline</button>
										</td>  
									@endif		
								</tr>
							@endif
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
                    url: '/dashboard/admin/adoptAccept/' + id,
                    success: function(response) {
                        if(response.status){
                            toastr.success('Pet successfully adopted. Thank you!');
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
                    url: '/dashboard/admin/adoptDecline/' + id,
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