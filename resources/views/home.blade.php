@extends('layouts.app')
@push('style')
<style media="screen">
.clock {
  top: 50%;
  left: 50%;
  font-size: 20px;
  font-family: Orbitron;
  letter-spacing: 5px;
}
</style>
@endpush
@section('content')
<!-- Page-Title -->
<div class="page-title-box">
  <div class="container-fluid">
    <div class="row align-items-center">
      <div class="col-md-8">
        <h4 class="page-title mb-1">Dashboard</h4>
        <ol class="breadcrumb m-0">
          <li class="breadcrumb-item active">@lang('dashboard.dasboard-title')</li>
        </ol>
      </div>
    </div>

  </div>
</div>
<!-- end page title end breadcrumb -->

<div class="page-content-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-6">
        <div class="card">
          <div class="card-body">
            <div class="media">
              <div class="media-body">
                <p class="text-muted mb-2">@lang('dashboard.dasboard-company-title')</p>
                <h4>{{$companies}} @lang('dashboard.dashboard-company')</h4>
              </div>
              <div class="col-7 ml-auto">
                <div>
                  <img src="{{asset('storage/assets/images/companies.svg')}}" alt="" class="img-fluid">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-6">
        <div class="card">
          <div class="card-body">
            <div class="media">
              <div class="media-body">
                <p class="text-muted mb-2">@lang('dashboard.dasboard-employee-title')</p>
                <h4>{{$employees}} @lang('dashboard.dashboard-employee')</h4>
              </div>
              <div class="col-7 ml-auto">
                <div>
                  <img src="{{asset('storage/assets/images/employee2.svg')}}" alt="" class="img-fluid">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-xl-8">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-7">
                <h5>@lang('dashboard.dashboard-title-greeting') {{Auth::user()->username }} !</h5>
                <p class="text-muted text-left">@lang('dashboard.dashboard-description-greeting')</p>
              </div>

              <div class="col-5 ml-auto">
                <div>
                  <img src="{{asset('storage/assets/images/welcome.svg')}}" alt="" class="img-fluid">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4">
        <div class="card">
          <div class="card-body">
            <div class="media">
              <div class="media-body">
                <div id="MyClockDisplay" class="clock" onload="showTime()"></div>
                <hr>
              </div>
              <hr>
            </div>
            <div class="col-6 ml-auto">
              <div>
                <img src="{{asset('storage/assets/images/gif/clock.gif')}}" alt="" class="img-fluid">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end row -->
  
  <!-- end row -->
</div> <!-- container-fluid -->
@endsection

@push('scripts')
<script type="text/javascript">
  function showTime(){
    var date = new Date();
    var h = date.getHours(); // 0 - 23
    var m = date.getMinutes(); // 0 - 59
    var s = date.getSeconds(); // 0 - 59
    var session = "AM";

    if(h == 0){
      h = 12;
    }

    if(h > 12){
      h = h - 12;
      session = "PM";
    }

    h = (h < 10) ? "0" + h : h;
    m = (m < 10) ? "0" + m : m;
    s = (s < 10) ? "0" + s : s;

    var time = h + ":" + m + ":" + s + " " + session;
    document.getElementById("MyClockDisplay").innerText = time;
    document.getElementById("MyClockDisplay").textContent = time;

    setTimeout(showTime, 1000);

  }

  showTime();
</script>
@endpush
