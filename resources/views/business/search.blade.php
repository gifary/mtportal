@extends('layouts.secondary')
@section('title', 'Edit Profile | Martechportal')
<!--
  <link rel="stylesheet" type="text/css" media="all" href="{{asset('assets/autocomplete/style.css')}}">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">-->

@section('style')
<style>
  .vertical-center {

    display: flex;
    align-items: center;
  }
</style>


@endsection

@section('breadcrumb-title', 'Account Details')
@section('breadcrumb-items')
<li class="breadcrumb-item"><a class="breadcrumb-item" href="{{route('business')}}"><span>Martech Business</span></a>
</li>
<li class="breadcrumb-item active">Business Details</li>
@endsection

@section('content')
<!-- Container-fluid starts-->
<div class="container-fluid">

  <!--////////////////////ADD CONTACT MODAL////////////////
-->
  <div class="modal fade" id="exampleModalgetbootstrap" tabindex="-1" role="document"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">New Business Contact</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('contact.store') }}" method="POST">
            {{ csrf_field() }}
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input required class="form-control" id="name" name="name" type="text" placeholder="Enter Name">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input required class="form-control" id="email" name="email" type="email" placeholder="Enter Email">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="position">Position</label>
                    <input required class="form-control" id="position" name="position" type="text"
                      placeholder="Enter position">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="phone">Phone</label>
                    <input required class="form-control" id="phone" name="phone" type="number"
                      placeholder="Enter Phone Number">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div>
                    <label for="department">Department</label>
                    <select class="form-control" id="department" name="department">
                      <option value="">
                        SELECT
                      </option>
                      <option value="SEO">
                        SEO
                      </option>
                      <option value="Website">
                        Website
                      </option>
                      <option value="Development">
                        Development
                      </option>
                      <option value="Business">
                        Business
                      </option>
                      <option value="Design">
                        Design
                      </option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-pill btn-secondary" type="button" data-dismiss="modal">Close</button>
          <input required type="hidden" value={{ $details[0]->id }} name="business_id" id="business_id" />
          <input required type="hidden" value={{ $details[0]->id }} name="business_id" id="business_id" />
          <button class="btn btn-pill btn-primary" type="submit">Submit</button>
        </div>
        </form>
      </div>
    </div>
  </div>


  <!--//////////////CONTACT MODAL END/////////////////// -->

  <!--////////////////////EDIT CONTACT MODAL////////////////
-->
  <div class="modal fade" id="editModel" tabindex="-1" role="document" aria-labelledby="editModelLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="business">Edit Business Contact</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">×</span></button>
        </div>
        <form action="{{ route('contact.update',[1]) }}" method="patch">
          {{ csrf_field() }}
          <div class="modal-body">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input value="" required class="form-control" id="name" name="name" type="text"
                      placeholder="Enter Full Name">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input value="" required class="form-control" id="email" name="email" type="email"
                      placeholder="Enter Email Address">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="position">position</label>
                    <input value="" required class="form-control" id="position" name="position" type="username"
                      placeholder="Enter position">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="phone">phone</label>
                    <input value="" required class="form-control" id="phone" name="phone" type="number"
                      placeholder="Enter Phone Number">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="department">department</label>
                    <select class="form-control" id="department" name="department">
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-pill btn-secondary" type="button" data-dismiss="modal">Close</button>
            <input required type="hidden" value="" name="business_id" id="business_id" />
            <input required type="hidden" value="" name="id" id="id" />
            <button class="btn btn-pill btn-primary" type="submit">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <!--//////////////EDIT CONTACT MODAL END/////////////////// -->

  <!--////////////////////EDIT STACK MODAL////////////////
-->
  <div class="modal fade" id="editStackModal" tabindex="-1" role="document" aria-labelledby="editStackModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="business">Edit Business Stack</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">×</span></button>
        </div>

        {!! Form::model(Auth::user(), [
        'method' => 'PATCH',
        'route' => ['user.preferences.update',1]
        ]) !!}

        {{ csrf_field() }}

        <div class="modal-body">
          <div class="card-body">

            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input value="" required class="form-control" id="name" name="name" type="text"
                    placeholder="Enter Full Name">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input value="" required class="form-control" id="email" name="email" type="email"
                    placeholder="Enter Email Address">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="username">Username</label>
                  <input value="" required class="form-control" id="username" name="username" type="username"
                    placeholder="username">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="password">Password</label>
                  <input value="" required class="form-control" id="password" name="password" type="password"
                    placeholder="Password">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="url">Url</label>
                  <input value="" required class="form-control" id="url" name="url" type="url" placeholder="Enter URL">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="category">Category</label>
                  <select class="form-control" id="category" name="category">
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="notice">Notes</label>
                  <textarea value="" required class="form-control" id="notice" name="notice" rows="3"></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-pill btn-secondary" type="button" data-dismiss="modal">Close</button>
          <input required type="hidden" value="" name="business_id" id="business_id" />
          <input required type="hidden" value="" name="id" id="id" />
          <button class="btn btn-pill btn-primary" type="submit">Submit</button>
        </div>
        </form>
      </div>
    </div>
  </div>


  <!--//////////////EDIT STACK MODAL END/////////////////// -->

  <!--////////////////////EDIT STACK MODAL////////////////
-->
  <div class="modal fade bd-example-modal-lg " id="addBusinessModal" tabindex="-1" role="document"
    aria-labelledby="addBusinessModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="dialog">
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
                    <input required class="form-control" id="contact1" name="contact1" type="number"
                      placeholder="Enter Phone Number">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="contact2">Contact Number 2</label>
                    <input class="form-control" id="contact2" name="contact2" type="username"
                      placeholder="Enter Phone Number">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="deal_size">Deal Size</label>($)
                    <input required class="form-control" id="dual_size" name="dual_size" type="number"
                      placeholder="In Dollars">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="closed_won_date">Closed Won Date</label>
                    <input required class="form-control" id="closed_won_date" name="closed_won_date" type="date"
                      placeholder="Enter Closed Won Date">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="lead_industry">Enter Lead Industry</label>
                    <input required class="form-control" id="lead_industry" name="lead_industry" type="text"
                      placeholder="Enter Lead Industry">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="lead_source">Lead Source</label>
                    <input required class="form-control" id="lead_source" name="lead_source" type="text"
                      placeholder="Enter Lead Source">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="market_contact">Marketing Contact</label>
                    <input required class="form-control" id="market_contact" name="market_contact" type="text"
                      placeholder="Enter Contact Person’s Name">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="market_email">Marketing Contact Email</label>
                    <input required class="form-control" id="market_email" name="market_email" type="email"
                      placeholder="Enter Contact Person’s Email">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="market_phone">Marketing Contact Phone</label>
                    <input required class="form-control" id="market_phone" name="market_phone" type="number"
                      placeholder="Enter Contact Person’s Phone Number">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="billing_contact">Billing Contact</label>
                    <input required class="form-control" id="billing_contact" name="billing_contact" type="text"
                      placeholder="Enter Name">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="profile_image">Add Business Logo</label>
                    <input required class="form-control" id="profile_image" name="profile_image" type="file"
                      accept="image/x-png,image/jpeg">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="billing_phone">Billing Phone</label>
                    <input required class="form-control" id="billing_phone" name="billing_phone" type="text"
                      placeholder="Enter Billing Number">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="billing_email">Billing Email</label>
                    <input required class="form-control" id="billing_email" name="billing_email" type="email"
                      placeholder="Enter Billing Email">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="special_notes">Special Notes</label>
                    <textarea class="form-control" id="special_notes" name="special_notes" rows="4" cols="50"
                      placeholder="Enter Your Notes Here">
                  </textarea>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="billing_address">Billing Address</label>
                    <textarea class="form-control" id="billing_address" name="billing_address" rows="4" cols="50"
                      placeholder="Enter Billing Address">
                  </textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-pill btn-secondary" type="button" data-dismiss="modal">Close</button>
            <input required type="hidden" value="" name="business_id" id="business_id" />
            <input required type="hidden" value="" name="id" id="id" />
            <button class="btn btn-pill btn-primary" type="submit">Create Business</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <!--//////////////EDIT Business MODAL END/////////////////// -->

  <!--////////////////////ADD STACK MODAL////////////////
-->
  <div class="modal fade" id="exampleModalgetbootstrap" tabindex="-1" role="document"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">New Business Contact</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('contact.store') }}" method="POST">
            {{ csrf_field() }}

            <div class="card-body">
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input required class="form-control" id="name" name="name" type="text" placeholder="Enter Name">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input required class="form-control" id="email" name="email" type="email" placeholder="Enter Email">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="position">position</label>
                    <input required class="form-control" id="position" name="position" type="username"
                      placeholder="position">
                  </div>
                </div>

                <div class="col">
                  <div class="form-group">
                    <label for="phone">phone</label>
                    <input required class="form-control" id="phone" name="phone" type="number"
                      placeholder="Phone Number">
                  </div>
                </div>
              </div>


              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="department">department</label>
                    <input required class="form-control" id="department" name="department" type="text"
                      placeholder="Enter department">
                  </div>
                </div>




              </div>



            </div>





        </div>
        <div class="modal-footer">
          <button class="btn btn-pill btn-secondary" type="button" data-dismiss="modal">Close</button>


          <input required type="hidden" value={{ $details[0]->id }} name="business_id" id="business_id" />

          <button class="btn btn-pill btn-primary" type="submit">Submit</button>



        </div>

        </form>
      </div>
    </div>
  </div>




  <!-- End CONTACT MODAL -->




  <!--////////////////////ADD STACK MODAL////////////////
-->
  <div class="modal fade" id="addStackModal" tabindex="-1" role="document" aria-labelledby="addStackModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">New Business Stack</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">

          <form action="{{ route('stack.store') }}" method="POST">

            {{ csrf_field() }}


            <div class="card-body">

              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="name">Service Name</label>
                    <input required class="form-control" id="name" name="name" type="text" placeholder="Enter Name">
                  </div>
                </div>

                <div class="col">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input required class="form-control" id="email" name="email" type="email" placeholder="Enter Email">
                  </div>
                </div>

              </div>





              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input required class="form-control" id="username" name="username" type="username"
                      placeholder="Enter Username">
                  </div>
                </div>

                <div class="col">
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input required class="form-control" id="password" name="password" type="password"
                      placeholder="Enter Password">
                  </div>
                </div>
              </div>


              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="url">Login URL</label>
                    <input required class="form-control" id="url" name="url" type="url" placeholder="Enter URL">
                  </div>
                </div>

                <div class="col">
                  <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control" id="category" name="category">
                      <option value="">
                        Select
                      </option>
                      <option value="Social">
                        Social
                      </option>
                      <option value="Website">
                        Website
                      </option>
                      <option value="Service">
                        Service
                      </option>
                      <option value="Business">
                        Business
                      </option>

                    </select>





                  </div>
                </div>
              </div>







              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="notice">Notes</label>
                    <textarea required class="form-control" id="notice" name="notice"
                      placeholder="Enter Your Notes Here" rows="3"></textarea>
                  </div>
                </div>
              </div>
            </div>













        </div>
        <div class="modal-footer">
          <button class="btn btn-pill btn-secondary" type="button" data-dismiss="modal">Close</button>


          <input required type="hidden" value={{ $details[0]->id }} name="business_id" id="business_id" />
          <button class="btn btn-pill btn-primary" type="submit">Submit</button>



        </div>

        </form>
      </div>
    </div>
  </div>
  <!--////////////////////END STACK MODAL////////////////-->

  <div class="edit-profile">

    <div class="row justify-content-center">
      <div class="col-lg-6">
        <div class="form-group">
          <form action="{{ route('business.search') }}" method="POST">
            {{ csrf_field() }}
            <div class="input-group">
              <input style="  border-bottom-left-radius: 25px;  border-top-left-radius: 25px;" required type="text"
                class="form-control" name="keyward" id="keyward" placeholder="Search Company details...">
              <div class="input-group-append">
                <button class="btn btn-primary" type="submit"
                  style="border-top-right-radius: 25px;  border-bottom-right-radius: 25px;">Search</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header b-l-primary border-3">
          <h5 class="text-center">Account Details</h5>
          <div class="text-center m-10"><img class="img-100 align-self-center border" alt=""
              src="{{ $details[0]->image}}"></div>
        </div>
        <div class="table-responsive">
          <table class="table table-striped">
            <tbody>
              <tr>
                <th class="text-right">Business Name :</th>
                <td>{{ $details[0]->cname}}</td>
                <th class="text-right">Business Abbreviation :</th>
                <td>{{ $details[0]->business_abbreviation}}</td>
              </tr>
              <tr>
                <th class="text-right">Contact Number 1 :</th>
                <td>{{ $details[0]->contact1}}</td>
                <th class="text-right">Contact Number 2 :</th>
                <td>{{ $details[0]->contact2}}</td>
              </tr>
              <tr>
                <th class="text-right">Deal Size :</th>
                <td>${{ $details[0]->dual_size}}</td>
                <th class="text-right">Closed Won Date :</th>
                <td>{{ $details[0]->closed_won_date}}</td>
              </tr>
              <tr>
                <th class="text-right">Lead Industry :</th>
                <td>{{ $details[0]->lead_industry}}</td>
                <th class="text-right">Lead Source :</th>
                <td>{{ $details[0]->lead_source}}</td>
              </tr>
              <tr>
                <th class="text-right">Marketing Contact :</th>
                <td colspan="3">{{ $details[0]->market_contact}}</td>
              </tr>
              <tr>
                <th class="text-right">Marketing Contact Email :</th>
                <td>{{ $details[0]->market_email}}</td>
                <th class="text-right">Marketing Contact Phone :</th>
                <td>{{ $details[0]->market_phone}}</td>
              </tr>
              <tr>
                <th class="text-right">Billing Contact :</th>
                <td>{{ $details[0]->billing_contact}}</td>
                <th class="text-right">Billing Address :</th>
                <td>{{ $details[0]->billing_address}}</td>
              </tr>
              <tr>
                <th class="text-right">Billing Phone :</th>
                <td>{{ $details[0]->billing_phone}}</td>
                <th class="text-right">Billing Email :</th>
                <td>{{ $details[0]->billing_email}}</td>
              </tr>
              <tr>
                <th class="text-right">Special Notes :</th>
                <td colspan="3">{{ $details[0]->special_notes}}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </div>




    <div class="container-fluid">
      <div class="default-according style-1" id="accordionoc2">


        <div class="card container-fluid">
          <div class="card-header badge-pill collapsed" style="margin-right: 30px;" data-toggle="collapse"
            data-target="#collapseicon2" aria-expanded="false">
            <h5 class="mb-0">
              MARTECH STACK
              <span class="pull-right justify-content-center vertical-center mt-2" id="caret_id1">&#9660;</span>
              <span class="pull-right collapsed justify-content-center align-content-center" style="margin-right: 30px;"
                data-toggle="collapse" data-target="#collapseicon2" aria-expanded="false">


                <button class="btn btn-pill btn-primary pull-right" type="button" data-toggle="modal"
                  data-target="#addStackModal" id="addStackId" data-whatever="@getbootstrap">ADD</button>




              </span>
            </h5>
          </div>
          <div class="collapse" id="collapseicon2" aria-labelledby="headingeight" data-parent="#accordionoc2">





            <div class="table-responsive">
              <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">URL</th>
                    <th scope="col">ID</th>
                    <th scope="col">Password</th>
                    <th scope="col">Category</th>
                    <th scope="col">Notes</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>

                  @foreach ($details[0]->stacks as $stack)
                  <tr>
                    <td style="display: none;">{{$stack->id }}</td>
                    <td class="text-center">
                      <!-- <div class="checkbox">
  <input id="checkbox1" type="checkbox">
</div> -->
                      {{ Form::checkbox('asap',null,null, array('id'=>$stack->id)) }}
                    </td>
                    <td>{{ $stack->name }}</td>
                    <td>{{ $stack->email }}</td>
                    <td>{{ $stack->url }}</td>
                    <td>{{ $stack->username }}</td>
                    <td>{{ $stack->password }}</td>
                    <td>{{ $stack->category }}</td>
                    <td>{{ $stack->notice }}</td>
                    <td>



                      <form action="{{ route('stack.destroy', [$stack->id,$details[0]->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf

                        {{ csrf_field() }}


                        <a class="btn  btn-xs form-inline" ata-toggle="modal" data-target="#editStackModal"
                          data-whatever="@getbootstrap" id="editStackId" name="editStackId"><i
                            class="fa fa-edit "></i></a>







                        <input type="hidden" value="{{$details[0]->id}}" name="business_id_fetch"
                          id="business_id_fetch">
                        <input type="hidden" value="{{$stack->id}}" name="contacts_id_hidden" id="contacts_id_hidden">


                        <input type="hidden" value="{{$details[0]->id}}" name="business_id" id="business_id">
                        <a href="{{ route('stack.destroy', [$stack->id,$details[0]->id]) }}"
                          class="btn  btn-xs form-inline"><i class="fa fa-trash"></i></a>






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







    <div class="container-fluid mt-3 mb-5">
      <div class="default-according style-1" id="accordionoc">

        <div class="card container-fluid">
          <div class="card-header badge-pill collapsed" style="margin-right: 30px;" data-toggle="collapse"
            data-target="#collapseicon1" aria-expanded="false">
            <h5 class="mb-0">
              CONTACT PERSON
              <span class="pull-right justify-content-center vertical-center mt-2" id="caret_id2">&#9660;</span>
              <span class="pull-right collapsed justify-content-center align-content-center" style="margin-right: 30px;"
                data-toggle="collapse" data-target="#collapseicon1" aria-expanded="false">

                <button class="btn btn-pill btn-primary pull-right" type="button" data-toggle="modal"
                  data-target="#exampleModalgetbootstrap" data-whatever="@getbootstrap">ADD </button>



              </span>
            </h5>
          </div>
          <div class="collapse" id="collapseicon1" aria-labelledby="headingeight" data-parent="#accordionoc">

            <div class="table-responsive">
              <table class="table">
                <thead class="thead-dark">
                  <tr>

                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Position</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Department</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>

                  @foreach ($details[0]->contacts as $contacts)
                  <tr>
                    <td style="display:none;">{{$contacts->id}}
                    </td>
                    <td class="text-center">

                      <input type="checkbox" name="contact_ids[]" value="{{ $contacts->id }}">



                    </td>
                    <td>{{ $contacts->name }}</td>
                    <td>{{ $contacts->email }}</td>
                    <td>{{ $contacts->position }}</td>
                    <td>{{ $contacts->phone }}</td>
                    <td>{{ $contacts->department }}</td>
                    <td>
                      <form action="{{ route('contact.destroy', [$contacts->id,$details[0]->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf

                        {{ csrf_field() }}


                        <a class="btn  btn-xs form-inline" ata-toggle="modal" data-target="#editContactBlade"
                          data-whatever="@getbootstrap" id="editContactId" name="editContactId"><i
                            class="fa fa-edit "></i></a>

                        <input type="hidden" value="{{$details[0]->id}}" name="business_id_fetch"
                          id="business_id_fetch">

                        <input type="hidden" value="{{$details[0]->id}}" name="business_id" id="business_id">


                        <input type="hidden" value="{{$contacts->id}}" name="contacts_id_hidden"
                          id="contacts_id_hidden">


                        <input type="hidden" value="{{$details[0]->id}}" name="business_id" id="business_id">
                        <a href="{{ route('contact.destroy', [$contacts->id,$details[0]->id]) }}"
                          class="btn  btn-xs form-inline"><i class="fa fa-trash"></i></a>






                      </form>
                      {{ csrf_field() }}

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
<!-- Container-fluid Ends-->
@endsection
@section('script')
<!--<script type="text/javascript" src="{{ asset('assets/autocomplete/js/jquery.autocomplete.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/autocomplete/js/currency-autocomplete.js') }}"></script>
 <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
-->
<script>
  $(document).ready(function(){

/*
 $( "#keyward" ).autocomplete({
        source: function( request, response ) {
          // Fetch data
          $.ajax({
            url:"{{route('business.datas')}}",
            type: 'post',
            dataType: "json",
            data: {
               _token: CSRF_TOKEN,
               search: request.term
            },
            success: function( data ) {
               response( data );
            }
          });
        },
        select: function (event, ui) {
           // Set selection
          // $('#keyward').val(ui.item.label); // display the selected text
           $('#keyward').val(ui.item.cname); // save selected id to input
           return false;
        }
      });













*/



/*
  
  // setup autocomplete function pulling from currencies[] array
  $('#keyward').autocomplete({
    lookup: currencies,
    onSelect: function (suggestion) {
      
    }
  });






  

});
  

  
if ($(window).width() < 500) {
 $("#caret_id1").css("display","none");
 $("#caret_id2").css("display","none");
}
else {
   $("#caret_id1").css("display","block");
    $("#caret_id2").css("display","block");
}




 $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });







 fetch_customer_data();



 function fetch_customer_data(query = '')
 {

  $.ajax({
   url:"{{ route('live_search.action') }}",
   method:'GET',
   data:{query:query},
   dataType:'json',
   success:function(data)
   {
    //$('tbody').html(data.table_data);
  //  $('#total_records').text(data.total_data);
   }
  })
 }
/*
 $(document).on('keyup', '#keyward', function(){
  var query = $(this).val();

  fetch_customer_data(query);
 });
*/

$(document).on('click', "#addStackId", function(e){
 
    e.preventDefault();
  $( "#collapseicon2" ).removeClass( "collapse" );

  }
  );


$(document).on('click', "#addContactId", function(e){
 
    e.preventDefault();
  $( "#collapseicon1" ).removeClass( "collapse" );

  }
  );


 $(document).on('click', "#editContactId", function(e){
 
    e.preventDefault();

    var keyward = $(this).closest("tr").find('td:eq(0)').text();
     //  alert(keyward);

   // alert(keyward);
$.ajax({
    cache: false,
    type: 'get',
    url: "{{ route('contact.showmodal') }}",
    data:  { 'id': keyward},
    success: function(data) {

       // alert(data);
    //  $modal=$('#editModel')
      
        /*$("#editModel").modal() 
       $("#editModel").find('name').html(data['name']);
       $("#editModel").find('email').html(data['email']);
       $("#editModel").find('position').html(data['position']);
       $("#editModel").find('department').html(data['department']);
    $("#editModel").find('phone').html(data['phone']);
    
       $("#editModel").find('business_id').html(data['business_id']);

*/ var obj = JSON.parse(data);
                     console.log(data);
          // $('#editModel').modal('toggle');
           // alert(obj["id"]);
     





$('#editModel').modal('show').on('shown.bs.modal', function () {
                   
                 // alert(obj['name']);
                  
                    $("#editModel #name").val(obj['name']);
                    $("#editModel #email").val(obj['email']);
                    $("#editModel #position").val(obj['position']);
                    var options="";

                      if(obj['department']=="SEO"){
   options+="<option  value="+obj['department']+">"+obj['department'] +'</option>';
 options+="<option  value='Website'>Website</option>";
 options+="<option  value='Development'>Development</option>";
  options+="<option  value='Business'>Business</option>";
   options+="<option  value='Design'>Design</option>";

                      }
                      else if(obj['department']=="Website"){

options="";
   options+="<option  value="+obj['department']+">"+obj['department'] +'</option>';
 options+="<option  value='SEO'>SEO</option>";
 options+="<option  value='Development'>Development</option>";
  options+="<option  value='Business'>Business</option>";
   options+="<option  value='Design'>Design</option>";

                 
                        
                      }
                      else if(obj['department']=="Development"){

options="";
   options+="<option  value="+obj['department']+">"+obj['department'] +'</option>';
 options+="<option  value='SEO'>SEO</option>";
 options+="<option  value='Website'>Website</option>";
  options+="<option  value='Business'>Business</option>";
   options+="<option  value='Design'>Design</option>";

                 
                        
                      }
                      else if(obj['department']=="Business"){
options="";

   options+="<option  value="+obj['department']+">"+obj['department'] +'</option>';
    options+="<option  value='SEO'>SEO</option>";
 options+="<option  value='Website'>Website</option>";
 options+="<option  value='Development'>Development</option>";
 
   options+="<option  value='Design'>Design</option>";

                 
                        
                      }
                      else if(obj['department']=="Design"){
          options="";              
   options+="<option  value="+obj['department']+">"+obj['department'] +'</option>';
    options+="<option  value='SEO'>SEO</option>";
 options+="<option  value='Website'>Website</option>";
 options+="<option  value='Development'>Development</option>";
  options+="<option  value='Business'>Business</option>";
  

                 
                      }


            $("#editModel #department")
                    .html(""); 
                    $("#editModel #department")
                    .append(options);

  
                   

                    $("#editModel #id").val(obj['id']);
                   $("#editModel #phone").val(obj['phone']);
                  ///  var datajson = GetCountyData(stateid);

                });


            




    }
});

 });



//////////EDIT STACK SCRIPT







 $(document).on('click', "#editStackId", function(e){
 
    e.preventDefault();

    var keyward = $(this).closest("tr").find('td:eq(0)').text();
     //  alert(keyward);

   // alert(keyward);
$.ajax({
    cache: false,
    type: 'get',
    url: "{{ route('stack.showmodal') }}",
    data:  { 'id': keyward},
    success: function(data) {

       // alert(data);
    //  $modal=$('#editModel')
      
        /*$("#editModel").modal() 
       $("#editModel").find('name').html(data['name']);
       $("#editModel").find('email').html(data['email']);
       $("#editModel").find('position').html(data['position']);
       $("#editModel").find('department').html(data['department']);
    $("#editModel").find('phone').html(data['phone']);
    
       $("#editModel").find('business_id').html(data['business_id']);

*/ var obj = JSON.parse(data);
                     console.log(data);
          // $('#editModel').modal('toggle');
           // alert(obj["id"]);
     





$('#editStackModal').modal('show').on('shown.bs.modal', function () {
                   
                 // alert(obj['name']);
                  
                    $("#editStackModal #name").val(obj['name']);
                    $("#editStackModal #email").val(obj['email']);
                    $("#editStackModal #username").val(obj['id']);
                    $("#editStackModal #password").val(obj['password']);
                    $("#editStackModal #url").val(obj['url']);
                  









var options="";

                      if(obj['category']=="Social"){
   options+="<option  value="+obj['category']+">"+obj['category'] +'</option>';
 options+="<option  value='Website'>Website</option>";
 options+="<option  value='Service'>Service</option>";
  
                      }
                      else if(obj['category']=="Website"){
 options+="<option  value="+obj['category']+">"+obj['category'] +'</option>';
 options+="<option  value='Social'>Social</option>";
 options+="<option  value='Service'>Service</option>";
       
                        
                      }
                      else if(obj['category']=="Service"){

 options+="<option  value="+obj['category']+">"+obj['category'] +'</option>';
 options+="<option  value='Website'>Website</option>";
 options+="<option  value='Social'>Social</option>";
       
                        
                      }
                      
                      
            $("#editStackModal #category")
                    .html(""); 
                    $("#editStackModal #category")
                    .append(options);























                     $("#editStackModal #notice").val(obj['notice']); 

                   
                      $("#editStackModal #id").val(obj['id']);          

                  ///  var datajson = GetCountyData(stateid);

                });


            




    }
});

 });












///////////////////ADD BUSINESS ACCOUNT ?///////






 $(document).on('click', "#addBusinessId", function(e){
 
    e.preventDefault();
     //  alert(keyward);

   // alert(keyward);





$('#addBusinessModal').modal('show').on('shown.bs.modal', function () {
                   
                 // alert(obj['name']);
                  
                         

                  ///  var datajson = GetCountyData(stateid);

              }); 
 });














});
</script>






<script>
  $(document).ready(function(){
/*
 $(document).on('keyup', '#keyward', function(){
        var query = $(this).val();
        if(query != '')
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"{{ route('autocomplete.fetch') }}",
          method:"POST",
          data:{query:query, _token:_token},
          success:function(data){
           $('#business_lists').fadeIn();  
                    $('#business_lists').html(data);
          }
         });
        }
    });

    $(document).on('click', 'li', function(){  
        $('#country_name').val($(this).text());  
        $('#countryList').fadeOut();  
    });  















//Edit Contact Ajax



*/


});
</script>















@endsection