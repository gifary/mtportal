@extends('layouts.master')
@section('title', 'Datatables Server Side | Martechportal')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
@endsection

@section('breadcrumb-title', 'All Tickets')
@section('breadcrumb-items')
    <li class="breadcrumb-item">Tickets</li>
@endsection
@section('breadcrumb-buttons')
    {{--    <a href="{{route('add_ticket_page')}}" class="btn btn-pill btn-primary" data-original-title="Create Ticket"--}}
    {{--       title="">Create Ticket</a>--}}
    <button class=" btn btn-pill btn-primary text-light" type="button" data-toggle="modal"
            data-target="#addTicketModal" data-whatever="@getbootstrap" id="addTicketId" name="addTicketId"
            data-original-title="" title="">Create Ticket
    </button>
@endsection

@section('content')

    <style>
        .make-me-sticky {
            position: sticky;
            top: 0;
        }

        .pt-7 {
            padding-top: 7px;
        }
    </style>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-xl-9 col-lg-9 col-md-9">

                <div class="row">
                    <div class="col-sm-6 col-xl-3 col-lg-6">
                        <div class="card o-hidden">
                            <div class="bg-danger card-body">
                                <div class="media1 static-top-widget1">
                                    <div class="media-body"><span class="m-0">New</span>
                                        <h4 class="mb-0 counter">{{$ticket_counts['new']}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3 col-lg-6">
                        <div class="card o-hidden">
                            <div class="bg-primary card-body">
                                <div class="media1 static-top-widget1">
                                    <div class="media-body"><span class="m-0">Assigned</span>
                                        <h4 class="mb-0 counter">{{$ticket_counts['assigned']}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3 col-lg-6">
                        <div class="card o-hidden">
                            <div class="bg-warning card-body">
                                <div class="media1 static-top-widget1">
                                    <div class="media-body"><span class="m-0">Open</span>
                                        <h4 class="mb-0 counter">{{$ticket_counts['open']}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3 col-lg-6">
                        <div class="card o-hidden">
                            <div class="bg-success card-body">
                                <div class="media1 static-top-widget1">
                                    <div class="media-body"><span class="m-0">Resolved</span>
                                        <h4 class="mb-0 counter">{{$ticket_counts['resolved']}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row default-according style-1 faq-accordion" id="accordionoc">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        @if(!empty($tickets))
                            @foreach($tickets as $key => $ticket)
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" data-toggle="collapse"
                                                    data-target="#collapseicon-{{ $key }}" aria-expanded="false"
                                                    aria-controls="collapseicon">
                                                <i class="fa fa-circle text-danger"></i> {{$ticket->title}}
                                            </button>
                                        </h5>
                                    </div>
                                    <div class="collapse" id="collapseicon-{{ $key }}" aria-labelledby="collapseicon"
                                         data-parent="#accordionoc">
                                        <div class="card-body">

                                            <div class="form-group row">
                                                <label class="col-lg-12 control-label text-lg-left" for="textinput">Detailed
                                                    Description</label>
                                                <div class="col-lg-12">
                                                    <textarea id="desc" name="desc" rows="4" placeholder=""
                                                              class="form-control">{{$ticket->description}}</textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 control-label text-right pt-7" for="textinput">Priority</label>
                                                <div class="col-lg-3">
                                                    {!! Form::select('priority', array('Higher' => 'Higher', 'Medium' => 'Medium', 'Lower' => 'Lower', 'None' => 'None'), $ticket->priority, ['id' => 'priority', 'class' => 'form-control']); !!}
                                                </div>
                                                <label class="col-lg-3 control-label text-right pt-7"
                                                       for="textinput">Status</label>
                                                <div class="col-lg-3">
                                                    {!! Form::select('status', array('Pending' => 'Pending', 'In Progress' => 'In Progress', 'Dismiss' => 'Dismiss', 'Completed' => 'Completed'), $ticket->status, ['id' => 'status', 'class' => 'form-control']); !!}
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 control-label text-right pt-7" for="textinput">Assigned
                                                    By</label>
                                                <div class="col-lg-3">
                                                    {!! Form::select('assigned_by', $assignees, $ticket->assigned_to, ['id' => 'assigned_by', 'class' => 'form-control']); !!}
                                                </div>
                                                <label class="col-lg-3 control-label text-right pt-7" for="textinput">Assigned
                                                    To</label>
                                                <div class="col-lg-3">
                                                    {!! Form::select('assigned_to', $assignees, $ticket->assigned_to, ['id' => 'assigned_to', 'class' => 'form-control']); !!}
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 control-label text-right pt-7" for="textinput">Start
                                                    Date</label>
                                                <div class="col-lg-3">
                                                    <input id="textinput" name="textinput" type="date"
                                                           placeholder="Date" class="form-control"
                                                           value="{{$ticket->start_date}}">
                                                </div>
                                                <label class="col-lg-3 control-label text-right pt-7" for="textinput">Due
                                                    Date</label>
                                                <div class="col-lg-3">
                                                    <input id="textinput" name="textinput" type="date"
                                                           placeholder="Date" class="form-control"
                                                           value="{{$ticket->due_date}}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 control-label text-right pt-7"
                                                       for="textinput">Tier</label>
                                                <div class="col-lg-3">
                                                    <select id="selectbasic" name="selectbasic" class="form-control ">
                                                        <option value="1">Option one</option>
                                                        <option value="2">Option two</option>
                                                    </select>
                                                </div>
                                                <label class="col-lg-3 control-label text-right pt-7"
                                                       for="textinput">Ticket Type</label>
                                                <div class="col-lg-3">
                                                    <select id="ticket_type" name="ticket_type" class="form-control ">
                                                        <option value="Open"
                                                                @if($ticket->ticket_type === 'Open') selected @endif>
                                                            Open
                                                        </option>
                                                        <option value="Assigned"
                                                                @if($ticket->ticket_type === 'Assigned') selected @endif>
                                                            Assigned
                                                        </option>
                                                        <option value="New"
                                                                @if($ticket->ticket_type === 'New') selected @endif>New
                                                        </option>
                                                        <option value="Resolved"
                                                                @if($ticket->ticket_type === 'Resolved') selected @endif>
                                                            Resolved
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row default-according style-1 faq-accordion"
                                                 id="accordionoc-sub-{{ $key }}">
                                                <div class="row" style="width: 100%;">
                                                    <div class="col-lg-12">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h5 class="mb-0">
                                                                    <button class="btn btn-link collapsed"
                                                                            data-toggle="collapse"
                                                                            data-target="#changelog-{{ $key }}"
                                                                            aria-expanded="false"
                                                                            aria-controls="collapseicon">
                                                                        Change Log
                                                                    </button>
                                                                </h5>
                                                            </div>
                                                            <div class="collapse" id="changelog-{{ $key }}"
                                                                 aria-labelledby="collapseicon"
                                                                 data-parent="#accordionoc-sub-{{ $key }}">
                                                                <div class="card-body">
                                                                    <table class="table table-bordered table-hover table-striped">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td>Feb 21, 2020</td>
                                                                            <td>Due date changed to Mar 21, 2020</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Feb 21, 2020</td>
                                                                            <td>Due date changed to Mar 21, 2020</td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row default-according style-1 faq-accordion"
                                                 id="accordionoc-tasks-{{ $key }}">
                                                <div class="row" style="width: 100%;">
                                                    <div class="col-lg-12">

                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h5 class="mb-0">
                                                                    <button class="btn btn-link collapsed"
                                                                            data-toggle="collapse"
                                                                            data-target="#assigned-tasks-{{ $key }}"
                                                                            aria-expanded="false"
                                                                            aria-controls="collapseicon">
                                                                        Assigned Tasks
                                                                    </button>
                                                                </h5>
                                                            </div>
                                                            <div class="collapse" id="assigned-tasks-{{ $key }}"
                                                                 aria-labelledby="collapseicon"
                                                                 data-parent="#accordionoc-tasks-{{ $key }}">
                                                                <div class="card-body">
                                                                    <table class="table table-bordered table-hover table-striped">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>Assigned Date</th>
                                                                            <th>Task Title</th>
                                                                            <th>Assigned To</th>
                                                                            <th>Due Date</th>
                                                                            <th>Actions</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <tr>
                                                                            <td>Feb 21, 2020</td>
                                                                            <td>Change the Website Header</td>
                                                                            <td>Rishav Das</td>
                                                                            <td>Feb 21, 2020</td>
                                                                            <td>View/Edit/Delete</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Feb 21, 2020</td>
                                                                            <td>Change the Website Header</td>
                                                                            <td>Rishav Das</td>
                                                                            <td>Feb 21, 2020</td>
                                                                            <td>View/Edit/Delete</td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row default-according style-1 faq-accordion"
                                                 id="accordionoc-attachment-{{ $key }}">
                                                <div class="row" style="width: 100%;">
                                                    <div class="col-lg-12">

                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h5 class="mb-0">
                                                                    <button class="btn btn-link collapsed"
                                                                            data-toggle="collapse"
                                                                            data-target="#assigned-attachment-{{ $key }}"
                                                                            aria-expanded="false"
                                                                            aria-controls="collapseicon">
                                                                        Attachments
                                                                    </button>
                                                                </h5>
                                                            </div>
                                                            <div class="collapse" id="assigned-attachment-{{ $key }}"
                                                                 aria-labelledby="collapseicon"
                                                                 data-parent="#accordionoc-attachment-{{ $key }}">
                                                                <div class="card-body">
                                                                    <table class="table table-bordered table-hover table-striped">
                                                                        <tbody>
                                                                        @foreach($ticket->ticket_attachments as $key=>$val)
                                                                            <tr>
                                                                                <td>{{ \Illuminate\Support\Carbon::parse($val->created_at)->format('M d, Y') }}</td>
                                                                                <td>{{ $val->attachment_title }}</td>
                                                                                <td>
                                                                                    <a href="{{ ($val->attachment) }}" target="_blank"><b>Download
                                                                                            Link</b></a></td>
                                                                                <td>View Comments</td>
                                                                            </tr>
                                                                        @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- comments start -->
                                            <div class="timeline-content">
                                                <div class="social-chat">
                                                    @foreach($ticket->ticket_comments as $key=>$val)
                                                        <div class="your-msg">
                                                            <div class="media">
                                                                <img class="img-50 img-fluid m-r-20 rounded-circle"
                                                                     style="margin-top: 20px;"
                                                                     alt=""
                                                                     src="http://localhost/martechportal/public/assets/images/user/lncg-logo-only.jpg"
                                                                     data-original-title="" title="">
                                                                <div class="media-body">
                                                                <span class="f-w-600">{{ \App\User::getUserName(1) }}
                                                                    <span>{{ \Carbon\Carbon::parse($val->created_at)->format('M d, Y')  }} </span>
                                                                </span>
                                                                    <p>{{ $val->comment_body }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="comments-box">
                                                    <div class="media"><img
                                                                class="img-50 img-fluid m-r-20 rounded-circle" alt=""
                                                                src="../assets/images/user/1.jpg" data-original-title=""
                                                                title="">
                                                        <div class="media-body">
                                                            <div class="input-group text-box">
                                                                <input class="form-control input-txt-bx" type="text"
                                                                       name="message_to_send"
                                                                       id="messageSend_{{$ticket->id}}"
                                                                       placeholder="Post Your commnets"
                                                                       data-original-title="" title="">
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-transparent messageAdd"
                                                                            type="button"
                                                                            id="messageAdd_{{ $ticket->id }}"
                                                                            data-original-title="" title=""><i
                                                                                class="fa fa-arrow-right"> </i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- comments end -->

                                            <!-- buttons start -->
                                            <div class="form-group row">
                                                <div class="col-lg-12 text-right mt-5">
                                                    <button type="button" class="btn btn-pill btn-primary"
                                                            style="width:auto;">Add Task
                                                    </button>
                                                    <button type="button" class="btn btn-pill btn-warning"
                                                            style="width:auto;">Add Attachment
                                                    </button>
                                                    <button type="button" class="btn btn-pill btn-primary"
                                                            style="width:auto;">Copy Link
                                                    </button>
                                                    <button type="button" class="btn btn-pill btn-success"
                                                            style="width:auto;">Save and Update
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- buttons end -->

                                        </div>
                                    </div>
                                </div>
                                <!-- text-danger text-primary text-warning text-success -->
                            @endforeach
                        @endif

                    </div>
                </div>


            </div>
            <div class="col-sm-12 col-xl-3 col-lg-3 col-md-3 make-me-sticky">
                <form class="form-horizontal card p-3">
                    <fieldset>

                        <!-- Form Name -->
                        <h5 class="m-t-10 text-center">Available Filters</h5>

                        <!-- Text input-->
                        <div class="form-group row">
                            <label class="col-lg-12 control-label text-lg-left" for="textinput"></label>
                            <div class="col-lg-12">
                                <input id="textinput" name="textinput" type="text" placeholder="Search"
                                       class="form-control  input-md">
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group row">
                            <label class="col-lg-12 control-label text-lg-left" for="textinput">From Date</label>
                            <div class="col-lg-12">
                                <input id="textinput" name="textinput" type="text" placeholder="Date"
                                       class="form-control  input-md">
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group row">
                            <label class="col-lg-12 control-label text-lg-left pt-7" for="textinput">To Date</label>
                            <div class="col-lg-12">
                                <input id="textinput" name="textinput" type="text" placeholder="Date"
                                       class="form-control  input-md">
                            </div>
                        </div>

                        <!-- Select Basic -->
                        <div class="form-group row">
                            <label class="col-lg-12 control-label text-lg-left pt-7" for="selectbasic">Business
                                Name</label>
                            <div class="col-lg-12">
                                <select id="selectbasic" name="selectbasic" class="form-control ">
                                    <option value="1">Option one</option>
                                    <option value="2">Option two</option>
                                </select>
                            </div>
                        </div>

                        <!-- Select Basic -->
                        <div class="form-group row">
                            <label class="col-lg-12 control-label text-lg-left pt-7" for="selectbasic">Assigned
                                To</label>
                            <div class="col-lg-12">
                                {!! Form::select('assigned_to', $assignees, null, ['id' => 'assigned_to', 'class' => 'form-control']); !!}
                            </div>
                        </div>

                        <!-- Select Basic -->
                        <div class="form-group row">
                            <label class="col-lg-12 control-label text-lg-left pt-7" for="selectbasic">Priority</label>
                            <div class="col-lg-12">
                                {!! Form::select('priority', array('Higher' => 'Higher', 'Medium' => 'Medium', 'Lower' => 'Lower', 'None' => 'None'), null, ['id' => 'priority', 'class' => 'form-control']); !!}
                            </div>
                        </div>

                        <!-- Select Basic -->
                        <div class="form-group row">
                            <label class="col-lg-12 control-label text-lg-left pt-7" for="selectbasic">Status</label>
                            <div class="col-lg-12">
                                {!! Form::select('status', array('Pending' => 'Pending', 'In Progress' => 'In Progress', 'Dismiss' => 'Dismiss', 'Completed' => 'Completed'), null, ['id' => 'status', 'class' => 'form-control']); !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-12 text-center">
                                <button type="submit" class="btn btn-pill btn-primary">Filter</button>
                            </div>
                        </div>

                    </fieldset>
                </form>

            </div>
        </div>

    </div>
    <!-- Container-fluid Ends-->
    <!--   modal start -->
    <div class="modal fade" id="addTicketModal" tabindex="-1" role="document"
         aria-labelledby="addBusinessModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="business">Add Ticket</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                </div>


                <form action="{{ route('post_ticket') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="cname">Title</label>
                                        <input required class="form-control" id="title" name="title" type="text"
                                               placeholder="Ticket Title">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="start_date">Start Date</label>
                                            <input name="start_date" id="start_date" class="form-control"
                                                   value="{{ date('Y-m-d') }}"
                                                   id="validationCustom03" type="date" placeholder="Start Date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="deal_size">Attachment</label>
                                        <input required class="form-control" id="attachment" name="attachment"
                                               type="file"
                                               accept="image/x-png,image/jpeg, .pdf, .docx, .jpeg, .png, .svg, .psd, .ai, .eps">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="contact1">Description</label>
                                        <textarea name="description" id="description" class="form-control"
                                                  id="validationCustom02" placeholder="Ticket Description"
                                                  required=""></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-pill btn-secondary" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-pill btn-primary" type="submit">Create Ticket</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!--   modal end -->

@endsection
@section('script')
    {{--    <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>--}}
    {{--    <script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>--}}

    <script>
        {{--$(document).ready(function () {--}}
        {{--    $('#tickets').DataTable({--}}
        {{--        processing: true,--}}
        {{--        serverSide: true,--}}
        {{--        ajax: "{{route('getSupportTicketData')}}",--}}
        {{--        columns: [--}}
        {{--            {data: 'title', name: 'title'},--}}
        {{--            {data: 'description', name: 'description'},--}}
        {{--            {data: 'status', name: 'status'},--}}
        {{--            {data: 'start_date', name: 'start_date'},--}}
        {{--            {data: 'due_date', name: 'due_date'},--}}
        {{--            {data: 'priority', name: 'priority'},--}}
        {{--            {data: 'assigned_to', name: 'assigned_to'},--}}
        {{--            {data: 'parent_task_id', name: 'parent_task_id'},--}}

        {{--        ]--}}
        {{--    });--}}
        {{--});--}}

        $(document).on('click', "#addTicketId", function () {
            $('#addTicketModal').modal('show').on('shown.bs.modal', function () {
            });
        });

        $(".messageAdd").click(function () {
            let ids = $(this).attr('id');
            let ticket_number = ids.split('_')[1];
            let comment_txt = $("#messageSend_" + ticket_number).val();
            var html = '';
            $.ajax({
                url: "{{ url('/commentAdd') }}",
                type: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    ticket_number : ticket_number,
                    comment_txt : comment_txt
                },

                success: function(data) {
                    console.log(data[0].name);
                    html+= '<div class="your-msg">\n' +
                    '     <div class="media">\n' +
                    '         <img class="img-50 img-fluid m-r-20 rounded-circle"\n' +
                    '              style="margin-top: 20px;"\n' +
                    '              alt=""\n' +
                    '              src="http://localhost/martechportal/public/assets/images/user/lncg-logo-only.jpg"\n' +
                    '              data-original-title="" title="">\n' +
                    '         <div class="media-body">\n' +
                    '         <span class="f-w-600">'+data[0].name+'\n' +
                    '             <span>'+data[0].created_at+' </span>\n' +
                    '         </span>\n' +
                    '             <p>'+data[0].comment_body+'</p>\n' +
                    '         </div>\n' +
                    '     </div>\n' +
                    ' </div>';
                    // console.log(html);
                    $('.social-chat').append(html);
                }
            });
        });
    </script>
@endsection

