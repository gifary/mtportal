<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Input;
use Illuminate\Support\Facades\Redirect;
class ContactController extends Controller
{
    

  public function edit($id){


    // return $id;
 
 
 
 
     
     $contact = Contact::find($id);
 
 
     return View('business.contact.edit',compact('contact',$contact));
 
 
   }
 



      
    public function create($id)
    {
        
       
    

     //  return $id.$type;


        return View('business.contact.create',compact('id'));

       
      

       
     //  Stack::whereIn($checked)->delete();
    }
    

    
    public function store(Request $request){
        $name = $request->get('name');
        $email = $request->get('email');
        $position = $request->get('position');
        $phone = $request->get('phone');
        $department = $request->get('department');
      
        $business_id = $request->get('business_id');
         
         
     /*$pcular=implode(", ", $request->input('pcular'));
    $quantity=implode(", ", $request->input('quantity'));
    $uitem=implode(", ", $request->input('uitem'));
     $quantity2=implode(", ", $request->input('quantity2'));*/
        try{
          DB::beginTransaction();
          $stack = new Contact;
        $stack['name']=$name;
        $stack['email']=$email;
        $stack['position']=$position;
        $stack['phone']=$phone;
        $stack['department']=$department;
        $stack['business_id']=$business_id;
  
        $stack->save();
       
        DB::commit();
        $output = ['success' => 1,
                        'msg' => __('Contact Successully created')
                      ];
  
                    
                 
                $details = Business::where('id', 'like', '%'.$business_id.'%')->with('contacts','stacks')->paginate(25);
      
                    if($details[0]->id!=null){
                        return view('business.search', compact('details'));
                    }
                    else {
                        return view('business.index');
                    }



                    } catch (\Exception $e) {
                        DB::rollBack();
                        \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
                        
                        $output = ['success' => 0,
                                        'msg' => __("messages.something_went_wrong")
                                    ];
                                    return '<script>alert("'.$e->getMessage().'");</script>';
                    //    return redirect('challan')->with('status', $output);
                    }
  
       // return view('pdf_view')->with('soul', $soul);
      // $testArray=array();
      // $testArray = array_merge($testArray, (array)$soul);
  
       
     //   return view('pdf_view')->with(compact('data',$data));
  //   return view('pdf_view')->with('soul', $soul);
  
    
      }
      
    public function delete(Request $request){
        
    $contact_ids = $request->get('stack_id');


    return $contact_ids;

    }

    public function testDelete(Request $request) {

        $contact_ids = $request->input('contact_ids');
    /*
        $pDel = Contact::where('id', 1);
        return $pDel;
       // return Redirect::to('home')->with('message', 'Contact(s) deleted.');


*/
$user = Contact::find(1);

return $user;

    } 














    
      
    public function update(Request $request){

      
        $id = $request->get('id');
    $contact=Contact::find($id);
    $name = $request->get('name');
    $email = $request->get('email');
    $position = $request->get('position');
    $phone = $request->get('phone');
    $department = $request->get('department');
    $business_id = $contact->business_id;
  
  
  
    try{
   
    $contact->name=$name;
         $contact->email=$email;
              $contact->position=$position;
                   $contact->phone=$phone;
                        $contact->department=$department;
                                 
  
  
  
    $result=$contact->save();
      
    $output = ['success' => 1,
                    'msg' => __('stack Successully created')
                  ];
  
                    
                $details = Business::where('id', 'like', '%'.$business_id.'%')->with('contacts','stacks')->paginate(25);
      
                    if($details[0]->id!=null){
                        return view('business.search', compact('details'));
                    }
                    else {
                        return view('business.index');
                    }

  
            // return $result;
             
  
                } catch (\Exception $e) {
                    DB::rollBack();
                    \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
                    
                    $output = ['success' => 0,
                                    'msg' => __("messages.something_went_wrong")
                                ];
                                return '<script>alert("'.$e->getMessage().'");</script>';
                //    return redirect('challan')->with('status', $output);
                }
  
   // return view('pdf_view')->with('soul', $soul);
  // $testArray=array();
  // $testArray = array_merge($testArray, (array)$soul);
  
   
  //   return view('pdf_view')->with(compact('data',$data));
  //   return view('pdf_view')->with('soul', $soul);
  
  
  }

  public function show(Request $request){



       

  }

     public function destroy(Request $request,$id,$business_id )
    {
  $business_id = $business_id ;
         $contact = Contact::where('id', $id)
                                ->first();
                                
                    if (!empty($contact)) {
                        DB::beginTransaction();
                        //Delete variation location details
                    
                        $contact->delete();

                        DB::commit();
 
                       $details = Business::where('id', 'like', '%'.$business_id.'%')->with('contacts','stacks')->paginate(25);
      
                    if($details[0]->id!=null){
                        return view('business.search', compact('details'));
                    }
                    else {
                        return view('business.index');
                    }




}

}





public function getStudent(Request $request)
{

    $id=$request->get('id');
    $contact = Contact::find($id);
 
echo json_encode($contact);
  //  echo $contact;  
     //just return the value not the View
}



}