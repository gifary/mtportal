@extends('layouts.master')

@section('title', 'Dashboard | Martechportal')
@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/chartist.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/prism.css')}}">
@endsection

@section('breadcrumb-title', 'Welcome')
@section('breadcrumb-items')
<li class="breadcrumb-item">Dashboard</li>
<li class="breadcrumb-item active">Default</li>
@endsection

@section('content')
<!-- Container-fluid starts-->
<div class="container-fluid">

    <table class="container-fluid table table-responsive">

        <tr>
            <td class="col-md-11 col-xl-11 col-12 ">

                <div class="row" style="margin-left:1px;margin-right:1px;">



              <div class="card col-xl-4"   >


                <div class="media m-2 ">
                  <div class="media-body">
                    <h5 class="mt-0 mb-0 f-w-600">TICKETS</h5>
                    <p>Total Tickets : <span class="font-primary counter f-w-600"> 1117</span></p>

                  </div><i data-feather="shopping-cart"></i>
                </div>


          </div>



              <div class="card col-xl-4">


                <div class="media m-2">
                  <div class="media-body">
                    <h5 class="mt-0 mb-0 f-w-600">TASKS</h5>
                    <p>Total Tasks : <span class="font-primary counter f-w-600">22222</span></p>
                  </div><i data-feather="shopping-cart"></i>
                </div>


          </div>


              <div class="card col-xl-4">


                <div class="media m-2">
                  <div class="media-body">
                    <h5 class="mt-0 mb-0 f-w-600">LEADS</h5>
                    <p>Total Leads : <span class="font-primary counter f-w-600"> 33335</span></p>
                  </div><i data-feather="shopping-cart"></i>
                </div>


          </div>

          </div>


           </div>

  <div class="row">

    <div class="col-xl-12">
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <div class="chart-widget-dashboard">
                <div class="media">
                  <div class="media-body">
                    <h5 class="mt-0 mb-0 f-w-600">TASKS</h5>
                    <p>New TASKS</p>
                  </div><i data-feather="tag"></i>
                </div>
                <div class="dashboard-chart-container">
                  <div class="small-chart-gradient-1"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <div class="chart-widget-dashboard">
                <div class="media">
                  <div class="media-body">
                    <h5 class="mt-0 mb-0 f-w-600">PROJECTS</h5>
                    <p>New Projects</p>
                  </div><i data-feather="shopping-cart"></i>
                </div>
                <div class="dashboard-chart-container">
                  <div class="small-chart-gradient-2"></div>
                </div>
              </div>
            </div>
          </div>
        </div>








      </div>


    </div>

    </div>


  <div class="row">

    <div class="col-xl-12">
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <div class="chart-widget-dashboard">
                <div class="media">
                  <div class="media-body">
                    <h5 class="mt-0 mb-0 f-w-600">LEADS</h5>
                    <p>New Leads</p>
                  </div><i data-feather="tag"></i>
                </div>
                <div class="dashboard-chart-container">
                  <div class="small-chart-gradient-3"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <div class="chart-widget-dashboard">
                <div class="media">
                  <div class="media-body">
                    <h5 class="mt-0 mb-0 f-w-600">SUPPORT TICKETS</h5>
                    <p>New Tickets</p>
                  </div><i data-feather="shopping-cart"></i>
                </div>
                <div class="dashboard-chart-container">
                  <div class="small-chart-gradient-3"></div>
                </div>
              </div>
            </div>
          </div>
        </div>








      </div>


    </div>

    </div>





            </td>



            <td class="col-md-4 col-xl-4 col-12">










    <div class="col-xl-12 col-12 col-md-12">
      <div class="card">
        <div class="card-header">
          <h5>To-Do</h5>
        </div>
        <div class="card-body">
          <div class="todo">
            <div class="todo-list-wrapper">
              <div class="todo-list-container">
                <div class="mark-all-tasks">

                </div>

                <div class="todo-list-footer">
                  <div class="add-task-btn-wrapper"><span class="add-task-btn">
                      <button class="btn btn-primary"><i class="icon-plus"></i> Add new task</button>
                      </span>
                      </div>
             <br> <br><br>      <br> <br><br><br><br><br><br><div class="new-task-wrapper">
                    <textarea id="new-task" placeholder="Enter new task here. . ."></textarea> &nbsp;&nbsp;
                  </div>
                   <div class="add-task-btn-wrapper"><span class="add-task-btn">
                         <span class="btn btn-success ml-3 add-new-task-btn" id="add-task">Add Task</span>
                      </span>
                      </div>


                </div>
              </div>
            </div>
            <div class="notification-popup hide">
              <p><span class="task"></span><span class="notification-text"></span></p>
            </div>
          </div>
          <!-- HTML Template for tasks-->
          <script id="task-template" type="tect/template">
            <li class="task">
            <div class="task-container">
            <h4 class="task-label"></h4>
            <span class="task-action-btn">
            <span class="action-box large delete-btn" title="Delete Task">
            <i class="icon"><i class="icon-trash"></i></i>
            </span>
            <span class="action-box large complete-btn" title="Mark Complete">
            <i class="icon"><i class="icon-check"></i></i>
            </span>
            </span>
            </div>
            </li>
          </script>
        </div>
      </div>

  </div>
  </td>
        </tr>
        <tr>
          </tr>
    </table>
    </div>
<!-- Container-fluid Ends-->
@endsection
@section('script')
<script src="{{asset('assets/js/chart/chartist/chartist.js')}}"></script>
<script src="{{asset('assets/js/chart/knob/knob.min.js')}}"></script>
<script src="{{asset('assets/js/chart/knob/knob-chart.js')}}"></script>
<script src="{{asset('assets/js/prism/prism.min.js')}}"></script>
<script src="{{asset('assets/js/clipboard/clipboard.min.js')}}"></script>
<script src="{{asset('assets/js/counter/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('assets/js/counter/jquery.counterup.min.js')}}"></script>
<script src="{{asset('assets/js/counter/counter-custom.js')}}"></script>
<script src="{{asset('assets/js/custom-card/custom-card.js')}}"></script>
<script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('assets/js/dashboard/default.js')}}"></script>
<script src="{{asset('assets/js/notify/index.js')}}"></script>
<script src="{{asset('assets/js/height-equal.js')}}"></script>
@endsection
