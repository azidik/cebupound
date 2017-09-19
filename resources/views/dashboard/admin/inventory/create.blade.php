@extends('layouts.dashboard')

@section('title', 'Pets')

@section('content')
<section class="content-header">
    <h1>
        Inventory
        <small>Create</small>
	</h1>
    <ol class="breadcrumb">
        <li>Dashboard</li>
        <li class="active">Inventory</li>
    </ol>

    </section>	
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session()->has('message'))
    <div class="alert alert-danger">
        {{ session()->get('message') }}
    </div>
    @endif
    <!-- Main content -->
    <section class="content">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Inventory Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ url('dashboard/pets/create') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="box-body ">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Item Code</label>
                                <input type="text" name="code" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Item Name</label>
                                <input type="text" name="name"class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Item Description</label>
                                <textarea type="text" class="form-control" name="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Price</label>
                                <input type="number" name="price"class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Quantity</label>
                                <input type="number" name="quantity"class="form-control">
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