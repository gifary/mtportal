<?php
/**
 * Created by gifary
 * Email gifary.upwork@gmail.com
 * Copyright (c) 2020.
 */

namespace App\Http\Controllers;


use App\Lead;
use App\LeadAttachment;
use App\LeadComment;
use App\LedCategories;
use App\LeadAttachmentComment;
use App\Notifications\LeadAssigned;
use App\Notifications\LeadReminder;
use App\User;
use App\MartechTool;
use App\Zone;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function index()
    {
        $this->authorize('View Leads');

        return view('leads.index');
    }

    public function view_leads($id)
    {     
  $lead= Lead::where('id',$id)->first();
        $leadcomments = LeadComment::where('lead_id',$id)->get();
$martechtools = MartechTool::where('lead_id',$id)->get();
        return view('leads.view_leads',compact('leadcomments','martechtools'))->with('lead', $lead);
    }


    public function leads_categori($id)
    {
        $leadselect= Lead::where('lead_status',$id)->get();
        $leads= Lead::where('lead_status',$id)->paginate(10);
        $leadcat= LedCategories::where('id',$id)->get('Categori_name')->first();
        return view('leads.leads_categori',compact('leads','leadselect','leadcat'));
    }


    public function lead_delete($id)
    {
        $this->authorize('Delete Leads');

        session::flash('message', '<p style="color: red; font-size:18px;" class="text-center pt-10 pb-10" >Lead Deleted Successfully</p>');
        Lead::where('id',$id)->delete();
        return Redirect::to('/leads');
    }


    public function store(Request $request) {

        $request->validate([
            'email' => 'required|email|unique:leads',
            'cname' => 'required|string',
            'contact_person' => 'required|string',
            'contact_person_position' => 'required|string',
            'full_address' => 'required|string',
        ]);

        $success = Lead::create($request->all());
        if ($success != null) {
            Session::flash('message', '<p style="color: green; font-size:18px;" class="text-center pt-10 pb-10" >Lead Added Successfully</p>');
            return Redirect::back();
        } else {
            Session::flash('message', '<p style="color: red; font-size:18px;" class="text-center pt-10 pb-10" >Something Were Missing</p>');
            return Redirect::back();
        }
    }


///////////////////////////////////leads controller///////////////////////////////////////////////////////////////////


    public function delete_lead_attachment(Request $request)
    {
        $attachmentid = $request->id;

        $attachment = LeadAttachment::findOrFail($attachmentid);
        $attachment->delete();

        $attachmentComments = LeadAttachmentComment::where('lead_attachment_id',$attachmentid)->delete();
        

        return Redirect::back();
    }

    public function deleteleadcomment(Request $request)
    {
        $commentid = $request->commentid;

        $comment = LeadComment::findOrFail($commentid);
        $comment->delete();

        return Redirect::back();
    }


    public function editleadcomment(Request $request)
    {
        $commentid = $request->commentid;

        $comment = LeadComment::findOrFail($commentid);
        $comment->comment = $request->comment;
        $comment->save();
        return Redirect::back();
    }


    public function addleadattachmentcomment(Request $request)
    {
       $user_id = $request->get('user_id');
       $lead_id = $request->get('lead_id');
       $lead_attachment_comment = $request->get('comment');
       $lead_attachment_id = $request->get('lead_attachment_id');


       $leadattachmentcomment = new LeadAttachmentComment;
       $leadattachmentcomment->user_id = $user_id;
$leadattachmentcomment->lead_attachment_id = $lead_attachment_id;
$leadattachmentcomment->lead_id = $lead_id;
$leadattachmentcomment->comment = $lead_attachment_comment;
$leadattachmentcomment->save();


 $returnleadattcomment = LeadAttachmentComment::where('lead_id',$lead_id)->where('lead_attachment_id',$lead_attachment_id)->get();
        $lg_user = User::where('id', $user_id)->first();
        
        
        $array="";

        foreach ($returnleadattcomment as $value) {

            $user = User::where('id',$value->user_id)->first();
            $username = $user->name;
            $timezone = Zone::where('zone_id', $lg_user->zone_name)->pluck('zone_name')->first();
            $updatedAt = $value->updated_at;  
            $dt  = Carbon::parse($updatedAt);         
            $tz = new \DateTimeZone($timezone); 
           $dt->setTimezone($tz);
                                                                        
                                                                   

            // $array.="<p>Pic: ".$user->profile_pic."</p><p>UserName: ".$username."</p><p>Updated Date: ".$finalDt."</p><p>Comment: ".$value->comment."</p><p>Comment ID: ".$value->id."</p><p>TZ: ".$timezone;
            
            if($value->user_id == $lg_user->id){
                
                $array.="<div class='message my-message' style='width: 100%; border: 1px solid #e8e8e8; border-radius: 10px;'>
                <img class='rounded-circle float-left chat-user-img img-30' src='".url($user->profile_pic)."' alt='".$username."'><div class='message-data text-right'><span class='message-data-time'>".$dt->setTimezone($tz).",".$username."</span>
                </div>
                <p class='text-left'>".$value->comment."</p>
                <form method='POST' action='".url('updateleadattachmentcomment')."' id='updateleadattcommentdiv_".$value->id."' style='display: none;'>".csrf_field()."
                    <div class='col-8' style='float: left;''>
<input type='hidden' name='attachmentcommentid' value=".$value->id." class='form-control'>
                                                                                        <input type='text' name='attachmentcomment' class='form-control' required>
                                                                                    </div>
                                                                                    <div class='col-md-2'  style='float: left;'>
                                                                                        <button class='btn btn-success' type='submit'>Update</button>
                                                                                        </div>
                                                                                        <div class='col-md-2'  style='float: left;'>
                                                                                        <a class='btn btn-danger' href='javascript:void(0)' id='cancelleadattcommentupdate_".$value->id."'>Cancel</a>
                                                                                        </div>
                                                                                        <div class='clearfix'></div>
                                                                                    </form>
                <div class='row float-right' style='background-color: #efefef; border-radius: 5px;'>
                    <div class='col-xs-6' style='border-right: 1px solid #dedede;'>                                                                              
                      <a href='javascript:void(0)' class='btn  btn-xs form-inline leadattcommentupdate' id='leadattachmentcommentupdate_".$leadattachmentcomment->id."'><i class='icon-pencil'></i></a>
                    </div>
                    <div class='col-xs-6'>                                                                              
                        <form method='POST' action='".url('deleteleadattachmentcomment')."'>
                           ".csrf_field()."
                            <input type='hidden' name='attachmentcommentid' value=".$value->id.">
                            <button class='btn btn-xs form-inline' type='submit'><i class='icon-trash'></i></button>
                        </form>
                    </div></div>
            </div>";
            }
            else{

          $array.=   "<div class='message other-message pull-right' style='width: 100%;'>
                    <img class='rounded-circle float-right chat-user-img img-30' src='".url($user->profile_pic)."' alt='".$username."' style='position: absolute;z-index: 9;right: 20px;'>
                                    <div class='message-data'>
                                <span class='message-data-time'>".$dt->setTimezone($tz).", ".$username."</span</div>
                                                                            <p style='color:#000' class='text-left'>".$value->comment."</p>                              </div>
                                                                            </div>
                                                                        <div class='clearfix'></div>";
            }

        }
        return $array;

    }

public function deleteleadattachmentcomment(Request $request){
     $attachmentcommentid = $request->attachmentcommentid;

        $comment = LeadAttachmentComment::findOrFail($attachmentcommentid);
        $comment->delete();

        return Redirect::back();
}

public function updateleadattachmentcomment(Request $request){
    $attachmentcommentid = $request->attachmentcommentid;
    $attachmentcomment = $request->attachmentcomment;
    if ($attachmentcomment != null) {
       $comment = LeadAttachmentComment::findOrFail($attachmentcommentid);
       $comment->comment = $attachmentcomment;
       $comment->save();
       return Redirect::back();
    }
    return Redirect::back();
}

    public function update(Request $request) {

        $request->validate([
            'id' => 'required|integer',
            'cname' => 'required|string',
        ]);

        $success = Lead::where('id', $request->id)->update($request->except('sendertime'));
        if ($success != null) {
            session::flash('message', '<p style="color: green; font-size:18px;" class="text-center pt-10 pb-10" >Lead Updated Successfully</p>');
            if ($request->assigned_to != null) {
                $assigned_to_id = $request->assigned_to;
                $user= User::where('id',$assigned_to_id)->first();
                $sender = Auth::user()->name;
                $action = 'view-lead/'.$request->id;
                $sendertime = $request->sendertime;
                Notification::send($user, new LeadAssigned($sender,$action,$sendertime));
            }
            return Redirect::back();
        } else {
            session::flash('message', '<p style="color: red; font-size:18px;" class="text-center pt-10 pb-10" >Something Were Missing</p>');
            return Redirect::back();
        }
    }


    public function fetchlead(Request $request)
    {

        /** Author Shubham Rawat(rwtshubhu5569@gmail.com) **/
        $leadname =   $request->get('cname');
        $data  = Lead::where('cname', 'LIKE', $leadname . '%')->first();
        $status      = \App\LedCategories::where('id',$data->lead_status)->pluck('led_class')->first();
        $date    = \Carbon\Carbon::parse($data->created_at)->format('M d, Y');
        $category    = \App\LedCategories::where('id',$data->lead_status)->pluck('categori_name')->first();
        $path = url('/view-lead');
        $assigned = \App\User::where('id', $data->assigned_to)->pluck('name')->first();

        $leadcard = '<a href="'.$path.'/'.$data->id.'"><div class="col-sm-12 col-xl-4" style="float: left;">
 <div class="card card-absolute">
   <div
     class="card-header '.$status.'">
     <h5 class="text-white">'.$data->cname.'</h5>
   </div>
   <div class="card-body lead-card-body">
     <div class="row">
       <div class="col-md-6">
         <p>Start Date :</p>
         <h5>'.$date.'</h5>
       </div>
       <div class="col-md-6">
         <p>Assigned To :</p>
         <h5>'.$assigned.'</h5>
       </div>
       <div class="col-md-12">
         <p>Status :</p>
         <h5>'.$category.'</h5>
       </div>
     </div>
   </div>
 </div>
</div></a>';






        return $leadcard;


    }




    public function leadreminder(Request $request)
    {
        if ($request->get('id') != null && $request->get('remindercomment') != null && $request->get('remindertime') != null) {
            $hour1 = 0; $hour2 = 0;
            $date1 =  $request->get('remindertime');
             $loggedinUser = Auth::user()->id;
                                                                    $loggedinUserZone = Auth::user()->zone_name;

                                                                   $timezone = \App\Zone::where('zone_id', $loggedinUserZone)->pluck('zone_name')->first();                                                        
                                                                  $updatedAt = date("Y-m-d\TH:i");      
                                                                   $dt = new DateTime($updatedAt);
$tz = new DateTimeZone($timezone); 

$dt->setTimezone($tz);

$currenttime = $dt->format('Y-m-d\TH:i');



            $datetimeObj1 = new DateTime($date1);
            $datetimeObj2 = new DateTime($currenttime);

            if ($datetimeObj1 >= $datetimeObj2) {
                $interval = $datetimeObj1->diff($datetimeObj2);

                $hours   = $interval->format('%h'); 
$minutes = $interval->format('%i');

$delay   = $hours * 60 + $minutes;
$when = now()->addMinutes($delay);
              
$ids = $request->get('id');





                    $comment = $request->get('remindercomment');
                   $leadid = $request->get('leadid');

                   $action = "/view-lead/".$leadid;

                   foreach ($ids as $id) {

$usersend = User::where('id',$id)->first();


                       $usersend->notify((new LeadReminder([
                     'comment' => $comment,
                     'action' => $action,
                     'leadid' =>$leadid

                   ]))->delay($when));


                   }
                   
                   
                return 1;
            }

            else{
                return "low";
            }


        }
        return 0;
    }


    public function lead_attachment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'attachment' => 'required'
        ]);

        if ($validator->fails()) {
            session::flash('message', '<p style="color: red; font-size:18px;" class="text-center pt-10 pb-10" >Something Were Missing</p>');
            return Redirect::back();
        }

        $images = $request->file('attachment');
        $lead_id = $request->lead_id;
        
        //dd(Str::random(6)); exit;

        foreach ($images as $key => $image) {
            $image_name = Str::random(16);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_fullname = $image_name . '.' . $ext;
            $upload_path = storage_path()."/lead/";
            $image_url = "/storage/lead/" . $image_fullname;
            $success = $image->move($upload_path, $image_fullname);
            $attachment = array();
            
            $attachment['attachment'] = $image_url;
            $attachment['lead_id'] = $lead_id;
            $attachment['attachment_title'] = $image->getClientOriginalName();
            LeadAttachment::create($attachment);
        }
        session::flash('message', '<p style="color: green; font-size:18px;" class="text-center pt-10 pb-10" >Lead Attachment Added Successfully</p>');
        return Redirect::back();

    }


    public function addleadcomment(Request $request){

        $comment = $request->get('leadcomment');
        $user_id = $request->get('leaduser_id');
        $lead_id = $request->get('leadcomment_id');
        $loggedin_uid = $request->get('lcuser_id');

        $leadcomment = new LeadComment;
        $leadcomment->lead_id = $lead_id;
        $leadcomment->user_id = $user_id;
        $leadcomment->comment = $comment;
        $leadcomment->save();

        $returnleadcomment = LeadComment::where('lead_id',$lead_id)->get();
        $lg_user = User::where('id', $loggedin_uid)->first();
        
        
        $array="";

        foreach ($returnleadcomment as $value) {

            $user = User::where('id',$value->user_id)->first();
            $username = $user->name;
            $timezone = Zone::where('zone_id', $lg_user->zone_name)->pluck('zone_name')->first();
            $updatedAt = $value->updated_at;  
            $dt  = Carbon::parse($updatedAt);         
            $tz = new \DateTimeZone($timezone); 
           $dt->setTimezone($tz);
                                                                        
                                                                   

            // $array.="<p>Pic: ".$user->profile_pic."</p><p>UserName: ".$username."</p><p>Updated Date: ".$finalDt."</p><p>Comment: ".$value->comment."</p><p>Comment ID: ".$value->id."</p><p>TZ: ".$timezone;
            
            if($value->user_id == $loggedin_uid){
                
                $array.="<div class='message my-message' style='width: 100%; border: 1px solid #e8e8e8; border-radius: 10px;'>
                <img class='rounded-circle float-left chat-user-img img-30' src='".url($user->profile_pic)."' alt='".$username."'><div class='message-data text-right'><span class='message-data-time'>".$dt->setTimezone($tz).",".$username."</span>
                </div>
                <p>".$value->comment."</p>
                <div class='row float-right' style='background-color: #efefef; border-radius: 5px;'>
                    <div class='col-xs-6' style='border-right: 1px solid #dedede;'>                                                                              
                        <a href='javascript:void(0)' class='btn  btn-xs form-inline' data-toggle='modal'
                            data-target='#editLeadcomment_'".$value->id."
                            data-whatever='@getbootstrap'><i class='icon-pencil'></i></a>
                    </div>
                    <div class='col-xs-6'>                                                                              
                        <form method='POST' action='".url('deleteleadcomment')."'>
                           ".csrf_field()."
                            <input type='hidden' name='commentid' value=".$value->id.">
                            <button class='btn btn-xs form-inline' type='submit'><i class='icon-trash'></i></button>
                        </form>
                    </div></div>
            </div><div class='modal fade' id='editLeadcomment_'".$value->id."' role='document' aria-labelledby='editLeadcomment'
                                                                    aria-hidden='true'>
                                                                    <div class='modal-dialog modal-lg' role='document'>
                                                                        <div class='modal-content'>
                                                                            <div class='modal-header'>
                                                                                <h5 class='modal-title' id='business'>Edit Lead Comment
                                                                                </h5>
                                                                                <button class='close' type='button' data-dismiss='modal'
                                                                                    aria-label='Close'><span
                                                                                        aria-hidden='true'>×</span></button>
                                                                            </div><div class='modal-body'><form action='".url('editleadcomment')."' method='POST'>
                                                                                ".csrf_field()."
                                                                                <div class='row'>
                                                                                    <div class='col'>
                                                                                        <div class='form-group'>
                                                                                            <input type='hidden' name='commentid'
                                                                                                value='".$leadcomment->id."'>
                                                                                            <label for='special_notes'>Edit Lead
                                                                                                Comment</label>
                                                                                            <textarea name='comment'
                                                                                                class='form-control'></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class='modal-footer' style='padding-bottom:0'>
                                                                                    <button class='btn btn-pill btn-secondary'
                                                                                        type='button'
                                                                                        data-dismiss='modal'>Close</button>
                
                                                                                    <button class='btn btn-pill btn-primary'
                                                                                        type='submit' id='updatelead'>Update
                                                                                        Comment</button>
                                                                                </div>
                
                                                                            </form>
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                </div>";
            }
            else{

          $array.=   "<div class='message other-message pull-right' style='width: 100%;'>
                    <img class='rounded-circle float-right chat-user-img img-30' src='".url($user->profile_pic)."' alt='".$username."' style='position: absolute;z-index: 9;right: 20px;'>
                                    <div class='message-data'>
                                <span class='message-data-time'>".$dt->setTimezone($tz).", ".$username."</span</div>
                                                                            <p style='color:#000'>".$value->comment."</p>                              </div>
                                                                            </div>
                                                                        <div class='clearfix'></div>";
            }

        }
        return $array;


    }



    public function addmartechtool(Request $request){
if ($request->get('purpose') != null || $request->get('name') != null) {
 $leadid =   $request->get('lead_id');
 $purpose =   $request->get('purpose');
 $name =   $request->get('name');

$tool = new MartechTool;
$tool->lead_id = $leadid;
$tool->purpose = $purpose;
$tool->name = $name;
$tool->save();

$martechtool = MartechTool::where('lead_id',$leadid)->get();

$array="";
foreach ($martechtool as $value) {

$array.="<tr>
<td>".$value->name."</td>
<td>".$value->purpose."</td>
<td class='text-center'><a class='btn btn-success' href='javascript:void(0)' data-toggle='modal' data-target='#edittool_".$value->id."' data-whatever='@getbootstrap'>Edit</a><div class='modal fade' id='edittool_".$value->id."' role='document' aria-labelledby='edittool_".$value->id."'
 aria-hidden='true'><div class='modal-dialog modal-lg' role='document'><div class='modal-content'><div class='modal-header'><h5>Edit Tool</h5><button class='close' type='button' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>×</span></button></div><form method='POST' action='".url('edittool')."'>".csrf_field()."<div class='modal-body'><div class='form-group'><input type='hidden' name='tool_id' value='".$value->id."'><input class='form-control' name='edittoolname' required  type='text' value='".$value->name."'></div><div class='form-group'><textarea class='form-control' name='edittoolpurpose' value='".$value->purpose."'>".$value->purpose."</textarea></div></div><div class='modal-footer'><button class='btn btn-success' type='submit'>Edit</button><a href='javascript:void(0)' data-dismiss='modal' aria-label='Close' aria-hidden='true' class='btn btn-danger'>Cancel</a></div></form></div></div></div></td>


<td><form method='POST' action='".url('deletetool')."'>
                                 ".csrf_field()."
                                <input type='hidden' name='toolid' value='".$value->id."'>
                                <button class='btn btn-danger' type='submit'>Delete</button>
                            </form></td>
</tr>" ;

}
return $array;
}
else{

    return 0;
    }
}


public function deletetool(Request $request){
    $id=$request->toolid;
     $tool = MartechTool::findOrFail($id);
        $tool->delete();
        return Redirect::back();
}

public function edittool(Request $request){

    if ($request->edittoolname != null || $request->edittoolpurpose != null) {
       
    $id=$request->tool_id;
     $tool = MartechTool::findOrFail($id);
        $tool->name = $request->edittoolname;
        $tool->purpose = $request->edittoolpurpose;
        $tool->save();
        return Redirect::back();
    }
    return Redirect::back();
}
}
