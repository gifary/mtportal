<div class="col-sm-12 col-xl-12 col-lg-12 col-md-12 make-me-sticky">
            {!! Form::open(array('url' => '/task-search','method'=>'get','class'=>'form-horizontal card p-3 ','id'=>'search-form','enctype'=>'multipart/form-data',)) !!}

                <fieldset>

                    <!-- Form Name -->
                    {{-- <h5 class="m-t-10 text-center">Available Filters</h5> --}}

                    <!-- Text input-->
                    {{-- <div class="form-group row">
                        <label class="col-lg-12 control-label text-lg-left" for="textinput"></label>
                        <div class="col-lg-12">
                            <input id="textinput" name="title" type="text" placeholder="Search Title" class="form-control  input-md" data-original-title="" title="">
                        </div>
                    </div> --}}

                    <!-- Text input-->
                    <div class="form-group row">
                        <div class="col-lg-6">
                        <label class="col-lg-6 control-label text-lg-left" for="textinput">From Date</label>
                            <input id="textinput" name="frmo" type="date"  class="form-control  input-md" data-original-title="" title="">
                        </div>
                        <div class="col-lg-6">
                        <label class="col-lg-6 control-label text-lg-left pt-7" for="to">To Date</label>
                            <input id="textinput" name="to" type="date" class="form-control  input-md" data-original-title="" title="">
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group row">                        
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

                            <select id="assigned_to" class="form-control js-example-basic-single" name="assigned">
                                @php
                                $assineds = \App\User::get();
                                @endphp
                                @foreach( $assineds as $key=>$to)
                                <option  value="{{$to->id}}"> {{$to->name}}-{{$to->email}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <!-- Select Basic -->
                    <div class="form-group row">
                        <label class="col-lg-12 control-label text-lg-left pt-7" for="selectbasic">Priority</label>
                        <div class="col-lg-12">
                            <select id="priority" class="form-control" name="priority">
                                <option value="3">High</option>
                                <option  value="2">Medium</option>
                                <option value="1">Low</option>
                                <option value="0">None</option>
                                <option selected value="null">All</option>
                            </select>
                        </div>
                    </div>

                    <!-- Select Basic -->
                    <div class="form-group row">
                        <label class="col-lg-12 control-label text-lg-left pt-7" for="selectbasic">Status</label>
                        <div class="col-lg-12">
                            <select id="status" class="form-control" name="status">
                                <option value="2">Pending</option>
                                <option  value="3">In Progress</option>
                                <option value="0">Archive</option>
                                <option value="1">Completed</option>
                                <option selected value="null">All</option>
                            </select>
                        </div>
                    </div>
                    <!-- Select Basic -->
                    <div class="form-group row">
                        <label class="col-lg-12 control-label text-lg-left pt-7" for="selectbasic">Task Type</label>
                        <div class="col-lg-12">
                           <select id="ticket_type" name="task_type" class="form-control ">
                                            <option selected="" value="1">New</option>
                                            <option value="2">Open</option>
                                            <option value="3"> Resolved </option>
                                             <option selected value="null">All</option>
                          </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-12 text-center">
                            <button type="submit" class="btn btn-pill btn-primary" data-original-title="" title="">Filter</button>
                        </div>
                    </div>

                </fieldset>
            </form>

        </div>

