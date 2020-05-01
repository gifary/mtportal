<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use Session;
use App\Lead;
use App\LedCategories;

class BKPLeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('leads.index');
    }
    public function view_leads($id)
    {
        $lead= Lead::where('id',$id)->first();
        return view('leads.view_leads')->with('lead', $lead);
    }


    public function leads_categori($id)
    {
        $leadselect= Lead::where('lead_status',$id)->get();
        $leads= Lead::where('lead_status',$id)->paginate(10);
        $leadcat= LedCategories::where('id',$id)->get('Categori_name')->first();
        return view('leads.leads_categori',compact('leads','leadselect','leadcat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lead_delete($id)
    {
        session::flash('message', '<p style="color: red; font-size:18px;" class="text-center pt-10 pb-10" >Lead Deleted Successfully</p>');
         Lead::where('id',$id)->delete();
         return Redirect::to('/leads');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            session::flash('message', '<p style="color: green; font-size:18px;" class="text-center pt-10 pb-10" >Lead Added Successfully</p>');
            return Redirect::back();
        } else {
            session::flash('message', '<p style="color: red; font-size:18px;" class="text-center pt-10 pb-10" >Something Were Missing</p>');
            return Redirect::back();
        }
    }

    public function update(Request $request) {

        $request->validate([
            'id' => 'required|integer',
            'cname' => 'required|string',
        ]);

        $success = Lead::where('id', $request->id)->update($request->all());
        if ($success != null) {
            session::flash('message', '<p style="color: green; font-size:18px;" class="text-center pt-10 pb-10" >Lead Updated Successfully</p>');
            return Redirect::back();
        } else {
            session::flash('message', '<p style="color: red; font-size:18px;" class="text-center pt-10 pb-10" >Something Were Missing</p>');
            return Redirect::back();
        }
    }

    /**
     * Display the specified resource.
     *


     */

    public function fetchlead(Request $request)
    {

        /** Author Shubham Rawat(rwtshubhu5569@gmail.com) **/
   $leadname =   $request->get('cname');
        $data  = Lead::where('cname', 'LIKE', $leadname . '%')->first();
         $status      = \App\LedCategories::where('id',$data->lead_status)->pluck('led_class')->first();
                    $date    = \Carbon\Carbon::parse($data->created_at)->format('M d, Y');
               $category    = \App\LedCategories::where('id',$data->lead_status)->pluck('categori_name')->first();
               $path = url('/view-lead');

 $leadcard = '<a href="'.$path.'/'.$data->id.'"><div class="col-sm-12 col-xl-6" style="float: left;"><div class="card card-absolute">
                  <div class="card-header '.$status.'"><h5 class="text-white">'.$data->cname.'</h5></div>
                  <div class="card-body"> <h5 class="black">Start Date : '.$date.'</h5><h5 class="black">Status : '.$category.'</h5>
                  </div>
                </div>
              </div></a>';




        return $leadcard;


    }




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
