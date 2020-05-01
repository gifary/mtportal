@extends('layouts.master')
@section('title', 'Support Ticket| Martechportal')
@section('style')

@endsection

@section('breadcrumb-title', 'New Ticket')
@section('breadcrumb-items')
    <li class="breadcrumb-item"><a class="breadcrumb-item" href="{{route('home')}}"><span>Home</span></a></li>
    <li class="breadcrumb-item"><a class="breadcrumb-item" href="{{route('add_ticket_page')}}"><span>Ticket</span></a>
    </li>
    <li class="breadcrumb-item active">Add New Ticket</li>
@endsection

@section('content')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">

                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <form class="needs-validation" novalidate="" action="{{route('post_ticket')}}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="title">Title</label>
                                    <input name="title" id="title" class="form-control" id="validationCustom01"
                                           type="text" placeholder="Ticket Title" required="">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label for="priority">Ticket Priorty</label>

                                    <select name="priority" id="priority" class="form-control">
                                        <option value="Higher">Higher</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Lower">Lower</option>
                                        <option value="None">None</option>
                                    </select>
                                    <div class="invalid-feedback">Ticket Priorty.</div>

                                </div>


                                <div class="col-md-4 mb-3">
                                    <label for="status">Status</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"
                                                                               id="inputGroupPrepend">@</span></div>

                                        <select name="status" id="status" class="form-control">
                                            <option value="Pending">Pending</option>
                                            <option value="In Progress">In Progress</option>
                                            <option value="Dismiss">Dismiss</option>
                                            <option value="Completed">Completed</option>
                                        </select>
                                        <div class="invalid-feedback">Please Enter Status.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4 mb-4">
                                    <label for="start_date">Start Date</label>
                                    <input name="start_date" id="start_date" class="form-control"
                                           id="validationCustom03" type="date" placeholder="Start Date">
                                    <div class="invalid-feedback">can be null</div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label for="due_date">Due Date</label>
                                    <input name="due_date" id="due_date" class="form-control" id="validationCustom04"
                                           type="date" placeholder="Due Date">
                                    <div class="invalid-feedback">Due date can be null</div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control"
                                              id="validationCustom02" placeholder="Ticket Description"
                                              required=""></textarea>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>


                            </div>
                            <div class="form-row">
                                <div class="col-md-4 mb-4">
                                    <label for="assigned_to">Assigned To</label>


									<?php
	                                use App\User;$emails = User::where( 'email', '!=', Auth::user()->email )->pluck( 'email' );


									?>

                                    <select name="assigned_to" id="assigned_to" class="form-control">
                                        @foreach($emails as $email)
                                            <option value={{$email}}>{{$email}}</option>

                                        @endforeach
                                    </select>

                                    <div class="invalid-feedback">Assigned To</div>

                                </div>

                            </div>

                            <input name="parent_Ticket_id" id="parent_Ticket_id" class="form-control"
                                   id="validationCustom03" value="{{ Auth::user()->name}}" type="hidden"
                                   placeholder="Assigned To">


                            <button class="btn btn-primary" type="submit">Create Ticket</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
        @endsection
        @section('script')
            @if (isset($success))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    {!! $success !!}.
                </div>
    @endif
@endsection
