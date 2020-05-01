@extends('layouts.secondary')
@section('title', 'Leads | Martechportal')
@section('style')
<!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css/datatables.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css/owlcarousel.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css/prism.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/select2.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/responsive.css')}}">
    <!-- Plugins css Ends-->
    
    <style>
        /* Lead Related CSS */
.lead-card-body > div > div > p{
    font-weight: 800;
    text-transform: uppercase;
    margin-bottom: 12px;
}
.lead-card-body > div > div > h5{
  color: black;  
}

#owl-carousel-14{padding: 0;}
.owl-prev span{font-size:30px!important;}
.owl-next span{font-size:30px!important;}
.owl-nav{margin-bottom: 20px;
    margin-top: 0!important;
    text-align: right!important;}
.discovery-call{
    background: #FF4136!important;
}
.create-proposal{
    background: #001F3F!important;
}
.proposan-send{
    background: #0074D9!important;
}
.awaiting{
        background: #FF851B!important;
}
.closed-won{
        background: #39CCCC!important;
}
.fresh-lead{
        background: #22af47 !important;
}
.closed-lost{
        background: #85144b !important;
}
.overall{background: #aaa!important;}
.ecommerce-icons div span{color:#fff;}
.white{color: #fff!important;}
.freshleads{background: #22af47 !important;}
.discoverycalls{background: #FF4136!important;}
.createproposals{background: #001F3F!important}
.proposalsend{background: #0074D9!important}
.awaitingsignature{background: #FF851B!important}
.closedwon{background: #39CCCC!important}
.closedlost{background: #85144b!important}
/* End Lead related CSS */
    </style>
@endsection

@section('breadcrumb-title', 'Leads')
  @section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{route('leads.index')}}">Leads</a></li>    
    <li class="breadcrumb-item active">{{$leadcat->Categori_name}}</li>    
  @endsection

@section('model-button')
<button class=" btn btn-pill btn-primary text-light" type="button" data-toggle="modal" data-target="#addLeadModal" data-whatever="@getbootstrap" 
id="addBusinessId" name="addBusinessId" 
>Add Lead</button>
@endsection
@section('content')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <!--///////////////////EDIT STACK MODAL////////////////
        -->
        <div class="modal fade" id="addLeadModal" tabindex="-1" role="document"
             aria-labelledby="addLeadModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="business">Add Lead</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                    </div>


                    <form action="{{ route('leads.store') }}" method="POST" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="modal-body">

                            <div class="card-body">

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                          <label for="cname">Company Name*</label>
                                          <input required class="form-control" id="cname" name="cname" type="text"
                                            placeholder="Enter Company Name">
                                        </div>
                                      </div>
                                      <div class="col">
                                        <div class="form-group">
                                          <label for="contact_person">Name Of Contact Person*</label>
                                          <input required class="form-control" id="contact_person" name="contact_person" type="text"
                                            placeholder="Name of Contact Person">
                                        </div>
                                      </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="contact1">Contact person’s position</label>
                                            <input required class="form-control" id="contact1" name="contact_person_position" type="text"
                                                   placeholder="Contact person’s position">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="contact2">Email</label>
                                            <input required  class="form-control" id="contact2" name="email"
                                                   type="email" placeholder="email">
                                        </div>
                                    </div>


                                    <div class="col">
                                        <div class="form-group">
                                            <label for="deal_size">Phone</label>
                                            <input   class="form-control" id="dual_size" name="phone"
                                                   type="number" placeholder="phone">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="closed_won_date">Full Address</label>
                                            <input required class="form-control" id="closed_won_date"
                                                   name="full_address" type="text" placeholder="Full Address">
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="deal_size">Deal Size ($)</label>
                                            <input   class="form-control" id="deal_size" name="deal_size"
                                                   type="number" placeholder="Deal Size">
                                        </div>
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="close_won_date">Closed Won Date </label>
                                            <input   class="form-control" id="close_won_date" name="close_won_date"
                                                   type="date" value="{{date('d/m/Y')}}" placeholder="Closed Won Date ">
                                        </div>
                                    </div>


                                    <div class="col">
                                        <div class="form-group">
                                            <label for="lead_industry">Lead Industry</label>
                                            <input   class="form-control" id="lead_industry"
                                                   name="lead_industry" type="text" placeholder="Lead Industry">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="lead_source">Lead Source</label>
                                            <input   class="form-control" id="lead_source" name="lead_source"
                                                   type="text" placeholder="Lead Source">
                                        </div>
                                    </div>


                                    <div class="col">
                                        <div class="form-group">
                                            <label for="market_contact">Marketing Contact contact</label>
                                            <input   class="form-control" id="market_contact" name="market_contact"
                                                   type="text" placeholder="Marketing Contact contact">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="marketing_phone">Marketing Contact phone</label>
                                            <input   class="form-control" id="marketing_phone"
                                                   name="marketing_phone" type="number"
                                                   placeholder="Marketing Contact phone">
                                        </div>
                                    </div>


                                    <div class="col">
                                        <div class="form-group">
                                            <label for="marketing_email">Marketing Contact Email</label>
                                            <input   class="form-control" id="marketing_email"
                                                   name="marketing_email" type="email"
                                                   placeholder="Marketing Contact email">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="billing_contact">Billing Contact</label>
                                            <input   class="form-control" id="billing_contact" name="billing_contact"
                                                   type="text" placeholder="Billing contact">
                                        </div>
                                    </div>


                                    <div class="col">
                                        <div class="form-group">
                                            <label for="billing_address">Billing Address</label>
                                            <input   class="form-control" id="billing_address" name="billing_address"
                                                   type="text" placeholder="Billing address">
                                        </div>
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="billing_phone">Billing Phone</label>
                                            <input   class="form-control" id="billing_phone" name="billing_phone"
                                                   type="text" placeholder="Billing Phone">
                                        </div>
                                    </div>


                                    <div class="col">
                                        <div class="form-group">
                                            <label for="billing_email">Billing Email</label>
                                            <input   class="form-control" id="billing_email" name="billing_email"
                                                   type="text" placeholder="Billing Email">
                                        </div>
                                    </div>


                                </div>


                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="special_notes">Lead Status</label>
                                            <select name="lead_status" id="" class="form-control">
                                                @foreach( \App\LedCategories::where('status',1)->get() as $key=> $categori)
                                                <option value="{{$categori->id}}">{{$categori->categori_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                            </div>


                        </div>
                    </div>


                        <div class="modal-footer">
                            <button class="btn btn-pill btn-secondary" type="button" data-dismiss="modal">Close</button>
                           
                            <button class="btn btn-pill btn-primary" type="submit">Create Lead</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>


        <!--//////////////EDIT STACK MODAL END/////////////////// -->


        <div class="container-fluid box">
            
             <div class="owl-carousel owl-theme" id="owl-carousel-14">
                    <div class="item">
                      <div  class="card overall"><a href="{{URL::to('/leads')}}">
                        <div class="card-body">
                          <div><span class="white">Overall</span></div>
                          <h4 class="  mb-0 counter white">{{\App\Lead::count()}}</h4>
                        </div></a>
                      </div>
                    </div>
                    <!--  -->
                    <div class="item"> <a href="{{URL::to('/leads-categori/1')}}">
                      <div class="card freshleads">
                        <div class="card-body">
                          <div><span class="white">Fresh Leads</span></div>
                          <h4 class="  mb-0 counter white">{{\App\Lead::where('lead_status',1)->count()}}</h4>
                        </div>
                      </div></a>
                    </div>
                    <div class="item"> <a href="{{URL::to('/leads-categori/2')}}">
                      <div class="card discoverycalls ">
                        <div class="card-body">
                          <div><span class="white">Discovery Call</span></div>
                          <h4 class="  mb-0 counter white">{{\App\Lead::where('lead_status',2)->count()}}</h4>
                        </div>
                      </div></a>
                    </div>
                     <div class="item"> <a href="{{URL::to('/leads-categori/3')}}">
                      <div class="card createproposals">
                        <div class="card-body" >
                          <div><span class="white">Create Proposal</span></div>
                          <h4 class="  mb-0 counter white">{{\App\Lead::where('lead_status',3)->count()}}</h4>
                        </div>
                      </div></a>
                    </div>
                    <div class="item"> <a href="{{URL::to('/leads-categori/4')}}">
                      <div class="card proposalsend">
                        <div class="card-body ">
                          <div><span class="white">Proposal Sent & Presented</span></div>
                          <h4 class=" white  mb-0 counter">{{\App\Lead::where('lead_status',4)->count()}}</h4>
                        </div>
                      </div></a>
                    </div>
                    <div class="item"> <a href="{{URL::to('/leads-categori/5')}}">
                      <div class="card awaitingsignature">
                        <div class="card-body ">
                          <div><span class="white">Awaiting Signature</span></div>
                          <h4 class="  mb-0 counter white">{{\App\Lead::where('lead_status',5)->count()}}</h4>
                        </div>
                      </div></a>
                    </div>
                     <div class="item"> <a href="{{URL::to('/leads-categori/6')}}">
                      <div class="card closedwon">
                        <div class="card-body">
                          <div><span class="white">Closed – WON</span></div>
                          <h4 class="  mb-0 counter white">{{\App\Lead::where('lead_status',6)->count()}}</h4>
                        </div>
                      </div></a>
                    </div>
                    <div class="item"> <a href="{{URL::to('/leads-categori/7')}}">
                      <div class="card closedlost">
                        <div class="card-body ">
                          <div><span class="white">Closed - LOST</span></div>
                          <h4 class="white mb-0 counter">{{\App\Lead::where('lead_status',7)->count()}}</h4>
                        </div>
                      </div></a>
                    </div>
                  </div>
               

<div class="col-sm-12" id="leadtableform" style="display: none;">
  <div class="col-sm-12 mb-3 text-right"><button class="btn btn-warning" id="switchcard">Switch to cards</button></div>
                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="leadstable">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Start Date</th>
                            <th>Status</th>
                            <th>Assigned To</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                         
            @if(count($leadselect)>0)
            @foreach( $leadselect as $key=>$lead)
                          <tr>
                            <td>{{$lead->cname}}</td>
                            <td>{{ \Carbon\Carbon::parse($lead->created_at)->format('M d, Y')}}</td>
                            <td>{{ \App\LedCategories::where('id',$lead->lead_status)->pluck('categori_name')->first()}}</td>
                            <td> @if ($lead->assigned_to) {{ \App\User::where('id', $lead->assigned_to)->pluck('name')->first() }}  @else Not assigned @endif</td>
                            <td><a href="{{URL::to('/view-lead').'/'.$lead->id}}"><i class="fa fa-eye"></i></a></td>
                          </tr>
                          @endforeach
                          @else
                          <tr>
                                            <td colspan="5" class="text-center">No data found!</td>
                                        </tr>
                                        @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>


            <div class="panel panel-default"  id="leadcardform">
               <div class="col-md-12 mb-5" style="padding: 15px 0px;background: aliceblue;border:3px solid #000;border-radius: 4px">
                    <div class="col-md-6" style="float: left;margin: 5px 0 5px">
                 <select  class="form-control js-example-basic-single" name="searchlead" id="searchlead" style="width: 100%">
                  
                                            <option value="" disabled selected>Search</option>
                    @foreach( $leadselect as $key=>$lead)
                    <option value="{{$lead->cname}}">{{$lead->cname}}</option>
                    @endforeach
                 </select>
             </div>
             <div class="col-md-3" style="float: left;margin: 5px 0 5px"><a href="javascript:void(0)" class="btn btn-success"
            id="reset" style="width: 100%">Reset</a></div>
            <div class="col-md-3" style="float: left;margin: 5px 0 5px"><a href="javascript:void(0)" class="btn btn-warning"
            id="switchtable" style="width: 100%">Switch to table</a></div>
        <div style="clear: both;"></div>
              <div style="clear: both;"></div>
             </div>
             <div style="clear: both;"></div>
                <div class="panel-heading"></div>
                <div class="panel-body" id="leadlist">


                    <div class="col-sm-12">
                      @foreach( $leads as $key=>$lead)
                                            <a href="{{URL::to('/view-lead').'/'.$lead->id}}">
              <div class="col-sm-12 col-xl-4" style="float: left;">
                <div class="card card-absolute">
                  <div class="card-header {{ \App\LedCategories::where('id',$lead->lead_status)->pluck('led_class')->first()}}">
                    <h5 class="text-white">{{$lead->cname}}</h5>
                  </div>
                  <div class="card-body lead-card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <p>Start Date :</p> <h5 style="font-size: 18px;">{{ \Carbon\Carbon::parse($lead->created_at)->format('M d, Y')}}</h5>                        
                      </div>
                      <div class="col-md-6">
                       @if ($lead->assigned_to)                        
                    <p>Assigned To :</p>
                    <h5 style="font-size: 18px;">{{ \App\User::where('id', $lead->assigned_to)->pluck('name')->first() }}</h5>
                    @endif
                      </div>
                      <div class="col-md-12">
                        <p>Status :</p> <h5 style="font-size: 18px;">{{ \App\LedCategories::where('id',$lead->lead_status)->pluck('categori_name')->first()}}</h5>
                      </div>
                    </div>
                  </div>
                </div>
              </div></a>
              @endforeach
                    </div>
                      <div style="width: 100%;
    display: flex;
    justify-content: flex-end;">
{{ $leads->links() }}

</div>
                </div>


            </div>
        </div>
    </div>


    <!-- Container-fluid Ends-->
@endsection
@section('script')
<script src="{{asset('assets')}}/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets')}}/js/datatable/datatables/datatable.custom.js"></script>
    
    <script src="{{asset('assets')}}/js/owlcarousel/owl.carousel.js"></script>
    <script src="{{asset('assets')}}/js/dashboard/dashboard-ecommerce/chart.custom.js"></script>
    <script src="{{asset('assets')}}/js/dashboard/dashboard-ecommerce/morris-script.js"></script>
    <script src="{{asset('assets')}}/js/dashboard/dashboard-ecommerce/owl-carousel.js"></script>
      <script type="text/javascript">
        $('.owl-carousel').find('.owl-nav').removeClass('disabled');
$('.owl-carousel').on('changed.owl.carousel', function(event) {
    $(this).find('.owl-nav').removeClass('disabled');
});



$('.owl-carousel').find('.owl-dots').removeClass('disabled');
$('.owl-carousel').on('changed.owl.carousel', function(event) {
    $(this).find('.owl-dots').removeClass('disabled');
});


$(document).ready(function() {
  $("#searchlead").on("change", function() {
    var value = $(this).val();
    
$.ajax({

                    url: "{{ route('fetchlead') }}",

                    type: "GET",

                    data: {
                        'cname': value
                    },

                    success: function(data) {

                        console.log(data);
                        $('#leadlist').html(data);
                    }
                })


  });
});


$(document).ready(function() {
            $('#leadstable').DataTable();
        } );


$('#reset').click(function(){
location.reload();
});


$('#switchtable').click(function(){
  $('#leadtableform').show();
  $('#leadcardform').hide();
});
$('#switchcard').click(function(){
  $('#leadtableform').hide();
  $('#leadcardform').show();
});
    </script>
    <script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/select2/select2-custom.js')}}"></script>
@endsection
