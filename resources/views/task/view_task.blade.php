@extends('layouts.master')
@section('title', 'View Task | Martechportal')
@section('style')
    <style>
        .select2-container {
            width: 100% !important;
        }

        .label-container {
            position: fixed;
            bottom: 48px;
            right: 105px;
            display: table;
            visibility: hidden;
        }

        .label-text {
            color: #FFF;
            background: rgba(51, 51, 51, 0.5);
            display: table-cell;
            vertical-align: middle;
            padding: 10px;
            border-radius: 3px;
        }

        .label-arrow {
            display: table-cell;
            vertical-align: middle;
            color: #333;
            opacity: 0.5;
        }

        .float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 40px;
            background-color: #06C;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            box-shadow: 2px 2px 3px #999;
        }

        .my-float {
            font-size: 24px;
            margin-top: 18px;
        }

        a.float+div.label-container {
            visibility: hidden;
            opacity: 0;
            transition: visibility 0s, opacity 0.5s ease;
        }

        a.float:hover+div.label-container {
            visibility: visible;
            opacity: 1;
        }
    </style>
@endsection

@section('breadcrumb-title', 'View Task')

@section('breadcrumb-items')
    <li class="breadcrumb-item active">View Task</li>
@endsection
@section('breadcrumb-buttons')

    <button class=" btn btn-pill btn-primary text-light" type="button" data-toggle="modal" data-target="#addTicketModal"
            data-whatever="@getbootstrap" id="addTicketId" name="addTicketId" data-original-title="" title="">Create Task
    </button>
@endsection

@section('content')

    <!-- Container-fluid starts  -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-xl-12 col-lg-12 col-md-12">

                <div class="row">
                    <div class="col-sm-6 col-xl-3 col-lg-6">
                        <div class="card o-hidden">
                            <div class="bg-warning card-body">
                                <div class="media1 static-top-widget1">
                                    <div class="media-body"><span class="m-0">Pending</span>
                                        <h4 class="mb-0 counter">{{\App\Task::where('status',2)->count()}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3 col-lg-6">
                        <div class="card o-hidden">
                            <div class="bg-primary card-body">
                                <div class="media1 static-top-widget1">
                                    <div class="media-body"><span class="m-0">In Progress</span>
                                        <h4 class="mb-0 counter">{{\App\Task::where('status',3)->count()}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3 col-lg-6">
                        <div class="card o-hidden">
                            <div class="bg-success card-body">
                                <div class="media1 static-top-widget1">
                                    <div class="media-body"><span class="m-0">Completed</span>
                                        <h4 class="mb-0 counter">{{\App\Task::where('status',1)->count()}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3 col-lg-6">
                        <div class="card o-hidden">
                            <div class="bg-danger card-body">
                                <div class="media1 static-top-widget1">
                                    <div class="media-body"><span class="m-0">Archive</span>
                                        <h4 class="mb-0 counter">{{\App\Task::where('status',0)->count()}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row default-according style-1 faq-accordion" id="accordionoc">
                    <div class="col-xl-12 col-lg-12 col-md-12">

                        @foreach( $tasks as $key=>$task)
                            @php
                                $user=\App\User::where('id',$task->assigned_to)->first();

                            @endphp
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        {{-- Styles Defined at assets\css\responsive.css --}}
                                        <button style="white-space: normal;" class="btn btn-link res-pons"
                                                data-toggle="collapse" type="button" data-target="#collapseicon-{{$key}}"
                                                aria-expanded="true" aria-controls="collapseicon" data-original-title="" title="">
                                            <i
                                                class="fa fa-circle @if($task->status === 1) text-success @elseif($task->status === 2) text-warning @elseif($task->status === 3) text-primary  @elseif($task->status === 0) text-danger @else text-dark  @endif"></i>

                                            <div class="row task-acc-full-details">
                                                <div class="col-md-7 task-title-res">
                                                    <span>{{$task->title}}</span>
                                                </div>
                                                <div class="col-md-4 task-acc-right">
                                                    <div class="res-thumblins task-acc-details">
                                                        <p>{{$user->name}}</p>
                                                        <p>{{ \Carbon\Carbon::parse($task->created_at)->format('d M, Y')  }}</p>
                                                        <img class="attachedTo_logo" style="float: left;width: 30px;height: 30px;border-radius: 25px;border: .5px solid #51ea86;margin-top: -5px;"
                                                             src=" @if ($user->profile_pic !=Null){{asset($user->profile_pic)}} @else {{asset('/')}}assets/images/other-images/receiver-img.jpg @endif" />

                                                    </div>
                                                </div>
                                            </div>
                                        </button>
                                    </h5>
                                </div>
                                <div class="collapse" id="collapseicon-{{$key}}" aria-labelledby="collapseicon"
                                     data-parent="#accordionoc">

                                    <div class="card-body">
                                        {!! Form::open(array('url' => '/update-task','method'=>'post','class'=>'form-control
                                        ','id'=>'','enctype'=>'multipart/form-data',)) !!}


                                        <div class="form-group row">
                                            <label class="col-lg-12 control-label text-lg-left" for="textinput">Detailed
                                                Description</label>
                                            <div class="col-lg-12">
                                        <textarea id="desc" name="desc" rows="4" placeholder=""
                                                  class="form-control">{{$task->description}}</textarea>
                                                <input type="hidden" name="id" value="{{$task->id}}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-3 control-label text-right pt-7"
                                                   for="textinput">Priority</label>
                                            <div class="col-lg-3">
                                                <select id="priority" class="form-control" name="priority">
                                                    <option @if($task->priority === 3) selected @endif value="3">High</option>
                                                    <option @if($task->priority === 2) selected @endif value="2">Medium</option>
                                                    <option @if($task->priority === 1) selected @endif value="1">Low</option>
                                                    <option @if($task->priority === 0) selected @endif value="0">None</option>
                                                </select>
                                            </div>
                                            <label class="col-lg-3 control-label text-right pt-7" for="textinput">Status</label>
                                            <div class="col-lg-3">
                                                <select id="status" class="form-control" name="status">
                                                    <option @if($task->status === 2) selected @endif value="2" >Pending</option>
                                                    <option @if($task->status === 3) selected @endif value="3">In Progress
                                                    </option>
                                                    <option @if($task->status === 1) selected @endif value="1">Completed
                                                    </option>
                                                    <option @if($task->status === 0) selected @endif value="0">Archive</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-3 control-label text-right pt-7" for="textinput">Assigned
                                                By</label>
                                            <div class="col-lg-3">
                                                <input disabled type="text" class="form-control"
                                                       value="{{\App\User::where('id',$task->user_id)->pluck('email')->first()}}">
                                            </div>
                                            <label class="col-lg-3 control-label text-right pt-7" for="textinput">Task
                                                Type</label>
                                            <div class="col-lg-3">
                                                <select id="ticket_type" name="task_type" class="form-control ">
                                                    <option @if($task->task_type === 1) selected @endif value="1"
                                                            selected="">New</option>
                                                    <option @if($task->task_type === 2) selected @endif value="2">Open</option>
                                                    <option @if($task->task_type === 3) selected @endif value="3"> Resolved
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-3 control-label text-right pt-7" for="textinput">Start
                                                Date</label>
                                            <div class="col-lg-3">
                                                <input id="textinput" disabled name="start_date" type="date" placeholder="Date"
                                                       class="form-control" value="{{$task->start_date}}" data-original-title=""
                                                       title="">
                                            </div>
                                            <label class="col-lg-3 control-label text-right pt-7" for="textinput">Due
                                                Date</label>
                                            <div class="col-lg-3">
                                                <input id="textinput" name="due_date" type="date" placeholder="Date"
                                                       class="form-control" value="{{$task->due_date}}" data-original-title=""
                                                       title="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 control-label text-right pt-7" for="textinput">Created
                                                By</label>
                                            <div class="col-lg-3">
                                                <label class="control-label "
                                                       for="textinput">{{\App\User::where('id',$task->user_id)->pluck('name')->first()}} on {{ \Carbon\Carbon::parse($task->created_at)->format('d M, Y')  }}</label>
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 control-label text-right pt-7" for="textinput">Assigned
                                                To</label>
                                            <div class="col-lg-9">
                                                <select id="assigned_to" class="form-control js-example-basic-single"
                                                        name="assigned_to">
                                                    @php
                                                        $assineds = \App\User::get();
                                                    @endphp
                                                    @foreach( $assineds as $key=>$to)
                                                        <option @if($task->assigned_to === $to->id) selected @endif
                                                        value="{{$to->id}}">{{$to->name}}-{{$to->email}}</option>
                                                    @endforeach

                                                </select>
                                            </div>

                                        </div>


                                        <div class=" default-according style-1 faq-accordion"
                                             id="accordionoc-sub-{{$task->id}}">
                                            <div class="row" style="width: 100%;">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5 class="mb-0">
                                                                <button type="button" class="btn btn-link collapsed"
                                                                        data-toggle="collapse"
                                                                        data-target="#changelog-{{$task->id}}" aria-expanded="true"
                                                                        aria-controls="collapseicon" data-original-title=""
                                                                        title="">
                                                                    Change Log
                                                                </button>
                                                            </h5>
                                                        </div>
                                                        <div class="collapse " id="changelog-{{$task->id}}"
                                                             aria-labelledby="collapseicon"
                                                             data-parent="#accordionoc-sub-{{$task->id}}">
                                                            <div class="card-body">




                                                                <?php $change_logs= \App\ChangLog::where('task_id',$task->id)->orderBy('id','desc')->get();
                                                                foreach ($change_logs as $change => $log) {


                                                                ?>


                                                                <div class=" default-according style-1 faq-accordion"
                                                                     id="accordionoc-change-{{$log->id}}">
                                                                    <div class="row" style="width: 100%;">
                                                                        <div class="col-lg-12">
                                                                            <div class="card">
                                                                                <div class="card-header">
                                                                                    <h5 class="mb-0">
                                                                                        <button type="button"
                                                                                                class="btn btn-link collapsed"
                                                                                                data-toggle="collapse"
                                                                                                data-target="#changelog-change-{{$log->id}}"
                                                                                                aria-expanded="true"
                                                                                                aria-controls="collapseicon"
                                                                                                data-original-title="" title="">
                                                                                            {{ \Carbon\Carbon::parse($log->created_at)->format('M d, Y, i:m a')}}
                                                                                            Changed By
                                                                                            {{\App\User::where('id',$log->user_id)->pluck('name')->first()}}
                                                                                        </button>
                                                                                    </h5>
                                                                                </div>
                                                                                <div class="collapse "
                                                                                     id="changelog-change-{{$log->id}}"
                                                                                     aria-labelledby="collapseicon"
                                                                                     data-parent="#accordionoc-change-{{$log->id}}">
                                                                                    <div class="card-body">
                                                                                        <table
                                                                                            class="table table-bordered table-hover table-striped">
                                                                                            <tbody>
                                                                                            <tr>
                                                                                                <td> Due date changed to
                                                                                                </td>
                                                                                                <td> {{ \Carbon\Carbon::parse($log->due_date)->format('M d, Y')}}
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td> Status Changed to </td>
                                                                                                <td>
                                                                                                    @if($log->status ===
                                                                                                    2)Pending
                                                                                                    @elseif($log->status ===
                                                                                                    3)In Progress
                                                                                                    @elseif($log->status ===
                                                                                                    0)Archive
                                                                                                    @elseif($log->status ===
                                                                                                    1) Completed @endif
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td> Type Changed to </td>
                                                                                                <td>
                                                                                                    @if($log->task_type ===
                                                                                                    2)Open
                                                                                                    @elseif($log->task_type
                                                                                                    === 3)In Resolved
                                                                                                    @elseif($log->task_type
                                                                                                    === 1) New @endif
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td> Changed Assigned To
                                                                                                </td>
                                                                                                <td>
                                                                                                    {{\App\User::where('id',$log->user_id)->pluck('email')->first()}}
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td> Priority Changed to
                                                                                                </td>
                                                                                                <td>
                                                                                                    @if($log->priority ===
                                                                                                    3)High
                                                                                                    @elseif($log->priority
                                                                                                    === 2)In Medium
                                                                                                    @elseif($log->priority
                                                                                                    === 1) Low
                                                                                                    @elseif($log->priority
                                                                                                    === 0) None @endif

                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td> Description </td>
                                                                                                <td style="width: 70%">
                                                                                                    {!!$log->description!!}
                                                                                                </td>
                                                                                            </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <?php } ?>





                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class=" default-according style-1 faq-accordion"
                                             id="accordionoc-attachment-{{$task->id}}">
                                            <div class="row" style="width: 100%;">
                                                <div class="col-lg-12">

                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5 class="mb-0">
                                                                <button type="button" class="btn btn-link collapsed"
                                                                        data-toggle="collapse"
                                                                        data-target="#assigned-attachment-{{$task->id}}"
                                                                        aria-expanded="true" aria-controls="collapseicon"
                                                                        data-original-title="" title="">
                                                                    Attachments
                                                                </button>
                                                            </h5>
                                                        </div>
                                                        <div class="collapse" id="assigned-attachment-{{$task->id}}"
                                                             aria-labelledby="collapseicon"
                                                             data-parent="#accordionoc-attachment-{{$task->id}}">
                                                            <div class="card-body">
                                                                <table class="table table-bordered table-hover table-striped">
                                                                    <tbody>
                                                                    @php
                                                                        $has
                                                                        =$attachments=\App\TuskAttachment::where('task_id',$task->id)->get();
                                                                    @endphp
                                                                    @if($has !=Null)
                                                                        @foreach( $attachments as $attached=> $attachment)
                                                                            <tr>
                                                                                <td>{{ \Carbon\Carbon::parse($attachment->created_at)->format('M d, Y')  }}
                                                                                </td>
                                                                                <td>{{$attachment->attachment_title}}</td>
                                                                                <td>
                                                                                    <a download="{{asset($attachment->attachment)}}"
                                                                                       href="{{asset($attachment->attachment)}}"><b>Download
                                                                                            Link</b></a>
                                                                                </td>
                                                                                <td>

                                                                                    <!--   modal start -->
                                                                                    <h5 class=" text-center"
                                                                                        style='font-size: 16px;font-family: sans-serif; color: #00c292; cursor: pointer'
                                                                                        data-toggle="modal"
                                                                                        data-target="#attachment_comment_{{$attachment->id}}">
                                                                                        View Comments</h5>

                                                                                    <div id="attachment_comment_{{$attachment->id}}"
                                                                                         class="modal fade bd-example-modal-lg"
                                                                                         tabindex="-1" role="dialog"
                                                                                         aria-labelledby="myLargeModalLabel"
                                                                                         aria-hidden="true">
                                                                                        <div class="modal-dialog modal-lg">
                                                                                            <div class="modal-content">
                                                                                                <div class="container-fluid">
                                                                                                    <div class="row">
                                                                                                        <div class="col-md-12">
                                                                                                            <div style="padding-top: 20px;"
                                                                                                                 class="timeline-content">
                                                                                                                <div
                                                                                                                    class="social-attachment-{{$attachment->id}}">
                                                                                                                    @php
                                                                                                                        $attachment_comments=
                                                                                                                        DB::table(
                                                                                                                        'attachment_comments'
                                                                                                                        )
                                                                                                                        ->join( 'users',
                                                                                                                        'attachment_comments.user_id',
                                                                                                                        '=', 'users.id'
                                                                                                                        )
                                                                                                                        ->select('attachment_comments.*','users.name','users.profile_pic')
                                                                                                                        ->
                                                                                                                        where('attachment_comments.ticket_id',$attachment->id)->get();
                                                                                                                    @endphp
                                                                                                                    @foreach($attachment_comments
                                                                                                                    as $key=>$val)
                                                                                                                        <div
                                                                                                                            class="your-msg">
                                                                                                                            <div
                                                                                                                                class="media">
                                                                                                                                <div
                                                                                                                                    class="media">
                                                                                                                                    <img class="img-50 img-fluid m-r-20 rounded-circle"
                                                                                                                                         style="margin-top: 20px;"
                                                                                                                                         @if($val->profile_pic
                                                                                                                                     !=null)
                                                                                                                                         src="{{asset($val->profile_pic)}}"
                                                                                                                                         @else
                                                                                                                                         src="{{asset('/')}}assets/images/user/lncg-logo-only.jpg"
                                                                                                                                        @endif
                                                                                                                                    >
                                                                                                                                    <div style="margin-top: 20px;"
                                                                                                                                         class="media-body">
                                                                                                                        <span
                                                                                                                            class="f-w-600">{{ $val->name }}
                                                                                                                            <span>{{ \Carbon\Carbon::parse($val->created_at)->format('M d, Y')  }}
                                                                                                                            </span>
                                                                                                                        </span>
                                                                                                                                        <p
                                                                                                                                            style="margin-top: 5px;">
                                                                                                                                            {{ $val->comment_body }}
                                                                                                                                        </p>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    @endforeach
                                                                                                                </div>


                                                                                                            </div>
                                                                                                            <div style="padding-bottom: 30px;"
                                                                                                                 class="comments-box">
                                                                                                                <div class="media">
                                                                                                                    <img class="img-50 img-fluid m-r-20 rounded-circle"
                                                                                                                         alt=""
                                                                                                                         src="http://localhost/martech/public/assets/images/user/1.jpg"
                                                                                                                         data-original-title=""
                                                                                                                         title="">
                                                                                                                    <div
                                                                                                                        class="media-body">
                                                                                                                        <div
                                                                                                                            class="input-group text-box">
                                                                                                                            <input
                                                                                                                                class="form-control input-txt-bx"
                                                                                                                                type="text"
                                                                                                                                name="comment_to_send"
                                                                                                                                id="attachmentSend_{{$attachment->id}}"
                                                                                                                                placeholder="Post Your commnets"
                                                                                                                                data-original-title=""
                                                                                                                                title="">
                                                                                                                            <div
                                                                                                                                class="input-group-append">
                                                                                                                                <button
                                                                                                                                    class="btn btn-transparent attachment"
                                                                                                                                    type="button"
                                                                                                                                    id="attachmentAdd_{{$attachment->id}}"
                                                                                                                                    data-original-title=""
                                                                                                                                    title=""><i
                                                                                                                                        class="fa fa-arrow-right">
                                                                                                                                    </i></button>
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

                                                                                    <!--   modal end -->


                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    @endif
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
                                            <div class="social-chat-{{ $task->id }}">
                                                @php
                                                    $task_comments= DB::table( 'task_comments' )
                                                    ->join( 'users', 'task_comments.user_id', '=', 'users.id' )
                                                    ->select('task_comments.*','users.name','users.profile_pic')
                                                    -> where('task_comments.ticket_id',$task->id)->get();
                                                @endphp
                                                @foreach($task_comments as $key=>$val)
                                                    <div class="your-msg">
                                                        <div class="media">
                                                            <img class="img-50 img-fluid m-r-20 rounded-circle"
                                                                 style="margin-top: 20px;" @if($val->profile_pic !=null)
                                                                 src="{{asset($val->profile_pic)}}" @else
                                                                 src="{{asset('/')}}assets/images/user/lncg-logo-only.jpg" @endif
                                                            >
                                                            <div style="margin-top: 20px;" class="media-body">
                                                    <span class="f-w-600">{{ $val->name }}
                                                        <span>{{ \Carbon\Carbon::parse($val->created_at)->format('M d, Y')  }}
                                                        </span>
                                                    </span>
                                                                <p style="margin-top: 5px;">{{ $val->comment_body }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <div class="comments-box">
                                                <div class="media"><img class="img-50 img-fluid m-r-20 rounded-circle" alt=""
                                                                        src="{{asset('/')}}assets/images/user/1.jpg" data-original-title=""
                                                                        title="">
                                                    <div class="media-body">
                                                        <div class="input-group text-box">
                                                            <input class="form-control input-txt-bx" type="text"
                                                                   name="message_to_send" id="messageSend_{{$task->id}}"
                                                                   placeholder="Post Your commnets" data-original-title=""
                                                                   title="">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-transparent messageAdd" type="button"
                                                                        id="messageAdd_{{ $task->id }}" data-original-title=""
                                                                        title=""><i class="fa fa-arrow-right"> </i></button>
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
                                                <a href="{{URL::to('/delete-task').'/'.$task->id}}"> <button
                                                        onclick=" return myFunction()" type="button"
                                                        class="btn btn-pill btn-danger" style="width:auto;"
                                                        data-original-title="" title="">Delete Task
                                                    </button></a>
                                                <button id="addAttachmentId_{{ $task->id }}" data-whatever="@getbootstrap"
                                                        data-toggle="modal" name="addAttachment_{{ $task->id }}"
                                                        data-target="#addAttachment_{{ $task->id }}" type="button"
                                                        class="btn btn-pill btn-warning" style="width:auto;" data-original-title=""
                                                        title="">Add Attachment
                                                </button>
                                                <button type="button" class="btn btn-pill btn-primary" style="width:auto;"
                                                        data-original-title="" title="">Copy Link
                                                </button>
                                                <button type="submit" class="btn btn-pill btn-success" style="width:auto;"
                                                        data-original-title="" title="">Save and Update
                                                </button>
                                            </div>
                                        </div>
                                        <!-- buttons end -->
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--   modal start -->
                            <div class="modal fade" id="addAttachment_{{ $task->id }}" tabindex="-1" role="document"
                                 aria-labelledby="addAttachmentId_{{ $task->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="business">Add Task Attachment</h5>
                                        </div>

                                        <form action="{{ URL::to('/add-attachment') }}" method="POST"
                                              enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="modal-body">
                                                <div class="card-body">

                                                    <input type="hidden" name="task_id" value="{{ $task->id }}" />

                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label for="deal_size">Attachment</label>
                                                            <input required class="" multiple id="attachment"
                                                                   name="attachment[]" type="file"
                                                                   accept="image/x-png,image/jpeg, .pdf, .docx, .jpeg, .png, .svg, .psd, .ai, .eps">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="col-6 row">
                                                    <button style="margin-right:25px" class="btn btn-sm btn-default col"
                                                            type="button" data-dismiss="modal">Close</button>
                                                    <button class="btn btn-sm btn-primary col" type="submit">Add
                                                        Attachment</button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--   modal end -->
                            <!-- text-danger text-primary text-warning text-success -->
                        @endforeach
                    </div>
                </div>

                <div style="" class="row pt-10 pb-40">
                    <div class="col-sm-6 text-center">
                        {{$tasks->render()}}
                    </div>
                </div>
            </div>

        </div>
        <!--   modal start -->
        <div class="modal fade" id="addTicketModal" tabindex="-1" role="document" aria-labelledby="addBusinessModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="business">Add Task</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>


                    <form action="{{ route('save_task') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-body ">
                            <!-- Container-fluid starts-->

                            <!-- Container-fluid Ends-->


                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="cname">Title</label>
                                            <input required class="form-control" id="title" name="title" type="text"
                                                   placeholder="Task Title">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="start_date">Due Date</label>
                                                <input name="due_date" id="start_date" class="form-control"
                                                       value="{{ date('Y-m-d') }}" id="validationCustom03" type="date"
                                                       placeholder="Start Date">
                                                <input type="hidden" name="start_date" value="{{date('Y-m-d')}}">
                                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="deal_size">Attachment</label>
                                            <input class="form-control" multiple id="attachment" name="attachment[]"
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
                                                <select name="assigned_to" class="form-control ">
                                                    @foreach( \App\User::get() as $key=>$to)
                                                        <option value="{{$to->id}}">{{$to->email}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="contact1">Description</label>
                                            <textarea name="description" id="description" class="form-control"
                                                      id="validationCustom02" placeholder="Task Description"
                                                      required=""></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-pill btn-secondary" type="button" data-dismiss="modal">Close</button>
                            <button class="btn btn-pill btn-primary" type="submit">Create Task</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
        <!--   modal end -->
        <a href="#searchFormModal" class="float" data-whatever="@getbootstrap" data-toggle="modal">
            <i class="fa fa-filter my-float"></i>
        </a>
        <div class="label-container">
            <div class="label-text">Available Filters</div>
            <i class="fa fa-play label-arrow"></i>
        </div>

        {{-- Modal Start for Search/filter Form --}}
        <div class="modal fade" id="searchFormModal" tabindex="-1" role="document" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Available Filters</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        @include('task.search_form')
                    </div>
                    <div class="modal-footer">
                        {{-- <button class="btn btn-pill btn-secondary" type="button" data-dismiss="modal">Close</button>
                            <button class="btn btn-pill btn-primary" type="submit">Create Task</button> --}}
                    </div>

                    </form>
                </div>
            </div>
        </div>
        {{-- Modal Ends --}}
    </div>
    <!-- Container-fluid Ends-->
@endsection




@section('script')
    <script>
        function myFunction() {
            if(confirm("Are you Sure to Delete")){
                return true;
            }else{
                return false;
            }
        };
    </script>
    <script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/js/select2/select2-custom.js')}}"></script>

    <script>
        $(".messageAdd").click(function () {
            let ids = $(this).attr('id');
            let ticket_number = ids.split('_')[1];
            let comment_txt = $("#messageSend_" + ticket_number).val();
            var html = '';
            $.ajax({
                url: "{{ url('/taskcommentAdd') }}",
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
                        '              src="{{asset('/')}}assets/images/user/lncg-logo-only.jpg"\n' +
                        '              data-original-title="" title="">\n' +
                        '         <div style="margin-top: 20px;" class="media-body">\n' +
                        '         <span class="f-w-600">'+data[0].name+'\n' +
                        '             <span>'+data[0].created_at+' </span>\n' +
                        '         </span>\n' +
                        '             <p style="margin-top: 5px;">'+data[0].comment_body+'</p>\n' +
                        '         </div>\n' +
                        '     </div>\n' +
                        ' </div>';
                    $("#messageSend_" + ticket_number).val("");
                    // console.log(html);
                    $('.social-chat-'+ ticket_number).append(html);
                }


            });
        });
    </script>
    <script>
        $(".attachment").click(function () {
            let ids = $(this).attr('id');
            let ticket_number = ids.split('_')[1];
            let comment_txt = $("#attachmentSend_" + ticket_number).val();
            var html = '';
            $.ajax({
                url: "{{ url('/taskattachmentcommentAdd') }}",
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
                        '              src="{{asset('/')}}assets/images/user/lncg-logo-only.jpg"\n' +
                        '              data-original-title="" title="">\n' +
                        '         <div style="margin-top: 20px;" class="media-body">\n' +
                        '         <span  class="f-w-600">'+data[0].name+'\n' +
                        '             <span>'+data[0].created_at+' </span>\n' +
                        '         </span>\n' +
                        '             <p style="margin-top: 5px;">'+data[0].comment_body+'</p>\n' +
                        '         </div>\n' +
                        '     </div>\n' +
                        ' </div>';
                    $("#attachmentSend_" + ticket_number).val("");
                    //console.log(html);
                    $('.social-attachment-'+ ticket_number).append(html);
                }


            });
        });
    </script>


@endsection
