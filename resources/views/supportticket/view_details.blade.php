@extends('layouts.master')
@section('title', 'Leads | Martechportal')
@section('style')
    <style>
        /* Styles for the comment section */
        @media only screen
        and (min-device-width : 320px)
        and (max-device-width : 765px) {
            div.comment-box > div.col-md-1{
                display: none;
            }
            div.comment-box > div.col-md-3{
                padding-top: 20px;
                text-align: right;
            }
        }
        @media only screen and (max-width: 767px)
        {.chat-box .chat-right-aside .chat .chat-msg-box {
            height: 400px!important;
        }}


        .chat-box .chat-right-aside .chat .chat-message{right: 0;
            left: 0;}
        .chat-message{width: 100%!important}
        .chat-box .chat-right-aside .chat .chat-msg-box .other-message{border-top-right-radius: 10px!important}
        .comment-box{padding-top: 20px!important;padding-bottom:0px!important; }

    </style>

@endsection

@section('breadcrumb-title', 'Detail Ticket')
@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{route('supportticket')}}">Support Ticket</a></li>
    <li class="breadcrumb-item active">View Ticket</li>
@endsection
{{-- @stop --}}


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                            <li class="nav-item"><a class="nav-link active show" id="top-home-tab" data-toggle="tab" href="#top-detail" role="tab" aria-controls="top-home" aria-selected="true" data-original-title="" title=""><i class="icofont icofont-ui-home"></i>Detail</a></li>
                            @if(strtolower(\Illuminate\Support\Facades\Auth::user()->role_user->name)!=='client')
                                <li class="nav-item"><a class="nav-link" id="change-log-top-tab" data-toggle="tab" href="#top-change-log" role="tab" aria-controls="top-profile" aria-selected="false" data-original-title="" title=""><i class="icofont icofont-man-in-glasses"></i>Change Log</a></li>
                                <li class="nav-item"><a class="nav-link" id="assigned-task-top-tab" data-toggle="tab" href="#top-assigned-task" role="tab" aria-controls="top-contact" aria-selected="false" data-original-title="" title=""><i class="icofont icofont-contacts"></i>Assigned Task</a></li>
                            @endif
                            <li class="nav-item"><a class="nav-link" id="attachmet-top-tab" data-toggle="tab" href="#top-attachment" role="tab" aria-controls="top-contact" aria-selected="false" data-original-title="" title=""><i class="icofont icofont-contacts"></i>Attachment</a></li>
                            <li class="nav-item"><a class="nav-link" id="comment-top-tab" data-toggle="tab" href="#top-comment" role="tab" aria-controls="top-contact" aria-selected="false" data-original-title="" title=""><i class="icofont icofont-contacts"></i>Comment</a></li>
                        </ul>
                        <div class="tab-content" id="top-tabContent">
                            <div class="tab-pane fade active show" id="top-detail" role="tabpanel" aria-labelledby="top-home-tab">
                                <form action="{{route('update.ticket',$ticket->id)}}" method="put" class="form-ticket" id="form_{{$ticket->id}}">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="control-label text-lg-left" for="textinput">Detailed Description</label>
                                                <textarea id="desc" name="description" rows="4" placeholder="" class="form-control">{{$ticket->description}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    @if(strtolower(\Illuminate\Support\Facades\Auth::user()->role_user->name)!=='client')
                                        <div class="row">

                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label class="control-label" for="textinput">Priority</label>
                                                    {!! Form::select('priority', array('Higher' => 'Higher', 'Medium' => 'Medium', 'Lower' => 'Lower'), $ticket->priority, ['id' => 'priority', 'class' => 'form-control']); !!}
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label class="control-label" for="textinput">Ticket Type/Status</label>
                                                    {!! Form::select('ticket_type', array('Open' => 'Open', 'Assigned' => 'Assigned', 'New' => 'New','Resolved'=>'Resolved'), $ticket->ticket_type, ['id' => 'priority', 'class' => 'form-control']); !!}
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label class="control-label" for="textinput">Assigned By</label>
                                                    {!! Form::select('assigned_by', $assignees, $ticket->assigned_to, ['id' => 'assigned_by', 'class' => 'form-control']); !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label class="control-label" for="textinput">Assigned To</label>
                                                    {!! Form::select('assigned_to', $assignees, $ticket->assigned_to, ['id' => 'assigned_to', 'class' => 'form-control']); !!}
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label class="control-label" for="textinput">Start Date</label>
                                                    <input id="textinput" name="start_date" type="date" placeholder="Date" class="form-control" value="{{$ticket->start_date}}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label class="control-label" for="textinput">Due Date</label>
                                                    <input id="textinput" name="due_date" type="date" placeholder="Date" class="form-control" value="{{$ticket->due_date}}">
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-12">
                                            <button type="button" class="btn btn-pill btn-success pull-right" id="button_submit_from_{{$ticket->id}}" data-btn-text="Save and Update" onclick="submitForm('{{$ticket->id}}')" style="width:auto;">Save and Update</button>
                                            @if(strtolower(\Illuminate\Support\Facades\Auth::user()->role_user->name)!=='client')
                                                <button type="button" class="mr-2 btn btn-pill btn-warning pull-right" id="button_submit_from_{{$ticket->id}}" data-btn-text="Save and Update" onclick="archived('{{$ticket->id}}')" style="width:auto;">Archived</button>
                                            @endif
                                            <button type="button" class="mr-2 btn btn-pill btn-primary pull-right" data-btn-text="Save and Update" onclick="copyLink('{{route("show.ticket",$ticket->id)}}')" style="width:auto;">Copy Link</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @if(strtolower(\Illuminate\Support\Facades\Auth::user()->role_user->name)!=='client')
                                <div class="tab-pane fade" id="top-change-log" role="tabpanel" aria-labelledby="profile-top-tab">
                                    @foreach($ticket->logs as $log)
                                        <div class="row default-according style-1 faq-accordion" id="toogle_log{{ $log->id }}" style="margin-top: -20px">
                                            <div class="row" style="width: 100%;">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5 class="mb-0">
                                                                <button class="btn btn-link collapsed"
                                                                        data-toggle="collapse"
                                                                        data-target="#toogle_log-{{ $log->id }}"
                                                                        aria-expanded="false"
                                                                        aria-controls="collapseicon">
                                                                    {{$log->user->name}}, {{ $log->updated_at }}
                                                                </button>
                                                            </h5>
                                                        </div>
                                                        <div class="collapse" id="toogle_log-{{ $log->id }}"
                                                             aria-labelledby="collapseicon"
                                                             data-parent="#toogle_logb-{{ $log->id }}">
                                                            <div class="card-body">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>Label</th>
                                                                        <th>From</th>
                                                                        <th>To</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach(json_decode($log->data) as $key_change=>$data)
                                                                        <tr>
                                                                            <td>{{ $key_change }}</td>
                                                                            <td>{{ $data->from  }}</td>
                                                                            <td> {{ $data->to  }}</td>
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
                                    @endforeach
                                </div>

                                <div class="tab-pane fade" id="top-assigned-task" role="tabpanel" aria-labelledby="contact-top-tab">
                                    <button type="button" class="btn btn-pill btn-primary pull-right" style="width:auto; margin-right: 40px;" onclick="addTask('{{$ticket->id}}')">Add</button>
                                    <table class="table table-bordered table-hover table-striped" id="table_task_{{$ticket->id}}">
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
                                        <tr></tr>
                                        @foreach($ticket->tasks as $task)
                                            <tr id="task_row{{$task->id}}">
                                                <td>{{ \Carbon\Carbon::parse($task->created_at)->format('d M, Y')  }}</td>
                                                <td>{{$task->title}}</td>
                                                <td>{{$task->assignedto->name}}</td>
                                                <td>{{ \Carbon\Carbon::parse($task->due_date)->format('d M, Y')  }}</td>
                                                <td>
                                                    <i class="icofont icofont-trash text-primary" onclick="deleteTask('{{$task->id}}')"></i>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                            <div class="tab-pane fade" id="top-attachment" role="tabpanel" aria-labelledby="contact-top-tab">
                                <button type="button" class="btn btn-pill btn-primary pull-right" style="width:auto; margin-right: 40px;" onclick="addAttachment('{{$ticket->id}}')">Add</button>
                                <table class="table table-bordered table-hover table-striped" id="table_attachment_{{$ticket->id}}">
                                    <tbody>
                                    <tr></tr>
                                    @foreach($ticket->ticket_attachments as $ta)
                                        <tr id="attachment_row_{{$ta->id}}">
                                            <td>{{ \Illuminate\Support\Carbon::parse($ta->created_at)->format('M d, Y') }}</td>
                                            <td>{{ $ta->attachment_title }}</td>
                                            <td>
                                                <a href="{{ ($ta->attachment) }}" target="_blank"><i class="icofont icofont-download-alt"></i></a>
                                                <a onclick="showCommentAttachment('{{$ta->id}}');return false" href="#"><i class="icofont icofont-chat text-primary"></i></a>
                                                @if(strtolower(\Illuminate\Support\Facades\Auth::user()->role_user->name)!=='client')
                                                    <a onclick="deleteAttachment('{{$ta->id}}');return false" href="#"><i class="icofont icofont-trash text-danger"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="top-comment" role="tabpanel" aria-labelledby="contact-top-tab">
                                <div class="col-12">
                                    <div class="chat-history chat-msg-box custom-scrollbar">
                                        <div id="comment-box-{{$ticket->id}}" style="margin-top: 15px">
                                            @foreach($ticket->ticket_comments as $val)
                                                @if ($val->user_id == \Illuminate\Support\Facades\Auth::user()->id)
                                                    <div class="message my-message" style="width: 100%; border: 1px solid #e8e8e8; border-radius: 10px; margin-bottom: 15px;padding: 20px" id="comment_box_{{$val->id}}">
                                                        <img class="rounded-circle float-left chat-user-img img-30" src="{{asset($val->user->profile_pic)}}" alt="{{$val->user->name}}" style="margin-top: -30px">
                                                        <div class="message-data text-right">
                                                            <span class="message-data-time">{{ $val->updated_at  }}, {{$val->user->name}}</span>
                                                        </div>
                                                        <p id="comment_body_{{$val->id}}">{{$val->comment_body}}</p>
                                                        <div class="row float-right" style="background-color: #efefef; border-radius: 5px;">
                                                            <div class="col-xs-6" style="border-right: 1px solid #dedede;">
                                                                <button class="btn btn-xs form-inline" onclick="editComment('{{$val->id}}','{{$val->comment_body}}')"><i class="icon-pencil"></i></button>
                                                            </div>
                                                            <div class="col-xs-6">
                                                                <button class="btn btn-xs form-inline" onclick="deleteComment('{{$val->id}}')"><i class="icon-trash"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="message other-message pull-right" style="width: 100%; border: 1px solid #e8e8e8; border-radius: 10px; margin-bottom: 15px;padding: 20px">
                                                        <img class="rounded-circle float-left chat-user-img img-30" src="{{asset($val->user->profile_pic)}}" alt="{{$val->user->name}}" style="margin-top: -30px">
                                                        <div class="message-data">
                                                            <span class="message-data-time">{{ $val->updated_at  }}, {{$val->user->name}}</span>
                                                        </div>
                                                        <p>{{$val->comment_body}}</p>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 20px">
                                        <div class="col-md-1">
                                            <img class="rounded-circle float-right img-40" src="{{asset(\Illuminate\Support\Facades\Auth::user()->profile_pic)}}" alt="">
                                        </div>
                                        <div class="col-md-9">
                                            {{ csrf_field() }}
                                            <input placeholder="Add Comment" class="form-control" id="comment_{{$ticket->id}}">
                                        </div>
                                        <div class="">
                                            <button class="btn btn-pill btn-primary text-light add-comment" id="button_add_comment_{{$ticket->id}}" onclick="addComment('{{$ticket->id}}')" data-id="{{$ticket->id}}" type="button" data-btn-text="<i class='icon-angle-right'></i>"><i class="icon-angle-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="edit-comment-form" tabindex="-1" role="document" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="business">Edit Comment</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <form action="#" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="cname">Comment</label>
                                                <input type="hidden" id="comment_id_form" name="comment_id">
                                                <input required class="form-control" id="comment_form" name="title" type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-pill btn-secondary" type="button" data-dismiss="modal">Close</button>
                                <button class="btn btn-pill btn-primary" type="button" id="edit_comment">Edit comment</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!--   modal end -->

            {{--    model add task--}}
            <div class="modal fade" id="addTask" tabindex="-1" role="document" aria-labelledby="addBusinessModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="business">Add Task</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                        </div>
                        <form action="{{ route('save_task') }}" method="POST" enctype="multipart/form-data" id="form_add_task">
                        <input type="hidden" name="ticket_id" id="ticket_id_of_task">
                        <div class="modal-body ">
                            <!-- Container-fluid starts-->
                            <!-- Container-fluid Ends-->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="cname">Title</label>
                                            <input required class="form-control" id="title_task" name="title" type="text"
                                                   placeholder="Task Title">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="start_date">Due Date</label>
                                                <input name="due_date" id="due_date_task" class="form-control"
                                                       value="{{ date('Y-m-d') }}" id="validationCustom03" type="date"
                                                       placeholder="Start Date">
                                                <input type="hidden" name="start_date" value="{{date('Y-m-d')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="deal_size">Attachment</label>
                                            <input class="form-control" multiple id="attachment_task" name="attachment[]"
                                                   type="file"
                                                   accept="image/x-png,image/jpeg, .pdf, .docx, .jpeg, .png, .svg, .psd, .ai, .eps">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="start_date">Assigned To</label>
                                                {!! Form::select('assigned_to_task', $assignees, null, ['id' => 'assigned_to_task', 'class' => 'form-control']); !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="contact1">Description</label>
                                            <textarea name="description" id="description_task" class="form-control"
                                                      placeholder="Task Description"
                                                      required=""></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-pill btn-secondary" type="button" data-dismiss="modal">Close</button>
                            <button class="btn btn-pill btn-primary" type="submit" id="create_task">Create Task</button>
                        </div>
                        </form>
                    </div>

                </div>
            </div>
            {{--    end modal add task--}}

            {{-- start modal attachment --}}
            <div class="modal fade" id="addAttachment" tabindex="-1" role="document" aria-labelledby="addBusinessModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="business">Add Attachment</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                        </div>

                        <input type="hidden" name="ticket_id" id="ticket_id_of_attachment">
                        <div class="modal-body ">
                            <!-- Container-fluid starts-->
                            <!-- Container-fluid Ends-->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="deal_size">Attachment</label>
                                    <input class="form-control" id="attachment_attachment" name="attachment"
                                           type="file"
                                           accept="image/x-png,image/jpeg, .pdf, .docx, .jpeg, .png, .svg, .psd, .ai, .eps">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-pill btn-primary" type="button" id="submit_attachment">Add Attachment</button>
                        </div>
                    </div>

                </div>
            </div>
            {{-- end modal attachment --}}

            {{-- start modal attachment comment --}}
            <div class="modal fade" id="addAttachmentComment" tabindex="-1" role="document" aria-labelledby="addAttachmentComment"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div id="body_attachment_comment"></div>
                    </div>
                </div>
            </div>
            {{-- end modal attachment comment --}}
        </div>
    </div>
@endsection
@section('script')
    <script>
        var role = '{{ \Illuminate\Support\Facades\Auth::user()->role_user->name  }}'
        $("#search_card").on('keyup',function () {
            let val = $(this).val()

            $.ajax({
                url: "{{ url('/searchTicket') }}",
                type: 'get',
                data: {
                    search : val
                },
                dataType:'html',
                success: function(data) {
                    $("#card_ticket").html(data)
                }
            });
        })

        $("#switchtable").on('click',function () {
            $("#card_ticket").hide()
            $("#filter_search").hide()
            $("#table_ticker").show()
            $("#filter_table").show()
        });

        $("#switchcard").on("click",function () {
            $("#card_ticket").show()
            $("#filter_search").show()
            $("#table_ticker").hide()
            $("#filter_table").hide()
        })

        $(document).on('click', "#addTicketId", function () {
            $('#addTicketModal').modal('show').on('shown.bs.modal', function () {
            });
        });

        $(document).ready(function() {
            $('#ticket-table').DataTable();
        } );

        function addTask(id) {
            $("#ticket_id_of_task").val(id)
            $("#addTask").modal('show');
        }

        function addAttachment(id) {
            $("#ticket_id_of_attachment").val(id)
            $("#addAttachment").modal('show');
        }

        function copyLink(value) {
            var tempInput = document.createElement("input");
            tempInput.style = "position: absolute; left: -1000px; top: -1000px";
            tempInput.value = value;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);

            $.notify('Link copied', {
                type: 'success',
                allow_dismiss: true,
                delay: 100,
                timer: 300
            })
        }

        function deleteTask(id) {
            var url = '/supportticket/'+id+'/deleteTask'
            $.ajax({
                url: url,
                type: 'delete',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                dataType:'json',
                success: function(data) {
                    $.notify('Delete success', {
                        type: 'success',
                        allow_dismiss: true,
                        delay: 100,
                        timer: 300
                    })
                    $("#task_row"+id).remove()
                }
            });
        }

        function deleteAttachment(id) {
            var url = '/supportticket/'+id+'/deleteAttachment'
            $.ajax({
                url: url,
                type: 'delete',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                dataType:'json',
                success: function(data) {
                    $.notify('Delete success', {
                        type: 'success',
                        allow_dismiss: true,
                        delay: 100,
                        timer: 300
                    })
                    $("#attachment_row_"+id).remove()
                }
            });

        }

        function submitForm(id) {
            var form = $("#form_"+id);
            var url = form.attr('action');

            var btn =$("#button_submit_from_"+id);
            $(btn).buttonLoader('start');

            $.ajax({
                type: "PUT",
                url: url,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                dataType:'html',
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    $.notify('Success update', {
                        type: 'success',
                        allow_dismiss: true,
                        delay: 100,
                        timer: 300
                    })
                    $(btn).buttonLoader('stop');
                    $("#child_change_log_"+id).append(data)
                }
            });
        }

        function archived(id)
        {
            var url = '/supportticket/'+id+'/archived'
            $.ajax({
                url: url,
                type: 'get',
                dataType:'json',
                success: function(data) {
                    $.notify('Success archived', {
                        type: 'success',
                        allow_dismiss: true,
                        delay: 100,
                        timer: 300
                    })
                    //redirect to list support ticket
                    window.location.href='/supportticket'
                }
            });
        }

        function editComment(id,comment)
        {
            // show modal
            $("#comment_id_form").val(id)
            $("#comment_form").val(comment)
            $("#edit-comment-form").modal('show')
        }

        function deleteComment(id)
        {
            $.ajax({
                url: "{{ url('/commentDelete') }}",
                type: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    ticket_number : id
                },
                dataType:'json',
                success: function(data) {
                    $.notify('Delete comment success', {
                        type: 'success',
                        allow_dismiss: true,
                        delay: 100,
                        timer: 300
                    })
                    $("#comment_box_"+id).remove()
                }
            });
        }

        function showCommentAttachment(id)
        {
            var url = '/supportticket/'+id+'/showCommentAttachment'
            $.ajax({
                url: url,
                type: 'get',
                dataType:'html',
                success: function(data) {
                    $("#body_attachment_comment").html(data)
                    $("#addAttachmentComment").modal('show')
                }
            });
        }

        function addCommentAttachment(e)
        {
            var comment = $("#comment_attachment").val()
            var ticket_attachment_id = $("#ticket_attachment_id").val()
            var url = '/supportticket/'+ticket_attachment_id+'/addCommentAttachment'
            $.ajax({
                url: url,
                type: 'post',
                dataType:'json',
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                data :{
                    comment:comment
                },
                success: function(data) {
                    $("#addAttachmentComment").modal('hide')
                    $.notify('Success add comment', {
                        type: 'success',
                        allow_dismiss: true,
                        delay: 100,
                        timer: 300
                    })
                }
            });
        }

        $("#form_add_task").on('submit',function(e){
            e.preventDefault()
            var form_data = new FormData();
            var totalfiles = document.getElementById('attachment_task').files.length;
            for (var index = 0; index < totalfiles; index++) {
                form_data.append("files[]", document.getElementById('attachment_task').files[index]);
            }

            var ticket_id = $("#ticket_id_of_task").val();

            form_data.append('ticket_id',ticket_id);
            form_data.append('title',$("#title_task").val());
            form_data.append('description',$("#description_task").val());
            form_data.append('due_date',$("#due_date_task").val());
            form_data.append('assigned_to',$("#assigned_to_task").val());

            var btn =$("#create_task");
            $(btn).buttonLoader('start');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                type:"post",
                url: "{!! route('addTask') !!}",
                data: form_data,
                contentType: false,
                processData: false,
                dataType:'json',
            }).done (function(data, textStatus, jqXHR){
                // append data to table
                let createdAt = moment(data.data.created_at).format('MMM DD , Y')
                let title = data.data.title
                let assignedto = data.data.assignedto.name
                let due_date = moment(data.data.due_date).format('MMM DD , Y')
                let id = data.data.id
                var html=''

                html+=' <tr id="task_row'+id+'">'
                html+='<td>'+createdAt+'</td>'
                html+='<td>'+title+'</td>'
                html+='<td>'+assignedto+'</td>'
                html+='<td>'+due_date+'</td>'
                html+='<td><i class="icofont icofont-trash text-primary" onclick="deleteTask('+id+')"></i></td>'
                html+='</tr>'

                $('#table_task_'+data.data.ticket_id+' tr:last').after(html);

                $(btn).buttonLoader('stop');
                document.getElementById("form_add_task").reset();
                $("#addTask").modal('hide');
                $.notify('Create task success', {
                    type: 'success',
                    allow_dismiss: true,
                    delay: 100,
                    timer: 300
                })

            }).fail (function(jqXHR, textStatus, errorThrown){
                $.notify('Something wrong', {
                    type: 'warning',
                    allow_dismiss: true,
                    delay: 100,
                    timer: 300
                })
                $(btn).buttonLoader('stop');
            });
        })

        $("#submit_attachment").on('click',function () {
            var files = $('#attachment_attachment')[0].files[0];
            if(files===undefined)
            {
                $.notify('Attachment required', {
                    type: 'warning',
                    allow_dismiss: true,
                    delay: 100,
                    timer: 300
                })
                return
            }
            var fd = new FormData();

            fd.append('file',files);
            fd.append('ticket_id',$("#ticket_id_of_attachment").val());

            var btn =$("#submit_attachment");
            $(btn).buttonLoader('start');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                type:"post",
                url: "{!! route('addAttachment') !!}",
                data: fd,
                contentType: false,
                processData: false,
                dataType:'json',
            }).done (function(data, textStatus, jqXHR){
                let id = data.data.id
                let createdAt = moment(data.data.created_at).format('MMM DD , Y')
                $("#attachment_attachment").val('')
                // append to table attachment
                var html = '<tr id="attachment_row_'+id+'">'
                html+='<td>'+createdAt+'</td>'
                html+='<td>'+data.data.attachment_title+'</td>'
                if(role.toLowerCase()!=='client')
                {
                    html+='<td><a href="'+data.data.attachment+'" target="_blank"><i class="icofont icofont-download-alt"></i></a>' +
                        ' <a onclick="showCommentAttachment('+id+');return false" href="#"><i class="icofont icofont-chat text-primary"></i></a>' +
                        '  <a onclick="deleteAttachment('+id+');return false" href=""><i class="icofont icofont-trash text-danger"></i></a></td>'
                }else{
                    html+='<td>' +
                        '<a href="'+data.data.attachment+'" target="_blank"><i class="icofont icofont-download-alt"></i></a>' +
                        '<a onclick="showCommentAttachment('+id+');return false" href="#"><i class="icofont icofont-chat text-primary"></i></a>' +
                        ' </td>'
                }

                html+='</tr>'
                $('#table_attachment_'+data.data.ticket_id+' tr:last').after(html);
                $("#addAttachment").modal('hide');
                $.notify('Upload success', {
                    type: 'success',
                    allow_dismiss: true,
                    delay: 100,
                    timer: 300
                })
                $(btn).buttonLoader('stop');
            }).fail (function(jqXHR, textStatus, errorThrown){
                $.notify('Something wrong', {
                    type: 'warning',
                    allow_dismiss: true,
                    delay: 100,
                    timer: 300
                })
                $(btn).buttonLoader('stop');
            });
        });

        $("#edit_comment").on('click',function () {
            // update comment
            let id = $("#comment_id_form").val()
            let comment = $("#comment_form").val()
            if(comment.length<2){
                $.notify('Comment is required', {
                    type: 'warning',
                    allow_dismiss: true,
                    delay: 100,
                    timer: 300
                })

                return
            }

            $.ajax({
                url: "{{ url('/commentEdit') }}",
                type: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    ticket_number : id,
                    comment_txt : comment
                },
                dataType:'json',
                success: function(data) {
                    $.notify('Edit comment success', {
                        type: 'success',
                        allow_dismiss: true,
                        delay: 100,
                        timer: 300
                    })
                    $("#comment_body_"+id).text(comment)
                    $("#edit-comment-form").modal('hide')
                }
            });
        })

        function addComment(id)
        {

            let id_ticket = id;
            let comment = $("#comment_"+id_ticket).val()
            if(comment.length<2){
                $.notify('Comment is required', {
                    type: 'warning',
                    allow_dismiss: true,
                    delay: 100,
                    timer: 300
                })

                return
            }
            var btn =$("#button_add_comment_"+id);
            $(btn).buttonLoader('start');

            $.ajax({
                url: "{{ url('/commentAdd') }}",
                type: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    ticket_number : id_ticket,
                    comment_txt : comment
                },
                dataType:'html',
                success: function(data) {
                    $.notify('Add comment success', {
                        type: 'success',
                        allow_dismiss: true,
                        delay: 100,
                        timer: 300
                    })
                    $("#comment_"+id_ticket).val("")
                    $('#comment-box-'+id_ticket).append(data);
                    $(btn).buttonLoader('stop');
                    $(btn).html('<i class="icon-angle-right"></i>');
                }
            });
        }
    </script>
@endsection
