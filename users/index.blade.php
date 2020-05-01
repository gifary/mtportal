
{{-- \resources\views\users\index.blade.php --}}
@extends('layouts.master')

@section('title', '| Users')

@section('breadcrumb-items')
<li class="breadcrumb-item active">View Users</li>
@endsection
@section('breadcrumb-buttons')

<a href="{{ route('users.create') }}"><button class=" btn btn-pill btn-primary text-light" type="button" data-toggle="modal"
        
        data-original-title="" title="">Create Users
</button></a>
@endsection

@section('content')

<div class="col-sm-12 col-xl-12 xl-100 set-col-12">
      <div class="card">
        <div class="card-header">
          <h5><i class="fa fa-users"></i>User Administration</h5>
        </div>
        <div class="card-body">
          <ul class="nav nav-tabs nav-right" id="right-tab" role="tablist">
            <li class="nav-item"><a class="nav-link active" id="right-home-tab" data-toggle="tab"
            href="#right-home" 
            role="tab" 
            aria-controls="right-home" 
            aria-selected="false">
            <i class="icofont icofont-ui-home">
            </i>
                Users
            </a>
            </li>
            <li class="nav-item"><a class="nav-link" id="profile-right-tab"  href="{{ route('roles.index') }}" role="tab" aria-controls="profile-icon" aria-selected="true"><i class="icofont icofont-man-in-glasses"></i>Roles</a></li>
            <li class="nav-item"><a class="nav-link" id="contact-right-tab"  href="{{ route('permissions.index') }}" role="tab" aria-controls="contact-icon" aria-selected="false"><i class="icofont icofont-contacts"></i>Permissions</a></li>
          </ul>
          <div class="tab-content" id="right-tabContent">
            <div class="tab-pane fade show active" id="right-home" role="tabpanel" aria-labelledby="right-home-tab">


<div class="col-lg-12 col-lg-offset-1">
   
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date/Time Added</th>
                    <th>User Roles</th>
                    <th>Operations</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                <tr>

                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
                    <td>{{  $user->roles()->pluck('name')->implode(' ') }}</td>{{-- Retrieve array of roles associated to a user and convert to string --}}
                    <td>
                    <a href="{{ URL::to('/edit-user', $user->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                    <a href="{{ URL::to('/edit-user', $user->id) }}" class="btn btn-danger pull-left" style="margin-right: 3px;">Delete</a>


                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <a href="{{ route('users.create') }}" class="btn btn-success">Add User</a>

</div>
            </div>
            
            
            <div class="tab-pane fade" id="right-profile" role="tabpanel" aria-labelledby="profile-right-tab">
             
             
             
            </div>
            
            
            <div class="tab-pane fade" id="right-contact" role="tabpanel" aria-labelledby="contact-right-tab">
           
           
           
            </div>
          </div>
        </div>
      </div>
    </div>
  

@endsection


@section('script')


@endsection