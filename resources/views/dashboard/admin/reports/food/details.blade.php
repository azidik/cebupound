@extends('layouts.dashboard')

@section('title', 'Pets')

@section('content')
<section class="content-header">
    <h1>
        Food
        <small>Details</small>
	</h1>
    <ol class="breadcrumb">
        <li>Dashboard</li>
        <li class="active">Food Details</li>
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
                <h3 class="box-title">Food Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ url('dashboard/admin/inventory/foodList/update/'.  $inventory->id) }}" method="post">
                {{ csrf_field() }}
                <div class="box-body ">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select class="form-control" name="pet_type_id" value="{{ $inventory->pet_type_id}}" disabled="true">
                                @foreach($types as $type)
                                <option value="{{$type->id}}" required="">{{$type->name}}</option>
                                @endforeach
                            </select>
                            </div>
                            <div class="form-group">
                                <label for="Category">Category</label>
                                <select class="form-control" name="food_category_id" value="{{ $inventory->food_category_id}}" disabled="true">
                                @foreach($categories as $category)
                                <option value="{{$category->id}}" required="">{{$category->name}}</option>
                                @endforeach
                            </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name"class="form-control" value="{{ $inventory->name}}" disabled="true">
                            </div>
                        </div>
                       <div class="col-md-6">
                            <div class="form-group">
                                <label for="description"> Description</label>
                                <textarea type="text" class="form-control" name="description" value="{{ $inventory->description}}" disabled="true"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="stock_in">Quantity</label>
                                <input type="number" name="stock_in" class="form-control" required="" value="{{ $inventory->stock_in}}">
                            </div>
                            <div class="form-group">
                                <label for="expiry">Expiry Date</label>
                                <input id="expiry" type="date" name="expiry_date" value="" class="form-control" value="{{ $inventory->expiry_date}}" disabled="true">
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
@stop