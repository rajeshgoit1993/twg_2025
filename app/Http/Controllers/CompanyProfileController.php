<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log; // Import the Log facade
use Illuminate\Http\Request;
use App\CompanyProfile;
use Sentinel;

class CompanyProfileController extends Controller
{
    //
    public function index()
    {
    	$data=CompanyProfile::all();
    	return view("company_profile.index",compact("data"));
    }
    public function create()
    {
    	if(Sentinel::getUser()->inRole('super_admin')):
    	return view("company_profile.create");
        else:
        	return redirect("/");
        endif;
    }
    public function save(Request $request)
    {
        $data=new CompanyProfile;
    	if($request->file('logo')):
         $logo=$request->file("logo");
         $logo_name=uniqid().'.'.$logo->getClientOriginalExtension();
         $logo->move(public_path().'/uploads/company_profile/', $logo_name);
         $data->logo=$logo_name;
    	endif;
    	//
    	if($request->file('pan_card')):
         $pan_card=$request->file("pan_card");
         $pan_card_name=uniqid().'.'.$pan_card->getClientOriginalExtension();
         $pan_card->move(public_path().'/uploads/company_profile/', $pan_card_name);
         $data->pan_card=$pan_card_name;
    	endif;
    	//
    	if($request->file('gst_certificate')):
         $gst_certificate=$request->file("gst_certificate");
         $gst_certificate_name=uniqid().'.'.$gst_certificate->getClientOriginalExtension();
         $gst_certificate->move(public_path().'/uploads/company_profile/', $gst_certificate_name);
         $data->gst_certificate=$gst_certificate_name;
    	endif;
    	//
    	if($request->file('id_proof')):
         $id_proof=$request->file("id_proof");
         $id_proof_name=uniqid().'.'.$id_proof->getClientOriginalExtension();
         $id_proof->move(public_path().'/uploads/company_profile/', $id_proof_name);
         $data->id_proof=$id_proof_name;
    	endif;
    	//
    	if($request->file('address_proof')):
         $address_proof=$request->file("address_proof");
         $address_proof_name=uniqid().'.'.$address_proof->getClientOriginalExtension();
         $address_proof->move(public_path().'/uploads/company_profile/', $address_proof_name);
         $data->address_proof=$address_proof_name;
    	endif;
    	//
    	if($request->file('registration_proof')):
         $registration_proof=$request->file("registration_proof");
         $registration_proof_name=uniqid().'.'.$registration_proof->getClientOriginalExtension();
         $registration_proof->move(public_path().'/uploads/company_profile/', $registration_proof_name);
         $data->registration_proof=$registration_proof_name;
    	endif;
    	//
    	if($request->file('other_first_image')):
         $other_first_image=$request->file("other_first_image");
         $other_first_image_name=uniqid().'.'.$other_first_image->getClientOriginalExtension();
         $other_first_image->move(public_path().'/uploads/company_profile/', $other_first_image_name);
         $data->other_first_image=$other_first_image_name;
    	endif;
    	//
    	if($request->file('other_second_image')):
         $other_second_image=$request->file("other_second_image");
         $other_second_image_name=uniqid().'.'.$other_second_image->getClientOriginalExtension();
         $other_second_image->move(public_path().'/uploads/company_profile/', $other_second_image_name);
         $data->other_second_image=$other_second_image_name;
    	endif;
    	//
       $data->company_id=time();
       $data->company_name=$request->company_name;
       $data->address=$request->address;
       $data->city=$request->city;
       $data->state=$request->state;
       $data->pin=$request->pin;
       $data->country=$request->country;
       $data->company_type=$request->company_type;
       $data->no_of_emp=$request->no_of_emp;
       $data->contact_person=$request->contact_person;
       $data->office_no=$request->office_no;
       $data->mobile_no=$request->mobile_no;
       $data->alternate_no=$request->alternate_no;
       $data->primary_email=$request->primary_email;
       $data->secondary_email=$request->secondary_email;
       $data->website=$request->website;
       $data->facebook_link=$request->facebook_link;
       $data->twiter=$request->twiter;
       $data->instagram=$request->instagram;
       $data->other_social_link=$request->other_social_link;
       $data->pan=$request->pan;
       $data->name_of_pan=$request->name_of_pan;
       $data->gst_no=$request->gst_no;
       $data->gst_name=$request->gst_name;
       $data->gst_email=$request->gst_email;
       $data->gst_contact=$request->gst_contact;
       $data->gst_address=$request->gst_address;
       $data->account_dept_no=$request->account_dept_no;
       $data->account_dept_email=$request->account_dept_email;
       $data->other_first_name=$request->other_first_name;
       $data->other_second_name=$request->other_second_name;
       if($data->save()):
        return redirect("/Company-Profile")->with("success","Company Profile Successfully Created");
       endif;
    }
    public function edit($id)
    {
    	if(Sentinel::getUser()->inRole('super_admin')):
    	$data=CompanyProfile::find($id);
    	if($data):
    		return view("company_profile.edit",compact("data"));
    	else:
    		return redirect("/");
    	endif;
    else:
    	return redirect("/");
    endif;
    }
    public function update(Request $request)
    {
     $data=CompanyProfile::find($request->id);
     if($data):
       if($request->file('logo')):
         $logo=$request->file("logo");
         $logo_name=uniqid().'.'.$logo->getClientOriginalExtension();
         $logo->move(public_path().'/uploads/company_profile/', $logo_name);
         if($data->logo!=""):
          $file_path = public_path().'/uploads/company_profile/'.$data->logo;
          unlink($file_path);
         endif;
         $data->logo=$logo_name;
    	endif;
    	//
    	if($request->file('pan_card')):
         $pan_card=$request->file("pan_card");
         $pan_card_name=uniqid().'.'.$pan_card->getClientOriginalExtension();
         $pan_card->move(public_path().'/uploads/company_profile/', $pan_card_name);
          if($data->pan_card!=""):
          $file_path = public_path().'/uploads/company_profile/'.$data->pan_card;
          unlink($file_path);
         endif;
         $data->pan_card=$pan_card_name;
    	endif;
    	//
    	if($request->file('gst_certificate')):
         $gst_certificate=$request->file("gst_certificate");
         $gst_certificate_name=uniqid().'.'.$gst_certificate->getClientOriginalExtension();
         $gst_certificate->move(public_path().'/uploads/company_profile/', $gst_certificate_name);
          if($data->gst_certificate!=""):
          $file_path = public_path().'/uploads/company_profile/'.$data->gst_certificate;
          unlink($file_path);
         endif;
         $data->gst_certificate=$gst_certificate_name;
    	endif;
    	//
    	if($request->file('id_proof')):
         $id_proof=$request->file("id_proof");
         $id_proof_name=uniqid().'.'.$id_proof->getClientOriginalExtension();
         $id_proof->move(public_path().'/uploads/company_profile/', $id_proof_name);
          if($data->id_proof!=""):
          $file_path = public_path().'/uploads/company_profile/'.$data->id_proof;
          unlink($file_path);
         endif;
         $data->id_proof=$id_proof_name;
    	endif;
    	//
    	if($request->file('address_proof')):
         $address_proof=$request->file("address_proof");
         $address_proof_name=uniqid().'.'.$address_proof->getClientOriginalExtension();
         $address_proof->move(public_path().'/uploads/company_profile/', $address_proof_name);
          if($data->address_proof!=""):
          $file_path = public_path().'/uploads/company_profile/'.$data->address_proof;
          unlink($file_path);
         endif;
         $data->address_proof=$address_proof_name;
    	endif;
    	//
    	if($request->file('registration_proof')):
         $registration_proof=$request->file("registration_proof");
         $registration_proof_name=uniqid().'.'.$registration_proof->getClientOriginalExtension();
         $registration_proof->move(public_path().'/uploads/company_profile/', $registration_proof_name);
          if($data->registration_proof!=""):
          $file_path = public_path().'/uploads/company_profile/'.$data->registration_proof;
          unlink($file_path);
         endif;
         $data->registration_proof=$registration_proof_name;
    	endif;
    	//
    	if($request->file('other_first_image')):
         $other_first_image=$request->file("other_first_image");
         $other_first_image_name=uniqid().'.'.$other_first_image->getClientOriginalExtension();
         $other_first_image->move(public_path().'/uploads/company_profile/', $other_first_image_name);
          if($data->other_first_image!=""):
          $file_path = public_path().'/uploads/company_profile/'.$data->other_first_image;
          unlink($file_path);
         endif;
         $data->other_first_image=$other_first_image_name;
    	endif;
    	//
    	if($request->file('other_second_image')):
         $other_second_image=$request->file("other_second_image");
         $other_second_image_name=uniqid().'.'.$other_second_image->getClientOriginalExtension();
         $other_second_image->move(public_path().'/uploads/company_profile/', $other_second_image_name);
          if($data->other_second_image!=""):
          $file_path = public_path().'/uploads/company_profile/'.$data->other_second_image;
          unlink($file_path);
         endif;
         $data->other_second_image=$other_second_image_name;
    	endif;
    	//
       $data->company_name=$request->company_name;
       $data->address=$request->address;
       $data->city=$request->city;
       $data->state=$request->state;
       $data->pin=$request->pin;
       $data->country=$request->country;
       $data->company_type=$request->company_type;
       $data->no_of_emp=$request->no_of_emp;
       $data->contact_person=$request->contact_person;
       $data->office_no=$request->office_no;
       $data->mobile_no=$request->mobile_no;
       $data->alternate_no=$request->alternate_no;
       $data->primary_email=$request->primary_email;
       $data->secondary_email=$request->secondary_email;
       $data->website=$request->website;
       $data->facebook_link=$request->facebook_link;
       $data->twiter=$request->twiter;
       $data->instagram=$request->instagram;
       $data->other_social_link=$request->other_social_link;
       $data->pan=$request->pan;
       $data->name_of_pan=$request->name_of_pan;
       $data->gst_no=$request->gst_no;
       $data->gst_name=$request->gst_name;
       $data->gst_email=$request->gst_email;
       $data->gst_contact=$request->gst_contact;
       $data->gst_address=$request->gst_address;
       $data->account_dept_no=$request->account_dept_no;
       $data->account_dept_email=$request->account_dept_email;
       $data->other_first_name=$request->other_first_name;
       $data->other_second_name=$request->other_second_name;
       if($data->save()):
        return redirect("/Company-Profile")->with("success","Company Profile Successfully Updated");
       endif;
     else:
     	return redirect("/");
     endif;
    }
}