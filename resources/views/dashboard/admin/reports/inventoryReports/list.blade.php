@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
<section class="content-header">
  <h1>
    Reports
  </h1>
  @if(session()->has('message'))
    <div class="alert alert-primary">
        {{ session()->get('message') }}
    </div>
    @endif
    <ol class="breadcrumb">
        <li>Dashboard</li>
        <li class="active">Pets</li>
    </ol>
  </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ $clients->count() }}</h3>

              <p>Client's Registration</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $pets->count() }}</h3>
            
              <p>Pet's Registration</p>
                <form action="{{ url('/dashboard/admin/pets/pdf/registered') }}" method="post">
                {{ csrf_field() }}
                  Select Category:
                  <select class="form-control" name="category">
                    <option value="1">Sheltered</option>
                    <option value="2">Stray</option>
                  </select>
                  Select Type:
                  <select class="form-control" name="type">
                    <option value="1">Dog</option>
                    <option value="2">Cats</option>
                  </select>
                  <br>
                  <button class="btn btn-primary" id="pet_registration_print">Print</button>
                </form>
            </div>
            
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ $impound_pets->count() }}</h3>

              <p>Impounded Pets</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ $adopted_pets->count() }}</h3>

              <p>Adopted Pets</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ $questions->count() }}</h3>

              <p>Questions</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $foods->count() }}</h3>

              <p>Food</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            
          </div>
        </div>
        <div></div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ $medicines->count() }}</h3>

              <p>Medicine</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3 id="deworming-count"></h3>

              <p>Deworming</p>
              Select barangay:
              <select class="form-control" name="barangay_id" id="report_select_barangay_deworming">
                  @foreach($barangays as $barangay)
                    <option value="{{$barangay->id}}">{{$barangay->description}}</option>
                  @endforeach
              </select>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3 id="treatment-count"></h3>

              <p>Mange Treatment</p>
              Select barangay:
              <select class="form-control" name="barangay_id" id="report_select_barangay_treatment">
                  @foreach($barangays as $barangay)
                    <option value="{{$barangay->id}}">{{$barangay->description}}</option>
                  @endforeach
              </select>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3 id="spay-count"></h3>

              <p>Spay and Neuter</p>
              Select barangay:
              <select class="form-control" name="barangay_id" id="report_select_barangay_spay">
                  @foreach($barangays as $barangay)
                    <option value="{{$barangay->id}}">{{$barangay->description}}</option>
                  @endforeach
              </select>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3 id="rabbies-count"></h3>
              <p>Rabies Vaccination</p>
              Select barangay:
              <select class="form-control" name="barangay_id" id="report_select_barangay_rabbies">
                  @foreach($barangays as $barangay)
                    <option value="{{$barangay->id}}">{{$barangay->description}}</option>
                  @endforeach
              </select>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3 id="medical-count"></h3>

              <p>Basic Medical Consultation</p>
              Select barangay:
              <select class="form-control" name="barangay_id" id="report_select_barangay_medical">
                  @foreach($barangays as $barangay)
                    <option value="{{$barangay->id}}">{{$barangay->description}}</option>
                  @endforeach
              </select>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection

@section('javascript')
	<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
	<script>
    $('#report_select_barangay_deworming').change(function () {
      $.ajax({
				type: "GET",
				url: '/dashboard/admin/inventory/report/ '+ $(this).val() + ' /deworming',
				success: function(response) {
          $('#deworming-count').text(response);
				}
			});
    });

    $('#report_select_barangay_treatment').change(function () {
      $.ajax({
				type: "GET",
				url: '/dashboard/admin/inventory/report/ '+ $(this).val() + ' /mange_treatment',
				success: function(response) {
          $('#treatment-count').text(response);
				}
			});
    });

    $('#report_select_barangay_spay').change(function () {
      $.ajax({
				type: "GET",
				url: '/dashboard/admin/inventory/report/ '+ $(this).val() + ' /spay_neuter',
				success: function(response) {
          $('#spay-count').text(response);
				}
			});
    });

    $('#report_select_barangay_rabbies').change(function () {
      $.ajax({
				type: "GET",
				url: '/dashboard/admin/inventory/report/ '+ $(this).val() + ' /rabies_vaccination',
				success: function(response) {
          $('#rabbies-count').text(response);
				}
			});
    });

    $('#report_select_barangay_medical').change(function () {
      $.ajax({
				type: "GET",
				url: '/dashboard/admin/inventory/report/ '+ $(this).val() + ' /basic_medical_consultation',
				success: function(response) {
          $('#medical-count').text(response);
				}
			});
    });

    $('#pet_registration_print').click(function () {
      var pet_category_id = $('#pet_registration_category').val();
      var pet_type_id = $('#pet_registration_type').val();
      $.ajax({
				type: "GET",
				url: '/dashboard/admin/pets/pdf/registered/'+pet_category_id+'/'+pet_type_id,
				success: function(response) {
          console.log(response);
				}
			});
    });
	</script>
@stop
