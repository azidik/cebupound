@extends('layouts.master')

@section('content')
    <section class="section-padding">
    <div class="container">
        <div class="row col-lg-12" style="margin-top:40px;">

        	<div class="container">
        		<div class="row">
          			<div class="col-md-4 col-sm-6 padleft-right">
					  	@foreach($impoudings as $impouding)
            			<figure class="imghvr-fold-up">
              				<img src="{{ asset('images/'. $impouding->pet->image )}}" class="img-responsive">
                				<figcaption>
                  				<center><h3>{{ $impouding->pet->name }}</h3></center>
                  				<p class="subtitle">
                  					Age: {{ $impouding->pet->age }}<br>
                  					Breed: {{ $impouding->pet->breed }}<br>
                  					Species: {{ $impouding->pet->type->name }}<br>
                  					Color: {{ $impouding->pet->color }}<br>
                  				</p>
              					</figcaption>
            			</figure>
            			<center><button id="submit" class="form contact-form-button light-form-button oswald light">ADOPT</button></center>
						@endforeach
						<div class="box box-primary">
							<div class="box-body box-profile">
							<img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">

							<h3 class="profile-username text-center">Nina Mcintire</h3>

							<p class="text-muted text-center">Software Engineer</p>

							<ul class="list-group list-group-unbordered">
								<li class="list-group-item">
								<b>Followers</b> <a class="pull-right">1,322</a>
								</li>
								<li class="list-group-item">
								<b>Following</b> <a class="pull-right">543</a>
								</li>
								<li class="list-group-item">
								<b>Friends</b> <a class="pull-right">13,287</a>
								</li>
							</ul>

							<a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
							</div>
							<!-- /.box-body -->
						</div>
          			</div>
          		</div>
          	</div>

        </div>
    </div>
    </section>
@endsection

@section('javascript')
	<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
	<script>
		$(document).ready(function() {
			$('#submit').click(function () {
				
			})
		});
	</script>
@stop