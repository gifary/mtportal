<?php

namespace App\Http\Controllers;

use App\Business;
use App\Country;
use App\Department;
use App\Zone;
use Illuminate\Http\Request;

use App\User;
use Auth;
use Str;
use Redirect;
use Spatie\Permission\Models\Role;
use Session;

class UserController extends Controller
{

    public function __construct() {
        $this->middleware(['auth', 'isAdmin']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //Get all users and pass it to the view
        $users = User::all();
        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //Get all roles and pass it to the view
        $country = Country::pluck('country_name','country_code');
        $businesses = Business::pluck('cname','id');
        $roles = Role::pluck('name','id');
        $departments = Department::pluck('dept_name','dept_id');
        $zones = Zone::pluck('zone_name','zone_id');
        return view('users.create',compact('country','businesses','roles','departments','zones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //Validate name, email and password fields
        $this->validate($request, [
            'name'=>'required|max:120',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|confirmed',
            'profile' => 'required',
        ]);

        $data= $request->except(['profile','password_confirmation']);
        $data['password']  = bcrypt($request->password);
        if($request->hasFile('profile')){
            $image = $request->file('profile');
            if ($image) {
                $image_name = Str::random(20);
                $ext = strtolower($image->getClientOriginalExtension());
                $image_fullname = $image_name . '.' . $ext;
                $upload_path = public_path() . '/storage/profile/';
                $image_url = '/storage/profile/' . $image_fullname;
                $image->move($upload_path, $image_fullname);

                $data['profile_pic'] = $image_url;
            }
        }
        $user = User::create($data); //Retrieving only the email and password data

        //Redirect to the users.index view and display message
        return redirect()->route('permissions.index')
            ->with('flash_message',
                'User successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return redirect('users');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $user = User::findOrFail($id); //Get user with specified id
        $country = Country::pluck('country_name','country_code');
        $businesses = Business::pluck('cname','id');
        $roles = Role::pluck('name','id');
        $departments = Department::pluck('dept_name','dept_id');
        $zones = Zone::pluck('zone_name','zone_id');
        return view('users.edit', compact('user', 'roles','country','businesses','departments','zones')); //pass user and roles data to view

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $user = User::findOrFail($id); //Get role specified by id

        $validate = [
            'name'=>'required|max:120'
        ];
        if($request->old_email!=$request->email){
            array_push($validate,[ 'email'=>'required|email|unique:users']);
        }

        if($request->has('password') && !empty($request->password)){
            array_push($validate,[ 'password'=>'required|min:6|confirmed']);
        }

        $this->validate($request, $validate);

        $data= $request->except(['profile','password_confirmation','password']);
        if($request->has('password') && !empty($request->password)){
            $data['password']  = bcrypt($request->password);
        }

        if($request->hasFile('profile')){
            @unlink(public_path() . $user->profile_pic);
            $image = $request->file('profile');
            if ($image) {
                $image_name = Str::random(20);
                $ext = strtolower($image->getClientOriginalExtension());
                $image_fullname = $image_name . '.' . $ext;
                $upload_path = public_path() . '/storage/profile/';
                $image_url = '/storage/profile/' . $image_fullname;
                $image->move($upload_path, $image_fullname);

                $data['profile_pic'] = $image_url;
            }
        }

        $user->update($data);

        return redirect()->route('permissions.index')
            ->with('flash_message',
                'User successfully edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //Find a user with a given id and delete
        $user = User::findOrFail($id);
        if($user->profile_pic!=null){
            @unlink(public_path() . $user->profile_pic);
        }
        $user->delete();

        return redirect()->route('permissions.index')
            ->with('flash_message',
                'User successfully deleted.');
    }
}
