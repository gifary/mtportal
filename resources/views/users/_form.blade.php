<div class="modal-body ">
    <!-- Container-fluid starts-->

    <!-- Container-fluid Ends-->
    <div class="card-body">

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="cname">Name</label>
                    {!! Form::text('name',isset($user) ? $user->name : null,['class'=>'form-control','required'=>'true']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="cname">Profile Image</label>
                    @if(isset($user) && $user->profile_pic!=null)
                        <img id="preview_icon" width="75" src="{{$user->profile_pic}}">
                    @else
                        <img id="preview_icon" width="75">
                    @endif
                    <input {{isset($user) ? '' : 'required'}}  class="form-control" name="profile" type="file" id="profile">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="cname">Email</label>
                    <input type="hidden" value="{{isset($user) ? $user->email:null}}" name="old_email">
                    {!! Form::email('email',isset($user) ? $user->email : null,['class'=>'form-control','required'=>'true']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="cname">Personal Contact Number</label>
                    {!! Form::text('personal_contact',isset($user) ? $user->personal_contact : null,['class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="cname">Official Contact Number</label>
                    {!! Form::text('official_contact',isset($user) ? $user->official_contact : null,['class'=>'form-control','required'=>'true']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="cname">Date of Birth</label>
                    {!! Form::date('birth_date',isset($user) ? $user->birth_date : null,['class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <div class="form-group">
                        <label for="start_date">Gender</label>
                        {!! Form::select('gender',array("Male"=>"Male","Female"=>"Female","Others"=>"Others"),isset($user) ? $user->gender : null ,['class'=>'form-control','id'=>'gender']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="cname">Country</label>
                    {!! Form::select('country',$country,isset($user) ? $user->country : null ,['class'=>'form-control','id'=>'country']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="cname">Position</label>
                    {!! Form::text('position',isset($user) ? $user->position : null,['class'=>'form-control','placeholder'=>'Your Position Title']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <div class="form-group">
                        <label for="start_date">Department</label>
                        {!! Form::select('department',$departments,isset($user) ? $user->department : null ,['class'=>'form-control','id'=>'department']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <div class="form-group">
                        <label for="start_date">Role</label>
                        {!! Form::select('role',$roles,isset($user) ? $user->role : null ,['class'=>'form-control','id'=>'role']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <div class="form-group">
                        <label for="start_date">Tier </label>
                        {!! Form::select('tire',array("1"=>"Select 1",'2'=>'Select 2','3'=>'Select 3'),isset($user) ? $user->tire : null ,['class'=>'form-control','id'=>'tire']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <div class="form-group">
                        <label for="start_date">Business Associated With </label>
                        {!! Form::select('businesses',$businesses,isset($user) ? $user->businesses : null ,['class'=>'form-control js-example-basic-single','id'=>'businesses']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <div class="form-group">
                        <label for="start_date">Timezone </label>
                        {!! Form::select('zone_name',$zones,isset($user) ? $user->zone_name : null ,['class'=>'form-control js-example-basic-single','id'=>'zone_name']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="cname">Password</label>
                    {!! Form::password('password',['class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="cname">Confirm Password</label>
                    {!! Form::password('password_confirmation',['class'=>'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <a href="{{route('roles_and_permissions')}}" class="btn btn-pill btn-secondary" type="button" data-dismiss="modal">Close</a>
    <button class="btn btn-pill btn-primary" type="submit">Save User</button>
</div>
@section('script')
    <script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/js/select2/select2-custom.js')}}"></script>
    <script>
        function readImage(input,idImage) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#'+idImage).attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#profile").change(function(){
            readImage(this,'preview_icon');
        });
    </script>
@endsection
