@extends('layouts.dashboard')

@section('title', 'Pets')

@section('content')
<section class="content-header">
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
							<th>Action</th>
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
							<td>{{ $pet->category->name}}</td>
							<td>{{ $pet->user->last_name . ', ' . $pet->user->first_name}}</td>
							@if($pet->is_accepted == 0) 
							<td>
								<button class="btn btn-info btn-xs" onclick="acceptPet('{{ $pet->id }}')">Accept</button>
								<button class="btn btn-danger btn-xs" onclick="declinePet('{{ $pet->id }}')">Decline</button>
							</td>
							@elseif($pet->is_accepted == 1)
								<td><small class="label label-primary"><i class="fa fa-thumbs-o-up"></i> Accepted</small>  </td>
							@elseif($pet->is_accepted == 2)
								<td><small class="label label-danger"><i class="fa fa-thumbs-o-down"></i> Declined</small></td>
							@endif
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
    </section>
	@endif
    <!-- /.content -->
@endsection

@section('javascript')
	<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
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
		function acceptPet (id) {
            if(confirm('Are you sure you want to accept this pet?')){
                $.ajax({
                    type: "GET",
                    url: '/dashboard/admin/pets/accept/' + id,
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

        function declinePet (id) {
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
	</script>
@stop