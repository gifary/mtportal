@extends('layouts.master')
@section('title', 'Datatables Server Side | Martechportal')
@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
@endsection

@section('breadcrumb-title', 'All Tasks')
@section('breadcrumb-items')
<li class="breadcrumb-item">Home</li>
<li class="breadcrumb-item">Tasks</li>
@endsection
  
@section('content')
<!-- Container-fluid starts-->
<div class="container-fluid">
  <div class="row">
    <!-- Server Side Processing start-->
    <div class="col-sm-12">
      <div class="card">
       
        <div class="card-body">
          <div class="table-responsive">
            <table class="display datatables" id="tasks">
               <thead>
                  <tr>
                     <th>title</th>
                     <th>description</th>
                     <th>status</th>
                     <th>start_date</th>
                     <th>due_date</th>
                     <th>priority</th>
                     <th>assigned_to</th>
                     <th>parent_task_id</th>
                  </tr>
               </thead>
               <tfoot>
                  <tr>
                     <th>title</th>
                     <th>description</th>
                     <th>status</th>
                     <th>start_date</th>
                     <th>due_date</th>
                     <th>priority</th>
                     <th>assigned_to</th>
                     <th>parent_task_id</th>
                  </tr>
               </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Container-fluid Ends-->
@endsection
@section('script')
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>

<script> 
   $(document).ready(function() {
       $('#tasks').DataTable({ 
           processing: true,
           serverSide: true,
           ajax: "{{route('getData')}}",
           columns:[
               { data: 'title', name: 'title' },
               { data: 'description', name: 'description' },
               { data: 'status', name: 'status' },
               { data: 'start_date', name: 'start_date' },
               { data: 'due_date', name: 'due_date' },
               { data: 'priority', name: 'priority' },
               { data: 'assigned_to', name: 'assigned_to' },
               { data: 'parent_task_id', name: 'parent_task_id' },
              
           ]
       });
   });
   </script>
@endsection

