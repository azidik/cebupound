@extends('layouts.dashboard')

@section('title', 'Pets')

@section('content')
<section class="content-header">
    <h1>
        Q/A
        <small>Create</small>
	</h1>
    <!-- @if(Auth::user()->is_admin) -->
    <ol class="breadcrumb">
        <li>Dashboard</li>
        <li class="active">Q/A</li>
    </ol>
    <!-- @else
    <ol class="breadcrumb">
        <li><a href="{{ url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Dashboard</li>
        <li class="active">Pets</li>
    </ol> -->
    @endif
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
    <!-- Main content -->
    <section class="content">
        <!-- general form elements -->
        @if(session()->has('message'))  
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Questionaire Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ url('dashboard/admin/questionsAndAnswers') }}" method="post">
                {{ csrf_field() }}
                <div class="box-body ">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Question</label>
                                <textarea type="text" class="form-control" name="question"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Answers</label>
                                <div class="input-group">
                                    <!-- <span class="input-group-addon">
                                        <input type="radio" name="answerCheck" value="1">
                                    </span> -->
                                    <input type="text" class="form-control" name="answer[]">
                                </div>
                                <div class="input-group">
                                    <!-- <span class="input-group-addon">
                                        <input type="radio" name="answerCheck" value="2">
                                    </span> -->
                                    <input type="text" class="form-control" name="answer[]">
                                </div>
                                <div class="input-group">
                                    <!-- <span class="input-group-addon">
                                        <input type="radio" name="answerCheck" value="3">
                                    </span> -->
                                    <input type="text" class="form-control" name="answer[]">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">

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