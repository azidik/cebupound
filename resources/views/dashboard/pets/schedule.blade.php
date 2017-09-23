@extends('layouts.dashboard')

@section('title', 'Pets')

@section('content')
<section class="content-header">
	<h1>
		Pets Schedule
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
                            <th>Service Name</th>
                            <th>Schedule</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($pets as $pet)
						<tr>
							<td><img src="{{ asset('/images/' . $pet->image)}}" width="50" height="auto"></td>
							<td><a href="{{ url('/dashboard/pets/'. $pet->id) }}">{{ $pet->name }}</a></td>
							<td>{{ $pet->breed }}</td>
							<td>{{ $pet->type->name }}</td>
                            <td>
                                @foreach($pet->service as $service)
                                    {{ $service->name }}
                                @endforeach
                            </td>
                            <td>
                                @foreach($pet->service as $service)
                                    {{ $service->pivot->schedule }}
                                @endforeach
                            </td>
                            
							@if(isset($pet->impound) && $pet->impound->is_accepted == 0) 
								<td>
									<small class="label label-warning"><i class="fa fa-thumbs-o-up"></i> Pending</small>
								<td>
							@else 
								<td><button class="btn btn-info btn-xs click-modal" data-toggle="modal" data-id="{{ $pet->id }}" data-target="#modal-default">Request Schedule</button>
							@endif		
						</tr>
						@endforeach
					</tbody>
				</table>
                <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Services List</h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="pet_id" id="pet_id" value="">
                            <p>Select service</p>
                            <select class="form-control" id="service_id">
                                @foreach($services as $service)
                                    <option value="{{$service->id}}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="submitRequest">Request</button>
                        </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
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
            $(document).on("click", ".click-modal", function () {
                var pet_id = $(this).data('id');
                $('#pet_id').val(pet_id);
            });


            $('#submitRequest').click(function (){
                var pet_id = $('#pet_id').val();
                var service_id = $('#service_id').val();
                $.ajax({
                    method: "POST",
                    url: "/dashboard/pets/schedules/create",
                    data: { 
                        _token: "{{ csrf_token() }}",
                        pet_id: pet_id, 
                        service_id: service_id 
                    },
                    success: function(response) {
                        if(response.status){
                            toastr.success('Reqested for service schedule. Thank you!');
                            location.reload();
                        } else {
                            toastr.error('Something went wrong!');
                            location.reload();
                        }
                    },
                    error: function(error) {
                        console.log(error)
                    }
                })
            });
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
	</script>
@stop