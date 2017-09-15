@extends('layouts.dashboard')

@section('title', 'Pets')

@section('content')
<section class="content-header">
    <h1>
        Questionaire
        <small>List</small>
	</h1>
    @if(Auth::user()->is_admin)
    <ol class="breadcrumb">
        <li>Dashboard</li>
        <li class="active">Pets</li>
    </ol>
    @else
    <ol class="breadcrumb">
        <li><a href="{{ url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Dashboard</li>
        <li class="active">Pets</li>
    </ol>
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
                <h3 class="box-title">Questionaire List</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ url('dashboard/admin/questionsAndAnswers/update') }}" method="post" >
                {{ csrf_field() }}
                <div class="box-body ">
                    <div class="row">
                        <div class="col-md-12">
                                <div class="box box-solid">
                                    <div class="box-header with-border">
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                    <div class="box-group" id="accordion">
                                        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                                        <div class="panel box box-primary">
                                            @foreach($questions as $index => $question)
                                                <div class="box-header with-border">
                                                    <h4 class="box-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#{{$index}}" aria-expanded="false" class="collapsed">
                                                            {{$index + 1}}. {{ $question->name }}
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="{{$index}}" class="panel-collapse collapse" aria-expanded="true" style="height: 0px;">
                                                    <div class="box-body">
                                                        @foreach($question->answers as $answer)
                                                            <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                    <input type="radio" name="is_correct" value="{{ $answer->id }}">
                                                                    </span>
                                                                <input type="text" class="form-control" name="answer[{{$answer->id}}]" value="{{ $answer->name }}">
                                                            </div>
                                                        @endforeach
                                                        <!-- <div class="box-footer"> -->
                                                        <br>
                                                            <button type="submit" class="btn btn-primary pull-left">Update</button>
                                                        <!-- </div> -->
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->

                <!-- <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                </div> -->
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