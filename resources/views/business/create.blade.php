  <form action="{{ route('business.store') }}" method="POST" enctype="multipart/form-data">
        
        {{ csrf_field() }}


          <div class="card-body">

            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="cname">Business Name</label>
                  <input required class="form-control" id="cname" name="cname" type="text" placeholder="Enter Name">
                </div>
              </div>

              <div class="col">
                <div class="form-group">
                  <label for="contact1">Contact Number 1</label>
                  <input required class="form-control" id="contact1" name="c" type="number" placeholder="Enter Contact Number 1 ">
                </div>
              </div>

            </div>

         

            

            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="contact2">Contact Number 2</label>
                  <input  class="form-control" id="contact2" name="contact2" type="username" placeholder="Enter Contact Number 2">
                </div>
              </div>




              <div class="col">
                <div class="form-group">
                  <label for="deal_size">Deal Size</label>
                  <input required class="form-control" id="dual_size"  name="dual_size" type="number" placeholder="Enter Deal Size">
                </div>
              </div>
          </div>
            <div class="row">

      <div class="col">
                <div class="form-group">
                  <label for="closed_won_date">Closed Won Date</label>
                  <input required class="form-control" id="closed_won_date"  name="closed_won_date" type="date" placeholder="Enter Closed Won Date">
                </div>
              </div>

    <div class="col">
                <div class="form-group">
                  <label for="lead_industry">Lead Industry</label>
                  <input required class="form-control" id="lead_industry"  name="lead_industry" type="text" placeholder="Enter Lead Industry">
                </div>
              </div>

          </div>


            <div class="row">
    <div class="col">
                <div class="form-group">
                  <label for="lead_source">Lead Source</label>
                  <input required class="form-control" id="lead_source"  name="lead_source" type="text" placeholder="Enter Lead Source">
                </div>
              </div>


<div class="col">
                <div class="form-group">
                  <label for="market_contact">Marketing Contact</label>
                  <input required class="form-control" id="market_contact"  name="market_contact" type="number" placeholder="Enter Marketing Contact">
                </div>
              </div>

          </div>

            <div class="row">

<div class="col">
                <div class="form-group">
                  <label for="market_email">Marketing Contact Email</label>
                  <input required class="form-control" id="market_email"  name="market_email" type="email" placeholder="Enter Marketing Contact Email">
                </div>
              </div>


<div class="col">
                <div class="form-group">
                  <label for="market_phone">Marketing Contact Phone</label>
                  <input required class="form-control" id="market_phone"  name="market_phone" type="number" placeholder="Enter Marketing Contact Phone">
                </div>
              </div>
                </div>

                  <div class="row">
<div class="col">
                <div class="form-group">
                  <label for="billing_contact">Billing Contact</label>
                  <input required class="form-control" id="billing_contact"  name="billing_contact" type="text" placeholder="Enter Marketing Contact Phone">
                </div>
              </div>



<div class="col">
                <div class="form-group">
                  <label for="billing_address">Billing Address</label>
                  <input required class="form-control" id="billing_address"  name="billing_address" type="text" placeholder="Enter Billing Address">
                </div>
              </div>

                  </div>


                    <div class="row">
<div class="col">
                <div class="form-group">
                  <label for="billing_phone">Billing Phone</label>
                  <input required class="form-control" id="billing_phone"  name="billing_phone" type="text" placeholder="Enter Billing Phone">
                </div>
              </div>



<div class="col">
                <div class="form-group">
                  <label for="billing_email">Billing Email</label>
                  <input required class="form-control" id="billing_email"  name="billing_email" type="text" placeholder="Enter Billing Email">
                </div>
              </div>


                </div>




                  <div class="row">
<div class="col">
                <div class="form-group">
                  <label for="special_notes">Special Notes</label>
                  <input required class="form-control" id="special_notes"  name="special_notes" type="text" placeholder="Enter Special Notes">
                </div>
              </div>


  <div class="col">
                <div class="form-group">
                  <label for="profile_image">Upload Profile Image</label>
                  <input required class="form-control" id="profile_image" name="profile_image" type="file"   accept="image/x-png,image/jpeg">
                </div>
              </div>
    </div>



           


          </div>
          <div class="card-footer">
            <button class="btn btn-pill btn-primary" type="submit">Create Business</button>
         
          </div>
        </form>