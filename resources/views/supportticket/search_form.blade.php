<div class="col-sm-12 make-me-sticky">
    <form class="form-horizontal card p-3">
        <fieldset>
            <!-- Text input-->
            <div class="form-group row">
                <label class="col-lg-12 control-label text-lg-left" for="textinput"></label>
                <div class="col-lg-12">
                    <input id="textinput" name="textinput" type="text" placeholder="Search"
                           class="form-control  input-md">
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group row">
                <label class="col-lg-12 control-label text-lg-left" for="textinput">From Date</label>
                <div class="col-lg-12">
                    <input id="textinput" name="textinput" type="text" placeholder="Date"
                           class="form-control  input-md">
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group row">
                <label class="col-lg-12 control-label text-lg-left pt-7" for="textinput">To Date</label>
                <div class="col-lg-12">
                    <input id="textinput" name="textinput" type="text" placeholder="Date"
                           class="form-control  input-md">
                </div>
            </div>

            <!-- Select Basic -->
            <div class="form-group row">
                <label class="col-lg-12 control-label text-lg-left pt-7" for="selectbasic">Business
                    Name</label>
                <div class="col-lg-12">
                    <select id="selectbasic" name="selectbasic" class="form-control ">
                        <option value="1">Option one</option>
                        <option value="2">Option two</option>
                    </select>
                </div>
            </div>

            <!-- Select Basic -->
            <div class="form-group row">
                <label class="col-lg-12 control-label text-lg-left pt-7" for="selectbasic">Assigned
                    To</label>
                <div class="col-lg-12">
                    {!! Form::select('assigned_to', $assignees, null, ['id' => 'assigned_to', 'class' => 'form-control']); !!}
                </div>
            </div>

            <!-- Select Basic -->
            <div class="form-group row">
                <label class="col-lg-12 control-label text-lg-left pt-7" for="selectbasic">Priority</label>
                <div class="col-lg-12">
                    {!! Form::select('priority', array('Higher' => 'Higher', 'Medium' => 'Medium', 'Lower' => 'Lower', 'None' => 'None'), null, ['id' => 'priority', 'class' => 'form-control']); !!}
                </div>
            </div>

            <!-- Select Basic -->
            <div class="form-group row">
                <label class="col-lg-12 control-label text-lg-left pt-7" for="selectbasic">Status</label>
                <div class="col-lg-12">
                    {!! Form::select('status', array('Pending' => 'Pending', 'In Progress' => 'In Progress', 'Dismiss' => 'Dismiss', 'Completed' => 'Completed'), null, ['id' => 'status', 'class' => 'form-control']); !!}
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-12 text-center">
                    <button type="submit" class="btn btn-pill btn-primary">Filter</button>
                </div>
            </div>

        </fieldset>
    </form>

</div>
