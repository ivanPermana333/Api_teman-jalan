@section("title") Friends Insert @endsection

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

          <div class="col-md-8">

          @if(session('status'))
          <div class="alert alert-success">
            {{session('status')}}
          </div>
          @endif
          <img src="stisla/img/teman.png" class="center"> 
          <form
            enctype="multipart/form-data"
            class="bg-white shadow-sm p-3"
            action="/loginteman"
            method="POST">

            @csrf

            <div class="form-group">
              <label for="username">Username</label>
              <input
              value="{{old('username')}}"
              class="form-control {{$errors->first('username') ? "is-invalid": ""}}"
              placeholder="Friends Username"
              type="text"
              name="username"
              id="username"/>
              <!-- <div class="invalid-feedback">
                {{$errors->first('username')}}
              </div> -->
            </div>

        
            <div class="form-group">
              <label for="Price">Email</label> <br>
              <input value="{{old('email')}}" type="text" class="form-control {{$errors->first('email') ? "is-invalid" : ""}}" name="email" id="email" placeholder="Email owner">
              <!-- <div class="invalid-feedback">
                {{$errors->first('email')}}
              </div> -->
            </div>

            <div class="form-group">
              <label for="name">Password</label>
              <input
              value="{{old('password')}}"
              class="form-control {{$errors->first('password') ? "is-invalid": ""}}"
              placeholder="Password"
              type="password"
              name="password"
              id="password"/>
              <!-- <div class="invalid-feedback">
                {{$errors->first('name')}}
              </div> -->
            </div>
            <div><a href="/registerteman">Buat Akun baru??</a></div>
            <div class="text-right">
              <input
              class="btn btn-primary"
              type="submit"
              value="LOGIN"/>
            </div>
          </form>
          </div>
      </section>
      </div>
      
    </div>
  </div>

  <!-- //General JS Scripts -->
  <script src="{{asset('stisla/modules/jquery.min.js')}}"></script>
  <script src="{{asset('stisla/modules/popper.js')}}"></script>
  <script src="{{asset('stisla/modules/tooltip.js')}}"></script>
  <script src="{{asset('stisla/modules/bootstrap/js/bootstrap.min.js')}}"></script>
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
