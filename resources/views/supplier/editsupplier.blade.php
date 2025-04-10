@extends('layouts.master')

@section("custom_css_code")

<style>
.supplier-item-container {
  box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.2);
  border: 1px solid #e9e9e9;
  border-radius: 10px;
  padding: 30px;
  margin-bottom: 20px;
  display: block;
  margin-top: 10px;
}
</style>

@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="box">
               <div class="box-header">
                  <h3 class="box-title">Edit Supplier</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body" >
                  <a href="{{ URL::to('/Supplier') }}" class="btn btn-success">
                     <i class="glyphicon glyphicon-arrow-left"></i> Back
                  </a>
                  <div class="supplier-item-container">
                     <form action="{{URL::to('/editsupplier/'.$data->id)}}" method="Post" id="supplierform" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="alert alert-success fontWeight600" id="success-contaier" style="display: none">
                           <p>Thank You! Your profile has been updated successfully.</p>
                        </div>

                        <div class="row">

                           <div class="col-md-1">
                           <div class="form-group">
                           <label for="supplierid">Supplier ID <span class="requiredcolor">*</span></label>
                           <input type="text" class="form-control" id="supplierid" name="supplierid" value="{{$data->id}}" placeholder="Enter Supplier ID" readonly>
                           </div>
                           </div>

                           <div class="col-md-12"></div>

                           <div class="col-md-8">
                           <div class="form-group">
                           <label for="suppliercompanyname">Company Name <span class="requiredcolor">*</span></label>
                           <input type="text" class="form-control textCapitalize" id="suppliercompanyname" name="suppliercompanyname" value="{{$data->suppliercompanyname}}" placeholder="Enter company name" required>
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="suppliercompanytype">Company Type <span class="requiredcolor">*</span></label>
                           <select class="form-control" id="suppliercompanytype" name="suppliercompanytype" required>
                           <option value="" selected disabled>Select</option>
                           <option value="Sole Proprietorship" @if($data->suppliercompanytype=="Sole Proprietorship") selected @endif>Sole Proprietorship</option>
                           <option value="Partnership" @if($data->suppliercompanytype=="Partnership") selected @endif>Partnership</option>
                           <option value="LLP" @if($data->suppliercompanytype=="LLP") selected @endif>>LLP</option>
                           <option value="Private Limited" @if($data->suppliercompanytype=="Private Limited") selected @endif>Private Limited</option>
                           <option value="Public Limited" @if($data->suppliercompanytype=="Public Limited") selected @endif>Public Limited</option>
                           </select>
                           </div>
                           </div>

                           <div class="col-md-8">
                           <div class="form-group">
                           <label for="supplieraddress">Registered Address <span class="requiredcolor">*</span></label>
                           <input type="text" class="form-control textCapitalize" id="supplieraddress" name="supplieraddress" value="{{$data->supplieraddress}}" placeholder="Enter registered address" required>
                           <!--<textarea class="form-control" name="supplieraddress" placeholder="Registered Address"></textarea>-->
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <?php
                           $country=DB::table('countries')->where('name','=',$data->suppliercountry)->first();
                           $country_id=$country->id;
                           $state=DB::table('states')->where('name','=',$data->supplierstate)->first();
                           $state_id=$state->id;
                           $state_list=DB::table('states')->where('country_id','=',$country_id)->get();
                           $city_list=DB::table('city')->where('state_id','=',$state_id)->get();
                           ?>
                           <label for="suppliercountry">Country <span class="requiredcolor">*</span></label>
                           <select class="form-control" id="suppliercountry" onchange="get_states(this)" name="suppliercountry" required>
                           <option value="" selected disabled>Select</option>
                           @foreach($countries as $cont)
                           <option value="{{ $cont->name }}" c_id="{{ $cont->id }}" @if($cont->name==$data->suppliercountry) selected @endif >{{ $cont->name }}
                           </option>
                           @endforeach
                           </select>
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplierstate">State <span class="requiredcolor">*</span></label>
                           <select class="form-control st_values" id="supplierstate" name="supplierstate" onchange="getcitys(this)" required>
                           <option value="" selected disabled>Select</option>
                           @foreach($state_list as $cont)
                           <option value="{{ $cont->name }}" c_id="{{ $cont->id }}" @if($cont->name==$data->supplierstate) selected @endif>{{ $cont->name }}
                           </option>
                           @endforeach
                           </select>
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="suppliercity">City <span class="requiredcolor">*</span></label>
                           <select class="form-control ct_values" id="suppliercity" name="suppliercity" required>
                           <option value="" selected disabled>Select</option>
                           @foreach($city_list as $cont)
                           <option value="{{ $cont->name }}" c_id="{{ $cont->id }}" @if($cont->name==$data->suppliercity) selected @endif>{{ $cont->name }}
                           </option>
                           @endforeach
                           </select>
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplierpincode">Pin Code <span class="requiredcolor">*</span></label>
                           <input type="text" class="form-control" id="supplierpincode" name="supplierpincode" placeholder="Enter pin code" required value="{{$data->supplierpincode}}">
                           </div>
                           </div>

                           <div class="col-md-8">
                           <div class="form-group">
                           <label for="supplierservicetype">Services Provided <span class="requiredcolor">*</span></label>
                           <select class="form-control" id="supplierservicetype" name="supplierservicetype">
                           <option selected disabled>Select Services</option>
                           <option value="flight" @if($data->supplierservicetype=="flight") selected @endif>Flight</option>
                           <option value="accommodation" @if($data->supplierservicetype=="accommodation") selected @endif>Hotel</option>
                           <option value="home" @if($data->supplierservicetype=="home") selected @endif>Home</option>
                           <option value="visa" @if($data->supplierservicetype=="visa") selected @endif>Visa</option>
                           <option value="bus" @if($data->supplierservicetype=="bus") selected @endif>Bus</option>
                           <option value="train" @if($data->supplierservicetype=="train") selected @endif>Train</option>
                           <option value="forex" @if($data->supplierservicetype=="forex") selected @endif>Travel Insurance</option>
                           <option value="cruise" @if($data->supplierservicetype=="cruise") selected @endif>Cruise</option>
                           <option value="carrental" @if($data->supplierservicetype=="carrental") selected @endif>Car Rental</option>
                           <option value="tours" @if($data->supplierservicetype=="tours") selected @endif>Sightseeing</option>
                           <option value="travelinsurance" @if($data->supplierservicetype=="travelinsurance") selected @endif>Travel Insurance</option>
                           <option value="miscellaneous" @if($data->supplierservicetype=="miscellaneous") selected @endif>Miscellaneous</option>
                           </select>
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="suppliercurrency">Default Currency</label>
                           <select class="form-control" id="suppliercurrency" name="suppliercurrency">
                           <option selected disabled>Select Currency</option>
                           <option value="" @if($data->suppliercurrency=="") selected @endif></option>
                           </select>
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplieremployees">No of Employees</label>
                           <select class="form-control" id="supplieremployees" name="supplieremployees">
                           <option selected disabled>Select Employees</option>
                           @for($i=1;$i<=20;$i++)
                           <option value="{{ $i }}" @if($data->supplieremployees==$i) selected @endif>{{ $i }}</option>
                           @endfor
                           <option value="20+" @if($data->supplieremployees=="20+") selected @endif>20+</option>
                           </select>
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="suppliercontactperson">Contact Person <span class="requiredcolor">*</span></label>
                           <input type="text" class="form-control textCapitalize" id="suppliercontactperson" name="suppliercontactperson" value="{{$data->suppliercontactperson}}" placeholder="Enter contact person name">
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplierprimaryemail">Primary Email ID <span class="requiredcolor">*</span></label>
                           <input type="email" class="form-control textLowercase" id="supplierprimaryemail" name="supplierprimaryemail" value="{{$data->supplierprimaryemail}}" placeholder="Enter primary email id">
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="suppliersecondaryemail">Secondary Email ID</label>
                           <input type="email" class="form-control textLowercase" id="suppliersecondaryemail" name="suppliersecondaryemail" value="{{$data->suppliersecondaryemail}}" placeholder="Enter secondary email id">
                           </div>
                           </div>
                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="suppliermobile">Mobile No <span class="requiredcolor">*</span></label>
                           <input type="text" class="form-control" id="suppliermobile" name="suppliermobile" value="{{$data->suppliermobile}}" placeholder="Enter mobile number" >
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplieralternatemobile">Alternate Mobile No</label>
                           <input type="text" class="form-control" id="supplieralternatemobile" name="supplieralternatemobile" value="{{$data->supplieralternatemobile}}" placeholder="Enter alternate mobile number">
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplierofficenumber">Office Landline No</label>
                           <input type="text" class="form-control" id="supplierofficenumber" name="supplierofficenumber" value="{{$data->supplierofficenumber}}" placeholder="Enter office landline number">
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplierwebsite">Website Name <span class="requiredcolor">*</span></label>
                           <input type="text" class="form-control textLowercase" id="supplierwebsite" name="supplierwebsite" value="{{$data->supplierwebsite}}" placeholder="Enter website name">
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplierpannumber">PAN Number <span class="requiredcolor">*</span></label>
                           <input type="text" class="form-control textUowercase" id="supplierpannumber" name="supplierpannumber" value="{{$data->supplierpannumber}}" placeholder="Enter pan number">
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplierpanname">PAN Card Name<span class="requiredcolor">*</span></label>
                           <input type="text" class="form-control textCapitalize" id="supplierpanname" name="supplierpanname" value="{{$data->supplierpanname}}" placeholder="Enter name on the PAN Card">
                           </div>
                           </div>

                           <div class="col-md-12">
                           <div class="form-group">
                           <h4>GST Details</h4>
                           </div>
                           </div>
                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="suppliergstnumber">GST Number<span class="requiredcolor">*</span></label>
                           <input type="text" class="form-control textUowercase" id="suppliergstnumber" name="suppliergstnumber" value="{{$data->suppliergstnumber}}" placeholder="Enter GST number">
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="suppliergstname">GST Name <span class="requiredcolor">*</span></label>
                           <input type="text" class="form-control textCapitalize" id="suppliergstname" name="suppliergstname" value="{{$data->suppliergstname}}" placeholder="Enter GST name">
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="suppliergstemail">GST Email <span class="requiredcolor">*</span></label>
                           <input type="email" class="form-control textLowercase" id="suppliergstemail" name="suppliergstemail" value="{{$data->suppliergstemail}}" placeholder="Enter GST email id">
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="suppleiergstcontact">GST Contact Number <span class="requiredcolor">*</span></label>
                           <input type="text" class="form-control" id="suppleiergstcontact" name="suppleiergstcontact" value="{{$data->suppleiergstcontact}}" placeholder="Enter GST contact number">
                           </div>
                           </div>

                           <div class="col-md-8">
                           <div class="form-group">
                           <label for="suppliergstaddress">GST Address <span class="requiredcolor">*</span></label>
                           <input type="text" class="form-control textCapitalize" id="suppliergstaddress" name="suppliergstaddress" value="{{$data->suppliergstaddress}}" placeholder="Enter GST address">
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplieraccountscontactnumber">Accounts Contact Number</label>
                           <input type="text" class="form-control" id="supplieraccountscontactnumber" name="supplieraccountscontactnumber" value="{{$data->supplieraccountscontactnumber}}" placeholder="Enter accounts contact number">
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplieraccountsemail">Accounts Email ID</label>
                           <input type="email" class="form-control textLowercase" id="supplieraccountsemail" name="supplieraccountsemail" value="{{$data->supplieraccountsemail}}" placeholder="Enter accounts email id">
                           </div>
                           </div>

                           <div class="col-md-12">
                           <div class="form-group">
                           <h4>Bank Account Details</h4>
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplierbankname">Bank Name <span class="requiredcolor">*</span></label>
                           <input type="text" class="form-control textCapitalize" id="supplierbankname" name="supplierbankname" value="{{$data->supplierbankname}}" placeholder="Enter bank name" >
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplierbankaddress">Bank Address</label>
                           <input type="text" class="form-control textCapitalize" id="supplierbankaddress" name="supplierbankaddress" value="{{$data->supplierbankaddress}}" placeholder="Enter bank address">
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplierbankaccountname">Account Name <span class="requiredcolor">*</span></label>
                           <input type="text" class="form-control textCapitalize" id="supplierbankaccountname" name="supplierbankaccountname" value="{{$data->supplierbankaccountname}}" placeholder="Enter bank account name">
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplierbankaccountnumber">Account Number <span class="requiredcolor">*</span></label>
                           <input type="text" class="form-control" id="supplierbankaccountnumber" name="supplierbankaccountnumber" value="{{$data->supplierbankaccountnumber}}" placeholder="Enter bank account number">
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplierbankifsccode">IFSC Code <span class="requiredcolor">*</span></label>
                           <input type="text" class="form-control textUowercase" id="supplierbankifsccode" name="supplierbankifsccode" value="{{$data->supplierbankifsccode}}" placeholder="Enter ifsc code">
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplierupiid">UPI ID</label>
                           <input type="text" class="form-control textLowercase" id="supplierupiid" name="supplierupiid" value="{{$data->supplierupiid}}" placeholder="Enter upi id">
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplierbankcountry">Country <span class="requiredcolor">*</span></label>
                           <input type="text" class="form-control textCapitalize" id="supplierbankcountry" name="supplierbankcountry" value="{{$data->supplierbankcountry}}" placeholder="Enter country name">
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplierswiftcode">SWIFT Code</label>
                           <input type="text" class="form-control" id="supplierswiftcode" name="supplierswiftcode" value="{{$data->supplierswiftcode}}" placeholder="Enter swift Code">
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="suppliersorttcode">SORT Code</label>
                           <input type="text" class="form-control" id="suppliersorttcode" name="suppliersorttcode" value="{{$data->suppliersorttcode}}" placeholder="Sort code for U.K.">
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplierbsbcode">BSB Code</label>
                           <input type="text" class="form-control" id="supplierbsbcode" name="supplierbsbcode" value="{{$data->supplierbsbcode}}" placeholder="BSB code for Australia">
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplieribancode">IBAN Code</label>
                           <input type="text" class="form-control" id="supplieribancode" name="supplieribancode" value="{{$data->supplieribancode}}" placeholder="IBAN code for UK,Europe,UAE,Saudi Arabia,Bahrain">
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplierbankroutingnumber">Routing Number</label>
                           <input type="text" class="form-control" id="supplierbankroutingnumber" name="supplierbankroutingnumber" value="{{$data->supplierbankroutingnumber}}" placeholder="Enter routing number">
                           </div>
                           </div>

                           <div class="col-md-12">
                           <div class="form-group">
                           <label for="supplierotherinfo">Additional Information</label>
                           <input type="text" class="form-control textCapitalize" id="supplierotherinfo" name="supplierotherinfo" value="{{$data->supplierotherinfo}}" placeholder="Any other additional information">
                           </div>
                           </div>

                           <div class="col-md-12">
                           <div class="form-group">
                           <h4>Upload Documents</h4>
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplieridproof">Upload PAN Card <span class="requiredcolor">*</span> &ensp;<span class="color9B">(size < 2 mb)</span></label>
                           <input type="file" class="form-control" id="file" name="supplierpancard" onchange="Filevalidation()" />
                           @if($data->supplierpancard!="")
                           <br><img width="50" height="50" src="{{url('/public/uploads/supplier/'.$data->supplierpancard)}}">
                           @endif
                           <span id="size"></span>
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="suppliergstcertificate">Upload GST Certificate <span class="requiredcolor">*</span> &ensp;<span class="color9B">(size < 2 mb)</span></label>
                           <input type="file" class="form-control" id="file" name="suppliergstcertificate" onchange="Filevalidation()" />
                           @if($data->suppliergstcertificate!="")
                           <br><img width="50" height="50" src="{{url('/public/uploads/supplier/'.$data->suppliergstcertificate)}}">
                           @endif
                           <span id="size"></span>
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplieridproof">Upload ID Proof <span class="requiredcolor">*</span> &ensp;<span class="color9B">(size < 2 mb)</span></label>
                           <input type="file" class="form-control" id="file" name="supplieridproof" onchange="Filevalidation()" />
                           @if($data->supplieridproof!="")
                           <br><img width="50" height="50" src="{{url('/public/uploads/supplier/'.$data->supplieridproof)}}">
                           @endif
                           <span id="size"></span>
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplieraddressproof">Upload Address Proof <span class="requiredcolor">*</span> &ensp;<span class="color9B">(size < 2 mb)</span></label>
                           <input type="file" class="form-control" id="file" name="supplieraddressproof" onchange="Filevalidation()" />
                           @if($data->supplieraddressproof!="")
                           <br><img width="50" height="50" src="{{url('/public/uploads/supplier/'.$data->supplieraddressproof)}}">
                           @endif
                           <span id="size"></span>
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="supplierregistrationproof">Upload Registration Proof &ensp;<span class="color9B">(size < 2 mb)</span></label>
                           <input type="file" class="form-control" id="file" name="supplierregistrationproof" onchange="Filevalidation()" />
                           @if($data->supplierregistrationproof!="")
                           <br><img width="50" height="50" src="{{url('/public/uploads/supplier/'.$data->supplierregistrationproof)}}">
                           @endif
                           <span id="size"></span>
                           </div>
                           </div>

                           <div class="col-md-4">
                           <div class="form-group">
                           <label for="suppliercompanylogo">Upload Company Logo (Jpeg, Png) &ensp;<span class="color9B">(size < 3 mb)</span></label>
                           <input type="file" class="form-control" id="file" name="suppliercompanylogo" onchange="Filevalidation()" />
                           @if($data->suppliercompanylogo!="")
                           <br><img width="50" height="50" src="{{url('/public/uploads/supplier/'.$data->suppliercompanylogo)}}">
                           @endif
                           <span id="size"></span>
                           </div>
                           </div>

                           <div class="col-md-6">
                           <div class="form-group">
                           <label for="supplierfirstadditionalname">Additional Document-I</label>
                           <input type="text" class="form-control textCapitalize" id="supplierfirstadditionalname" name="supplierfirstadditionalname" placeholder="Enter name of the document" value="{{$data->supplierfirstadditionalname}}">
                           </div>
                           </div>

                           <div class="col-md-6">
                           <div class="form-group">
                           <label for="supplierfirstadditionaldocument">Upload Document-I &ensp;<span class="color9B">(size < 2 mb)</span></label>
                           <input type="file" class="form-control" id="file" name="supplierfirstadditionaldocument" onchange="Filevalidation()" />
                           @if($data->supplierfirstadditionaldocument!="")
                           <br><img width="50" height="50" src="{{url('/public/uploads/supplier/'.$data->supplierfirstadditionaldocument)}}">
                           @endif
                           <span id="size"></span>
                           </div>
                           </div>

                           <div class="col-md-6">
                           <div class="form-group">
                           <label for="suppliersecondadditionalname">Additional Document-II</label>
                           <input type="text" class="form-control textCapitalize" id="suppliersecondadditionalname" name="suppliersecondadditionalname" placeholder="Enter name of the document" value="{{$data->suppliersecondadditionalname}}">
                           </div>
                           </div>

                           <div class="col-md-6">
                           <div class="form-group">
                           <label for="suppliersecondadditionaldocument">Upload Document-II &ensp;<span class="color9B">(size < 2 mb)</span></label>
                           <input type="file" class="form-control" id="file" name="suppliersecondadditionaldocument" onchange="Filevalidation()" />
                           @if($data->suppliersecondadditionaldocument!="")
                           <br><img width="50" height="50" src="{{url('/public/uploads/supplier/'.$data->suppliersecondadditionaldocument)}}">
                           @endif
                           <span id="size"></span>
                           </div>
                           </div>

                           <div class="col-md-6">
                           <div class="form-group">
                           <label for="supplierstatus">Status <span class="requiredcolor">*</span></label>
                           <select class="form-control" name="supplierstatus" id="supplierstatus" required>
                           <option value="" selected disabled>Select</option>
                           <option value="enabled" @if($data->supplierstatus=="enabled") selected="selected" @endif>Enabled</option>
                           <option value="disabled" @if($data->supplierstatus=="disabled") selected="selected" @endif>Disabled</option>
                           </select>
                           </div>
                           </div>

                           <div class="col-md-12">
                              <div class="form-group text-center">
                                 <button type="submit" name="submit" id="form_submit" class="btn btn-primary location_add">Update</button>
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
               <!-- /.box-body -->
            </div>
         </div>
      </div>
   </section>
   <!-- /.content -->
</div>

<script src="https://code.jquery.com/jquery-2.2.4.js"></script>

@endsection

@section("custom_js_code_second")

<script>
$(document).ready(function () {
   // File validation function to check file size
   function Filevalidation() {
      const fi = document.getElementById('file');

      // Check if any file is selected
      if (fi && fi.files.length > 0) {
         for (let i = 0; i < fi.files.length; i++) {
            const fsize = fi.files[i].size;  // File size in bytes
            const fileSizeInKB = Math.round(fsize / 1024);  // Convert size to KB

            // Validate file size range
            if (fileSizeInKB >= 2048) {
               alert("File too big, please select a file less than 2MB.");
               return false;  // Prevent form submission
            } else if (fileSizeInKB < 100) {
               alert("File too small, please select a file greater than 100KB.");
               return false;  // Prevent form submission
            } else {
               $('#size').html('<b>' + fileSizeInKB + '</b> KB');
            }
         }
      }
      return true;  // Allow form submission if file size is valid
   }

   // Attach Filevalidation function to the form's submit event
   $('form#supplierform').on('submit', function (e) {
      if (!Filevalidation()) {
         e.preventDefault();  // Stop form submission if validation fails
      }
   });
});
</script>
<!-- /.content-wrapper -->
@endsection