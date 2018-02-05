@extends('layouts.dashboard')

@section('title', 'Pets')

@section('content')
<section class="content-header">
    <h1>
        Medicine Inventory
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
            <form role="form" action="{{ url('dashboard/admin/inventory/medicine/create') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="box-body ">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select class="form-control" name="pet_type_id">
                                @foreach($types as $type)
                                <option value="{{$type->id}}" required="">{{$type->name}}</option>
                                @endforeach
                            </select>
                            </div>
                            <div class="form-group">
                                <label for="Category">Category</label>
                                <select class="form-control" name="medicine_category_id">
                                @foreach($categories as $category)
                                <option value="{{$category->id}}" required="">{{$category->name}}</option>
                                @endforeach
                            </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description"> Description</label>
                                <textarea type="text" class="form-control" name="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="stock_in">Quantity</label>
                                <input type="number" name="stock_in" class="form-control" required="">
                            </div>
                            <div class="form-group">
                                <label for="expiry">Expiry Date</label>
                                <input id="expiry" type="date" name="expiry_date" value="" class="form-control">
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