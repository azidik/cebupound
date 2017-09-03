@extends('layouts.dashboard')

@section('title', 'Pets')

@section('content')
<section class="content-header">
    <h1>
        Pet
        <small>Create</small>
	</h1>
	<br>
	    <button type="submit" class="btn btn-info pull-left">Create</button>
	<br>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Dashboard</li>
        <li class="active">Pets</li>
    </ol>
	</section>	
	<br>
    <!-- Main content -->
    <section class="content">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Pet Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
                <div class="box-body ">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputPassword1">Age</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputPassword1">Gender</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="exampleInputPassword1">Breed</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputPassword1">Color</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputPassword1">Type</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <input type="file" id="exampleInputFile">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                </div>
            </form>
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
	</script>
@stop