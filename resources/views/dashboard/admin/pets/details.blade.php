@extends('layouts.dashboard')

@section('title', 'Pets')

@section('content')
<section class="content-header">
    <h1>
        Pet
        <small>Details</small>
	</h1>
    <ol class="breadcrumb">
        <li>Dashboard</li>
        <li class="active">Pet Details</li>
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
                <h3 class="box-title">Pet Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ url('dashboard/admin/pets/update/'.  $pet['id']) }}" enctype="multipart/form-data" method="post">
                {{ csrf_field() }}
                <div class="box-body ">
                    <div class="row">
                        <input type="hidden" name="age" value="{{ $pet['age'] }}">
                        <input type="hidden" name="gender" value="{{ $pet['gender'] }}">
                        <input type="hidden" name="breed_id" value="{{ $pet['breed']['id'] }}">
                        <input type="hidden" name="color" value="{{ $pet['color'] }}">
                        <input type="hidden" name="pet_type_id" value="{{ $pet['pet_type_id'] }}">
                        <input type="hidden" name="age" value="{{ $pet['age'] }}">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $pet['name'] }}">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputPassword1">Age</label>
                            <input type="number" name="age"class="form-control" value="{{ $pet['age'] }}" disabled="true">
                            </div>
                            <div class="form-group">
                            <label>Gender</label>
                            <select class="form-control" name="gender" disabled="true">
                                <option value="Male" {{$pet['gender'] == 'Male'}} ?? 'selected' : ''>Male</option>
                                <option value="Female" {{$pet['gender'] == 'Female'}} ?? 'selected' : ''>Female</option>
                            </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">
                                    <img src="{{ asset('/images/'. $pet['image'])}}" width="200">
                                </label> 
                                <input type="file" name="image" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label >Breed</label>
                            <input type="text" name="breed" class="form-control" value="{{ $pet['breed']['name'] }}" disabled="true">
                            </div>
                            <div class="form-group">
                            <label >Color</label>
                            <input type="text" name="color" class="form-control" value="{{ $pet['color'] }}" disabled="true">
                            </div>
                            <div class="form-group">
                            <label>Type</label>
                            <select class="form-control" name="pet_type_id" disabled="true">
                                @foreach($types as $type)
                                <option value="{{$type->id}}" {{$pet['pet_type_id'] == $type['id']}} ?? 'selected' : ''>{{$type['name']}}</option>
                                @endforeach
                            </select>
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

            var dtToday = new Date();
        
            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
        
            if(month < 10)
                month = '0' + month.toString();
            if(day < 10)
                day = '0' + day.toString();
        
            var maxDate = year + '-' + month + '-' + day;    
            $('#birth_date').attr('max', maxDate);
		});
	</script>
@stop