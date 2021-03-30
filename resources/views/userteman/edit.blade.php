
@section("title") Bookings @endsection
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
    <div class="main-wrapper main-wrapper-1">
    
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">

        <div class="col-md-8">

          @if(session('status'))
          <div class="alert alert-success">
            {{session('status')}}
          </div>
          @endif
          <img src="{{asset('stisla/img/teman.png')}}" class="center"> 
          <form
            enctype="multipart/form-data"
            class="bg-white shadow-sm p-3"
            action="{{route('userteman.update', [$booking->id])}}"
            method="POST">

            @csrf
            <input type="hidden" value="PUT" name="_method">

            <div class="form-group">
              <label for="name">Code</label>
              <input
              value="{{$booking->code}}"
              class="form-control {{$errors->first('name') ? "is-invalid": ""}}"
              type="text"
              name="name"
              id="name"
              disabled/>
              <div class="invalid-feedback">
                {{$errors->first('code')}}
              </div>
            </div>

            <div class="form-group">
              <label for="customer">Customer</label>
              <input
              value="{{$booking->user->name}}"
              class="form-control {{$errors->first('location') ? "is-invalid": ""}}"
              type="text"
              name="customer"
              disabled/>
              <div class="invalid-feedback">
                {{$errors->first('customer')}}
              </div>
            </div>

            <div class="form-group">
              <label for="teman">Teman</label>
              <input
              value="{{$booking->teman->name}}"
              class="form-control {{$errors->first('teman') ? "is-invalid": ""}}"
              type="text"
              name="teman"
              disabled/>
              <div class="invalid-feedback">
                {{$errors->first('teman')}}
              </div>
            </div>

            <div class="form-group">
              <label for="date">Date</label>
              <input
              value="{{$booking->date}}"
              class="form-control {{$errors->first('date') ? "is-invalid": ""}}"
              type="text"
              name="date"
              disabled/>
              <div class="invalid-feedback">
                {{$errors->first('date')}}
              </div>
            </div>

            <div class="form-group">
              <label for="time">Time</label>
              <input
              value="@foreach (json_decode($booking->time) as $t){{$t}}@endforeach"
              class="form-control {{$errors->first('date') ? "is-invalid": ""}}"
              type="text"
              name="date"
              disabled/>
              <div class="invalid-feedback">
                {{$errors->first('date')}}
              </div>
            </div>

            <div class="form-group">
              <label for="total_price">Price</label> <br>
              <input value="{{$booking->total_price}}" type="text" class="form-control {{$errors->first('price') ? "is-invalid" : ""}}" name="total_price" disabled>
              <div class="invalid-feedback">
                {{$errors->first('total_price')}}
              </div>
            </div>

            <div class="form-group">
              <label for="status">Status</label><br>
              <select class="form-control" name="status" id="status" @if($booking->status == "ACCEPT" || $booking->status == "REJECT") disabled @endif>
                <option {{$booking->status == "PENDING" ? "selected" : ""}} value="PENDING">PENDING</option>
                <option {{$booking->status == "ACCEPT" ? "selected" : ""}} value="ACCEPT">ACCEPT</option>
                <option {{$booking->status == "REJECT" ? "selected" : ""}} value="REJECT">REJECT</option>
              </select>
            </div>

            <div class="text-right">
              <input
              class="btn btn-primary"
              type="submit"
              value="Save"/>
            </div>
          </form>
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


