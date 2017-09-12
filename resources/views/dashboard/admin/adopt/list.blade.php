@extends('layouts.dashboard')

@section('title', 'Pets')

@section('content')
<section class="content-header">
    <h1>
        Adoption List
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
							<th>Age</th>
							<th>Gender</th>
							<th>Breed</th>
							<th>Color</th>
							<th>Type</th>
                            <th>Adopted By</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						@foreach($adopts as $adopt)
                            <tr>
                                <td><img src="{{ asset('/images/' . $adopt->impound->pet->image)}}" width="50" height="auto"></td>
                                <td><a href="{{ url('/dashboard/pets/'. $adopt->impound->pet->id) }}">{{ $adopt->impound->pet->name }}</a></td>
                                <td>{{ $adopt->impound->pet->age }}</td>
                                <td>{{ $adopt->impound->pet->gender }}</td>
                                <td>{{ $adopt->impound->pet->breed }}</td>
                                <td>{{ $adopt->impound->pet->color }}</td>
                                <td>{{ $adopt->impound->pet->type->name }}</td>
                                <td>{{ $adopt->user->first_name }}</td>
                                @if($adopt->is_accepted == 1)
                                    <td><small class="label label-primary"><i class="fa fa-thumbs-o-up"></i> Accepted</small>  </td>
                                @elseif($adopt->is_accepted == 2)
                                    <td><small class="label label-danger"><i class="fa fa-thumbs-o-down"></i> Declined</small></td>
                                @else
                                    <td><small class="label label-warning"><i class="fa fa-thumbs-o-down"></i> Pending</small></td>
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