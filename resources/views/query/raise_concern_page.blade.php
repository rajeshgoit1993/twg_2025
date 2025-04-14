@extends('layouts.master')

@section('custom_css_code')
    <!-- lead manager css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/backend/css/lead-manager.css') }}" />

    <!-- enquiry timeline CSS -->
    <link type="text/css" rel="stylesheet" href="{{ asset('/resources/assets/backend/css/enquiry-timeline.css') }}" />

    <!-- lead modal CSS -->
    <link type="text/css" rel="stylesheet" href="{{ asset('/resources/assets/backend/css/lead-validation.css') }}" />

    <!-- JS modal pop-up -->
    <link type="text/css" rel="stylesheet" href="{{ asset('/resources/assets/backend/css/modal-popup.css') }}" />

    <!-- search lead -->
    <link type="text/css" rel="stylesheet" href="{{ asset('/resources/assets/backend/css/search-form.css') }}" />
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box autoScroll">
                        <div class="box-header">
                            <h3 class="box-title">Raised Concerns</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            @if (\Session::has('message'))
                                <div class="alert alert-success">
                                    <ul>
                                        <li>{!! \Session::get('message') !!}</li>
                                    </ul>
                                </div>
                            @endif

                            <div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none">
                                <p>Concern Updated Successfully</p>
                            </div>

                            <div class="alert alert-danger error-contaier-parent-hotel" id="error-contaier-parent-hotel" style="display:none">
                                <ul class="error-contaier-hotel" id="error-contaier-hotel"></ul>
                            </div>

                            <div class="dashboard-outer-table">
                                <table id="concernTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="100">Query Reference</th>
                                            <th width="150">Guest Name</th>
                                            <th width="200">Concern Description</th>
                                            <th width="100">Status</th>
                                            <th width="150">Raised At</th>
                                            <th width="100">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($concerns) && $concerns->isNotEmpty())
                                            @foreach($concerns as $query)
                                                <tr>
                                                    <!-- Query Reference -->
                                                    <td>
                                                        <div class="dashboard-inner-table">
                                                            <p class="q-dtls">#{{ $query->query_reference }}</p>
                                                        </div>
                                                    </td>

                                                    <!-- Guest Name -->
                                                    <td>
                                                        <div class="dashboard-inner-table">
                                                            <p class="q-dtls">{{ $query->name ?? 'N/A' }}</p>
                                                        </div>
                                                    </td>

                                                    <!-- Concern Description -->
                                                    <td>
                                                        <div class="dashboard-inner-table">
                                                            <p class="q-dtls">{{ $query->description ?? 'No description available' }}</p>
                                                        </div>
                                                    </td>

                                                    <!-- Status -->
                                                    <td>
                                                        <div class="dashboard-inner-table">
                                                            @if($query->status == 0)
                                                                <p class="q-sendbox">Pending</p>
                                                            @elseif($query->status == 1)
                                                                <p class="q-acceptancebox">Open</p>
                                                            @else
                                                                <p class="q-rejectionbox">Closed</p>
                                                            @endif
                                                        </div>
                                                    </td>

                                                    <!-- Raised At -->
                                                    <td>
                                                        <div class="dashboard-inner-table">
                                                            <?php
                                                                $raised_at = date("d M Y, H:i:s", strtotime($query->created_at));
                                                            ?>
                                                            <p class="q-dtls textCenter">{{ $raised_at }}</p>
                                                        </div>
                                                    </td>

                                                    <!-- Action -->
                                                    <td>
                                                        <div class="btnContainer">
                                                            <button class="btn-q btn-viewlead edit-concern" data-id="{{ $query->id }}" data-toggle="modal">Edit</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6" class="text-center">No concerns available.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>

    <!-- Include modals if needed -->
    @include('query.query_modal.modal-popup.action-modal.edit-raised-concern')
@endsection

@section('custom_js_code')
    <!-- page script -->
    <script type="text/javascript" src='{{ asset("/resources/assets/backend/js/concern-raised.js") }}'></script>
@endsection