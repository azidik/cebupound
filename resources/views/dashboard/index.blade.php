@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
<section class="content-header">
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>

</section>
@if(Auth::user(0))
<section class="content"><center>
  <div class="box box-primary">
          <div class="box-header with-border">
                <h3 class="box-title">User Profile</h3>
          </div>
          <hr class="bottom-line">
            <div class="inner">
              <div class="avatar"><img src="img/add.png" alt="" class="img-responsive img-circle" width="80px" height="50px" >
                  <h3>{{ Auth::user()->first_name}}</h3>
                  <hr>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Email Address: {{ Auth::user()->email}}</label>
                  </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Address: {{ Auth::user()->address}}</label>
                  </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Contact No.: {{ Auth::user()->contact_no}}</label>
                  </div>
            </div>
        </div>
        <div class="box-footer">
            <a href="{{ url('/dashboard/profile')}}" class="btn btn-primary pull-right">Edit Profile</a>
    </div>
  </center>
</section>
<section class="content">
  <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
            <h3>Adopt</h3>
              <p>New Adopted Pet</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
            <h3>Impound</h3>
              <p>New Impounded Pet</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
            <h3>Register</h3>
              <p>New Registered Pet</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
            <h3>Services</h3>
              <p>Recent Services</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
</section> 
@endif
@endsection