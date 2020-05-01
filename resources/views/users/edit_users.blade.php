{{-- \resources\views\users\create.blade.php --}}
@extends('layouts.master')

@section('title', '| Edit User')


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
            border: 1px solid #ced4da!important;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

    </style>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Edit Users</li>
@endsection
@section('breadcrumb-buttons')

    <a href="{{ route('users.create') }}"><button class=" btn btn-pill btn-primary text-light" type="button" data-toggle="modal"

                                                  data-original-title="" title="">Add Users
        </button></a>
@endsection

@section('content')
    <!--   modal start -->
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="business">Update User</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">×</span></button>
        </div>
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
                        <li style="color: #f00;font-size: 13px;" >{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.update', $user->id) }}" method="POST" name="edit-user" enctype="multipart/form-data">
            @csrf
            @method('Patch')
            <div class="modal-body ">
                <!-- Container-fluid starts-->

                <!-- Container-fluid Ends-->

                <input type="hidden" name="id" value="{{$user->id}}" />
                <input type="hidden" name="old_pic" value="{{$user->profile_pic}}" />

                <div class="card-body">

                    <div class="row">
                        <div class="col ">
                            <div class="form-group">
                                <label for="cname">Name</label>
                                <input  required  class="form-control"    name="name" type="text"
                                        value="{{$user->name}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col row">
                            <div class="form-group col-6">
                                <label for="cname">Profile Image</label>
                                <input     name="profile" type="file">
                            </div>
                            <div class="form-group col-6">
                                <img height="60px" src="{{asset( $user->profile_pic)}}" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="cname">Email</label>
                                <input  required  class="form-control"    name="email" type="email"
                                        value="{{$user->email}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="cname">Personal Contact Number</label>
                                <input    class="form-control"    name="personal_contact" type="text"
                                          value="{{$user->personal_contact}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="cname">Official Contact Number</label>
                                <input  required  class="form-control"    name="official_contact" type="text"
                                        value="{{$user->official_contact}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="cname">Date of Birth</label>
                                <input    class="form-control"    name="birth_date" type="date"
                                          value="{{$user->birth_date}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select id="gender" name="gender" required class="form-control ">
                                        <option value="Male" >Male</option>
                                        <option value="Female" >Female</option>
                                        <option value="Others" >Others</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="country">Country</label>
                                {!! Form::select('country',$country,$user->country,['class'=>'form-control','id'=>'country']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="cname">Position</label>
                                <input    class="form-control"    name="position" type="text"
                                          value="{{$user->position}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="department">Department</label>
                                    <select id="department" name="department" class="form-control ">
                                        @foreach( DB::table('department')->get() as $department=> $value)
                                            <option value="{{$value->dept_id}}" >{{$value->dept_name}}</option>
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
                                    <label for="role">Role</label>
                                    <select name="role" id="role" class="form-control ">
                                        @foreach( DB::table('roles')->get() as $role=> $value)
                                            <option value="{{$value->id}}" >{{$value->name}}</option>
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
                                    <select id="tire" name="tire" class="form-control ">
                                        <option value="1" >Select 1</option>
                                        <option value="2" >Select 2</option>
                                        <option value="3" >Select 3</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="businesses">Business Associated With </label>
                                    <select id="businesses" name="businesses" class="form-control js-example-basic-single">
                                        @foreach( DB::table('businesses')->get() as $business=> $value)
                                            <option value="{{$value->id}}" >{{$value->cname}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="cname">Password</label>
                                <input  required  class="form-control"    name="password" type="password"
                                       placeholder="Password">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="cname">Confirm Password</label>
                                <input  required  class="form-control"    name="confirm_password" type="password"
                                       placeholder="Confirm Password">
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-pill btn-secondary" type="button" data-dismiss="modal">Close</button>
                <button class="btn btn-pill btn-primary" type="submit">Update User</button>
            </div>

        </form>
    </div>
    <!--   modal end -->

@endsection


@section('script')
    <script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/js/select2/select2-custom.js')}}"></script>


    <script>
        $(document).ready(function() {
            $('#country').val('{{$user->country}}');
            $('#gender').val('{{$user->gender}}');
            $('#role').val('{{$user->role}}');
            $('#department').val('{{$user->department}}');
        });
    </script>
@endsection
