@extends('layouts.master')

@section('content')
    <section class="section-padding">
    <div class="container">
        <div class="row col-lg-12" style="margin-top:40px;">

        	<div class="container">
        		<div class="row">
          			<div class="col-md-4 col-sm-6 padleft-right">
					  	@foreach($impoundings as $impounding)
            			<figure class="imghvr-fold-up">
              				<img src="{{ asset('images/'. $impounding->pet->image )}}" class="img-responsive">
                				<figcaption>
                  				<center><h3>{{ $impounding->pet->name }}</h3></center>
                  				<p class="subtitle">
                  					Age: {{ $impounding->pet->age }}<br>
                  					Breed: {{ $impounding->pet->breed }}<br>
                  					Species: {{ $impounding->pet->type->name }}<br>
                  					Color: {{ $impounding->pet->color }}<br>
                  				</p>
              					</figcaption>
            			</figure>
            			<center><button id="submit" class="form contact-form-button light-form-button oswald light">ADOPT</button></center>
						@endforeach
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