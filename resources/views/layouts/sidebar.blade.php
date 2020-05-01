<!-- Page Sidebar Start-->
<div class="page-sidebar">
    <div class="main-header-left d-none d-lg-block">
        <div class="logo-wrapper"><a href="{{route('/')}}"><img src="{{asset('assets/images/martechlogo.png')}}" alt=""></a></div>
    </div>
    <div class="sidebar custom-scrollbar">

        <ul class="sidebar-menu">

            <li ><a class="sidebar-header {{ Route::currentRouteName()=='/' ? 'active' : '' }}" href="{{route('/')}}"><i data-feather="home"></i><span>Dashboard</span></a></li>

            <li >
                <a class="sidebar-header {{ Route::currentRouteName()=='permissions' ? 'active' : '' }}" href="{{route('business')}}"><i data-feather="user"></i><span>Martech Business</span></a>
            </li>


            <li ><a class="sidebar-header " href="#"><i data-feather="user"></i><span>Employees</span></a></li>

            <li ><a class="sidebar-header " href="#"><i data-feather="user"></i><span>Clients</span></a></li>

            <li ><a class="sidebar-header " href="{{route('leads.index')}}"><i data-feather="user"></i><span>Leads</span></a></li>
         
            <li ><a class="sidebar-header " href="#"><i data-feather="user"></i><span>Documents</span></a></li>

      <li>
        <a class="sidebar-header {{ Route::currentRouteName()=='permissions' ? 'active' : '' }}"
            href="{{route('projects.viewProject')}}"><i data-feather="user"></i><span>Projects</span></a>
      </li>

            <li class="{{request()->route()->getPrefix() == '/widgets' ? 'active' : '' }}">
                <a class="sidebar-header {{ Route::currentRouteName()=='tasks' ? 'active' : '' }}" href="{{route('tasks.index')}}"><i data-feather="airplay"></i><span>Tasks</span></a>
                
            </li>

            <li ><a class="sidebar-header " href="#"><i data-feather="user"></i><span>Reports</span></a></li>

            <li ><a class="sidebar-header " href="{{route('supportticket')}}"><i data-feather="airplay"></i><span>Support Ticket</span></a></li>


            <li ><a class="sidebar-header " href="#"><i data-feather="user"></i><span>Announcement</span></a></li>


            <li ><a class="sidebar-header " href="#"><i data-feather="user"></i><span>Social</span></a></li>

            <li ><a class="sidebar-header {{ Route::currentRouteName()=='permissions' ? 'active' : '' }}" href="{{route('roles_and_permissions')}}"><i data-feather="user"></i><span>Roles & Permissions</span></a></li>

            <li >
                <a  class="sidebar-header " 
                    href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();"><i data-feather="log-out"></i>         
                    Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>

        </ul>
    </div>
</div>
<!-- Page Sidebar Ends-->
<!-- Right sidebar Start-->
<div class="right-sidebar" id="right_side_bar">
    <div>
        <div class="container p-0">
            <div class="modal-header p-l-20 p-r-20">
                <div class="col-sm-8 p-0">
                    <h6 class="modal-title font-weight-bold">FRIEND LIST</h6>
                </div>
                <div class="col-sm-4 text-right p-0"><i class="mr-2" data-feather="settings"></i></div>
            </div>
        </div>
        <div class="friend-list-search mt-0">
            <input type="text" placeholder="search friend"><i class="fa fa-search"></i>
        </div>
        <div class="p-l-30 p-r-30">
            <div class="chat-box">
                <div class="people-list friend-list">
                    <ul class="list">
                        <li class="clearfix"><img class="rounded-circle user-image" src="{{asset('assets/images/user/1.jpg')}}" alt="">
                            <div class="status-circle online"></div>
                            <div class="about">
                                <div class="name">Vincent Porter</div>
                                <div class="status"> Online</div>
                            </div>
                        </li>
                        <li class="clearfix"><img class="rounded-circle user-image" src="{{asset('assets/images/user/2.png')}}" alt="">
                            <div class="status-circle away"></div>
                            <div class="about">
                                <div class="name">Ain Chavez</div>
                                <div class="status"> 28 minutes ago</div>
                            </div>
                        </li>
                        <li class="clearfix"><img class="rounded-circle user-image" src="{{asset('assets/images/user/8.jpg')}}" alt="">
                            <div class="status-circle online"></div>
                            <div class="about">
                                <div class="name">Kori Thomas</div>
                                <div class="status"> Online</div>
                            </div>
                        </li>
                        <li class="clearfix"><img class="rounded-circle user-image" src="{{asset('assets/images/user/4.jpg')}}" alt="">
                            <div class="status-circle online"></div>
                            <div class="about">
                                <div class="name">Erica Hughes</div>
                                <div class="status"> Online</div>
                            </div>
                        </li>
                        <li class="clearfix"><img class="rounded-circle user-image" src="{{asset('assets/images/user/5.jpg')}}" alt="">
                            <div class="status-circle offline"></div>
                            <div class="about">
                                <div class="name">Ginger Johnston</div>
                                <div class="status"> 2 minutes ago</div>
                            </div>
                        </li>
                        <li class="clearfix"><img class="rounded-circle user-image" src="{{asset('assets/images/user/6.jpg')}}" alt="">
                            <div class="status-circle away"></div>
                            <div class="about">
                                <div class="name">Prasanth Anand</div>
                                <div class="status"> 2 hour ago</div>
                            </div>
                        </li>
                        <li class="clearfix"><img class="rounded-circle user-image" src="{{asset('assets/images/user/7.jpg')}}" alt="">
                            <div class="status-circle online"></div>
                            <div class="about">
                                <div class="name">Hileri Jecno</div>
                                <div class="status"> Online</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Right sidebar Ends -->