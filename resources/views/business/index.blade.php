@extends('layouts.secondary')
@section('title', 'Edit Profile | Martechportal')
@section('style')

@endsection

@section('breadcrumb-title', 'Account Details')
@section('breadcrumb-items')
    <li class="breadcrumb-item" class="breadcrumb-item"><a class="breadcrumb-item">Martech Business</a></li>
@stop

@section('model-button')
<button class=" btn btn-pill btn-primary text-light" type="button" data-toggle="modal" data-target="#addBusinessModal" data-whatever="@getbootstrap" 
id="addBusinessId" name="addBusinessId" 
>Add Business</button>
@endsection
@section('content')
    <!-- Container-fluid starts-->
    <div class="container-fluid">


        <!--////////////////////EDIT STACK MODAL////////////////
        -->
        <div class="modal fade" id="addBusinessModal" tabindex="-1" role="document"
             aria-labelledby="addBusinessModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="business">Add Business</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                    </div>


                    <form action="{{ route('business.store') }}" method="POST" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="modal-body">

                            <div class="card-body">

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                          <label for="cname">Business Name*</label>
                                          <input required class="form-control" id="cname" name="cname" type="text"
                                            placeholder="Enter Business Name">
                                        </div>
                                      </div>
                                      <div class="col">
                                        <div class="form-group">
                                          <label for="business_abbreviation">Business Abbreviation*</label>
                                          <input required class="form-control" id="business_abbreviation" name="business_abbreviation" type="text"
                                            placeholder="Enter Business Abbreviation (4 Characters only)">
                                        </div>
                                      </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="contact1">Contact Number 1</label>
                                            <input required class="form-control" id="contact1" name="c" type="number"
                                                   placeholder="Enter Number 1 ">
                                        </div>
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="contact2">Contact Number 2</label>
                                            <input required class="form-control" id="contact2" name="contact2"
                                                   type="username" placeholder="Enter Number 2">
                                        </div>
                                    </div>


                                    <div class="col">
                                        <div class="form-group">
                                            <label for="deal_size">Deal Size</label>
                                            <input required class="form-control" id="dual_size" name="dual_size"
                                                   type="number" placeholder="Deal Size">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="closed_won_date">Closed Won Date</label>
                                            <input required class="form-control" id="closed_won_date"
                                                   name="closed_won_date" type="date" placeholder="Closed Won Date">
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="lead_industry">Lead Industry</label>
                                            <input required class="form-control" id="lead_industry" name="lead_industry"
                                                   type="text" placeholder="Lead Industry">
                                        </div>
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="lead_source">Lead Source</label>
                                            <input required class="form-control" id="lead_source" name="lead_source"
                                                   type="text" placeholder="Lead Source">
                                        </div>
                                    </div>


                                    <div class="col">
                                        <div class="form-group">
                                            <label for="market_contact">Marketing Contact</label>
                                            <input required class="form-control" id="market_contact"
                                                   name="market_contact" type="number" placeholder="Marketing Contact">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="market_email">Marketing Contact Email</label>
                                            <input required class="form-control" id="market_email" name="market_email"
                                                   type="email" placeholder="Marketing Contact Email">
                                        </div>
                                    </div>


                                    <div class="col">
                                        <div class="form-group">
                                            <label for="market_phone">Marketing Contact Phone</label>
                                            <input required class="form-control" id="market_phone" name="market_phone"
                                                   type="number" placeholder="Marketing Contact Phone">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="billing_contact">Billing Contact</label>
                                            <input required class="form-control" id="billing_contact"
                                                   name="billing_contact" type="text"
                                                   placeholder="Marketing Contact Phone">
                                        </div>
                                    </div>


                                    <div class="col">
                                        <div class="form-group">
                                            <label for="billing_address">Billing Address</label>
                                            <input required class="form-control" id="billing_address"
                                                   name="billing_address" type="text" placeholder="Billing Address">
                                        </div>
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="billing_phone">Billing Phone</label>
                                            <input required class="form-control" id="billing_phone" name="billing_phone"
                                                   type="text" placeholder="Billing Phone">
                                        </div>
                                    </div>


                                    <div class="col">
                                        <div class="form-group">
                                            <label for="billing_email">Billing Email</label>
                                            <input required class="form-control" id="billing_email" name="billing_email"
                                                   type="text" placeholder="Billing Email">
                                        </div>
                                    </div>


                                </div>


                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="special_notes">Special Notes</label>
                                            <input required class="form-control" id="special_notes" name="special_notes"
                                                   type="text" placeholder="Special Notes">
                                        </div>
                                    </div>


                                    <div class="col">
                                        <div class="form-group">
                                            <label for="profile_image">Upload Profile Image</label>
                                            <input required class="form-control" id="profile_image" name="profile_image"
                                                   type="file" accept="image/x-png,image/jpeg">
                                        </div>
                                    </div>
                                </div>


                            </div>


                        </div>


                        <div class="modal-footer">
                            <button class="btn btn-pill btn-secondary" type="button" data-dismiss="modal">Close</button>
                            <input required type="hidden" value="" name="business_id" id="business_id"/>
                            <input required type="hidden" value="" name="id" id="id"/>
                            <button class="btn btn-pill btn-primary" type="submit">Create Business</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>


        <!--//////////////EDIT STACK MODAL END/////////////////// -->


        <div class="container box">

            <div class="panel panel-default">
                <div class="panel-heading"></div>
                <div class="panel-body">


                    <div class="edit-profile">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">


                                <form action="{{ route('business.search') }}" method="POST">

                                    {{ csrf_field() }}
                                    <div class="input-group mb-3">
                                        <input required type="text" class="form-control"
                                               style="  border-bottom-left-radius: 25px;  border-top-left-radius: 25px;"
                                               name="keyward" id="keyward" placeholder="Search Company details...">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit"
                                                    style="border-top-right-radius: 25px;  border-bottom-right-radius: 25px;">
                                                Search
                                            </button>

                                        </div>

                                    </div>


                                </form>


                            </div>

                        </div>
                    </div>


                    <div class="col-sm-12 col-lg-12 col-xl-12">
                        <div class="card">
                            <div class="card-header b-l-primary border-3">
                                <h5 class="text-center">Business Accounts </h5>
                                <div class="text-center m-10"><img class="img-100 align-self-center border" alt=""
                                                                   src="{{ asset('assets/images/martechportal_logo.png') }}">
                                </div>
                            </div>


                            <div class="table-responsive">

                                <table class="table table-striped table-bordered  " id="table">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Business Name</th>
                                        <th scope="col">Marketing Email</th>
                                        <th scope="col">Contact Number 1</th>
                                        <th scope="col">Special Notes</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>


    <!-- Container-fluid Ends-->
@endsection
@section('script')

    <script>
        $(document).ready(function () {


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $(document).on('click', "#viewId", function () {


                var keyward = $(this).closest("tr").find('td:eq(0)').text();


//alert("Double clicked on "+keyward);
                $(location).attr('href', "{{url('/business/newsearch')}}/" + keyward);

                // alert(keyward);

                // alert(keyward);


            });


///////////////////ADD BUSINESS ACCOUNT ?///////


            $(document).on('click', "#addBusinessId", function () {


                //  alert(keyward);

                // alert(keyward);


                $('#addBusinessModal').modal('show').on('shown.bs.modal', function () {

                    // alert(obj['name']);


                    ///  var datajson = GetCountyData(stateid);

                });
            });


            fetch_customer_data();

            function fetch_customer_data(query = '') {
                $.ajax({
                    url: "{{ route('live_search.action') }}",
                    method: 'GET',
                    data: {query: query},
                    dataType: 'json',
                    success: function (data) {
                        $('tbody').html(data.table_data);
                        $('#total_records').text(data.total_data);
                    }
                })
            }

            $(document).on('keyup', '#keyward', function () {
                var query = $(this).val();

                fetch_customer_data(query);
            });

            $(document).on("dblclick", "#table tr", function () {

                var keyward = $(this).closest("tr").find('td:eq(0)').text();
//viewdetails_process(keyward);


//alert("Double clicked on "+keyward);
                $(location).attr('href', "{{url('/business/newsearch')}}/" + keyward);

            });


        });
    </script>




    <script>
        $(document).ready(function () {

            $(document).on('keyup', '#keyward', function () {
                var query = $(this).val();
                if (query != '') {
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url: "{{ route('autocomplete.fetch') }}",
                        method: "POST",
                        data: {query: query, _token: _token},
                        success: function (data) {
                            $('#business_lists').fadeIn();
                            $('#business_lists').html(data);
                        }
                    });
                }
            });


        });
    </script>














@endsection
