<?php

namespace App\Http\Controllers;


use App\Business;
use App\Notifications\AddComment;
use App\Notifications\CreateTask;
use App\Notifications\CreateTaskAdmin;
use App\SupportTicket;
use App\TicketAttachment;
use App\TicketComment;
use App\TaskComment;
use App\AttachmentComment;
use App\TicketLog;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Yajra\Datatables\Datatables;


class SupportTicketController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('View SupportTicket');

        $ticket_counts             = [];

        $new = SupportTicket::where( 'ticket_type', 'New' );
        $assigned = SupportTicket::where( 'ticket_type', 'Assigned' );
        $open = SupportTicket::where( 'ticket_type', 'Open' );
        $resolved = SupportTicket::where( 'ticket_type', 'Resolved' );
        $tickets = SupportTicket::with( [ 'ticket_attachments', 'ticket_comments' ] );

        //validate if login user is client
        if (strtolower(Auth::user()->role_user->name)=='client')
        {
            $new = $new->where('user_id',Auth::user()->id);
            $assigned = $assigned->where('user_id',Auth::user()->id);
            $open = $open->where('user_id',Auth::user()->id);
            $resolved = $resolved->where('user_id',Auth::user()->id);
            $tickets = $tickets->where('user_id',Auth::user()->id);
        }

        if($request->has('search') && strlen($request->search)>1)
        {
            $search = $request->search;
            $new = $new->where(function ($q) use($search){
                $q->where('ticket_number','LIKE',"%$search%")->orWhere('title','LIKE',"%$search%");
            });

            $assigned = $assigned->where(function ($q) use($search){
                $q->where('ticket_number','LIKE',"%$search%")->orWhere('title','LIKE',"%$search%");
            });

            $open = $open->where(function ($q) use($search){
                $q->where('ticket_number','LIKE',"%$search%")->orWhere('title','LIKE',"%$search%");
            });

            $resolved = $resolved->where(function ($q) use($search){
                $q->where('ticket_number','LIKE',"%$search%")->orWhere('title','LIKE',"%$search%");
            });

            $tickets = $tickets->where(function ($q) use($search){
                $q->where('ticket_number','LIKE',"%$search%")->orWhere('title','LIKE',"%$search%");
            });
        }

        if($request->has('start_date') && strlen($request->start_date)>8)
        {
            $start_date = $request->start_date;

            $new = $new->whereDate('start_date','>=',$start_date);
            $assigned = $assigned->whereDate('start_date','>=',$start_date);
            $open = $open->whereDate('start_date','>=',$start_date);
            $resolved = $resolved->whereDate('start_date','>=',$start_date);
            $tickets = $tickets->whereDate('start_date','>=',$start_date);
        }

        if($request->has('end_date') && strlen($request->end_date)>8)
        {
            $start_date = $request->end_date;

            $new = $new->whereDate('start_date','<=',$start_date);
            $assigned = $assigned->whereDate('start_date','<=',$start_date);
            $open = $open->whereDate('start_date','<=',$start_date);
            $resolved = $resolved->whereDate('start_date','<=',$start_date);
            $tickets = $tickets->whereDate('start_date','<=',$start_date);
        }

        if($request->has('created_date') && strlen($request->created_date)>8)
        {
            $start_date = $request->created_date;

            $new = $new->whereDate('created_at','=',$start_date);
            $assigned = $assigned->whereDate('created_at','=',$start_date);
            $open = $open->whereDate('created_at','=',$start_date);
            $resolved = $resolved->whereDate('created_at','=',$start_date);
            $tickets = $tickets->whereDate('created_at','=',$start_date);
        }

        if($request->has('due_date') && strlen($request->due_date)>8)
        {
            $start_date = $request->due_date;

            $new = $new->whereDate('due_date','=',$start_date);
            $assigned = $assigned->whereDate('due_date','=',$start_date);
            $open = $open->whereDate('due_date','=',$start_date);
            $resolved = $resolved->whereDate('due_date','=',$start_date);
            $tickets = $tickets->whereDate('due_date','=',$start_date);
        }

        if($request->has('assigment'))
        {
            $assigment = $request->assigment;

            $new = $new->whereIn('assigned_to',$assigment);
            $assigned = $assigned->whereIn('assigned_to',$assigment);
            $open = $open->whereIn('assigned_to',$assigment);
            $resolved = $resolved->whereIn('assigned_to',$assigment);
            $tickets = $tickets->whereIn('assigned_to',$assigment);
        }

        if($request->has('business'))
        {
            $assigment = $request->business;

            $new = $new->whereIn('user_id',$assigment);
            $assigned = $assigned->whereIn('user_id',$assigment);
            $open = $open->whereIn('user_id',$assigment);
            $resolved = $resolved->whereIn('user_id',$assigment);
            $tickets = $tickets->whereIn('user_id',$assigment);
        }

        if($request->has('priority'))
        {
            $assigment = $request->priority;

            $new = $new->whereIn('priority',$assigment);
            $assigned = $assigned->whereIn('priority',$assigment);
            $open = $open->whereIn('priority',$assigment);
            $resolved = $resolved->whereIn('priority',$assigment);
            $tickets = $tickets->whereIn('priority',$assigment);
        }

        if($request->has('status'))
        {
            $assigment = $request->status;

            $new = $new->whereIn('ticket_type',$assigment);
            $assigned = $assigned->whereIn('ticket_type',$assigment);
            $open = $open->whereIn('ticket_type',$assigment);
            $resolved = $resolved->whereIn('ticket_type',$assigment);
            $tickets = $tickets->whereIn('ticket_type',$assigment);
        }

        $ticket_counts['new']      = $new->count();

        $ticket_counts['assigned'] = $assigned->count();

        $ticket_counts['open']     = $open->count();
        $ticket_counts['resolved'] = $resolved->count();

        $tickets                   = $tickets
                ->orderBy( 'id', 'desc' )
                ->take(1)->get();

        //dd(json_decode($tickets[0]->logs()->first()->data));

        $assignees = User::where( 'email', '!=', Auth::user()->email )->pluck( 'email','id' );

        return view( 'supportticket.index',compact('ticket_counts','tickets','assignees') );
    }

    public function searchTicket(Request $request)
    {
        $tickets = SupportTicket::with( [ 'ticket_attachments', 'ticket_comments' ] );

        if (strtolower(Auth::user()->role_user->name)=='client')
        {
            $tickets = $tickets->where('user_id',Auth::user()->id);
        }

        if($request->has('search') && strlen($request->search)>1)
        {
            $search = $request->search;

            $tickets = $tickets->where(function ($q) use($search){
                $q->where('ticket_number','LIKE',"%$search%")->orWhere('title','LIKE',"%$search%");
            });
        }

        $tickets                   = $tickets
            ->orderBy( 'id', 'desc' )
            ->get();

        $assignees = User::where( 'email', '!=', Auth::user()->email )->pluck( 'email','id' );

        return view( 'supportticket.card_ticket',compact('tickets','assignees') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'supportticket.create' );
    }


    public function store(Request $request ) {

        try{
            DB::beginTransaction();
            $data = $request->only(['title','description','start_date']);
            //$data['start_date'] = Carbon::now()->toDateString();
            $data['ticket_type'] = 'New';

            $support_ticket = SupportTicket::create($data);

            $file            = $request->file( 'attachment' );
            $destinationPath = public_path( '/storage/images/' );
            $real_name       = $file->getClientOriginalName();
            $filename        = time() . '.' . $real_name;
            $file->move( $destinationPath, $filename );

            $ticket_attachment                   = new TicketAttachment();
            $ticket_attachment->ticket_id        = $support_ticket->id;
            $ticket_attachment->attachment_title = $real_name;
            $ticket_attachment->attachment       =  "/storage/images/" . $filename;
            $ticket_attachment->save();

            // notif to user
            $user = User::find(Auth::user()->id);
            $user->notify(new CreateTask($support_ticket));

            // notif to admin
            $role_admin = Role::where('name','Admin')->first();

            $admins = User::where('role',$role_admin->id)->get();

            foreach ($admins as $admin){
                if($admin->id!=$user->id){
                    $admin->notify(new CreateTaskAdmin($support_ticket));
                }
            }

            DB::commit();
            return redirect()->route( 'supportticket' )
                ->with( 'success',
                    'Ticket,
                 ' . $support_ticket->title . ' created' );


        }catch ( Exception $e ) {
            DB::rollBack();
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    public function commentAdd(Request $request ) {
        try{
            $ticket_number = $request->input( 'ticket_number' );
            $comment_txt   = $request->input( 'comment_txt' );

            $ticket = SupportTicket::find($ticket_number);

            $ticket_comment               = new TicketComment();
            $ticket_comment->ticket_id    = $ticket_number;
            $ticket_comment->user_id      = Auth::user()->id;
            $ticket_comment->comment_body = $comment_txt;
            $ticket_comment->save();

            if($ticket->assigned_to!=null)
            {
                if($ticket->assigned_to==Auth::user()->id)
                {
                    // notif to user to
                    $user = User::find($ticket->user_id);
                    $user->notify(new AddComment($ticket_comment,$ticket->ticket_number));

                }else if(Auth::user()->id==$ticket->user_id){
                    // notif to assigment to
                    $user = User::find($ticket->assigned_to);
                    $user->notify(new AddComment($ticket_comment,$ticket->ticket_number));

                }
            }

            return view( 'supportticket.add_comment',compact('ticket_comment') );
        }catch (Exception $ex){
            return $ex->getMessage();
        }
    }

    public function commentEdit(Request $request)
    {
        try{
            $ticket_number = $request->input( 'ticket_number' );
            $comment_txt   = $request->input( 'comment_txt' );

            $ticket_comment               = TicketComment::where('id',$ticket_number)->where('user_id',Auth::user()->id)->first();
            if(!empty($ticket_comment)){
                $ticket_comment->comment_body = $comment_txt;
                $ticket_comment->save();
            }

            return response()->json(['message'=>'success']);
        }catch (Exception $ex){
            return $ex->getMessage();
        }
    }

    public function commentDelete(Request $request)
    {
        try{
            $ticket_number = $request->input( 'ticket_number' );

            $ticket_comment               = TicketComment::where('id',$ticket_number)->where('user_id',Auth::user()->id)->first();
            if(!empty($ticket_comment)){
                $ticket_comment->delete();
            }

            return response()->json(['message'=>'success']);
        }catch (Exception $ex){
            return $ex->getMessage();
        }
    }

    public function taskcommentAdd( Request $request ) {

        try{
            $ticket_number = $request->input( 'ticket_number' );
            $comment_txt   = $request->input( 'comment_txt' );

            $ticket_comment               = new TaskComment();
            $ticket_comment->ticket_id    = $ticket_number;
            $ticket_comment->user_id      = Auth::user()->id;
            $ticket_comment->comment_body = $comment_txt;
            $ticket_comment->created_at =  \Carbon\Carbon::now();
            $ticket_comment->save();

            return DB::table( 'task_comments' )
                ->join( 'users', 'task_comments.user_id', '=', 'users.id' )
                ->select('task_comments.comment_body','task_comments.created_at','users.name')
                ->where( 'task_comments.id', $ticket_comment->id )->get()->toArray();
        }catch (Exception $ex){
            return $ex->getMessage();
        }


    }
    public function taskattachmentcommentAdd( Request $request ) {

        try{
            $ticket_number = $request->input( 'ticket_number' );
            $comment_txt   = $request->input( 'comment_txt' );

            $ticket_comment               = new AttachmentComment();
            $ticket_comment->ticket_id    = $ticket_number;
            $ticket_comment->user_id      = Auth::user()->id;
            $ticket_comment->comment_body = $comment_txt;
            $ticket_comment->created_at = \Carbon\Carbon::now();
            $ticket_comment->save();

            return DB::table( 'attachment_comments' )
                ->join( 'users', 'attachment_comments.user_id', '=', 'users.id' )
                ->select('attachment_comments.comment_body','attachment_comments.created_at','users.name')
                ->where( 'attachment_comments.id', $ticket_comment->id )->get()->toArray();
        }catch (Exception $ex){
            return $ex->getMessage();
        }


    }
    function getSupportTicketData() {


        $tasks = SupportTicket::select( [
            'title',
            'description',
            'status',
            'start_date',
            'due_date',
            'priority',
            'assigned_to',
            'parent_task_id',
        ] );

        return Datatables::of( $tasks )->make( true );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        try{
            DB::beginTransaction();
            $ticket = SupportTicket::find($id);
            $log=null;
            if(!empty($ticket))
            {
                $data_ticket_log['ticket_id']= $ticket->id;
                $data_ticket_log['user_id']= Auth::user()->id;
                $changes_data = [];
                if($request->description!=$ticket->description){

                    $changes_data['description']=['from'=>$ticket->description,'to'=>$request->descriptio];
                }

                if($request->ticket_type!=$ticket->ticket_type){
                    $changes_data['ticket type']=['from'=>$ticket->ticket_type,'to'=>$request->ticket_type];
                }

                if($request->start_date!=$ticket->start_date){
                    $changes_data['start date']=['from'=>$ticket->start_date,'to'=>$request->start_date];
                }

                if($request->due_date!=$ticket->due_date){
                    $changes_data['due date']=['from'=>$ticket->due_date,'to'=>$request->due_date];
                }

                if($request->priority!=$ticket->priority){
                    $changes_data['priority']=['from'=>$ticket->priority,'to'=>$request->priority];
                }

                if($request->assigned_to!=$ticket->assigned_to){
                    $user_from = User::find($ticket->assigned_to);
                    $user_to= User::find($request->assigned_to);

                    $changes_data['assigned to']=['from'=>$user_from->email,'to'=>$user_to->email];
                }

                if($request->assigned_by!=$ticket->assigned_by){
                    $user_from = User::find($ticket->assigned_by);
                    $user_to= User::find($request->assigned_by);

                    $changes_data['assigned by']=['from'=>$user_from->email,'to'=>$user_to->email];
                }

                if(count($changes_data)>0)
                {
                    $data_ticket_log['data']=json_encode($changes_data);

                    $log = TicketLog::create($data_ticket_log);
                }
            }

            $ticket->update($request->all());
            DB::commit();

            return view( 'supportticket.add_changelog',compact('log') );
        }catch (Exception  $e){
            DB::rollBack();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function assigment(Request $request)
    {
        $term = trim($request->q);

        if (empty($term)) {
            return response()->json([]);
        }

        $users = User::where('email','LIKE',"%$term%")->orWhere('name','LIKE',"%$term%")->limit(10)->get();

        $formatted_tags = [];

        foreach ($users as $tag) {
            $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->name];
        }

        return response()->json($formatted_tags);
    }

    public function business(Request $request)
    {
        $term = trim($request->q);

        if (empty($term)) {
            return response()->json([]);
        }

        $users = Business::where('cname','LIKE',"%$term%")
            ->whereHas('user',function ($q){
                $q->whereNotNull('businesses');
            })
            ->limit(10)->get();

        $formatted_tags = [];

        foreach ($users as $tag) {
            $formatted_tags[] = ['id' => $tag->user->id, 'text' => $tag->cname];
        }

        return response()->json($formatted_tags);
    }

    public function deleteAttachment($id)
    {
        $ticket_attachment = TicketAttachment::find($id);
        @unlink(public_path() . $ticket_attachment->attachment);

        $ticket_attachment->delete();

        return response()->json(['message'=>'success']);
    }

    public function addAttachment(Request $request)
    {

        try{
            $file            = $request->file( 'file' );
            $destinationPath = public_path( '/storage/images/' );
            $real_name       = $file->getClientOriginalName();
            $filename        = time() . '.' . $real_name;
            $file->move( $destinationPath, $filename );

            $ticket_attachment                   = new TicketAttachment();
            $ticket_attachment->ticket_id        = $request->ticket_id;
            $ticket_attachment->attachment_title = $real_name;
            $ticket_attachment->attachment       =  "/storage/images/" . $filename;
            $ticket_attachment->save();

            return response()->json(['message'=>'success','data'=>$ticket_attachment]);

        }catch (Exception $e){
            return response()->json(['message'=>$e->getMessage()]);
        }
    }
}
