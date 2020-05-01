@extends('layouts.master')
@section('title', 'Projects | Martechportal')
@section('style')
   <style>
    div.bg-lncg-ellipse{
    background-image: url("{{asset('assets/images/project/bg-round.png')}}");
    background-size: cover;
    }   
    .icon-timeline{
      color: white;
    }
    </style>
@endsection

@section('breadcrumb-title', 'Project')
@section('breadcrumb-items')
<li class="breadcrumb-item">Project</li>
<li class="breadcrumb-item active">Project Timeline</li>
@endsection
  
@section('content')


<!-- Container-fluid starts-->
<div class="container-fluid">
  <div class="row">
    <div class="col-xl-4 xl-50 set-col-6">
      <div class="card">
        <div class="card-header">
          <h5>Phase 1 - Niche</h5>
        </div>
        <div class="card-body">
          <div class="timeline-small">
            <div class="media">
              <div class="timeline-round m-r-30 timeline-line-1 bg-lncg-ellipse"><i data-feather="phone-call"></i></div>
              <div class="media-body">
                <h6>Call With LNCG <span class="pull-right f-14">Step 1</span></h6>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum has been the industry.</p>
              </div>
            </div>
            <div class="media">
              <div class="timeline-round m-r-30 timeline-line-1 bg-lncg-ellipse"><i data-feather="edit-3" style="color: white;"></i></div>
              <div class="media-body">
                <h6>Fill up the niche form <span class="pull-right f-14">Step 2</span></h6>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum has been the industry.</p>
              </div>
            </div>
            <div class="media">
              <div class="timeline-round m-r-30 small-line bg-success"><i data-feather="check"></i></div>
              <div class="media-body">
                <h6>Verify and finalise the Niche by LNCG <span class="pull-right f-14">Step 3</span></h6>
                <p>Lorem Ipsum is simply dummy text.</p>
              </div>
            </div>  
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 xl-50 set-col-6">
      <div class="card">
        <div class="card-header">
          <h5>Phase 2 - Branding</h5>
        </div>
        <div class="card-body">
          <div class="timeline-small">
            <div class="media">
              <div class="timeline-round m-r-30 timeline-line-1 bg-lncg-ellipse"><i data-feather="phone-call"></i></div>
              <div class="media-body">
                <h6>Call With LNCG <span class="pull-right f-14">Step 1</span></h6>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum has been the industry.</p>
              </div>
            </div>
            <div class="media">
              <div class="timeline-round m-r-30 timeline-line-1 bg-lncg-ellipse"><i data-feather="edit-3" style="color: white;"></i></div>
              <div class="media-body">
                <h6>Fill up the logo form <span class="pull-right f-14">Step 2</span></h6>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum has been the industry.</p>
              </div>
            </div>
            <div class="media">
              <div class="timeline-round m-r-30 small-line bg-success"><i data-feather="check"></i></div>
              <div class="media-body">
                <h6>Verify and finalise with LNCG <span class="pull-right f-14">Step 3</span></h6>
                <p>Lorem Ipsum is simply dummy text.</p>
              </div>
            </div>  
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 xl-50 set-col-6">
      <div class="card">
        <div class="card-header">
          <h5>Phase 3 - Getting Website Ready</h5>
        </div>
        <div class="card-body">
          <div class="timeline-small">
            <div class="media">
              <div class="timeline-round m-r-30 timeline-line-1 bg-lncg-ellipse"><i data-feather="phone-call"></i></div>
              <div class="media-body">
                <h6>Call With LNCG <span class="pull-right f-14">Step 1</span></h6>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum has been the industry.</p>
              </div>
            </div>
            <div class="media">
              <div class="timeline-round m-r-30 timeline-line-1 bg-lncg-ellipse"><i data-feather="edit-3" class="icon-timeline"></i></div>
              <div class="media-body">
                <h6>Fill up the website form <span class="pull-right f-14">Step 2</span></h6>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum has been the industry.</p>
              </div>
            </div>
            <div class="media">
              <div class="timeline-round m-r-30 timeline-line-1 bg-lncg-ellipse"><i data-feather="monitor" class="icon-timeline"></i></div>
              <div class="media-body">
                <h6>Get the website done <span class="pull-right f-14">Step 3</span></h6>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum has been the industry.</p>
              </div>
            </div>
            <div class="media">
              <div class="timeline-round m-r-30 timeline-line-1 bg-lncg-ellipse"><i data-feather="edit-3" class="icon-timeline"></i></div>
              <div class="media-body">
                <h6>Go through revisions <span class="pull-right f-14">Step 4</span></h6>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum has been the industry.</p>
              </div>
            </div>
            <div class="media">
              <div class="timeline-round m-r-30 small-line bg-success"><i data-feather="check"></i></div>
              <div class="media-body">
                <h6>Verify and finalise the website <span class="pull-right f-14">Step 5</span></h6>
                <p>Lorem Ipsum is simply dummy text.</p>
              </div>
            </div>  
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 xl-50 set-col-6">
      <div class="card">
        <div class="card-header">
          <h5>Phase 4 - Getting business ready for social media</h5>
        </div>
        <div class="card-body">
          <div class="timeline-small">
            <div class="media">
              <div class="timeline-round m-r-30 timeline-line-1 bg-lncg-ellipse"><i data-feather="phone-call"></i></div>
              <div class="media-body">
                <h6>Call With LNCG <span class="pull-right f-14">Step 1</span></h6>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum has been the industry.</p>
              </div>
            </div>
            <div class="media">
              <div class="timeline-round m-r-30 timeline-line-1 bg-lncg-ellipse"><i data-feather="edit-3" class="icon-timeline"></i></div>
              <div class="media-body">
                <h6>Fill up the social media form <span class="pull-right f-14">Step 2</span></h6>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum has been the industry.</p>
              </div>
            </div>
            <div class="media">
              <div class="timeline-round m-r-30 timeline-line-1 bg-lncg-ellipse"><i data-feather="facebook" class="icon-timeline"></i> </div>
              <div class="media-body">
                <h6>Work on Facebook <span class="pull-right f-14">Step 3</span></h6>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum has been the industry.</p>
              </div>
            </div>
            <div class="media">
              <div class="timeline-round m-r-30 timeline-line-1 bg-lncg-ellipse"><i data-feather="linkedin" class="icon-timeline"></i> </div>
              <div class="media-body">
                <h6>Work on LinkedIn <span class="pull-right f-14">Step 4</span></h6>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum has been the industry.</p>
              </div>
            </div>
            <div class="media">
              <div class="timeline-round m-r-30 timeline-line-1 bg-lncg-ellipse"><i data-feather="message-circle" class="icon-timeline"></i> </div>
              <div class="media-body">
                <h6>Other social networks <span class="pull-right f-14">Step 5</span></h6>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum has been the industry.</p>
              </div>
            </div>
            <div class="media">
              <div class="timeline-round m-r-30 small-line bg-success"><i data-feather="check"></i></div>
              <div class="media-body">
                <h6>Verify and finalise the social media profiles <span class="pull-right f-14">Step 6</span></h6>
                <p>Lorem Ipsum is simply dummy text.</p>
              </div>
            </div>  
          </div>
        </div>
      </div>
    </div>    
  </div>
</div>
<!-- Container-fluid ends -->
@endsection
@section('script')

@endsection