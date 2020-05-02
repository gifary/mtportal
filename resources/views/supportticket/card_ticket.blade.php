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
            <div class="collapse" id="collapseicon-{{ $key }}" aria-labelledby="collapseicon" data-parent="#accordionoc">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="control-label text-lg-left" for="textinput">Detailed Description</label>
                                <textarea id="desc" name="desc" rows="4" placeholder="" class="form-control">{{$ticket->description}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label class="control-label" for="textinput">Priority</label>
                                {!! Form::select('priority', array('Higher' => 'Higher', 'Medium' => 'Medium', 'Lower' => 'Lower', 'None' => 'None'), $ticket->priority, ['id' => 'priority', 'class' => 'form-control']); !!}
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="control-label" for="textinput">Status</label>
                                {!! Form::select('status', array('New' => 'New', 'Open' => 'Open', 'Assigned' => 'Assigned', 'Resolved' => 'Resolved'), $ticket->status, ['id' => 'status', 'class' => 'form-control']); !!}
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
                                <input id="textinput" name="textinput" type="date" placeholder="Date" class="form-control" value="{{$ticket->start_date}}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="control-label" for="textinput">Due Date</label>
                                <input id="textinput" name="textinput" type="date" placeholder="Date" class="form-control" value="{{$ticket->due_date}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label class="control-label" for="textinput">Tier</label>
                                <select id="selectbasic" name="selectbasic" class="form-control ">
                                    <option value="1">Option one</option>
                                    <option value="2">Option two</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="control-label" for="textinput">Ticket Type</label>
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
                    </div>
                    {{-- tab change log--}}
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
                    {{-- tab assigned tasks --}}
                    <div class="row default-according style-1 faq-accordion" id="accordionoc-tasks-{{ $key }}" style="margin-top: -20px">
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
                    {{-- tab attachment --}}
                    <div class="row default-according style-1 faq-accordion" id="accordionoc-attachment-{{ $key }}" style="margin-top: -20px">
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
                                                @foreach($ticket->ticket_attachments as $val)
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

