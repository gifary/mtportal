<?php

namespace App\Http\Controllers;

use App\Task;
use Auth;
use App\ChangLog;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Session;
use DB;
use Redirect;
use App\TuskAttachment;
use App\AttachmentComment;
use App\TaskComment;
use Str;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('View Tasks');
        $tasks = Task::orderBy('id','desc')->where('status' , '!=' ,0)->paginate(12);
        return view('task.view_task')->with('tasks',$tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('Create Tasks');

        return view('task.create');
    }

    public function delete_task($id)
    {
        $this->authorize('Delete Tasks');

        $attachment = TuskAttachment::where('task_id', $id)->get();
        foreach ($attachment as $file) {
            unlink(public_path() . $file->attachment);
            AttachmentComment::where('ticket_id', $file->id)->delete();
        }
        ChangLog::where('task_id', $id)->delete();
        TuskAttachment::where('task_id', $id)->delete();
        TaskComment::where('ticket_id', $id)->delete();
        DB::table('tasks')->where('id', $id)->delete();
        return Redirect::back();
    }
    public function search_task( Request $request) {
        //        dd($request->all()); exit;
        $tasks = DB::table('tasks')
                ->join('users', 'tasks.assigned_to', '=', 'users.id')
                ->select('tasks.*', 'users.email', 'users.name')
                ->where('tasks.title','like','%'.$request->title.'%')
                ->where('tasks.status', $request->status)
                ->where('tasks.task_type', $request->task_type)
                ->orWhere('users.email', $request->assigned)
                ->orWhere('tasks.task_type', $request->assigned_to)
                ->orWhereBetween('tasks.created_at', [$request->from,$request->to ])
                ->orderBy('id','desc')
                ->paginate(12);
        return view('task.search_task')->with('tasks',$tasks);

    }
    public function update_task( Request $request) {

        $this->authorize('Edit Tasks');

        $tasks = DB::table('tasks')->where('id', $request->id)->first();
        $prev = array();
        $prev['user_id'] = Auth::user()->id;
        $prev['task_id'] = $tasks->id;
        $prev['description'] = $tasks->description;
        $prev['status'] = $tasks->status;
        $prev['task_type'] = $tasks->task_type;
        $prev['due_date'] = $tasks->due_date;
        $prev['priority'] = $tasks->priority;
        $prev['assigned_to'] = $tasks->assigned_to;
        $success = ChangLog::create($prev);

        if ($success != null) {
            $data = array();
            $data['description'] = $description = $request['desc'];
            $data['status'] = $status = $request['status'];
            $data['due_date'] = $due_date = $request['due_date'];
            $data['priority'] = $priority = $request['priority'];
            $data['assigned_to'] = $assigned_to = $request['assigned_to'];

            DB::table('tasks')->where('id', $request->id)->update($data);
        }



        return Redirect::back();

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Validate name and permissions field


        $title= $request['title'];
        $description= $request['description'];
        $status= $request['status'];
        $start_date= $request['start_date'];
        $due_date= $request['due_date'];
        $priority= $request['priority'];
        $assigned_to= $request['assigned_to'];
        $parent_task_id= $request['parent_task_id'];
        $task = new Task();
        $task->title=$title;
        $task->description=$description;
        $task->status=$status;
        $task->start_date=$start_date;
        $task->due_date=$due_date;
        $task->priority=$priority;
        $task->assigned_to=$assigned_to;
        $task->parent_task_id=$parent_task_id;

                try {

                    $task->save();
                    return redirect()->route('tasks.create')
                    ->with('success', 'Tasks,
                     '. $task->title.' created');

                  } catch (\Exception $e) {
                      return $e->getMessage();
                  }

    }

    function getData(){


        $tasks = Task::select(['title','description','status','start_date','due_date','priority','assigned_to','parent_task_id']);
        dd($tasks);
        return Datatables::of($tasks)->make(true);
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function save_task_attachment(Request $request)
    {

        $request->validate([
            'task_id' => 'required',
            'attachment' => 'required',
        ]);


        $images = $request->file('attachment');
        //dd(Str::random(6)); exit;
        if ($images) {
            foreach ($images as $key => $image) {
                $image_name = Str::random(16);
                $ext = strtolower($image->getClientOriginalExtension());
                $image_fullname = $image_name . '.' . $ext;
                $upload_path =public_path()."/storage/task/";
                $image_url = "/storage/task/" . $image_fullname;
                $success = $image->move($upload_path, $image_fullname);
                $attachment = array();
                $attachment['attachment'] = $image_url;
                $attachment['task_id'] = $request->task_id;
                $attachment['attachment_title'] = $image->getClientOriginalName();
                TuskAttachment::create($attachment);
            }
        }

        return Redirect::back();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function save_task(Request $request) {

        $request->validate([
            'title' => 'required|string|max:250',
            'description' => 'required|string|max:4255',
            'user_id' => 'required',
            'attachment' => 'nullable',
            'due_date' => 'required',
        ]);

        $data = array();
        $data['title'] = $request['title'];
        $data['description'] = $request['description'];
        $data['status'] = 2;
        $data['start_date'] = $request['start_date'];
        $data['due_date'] = $request['due_date'];
        $data['priority'] = 2;
        $data['task_type'] = 1;
        $data['user_id'] = $request['user_id'];
        $data['assigned_to'] = $request['assigned_to'];
        $data['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
        $data['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
        $result = $task_id = Task::insertGetId($data);
        $images = $request->file('attachment');
        //dd(Str::random(6)); exit;
        if ($images) {
            foreach ($images as $key => $image) {
                $image_name = Str::random(16);
                $ext = strtolower($image->getClientOriginalExtension());
                $image_fullname = $image_name . '.' . $ext;
                $upload_path =public_path()."/storage/task/";
                $image_url = "/storage/task/" . $image_fullname;
                $success = $image->move($upload_path, $image_fullname);
                $attachment = array();
                $attachment['attachment'] = $image_url;
                $attachment['task_id'] = $task_id;
                $attachment['attachment_title'] = $image->getClientOriginalName();
                TuskAttachment::create($attachment);
            }
        }

        if ($result) {
            session::flash('message', '<p style="color: green;" class="text-center" > Task Added </p>');
            return Redirect::back();
        } else {
            session::flash('message', '<p style="color: red;" class="text-center" > Your User id or Password Invalid </p>');
            return Redirect::back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }



    function paginate()
    {

        $query_key          = Input::get('search');
        $search_key         = $query_key['value'];
        $q                  = Task::query();
        $query              = Task::with(['status', 'assigned_user', 'tags', 'priority', 'type']);


        $component_id       = Input::get('component_id');
        $component_number   = Input::get('component_number');
        $status_id          = Input::get('status_id');
        $priority_id        = Input::get('priority_id');
        $assigned_to        = Input::get('assigned_to');
        $sort_by            = Input::get('sort_by');

        /* If the current user doesn't have permission to view all tasks, then
            show only the ones that he is assigned to or has created.
        */
        if(!can('Tasks View') && (!($component_id && $component_number)) )
        {
            $q->where(function($k){
                $k->where('created_by', auth()->user()->id)->orWhere('assigned_to', auth()->user()->id);
            });

            $query->where(function($k){
                $k->where('created_by', auth()->user()->id)->orWhere('assigned_to', auth()->user()->id);
            });
        }


        if($component_id && $component_number)
        {
            $q->where('component_id', '=', $component_id)->where('component_number', '=', $component_number);

            $query->where('component_id', '=', $component_id)->where('component_number', '=', $component_number);

        }
        elseif($component_id && !$component_number)
        {
            if($component_id == 'uncategorized')
            {
                $query->whereNull('component_id');
            }
            else
            {
                $query->whereIn('component_id',  $component_id);
            }

        }


        if($status_id)
        {
           $query->whereIn('status_id', (is_array($status_id)) ? $status_id : [$status_id] );
        }

        if($priority_id)
        {
            $query->whereIn('priority_id', $priority_id );
        }

        if($assigned_to)
        {
            if($assigned_to == 'unassigned')
            {
                $query->whereNull('assigned_to');
            }
            else
            {
                $query->where('assigned_to', '=', $assigned_to);
            }
        }

        if($sort_by)
        {
            if($sort_by == 'due_date')
            {
                $query->orderBy('due_date', 'ASC');
            }
        }
        else
        {
            $query->orderBy('id', 'DESC');
        }

        $number_of_records = $q->count();

        if($search_key)
        {
            $query->where('title', 'like', $search_key.'%')
                // ->orWhere('start_date', '=', date2sql($search_key))
                // ->orWhere('due_date', '=', date2sql($search_key))
                // ->orWhereHas('status', function ($q) use ($search_key) {
                //     $q->where('project_statuses.name', 'like', $search_key.'%');

                // })
            ;


        }

        $recordsFiltered = $query->get()->count();
        $query->skip(Input::get('start'))->take(Input::get('length'));
        $data = $query->get();
        //

        $rec = [];

        if (count($data) > 0)
        {
            $status_id_list = TaskStatus::orderBy('id','ASC')->pluck('name', 'id')->toArray();

            foreach ($data as $key => $row)
            {

              $person_created_route_name= ($row->user_type == USER_TYPE_CUSTOMER) ? 'view_customer_page' : 'member_profile' ;

               if(isset($row->assigned_user->first_name))
               {
                    $assigned_to = anchor_link($row->assigned_user->first_name . " ". $row->assigned_user->last_name, route('member_profile', $row->assigned_user->id)) ;
               }
               else
               {
                 $assigned_to = "";
               }

                if(check_perm('tasks_edit'))
                {
                    $status = $this->status_change_dropdown($row->id, $row->status->id, $row->status->name, $status_id_list);
                }
                else
                {
                    $status = $row->status->name;
                }

                $rec[] = array(

                    a_links(anchor_link($row->number, route('show_task_page', $row->id)), [
                        [
                            'action_link' => route('edit_task_page', $row->id),
                            'action_text' => __('form.edit'), 'action_class' => '',
                            'permission'  => 'tasks_edit',
                        ],
                        [
                            'action_link' => route('delete_task', $row->id),
                            'action_text' => __('form.delete'), 'action_class' => 'delete_item',
                            'permission'  => 'tasks_delete',
                        ]
                    ]),
                    $row->title,
                    $status,
                    ($row->start_date) ? sql2date($row->start_date) : "",
                    ($row->due_date) ? sql2date($row->due_date) : "",
                    $assigned_to,
                    $row->get_tags_as_badges(true),
                    $row->priority->name,
                    anchor_link($row->person_created->name , route($person_created_route_name, $row->person_created->id))

                );

            }
        }


        $output = array(
            "draw" => intval(Input::get('draw')),
            "recordsTotal" => $number_of_records,
            "recordsFiltered" => $recordsFiltered,
            "data" => $rec
        );


        return response()->json($output);


    }
}
