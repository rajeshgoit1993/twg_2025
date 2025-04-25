@extends('layouts.master')
@section('content')
<link type="text/css" rel="stylesheet" href="{{ asset('/resources/assets/backend/css/lead-validation.css') }}" />
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="makeflex aligncenter padding10">
                        <a href="{{ URL::to('/quote-pending') }}" class="btn btn-success apndRt20">
                            <i class="glyphicon glyphicon-arrow-left"></i> Back
                        </a>
                        <div class="box-header">
                            <h3 class="box-title">Create Quotation</h3>
                        </div>
                    </div>
                    
                    <div class="box-body" style="padding-top: 0px">
                        <div class="panel-body">

<?php 
$id = $data->id;
?>
@include('query.enquiryDetails.edit_enquiry')
                            <!-- Quote Lead Details Starts -->
                            <!-- @include('query.enquiryDetails.quoteLeadDetails') -->
                            <!-- Quote Lead Details Ends -->

                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    @if($allowCreateQuotation)
                                        <!-- Create Quotation -->
                                        <a href="{{ URL::to('quo_new/'.$data->id) }}">
                                            <button type="button" name="add" class="btn btn-success">Create Quotation</button>
                                        </a>
                                    @endif

                                    <!-- Import Quotation -->
                                    <a href="{{ URL::to('quo_copy/'.$data->id) }}">
                                        <button type="button" name="add" class="btn btn-success">Import Quotation</button>
                                    </a>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<!-- Hidden Base URL for JS -->
<div class="testing">
    <input type="hidden" value="{{url('/')}}" id="test">
</div>

<!-- JS Scripts -->
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

@endsection
