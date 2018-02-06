@extends('layouts.dashboard')

@section('title', 'Pets')

@section('content')
<section class="content-header">
	<h1>
		Pets Schedule
		<small>List</small>
	</h1>
	
    <ol class="breadcrumb">
        <li><a href="{{ url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
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
							<th>Breed</th>
							<th>Type</th>
                            <th>Service Name</th>
                            <th>Schedule</th>
							<th>Action</th>
						</tr>
					</thead>
                    
					<tbody>
						@foreach($pets as $pet)
                            @if(!isset($pet['impound']) && $pet['is_accepted'] == 1)
                            <tr>
                                <td>
                                    @if(isset($pet['image_mobile']) != NULL)
                                        <img src="{{ $pet['image_mobile'] }}" width="50" height="auto">
                                    @else
                                        <img src="{{ asset('/images/' . $pet['image']) }}" width="50" height="auto">
                                    @endif
                                </td>
                                <td>{{ $pet['name'] }}</td>
                                <td>{{ $pet['breed']['name'] }}</td>
                                <td>{{ $pet['type']['name'] }}</td>
                                <td>
                                    @foreach($pet['service'] as $service)
                                        {{ $service['name'] }}
                                        <br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($pet['service'] as $service)
                                        {{ $service['pivot']['schedule'] }}
                                        <br>
                                    @endforeach
                                </td>
                                <td><button class="btn btn-info btn-xs click-modal" data-toggle="modal" data-id="{{ $pet['id']}}" data-target="#modal-default">Request Schedule</button>
                            </tr>
                            @endif
						@endforeach

                        @foreach($adopts as $adopt)
                            <tr>
                                <td>
                                    @if(isset($adopt['impound']['pet']['image_mobile']) != NULL)
                                        <img src="{{ $adopt['impound']['pet']['image_mobile'] }}" width="50" height="auto">
                                    @else
                                        <img src="{{ asset('/images/' . $adopt['impound']['pet']['image']) }}" width="50" height="auto">
                                    @endif
                                </td>
                                <td>{{ $adopt['impound']['pet']['name'] }}</td>
                                <td>{{ $adopt['impound']['pet']['breed']['name'] }}</td>
                                <td>{{ $adopt['impound']['pet']['type']['name'] }}</td>
                                <td>
                                    @foreach($adopt['impound']['pet']['service'] as $service)
                                        {{ $service['name'] }}
                                        <br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($adopt['impound']['pet']['service'] as $service)
                                        {{ $service['pivot']['schedule'] }}
                                        <br>
                                    @endforeach
                                </td>
                                <td><button class="btn btn-info btn-xs click-modal" data-toggle="modal" data-id="{{ $adopt['impound']['pet']['id'] }}" data-target="#modal-default">Request Schedule</button>
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
                                    <option value="{{$service['id']}}">{{ $service['name'] }}</option>
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
                        service_id: service_id,
                        user_id: "{{ Auth::user()->id }}"
                    },
                    success: function(response) {
                        if(response.status == 1){
                            toastr.success('Requested for service schedule. Thank you!');
                            // location.reload();
                        } else {
                            toastr.error('Pet has already scheduled for this service!');
                            // location.reload();
                        }
                    },
                    error: function(error) {
                        console.log(error)
                    }
                })
            });
		});
	</script>
@stop