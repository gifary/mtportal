@extends('layouts.master')
@section('title', 'Validation Forms | Martechportal')
@section('style')

@endsection

@section('breadcrumb-title', 'New Tasks')
@section('breadcrumb-items')
<li class="breadcrumb-item"><a class="breadcrumb-item" href="{{route('home')}}"><span>Home</span></a></li>
<li class="breadcrumb-item"><a  class="breadcrumb-item" href="{{route('tasks.index')}}"><span>Tasks</span></a></li>
<li class="breadcrumb-item active">Add New Tasks</li>
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
                    <form class="needs-validation" novalidate="" action="{{route('post_task')}}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="title">Title</label>
                                <input name="title" id="title" class="form-control" id="validationCustom01" type="text" placeholder="Task Title" required="">
                                <div class="valid-feedback">Looks good!</div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <label for="priority">Task Priorty</label>

                                <select  name="priority" id="priority" class="form-control">
                                    <option value="higher">Higher</option>
                                    <option value="medium">Medium</option>
                                    <option value="Lower">Lower</option>
                                    <option value="none">None</option>
                                </select>
                                <div class="invalid-feedback">Task Priorty.</div>

                            </div>


                            <div class="col-md-4 mb-3">
                                <label for="status">Status</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">@</span></div>

                                    <select  name="status" id="status" class="form-control">
                                        <option value="higher">Pending</option>
                                        <option value="medium">In Progress</option>
                                        <option value="Lower">Dismiss</option>
                                        <option value="none">Completed</option>
                                    </select>
                                    <div class="invalid-feedback">Please Enter Status.</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-4">
                                <label for="start_date">Start Date</label>
                                <input  name="start_date" id="start_date" class="form-control" id="validationCustom03" type="date" placeholder="Start Date" >
                                <div class="invalid-feedback">can be null</div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="due_date">Due Date</label>
                                <input  name="due_date" id="due_date" class="form-control" id="validationCustom04" type="date" placeholder="Due Date">
                                <div class="invalid-feedback">Due date can  be null</div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="description">Description</label>
                                <textarea  name="description" id="description" class="form-control" id="validationCustom02"  placeholder="Task Description" required=""></textarea>
                                <div class="valid-feedback">Looks good!</div>
                            </div>



                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-4">
                                <label for="assigned_to">Assigned To</label>


                                <?php
                                $emails = \App\User::where('email', '!=', Auth::user()->email)->pluck('email');
                                ?>

                                <select  name="assigned_to" id="assigned_to" class="form-control">
                                    @foreach($emails as $email)
                                    <option value={{$email}}>{{$email}}</option>

                                    @endforeach
                                </select>

                                <div class="invalid-feedback">Assigned To</div>

                            </div>

                        </div>

                        <input  name="parent_task_id" id="parent_task_id" class="form-control" id="validationCustom03" value="{{ Auth::user()->name}}"type="hidden" placeholder="Assigned To">



                        <button class="btn btn-primary" type="submit">Create Task</button>
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
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {!! $success !!}. 
    </div>
    @endif
    @endsection