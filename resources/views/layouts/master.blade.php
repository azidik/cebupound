<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cebu Pound|WELCOME</title>
    <meta name="description" content="Free Bootstrap Theme by BootstrapMade.com">
    <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">
    
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Candal|Alegreya+Sans">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/imagehover.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
   
  </head>
  <body>
    <!--Navigation bar-->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
        <a class="navbar-brand" href="/">Cebu Pound</a>
        </div>

        @if (Auth::guest())
        <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#feature">Adopt Me</a></li>
          <li><a href="{{ url('/about')}}">About Us</a></li>
          <li><a href="{{ url('/contact')}}">Contact Us</a></li>
          <li><a href="{{ url('/login')}}">Sign in</a></li>
          <li class="btn-trial"><a href="{{ url('/register')}}">Register</a></li>
        </ul>
        </div>
      </div>
    </nav>
    <!--/ Navigation bar-->
    

    @else
    <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
                  <li class=""><a href="/user">Home</a></li>         
                  <li><a href="/profile">Profile</a></li>
                  <li class="dropdown collapse">
                     <a href=" " class="dropdown-toggle" data-toggle="dropdown">Pets <b class="caret"></b></a>
                        <ul class="dropdown-menu btn btn-danger">
                           <li><a href="/petRegistration">Pet Registration</a></li>
                           <li><a href="/adopt">Adoption</a></li>
                           <li><a href="/impound">Impounding</a></li>
                        </ul>
                  </li>
                  <li class="dropdown collapse ">
                     <a href=" " class="dropdown-toggle" data-toggle="dropdown">Services <b class="caret"></b></a>
                        <ul class="dropdown-menu btn btn-danger">
                           <li><a href="ideworm.php">Deworming</a></li>
                           <li><a href="imange.php">Mange Treatment</a></li>
                           <li><a href="isandn.php">Spay and Neuter</a></li>
                           <li><a href="irabies.php">Rabies Vaccination</a></li>
                           <li><a href="ibasic.php">Basic Medical Consultation</a></li>
                        </ul>
                  </li>
                  <li><a href="/donation">Donation</a></li>
                  <li><a href="notices">Notices</a></li>       
                  <li><a href='/logout'> {{ Auth::user()->name }} <span class="caret"></span></a>

                      <li>
                        <a href="{{ url('/logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        Sign Out
                        </a>

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                      </li>

                  </li>
               </ul>
            </div>
      
    @endif

    @yield('content')

    <!--Footer-->
    <footer id="footer" class="footer">
      <div class="container text-center">
    
      <ul class="social-links">
        <li><a href="#link"><i class="fa fa-twitter fa-fw"></i></a></li>
        <li><a href="#link"><i class="fa fa-facebook fa-fw"></i></a></li>
        <li><a href="#link"><i class="fa fa-google-plus fa-fw"></i></a></li>
        <li><a href="#link"><i class="fa fa-dribbble fa-fw"></i></a></li>
        <li><a href="#link"><i class="fa fa-linkedin fa-fw"></i></a></li>
      </ul>
        ©2017 Cebu Pound. All rights reserved
      </div>
    </footer>
    <!--/ Footer-->
    
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="contactform/contactform.js"></script>
    
  </body>
</html>