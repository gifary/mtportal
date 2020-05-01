<?php

namespace App\Http\Controllers;


use App\Notifications\CreateTask;
use App\Notifications\CreateTaskAdmin;
use App\SupportTicket;
use App\TicketAttachment;
use App\TicketComment;
use App\TaskComment;
use App\AttachmentComment;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Yajra\Datatables\Datatables;

class SupportTicketController extends Controller
{
    public function index()
    {
        $this->authorize('View SupportTicket');

        $ticket_counts             = [];
        $ticket_counts['new']      =
            SupportTicket::where( 'ticket_type', 'New' )->count();
        $ticket_counts['assigned'] =
            SupportTicket::where( 'ticket_type', 'Assigned' )->count();
        $ticket_counts['open']     =
            SupportTicket::where( 'ticket_type', 'Open' )->count();
        $ticket_counts['resolved'] =
            SupportTicket::where( 'ticket_type', 'Resolved' )->count();
        $tickets                   =
            SupportTicket::with( [ 'ticket_attachments', 'ticket_comments' ] )
                ->orderBy( 'id', 'desc' )
                ->get();

        $assignees =
            User::where( 'email', '!=', Auth::user()->email )->pluck( 'email' )
                ->toArray();
        $assignees = array_combine( $assignees, $assignees );


        return view( 'supportticket.index',compact('ticket_counts','tickets','assignees') );
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
            $data = $request->only(['title','description']);
            $data['start_date'] = Carbon::now()->toDateString();
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
            $ticket_attachment->attachment       =
                env( 'app_url' ) . "/public/storage/images/" . $filename;
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

    public function commentAdd( Request $request ) {
        try{
            $ticket_number = $request->input( 'ticket_number' );
            $comment_txt   = $request->input( 'comment_txt' );

            $ticket_comment               = new TicketComment();
            $ticket_comment->ticket_id    = $ticket_number;
            $ticket_comment->user_id      = Auth::user()->id;
            $ticket_comment->comment_body = $comment_txt;
            $ticket_comment->created_at =  \Carbon\Carbon::now();
            $ticket_comment->save();

            return DB::table( 'ticket_comments' )
                ->join( 'users', 'ticket_comments.user_id', '=', 'users.id' )
                ->select('ticket_comments.comment_body','ticket_comments.created_at','users.name')
                ->where( 'ticket_comments.id', $ticket_comment->id )->get();
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
