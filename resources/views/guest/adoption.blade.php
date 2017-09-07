@extends('layouts.master')

@section('content')
    <section class="section-padding">
    <div class="container">
        <div class="row col-lg-12" style="margin-top:40px;">

        	<div class="container">
        		<div class="row">
          			<div class="col-md-4 col-sm-6 padleft-right">
            			<figure class="imghvr-fold-up">
              				<img src="img/bull.jpg" class="img-responsive">
                				<figcaption>
                  				<center><h3>Shame</h3></center>
                  				<p class="subtitle">
                  					Age:<br>
                  					Breed:<br>
                  					Species:<br>
                  					Color:<br>
                  					Other Description
                  				</p>
              					</figcaption>
              						
            			</figure>
            			<center><button type="submit" id="submit" name="submit" class="form contact-form-button light-form-button oswald light">ADOPT</button></center>
          			</div>
          		</div>
          	</div>

        </div>
    </div>
    </section>
@endsection