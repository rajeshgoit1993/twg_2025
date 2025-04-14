@extends('layouts.master')
@section('title', 'Create Quote')

@section('custom_css_code')
    <!-- Create quote CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/create-quote.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
    <?php
        $condition_data = '';
        $difference = 0;
        if (!empty($data->date_arrival)) {
            try {
                $dept_date = str_replace(' ', '', $data->date_arrival);
                $dept_date = str_replace('/', '-', $dept_date);
                $condition_data = date('m/d/Y', strtotime($dept_date));
                $dept_date = strtotime($dept_date);
                $now = strtotime('now');
                $difference = ($dept_date - $now) / (60 * 60 * 24);
                $difference = (int)$difference;
                if ($dept_date <= $now) {
                    $difference = 0;
                }
            } catch (\Exception $e) {
                $condition_data = '';
                $difference = 0;
            }
        }
    ?>
    <input type="hidden" id="condition_data" name="condition_data" value="{{ $condition_data }}">

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="flexCenter pdng10">
                        <a href="{{ route('quote.pending') }}">
                            <button class="btnBack">Back</button>
                        </a>
                        <div class="box-header">
                            <h3 class="box-title">Create Quotation</h3>
                        </div>
                    </div>
                    <div class="quoteCont makeflex flex-column">
                        <div class="navQuoteBar">
                            <ul class="quoteType">
                                <li class="tablinks quoteTab active" id="defaultOpen" data-tab="quote1">
                                    <span>Quote 1</span>
                                </li>
                                <li class="tablinks quoteTab" data-tab="quote2">
                                    <span>Quote 2</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Tab content -->
                        <div class="tabcontent" id="quote1" style="display: block;">
                            @include('query.quotation.quote1')
                        </div>
                        <div class="tabcontent" id="quote2" style="display: none;">
                            @include('query.quotation.quote2')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Hidden input for base URL -->
<div class="testing">
    <input type="hidden" value="{{ url('/') }}" name="base_url" id="base_url">
</div>

<!-- Supplier modal remarks -->
<div class="modal fade" id="supplier" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content borderRadius5">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <input type="hidden" name="book_id" value="" id="bookId">
                <h4 class="modal-title">Supplier Remarks</h4>
            </div>
            <form action="#" method="post" id="enq_data" name="enq_data">
                @csrf
                <div class="modal-body custom_border" id="supplier_body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success supplier_remarks" supplier_remarks_id="" supplier_attr="">Apply</button>
                    <button type="button" class="btn btn-default color4a" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('custom_js_code_second')
    <script type="text/javascript" src="{{ asset('assets/js/packages/create-edit-quote.js') }}"></script>
@endsection