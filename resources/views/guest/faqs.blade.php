
    @extends('layouts.master')

    @section('content')

    <section class="section-padding">
    <div class="container">
        <div class="row col-lg-12" style="margin-top:70px;">
       
                <center>
                        <h2>Frequently Asked Questions</h2>
                        <hr class="bottom-line">
                </center>
        </div>
    </div>
    </section>

    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Is account registration required?</a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
                    <a href="{{ url('/register')}}">Account registration</a> at <strong>Cebu City Pound</strong> is only required if you will be adopting, impounding or get services from Cebu Pound.<br> 
                    This ensures a valid communication channel for those parties involved in any transactions. 
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">How to adopt a pet?</a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
                    1) Choose the cat or the dog, kitten or puppy, that would complement you and your home.<br><br>

                    2) Click the adopt button and a there will be a prompt message telling you that you have to take an exam to evaluate and assessed you as a potential owner for your chosen pet. Cebu City Pound reserves the right to deny any adoption application once you are not qualified. Although all animals are given an exam prior to becoming available for adoption, Cebu City Pound cannot guarantee that these animals have not been exposed to an illness prior to coming to the Pound.<br><br>

                    3) If it seems you are a good fit for each other based on the answers you provided, the administrator will confirm that your request have been accepted and that is the time that you will go Cebu City Pound to get your chosen pet.<br>
                    NOTE: Cebu City Pound requires adopters to be at least 18 years of age<br><br>

                    4) Pay adoption fee worth P150.00 at Cebu City Pound Office.<br>
                    Adoption fee covers:<br>
                    * Rabies vaccine for an adopted pet<br>
                    * Spay and Neuter<br>
                    * Deworming<br>
                    * Cebu City Dog Collar<br>
 
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">What is impounding?</a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
                     
                </div>
            </div>
        </div>
    </div> 

    @endsection
