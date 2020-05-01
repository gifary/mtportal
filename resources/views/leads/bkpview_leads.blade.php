@extends('layouts.secondary')
@section('title', 'Leads | Martechportal')
@section('style')
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css/datatables.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/select2.css')}}">
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
                            @if(Session::get('message'))<?php echo Session::get('message');Session::put('message'); ?>@endif
                        </div>
                        <div class="card-body">
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
                                            data-toggle="tab" href="#top-comments" role="tab"
                                            aria-controls="top-comments" aria-selected="true"><i
                                                class="icofont icofont-man-in-glasses"></i>Comments</a>
                                        <div class="material-border"></div>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" id="contact-top-secondary"
                                            data-toggle="tab" href="#top-attachments" role="tab"
                                            aria-controls="top-attachments" aria-selected="false"><i
                                                class="icofont icofont-contacts"></i>Attachments</a>
                                        <div class="material-border"></div>
                                    <li class="nav-item"><a class="nav-link" id="remainder-top-secondary"
                                            data-toggle="tab" href="#top-reminders" role="tab"
                                            aria-controls="top-reminders" aria-selected="false"><i
                                                class="icofont icofont-contacts"></i>Reminders</a>
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
                                    <div class="tab-pane fade " id="top-comments" role="tabpanel"
                                        aria-labelledby="profile-top-tab">
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                            Lorem Ipsum has been the industry's standard dummy text ever since the
                                            1500s, when an unknown printer took a galley of type and scrambled it to
                                            make a type specimen book. It has survived not only five centuries, but also
                                            the leap into electronic typesetting, remaining essentially unchanged. It
                                            was popularised in the 1960s with the release of Letraset sheets containing
                                            Lorem Ipsum passages, and more recently with desktop publishing software
                                            like Aldus PageMaker including versions of Lorem Ipsum</p>
                                    </div>
                                    <div class="tab-pane fade" id="top-attachments" role="tabpanel"
                                        aria-labelledby="contact-top-tab">
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                            Lorem Ipsum has been the industry's standard dummy text ever since the
                                            1500s, when an unknown printer took a galley of type and scrambled it to
                                            make a type specimen book. It has survived not only five centuries, but also
                                            the leap into electronic typesetting, remaining essentially unchanged. It
                                            was popularised in the 1960s with the release of Letraset sheets containing
                                            Lorem Ipsum passages, and more recently with desktop publishing software
                                            like Aldus PageMaker including versions of Lorem Ipsum</p>
                                    </div>
                                    <div class="tab-pane fade" id="top-reminders" role="tabpanel"
                                        aria-labelledby="remainder-top-tab">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h5 style="padding-bottom: 20px;">Set a Reminder</h5>
                                                <form class="form theme-form">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Select Persons</label>
                                                        <div class="col-sm-9">
                                                            <select
                                                                class="js-example-basic-multiple col-sm-12 btn-square"
                                                                multiple="multiple" style="width: 100%">
                                                                <option value="AL">Alabama</option>
                                                                <option value="WY">Wyoming</option>
                                                                <option value="WY">Coming</option>
                                                                <option value="WY">Hanry Die</option>
                                                                <option value="WY">John Doe</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="reminder-date-time">Date and time</label>
                                                        <div class="col-sm-9">
                                                            <input class="form-control btn-square" id="reminder-date-time"
                                                                type="datetime-local" value="2018-01-19T18:45:00">                                                           
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="reminder-text">Reminder text</label>
                                                        <div class="col-sm-9">
                                                            <textarea class="form-control btn-square" id="reminder-text"
                                                                rows="3"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 text-right">
                                                            <button class=" btn btn-pill btn-primary text-light"
                                                                type="submit">Submit</button>
                                                            <input class="btn btn-pill btn-light" type="reset"
                                                                value="Cancel">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="col-xl-12">
                                                    <div class="card upcoming-reminder-card">
                                                        <div class="card-header">
                                                            <h5 class="mb-0">
                                                                <button class="btn btn-link pl-0" data-toggle="collapse"
                                                                    data-target="#collapseicon2" aria-expanded="true"
                                                                    aria-controls="collapseicon2" style="font-size: 16px; text-transform: uppercase; font-family:'Montserrat', sans-serif; text-decoration: none;">Upcoming
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
                                                                                Zaman</strong></span><span>At 2
                                                                            PM</span></div>
                                                                    <div>
                                                                        <h5 class="mb-0 font-primary">09</h5><span
                                                                            class="d-block">Nov</span>
                                                                    </div>
                                                                </div>
                                                                <div class="media">
                                                                    <div class="media-body"><span class="f-w-600">Remind
                                                                            me to Call</span><span
                                                                            class="d-block">Reminder For <strong>
                                                                                John</strong></span><span>At 2 PM</span>
                                                                    </div>
                                                                    <div>
                                                                        <h5 class="mb-0 font-primary">09</h5><span
                                                                            class="d-block">Feb</span>
                                                                    </div>
                                                                </div>
                                                                <div class="media">
                                                                    <div class="media-body"><span class="f-w-600">Remind
                                                                            me to Call</span><span
                                                                            class="d-block">Reminder For <strong>
                                                                                Zaman</strong></span><span>At 2
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


                    </div>
                </div>


                <div class="modal-footer">
                    <button class="btn btn-pill btn-secondary" type="button" data-dismiss="modal">Close</button>

                    <button class="btn btn-pill btn-primary" type="submit">Update Lead</button>
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
<script>
    $(document).ready(function() {
      $(function() {
        
        $('#datetimepicker7').datetimepicker({
          useCurrent: false //Important! See issue #1075
        });
        
      });
    });
    </script>
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/select2/select2-custom.js')}}"></script>
<script src="{{asset('assets')}}/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('assets')}}/js/datatable/datatables/datatable.custom.js"></script>

{{-- <script src="{{asset('assets')}}/js/moment-with-locales.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script> --}}


<script type="text/javascript">
    console.log(new Date($.now()));
</script>

@endsection