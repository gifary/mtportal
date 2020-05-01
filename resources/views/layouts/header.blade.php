Page Header Start-->
<div class="page-main-header" style="font-family: 'Montserrat', sans-serif!important;
">
  <div class="main-header-right row">
    <div class="main-header-left d-lg-none">
      <div class="logo-wrapper"><a href="{{route('/')}}"><img src="#" alt=""></a></div>
    </div>
    <div class="mobile-sidebar">
      <div class="media-body text-right switch-sm">
        <label class="switch"><a href="#"><i id="sidebar-toggle" data-feather="align-left"></i></a></label>
      </div>
    </div>
    <div class="nav-right col p-0">
      <ul class="nav-menus">
        <li>
          <!-- <form class="form-inline search-form" action="#" method="get">
            <div class="form-group">
              <div class="Typeahead Typeahead--twitterUsers">
                <div class="u-posRelative">
                  <input class="Typeahead-input form-control-plaintext" id="demo-input" type="text" name="q" placeholder="Search...">
                  <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div><span class="d-sm-none mobile-search"><i data-feather="search"></i></span>
                </div>
                <div class="Typeahead-menu"></div>
              </div>
            </div>
          </form> -->
        </li>
        <!-- <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li> -->
        <!-- <li class="onhover-dropdown"><a class="txt-dark" href="#">
            <h6>EN</h6></a>
          <ul class="language-dropdown onhover-show-div p-20">
            <li><a href="#" data-lng="en"><i class="flag-icon flag-icon-is"></i> English</a></li>
            <li><a href="#" data-lng="es"><i class="flag-icon flag-icon-um"></i> Spanish</a></li>
            <li><a href="#" data-lng="pt"><i class="flag-icon flag-icon-uy"></i> Portuguese</a></li>
            <li><a href="#" data-lng="fr"><i class="flag-icon flag-icon-nz"></i> French</a></li>
          </ul>
        </li> -->
        <li class="onhover-dropdown"><i data-feather="bell"></i><span class="dot"></span>
          <ul class="notification-dropdown onhover-show-div">
            <li>Notications <span class="badge badge-pill badge-primary pull-right">{{Auth::user()->unreadNotifications->count()}}</span></li>


@foreach(Auth::user()->unreadNotifications->take(7) as $unreadnotification)
<li class="bg-light txt-dark">{{$unreadnotification->data['data']}}</li>
@endforeach
            <li class="bg-light txt-dark"><a href="#">All</a> notification</li>
          </ul>
        </li>
        <!-- <li><a href="#"><i class="right_side_toggle" data-feather="message-circle"></i><span class="dot"></span></a></li> -->
        @php
        if(file_exists( public_path().Auth::user()->profile_pic)){
        $profile_pic = Auth::user()->profile_pic;
        }else{
        $profile_pic ='assets/images/user/lncg-logo-only.jpg';

        }
        @endphp
        <li class="onhover-dropdown">
          <div class="media align-items-center"><img class="align-self-center pull-right img-50 rounded-circle border"
              src="{{asset($profile_pic)}}" alt="header-user" style="height:50px">
            <div class="dotted-animation"><span class="animate-circle"></span><span class="main-circle"></span></div>
          </div>
          <ul class="profile-dropdown onhover-show-div p-20">


            <div style="text-align: center!important;" class="d-flex justify-content-center">
              <li><a class=" pull-center align-items-center text-dark font-weight-bold  text-center ">
                  {{Auth::user()->name}}</a></li>
            </div>

            <div class="d-flex justify-content-center" style="text-align: center!important;">
              <li><a class="text-secondary text-center"> {{ get_user_role(Auth::user()->id)}} </a></li>
        </li>
    </div>
    <hr>

    <li><a href="#"><i data-feather="user"></i>Edit Profile</a></li>
    <li><a href="#"><i data-feather="mail"></i>Inbox</a></li>
    <li><a href="#"><i data-feather="lock"></i>Lock Screen</a></li>
    <li><a href="#"><i data-feather="settings"></i>Settings</a></li>
    <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i data-feather="log-out"></i>
        Logout</a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
    </li>
    </ul>
    </li>
    </ul>
    <div class="d-lg-none mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div>
  </div>
  <script id="result-template" type="text/x-handlebars-template">
    <div class="ProfileCard u-cf">
      
      <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
      <div class="ProfileCard-details">
      <div class="ProfileCard-realName">@{{name}}</div>
      </div>
      </div>
    </script>
  <script id="empty-template" type="text/x-handlebars-template">
    <div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div>
      
    </script>
</div>
</div>
<!-- Page Header Ends 