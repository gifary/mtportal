@extends('layouts.master')

@section('title', 'Roles & Permissions | Martechportal')
@section('style')

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
@endsection

@section('breadcrumb-title', 'Welcome')
@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Default</li>
@endsection

@section('content')
    <div class="container-fluid">
        <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
            <li class="nav-item"><a class="nav-link active show" id="top-users-tab" data-toggle="tab" href="#top-users" role="tab" aria-controls="top-users" aria-selected="true" data-original-title="" title=""><i class="fa fa-users"></i>Users</a></li>
            <li class="nav-item"><a class="nav-link" id="roles-top-tab" data-toggle="tab" href="#top-roles" role="tab" aria-controls="top-roles" aria-selected="false" data-original-title="" title=""><i class="icofont icofont-man-in-glasses"></i>Roles</a></li>
        </ul>
        <div class="tab-content" id="top-tabContent">
            <div class="tab-pane fade active show" id="top-users" role="tabpanel" aria-labelledby="top-users-tab">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5><i class="fa fa-users"></i> User Administration</h5>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('users.create') }}" class=" btn btn-pill btn-primary text-light">Add User</a>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display datatables" id="users">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Date/Time Added</th>
                                        <th>User Roles</th>
                                        <th>Operations</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Date/Time Added</th>
                                        <th>User Roles</th>
                                        <th>Operations</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>

                                    @if(count($users)>0)
                                        @foreach ($users as $key=> $user)
                                            <tr>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{$user->created_at}}</td>
                                                <td> {{ get_user_role($user->role)}}</td>
                                                <td>
                                                    <a href="{{route('users.edit',$user->id)}}" class="btn  btn-xs form-inline"><i class="icon-pencil"></i></a>
                                                    <form action="{{route('users.destroy', $user->id)}}"
                                                          onsubmit="return confirm('Are you sure?')" class="d-inline"
                                                          method="POST">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="btn  btn-xs form-inline" style="background: transparent"><i class="icon-trash" style="color: #4466f3"></i></button>
                                                    </form>
                                                    {{--                                  <a href="{{route('user.edit',$user->id)}}" class="btn  btn-xs form-inline"><i class="icon-trash"></i></a>--}}

                                                </td>
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
            <div class="tab-pane fade" id="top-roles" role="tabpanel" aria-labelledby="roles-top-tab">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="fa fa-users"></i> Roles</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display datatables" id="roles">
                                    <thead>
                                    <tr>
                                        @if(count($roles)>0)
                                            <th>Permission</th>
                                            @foreach ($roles as $key=> $role)
                                                <th>
                                                    {{$role->name}}
                                                    <a href="{{route('roles.edit',$role->id)}}" class="btn  btn-xs form-inline"><i class="icon-pencil"></i></a>
                                                    <form action="{{route('roles.destroy', $role->id)}}"
                                                          onsubmit="return confirm('Are you sure?')" class="d-inline"
                                                          method="POST">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="btn  btn-xs form-inline" style="background: transparent"><i class="icon-trash" style="color: #4466f3"></i></button>
                                                    </form>
                                                </th>
                                            @endforeach
                                            <th>Operation</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($permissions as $key=> $permissions)
                                        <tr>
                                            <td>{{$permissions->name}}</td>
                                            @foreach ($roles as $key=> $role)
                                                <td>
                                                    <div class="checkbox checkbox-primary">
                                                        <input style="opacity: 100!important;" type="checkbox" {{($role->hasPermissionTo($permissions->name)) ? 'checked' : ''}} class="permission" data-role="{{$role->id}}" data-permission="{{$permissions->name}}" name="{{$permissions->name}}" >
                                                    </div>
                                                </td>
                                            @endforeach
                                            <td>
                                                <a href="{{route('role_permission.edit',$permissions->id)}}" class="btn  btn-xs form-inline"><i class="icon-pencil"></i></a>
                                                <form action="{{route('role_permission.destroy', $permissions->id)}}"
                                                      onsubmit="return confirm('Are you sure?')" class="d-inline"
                                                      method="POST">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn  btn-xs form-inline" style="background: transparent"><i class="icon-trash" style="color: #4466f3"></i></button>
                                                </form>
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
    </div>
@endsection
@section('script')
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('assets/js/notify/index.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#top-users-tab').click(function(e) {
            });
            $(".permission").change(function(){
                //get id role and get permission name
                var role_id = $(this).data('role');
                var permission_name = $(this).data('permission');
                var link = "{{ url('permissions') }}";

                $.ajax({
                    url: link+"/"+role_id+"/update-permission",
                    type: 'PUT',
                    data : {
                        _token : '{!! csrf_token() !!}',
                        permission_name : permission_name,
                    },
                    success: function(result) {
                        $.notify('<i class="fa fa-cloud-upload"></i><strong>Success update permission</strong>', {
                            type: 'theme',
                            allow_dismiss: true,
                            delay: 500,
                            timer: 300
                        })
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#users').DataTable();
        } );

        $(document).ready(function() {
            $('#roles').DataTable();
        } );

        $(document).ready(function() {
            $('#permissions').DataTable();
        } );
    </script>
@endsection
