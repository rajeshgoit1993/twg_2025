<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log; // Import the Log facade
use Illuminate\Http\Request;
use App\Supplier;
use Sentinel;
use App\State;
use App\City;
use App\countries;
use App\PackageUploads;
use App\PackageImageGallery;
use Image;
use App\Helpers\CustomHelpers;
use DB;
use Datatables;
use App\SupplierEmail;
use App\QuotationFooter;
use App\SupplierEmailNonLead;

class SupplierController extends Controller
{
	public function supplier_email_non_lead()
	{
		return view('query.send_supplier_email.non_lead.supplier_email_non_lead');	
	}


	/*public function compose_email_non_lead()
	{
		$quotation_footer=QuotationFooter::all();
		return view('query.send_supplier_email.non_lead.compose_email_non_lead',compact('quotation_footer'));	
	}*/

	/**********************/

	public function compose_email_non_lead()
	{
	    $quotation_footer = QuotationFooter::all();
	    
	    // Fetch email data
	    $email_data = DB::table('supplier_email_non_lead')->get();
	    $emails = [];

	    foreach ($email_data as $d) {
	        if (!empty($d->to)) {
	            $toArray = @unserialize($d->to); // Safe unserialize
	            if ($toArray !== false && is_array($toArray)) {
	                $emails = array_merge($emails, $toArray);
	            }
	        }
	    }

	    $email_s = array_unique($emails);

	    return view('query.send_supplier_email.non_lead.compose_email_non_lead', compact('quotation_footer', 'email_s'));
	}

	/**********************/

	public function supplier_email()
	{
		$supplierdata = Supplier::all();
		return view('query.send_supplier_email.supplier_email',compact('supplierdata'));	
	}

	/**********************/

	/*public function get_supplier_email_list(Request $request)
	{
		$supplier_email=$request->supplier_email;
		if($supplier_email==0)
		{
		$data=SupplierEmail::all();
		}
		else
		{
		$data=SupplierEmail::where('to', 'like', '%' . $supplier_email . '%')->orWhere('cc', 'like', '%' . $supplier_email . '%')->orWhere('bcc', 'like', '%' . $supplier_email . '%')->get();;
		}
		return Datatables::of($data)
		->addIndexColumn()
		->addColumn('quo_ref', function($row){
		return $row->quo_ref;
		})
		->addColumn('to', function($row){
		if($row->to=='')
		{
		return 'NA';
		}
		else
		{
		$to=unserialize($row->to);
		$to_out='<ul>';
		foreach($to as $t)
		{
		$to_out.='<li>'.$t.'</li>';
		}
		$to_out.='<ul>';
		return $to_out;
		}
		})
		->addColumn('cc', function($row){
		if($row->cc=='')
		{
		return 'NA';
		}
		else
		{
		$cc=unserialize($row->cc);
		$to_out='<ul>';
		foreach($cc as $t)
		{
		$to_out.='<li>'.$t.'</li>';
		}
		$to_out.='<ul>';
		return $to_out;
		}
		})
		->addColumn('bcc', function($row){
		if($row->bcc=='')
		{
		return 'NA';
		}
		else
		{
		$cc=unserialize($row->bcc);
		$to_out='<ul>';
		foreach($cc as $t)
		{
		$to_out.='<li>'.$t.'</li>';
		}
		$to_out.='<ul>';
		return $to_out;
		}
		})
		->addColumn('action', function($row){
		$output='<a href="#" >
		<button type="button" class="btn btn-warning btn-sm view" id="'.$row->id.'">View </button>
		</a>
		<a href="#" ><button type="button" class="btn btn-danger btn-sm resend" id="'.$row->id.'">Re-send Email</button>	</a>
		';
		return $output;
		})
		->addColumn('last_update', function($row){
		return date('d M Y H:i:s',strtotime($row->updated_at));
		})
		->make(true);
	}*/

	public function get_supplier_email_list(Request $request)
	{
	    try {
	        // Log::info('Fetching supplier email list...', ['request_data' => $request->all()]);

	        $supplier_email = $request->supplier_email;

	        if ($supplier_email == 0) {
	            $data = SupplierEmail::all();
	        } else {
	            $data = SupplierEmail::where('to', 'like', '%' . $supplier_email . '%')
	                ->orWhere('cc', 'like', '%' . $supplier_email . '%')
	                ->orWhere('bcc', 'like', '%' . $supplier_email . '%')
	                ->get();
	        }

	        // foreach ($data as $row) {
	        //     Log::info("Row Data", [
	        //         'quo_ref' => $row->quo_ref,
	        //         'to' => $row->to,
	        //         'cc' => $row->cc,
	        //         'bcc' => $row->bcc,
	        //     ]);
	        // }

	        return Datatables::of($data)
	            ->addIndexColumn()
	            ->addColumn('quo_ref', fn($row) => $row->quo_ref)
	            ->addColumn('to', function ($row) {
	                if (empty($row->to)) return 'NA';

	                $to = @unserialize($row->to);
	                if ($to === false) {  // If unserialization fails, try JSON
	                    $to = json_decode($row->to, true);
	                }

	                if (!is_array($to)) return 'Invalid Format';

	                return '<ul><li>' . implode('</li><li>', array_map('e', $to)) . '</li></ul>';
	            })
	            ->addColumn('cc', function ($row) {
	                if (empty($row->cc)) return 'NA';

	                $cc = @unserialize($row->cc);
	                if ($cc === false) {
	                    $cc = json_decode($row->cc, true);
	                }

	                if (!is_array($cc)) return 'Invalid Format';

	                return '<ul><li>' . implode('</li><li>', array_map('e', $cc)) . '</li></ul>';
	            })
	            ->addColumn('bcc', function ($row) {
	                if (empty($row->bcc)) return 'NA';

	                $bcc = @unserialize($row->bcc);
	                if ($bcc === false) {
	                    $bcc = json_decode($row->bcc, true);
	                }

	                if (!is_array($bcc)) return 'Invalid Format';

	                return '<ul><li>' . implode('</li><li>', array_map('e', $bcc)) . '</li></ul>';
	            })
	            ->addColumn('action', function ($row) {
	                return '<a href="#">
	                            <button type="button" class="btn btn-warning btn-sm view" id="'.e($row->id).'">View</button>
	                        </a>
	                        <a href="#">
	                            <button type="button" class="btn btn-danger btn-sm resend" id="'.e($row->id).'">Re-send Email</button>
	                        </a>';
	            })
	            ->addColumn('last_update', fn($row) => date('d M Y H:i:s', strtotime($row->updated_at)))
	            ->make(true);
	    } catch (\Exception $e) {
	        // Log::error('Error fetching supplier email list', ['error' => $e->getMessage()]);
	        return response()->json(['error' => 'Something went wrong!'], 500);
	    }
	}

	/**********************/

  	/*public function get_supplier_email_list_non_lead(Request $request)
	{
		$supplier_email=$request->supplier_email;
		if($supplier_email==0)
		{
		$data=SupplierEmailNonLead::all();
		}
		else
		{
		$data=SupplierEmailNonLead::where('to', 'like', '%' . $supplier_email . '%')->orWhere('cc', 'like', '%' . $supplier_email . '%')->orWhere('bcc', 'like', '%' . $supplier_email . '%')->get();;
		}
		return Datatables::of($data)
		->addIndexColumn()
		->addColumn('quo_ref', function($row) {
		return $row->quo_ref;
		})
		->addColumn('from_email_name', function($row){
		return $row->from_email_name;
		})
		->addColumn('to', function($row){
		if($row->to=='') {
		return 'NA';
		} else {
		$to=unserialize($row->to);
		$to_out='<ul>';
		foreach($to as $t) {
		$to_out.='<li>'.$t.'</li>';
		}
		$to_out.='<ul>';
		return $to_out;
		}
		})
		->addColumn('cc', function($row){
		if($row->cc=='')
		{
		return 'NA';
		}
		else
		{
		$cc=unserialize($row->cc);
		$to_out='<ul>';
		foreach($cc as $t)
		{
		$to_out.='<li>'.$t.'</li>';
		}
		$to_out.='<ul>';
		return $to_out;
		}
		})
		->addColumn('bcc', function($row){
		if($row->bcc=='')
		{
		return 'NA';
		}
		else
		{
		$cc=unserialize($row->bcc);
		$to_out='<ul>';
		foreach($cc as $t)
		{
		$to_out.='<li>'.$t.'</li>';
		}
		$to_out.='<ul>';
		return $to_out;
		}
		})
		->addColumn('attachment', function($row){
		if($row->attachment!='')
		{
		$path = url('/').'/public/uploads/email/attachments/'.$row->attachment;
		return '<a href="'.$path.'" target="_blank">View</a>';
		}
		})
		->addColumn('action', function($row){
		$output='<a href="#" >
		<button  class="btn-q btn-viewquote view" id="'.$row->id.'">View </button>
		</a>
		<a href="#" ><button class="btn-q btn-viewlead resend" id="'.$row->id.'">Resend Email</button>	</a>
		';
		return $output;
		})
		->addColumn('last_update', function($row){
		return date('d M Y H:i:s',strtotime($row->updated_at));
		})
		->make(true);
	}*/

	public function get_supplier_email_list_non_lead(Request $request)
	{
	    try {
	        // Log::info('Fetching supplier email list (Non-Lead)...', ['request_data' => $request->all()]);

	        $supplier_email = $request->supplier_email;

	        if ($supplier_email == 0) {
	            $data = SupplierEmailNonLead::all();
	        } else {
	            $data = SupplierEmailNonLead::where('to', 'like', '%' . $supplier_email . '%')
	                ->orWhere('cc', 'like', '%' . $supplier_email . '%')
	                ->orWhere('bcc', 'like', '%' . $supplier_email . '%')
	                ->get();
	        }

	        return Datatables::of($data)
	            ->addIndexColumn()
	            ->addColumn('quo_ref', fn($row) => $row->quo_ref)
	            ->addColumn('from_email_name', fn($row) => $row->from_email_name)
	            ->addColumn('to', function ($row) {
	                if (empty($row->to)) return 'NA';

	                $to = @unserialize($row->to);
	                if ($to === false) {  
	                    $to = json_decode($row->to, true);
	                }

	                if (!is_array($to)) return 'Invalid Format';

	                return '<ul><li>' . implode('</li><li>', array_map('e', $to)) . '</li></ul>';
	            })
	            ->addColumn('cc', function ($row) {
	                if (empty($row->cc)) return 'NA';

	                $cc = @unserialize($row->cc);
	                if ($cc === false) {
	                    $cc = json_decode($row->cc, true);
	                }

	                if (!is_array($cc)) return 'Invalid Format';

	                return '<ul><li>' . implode('</li><li>', array_map('e', $cc)) . '</li></ul>';
	            })
	            ->addColumn('bcc', function ($row) {
	                if (empty($row->bcc)) return 'NA';

	                $bcc = @unserialize($row->bcc);
	                if ($bcc === false) {
	                    $bcc = json_decode($row->bcc, true);
	                }

	                if (!is_array($bcc)) return 'Invalid Format';

	                return '<ul><li>' . implode('</li><li>', array_map('e', $bcc)) . '</li></ul>';
	            })
	            ->addColumn('attachment', function ($row) {
	                if (!empty($row->attachment)) {
	                    $path = url('/public/uploads/email/attachments/' . $row->attachment);
	                    return '<a href="' . e($path) . '" target="_blank">View</a>';
	                }
	                return 'NA';
	            })
	            ->addColumn('action', function ($row) {
	                return '<a href="#">
	                            <button type="button" class="btn btn-warning btn-sm view" id="'.e($row->id).'">View</button>
	                        </a>
	                        <a href="#">
	                            <button type="button" class="btn btn-danger btn-sm resend" id="'.e($row->id).'">Re-send Email</button>
	                        </a>';
	            })
	            ->addColumn('last_update', fn($row) => date('d M Y H:i:s', strtotime($row->updated_at)))
	            ->make(true);
	    } catch (\Exception $e) {
	        // Log::error('Error fetching supplier email list (Non-Lead)', ['error' => $e->getMessage()]);
	        return response()->json(['error' => 'Something went wrong!'], 500);
	    }
	}

	/**********************/

	/*public function view_supplier_email(Request $request)
	{
		$id=$request->id;
		$data=SupplierEmail::find($id);
		$output=view('query.send_supplier_email.view_supplier_email',compact('data'));
		echo $output;
	}*/

	public function view_supplier_email(Request $request)
	{
	    $id = $request->id;
	    $data = SupplierEmail::find($id);

	    if (!$data) {
	        return response()->json(['error' => 'Supplier email not found'], 404);
	    }

	    return view('query.send_supplier_email.view_supplier_email', compact('data'));
	}


	/**********************/

	public function view_supplier_email_non_lead(Request $request)
	{
		$id=$request->id;

		$data=SupplierEmailNonLead::find($id);
		$output=view('query.send_supplier_email.view_supplier_email',compact('data'));
		echo $output;
	}

	/**********************/
  
	public function index() 
	{
		$supplierdata = Supplier::all();
		//dd($all_roles);
		return view('supplier.index',compact('supplierdata'));
	}

	/**********************/

	public function addsupplier() 
	{
		$countries=countries::all();
		return view('supplier.createsupplier',compact('countries'));
	}

	/**********************/

	public function savesupplierprofile(Request $request) 
	{
		$data=new Supplier;
		if($request->file('supplierpancard')) {
			$supplierpancard=$request->file('supplierpancard');
			$supplierpancardname = uniqid().$supplierpancard->getClientOriginalName();
			$path = '/uploads/supplier/'.$supplierpancardname;
			//move the file to correct location
			$supplierpancard->move(public_path().'/uploads/supplier/', $supplierpancardname);
			$data->supplierpancard = $supplierpancardname;
			}
		if($request->file('suppliergstcertificate')) {
			$suppliergstcertificate=$request->file('suppliergstcertificate');
			$suppliergstcertificatename = uniqid().$suppliergstcertificate->getClientOriginalName();
			$path = '/uploads/supplier/'.$suppliergstcertificatename;
			//move the file to correct location
			$suppliergstcertificate->move(public_path().'/uploads/supplier/', $suppliergstcertificatename);
			$data->suppliergstcertificate = $suppliergstcertificatename;
			}
		if($request->file('supplieridproof')) {
			$supplieridproof=$request->file('supplieridproof');
			$supplieridproofname = uniqid().$supplieridproof->getClientOriginalName();
			$path = '/uploads/supplier/'.$supplieridproofname;
			//move the file to correct location
			$supplieridproof->move(public_path().'/uploads/supplier/', $supplieridproofname);
			$data->supplieridproof = $supplieridproofname;
			}
		if($request->file('supplieraddressproof')) {
			$supplieraddressproof=$request->file('supplieraddressproof');
			$supplieraddressproofname = uniqid().$supplieraddressproof->getClientOriginalName();
			$path = '/uploads/supplier/'.$supplieraddressproofname;
			//move the file to correct location
			$supplieraddressproof->move(public_path().'/uploads/supplier/', $supplieraddressproofname);
			$data->supplieraddressproof = $supplieraddressproofname;
			}
		if($request->file('supplierregistrationproof')) {
			$supplierregistrationproof=$request->file('supplierregistrationproof');
			$supplierregistrationproofname = uniqid().$supplierregistrationproof->getClientOriginalName();
			$path = '/uploads/supplier/'.$supplierregistrationproofname;
			//move the file to correct location
			$supplierregistrationproof->move(public_path().'/uploads/supplier/', $supplierregistrationproofname);
			$data->supplierregistrationproof = $supplierregistrationproofname;
			}
		if($request->file('suppliercompanylogo')) {
			$suppliercompanylogo=$request->file('suppliercompanylogo');
			$suppliercompanylogoname = uniqid().$suppliercompanylogo->getClientOriginalName();
			$path = '/uploads/supplier/'.$suppliercompanylogoname;
			//move the file to correct location
			$suppliercompanylogo->move(public_path().'/uploads/supplier/', $suppliercompanylogoname);
			$data->suppliercompanylogo = $suppliercompanylogoname;
			}
		if($request->file('supplierfirstadditionaldocument')) {
			$supplierfirstadditionaldocument=$request->file('supplierfirstadditionaldocument');
			$supplierfirstadditionaldocumentname = uniqid().$supplierfirstadditionaldocument->getClientOriginalName();
			$path = '/uploads/supplier/'.$supplierfirstadditionaldocumentname;
			//move the file to correct location
			$supplierfirstadditionaldocument->move(public_path().'/uploads/supplier/', $supplierfirstadditionaldocumentname);
			$data->supplierfirstadditionaldocument = $supplierfirstadditionaldocumentname;
			}
		if($request->file('suppliersecondadditionaldocument')) {
			$suppliersecondadditionaldocument=$request->file('suppliersecondadditionaldocument');
			$suppliersecondadditionaldocumentname = uniqid().$suppliersecondadditionaldocument->getClientOriginalName();
			$path = '/uploads/supplier/'.$suppliersecondadditionaldocumentname;
			//move the file to correct location
			$suppliersecondadditionaldocument->move(public_path().'/uploads/supplier/', $suppliersecondadditionaldocumentname);
			$data->suppliersecondadditionaldocument = $suppliersecondadditionaldocumentname;
			}
		$data->suppliercompanyname = $request->suppliercompanyname;
		$data->suppliercompanytype = $request->suppliercompanytype;
		$data->supplieraddress = $request->supplieraddress;
		$data->suppliercountry = $request->suppliercountry;
		$data->supplierstate = $request->supplierstate;
		$data->suppliercity = $request->suppliercity;
		$data->supplierpincode = $request->supplierpincode;
		$data->supplierservicetype = $request->supplierservicetype;
		$data->suppliercurrency = $request->suppliercurrency;
		$data->supplieremployees = $request->supplieremployees;
		$data->suppliercontactperson = $request->suppliercontactperson;
		$data->supplierprimaryemail = $request->supplierprimaryemail;
		$data->suppliersecondaryemail = $request->suppliersecondaryemail;
		$data->suppliermobile = $request->suppliermobile;
		$data->supplieralternatemobile = $request->supplieralternatemobile;
		$data->supplierofficenumber = $request->supplierofficenumber;
		$data->supplierwebsite = $request->supplierwebsite;
		$data->supplierpannumber = $request->supplierpannumber;
		$data->supplierpanname = $request->supplierpanname;
		$data->suppliergstnumber = $request->suppliergstnumber;
		$data->suppliergstname = $request->suppliergstname;
		$data->suppliergstemail = $request->suppliergstemail;
		$data->suppleiergstcontact = $request->suppleiergstcontact;
		$data->suppliergstaddress = $request->suppliergstaddress;
		$data->supplieraccountscontactnumber = $request->supplieraccountscontactnumber;
		$data->supplieraccountsemail = $request->supplieraccountsemail;
		$data->supplierbankname = $request->supplierbankname;
		$data->supplierbankaddress = $request->supplierbankaddress;
		$data->supplierbankaccountname = $request->supplierbankaccountname;
		$data->supplierbankaccountnumber = $request->supplierbankaccountnumber;
		$data->supplierbankifsccode  = $request->supplierbankifsccode;
		$data->supplierupiid = $request->supplierupiid;
		$data->supplierbankcountry = $request->supplierbankcountry;
		$data->supplierswiftcode = $request->supplierswiftcode;
		$data->suppliersorttcode = $request->suppliersorttcode;
		$data->supplierbsbcode = $request->supplierbsbcode;
		$data->supplieribancode = $request->supplieribancode;
		$data->supplierbankroutingnumber = $request->supplierbankroutingnumber;
		$data->supplierotherinfo     = $request->supplierotherinfo;
		$data->supplierfirstadditionalname = $request->supplierfirstadditionalname;
		$data->suppliersecondadditionalname = $request->suppliersecondadditionalname;
		$data->supplierstatus = $request->supplierstatus;
		$data->save();
		
		return redirect('/Supplier')->with('success','Supplier added successfully');
	}
	
	/**********************/

	public function edit($id) 
	{
		$data=Supplier::find($id);
		$countries=countries::all();
		return view('supplier.editsupplier',compact('countries','data'));
	}

	/**********************/
	
	public function supplier_data(Request $request) 
	{
		$id = $request->id;
		$data = Supplier::find($id);

		$value = "
		<div class='row'>
			<div class='col-md-12'>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>Supplier ID</label>
					<input class='form-control' type='text' value='" . $data->id . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>Company Name</label>
					<input class='form-control textCapitalize' type='text' value='" . $data->suppliercompanyname . "' readonly />
				</div>
			</div>
			<div class='col-md-12'>
				<div class='form-group'>
					<label>Registered Address</label>
					<input class='form-control textCapitalize' type='text' value='" . $data->supplieraddress . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>Company Type</label>
					<input class='form-control textCapitalize' type='text' value='" . $data->suppliercompanytype . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>Pin Code</label>
					<input class='form-control' type='text' value='" . $data->supplierpincode . "' readonly />
				</div>
			</div>
			<div class='col-md-4'>
				<div class='form-group'>
					<label>Country</label>
					<input class='form-control textCapitalize' type='text' value='" . $data->suppliercountry . "' readonly />
				</div>
			</div>
			<div class='col-md-4'>
				<div class='form-group'>
					<label>State</label>
					<input class='form-control textCapitalize' type='text' value='" . $data->supplierstate . "' readonly />
				</div>
			</div>
			<div class='col-md-4'>
				<div class='form-group'>
					<label>City</label>
				<input class='form-control textCapitalize' type='text' value='" . $data->suppliercity . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>Services Type</label>
					<input class='form-control textCapitalize' type='text' value='" . $data->supplierservicetype . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>Default Currency</label>
					<input class='form-control' type='text' value='" . $data->suppliercurrency . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>No of Employees</label>
					<input class='form-control' type='text' value='" . $data->supplieremployees . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>Contact Person</label>
					<input class='form-control textCapitalize' type='text' value='" . $data->suppliercontactperson . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>Primary Email ID</label>
					<input class='form-control textLowercase' type='text' value='" . $data->supplierprimaryemail . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>Secondary Email ID</label>
					<input class='form-control textLowercase' type='text' value='" . $data->suppliersecondaryemail . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>Mobile No</label>
					<input class='form-control' type='text' value='" . $data->suppliermobile . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>Alternate Mobile No</label>
					<input class='form-control' type='text' value='" . $data->supplieralternatemobile . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>Office Landline No</label>
					<input class='form-control' type='text' value='" . $data->supplierofficenumber . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>Website Name</label>
					<input class='form-control textLowercase' type='text' value='" . $data->supplierwebsite . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>PAN Number</label>
					<input class='form-control textUppercase' type='text' value='" . $data->supplierpannumber . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>PAN Card Name</label>
					<input class='form-control textCapitalize' type='text' value='" . $data->supplierpanname . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>GST Number</label>
					<input class='form-control textUppercase' type='text' value='" . $data->suppliergstnumber . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>GST Name</label>
					<input class='form-control textCapitalize' type='text' value='" . $data->suppliergstname . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>GST Email</label>
					<input class='form-control textLowercase' type='text' value='" . $data->suppliergstemail . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>GST Contact Number</label>
					<input class='form-control' type='text' value='" . $data->suppleiergstcontact . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>GST Address</label>
					<input class='form-control textCapitalize' type='text' value='" . $data->suppliergstaddress . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>Accounts Contact Number</label>
					<input class='form-control' type='text' value='" . $data->supplieraccountscontactnumber . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>Accounts Email ID</label>
					<input class='form-control textLowercase' type='text' value='" . $data->supplieraccountsemail . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>Bank Name</label>
					<input class='form-control textCapitalize' type='text' value='" . $data->supplierbankname . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>Bank Address</label>
					<input class='form-control textCapitalize' type='text' value='" . $data->supplierbankaddress . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>Account Name </label>
					<input class='form-control textCapitalize' type='text' value='" . $data->supplierbankaccountname . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>Account Number</label>
					<input class='form-control' type='text' value='" . $data->supplierbankaccountnumber . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>IFSC Code</label>
					<input class='form-control textUppercase' type='text' value='" . $data->supplierbankifsccode . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>UPI ID</label>
					<input class='form-control textLowercase' type='text' value='" . $data->supplierupiid . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>Country</label>
					<input class='form-control textCapitalize' type='text'value='" . $data->supplierbankcountry . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>SWIFT Code</label>
					<input class='form-control textUppercase' type='text'value='" . $data->supplierswiftcode . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>SORT Code</label>
					<input class='form-control textUppercase' type='text' value='" . $data->suppliersorttcode . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>BSB Code</label>
					<input class='form-control textUppercase' type='text'value='" . $data->supplierbsbcode . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>IBAN Code</label>
					<input class='form-control textUppercase' type='text'value='" . $data->supplieribancode . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>Routing Number</label>
					<input class='form-control' type='text'value='" . $data->supplierbankroutingnumber . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>Additional Information</label>
					<input class='form-control' type='text'value='" . $data->supplierotherinfo . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>PAN Card</label>";
					if($data->supplierpancard != ''):
						$value .= "<a href='" . url('/public/uploads/supplier/' . $data->supplierpancard) . "' class='form-control' target='_blank'>View</a>";
					else:
						$value .= "<a href='#' class='form-control'>No File</a>";
					endif;
					$value.="
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>GST Certificate </label>";
					if($data->suppliergstcertificate != ''):
						$value .= "<a href='" . url('/public/uploads/supplier/' . $data->suppliergstcertificate) . "' class='form-control' target='_blank'>View</a>";
					else:
						$value .= "<a href='#' class='form-control'>No File</a>";
					endif;
					$value.="
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>ID Proof</label>";
					if($data->supplieridproof!=''):
					$value.="<a href='".url('/public/uploads/supplier/' . $data->supplieridproof) . "' class='form-control' target='_blank'>View</a>";
					else:
					$value .= "<a href='#' class='form-control'>No File</a>";
					endif;
					$value.="
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>Address Proof</label>";
					if($data->supplieraddressproof!=''):
					$value.="<a href='" . url('/public/uploads/supplier/' . $data->supplieraddressproof) . "' class='form-control' target='_blank'>View</a>";
					else:
						$value .= "<a href='#' class='form-control'>No File</a>";
					endif;
					$value.="
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>Registration Proof</label>";
					if($data->supplierregistrationproof!=''):
						$value.="<a href='" . url('/public/uploads/supplier/' . $data->supplierregistrationproof) . "' class='form-control' target='_blank'>View</a>";
					else:
						$value .= "<a href='#' class='form-control'>No File</a>";
					endif;
					$value.="
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>Company Logo</label>";
					if($data->suppliercompanylogo!=''):
						$value.="<a href='" . url('/public/uploads/supplier/' . $data->suppliercompanylogo) . "' class='form-control' target='_blank'>View</a>";
					else:
						$value .= "<a href='#' class='form-control'>No File</a>";
					endif;
					$value.="
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>Additional Document-I</label>
					<input class='form-control' type='text' value='" . $data->supplierfirstadditionalname . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>Document-I</label>";
					if($data->supplierfirstadditionaldocument!=''):
						$value.=" <a href='" . url('/public/uploads/supplier/' . $data->supplierfirstadditionaldocument) . "' class='form-control' target='_blank'>View</a>";
					else:
						$value .= "<a href='#' class='form-control'>No File</a>";
					endif;
					$value.="
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>Document-II</label>
					<input class='form-control' type='text' value='" . $data->suppliersecondadditionalname . "' readonly />
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label>Upload Document-II </label>";
					if($data->suppliersecondadditionaldocument!=''):
						$value.="<a href='" . url('/public/uploads/supplier/' . $data->suppliersecondadditionaldocument) . "' class='form-control' target='_blank'>View</a>";
					else:
						$value .= "<a href='#' class='form-control'>No File</a>";
					endif;
					$value.="
				</div>
			</div>
			</div>
		</div>";

		return $value;
	}

	/**********************/

	public function update($id,Request $request) 
	{
		$data=Supplier::find($id);
		if($request->file('supplierpancard')) {
			$supplierpancard=$request->file('supplierpancard');
			$supplierpancardname = uniqid().$supplierpancard->getClientOriginalName();
			$path = '/uploads/supplier/'.$supplierpancardname;
			//move the file to correct location
			$supplierpancard->move(public_path().'/uploads/supplier/', $supplierpancardname);
			$data->supplierpancard = $supplierpancardname;
			}
		if($request->file('suppliergstcertificate')) {
			$suppliergstcertificate=$request->file('suppliergstcertificate');
			$suppliergstcertificatename = uniqid().$suppliergstcertificate->getClientOriginalName();
			$path = '/uploads/supplier/'.$suppliergstcertificatename;
			//move the file to correct location
			$suppliergstcertificate->move(public_path().'/uploads/supplier/', $suppliergstcertificatename);
			$data->suppliergstcertificate = $suppliergstcertificatename;
			}
		if($request->file('supplieridproof')) {
			$supplieridproof=$request->file('supplieridproof');
			$supplieridproofname = uniqid().$supplieridproof->getClientOriginalName();
			$path = '/uploads/supplier/'.$supplieridproofname;
			//move the file to correct location
			$supplieridproof->move(public_path().'/uploads/supplier/', $supplieridproofname);
			$data->supplieridproof = $supplieridproofname;
			}
		if($request->file('supplieraddressproof')) {
			$supplieraddressproof=$request->file('supplieraddressproof');
			$supplieraddressproofname = uniqid().$supplieraddressproof->getClientOriginalName();
			$path = '/uploads/supplier/'.$supplieraddressproofname;
			//move the file to correct location
			$supplieraddressproof->move(public_path().'/uploads/supplier/', $supplieraddressproofname);
			$data->supplieraddressproof = $supplieraddressproofname;
			}
		if($request->file('supplierregistrationproof')) {
			$supplierregistrationproof=$request->file('supplierregistrationproof');
			$supplierregistrationproofname = uniqid().$supplierregistrationproof->getClientOriginalName();
			$path = '/uploads/supplier/'.$supplierregistrationproofname;
			//move the file to correct location
			$supplierregistrationproof->move(public_path().'/uploads/supplier/', $supplierregistrationproofname);
			$data->supplierregistrationproof = $supplierregistrationproofname;
			}
		if($request->file('suppliercompanylogo')) {
			$suppliercompanylogo=$request->file('suppliercompanylogo');
			$suppliercompanylogoname = uniqid().$suppliercompanylogo->getClientOriginalName();
			$path = '/uploads/supplier/'.$suppliercompanylogoname;
			//move the file to correct location
			$suppliercompanylogo->move(public_path().'/uploads/supplier/', $suppliercompanylogoname);
			$data->suppliercompanylogo = $suppliercompanylogoname;
			}
		if($request->file('supplierfirstadditionaldocument')) {
			$supplierfirstadditionaldocument=$request->file('supplierfirstadditionaldocument');
			$supplierfirstadditionaldocumentname = uniqid().$supplierfirstadditionaldocument->getClientOriginalName();
			$path = '/uploads/supplier/'.$supplierfirstadditionaldocumentname;
			//move the file to correct location
			$supplierfirstadditionaldocument->move(public_path().'/uploads/supplier/', $supplierfirstadditionaldocumentname);
			$data->supplierfirstadditionaldocument = $supplierfirstadditionaldocumentname;
			}
		if($request->file('suppliersecondadditionaldocument')) {
			$suppliersecondadditionaldocument=$request->file('suppliersecondadditionaldocument');
			$suppliersecondadditionaldocumentname = uniqid().$suppliersecondadditionaldocument->getClientOriginalName();
			$path = '/uploads/supplier/'.$suppliersecondadditionaldocumentname;
			//move the file to correct location
			$suppliersecondadditionaldocument->move(public_path().'/uploads/supplier/', $suppliersecondadditionaldocumentname);
			$data->suppliersecondadditionaldocument = $suppliersecondadditionaldocumentname;
			}

		$data->suppliercompanyname = $request->suppliercompanyname;
		$data->suppliercompanytype = $request->suppliercompanytype;
		$data->supplieraddress = $request->supplieraddress;
		$data->suppliercountry = $request->suppliercountry;
		$data->supplierstate = $request->supplierstate;
		$data->suppliercity = $request->suppliercity;
		$data->supplierpincode = $request->supplierpincode;
		$data->supplierservicetype = $request->supplierservicetype;
		$data->suppliercurrency = $request->suppliercurrency;
		$data->supplieremployees = $request->supplieremployees;
		$data->suppliercontactperson = $request->suppliercontactperson;
		$data->supplierprimaryemail = $request->supplierprimaryemail;
		$data->suppliersecondaryemail = $request->suppliersecondaryemail;
		$data->suppliermobile = $request->suppliermobile;
		$data->supplieralternatemobile = $request->supplieralternatemobile;
		$data->supplierofficenumber = $request->supplierofficenumber;
		$data->supplierwebsite = $request->supplierwebsite;
		$data->supplierpannumber = $request->supplierpannumber;
		$data->supplierpanname = $request->supplierpanname;
		$data->suppliergstnumber = $request->suppliergstnumber;
		$data->suppliergstname = $request->suppliergstname;
		$data->suppliergstemail = $request->suppliergstemail;
		$data->suppleiergstcontact = $request->suppleiergstcontact;
		$data->suppliergstaddress = $request->suppliergstaddress;
		$data->supplieraccountscontactnumber = $request->supplieraccountscontactnumber;
		$data->supplieraccountsemail = $request->supplieraccountsemail;
		$data->supplierbankname = $request->supplierbankname;
		$data->supplierbankaddress = $request->supplierbankaddress;
		$data->supplierbankaccountname = $request->supplierbankaccountname;
		$data->supplierbankaccountnumber = $request->supplierbankaccountnumber;
		$data->supplierbankifsccode  = $request->supplierbankifsccode;
		$data->supplierupiid = $request->supplierupiid;
		$data->supplierbankcountry = $request->supplierbankcountry;
		$data->supplierswiftcode = $request->supplierswiftcode;
		$data->suppliersorttcode = $request->suppliersorttcode;
		$data->supplierbsbcode = $request->supplierbsbcode;
		$data->supplieribancode = $request->supplieribancode;
		$data->supplierbankroutingnumber = $request->supplierbankroutingnumber;
		$data->supplierotherinfo     = $request->supplierotherinfo;
		$data->supplierfirstadditionalname = $request->supplierfirstadditionalname;
		$data->suppliersecondadditionalname = $request->suppliersecondadditionalname;
		$data->supplierstatus = $request->supplierstatus;
		$data->save();
		
		return redirect('/Supplier')->with('success','Supplier updated successfully');
	}

	/**********************/

	public function delete($id) 
	{
		$data=Supplier::find($id);
		if($data):
		Supplier::destroy($id);
		return redirect("/Supplier")->with('success','Supplier deleted successfully');
		else:
		return redirect("/Supplier");
		endif;
	}
}