@extends('layouts.dashboard')

@section('title', 'Pets')

@section('content')
<section class="content-header">
    <h1>
        Questionaire
        <small>List</small>
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
                <h3 class="box-title">Questionaire List</h3>
                <div class="pull-right"><p class="fa fa-clock-o" aria-hidden="true"></p> <p id="timer" class="box-title"></p></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ url('dashboard/pets/exams/submit') }}" method="post" >
                {{ csrf_field() }}
                <div class="box-body ">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="pet_id" value="{{ $pet_id }}">
                            @foreach($questions as $i => $question)
                                {{ $i + 1}}. {{ $question->name }} 
                                <div class="radio" style="padding-left: 10px;">
                                    @foreach($question->answers as $answer)
                                        <label>
                                            <input type="radio" name="{{ $question->id }}" value="{{ $answer->id }}">
                                            {{ $answer->name }}
                                        </label>
                                    @endforeach
                                </div>
                                </br>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-left">Submit</button>
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

        var timeoutHandle;
        function countdown(minutes) {
            var seconds = 60;
            var mins = minutes
            function tick() {
                var counter = document.getElementById("timer");
                var current_minutes = mins-1
                seconds--;
                counter.innerHTML =
                current_minutes.toString() + ":" + (seconds < 10 ? "0" : "") + String(seconds);
                if( seconds > 0 ) {
                    timeoutHandle=setTimeout(tick, 1000);
                } else {

                    if(mins > 1){
                        alert('aw');
                    // countdown(mins-1);   never reach “00″ issue solved:Contributed by Victor Streithorst
                    setTimeout(function () { 
                        countdown(mins - 1); 
                        alert('ew');
                    }, 1000);
                    }
                }
            }
            tick();
        }
        // countdown('{{$passing->minutes}}');
        countdown(2);
	</script>
@stop