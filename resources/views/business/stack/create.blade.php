@extends('layouts.master')
@section('title', 'Base inputs | Martechportal')
@section('style')

@endsection

@section('breadcrumb-title', 'Business Stack')
@section('breadcrumb-items')
<li class="breadcrumb-item">Home</li>
<li class="breadcrumb-item">Business Account</li>
<li class="breadcrumb-item active">Stack</li>
@endsection
  
@section('content')
<!-- Container-fluid starts-->
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h5>Add New Stack</h5>
        </div>

        <form action="{{ route('stack.store') }}" method="POST">
        
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
                  <label for="username">ID</label>
                  <input required class="form-control" id="username" name="username" type="username" placeholder="username">
                </div>
              </div>

              <div class="col">
                <div class="form-group">
                  <label for="password">Password</label>
                  <input required class="form-control" id="password"  name="password" type="password" placeholder="Password">
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="url">Url</label>
                  <input required class="form-control" id="url" name="url" type="url" placeholder="Enter URL">
                </div>
              </div>

              <div class="col">
                <div class="form-group">
                  <label for="category">Category</label>
                  <input required class="form-control" id="category"  name="category" type="text" placeholder="category">
                </div>
              </div>
            </div>
          




           
       
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="notice">Notes</label>
                  <textarea required class="form-control" id="notice"  name="notice" rows="3"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
          <input required type="hidden" value={{$id}} name="business_id" id="business_id"/>
            <button class="btn btn-pill btn-primary" type="submit">Submit</button>
         
          </div>
        </form>
      </div>
         
        </form>


    </div>
  </div>
</div>
<!-- Container-fluid Ends-->
@endsection
@section('script')

@endsection