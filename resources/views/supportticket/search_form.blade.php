<div class="col-sm-12 make-me-sticky">
    <form class="form-horizontal">
        <fieldset>
            <!-- Text input-->
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="control-label text-lg-left" for="textinput">From Date</label>
                        <input  name="start_date" type="date" placeholder="Date" class="form-control  input-md">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="control-label text-lg-left pt-7" for="textinput">To Date</label>
                        <input  name="end_date" type="date" placeholder="Date" class="form-control  input-md">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="control-label text-lg-left" for="textinput">Created Date</label>
                        <input  name="created_date" type="date" placeholder="Date" class="form-control  input-md">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="control-label text-lg-left pt-7" for="textinput">Due Date</label>
                        <input  name="due_date" type="date" placeholder="Date" class="form-control  input-md">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label class="control-label text-lg-left pt-7" for="selectbasic">Business Name</label>
                        <select id="business" name="business[]" class="form-control" multiple></select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label class="control-label text-lg-left pt-7" for="selectbasic">Assigned To</label>
                        <select id="assigment" name="assigment[]" class="form-control" multiple></select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="control-label text-lg-left pt-7" for="selectbasic">Priority</label>
                        {!! Form::select('priority[]', array('Higher' => 'Higher', 'Medium' => 'Medium', 'Lower' => 'Lower'), null, ['id' => 'priority', 'class' => 'form-control js-example-basic-single','multiple'=>'multiple']); !!}
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="control-label text-lg-left pt-7" for="selectbasic">Status</label>
                        {!! Form::select('status[]', array('New' => 'New', 'Open' => 'Open', 'Assigned' => 'Assigned', 'Resolved' => 'Resolved'), null, ['id' => 'status', 'class' => 'form-control js-example-basic-single','multiple'=>'multiple']); !!}
                    </div>
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
@push('push_js')
    <script>
        $('#assigment').select2({
            placeholder: "Choose Assigment...",
            minimumInputLength: 2,
            ajax: {
                url: '{{route('find_assigment')}}',
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });

        $('#business').select2({
            placeholder: "Choose Business...",
            minimumInputLength: 2,
            ajax: {
                url: '{{route('find_business')}}',
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });

    </script>
@endpush
