@extends('layouts.secondary')
@section('title', 'Leads | Martechportal')
@section('style')
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css/datatables.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/select2.css')}}">

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

@section('breadcrumb-title', 'Leads')
@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{route('leads.index')}}">Leads</a></li>
    <li class="breadcrumb-item active">View Lead</li>
@endsection
{{-- @stop --}}

@section('model-button')
    <button class=" btn btn-pill btn-primary text-light" type="button" data-toggle="modal" data-target="#addLeadModal"
            data-whatever="@getbootstrap" id="leadId" name="leadId">Add Lead</button>
@endsection
@section('content')
    <style type="text/css">
        .select2-container--open {
            z-index: 9999 !important;
        }
        .select2-container{width: 100%!important;}
        .greenFont {
            color: green;
        }

        .redFont {
            color: red;
        }

        .select2-container .select2-selection--multiple .select2-selection__rendered {
            right: 0 !important;
            top: 4px !important;
        }

        .upcoming-reminder-card {
            webkit-box-shadow: 1px 5px 24px 0 rgba(0, 0, 0, 0.2);
            box-shadow: 1px 5px 24px 0 rgba(0, 0, 0, 0.2);
        }
    </style>
    <!-- Container-fluid starts-->
    <div class="container-fluid">


        <!--////////////////////EDIT STACK MODAL////////////////
        -->
        <div class="modal fade" id="addLeadModal" tabindex="-1" role="document" aria-labelledby="addLeadModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="business">Add Lead</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>


                    <form action="{{ route('leads.store') }}" method="POST" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="modal-body">

                            <div class="card-body">

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="cname">Company Name*</label>
                                            <input required class="form-control" id="cname" name="cname" type="text"
                                                   placeholder="Enter Company Name">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="contact_person">Name Of Contact Person*</label>
                                            <input required class="form-control" id="contact_person" name="contact_person"
                                                   type="text" placeholder="Name of Contact Person">
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="contact1">Contact person’s position</label>
                                            <input required class="form-control" id="contact1"
                                                   name="contact_person_position" type="text"
                                                   placeholder="Contact person’s position">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="contact2">Email</label>
                                            <input required class="form-control" id="contact2" name="email" type="email"
                                                   placeholder="email">
                                        </div>
                                    </div>


                                    <div class="col">
                                        <div class="form-group">
                                            <label for="deal_size">Phone</label>
                                            <input class="form-control" id="dual_size" name="phone" type="number"
                                                   placeholder="phone">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="closed_won_date">Full Address</label>
                                            <input required class="form-control" id="closed_won_date" name="full_address"
                                                   type="text" placeholder="Full Address">
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="deal_size">Deal Size ($)</label>
                                            <input class="form-control" id="deal_size" name="deal_size" type="number"
                                                   placeholder="Deal Size">
                                        </div>
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="close_won_date">Closed Won Date </label>
                                            <input class="form-control" id="close_won_date" name="close_won_date"
                                                   type="date" value="{{date('d/m/Y')}}" placeholder="Closed Won Date ">
                                        </div>
                                    </div>


                                    <div class="col">
                                        <div class="form-group">
                                            <label for="lead_industry">Lead Industry</label>
                                            <input class="form-control" id="lead_industry" name="lead_industry" type="text"
                                                   placeholder="Lead Industry">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="lead_source">Lead Source</label>
                                            <input class="form-control" id="lead_source" name="lead_source" type="text"
                                                   placeholder="Lead Source">
                                        </div>
                                    </div>


                                    <div class="col">
                                        <div class="form-group">
                                            <label for="market_contact">Marketing Contact contact</label>
                                            <input class="form-control" id="market_contact" name="market_contact"
                                                   type="text" placeholder="Marketing Contact contact">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="marketing_phone">Marketing Contact phone</label>
                                            <input class="form-control" id="marketing_phone" name="marketing_phone"
                                                   type="number" placeholder="Marketing Contact phone">
                                        </div>
                                    </div>


                                    <div class="col">
                                        <div class="form-group">
                                            <label for="marketing_email">Marketing Contact Email</label>
                                            <input class="form-control" id="marketing_email" name="marketing_email"
                                                   type="email" placeholder="Marketing Contact email">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="billing_contact">Billing Contact</label>
                                            <input class="form-control" id="billing_contact" name="billing_contact"
                                                   type="text" placeholder="Billing contact">
                                        </div>
                                    </div>


                                    <div class="col">
                                        <div class="form-group">
                                            <label for="billing_address">Billing Address</label>
                                            <input class="form-control" id="billing_address" name="billing_address"
                                                   type="text" placeholder="Billing address">
                                        </div>
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="billing_phone">Billing Phone</label>
                                            <input class="form-control" id="billing_phone" name="billing_phone" type="text"
                                                   placeholder="Billing Phone">
                                        </div>
                                    </div>


                                    <div class="col">
                                        <div class="form-group">
                                            <label for="billing_email">Billing Email</label>
                                            <input class="form-control" id="billing_email" name="billing_email" type="text"
                                                   placeholder="Billing Email">
                                        </div>
                                    </div>


                                </div>


                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="special_notes">Lead Status</label>
                                            <select name="lead_status" id="" class="form-control">
                                                @foreach( \App\LedCategories::where('status',1)->get() as $key=> $categori)
                                                    <option value="{{$categori->id}}">{{$categori->categori_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>


                        <div class="modal-footer">
                            <button class="btn btn-pill btn-secondary" type="button" data-dismiss="modal">Close</button>

                            <button class="btn btn-pill btn-primary" type="submit">Create Lead</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>


        <!--//////////////EDIT STACK MODAL END/////////////////// -->


        <div class="container box">
            <div class="owl-carousel owl-theme" id="owl-carousel-14">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="pull-left">{{$lead->cname }}</h5>
                                <div class="text-center"><img class="img-100 align-self-center border" alt=""
                                                              src="http://martechportal.com/storage/images/1584416471.sample.png"
                                                              data-original-title="" title=""></div>

                            </div>
                            <div class="card-body">
                                @if(Session::get('message'))<?php echo Session::get('message');Session::put('message'); ?>@endif
                                <div class="tabbed-card">
                                    <ul class="pull-right nav nav-tabs border-tab nav-secondary" id="top-tabsecondary"
                                        role="tablist">
                                        <li class="nav-item"><a class="nav-link active" id="top-home-secondary"
                                                                data-toggle="tab" href="#top-homesecondary" role="tab"
                                                                aria-controls="top-home" aria-selected="false"><i
                                                    class="icofont icofont-ui-search"></i>Lead Details</a>
                                            <div class="material-border"></div>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" id="profile-top-secondary"
                                                                data-toggle="tab" href="#top-profilesecondary" role="tab"
                                                                aria-controls="top-profilesecondary" aria-selected="true"><i
                                                    class="icofont icofont-comment"></i>Comments</a>
                                            <div class="material-border"></div>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" id="attachment-top-secondary"
                                                                data-toggle="tab" href="#top-attachmentsecondary" role="tab"
                                                                aria-controls="top-attachmentsecondary" aria-selected="false"><i
                                                    class="icofont icofont-attachment"></i>Attachments</a>
                                            <div class="material-border"></div>
                                        @if($lead->assigned_to != null)
                                            <li class="nav-item"><a class="nav-link" id="reminder-top-secondary"
                                                                    data-toggle="tab" href="#top-remindersecondary" role="tab"
                                                                    aria-controls="top-remindersecondary" aria-selected="false"><i
                                                        class="icofont icofont-alarm"></i>Reminder</a>
                                                <div class="material-border"></div>
                                            </li>
                                        @endif
                                        <li class="nav-item"><a class="nav-link" id="tools-top-secondary"
                                                                data-toggle="tab" href="#top-toolssecondary" role="tab"
                                                                aria-controls="top-toolssecondary" aria-selected="false"><i
                                                    class="icofont icofont-settings"></i>Martech Tools</a>
                                            <div class="material-border"></div>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="top-tabContentsecondary">
                                        <div class="tab-pane fade active show" id="top-homesecondary" role="tabpanel"
                                             aria-labelledby="top-home-tab">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <tbody>

                                                    <tr>
                                                        <th class="text-right">Company Name :</th>
                                                        <td>{{$lead->cname }}</td>
                                                        <th class="text-right">Name Of Contact Person :</th>
                                                        <td>{{$lead->contact_person}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-right">Email :</th>
                                                        <td>{{$lead->email}}</td>
                                                        <th class="text-right">Phone :</th>
                                                        <td>{{$lead->phone}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-right">Full Address:</th>
                                                        <td>{{$lead->full_address}}</td>
                                                        <th class="text-right">Deal Size($) :</th>
                                                        <td>{{$lead->deal_size}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-right">Closed Won Date:</th>
                                                        <td>{{$lead->close_won_date}}</td>
                                                        <th class="text-right">Lead Industry :</th>
                                                        <td>{{$lead->lead_industry}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-right">Lead Source:</th>
                                                        <td>{{$lead->lead_source}}</td>
                                                        <th class="text-right">Marketing Contact:</th>
                                                        <td>{{$lead->market_contact}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-right">Marketing Contact phone:</th>
                                                        <td>{{$lead->marketing_phone}}</td>
                                                        <th class="text-right">Marketing Contact Email :</th>
                                                        <td>{{$lead->marketing_email}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-right">Billing Contact:</th>
                                                        <td>{{$lead->billing_contact}}</td>
                                                        <th class="text-right">Billing Address :</th>
                                                        <td>{{$lead->billing_address}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-right">Billing Phone:</th>
                                                        <td>{{$lead->billing_phone}}</td>
                                                        <th class="text-right">Billing Email :</th>
                                                        <td>{{$lead->billing_email}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-right">Contact person’s position:</th>
                                                        <td>{{$lead->contact_person_position}}</td>
                                                        <th class="text-right">Lead Status:</th>
                                                        <td>{{ \App\LedCategories::where('id',$lead->lead_status)->pluck('categori_name')->first()}}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-right">Assigned to:</th>
                                                        <td>@if($lead->assigned_to !=
                                                            null){{\App\User::where('id',$lead->assigned_to)->pluck('name')->first()}}
                                                            @else Not Assigned @endif</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-right">&nbsp;</th>
                                                        <td>
                                                            <div class="text-right">&nbsp;
                                                            </div>
                                                        </td>
                                                        <th class="text-right">&nbsp;</th>
                                                        <td>
                                                            <div class="text-right">
                                                                <a href="{{URL::to('/lead-delete').'/'.$lead->id}}"><button
                                                                        onclick=" return myFunction()"
                                                                        class=" btn btn-pill btn-danger text-light"
                                                                        type="button">Delete Lead</button></a>
                                                                <button class=" btn btn-pill btn-primary text-light"
                                                                        type="button" data-toggle="modal"
                                                                        data-target="#editLeadModal"
                                                                        data-whatever="@getbootstrap" id="EditLead"
                                                                        name="EditLead">Edit Lead</button>

                                                                <!--<button class="btn btn-pill  btn-primary" type="">Edit Lead</button></div>-->
                                                        </td>
                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade " id="top-profilesecondary" role="tabpanel"
                                             aria-labelledby="profile-top-tab">

                                            <div class="col call-chat-body">
                                                <div class="card" style="-webkit-box-shadow:1px 5px 24px 0 rgba(0, 0, 0, 0.1); box-shadow: 1px 5px 24px 0 rgba(0, 0, 0, 0.1); width:100%;">
                                                    <div class="card-body p-0">
                                                        <div class="row chat-box">
                                                            <!-- Chat right side start-->
                                                            <div class="col chat-right-aside" style="max-width: 100% !important; flex: 0 0 100%;">
                                                                <!-- chat start-->
                                                                <div class="chat" >
                                                                    <!-- chat-header end-->
                                                                    <div class="chat-history chat-msg-box custom-scrollbar">
                                                                        <div id="leadcommentbox">
                                                                            @foreach($leadcomments as $leadcomment)
                                                                                @php

                                                                                    $user = \App\User::where('id',$leadcomment->user_id)->first();
                                                                                    $username = $user->name;
                                                                                    $loggedinUser = Auth::user()->id;
                                                                                    $loggedinUserZone = Auth::user()->zone_name;

                                                                                   $timezone = \App\Zone::where('zone_id', $loggedinUserZone)->pluck('zone_name')->first();
                                                                                  $updatedAt = $leadcomment->updated_at;
                                                                                   $dt = new DateTime($updatedAt);
                                                                                    $tz = new DateTimeZone($timezone);

                                                                                    $dt->setTimezone($tz);
                                                                                @endphp
                                                                                {{-- Logged In User Messages --}}
                                                                                @if ($user->id == $loggedinUser)
                                                                                    <div class="message my-message" style="width: 100%; border: 1px solid #e8e8e8; border-radius: 10px;">

                                                                                        <img class="rounded-circle float-left chat-user-img img-30" src="{{asset($user->profile_pic)}}" alt="{{$username}}">
                                                                                        <div class="message-data text-right">
                                                                                            <span class="message-data-time">{{ $dt->format('Y-m-d H:i:s')  }}, {{$username}}</span>
                                                                                        </div>
                                                                                        <p>{{$leadcomment->comment}}</p>
                                                                                        <div class="row float-right" style="background-color: #efefef; border-radius: 5px;">
                                                                                            <div class="col-xs-6" style="border-right: 1px solid #dedede;">
                                                                                                <a href="javascript:void(0)" class="btn  btn-xs form-inline" data-toggle="modal"
                                                                                                   data-target="#editLeadcomment_{{$leadcomment->id}}"
                                                                                                   data-whatever="@getbootstrap"><i class="icon-pencil"></i></a>
                                                                                            </div>
                                                                                            <div class="col-xs-6">
                                                                                                <form method="POST" action="{{url('deleteleadcomment')}}">
                                                                                                    @csrf
                                                                                                    <input type="hidden" name="commentid" value="{{$leadcomment->id}}">
                                                                                                    <button class="btn btn-xs form-inline" type="submit"><i class="icon-trash"></i></button>
                                                                                                </form>
                                                                                            </div>

                                                                                        </div>
                                                                                    </div>

                                                                                @else
                                                                                    {{-- Other User Messages --}}
                                                                                    <div class="message other-message pull-right" style="width: 100%;">
                                                                                        <img class="rounded-circle float-right chat-user-img img-30" src="{{asset($user->profile_pic)}}" alt="{{$username}}" style="position: absolute;
    z-index: 9;
    right: 20px;">
                                                                                        <div class="message-data">
                                                                                            <span class="message-data-time">{{ $dt->format('Y-m-d H:i:s')  }}, {{$username}}</span>
                                                                                        </div>
                                                                                        <p>{{$leadcomment->comment}}</p>
                                                                                    </div>
                                                                                    <div class="clearfix"></div>
                                                                                @endif

                                                                                <div class="modal fade" id="editLeadcomment_{{$leadcomment->id}}"
                                                                                     role="document" aria-labelledby="editLeadcomment"
                                                                                     aria-hidden="true">
                                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <h5 class="modal-title" id="business">Edit Lead Comment
                                                                                                </h5>
                                                                                                <button class="close" type="button" data-dismiss="modal"
                                                                                                        aria-label="Close"><span
                                                                                                        aria-hidden="true">×</span></button>
                                                                                            </div>

                                                                                            <div class="modal-body">
                                                                                                <form action="{{url('editleadcomment')}}" method="POST">
                                                                                                    {{ csrf_field() }}
                                                                                                    <div class="row">
                                                                                                        <div class="col">
                                                                                                            <div class="form-group">
                                                                                                                <input type="hidden" name="commentid"
                                                                                                                       value="{{$leadcomment->id}}">
                                                                                                                <textarea name="comment"
                                                                                                                          class="form-control"></textarea>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="modal-footer" style="padding-bottom: 0">
                                                                                                        <button class="btn btn-pill btn-secondary"
                                                                                                                type="button"
                                                                                                                data-dismiss="modal">Close</button>

                                                                                                        <button class="btn btn-pill btn-primary"
                                                                                                                type="submit" id="updatelead">Update
                                                                                                            Comment</button>
                                                                                                    </div>

                                                                                                </form>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                @endforeach
                                                                                </ul>
                                                                        </div>
                                                                        <!-- end chat-history-->

                                                                        <div class="chat-message clearfix">
                                                                            <div class="form-group row comment-box">
                                                                                <div class="col-md-1">
                                                                                    @php
                                                                                        $loggedinUser = Auth::user()->id;
                                                                                        $userimg = \App\User::where('id', $loggedinUser)->pluck('profile_pic')->first();
                                                                                    @endphp
                                                                                    <img class="rounded-circle float-left img-40" src="{{asset($userimg)}}" alt="">
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    {{ csrf_field() }}
                                                                                    <input type="hidden" name="leadcomment_id" value="{{$lead->id}}">
                                                                                    <input type="hidden" name="lcuser_id" value="{{$loggedinUser}}">
                                                                                    <input type="hidden" name="leaduser_id"
                                                                                           value="{{Auth::user()->id}}">
                                                                                    <input id="leadcomment" placeholder="Add Comment"
                                                                                           class="form-control" >
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <button class="btn btn-pill btn-primary text-light" type="button"
                                                                                            id="addleadcomment"><i class="icon-angle-right"></i></button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- end chat-message-->

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="top-attachmentsecondary" role="tabpanel"
                                             aria-labelledby="attachment-top-tab">
                                            <form action="{{ URL::to('/lead_attachment') }}" method="POST"
                                                  enctype="multipart/form-data" class="row">
                                                {{ csrf_field() }}
                                                <div class="col-md-12">
                                                    <h5 style="padding-bottom: 20px;">Add Attachment</h5>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="hidden" name="lead_id" value="{{$lead->id}}">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            {{-- <label for="deal_size">Attachment</label> --}}
                                                            <input class="form-control" multiple id="attachment"
                                                                   name="attachment[]" type="file"
                                                                   accept="image/x-png,image/jpeg, .pdf, .docx, .jpeg, .png, .svg, .psd, .ai, .eps">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <button class="btn btn-pill btn-primary text-light"
                                                                    type="submit">Add
                                                                Attachment</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            @php

                                                $attachments=\App\LeadAttachment::where('lead_id',$lead->id)->get();
                                            @endphp
                                            @if(count($attachments)>0)
                                                <div class="col">
                                                    <table class="table table-bordered table-hover table-striped">
                                                        <tbody>
                                                        <th>Date</th>
                                                        <th>Title</th>
                                                        <th>Download</th>
                                                        <th>Edit Comment</th>
                                                        <th>Delete</th>

                                                        @foreach( $attachments as $attached => $attachment)
                                                            <tr>
                                                                <td>{{ \Carbon\Carbon::parse($attachment->created_at)->format('M d, Y')  }}
                                                                </td>
                                                                <td>{{$attachment->attachment_title}}</td>
                                                                <td>
                                                                    <a download="{{asset($attachment->attachment)}}"
                                                                       href="{{asset($attachment->attachment)}}"><b>Download
                                                                            Link</b></a>
                                                                </td>
                                                                <td style="text-align:center;">
                                                                    <a href="javascript:void(0)" class="btn btn-pill btn-danger"
                                                                       data-toggle="modal"
                                                                       data-target="#editattachmentcomment_{{$attachment->id}}"
                                                                       data-whatever="@getbootstrap">Edit</a>

                                                                    <!------------ edit attachment comment ----------->
                                                                    <div class="modal fade"
                                                                         id="editattachmentcomment_{{$attachment->id}}"
                                                                         role="document" aria-labelledby="editattachmentcomment"
                                                                         aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="model-body">
                                                                                    <div class="col call-chat-body" style="margin-top: 20px;">
                                                                                        <div class="card" style="-webkit-box-shadow:1px 5px 24px 0 rgba(0, 0, 0, 0.1); box-shadow: 1px 5px 24px 0 rgba(0, 0, 0, 0.1); width:100%;margin-bottom: 0px;">
                                                                                            <div class="card-body p-0">
                                                                                                <div class="row chat-box">
                                                                                                    <!-- Chat right side start-->
                                                                                                    <div class="col chat-right-aside" style="max-width: 100% !important; flex: 0 0 100%;">
                                                                                                        <!-- chat start-->
                                                                                                        <div class="chat" >
                                                                                                            <!-- chat-header end-->
                                                                                                            <div class="chat-history chat-msg-box custom-scrollbar">
                                                                                                                <div id="leadattachmentcommentbox_{{$attachment->id}}">
                                                                                                                    @php
                                                                                                                        $leadattachmentcomments = \App\LeadAttachmentComment::where('lead_id',$lead->id)->where('lead_attachment_id',$attachment->id)->get(); @endphp
                                                                                                                    @foreach($leadattachmentcomments as $leadattachmentcomment)
                                                                                                                        @php

                                                                                                                            $user = \App\User::where('id',$leadattachmentcomment->user_id)->first();
                                                                                                                            $username = $user->name;
                                                                                                                            $loggedinUser = Auth::user()->id;
                                                                                                                            $loggedinUserZone = Auth::user()->zone_name;

                                                                                                                           $timezone = \App\Zone::where('zone_id', $loggedinUserZone)->pluck('zone_name')->first();
                                                                                                                          $updatedAt = $leadattachmentcomment->updated_at;
                                                                                                                           $dt = new DateTime($updatedAt);
                                                        $tz = new DateTimeZone($timezone);

                                                        $dt->setTimezone($tz);
                                                                                                                        @endphp
                                                                                                                        {{-- Logged In User Messages --}}
                                                                                                                        @if ($user->id == $loggedinUser)
                                                                                                                            <div class="message my-message" style="width: 100%; border: 1px solid #e8e8e8; border-radius: 10px;">

                                                                                                                                <img class="rounded-circle float-left chat-user-img img-30" src="{{asset($user->profile_pic)}}" alt="{{$username}}">
                                                                                                                                <div class="message-data text-right">
                                                                                                                                    <span class="message-data-time">{{ $dt->format('Y-m-d H:i:s')  }}, {{$username}}</span>
                                                                                                                                </div>
                                                                                                                                <p class="text-left">{{$leadattachmentcomment->comment}}</p>
                                                                                                                                <form method="POST" action="{{url('updateleadattachmentcomment')}}" id="updateleadattcommentdiv_{{$leadattachmentcomment->id}}" style="display: none;">
                                                                                                                                    @csrf
                                                                                                                                    <div class="col-8" style="float: left;">
                                                                                                                                        <input type="hidden" name="attachmentcommentid" value="{{$leadattachmentcomment->id}}" class="form-control">
                                                                                                                                        <input type="text" name="attachmentcomment" class="form-control" required>
                                                                                                                                    </div>
                                                                                                                                    <div class="col-md-2"  style="float: left;">
                                                                                                                                        <button class="btn btn-success" type="submit">Update</button>
                                                                                                                                    </div>
                                                                                                                                    <div class="col-md-2"  style="float: left;">
                                                                                                                                        <a class="btn btn-danger" href="javascript:void(0)" id="cancelleadattcommentupdate_{{$leadattachmentcomment->id}}">Cancel</a>
                                                                                                                                    </div>
                                                                                                                                    <div class="clearfix"></div>
                                                                                                                                </form>
                                                                                                                                <div class="row float-right" style="background-color: #efefef; border-radius: 5px;">
                                                                                                                                    <div class="col-xs-6" style="border-right: 1px solid #dedede;">
                                                                                                                                        <a href="javascript:void(0)" class="btn  btn-xs form-inline leadattcommentupdate" id="leadattachmentcommentupdate_{{$leadattachmentcomment->id}}"><i class="icon-pencil"></i></a>
                                                                                                                                    </div>
                                                                                                                                    <div class="col-xs-6">
                                                                                                                                        <form method="POST" action="{{url('deleteleadattachmentcomment')}}">
                                                                                                                                            @csrf
                                                                                                                                            <input type="hidden" name="attachmentcommentid" value="{{$leadattachmentcomment->id}}">
                                                                                                                                            <button class="btn btn-xs form-inline" type="submit"><i class="icon-trash"></i></button>
                                                                                                                                        </form>
                                                                                                                                    </div>

                                                                                                                                </div>

                                                                                                                            </div>

                                                                                                                        @else
                                                                                                                            {{-- Other User Messages --}}
                                                                                                                            <div class="message other-message pull-right" style="width: 100%;">
                                                                                                                                <img class="rounded-circle float-right chat-user-img img-30" src="{{asset($user->profile_pic)}}" alt="{{$username}}" style="position: absolute;
    z-index: 9;
    right: 20px;">
                                                                                                                                <div class="message-data">
                                                                                                                                    <span class="message-data-time">{{ $dt->format('Y-m-d H:i:s')  }}, {{$username}}</span>
                                                                                                                                </div>
                                                                                                                                <p>{{$leadattachmentcomment->comment}}</p>
                                                                                                                            </div>
                                                                                                                            <div class="clearfix"></div>
                                                                                                                            @endif
                                                                                                                            @endforeach
                                                                                                                            </ul>
                                                                                                                </div>
                                                                                                                <!-- end chat-history-->

                                                                                                                <div class="chat-message clearfix">
                                                                                                                    <div class="form-group row comment-box">
                                                                                                                        <div class="col-md-1">
                                                                                                                            @php
                                                                                                                                $loggedinUser = Auth::user()->id;
                                                                                                                                $userimg = \App\User::where('id', $loggedinUser)->pluck('profile_pic')->first();
                                                                                                                            @endphp
                                                                                                                            <img class="rounded-circle float-left img-40" src="{{asset($userimg)}}" alt="">
                                                                                                                        </div>
                                                                                                                        <div class="col-md-9">
                                                                                                                            {{ csrf_field() }}
                                                                                                                            <input type="hidden" name="leadattlead_id" value="{{$lead->id}}">
                                                                                                                            <input type="hidden" name="leadatt_id" value="{{$attachment->id}}">
                                                                                                                            <input type="hidden" name="leadattcommentuser_id"
                                                                                                                                   value="{{Auth::user()->id}}">
                                                                                                                            <input id="leadattcomment_{{$attachment->id}}" placeholder="Add Comment"
                                                                                                                                   class="form-control" >
                                                                                                                        </div>
                                                                                                                        <div class="col-md-2">
                                                                                                                            <button class="btn btn-pill btn-primary text-light addleadattcomment" type="button"
                                                                                                                                    id="addleadattcomment_{{$attachment->id}}"><i class="icon-angle-right"></i></button>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>

                                                                                                            <!-- end chat-message-->

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
                                                                </td>
                                                                <td style="text-align:center;">
                                                                    <form action="{{url('delete_lead_attachment')}}"
                                                                          method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="id"
                                                                               value="{{$attachment->id}}">
                                                                        <button class="btn btn-pill btn-danger">Delete</button>
                                                                    </form>
                                                                </td>

                                                            </tr>
                                                        @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endif
                                        </div>
                                        @if($lead->assigned_to != null)
                                            <div class="tab-pane fade" id="top-remindersecondary" role="tabpanel"
                                                 aria-labelledby="reminder-top-tab">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <h5>Set a Reminder</h5>
                                                        <p style="padding-bottom: 20px;">Once you set a reminder we will notify
                                                            you via your mail and portal's notification panel.</p>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Remind </label>
                                                            <div class="col-sm-9">

                                                                <select class="form-control js-example-basic-multiple"  id="to_notify" multiple="multiple">
                                                                    @php
                                                                        $users = \App\User::all();

                                                                    @endphp
                                                                    @foreach($users as $user)
                                                                        <option value="{{$user->id}}" @if($user->id == Auth::user()->id) selected @endif>
                                                                            {{$user->name}}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label" for="reminder-text">Reminder
                                                                text</label>
                                                            <div class="col-sm-9">
                                                        <textarea name="remindercomment" id="remindercomment"
                                                                  class="form-control" placeholder="Add Comment"
                                                                  required></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label" for="reminder-date-time">Date
                                                                and
                                                                time</label>
                                                            <div class="col-sm-9">
                                                                @php
                                                                    $loggedinUser = Auth::user()->id;
                                                                                                                                       $loggedinUserZone = Auth::user()->zone_name;

                                                                                                                                      $timezone = \App\Zone::where('zone_id', $loggedinUserZone)->pluck('zone_name')->first();
                                                                                                                                     $updatedAt = date("Y-m-d\TH:i");
                                                                                                                                      $dt = new DateTime($updatedAt);
                                                                   $tz = new DateTimeZone($timezone);

                                                                   $dt->setTimezone($tz);

                                                                @endphp
                                                                <input class="form-control btn-square" id="remindertime"
                                                                       type="datetime-local"
                                                                       value="{{$dt->format('Y-m-d\TH:i')}}">

                                                                <input type="hidden" id="linkactionid" value="{{$lead->id}}">
                                                            </div>
                                                        </div>
                                                        <p id="remindererror"></p>
                                                        <a class="btn btn-pill btn-primary text-light" href="javascript:void(0)"
                                                           style="float:right;" id="sendreminderbtn">Set reminder</a>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xl-12">
                                                            <div class="card upcoming-reminder-card">
                                                                <div class="card-header">
                                                                    <h5 class="mb-0">
                                                                        <button class="btn btn-link pl-0" data-toggle="collapse"
                                                                                data-target="#collapseicon2" aria-expanded="true"
                                                                                aria-controls="collapseicon2"
                                                                                style="font-size: 16px; text-transform: uppercase; font-family:'Montserrat', sans-serif; text-decoration: none;">Upcoming
                                                                            Reminders</button>
                                                                    </h5>
                                                                </div>
                                                                <div class="collapse show" id="collapseicon2"
                                                                     aria-labelledby="collapseicon2" data-parent="#accordion">
                                                                    <div class="upcoming-course card-body">


                                                                        <div class="media">
                                                                            <div class="media-body"><span class="f-w-600">Remind
                                                                            me to Call</span><span
                                                                                    class="d-block">Reminder For <strong>
                                                                                Henry</strong></span><span>At 2
                                                                            PM</span></div>
                                                                            <div>
                                                                                <h5 class="mb-0 font-primary">09</h5><span
                                                                                    class="d-block">Nov</span>
                                                                            </div>
                                                                        </div>


                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="tab-pane fade" id="top-toolssecondary" role="tabpanel"
                                             aria-labelledby="tools-top-tab">
                                            <div class="col-sm-12" id="" >
                                                <div class="col-sm-12 mb-3 text-right"><a class="btn btn-success" href="javascript:void(0)"  data-toggle="modal"
                                                                                          data-target="#addtool"
                                                                                          data-whatever="@getbootstrap">Add Tool</button></a></div>
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="display" id="toolstable">
                                                                <thead>
                                                                <tr>
                                                                    <th>Tool Name</th>
                                                                    <th>Purpose</th>

                                                                    <th>Edit</th>
                                                                    <th>Delete</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody id="toolresponse">
                                                                @if(count($martechtools)>0)
                                                                    @foreach($martechtools as $martechtool)
                                                                        <tr>
                                                                            <td>{{$martechtool->name}}</td>
                                                                            <td>{{$martechtool->purpose}}</td>

                                                                            <td class="text-center"><a class="btn btn-success" href="javascript:void(0)" data-toggle="modal" data-target="#edittool_{{$martechtool->id}}" data-whatever="@getbootstrap">Edit</button></td>
                                                                            <div class="modal fade" id="edittool_{{$martechtool->id}}"
                                                                                 role="document" aria-labelledby="edittool_{{$martechtool->id}}"
                                                                                 aria-hidden="true">
                                                                                <div class="modal-dialog modal-lg" role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5>Edit Tool</h5>

                                                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                                                                                    aria-hidden="true">×</span></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <form method="POST" action="{{url('edittool')}}">
                                                                                                @csrf
                                                                                                <div class="form-group">
                                                                                                    <input type="hidden" name="tool_id" value="{{$martechtool->id}}">
                                                                                                    <input class="form-control" name="edittoolname" required  type="text" value="{{$martechtool->name}}">
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <textarea class="form-control" name="edittoolpurpose" value="{{$martechtool->purpose}}" >{{$martechtool->purpose}}</textarea>
                                                                                                </div>

                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button class="btn btn-success" type="submit">Edit</button>
                                                                                            <a href="javascript:void(0)" data-dismiss="modal" aria-label="Close" aria-hidden="true" class="btn btn-danger">Cancel</a>
                                                                                        </div>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <td class="text-center"><form method="POST" action="{{url('deletetool')}}">
                                                                                    @csrf
                                                                                    <input type="hidden" name="toolid" value="{{$martechtool->id}}">
                                                                                    <button class="btn btn-danger" type="submit">Delete</button>
                                                                                </form></td>

                                                                        </tr>
                                                                    @endforeach
                                                                @else
                                                                    <tr>
                                                                        <td colspan="5" class="text-center">No data found!</td>
                                                                    </tr>
                                                                @endif
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Add tool modal -->

                                        <div class="modal fade" id="addtool"
                                             role="document" aria-labelledby="addtool"
                                             aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5>Add Tool</h5>

                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                                                aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="form-group">
                                                            <input type="hidden" name="tool_lead_id" value="{{$lead->id}}">
                                                            <input class="form-control" name="toolname" required id="toolname" type="text" placeholder="Enter Tool Name">
                                                        </div>
                                                        <div class="form-group">
                                                            <textarea class="form-control" name="toolpurpose" id="toolpurpose" placeholder="Enter Tool Purpose"></textarea>
                                                        </div>
                                                        <span id="toolerror"></span>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="javascript:void(0)" id="addtoolbtn" class="btn btn-success">Add</a>
                                                        <a href="javascript:void(0)" data-dismiss="modal" aria-label="Close" id="closeaddtool"><span
                                                                aria-hidden="true" class="btn btn-danger">Cancel</a>
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

        </div>
    </div>



    <!--////////////////////EDIT STACK MODAL////////////////
        -->
    <div class="modal fade" id="editLeadModal" role="document" aria-labelledby="editLeadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="business">Edit Lead</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>


                <form action="{{ URL::to('/update-lead')}}" method="POST" name="update-lead" id="update-lead"
                      enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <div class="modal-body">

                        <div class="card-body">

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="cname">Company Name*</label>
                                        <input required class="form-control" id="cname" name="cname"
                                               value="{{$lead->cname }}" type="text" placeholder="Enter Company Name">
                                        <input required name="id" value="{{$lead->id }}" type="hidden">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="contact_person">Name Of Contact Person*</label>
                                        <input required class="form-control" id="contact_person"
                                               value="{{$lead->contact_person }}" name="contact_person" type="text"
                                               placeholder="Name of Contact Person">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="contact1">Contact person’s position</label>
                                        <input required class="form-control" value="{{$lead->contact_person_position }}"
                                               id="contact1" name="contact_person_position" type="text"
                                               placeholder="Contact person’s position">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="contact2">Email</label>
                                        <input required class="form-control" value="{{$lead->email }}" id="contact2"
                                               name="email" type="email" placeholder="email">
                                    </div>
                                </div>


                                <div class="col">
                                    <div class="form-group">
                                        <label for="deal_size">Phone</label>
                                        <input class="form-control" value="{{$lead->phone }}" id="dual_size" name="phone"
                                               type="number" placeholder="phone">
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col">
                                    <div class="form-group">
                                        <label for="closed_won_date">Full Address</label>
                                        <input required class="form-control" value="{{$lead->full_address }}"
                                               id="closed_won_date" name="full_address" type="text" placeholder="Full Address">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="deal_size">Deal Size ($)</label>
                                        <input class="form-control" value="{{$lead->deal_size }}" id="deal_size"
                                               name="deal_size" type="number" placeholder="Deal Size">
                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="close_won_date">Closed Won Date </label>
                                        <input class="form-control" name="close_won_date" type="date"
                                               value="{!! $lead->close_won_date!!}" placeholder="Closed Won Date ">
                                    </div>
                                </div>


                                <div class="col">
                                    <div class="form-group">
                                        <label for="lead_industry">Lead Industry</label>
                                        <input class="form-control" id="lead_industry" value="{{$lead->lead_industry }}"
                                               name="lead_industry" type="text" placeholder="Lead Industry">
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col">
                                    <div class="form-group">
                                        <label for="lead_source">Lead Source</label>
                                        <input class="form-control" id="lead_source" name="lead_source"
                                               value="{{$lead->lead_source }}" type="text" placeholder="Lead Source">
                                    </div>
                                </div>


                                <div class="col">
                                    <div class="form-group">
                                        <label for="market_contact">Marketing Contact contact</label>
                                        <input class="form-control" id="market_contact" name="market_contact"
                                               value="{{$lead->market_contact }}" type="text"
                                               placeholder="Marketing Contact contact">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="marketing_phone">Marketing Contact phone</label>
                                        <input class="form-control" id="marketing_phone" value="{{$lead->marketing_phone }}"
                                               name="marketing_phone" type="number" placeholder="Marketing Contact phone">
                                    </div>
                                </div>


                                <div class="col">
                                    <div class="form-group">
                                        <label for="marketing_email">Marketing Contact Email</label>
                                        <input class="form-control" id="marketing_email" value="{{$lead->marketing_email }}"
                                               name="marketing_email" type="email" placeholder="Marketing Contact email">
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="billing_contact">Billing Contact</label>
                                        <input class="form-control" id="billing_contact" name="billing_contact"
                                               value="{{$lead->billing_contact }}" type="text" placeholder="Billing contact">
                                    </div>
                                </div>


                                <div class="col">
                                    <div class="form-group">
                                        <label for="billing_address">Billing Address</label>
                                        <input class="form-control" id="billing_address" name="billing_address"
                                               value="{{$lead->billing_address }}" type="text" placeholder="Billing address">
                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="billing_phone">Billing Phone</label>
                                        <input class="form-control" id="billing_phone" name="billing_phone"
                                               value="{{$lead->billing_phone }}" type="text" placeholder="Billing Phone">
                                    </div>
                                </div>


                                <div class="col">
                                    <div class="form-group">
                                        <label for="billing_email">Billing Email</label>
                                        <input class="form-control" id="billing_email" name="billing_email"
                                               value="{{$lead->billing_email }}" type="text" placeholder="Billing Email">
                                    </div>
                                </div>


                            </div>


                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="special_notes">Lead Status</label>
                                        <select name="lead_status" id="lead_status_update" class="form-control">
                                            @foreach( \App\LedCategories::where('status',1)->get() as $key=> $categori)
                                                <option value="{{$categori->id}}">{{$categori->categori_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="special_notes">Assigned To</label>
                                        <select name="assigned_to" id="assigned_to_update"
                                                class="form-control  js-example-basic-single" style="width: 100%">
                                            <option value="" selected disabled>Select</option>
                                            @foreach( \App\User::where('role','!=',6)->get() as $key=> $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" id="sendertime" name="sendertime" value="">
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button class="btn btn-pill btn-secondary" type="button" data-dismiss="modal">Close</button>

                        <button class="btn btn-pill btn-primary" type="submit" id="updatelead">Update Lead</button>
                    </div>

                </form>
            </div>
        </div>
    </div>



    <!--//////////////EDIT STACK MODAL END/////////////////// -->


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

    <script type="text/javascript">
        $(document).ready(function () {

            $("#lead_status_update").val('{!!$lead->lead_status!!}');

        });

    </script>
    <script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/js/select2/select2-custom.js')}}"></script>
    <script src="{{asset('assets')}}/js/datatable/datatables/jquery.dataTables.min.js"></script>

    <script src="{{asset('assets')}}/js/datatable/datatables/datatable.custom.js"></script>
    <script type="text/javascript">$(document).ready(function() {
            $('#toolstable').DataTable();
        } );</script>
    <script type="text/javascript">
        $('#updatelead').click(function(){
            var currentdate = new Date();
            var datetime = currentdate.getFullYear()+"-"+(currentdate.getMonth()+1)+"-"+currentdate.getDate()+" "+currentdate.getHours()+":"+currentdate.getMinutes()+":"+ currentdate.getSeconds();
            $('#sendertime').val(datetime);
        });


        $('#sendreminderbtn').click(function(){

            $.ajax({

                url: "{{ route('leadreminder') }}",

                type: "POST",

                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $('#to_notify').val(),

                    'remindertime' : $('#remindertime').val(),
                    'remindercomment' : $('#remindercomment').val(),
                    'leadid': $('#linkactionid').val(),

                },

                success: function(data) {
                    console.log(data)
                    if (data == 1) {
                        $('#remindererror').html("The reminder has been sent successfully.");
                        $('#remindererror').addClass("greenFont");
                        $('#remindererror').removeClass("redFont");
                    }
                    else if(data == 0){
                        $('#remindererror').html("Please fill all fields.");
                        $('#remindererror').addClass("redFont");
                        $('#remindererror').removeClass("greenFont");
                    }
                    else{
                        $('#remindererror').html("Remainder Time Should Be Greater Then Current Time.");
                        $('#remindererror').addClass("redFont");
                        $('#remindererror').removeClass("greenFont");
                    }
                }
            })
        });


        $('#addleadcomment').click(function(){
            $.ajax({
                url: "{{ route('addleadcomment') }}",
                type: "POST",

                data: {
                    '_token': $('input[name=_token]').val(),
                    'leadcomment_id' : $('input[name=leadcomment_id]').val(),
                    'leaduser_id' : $('input[name=leaduser_id]').val(),
                    'leadcomment' : $('#leadcomment').val(),
                    'lcuser_id' : $('input[name=lcuser_id]').val(),
                },

                success: function(data) {

                    $('#leadcommentbox').html(data);
                    $('#leadcomment').val("");

                }
            });
        });


        $('.addleadattcomment').click(function(){

            var id = $(this).attr('id');

            var lead_attachment_id = id.split('_');

            var comment = $('#leadattcomment_'+lead_attachment_id[1]).val();



            $.ajax({
                url: "{{ route('addleadattachmentcomment') }}",
                type: "POST",

                data: {
                    '_token': $('input[name=_token]').val(),
                    'lead_id' : $('input[name=leadattlead_id]').val(),
                    'lead_attachment_id' : lead_attachment_id[1],
                    'comment' : comment,
                    'user_id' : $('input[name=leadattcommentuser_id]').val(),
                },

                success: function(data) {


                    $('#leadattachmentcommentbox_'+lead_attachment_id[1]).html(data);
                    $('#leadattcomment_'+lead_attachment_id[1]).val("");
                }
            });
        });



        $(document).on("click", ".leadattcommentupdate", function(){
            var id = $(this).attr('id');
            var update = id.split('_');

            $('#updateleadattcommentdiv_'+update[1]).show();

            $(document).on("click", '#cancelleadattcommentupdate_'+update[1], function(){
                $('#updateleadattcommentdiv_'+update[1]).hide();
            })
        });



        $('#addtoolbtn').click(function(){




            $.ajax({
                url: "{{ route('addmartechtool') }}",
                type: "POST",

                data: {
                    '_token': $('input[name=_token]').val(),
                    'lead_id' : $('input[name=tool_lead_id]').val(),

                    'name' : $('input[name=toolname]').val(),
                    'purpose' : $('#toolpurpose').val(),
                },

                success: function(data) {


                    console.log(data);
                    if (data == 0) {
                        $('#toolerror').html("Please fill all fields.");
                        $('#toolerror').attr("style","color:red");
                    }
                    else{
                        $('#toolresponse').html(data);
                        $('#toolerror').html("Tool added successfully.");
                        $('#toolerror').attr("style","color:green");
                        $('#closeaddtool').trigger("click");
                    }

                }
            });
        });
    </script>
@endsection
