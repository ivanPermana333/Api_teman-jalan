
@section("title") Bookings list @endsection

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Teman Jalan&mdash; @yield("title")</title>
  <link rel="icon" href="{{asset('stisla/img/teman.png')}}">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

  <!-- General CSS Files -->
  <!-- <link rel="stylesheet" href="{{asset('stisla/modules/bootstrap/css/bootstrap.min.css')}}"> -->
  <link rel="stylesheet" href="{{asset('stisla/modules/fontawesome/css/all.min.css')}}">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{asset('stisla/modules/jqvmap/dist/jqvmap.min.css')}}">
  <link rel="stylesheet" href="{{asset('stisla/modules/weather-icon/css/weather-icons.min.css')}}">
  <link rel="stylesheet" href="{{asset('stisla/modules/weather-icon/css/weather-icons-wind.min.css')}}">
  <link rel="stylesheet" href="{{asset('stisla/modules/summernote/summernote-bs4.css')}}">
  <link rel="stylesheet" href="{{asset('stisla/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}">
  <link rel="stylesheet" href="{{asset('stisla/modules/bootstrap-daterangepicker/daterangepicker.css')}}">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('stisla/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('stisla/css/components.css')}}">
  <!-- Start GA -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');

    function submitForm() {
      document.getElementById('sample_form').submit();
      return true;
    }
  </script>
  <!-- /END GA -->
</head>
<body>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
    
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">

          <div class="col-md-20">
            @if(session('status'))
            <div class="alert alert-success">
              {{session('status')}}
            </div>
            @endif

            <div class="card">
              <div class="card-header">
                <h4></h4>
                <div class="card-header-form">
                  <form action="{{route('bookings.index')}}">
                    <div class="input-group">
                      <input name="keyword" value="{{Request::get('keyword')}}" type="text" class="form-control" placeholder="Search">
                      <div class="input-group-btn">
                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>

              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-md">
                    <tr>
                      <th>Code</th>
                      <th>Status</th>
                      <th>Customer</th>
                      <th>Friends</th>
                      <th>Date</th>
                      <th>Time</th>
                      <th>Total Price</th>
                      <th>Action</th>
                    </tr>
                    @foreach($bookings as $booking)
                    <tr>
                      <td>{{$booking->code}}</td>
                      <td>
                        @if($booking->status == "PENDING")
                        <span class="badge bg-info text-light">{{$booking->status}}</span>
                        @elseif($booking->status == "ACCEPT")
                        <span class="badge bg-success text-light">{{$booking->status}}</span>
                        @elseif($booking->status == "REJECT")
                        <span class="badge bg-dark text-light">{{$booking->status}}</span>
                        @endif
                      </td>
                      <td>{{$booking->user->name}}<br><small>{{$booking->user->email}}</small></td>
                      <td>{{$booking->teman->name}}</td>
                      <td>
                        {{$booking->date}}
                      </td>
                      <td>
                        @if (count(json_decode($booking->time)) > 1)
                          @foreach (json_decode($booking->time) as $time)
                            @if ($loop->first)
                              {{$time}} -
                            @endif
                          @endforeach
                          @foreach (json_decode($booking->time) as $time)
                            @if ($loop->last)
                              {{$time}}
                            @endif
                          @endforeach
                          @else
                          @foreach (json_decode($booking->time) as $time)
                              {{$time}}
                          @endforeach
                        @endif
                      </td>
                      <td>{{$booking->total_price}}</td>
                      <td>
                        <a href="{{route('userteman.edit', [$booking->id])}}" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                      </td>
                    </tr>
                    @endforeach
                  </table>
                </div>
              </div>

              <div class="card-footer text-right">
                <nav class="d-inline-block">
                  <tr>
                    <td colspan=10>
                      {{$bookings->links()}}
                    </td>
                  </tr>
                </nav>
              </div>
            </div>
            </section>
      </div>
      
    </div>
  </div>

  <!-- General JS Scripts -->
  <!-- <script src="{{asset('stisla/modules/jquery.min.js')}}"></script> -->
  <script src="{{asset('stisla/modules/popper.js')}}"></script>
  <script src="{{asset('stisla/modules/tooltip.js')}}"></script>
  <!-- <script src="{{asset('stisla/modules/bootstrap/js/bootstrap.min.js')}}"></script> -->
  <script src="{{asset('stisla/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
  <script src="{{asset('stisla/modules/moment.min.js')}}"></script>
  <script src="{{asset('stisla/js/stisla.js')}}"></script>

  <!-- JS Libraies -->
  <script src="{{asset('stisla/modules/simple-weather/jquery.simpleWeather.min.js')}}"></script>
  <script src="{{asset('stisla/modules/chart.min.js')}}"></script>
  <script src="{{asset('stisla/modules/jqvmap/dist/jquery.vmap.min.js')}}"></script>
  <script src="{{asset('stisla/modules/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
  <script src="{{asset('stisla/modules/summernote/summernote-bs4.js')}}"></script>
  <script src="{{asset('stisla/modules/chocolat/dist/js/jquery.chocolat.min.js')}}"></script>
  <script src="{{asset('stisla/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}"></script>
  <script type="{{asset('stisla/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}"></script>
  <script src="{{asset('stisla/modules/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

  <!-- Page Specific JS File -->
  <script src="{{asset('stisla/js/page/index-0.js')}}"></script>

  <!-- Template JS File -->
  <script src="{{asset('stisla/js/scripts.js')}}"></script>
  <script src="{{asset('stisla/js/custom.js')}}"></script>

  <script>
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
  </script>
</body>
</html>

