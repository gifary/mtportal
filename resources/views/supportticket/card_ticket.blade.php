@if(!empty($tickets))
    @foreach($tickets as $key => $ticket)
        <div class="card" id="card_ticket_{{$ticket->id}}">
            <div class="card-header">
                <h5 class="mb-0">
                    <button style="white-space: normal;" class="btn btn-link collapsed d-inline-block" data-toggle="collapse"
                            data-target="#collapseicon-{{ $key }}" aria-expanded="false"
                            aria-controls="collapseicon">

                        @if(strtolower($ticket->ticket_type)=='new')
                            <i class="fa fa-circle text-danger"></i>
                        @elseif(strtolower($ticket->ticket_type)=='assigned')
                            <i class="fa fa-circle text-primary"></i>
                        @elseif(strtolower($ticket->ticket_type)=='open')
                            <i class="fa fa-circle text-warning"></i>
                        @else
                            <i class="fa fa-circle text-success"></i>
                        @endif

                        <div class="row task-acc-full-details">
                            <div class="col-md-7 task-title-res" style="overflow: hidden">
                                <span>{{$ticket->ticket_number}} {{$ticket->title}}</span>
                            </div>
                            <div class="col-md-4 task-acc-right">
                                <div class="res-thumblins task-acc-details">
                                    <p>{{!empty($ticket->user->business) ? $ticket->user->business->cname : ''}}</p>
                                    <p>{{ \Carbon\Carbon::parse($ticket->created_at)->format('d M, Y')  }}</p>
                                    <img class="attachedTo_logo" style="float: left;width: 30px;height: 30px;border-radius: 25px;border: .5px solid #51ea86;margin-top: -5px;"
                                         src=" @if (!empty($ticket->user) && $ticket->user->profile_pic != null){{asset($ticket->user->profile_pic)}} @else {{asset('/')}}assets/images/other-images/receiver-img.jpg @endif" />

                                </div>
                            </div>
                        </div>
                    </button>
                </h5>
            </div>
            <div class="collapse" id="collapseicon-{{ $key }}" aria-labelledby="collapseicon" data-parent="#accordionoc">
                <div class="card-body">
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
                    {{-- tab change log--}}
                    @if(strtolower(\Illuminate\Support\Facades\Auth::user()->role_user->name)!=='client')
                        <div class="row default-according style-1 faq-accordion" id="accordionoc-sub-{{ $key }}">
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
                                            <div class="card-body" id="child_change_log_{{$ticket->id}}">
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(strtolower(\Illuminate\Support\Facades\Auth::user()->role_user->name)!=='client')
                        {{-- tab assigned tasks --}}
                        <div class="row default-according style-1 faq-accordion" id="accordionoc-tasks-{{ $key }}" style="margin-top: -20px">
                            <div class="row" style="width: 100%;">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0 d-inline-block" style="width: 70%">
                                                <button class="btn btn-link collapsed"
                                                        data-toggle="collapse"
                                                        data-target="#assigned-tasks-{{ $key }}"
                                                        aria-expanded="false"
                                                        aria-controls="collapseicon">
                                                    Assigned Tasks
                                                </button>
                                            </h5>
                                            <button type="button" class="btn btn-pill btn-primary pull-right" style="width:auto; margin-right: 40px;" onclick="addTask('{{$ticket->id}}')">Add</button>
                                        </div>
                                        <div class="collapse" id="assigned-tasks-{{ $key }}"
                                             aria-labelledby="collapseicon"
                                             data-parent="#accordionoc-tasks-{{ $key }}">
                                            <div class="card-body">
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
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- tab attachment --}}
                    <div class="row default-according style-1 faq-accordion" id="accordionoc-attachment-{{ $key }}" style="margin-top: -20px">
                        <div class="row" style="width: 100%;">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0 d-inline-block" style="width: 70%">
                                            <button class="btn btn-link collapsed"
                                                    data-toggle="collapse"
                                                    data-target="#assigned-attachment-{{ $key }}"
                                                    aria-expanded="false"
                                                    aria-controls="collapseicon">
                                                Attachments
                                            </button>
                                        </h5>
                                        <button type="button" class="btn btn-pill btn-primary pull-right" style="width:auto; margin-right: 40px;" onclick="addAttachment('{{$ticket->id}}')">Add</button>
                                    </div>
                                    <div class="collapse" id="assigned-attachment-{{ $key }}"
                                         aria-labelledby="collapseicon"
                                         data-parent="#accordionoc-attachment-{{ $key }}">
                                        <div class="card-body">
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
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- comments start -->
                    <div class="row default-according style-1 faq-accordion" id="accordionoc-comment-{{ $key }}" style="margin-top: -20px">
                        <div class="row" style="width: 100%;">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed"
                                                    data-toggle="collapse"
                                                    data-target="#assigned-comment-{{ $key }}"
                                                    aria-expanded="false"
                                                    aria-controls="collapseicon">
                                                Comment
                                            </button>
                                        </h5>
                                    </div>
                                    <div class="collapse" id="assigned-comment-{{ $key }}"
                                         aria-labelledby="collapseicon"
                                         data-parent="#accordionoc-comment-{{ $key }}">
                                        <div class="card-body">
                                            <div class="col call-chat-body">
                                                <div class="card" style="-webkit-box-shadow:1px 5px 24px 0 rgba(0, 0, 0, 0.1); box-shadow: 1px 5px 24px 0 rgba(0, 0, 0, 0.1); width:100%;">
                                                    <div class="card-body p-0">
                                                        <div id="row chat-box">
                                                            <div class="col chat-right-aside" style="max-width: 100% !important; flex: 0 0 100%;">
                                                                <!-- chat start-->
                                                                <div class="chat">
                                                                    <!-- chat-header end-->
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
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="chat-message clearfix">
                                                        <div class="form-group row comment-box">
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

                            </div>
                        </div>
                    </div>
                    <!-- comments end -->
                </div>
            </div>
        </div>
        <!-- text-danger text-primary text-warning text-success -->
    @endforeach
@endif

