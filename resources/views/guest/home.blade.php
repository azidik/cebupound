@extends('layouts.master')

@section('content')

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
 		<section class="section-padding">
    		<div class="container">
        		<div class="row col-lg-12" style="margin-top:40px;">
  					<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <center><img src="img/ad1.jpg" alt="First Slide" style="width:50%;height:30%">
        <h3>Animals Depend On People Too</h3>
		<h4><p class="subtitle">Don't wait.. ADOPT before it's too late!</p></h4></center>
      </div>

      <div class="item">
        <center><img src="img/ad2.png" alt="Second Slide" style="width:60%;height:30%">
        <h3>Animals Depend On People Too</h3>
		<h4><p class="subtitle">Help them. Save them before it's too late!</p></h4></center>
      </div>
    
      <div class="item">
        <center><img src="img/ser.jpg" alt="Third Slide" style="width:60%;height:30%">
        <h3>Animals Depend On People Too</h3>
		<h4><p class="subtitle">Treat them as you treat yourself before it's too late!</p></h4></center>
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>


        </div>
    </div>
</section>


<section class="section-padding">
      <div class="container">
        <div class="row">
          <div class="header-section text-center">
            <h2>Features</h2>
            <hr class="bottom-line">
          </div>
          <div class="feature-info">
            <div class="fea">
              <div class="col-md-4">
                <div class="heading pull-right">
                  <h4>ADOPTION</h4>
                  <p>A process in which only a registered and capable Client will be able to do so. A Client will be capable once they will get the passing percentage after taking the test to know if they are able to raise the pet under their custody.</p>
                </div>
                <div class="fea-img pull-left">
                </div>
              </div>
            </div>
            <div class="fea">
              <div class="col-md-4">
                <div class="heading pull-right">
                  <h4>IMPOUNDING</h4>
                  <p>Has two category the Sheltered wherein it is to take control of the custody of every animal surrendered by their owner, and Stray wherein it is to take custody of those animals without owner that is reported by the community.</p>
                </div>
                <div class="fea-img pull-left">
                </div>
              </div>
            </div>
            <div class="fea">
              <div class="col-md-4">
                <div class="heading pull-right">
                  <h4>SERVICES</h4>
                  <p>Caters what every pet needs.
                  	<li>Deworming</li>
                  	<li>Mange Treatment</li>
                  	<li>Spay and Neuter</li>
                  	<li>Rabies Vaccination</li>
                  	<li>Basic Medical Consultation</li>
                  </p>
                </div>
                <div class="fea-img pull-left">
                </div>
              </div>
            </div>
        </div>
        </div>
      </div>
    </section>


@endsection
