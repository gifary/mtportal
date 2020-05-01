
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="endless admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, endless admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
    <title>Login | Martechportal</title>
    <!-- Google font-->
<link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<!-- Font Awesome-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/fontawesome.css')}}">
<!-- ico-font-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/icofont.css')}}">
<!-- Themify icon-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/themify.css')}}">
<!-- Flag icon-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/flag-icon.css')}}">
<!-- Feather icon-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/feather-icon.css')}}">

<!-- Bootstrap css-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.css')}}">
<!-- App css-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
<link id="color" rel="stylesheet" href="{{asset('assets/css/light-1.css')}}" media="screen">
<!-- Responsive css-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/responsive.css')}}">


  </head>
  <body>
    <!-- page-wrapper Start-->
    <div class="page-wrapper box-layout">
      <!-- Page Body Start-->

<style>
    .login-left-half{
        background-color:white;
    }
    .mt-8{
        margin-top: 30px;
    }
    .login-right-half{
        background-image: url({{asset('assets/images/clouds.jpg')}});
        background-size: cover;
    }
    .bottomright {
      position: absolute;
      bottom: 20%;
      right: 5%;
      font-size: 18px;
      text-align: right;
      color: white;
    }
    .bottomright-img {
      position: absolute;
      bottom: -120px;
      right: -120px;
    }
    .martech-logo{
        width: 100%;
        max-width: 170px;
    }
    .gradient-button {
    font-family: 'Montserrat', sans-serif;
    text-align: center;
    transition: 0.5s;
    background-size: 200% auto;
    color: #FFF;
    box-shadow: 0 0 20px #eee;
    width: 200px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
    transition: all 0.3s cubic-bezier(.25,.8,.25,1);
    cursor: pointer;

    }
    .gradient-button-4 {background-image: linear-gradient(to right, #00d2ff 0%, #3a7bd5 51%, #00d2ff 100%)}
    .gradient-button-4:hover { background-position: right center; }
    h3, h6{
        font-family: 'Montserrat', sans-serif;
    }
    .mt-3{
        justify-content: center;
    }
    /* Smartphones (portrait and landscape) ----------- */
    @media  only screen
    and (min-device-width : 320px)
    and (max-device-width : 480px) {
        .login-left-half{
            padding: 30px;
        }
        .login-right-half{
            display: none;
        }
    }

    /* Smartphones (landscape) ----------- */
    @media  only screen
    and (min-width : 321px) {
        .login-left-half{
            padding: 30px;
        }
        .login-right-half{
            display: none;
        }
    }

    /* Smartphones (portrait) ----------- */
    @media  only screen
    and (max-width : 320px) {
        .login-left-half{
            padding: 30px;
        }
        .login-right-half{
            display: none;
        }
    }

    /* iPads (portrait and landscape) ----------- */
    @media  only screen
    and (min-device-width : 768px)
    and (max-device-width : 1024px) {
        .login-left-half{
            padding: 30px;
        }
        .login-right-half{
            display: none;
        }
    }

    /* iPads (landscape) ----------- */
    @media  only screen
    and (min-device-width : 768px)
    and (max-device-width : 1024px)
    and (orientation : landscape) {
        .login-left-half{
            padding: 30px;
        }
        .login-right-half{
            display: none;
        }
    }

    /* iPads (portrait) ----------- */
    @media  only screen
    and (min-device-width : 768px)
    and (max-device-width : 1024px)
    and (orientation : portrait) {
        .login-left-half{
            padding: 30px;
        }
        .login-right-half{
            display: none;
        }
    }

    /* Desktops and laptops ----------- */
    @media  only screen
    and (min-width : 1024px) {
        .login-left-half{
            padding: 30px;
        }
        h3.tag-login{
            padding: 25px 0px;
            font-weight: bold;
        }
        .login-right-half{
            display: block;
        }
    }

    /* Large screens ----------- */
    @media  only screen
    and (min-width : 1824px) {
        .login-left-half{
            padding: 30px;
        }
        .login-right-half{
            display: block;
        }
    }

    /* iPhone 4 -----------
    @media
    only screen and (-webkit-min-device-pixel-ratio : 1.5),
    only screen and (min-device-pixel-ratio : 1.5) {
        .login-left-half{
            padding: 30px;
        }
        .login-right-half{
            display: none;
        }
    }*/
</style>

<div class="auth-bg" style="background-size: cover;">
  <div class="authentication-box col-md-9">
    <div class="text-center"><img src="{{asset('assets/images/lncg-logo-w.png')}}" alt="LNCG Logo" width="80px"></div>
    <div class="card mt-8">
      <div class="card-body" style="padding:0px;">
        <div class="row">
            <div class="col-sm-5 login-left-half">
              <div class="text-center">
                  <img src="{{asset('assets/images/martech-portal-new-logo.png')}}" alt="Martech Portal Logo" class="martech-logo">
                </div>
              <div class="text-center">
                  <img src="{{asset('assets/images/Layer2.png')}}" alt="" style="padding: 25px;">
                </div>
              <form class="theme-form" method="POST"  action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                      <label class="col-form-label pt-0">{{ __('Your Email') }}</label>
                      <input class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus type="email" required="">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                  <div class="form-group">
                    <label class="col-form-label">{{ __('Password') }}</label>
                    <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                      @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>

                    <div class="checkbox" style="padding-left: 10px;">
                      <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                      <label class="form-check-label" for="remember">
                          {{ __('Remember Me') }}
                      </label>
                  </div>
                  <div class="form-group form-row mt-3 mb-0">
                    <button class="btn btn-primary btn-pill gradient-button gradient-button-4" type="submit">  {{ __('Login') }}</button>
                  </div>

                  @if (Route::has('password.request'))
                    <div class="text-center">
                      <a class="btn btn-link" href="{{ route('password.request') }}">
                          {{ __('Forgot Your Password?') }}
                      </a>
                    </div>

                  @endif
                </form>
            </div>
            <div class="col-sm-7 login-right-half">
              <div class="bottomright">
                    <div class="row" style="padding-right: 16px;">
                      <div class="col-sm-8"></div>
                      <div class="col-sm-4" style="background-color: white; height: 5px;"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="tag-login">Your Managed Marketing<br>Department in the cloud.</h3>
                            <h6 style="text-transform: uppercase; color: white;">LN Creative Group</h6>
                        </div>
                    </div>
                </div>
                <div class="bottomright-img">
                    <img src="{{asset('assets/images/Ellipse1copy.png')}}" alt="">
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
      <!-- Page Body End-->
    </div>
    <!-- page-wrapper End-->
    <!-- latest jquery-->
<script src="{{asset('assets/js/jquery-3.2.1.min.js')}}"></script>
<!-- Bootstrap js-->
<script src="{{asset('assets/js/bootstrap/popper.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap/bootstrap.js')}}"></script>
<!-- feather icon js-->
<script src="{{asset('assets/js/icons/feather-icon/feather.min.js')}}"></script>
<script src="{{asset('assets/js/icons/feather-icon/feather-icon.js')}}"></script>
<!-- Sidebar jquery-->
<script src="{{asset('assets/js/sidebar-menu.js')}}"></script>
<script src="{{asset('assets/js/config.js')}}"></script>
<!-- Plugins JS Ends-->
<!-- Theme js-->
<script src="{{asset('assets/js/script.js')}}"></script>
<!-- Plugin used-->
  </body>
</html>
