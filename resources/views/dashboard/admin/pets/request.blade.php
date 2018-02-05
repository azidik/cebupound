@extends('layouts.dashboard')

@section('title', 'Pets')

@section('content')
<section class="content-header">
    <h1>
        Registration Request
        <small>List</small>
	</h1>	
    <ol class="breadcrumb">
        <li>Dashboard</li>
        <li class="active">Registration Request</li>
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
							<th>Category</th>
							<th>Requested By</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($pets as $pet)
							@if($pet['is_accepted'] == 0)
								<tr>
									<td>
									@if(isset($pet['image_mobile']) != NULL)
										<img src="{{ $pet->image_mobile }}" width="50" height="auto">
									@else
										<img src="{{ asset('/images/' . $pet['image'])}}" width="50" height="auto">
									@endif
									</td>
									<td><a href="{{ url('/dashboard/admin/pets/'. $pet['id'])}}">{{ $pet['name'] }}</td>
									<td>{{ $pet['age'] }}</td>
									<td>{{ $pet['gender'] }}</td>
									<td>{{ $pet['breed']['name'] }}</td>
									<td>{{ $pet['color'] }}</td>
									<td>{{ $pet['type']['name'] }}</td>	
									<td>{{ $pet['category']['name'] }}</td>
									<td>{{ $pet->user['last_name'] . ', ' . $pet->user['first_name'] }}</td>
									<td>
										<button class="btn btn-info btn-xs" onclick="accept('{{ $pet['id'] }}')">Accept</button>
										<button class="btn btn-danger btn-xs" onclick="decline('{{ $pet['id'] }}')">Decline</button>
									</td>  		
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
                    url: '/dashboard/admin/pets/accept/' + id,
                    success: function(response) {
                        if(response.status){
                            toastr.success('Pet successfully registered. Thank you!');
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
                    url: '/dashboard/admin/pets/decline/' + id,
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