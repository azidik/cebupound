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
            			<center><button type="submit" id="submit" name="submit" class="form contact-form-button light-form-button oswald light">ADOPT</button></center>
						@endforeach
          			</div>
          		</div>
          	</div>

        </div>
    </div>
    </section>
@endsection