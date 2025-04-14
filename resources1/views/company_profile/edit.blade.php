@extends('layouts.master')
@section('content')
<style>
  .error{color: red}
   .bor_cen
         {
         border-top:1px solid lightgray;
         border-bottom:1px solid lightgray;
         padding: 5px 10px

         }
    .bor
         {
          border:1px solid lightgray;
          padding: 5px 10px;
          cursor: pointer;

         }
     .checkbox_spn
         {
          margin-right: 10px;
          position: relative;
          top: -1px;
          margin-left: 4px;

         }   
        
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <!-- Main content -->
  <section class="content">
  <div class="row">
  <div class="col-md-12">
  <div class="box">

  <div class="box-header">
  <div class="add">
    <a href="{{URL::to('/Company-Profile')}}" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"> </i> Back</a>
    </div>
  <h3 class="box-title">Edit Company Profile</h3>
  </div>
            <!-- /.box-header -->
  <div class="box-body">
  <!---->
  <form action="{{URL::to('/company_profile_update')}}" method="Post" id="enquiry_form" enctype="multipart/form-data">
    {{csrf_field()}}
    <input type="hidden" name="id" value="{{$data->id}}">
<div class="alert alert-success" id="success-contaier" style="display:none">
   <p>Thanks You! Your query has been submitted.</p>
</div>


<div class="row">


<div class="col-md-6">
   <div class="form-group">
    <label for="company_name">Company Name:</label>
    <input type="text" class="form-control" id="company_name" placeholder="Company Name" name="company_name" value="{{$data->company_name}}">
  </div>
</div>
<div class="col-md-6"> 
  <div class="form-group">
    
  </div></div>
<div class="col-md-12">
   <div class="form-group">
    <label for="address">Registered Address:</label>
   <textarea class="form-control" name="address" placeholder="Registered Address">{{$data->address}}</textarea>
  </div>
</div>
<div class="col-md-4">
   <div class="form-group">
    <label for="City">City:</label>
    <input type="text" class="form-control" placeholder="City" name="city" value="{{$data->city}}">
  </div>
</div>
<div class="col-md-4">
   <div class="form-group">
    <label for="state">State:</label>
    <input type="text" class="form-control" id="state" name="state" placeholder="State" value="{{$data->state}}">
  </div>
</div>
<div class="col-md-4">
   <div class="form-group">
    <label for="country">Country:</label>
    <input type="text" class="form-control" id="country" placeholder="Country" name="country" value="{{$data->country}}">
  </div>
</div>
<div class="col-md-4">
   <div class="form-group">
    <label for="pin">Pin Code:</label>
    <input type="text" class="form-control" id="pin" placeholder="Pin Code" name="pin" value="{{$data->pin}}">
  </div>
</div>
<div class="col-md-4">
   <div class="form-group">
    <label for="company_type">Company Type:</label>
    <select class="form-control" name="company_type" id="company_type">
  <option value="Sole Proprietorship" @if($data->company_type=="Sole Proprietorship") selected @endif>Sole Proprietorship</option>
  <option value="Partnership" @if($data->company_type=="Partnership") selected @endif>Partnership</option>
  <option value="LLP" @if($data->company_type=="LLP") selected @endif>LLP</option>
  <option value="Private Limited" @if($data->company_type=="Private Limited") selected @endif>Private Limited</option>
  <option value="Public Limited" @if($data->company_type=="Public Limited") selected @endif>Public Limited</option>
    </select>
  </div>
</div>
<div class="col-md-4">
   <div class="form-group">
    <label for="email">No of Employees:</label>
    <select class="form-control" name="no_of_emp" id="no_of_emp">
      <option selected="" disabled> --Choose--</option>
      @for($i=1;$i<=20;$i++)
  <option value="{{ $i }}" @if($data->no_of_emp==$i) selected @endif>{{ $i }}</option>   
  @endfor
  <option value="20+" @if($data->no_of_emp=="20+") selected @endif>20+</option> 
    </select>
  </div>
</div>
<div class="col-md-4">
   <div class="form-group">
    <label for="contact_person">Contact Person:</label>
    <input type="text" class="form-control" id="contact_person" name="contact_person" placeholder="Contact Person" value="{{$data->contact_person}}">
  </div>
</div>
<div class="col-md-4">
   <div class="form-group">
    <label for="office_no">Office Landline No:</label>
    <input type="text" class="form-control" id="office_no" placeholder="Office Landline No" name="office_no" value="{{$data->office_no}}">
  </div>
</div>
<div class="col-md-4">
   <div class="form-group">
    <label for="mobile_no">Mobile No:</label>
    <input type="text" class="form-control" id="mobile_no" placeholder="Mobile No" name="mobile_no" value="{{$data->mobile_no}}">
  </div>
</div>
<div class="col-md-4">
   <div class="form-group">
    <label for="alternate_no">Alternate Mobile No:</label>
    <input type="text" class="form-control" id="alternate_no" placeholder="Alternate Mobile No" name="alternate_no" value="{{$data->alternate_no}}">
  </div>
</div>
<div class="col-md-4">
   <div class="form-group">
    <label for="primary_email">Primary Email ID:</label>
    <input type="email" class="form-control" id="primary_email" name="primary_email" placeholder="Primary Email ID" value="{{$data->primary_email}}">
  </div>
</div>
<div class="col-md-4">
   <div class="form-group">
    <label for="secondary_email">Secondary Email ID:</label>
    <input type="email" class="form-control" id="secondary_email" name="secondary_email" placeholder="Secondary Email ID" value="{{$data->secondary_email}}">
  </div>
</div>
<div class="col-md-4">
   <div class="form-group">
    <label for="website">Website:</label>
    <input type="text" class="form-control" id="website" name="website" placeholder="Website" value="{{$data->website}}">
  </div>
</div>
<div class="col-md-4">
   <div class="form-group">
    <label for="facebook_link">Facebook Link:</label>
    <input type="text" class="form-control" id="facebook_link" placeholder="Facebook Link" name="facebook_link" value="{{$data->facebook_link}}">
  </div>
</div>
<div class="col-md-4">
   <div class="form-group">
    <label for="twiter">Twitter Link:</label>
    <input type="text" class="form-control" id="twiter" placeholder="Twitter Link" name="twiter" value="{{$data->twiter}}">
  </div>
</div>
<div class="col-md-4">
   <div class="form-group">
    <label for="instagram">Instagram Link:</label>
    <input type="text" class="form-control" id="instagram" placeholder="Instagram Link" name="instagram" value="{{$data->instagram}}">
  </div>
</div>
<div class="col-md-4">
   <div class="form-group">
    <label for="other_social_link">Other Social Link:</label>
    <input type="text" class="form-control" id="other_social_link" name="other_social_link" placeholder="Other Social Link" value="{{$data->other_social_link}}">
  </div>
</div>
<div class="col-md-4">
   <div class="form-group">
    <label for="pan">PAN Number:</label>
    <input type="text" class="form-control" id="pan" name="pan" placeholder="PAN Number" value="{{$data->pan}}">
  </div>
</div>
<div class="col-md-4">
   <div class="form-group">
    <label for="name_of_pan">Name on the PAN Card:</label>
    <input type="text" class="form-control" id="name_of_pan" placeholder="Name on the PAN Card" name="name_of_pan" value="{{$data->name_of_pan}}">
  </div>
</div>
<div class="col-md-4">
   <div class="form-group">
    <label for="gst_no">GST No.:</label>
    <input type="text" class="form-control" id="gst_no" placeholder="GST No." name="gst_no" value="{{$data->gst_no}}">
  </div>
</div>
<div class="col-md-4">
   <div class="form-group">
    <label for="gst_name">GST Name:</label>
    <input type="text" class="form-control" id="gst_name" placeholder="GST Name" name="gst_name" value="{{$data->gst_name}}">
  </div>
</div>
<div class="col-md-4">
   <div class="form-group">
    <label for="gst_email">GST Email:</label>
    <input type="email" class="form-control" id="gst_email" placeholder="GST Email" name="gst_email" value="{{$data->gst_email}}">
  </div>
</div>
<div class="col-md-4">
   <div class="form-group">
    <label for="gst_contact">GST Contact Number:</label>
    <input type="text" class="form-control" id="gst_contact" placeholder="GST Contact Number" name="gst_contact" value="{{$data->gst_contact}}">
  </div>
</div>
<div class="col-md-4">
   <div class="form-group">
    <label for="gst_address">GST Address:</label>
    <input type="text" class="form-control" id="gst_address" placeholder="GST Address" name="gst_address" value="{{$data->gst_address}}">
  </div>
</div>
<div class="col-md-4">
   <div class="form-group">
    <label for="account_dept_no">Accounts Dept. Contact No.:</label>
    <input type="text" class="form-control" id="account_dept_no" placeholder="Accounts Dept. Contact No." name="account_dept_no" value="{{$data->account_dept_no}}">
  </div>
</div>
<div class="col-md-4">
   <div class="form-group">
    <label for="account_dept_email">Accounts Dept. Email ID:</label>
    <input type="email" class="form-control" id="account_dept_email" placeholder="Accounts Dept. Email ID" name="account_dept_email" value="{{$data->account_dept_email}}">
  </div>
</div>
<div class="col-md-4">
   <div class="form-group">
    <label for="logo">Company Logo (JPEG, PNG):</label>
    @if($data->logo!="")
           <br> <img src="{{url('/public/uploads/company_profile/'.$data->logo)}}" style="width: 100px"><br>
    @endif
    <input type="file" class="form-control" id="logo"  name="logo">
  </div>
</div>

<div class="col-md-4">
   <div class="form-group">
    <label for="pan_card">PAN Card:</label>
    @if($data->pan_card!="")
            <br><img src="{{url('/public/uploads/company_profile/'.$data->pan_card)}}" style="width: 100px"><br>
               @endif
    <input type="file" class="form-control" id="pan_card"  name="pan_card">
  </div>
</div>
<div class="col-md-4">
   <div class="form-group">
    <label for="gst_certificate">GST Certificate:</label>
    @if($data->gst_certificate!="")
           <br> <img src="{{url('/public/uploads/company_profile/'.$data->gst_certificate)}}" style="width: 100px">
            <br>   @endif
    <input type="file" class="form-control" id="gst_certificate"  name="gst_certificate">
  </div>
</div>
<div class="col-md-4">
   <div class="form-group">
    <label for="id_proof">ID Proof:</label>
    @if($data->id_proof!="")
           <br> <img src="{{url('/public/uploads/company_profile/'.$data->id_proof)}}" style="width: 100px"><br>
               @endif
    <input type="file" class="form-control" id="id_proof"  name="id_proof">
  </div>
</div>
<div class="col-md-4">
   <div class="form-group">
    <label for="address_proof">Address Proof:</label>
    @if($data->address_proof!="")
            <br><img src="{{url('/public/uploads/company_profile/'.$data->address_proof)}}" style="width: 100px"><br>
               @endif
    <input type="file" class="form-control" id="address_proof"  name="address_proof">
  </div>
</div>
<div class="col-md-4">
   <div class="form-group">
    <label for="registration_proof">Registration Proof:</label>
    @if($data->registration_proof!="")
           <br> <img src="{{url('/public/uploads/company_profile/'.$data->registration_proof)}}" style="width: 100px"><br>
               @endif
    <input type="file" class="form-control" id="registration_proof"  name="registration_proof">
  </div>
</div>
<div class="col-md-6">
   <div class="form-group">
    <label for="other_first_name">Name of the Document:</label>
    <input type="text" class="form-control" id="other_first_name" placeholder="Name of the Document" name="other_first_name" value="{{$data->other_first_name}}">
  </div>
</div>
<div class="col-md-6">
   <div class="form-group">
    <label for="other_first_image">Upload:</label>
     @if($data->other_first_image!="")
           <br> <img src="{{url('/public/uploads/company_profile/'.$data->other_first_image)}}" style="width: 100px"><br>
               @endif
    <input type="file" class="form-control" id="other_first_image"  name="other_first_image">
  </div>
</div>
<div class="col-md-6">
   <div class="form-group">
    <label for="other_second_name">Name of the Document:</label>
    <input type="text" class="form-control" id="other_second_name" placeholder="Name of the Document" name="other_second_name" value="{{$data->other_second_name}}">
  </div>
</div>
<div class="col-md-6">
   <div class="form-group">
    <label for="other_second_image">Upload:</label>
    @if($data->other_second_image!="")
            <br><img src="{{url('/public/uploads/company_profile/'.$data->other_second_image)}}" style="width: 100px"><br>
               @endif
    <input type="file" class="form-control" id="other_second_image"  name="other_second_image">
  </div>
</div>

<!---->







  </div>
      
       
</div>

<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-8">
     <button type="submit" name="submit" id="form_submit" class="btn btn-danger btn-lg">Save 
  <i class="fa  fa-arrow-right"></i>
                            
  </button>

  </div>
</div>

<div class="modal-footer">


</form>


  <!---->

  </div>
  <!-- /.box-body -->
  </div>
  </div>
  </div>
  </section>
  <!-- /.content -->
  </div>
  <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
  
  <!-- /.content-wrapper -->
@endsection