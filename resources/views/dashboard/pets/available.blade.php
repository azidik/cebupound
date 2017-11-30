@extends('layouts.dashboard')

@section('title', 'Pets')

@section('content')
<section class="content-header">
	<h1>
		Pets
		<small>Available for Adoption</small>
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
				<dic class="row">
					@foreach($available_adoptions as $available_adoption)
						@if(count($available_adoption['adopt']) > 0 && $available_adoption['adopt']['adopted_by'] == 0)
							<div class="col-md-3">
								<div class="box-body box-profile" style="border: 1px solid #eee">
									<img class="profile-user-img img-responsive img-circle" src="{{ asset('images/'. $available_adoption['pet']['image']) }}" alt="User profile picture">

									<h3 class="profile-username text-center">{{ $available_adoption['pet']['name'] }}</h3>

									<p class="text-muted text-center">{{ $available_adoption['pet']['breed']['name'] }}</p>

									<ul class="list-group list-group-unbordered">
										<li class="list-group-item">
										<b>Age</b> <a class="pull-right">{{ $available_adoption['pet']['age'] }}</a>
										</li>
										<li class="list-group-item">
										<b>Gender</b> <a class="pull-right">{{ $available_adoption['pet']['gender'] }}</a>
										</li>
										<li class="list-group-item">
										<b>Color</b> <a class="pull-right">{{ $available_adoption['pet']['color'] }}</a>
										</li>
									</ul>
<!-- 									
										@if(Auth::user()->id == $available_adoption['adopt']['adopted_by'])
											@if($available_adoption['adopt']['is_accepted'] == 0)
												<a href="#" class="btn btn-warning btn-block" disabled="true"><b>Pending for adoption</b></a>
											@elseif($available_adoption['adopt']['is_accepted'] == 1)
												<a href="#" class="btn btn-primary btn-block" disabled="true"><b>Accepted for adoption</b></a>
											@else
												<a href="#" class="btn btn-danger btn-block" disabled="true"><b>Declined for adoption</b></a>
											@endif
										@endif -->

									<a href="#" class="btn btn-info btn-block" onclick="adopt('{{$available_adoption['id']}}', '{{ $available_adoption['pet']['id'] }}')"><b>Adopt</b></a>
									
								</div>
							</div>
						@endif
					@endforeach
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
		});

		function adopt (id, pet_id) {
			console.log(id + '' + pet_id);
			$.ajax({
				type: "GET",
				url: '/dashboard/pets/adopt/' + id + '/'+ pet_id,
				success: function(response) {
					console.log(response);
					if(response.status && response.canAdopt){
						toastr.success('You have successfully requested to adopt your chosen pet. Thank you!');
						location.reload();
					} else if(!response.status && !response.canAdopt && response.hasImpound){
						toastr.error("Sorry. You are no longer able to adopt any pets.");
					} else if(!response.status && !response.canAdopt) {
						if(confirm('You need to take the exam before proceeding to adopt!')){
							window.location.href = '/dashboard/pets/exams/'+pet_id;
						}
					} else if(response.status == 2 && !response.canAdopt) {
						toastr.error("Sorry! You've failed to take the exam. you need to wait after 30 days. Thank you!");
					}  else {
						toastr.error("Something went wrong...");
					}
				},
				error: function(error) {
					console.log(error)
				}
			});
		}
	</script>
@stop