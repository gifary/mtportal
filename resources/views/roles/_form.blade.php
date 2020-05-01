<div class="modal-body ">
    <!-- Container-fluid starts-->

    <!-- Container-fluid Ends-->
    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="cname">Name</label>
                    {!! Form::text('name',isset($role) ? $role->name : null,['class'=>'form-control','required'=>'true']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="cname">Guard Name</label>
                    {!! Form::text('guard_name',isset($role) ? $role->guard_name : null,['class'=>'form-control','required'=>'true']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <a href="{{route('roles_and_permissions')}}" class="btn btn-pill btn-secondary" type="button" data-dismiss="modal">Close</a>
    <button class="btn btn-pill btn-primary" type="submit">Save</button>
</div>

