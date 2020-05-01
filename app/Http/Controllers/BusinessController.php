<?php

namespace App\Http\Controllers;

use App\Business;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Log;

class BusinessController extends Controller
{
    public function __construct() {
		$this->middleware( 'auth' );
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'business.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

		$file            = $request->file( 'profile_image' );
		$destinationPath = public_path( '/storage/images/' );
		$filename        = time() . '.' . $file->getClientOriginalName();
		$file->move( $destinationPath, $filename );


		$dual_size = $request->get( 'dual_size' );

		$cname           = $request->get( 'cname' );
		$contact1        = $request->get( 'contact1' );
		$contact2        = $request->get( 'contact2' );
		$closed_won_date = $request->get( 'closed_won_date' );
		$lead_industry   = $request->get( 'lead_industry' );
		$lead_source     = $request->get( 'lead_source' );
		$market_contact  = $request->get( 'market_contact' );
		$market_email    = $request->get( 'market_email' );
		$market_phone    = $request->get( 'market_phone' );
		$billing_contact = $request->get( 'billing_contact' );
		$billing_address = $request->get( 'billing_address' );
		$billing_phone   = $request->get( 'billing_phone' );
		$billing_email   = $request->get( 'billing_email' );

		$special_notes = $request->get( 'special_notes' );


		/*$pcular=implode(", ", $request->input('pcular'));
	   $quantity=implode(", ", $request->input('quantity'));
	   $uitem=implode(", ", $request->input('uitem'));
		$quantity2=implode(", ", $request->input('quantity2'));*/
		try {
			DB::beginTransaction();
			$stack                    = new Business;
			$stack['cname']           = $cname;
			$stack['contact1']        = $contact1;
			$stack['contact2']        = $contact2;
			$stack['dual_size']       = $dual_size;
			$stack['closed_won_date'] = $closed_won_date;
			$stack['lead_industry']   = $lead_industry;
			$stack['lead_source']     = $lead_source;
			$stack['market_contact']  = $market_contact;

			$stack['market_email'] = $market_email;

			$stack['market_phone']    = $market_phone;
			$stack['billing_email']   = $billing_email;
			$stack['billing_contact'] = $billing_contact;

			$stack['billing_address'] = $billing_address;

			$stack['billing_phone'] = $billing_phone;

			$stack['special_notes'] = $special_notes;
			$stack['image']         =
				"http://martechportal.com/storage/images/" . $filename;


			$stack->save();

			DB::commit();
			$output = [
				'success' => 1,
				'msg'     => __( 'stack Successully created' ),
			];


			return view( 'business.index' )->with( 'flash_message',
				'User sstack Successully created' );


		} catch ( Exception $e ) {
			DB::rollBack();
			Log::emergency( "File:" . $e->getFile() . "Line:" . $e->getLine()
			                . "Message:" . $e->getMessage() );

			$output = [
				'success' => 0,
				'msg'     => __( "messages.something_went_wrong" ),
			];

			return '<script>alert("' . $e->getMessage() . '");</script>';
			//    return redirect('challan')->with('status', $output);
		}
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


	public function viewBusiness() {

        $this->authorize('View Stack');

		$details = Business::with( 'contacts', 'stacks' )->paginate( 25 );
		$stacks  = Business::with( 'stacks' )->paginate( 25 );

		//return view('customers.index', compact('customers'));


		//return $details;
		//
		return view( 'business.index', compact( 'details' ) );
	}


	public function search( Request $request ) {
		$keyword = $request->get( 'keyward' );


		//   return $keyword;
		$details = Business::where( 'cname', 'like', '%' . $keyword . '%' )
			->orWhere( 'id', 'like', '%' . $keyword . '%' )
			->orWhere( 'market_email', 'like', '%' . $keyword . '%' )
			->orWhere( 'billing_email', 'like', '%' . $keyword . '%' )
			->with( 'contacts', 'stacks' )->paginate( 25 );


		//return view('customers.index', compact('customers'));

		//  return $details;

		//return $details;

		try {
			if ( $details[0]->id != "" ) {

				return view( 'business.search', compact( 'details' ) );
			} else {

			}

		} catch ( Exception $e ) {
			return view( 'business.index' )->with( 'flash_message',
				'User successfully added.' );


		}


	}


	public function newsearch( $keyward ) {
		$keyword = $keyward;


		//   return $keyword;
		$details = Business::where( 'cname', 'like', '%' . $keyword . '%' )
			->orWhere( 'id', 'like', '%' . $keyword . '%' )
			->orWhere( 'market_email', 'like', '%' . $keyword . '%' )
			->orWhere( 'billing_email', 'like', '%' . $keyword . '%' )
			->with( 'contacts', 'stacks' )->paginate( 25 );


		//return view('customers.index', compact('customers'));

		//  return $details;

		//return $details;

		try {
			if ( $details[0]->id != "" ) {

				return view( 'business.search', compact( 'details' ) );
			} else {

			}

		} catch ( Exception $e ) {
			return view( 'business.index' )->with( 'flash_message',
				'User successfully added.' );


		}


	}


	function action( Request $request ) {
		if ( $request->ajax() ) {
			$output = '';
			$query  = $request->get( 'query' );
			if ( $query != '' ) {
				$data = DB::table( 'businesses' )
					->where( 'cname', 'like', '%' . $query . '%' )
					->orWhere( 'id', 'like', '%' . $query . '%' )
					->orWhere( 'market_email', 'like', '%' . $query . '%' )
					->orWhere( 'billing_email', 'like', '%' . $query . '%' )
					->orWhere( 'billing_contact', 'like', '%' . $query . '%' )
					->orWhere( 'contact1', 'like', '%' . $query . '%' )
					->orWhere( 'contact2', 'like', '%' . $query . '%' )
					->orWhere( 'dual_size', 'like', '%' . $query . '%' )
					->orWhere( 'closed_won_date', 'like', '%' . $query . '%' )
					->orderBy( 'id', 'desc' )
					->get();

			} else {
				$data = DB::table( 'businesses' )
					->orderBy( 'id', 'desc' )
					->get();
			}
			$total_row = $data->count();
			if ( $total_row > 0 ) {
				foreach ( $data as $row ) {
					$output .= '
        <tr  id=' . $row->id . '>
         <td>' . $row->id . '</td>
         <td>' . $row->cname . '</td>
         <td>' . $row->market_email . '</td>
                  <td>' . $row->contact1 . '</td>
         <td>' . $row->special_notes . '</td>

        <td><a class="btn  btn-xs form-inline"  id="viewId" name="viewId"><i class="fa fa-eye" ></i></a>
        </td>
        </tr>
        ';
				}
			} else {
				$output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
			}
			$data = array(
				'table_data' => $output,
				'total_data' => $total_row,
			);

			echo json_encode( $data );
		}
	}


	function fetch( Request $request ) {
		if ( $request->get( 'query' ) ) {
			$query  = $request->get( 'query' );
			$data   = DB::table( 'businesses' )
				->where( 'cname', 'LIKE', "%{$query}%" )
				->get();
			$output =
				'<ul class="dropdown-menu" style="display:block; position:relative">';
			foreach ( $data as $row ) {
				$output .= '
       <li><a href="#">' . $row->country_name . '</a></li>
       ';
			}
			$output .= '</ul>';
			echo $output;
		}
	}


	function datas( Request $request ) {


		$fName = DB::table( 'businesses' )->select( 'cname' )->get();


		$response = array();
		foreach ( $fName as $eName ) {
			$response[] =
				array( "value" => $eName->cname, "label" => $eName->cname );
		}

		echo json_encode( $response );
		exit;


	}
}
