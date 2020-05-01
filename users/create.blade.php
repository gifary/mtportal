{{-- \resources\views\users\create.blade.php --}}
@extends('layouts.master')

@section('title', 'Martech Portal | Add User')


@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/select2.css')}}">
<style>
    .select2-container {
        width: 100% !important;
    }

    .select2-container {
        display: block;
        width: 100%;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da !important;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
</style>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{route('permissions.index')}}">Roles & Permissions</a></li>
<li class="breadcrumb-item active">Add User</li>
@endsection
@section('breadcrumb-buttons')

{{-- <a href="{{ route('users.create') }}"><button class=" btn btn-pill btn-primary text-light" type="button"
    data-toggle="modal" data-original-title="" title="">Create Users
</button></a> --}}
@endsection

@section('content')
<!--   modal start -->
<div class="container">
    <div class="card row">
        <div class="card-header">
            <h5>Add User</h5>
        </div>
        <div class="card-body">
            @if (Session::get('message'))
            <?php 
                    echo Session::get('message');
                    Session::put('message');
                ?>
            @endif
            @if ($errors->any())
            <div style="width: 60%;margin: 0 auto;background: #fff;border: none;" class="alert text-left alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li style="color: #f00;font-size: 13px;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ URL::to('save-user') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}


                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cname">Name</label>
                                <input required class="form-control" name="name" type="text" placeholder=" "
                                    value="{{old('name')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cname">Email</label>
                                <input required class="form-control" name="email" type="email" placeholder=" "
                                    value="{{old('email')}}">
                            </div>
                        </div>
                    </div>                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cname">Personal Contact Number</label>
                                <input class="form-control" name="personal_contact" type="text" placeholder=" "
                                    value="{{old('personal_contact')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cname">Official Contact Number</label>
                                <input required class="form-control" name="official_contact" type="text" placeholder=" "
                                    value="{{old('official_contact')}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cname">Profile Image</label>
                                <input required class="form-control" name="profile" type="file" placeholder=" ">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cname">Date of Birth</label>
                                <input class="form-control" name="birth_date" type="date" placeholder=" "
                                    value="{{old('birth_date')}}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="start_date">Gender</label>
                                    <select name="gender" required class="form-control ">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Others">Others</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cname">Country</label>
                                <select name="country" class="form-control js-example-basic-single ">
                                    @foreach( DB::table('country')->get() as $country=> $value)
                                    <option value="{{$value->country_code}}">{{$value->country_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cname">Position</label>
                                <input class="form-control" name="position" type="text"
                                    placeholder="Your Position Title" {{old('position')}}>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="start_date">Department</label>
                                    <select name="department" class="form-control ">
                                        @foreach( DB::table('department')->get() as $department=> $value)
                                        <option value="{{$value->dept_id}}">{{$value->dept_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="start_date">Business Associated With </label>
                                    <select name="businesses" class="form-control js-example-basic-single">
                                        @foreach( DB::table('businesses')->get() as $business=> $value)
                                        <option value="{{$value->id}}">{{$value->cname}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="start_date">Role</label>
                                    <select name="role" class="form-control ">
                                        @foreach( DB::table('roles')->get() as $role=> $value)
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="start_date">Tier </label>
                                    <select name="tire" class="form-control ">
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                        <option value="4">Four</option>
                                        <option value="5">Five</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cname">Password</label>
                                <input required class="form-control" name="password" type="password"
                                    placeholder="Password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cname">Confirm Password</label>
                                <input required class="form-control" name="confirm_password" type="password"
                                    placeholder="Confirm Password">
                            </div>
                        </div>
                    </div>
                    
                </div>

                <div class="card-footer text-right">
                    <a href="{{route('permissions.index')}}" class="btn btn-pill btn-secondary">Close</a>                    
                    <button class="btn btn-pill btn-primary" type="submit">Save User</button>
                </div>
            </form>
        </div>

    </div>
</div>

@endsection


@section('script')
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/select2/select2-custom.js')}}"></script>


@endsection