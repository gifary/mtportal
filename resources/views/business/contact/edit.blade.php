@extends('layouts.master')
@section('title', 'Base inputs | Martechportal')
@section('style')

@endsection

@section('breadcrumb-title', 'Contact Person')
@section('breadcrumb-items')
<li class="breadcrumb-item">Home</li>
<li class="breadcrumb-item">Business Account</li>
<li class="breadcrumb-item active">Contact Person</li>
@endsection
  
@section('content')
<!-- Container-fluid starts-->
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h5>Edit Contact</h5>
        </div>

        <form action="{{ route('contact.update',[1]) }}" method="patch">
        
        {{ csrf_field() }}




          <div class="card-body">
         
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="name">Name</label>
                   <input  value="{{$contact->name}}"required class="form-control" id="name" name="name" type="text" placeholder="Enter Name">
                </div>
              </div>

              <div class="col">
                <div class="form-group">
                  <label for="email">Email</label>
                   <input  value="{{$contact->email}}"required class="form-control" id="email" name="email" type="email" placeholder="Enter Email">
                </div>
              </div>

            </div>

            

            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="position">position</label>
                   <input  value="{{$contact->position}}"required class="form-control" id="position" name="position" type="username" placeholder="position">
                </div>
              </div>

              <div class="col">
                <div class="form-group">
                  <label for="phone">phone</label>
                   <input  value="{{$contact->phone}}"required class="form-control" id="phone"  name="phone" type="number" placeholder="Phone Number">
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="department">department</label>
                   <input  value="{{$contact->department}}"required class="form-control" id="department" name="department" type="text" placeholder="Enter department">
                </div>
              </div>

          


    </div>

    
           <input  value="" required type="hidden"  name="id" id="id"/>
            <button class="btn btn-pill btn-primary" type="submit">Submit</button>
         
      
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