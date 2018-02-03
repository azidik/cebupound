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
            <form role="form" action="{{ url('dashboard/admin/inventory/food/update') }}" method="post">
                {{ csrf_field() }}
                <div class="box-body ">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" name="id" value="{{ $inventory->id }}"> 
                                <label for="type">Type</label>
                                <select class="form-control" name="pet_type_id" value="{{ $inventory->pet_type_id}}" readonly>
                                    @foreach($types as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Category">Category</label>
                                <select class="form-control" name="food_category_id" value="{{ $inventory->food_category_id}}" readonly>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}" {{ ($category->id == $inventory->food_category_id) ? 'selected' : ''}} required="">{{$category->name}}</option>
                                @endforeach
                            </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $inventory->name}}" readonly>
                            </div>
                        </div>
                       <div class="col-md-6">
                            <div class="form-group">
                                <label for="description"> Description</label>
                                <textarea type="text" class="form-control" name="description" value="{{ $inventory->description }}" readonly>{{ $inventory->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="stock_in">Quantity</label>
                                <input type="number" name="stock_in" class="form-control" required="" value="{{ $inventory->stock_in}}">
                            </div>
                            <div class="form-group">
                                <label for="expiry">Expiry Date</label>
                                <input id="expiry" type="date" name="expiry_date" class="form-control" value="{{ $inventory->expiry_date}}" readonly>
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