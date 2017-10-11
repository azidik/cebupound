@extends('layouts.dashboard')

@section('title', 'Pets')

@section('content')
<section class="content-header">
    <h1>
        Pet
        <small>Registration</small>
	</h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Dashboard</li>
        <li class="active">Pets</li>
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
            <form  action="{{ url('dashboard/admin/pets/create') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="box-body ">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputPassword1">Birth Date</label>
                            <input type="date" name="birth_date" id="birth_date" class="form-control">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputPassword1">Age</label>
                            <input type="number" name="age" id="age" readonly class="form-control">
                            </div>
                            <div class="form-group">
                            <label>Gender</label>
                            <select class="form-control" name="gender">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Type</label>
                            <select class="form-control" name="pet_type_id" id="pet_type_id">
                                @foreach($types as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                            </div>
                            <div class="form-group">
                            <label >Breed</label>
                            <select class="form-control" name="breed_id" id="breed">
                            </select>
                            </div>
                            <div class="form-group">
                            <label >Color</label>
                            <input type="text" name="color" class="form-control">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputFile">Pet Image</label>
                            <input type="file" name="image">
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
            $('#birth_date').change(function () {
                var birt_date = $('#birth_date').val();
                var d = new Date( birt_date );
                year = d.getFullYear();
                month = d.getMonth();
                day = d.getDate();

                var age = calculate_age(month, day, year);
                $('#age').val(age);
            });

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

            $('#pet_type_id').change(function(){
                var pet_type_id = $('#pet_type_id').val();
                $.ajax({
                    method: "GET",
                    url: "/dashboard/pets/type/"+ pet_type_id,
                    success: function(response) {
                        document.getElementById('breed').options.length = 0;
                        for(var i in response) {
                            
                            $('#breed').append(
                                '<option value="'+response[i].id+'">'+response[i].name+'</option>'
                            );
                        }
                    },
                    error: function(error) {
                        console.log(error)
                    }
                });
            });
            
            var pet_type_id = $('#pet_type_id').val();
            $.ajax({
                method: "GET",
                url: "/dashboard/pets/type/"+ pet_type_id,
                success: function(response) {
                    document.getElementById('breed').options.length = 0;
                    for(var i in response) {
                        
                        $('#breed').append(
                            '<option value="'+response[i].id+'">'+response[i].name+'</option>'
                        );
                    }
                },
                error: function(error) {
                    console.log(error)
                }
            });
		});
        function calculate_age(birth_month,birth_day,birth_year)
        {
            today_date = new Date();
            today_year = today_date.getFullYear();
            today_month = today_date.getMonth();
            today_day = today_date.getDate();
            age = today_year - birth_year;
        
            if ( today_month < (birth_month - 1))
            {
                age--;
            }
            if (((birth_month - 1) == today_month) && (today_day < birth_day))
            {
                age--;
            }
            return age;
        }
	</script>
@stop