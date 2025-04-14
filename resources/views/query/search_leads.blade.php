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
                            <!-- query-list page -->
                            <h3 class="box-title">Search Lead</h3>
                        </div>
                        <!-- /.box-header -->

                        <!-- search lead form -->
                        @include('query.search_lead_form')

                        <div class="box-body">
                            @if (\Session::has('message'))
                                <div class="alert alert-success">
                                    <ul>
                                        <li>{!! \Session::get('message') !!}</li>
                                    </ul>
                                </div>
                            @endif

                            <div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none">
                                <p>Query Deleted Successfully</p>
                            </div>

                            <div class="alert alert-danger error-contaier-parent-hotel" id="error-contaier-parent-hotel" style="display:none">
                                <ul class="error-contaier-hotel" id="error-contaier-hotel"></ul>
                            </div>

                            <div class="dashboard-outer-table">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <!-- quote reference no -->
                                            <th width="175" style="min-width: 125px;">Reference No</th>
                                            <!-- guest details -->
                                            <th>Guest Name,<br>Mobile No & Email id</th>
                                            <!-- travel date & nationality -->
                                            <th width="200" style="min-width: 150px;">Travel Date,<br>Guests & Nationality</th>
                                            <!-- travel destination -->
                                            <th width="200">Destination & <br>Package Name</th>
                                            <!-- lead status -->
                                            <th width="200">Lead Status</th>
                                            <!-- quote status -->
                                            <th width="100">Quote status</th>
                                            <!-- action -->
                                            <th width="100">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = "1"; ?>
                                        @foreach($data as $key => $query)
                                            @if(CustomHelpers::get_query_field($query->query_reference, 'status') == '' || 
                                                CustomHelpers::get_query_field($query->query_reference, 'status') == "quote_sent" || 
                                                CustomHelpers::get_query_field($query->query_reference, 'status') == "lead_follow_up" || 
                                                CustomHelpers::get_query_field($query->query_reference, 'status') == "process_booking" || 
                                                CustomHelpers::get_query_field($query->query_reference, 'status') == "payment_follow_up" || 
                                                CustomHelpers::get_query_field($query->query_reference, 'status') == "under_cancellation" || 
                                                CustomHelpers::get_query_field($query->query_reference, 'status') == "voucher_issue" || 
                                                CustomHelpers::get_query_field($query->query_reference, 'status') == "voucher_issued" || 
                                                CustomHelpers::get_query_field($query->query_reference, 'status') == "issue_voucher" || 
                                                CustomHelpers::get_query_field($query->query_reference, 'status') == "tour_cancelled" || 
                                                CustomHelpers::get_query_field($query->query_reference, 'status') == "process_refund" || 
                                                CustomHelpers::get_query_field($query->query_reference, 'status') == "refund_processed" || 
                                                CustomHelpers::get_query_field($query->query_reference, 'status') == "refund_under_process")
                                                <tr>
                                                    <!-- enquiry & quote reference no -->
                                                    <td>
                                                        <!-- enquiry reference no -->
                                                        <div class="dashboard-inner-table">
                                                            <div><u><h5>Enquiry Reference No</h5></u></div>
                                                            <p class="q-dtls">{{ $query->enquiry_ref_no ?? 'No enquiry id available.' }}</p>
                                                            <p class="q-dtls">{{ $query->service_type ?? 'No service type available.' }}</p>
                                                            <p class="q-dtls">{{ $query->channel_type ?? 'No channel type available.' }}</p>
                                                        </div>

                                                        <!-- quote reference no -->
                                                        <div class="dashboard-inner-table">
                                                            <div><u><h5>Quote Reference No</h5></u></div>
                                                            <p class="q-dtls">{{ $query->quo_ref ?? 'No quote id available.' }}</p>
                                                        </div>
                                                    </td>

                                                    <!-- guest details -->
                                                    <td>
                                                        <div class="dashboard-inner-table">
                                                            <div><u><h5>Guest Details</h5></u></div>
                                                            <p class="q-dtls">{{ $query->name ?? 'N/A' }}</p>
                                                            <?php 
                                                                $loged_user = Sentinel::getUser();
                                                            ?>
                                                            @if($loged_user->lock_before_quote_send == '')
                                                                @if(isset($query->mobile) && $query->mobile != "")
                                                                    <p class="q-dtls">{{ $query->mobile }}</p>
                                                                @endif
                                                                <p class="q-dtls">{{ $query->email ?? 'N/A' }}</p>
                                                            @else
                                                                @if(isset($query->mobile) && $query->mobile != "")
                                                                    <p class="q-dtls">{{ CustomHelpers::mask_mobile_no($query->mobile) }}</p>
                                                                @endif
                                                                <p class="q-dtls">{{ CustomHelpers::partiallyHideEmail($query->email ?? 'N/A') }}</p>
                                                            @endif
                                                        </div>
                                                    </td>

                                                    <!-- travel date, no of guests & nationality -->
                                                    <td>
                                                        <div class="dashboard-inner-table">
                                                            <div><u><h5>Travel Details</h5></u></div>
                                                            <!-- travel date -->
                                                            <p class="q-dtls">
                                                                @if(isset($query->date_arrival) && $query->date_arrival != "")
                                                                    <?php
                                                                        $date_arrival = $query->date_arrival;
                                                                        $date_arrival = str_replace('/', '-', $date_arrival);
                                                                        $exploded = explode("-", $date_arrival);
                                                                        $exploded = array_reverse($exploded);
                                                                        $newFormat = array_map('trim', $exploded);
                                                                        $newFormat = implode("-", $newFormat);
                                                                        $newFormat = date("d M Y", strtotime($newFormat));
                                                                        echo $newFormat;
                                                                    ?>
                                                                @else
                                                                    N/A
                                                                @endif
                                                            </p>

                                                            <!-- no of guests -->
                                                            <p class="q-dtls">
                                                                <?php
                                                                    $adult = 0;
                                                                    $child_with_bed = 0;
                                                                    $child_without_bed = 0;
                                                                    $infant = 0;

                                                                    if (isset($query->quote1_number_of_adult) && $query->quote1_number_of_adult != '' && $query->quote1_number_of_adult != 0) {
                                                                        $adult += (int) $query->quote1_number_of_adult;
                                                                    }
                                                                    if (isset($query->extra_adult) && $query->extra_adult != '' && $query->extra_adult != 0) {
                                                                        $adult += (int) $query->extra_adult;
                                                                    }
                                                                    if (isset($query->solo_traveller) && $query->solo_traveller != '' && $query->solo_traveller != 0) {
                                                                        $adult += (int) $query->solo_traveller;
                                                                    }
                                                                    if (isset($query->child_with_bed) && $query->child_with_bed != '' && $query->child_with_bed != 0) {
                                                                        $child_with_bed += (int) $query->child_with_bed;
                                                                    }
                                                                    if (isset($query->child_without_bed) && $query->child_without_bed != '' && $query->child_without_bed != 0) {
                                                                        $child_without_bed += (int) $query->child_without_bed;
                                                                    }
                                                                    if (isset($query->infant) && $query->infant != '' && $query->infant != 0) {
                                                                        $infant += (int) $query->infant;
                                                                    }
                                                                ?>
                                                                @if($adult != 0)
                                                                    @php $adultText = $adult == 1 ? 'Adult' : 'Adults'; @endphp
                                                                    {{$adult}} {{$adultText}}
                                                                @endif
                                                                @if($child_with_bed != 0)
                                                                    @php $childWithBedText = $child_with_bed == 1 ? 'Child (with bed)' : 'Children (with bed)'; @endphp
                                                                    + {{$child_with_bed}} {{$childWithBedText}}
                                                                @endif
                                                                @if($child_without_bed != 0)
                                                                    @php $childWithoutBedText = $child_without_bed == 1 ? 'Child (without bed)' : 'Children (without bed)'; @endphp
                                                                    + {{$child_without_bed}} {{$childWithoutBedText}}
                                                                @endif
                                                                @if($infant != 0)
                                                                    @php $infantText = $infant == 1 ? 'Infant' : 'Infants'; @endphp
                                                                    + {{$infant}} {{$infantText}}
                                                                @endif
                                                                @if($adult == 0 && $child_with_bed == 0 && $child_without_bed == 0 && $infant == 0)
                                                                    No guests specified
                                                                @endif
                                                            </p>

                                                            <!-- nationality -->
                                                            <p class="q-dtls">{{ $query->nationality ?? 'N/A' }}</p>
                                                        </div>
                                                    </td>

                                                    <!-- travel destination -->
                                                    <td>
                                                        <div class="dashboard-inner-table">
                                                            <!-- destination -->
                                                            @if(is_numeric((int) $query->query_reference))
                                                                <div><u><h5>Destination</h5></u></div>
                                                                @php  
                                                                    $packageId = (int) CustomHelpers::get_query_field((int)$query->query_reference, 'packageId');
                                                                    $cities = CustomHelpers::get_master_table_data('rt_packages', 'id', $packageId, 'city');
                                                                    if ($cities === false || $cities === null || !is_string($cities)) {
                                                                        $cities = [];
                                                                    } else {
                                                                        try {
                                                                            $cities = unserialize($cities);
                                                                            if ($cities === false && $cities !== 'b:0;') {
                                                                                $cities = [];
                                                                            }
                                                                        } catch (Exception $e) {
                                                                            $cities = [];
                                                                        }
                                                                    }
                                                                    if (!is_array($cities)) {
                                                                        $cities = [];
                                                                    }
                                                                @endphp
                                                                @if(!empty($cities))
                                                                    <ul class="q-dtls">
                                                                        @foreach($cities as $c)
                                                                            <li>{{ $c }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                @elseif(!empty($query->destinations))
                                                                    <ul class="q-dtls">
                                                                        <li>{{ $query->destinations }}</li>
                                                                    </ul>
                                                                @else
                                                                    <p class="q-dtls">No destination available</p>
                                                                @endif
                                                            @else
                                                                <p class="q-dtls">{{ $query->destinations ?? 'No destinations available.' }}</p>
                                                            @endif

                                                            <!-- tour name & link -->
                                                            @if(is_numeric((int) CustomHelpers::get_query_field((int)$query->query_reference, 'packageId')))
                                                                @php
                                                                    $packageId = (int) CustomHelpers::get_query_field((int)$query->query_reference, 'packageId');
                                                                    $packageName = $query->package_name ?? '';
                                                                    $href_id = CustomHelpers::custom_encrypt($packageId);
                                                                    $form_action = url('/Holidays/' . str_slug($packageName)) . '?package_id=' . $href_id;
                                                                @endphp
                                                                @if(!empty($packageName))
                                                                    <div class="pdngTop7"><u><h5>Tour Name</h5></u></div>
                                                                    <p class="q-dtls">
                                                                        <a href="{{ $form_action }}" target="_blank">
                                                                            {{ $packageName }}
                                                                        </a>
                                                                    </p>
                                                                @else
                                                                    <div class="pdngTop7"><u><h5>Source</h5></u></div>
                                                                    <p class="q-dtls">Quick enquiry</p>
                                                                @endif
                                                            @else
                                                                <p class="q-dtls">{{ $query->packageId ?? 'N/A' }}</p>
                                                            @endif
                                                        </div>
                                                    </td>

                                                    <!-- lead status -->
                                                    <td id="{{ $query->query_reference }}">
                                                        <div class="dashboard-inner-table">
                                                            <u><h5>Current Status</h5></u>
                                                            <table>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <p class="q-user-name" value="{{ CustomHelpers::get_query_field($query->query_reference, 'status') }}">{{ CustomHelpers::get_query_field($query->query_reference, 'status') ?? 'N/A' }}</p>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                        <!-- assigned user -->
                                                        <?php
                                                            $user_data = DB::table('users')
                                                                ->where('id', $query->assign_id ?? 0)
                                                                ->first();
                                                        ?>
                                                        @if($user_data)
                                                            <div class="dashboard-inner-table">
                                                                <u><h5>Assigned User</h5></u>
                                                                <table>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <p class="q-user-name">{{ $user_data->first_name }} {{ $user_data->last_name }}</p>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        @endif
                                                    </td>

                                                    <!-- quote status -->
                                                    <td id="{{ $query->query_reference }}">
                                                        <div class="dashboard-inner-table">
                                                            <u><h5>Quote Viewed</h5></u>
                                                            <table>
                                                                <tbody>
                                                                    <tr class="makeflex">
                                                                        <td class="flexOne">
                                                                            @if(($query->send_option ?? '0') == '0' && ($query->accept_status ?? '0') == '0')
                                                                                <p class="q-sendbox">Not Sent</p>
                                                                            @elseif(($query->send_option ?? '0') == '1' && ($query->accept_status ?? '0') == '0')
                                                                                <p class="q-noresponsebox">No Response</p>
                                                                            @elseif(($query->send_option ?? '0') == '1' && ($query->accept_status ?? '0') == '1')
                                                                                <p class="q-acceptancebox">Quote Accepted</p>
                                                                            @elseif(($query->send_option ?? '0') == '0' && ($query->accept_status ?? '0') == '1')
                                                                                <p class="q-acceptancebox">Quote Accepted</p>
                                                                            @elseif(($query->send_option ?? '0') == '1' && ($query->accept_status ?? '0') == '2')
                                                                                <p class="q-rejectionbox">Quote Rejected</p>
                                                                            @elseif(($query->send_option ?? '0') == '0' && ($query->accept_status ?? '0') == '2')
                                                                                <p class="q-rejectionbox">Quote Rejected</p>
                                                                            @endif
                                                                        </td>
                                                                        <td class="flexOne">
                                                                            @if(($query->quote_view ?? '0') == '0')
                                                                                <p class="q-responsebox">Not Viewed</p>
                                                                            @else
                                                                                <p class="q-responsebox">Viewed</p>
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                        <div class="dashboard-inner-table">
                                                            <div><u><h5>Enquiry Timeline</h5></u></div>
                                                            <table>
                                                                <tr>
                                                                    <td>
                                                                        <div class="btnContainer">
                                                                            <button class="btn-backend-main btnInfo view_history" data-id="{{ $query->query_reference }}">View History</button>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </td>

                                                    <!-- lead action -->
                                                    <td>
                                                        <!-- view quote -->
                                                        <input type="hidden" class="unique_code" value="{{ CustomHelpers::custom_encrypt($query->unique_code ?? '') }}">
                                                        <a href="{{ url('/quotes/'.($query->unique_code ?? '')) }}" target="_blank">
                                                            <div class="btnContainer">
                                                                <button type="submit" class="btn-q btn-view-quote" data-id="{{ $query->id ?? '' }}">View Quote</button>
                                                            </div>
                                                        </a>

                                                        <!-- view lead -->
                                                        <div class="btnContainer">
                                                            <button class="btn-q btn-viewlead open-enquiryModal" data-id="{{ $query->query_reference }}" data-toggle="modal">View Lead</button>
                                                        </div>

                                                        <!-- guest requests -->
                                                        <?php 
                                                            $check_raise_concern = DB::table('quote_raise_concern')
                                                                ->where('query_reference', (int)$query->query_reference)
                                                                ->get();
                                                            $pending = DB::table('quote_raise_concern')
                                                                ->where([['query_reference', (int)$query->query_reference], ['status', 0]])
                                                                ->get();
                                                            $open = DB::table('quote_raise_concern')
                                                                ->where([['query_reference', (int)$query->query_reference], ['status', 1]])
                                                                ->get();

                                                            if (count($pending) > 0) {
                                                                $btn_class = 'btn-request-pending';
                                                                $btn_name = 'Pending Requests';
                                                            } elseif (count($pending) == 0 && count($open) > 0) {
                                                                $btn_class = 'btn-request-open';
                                                                $btn_name = 'Active Requests';
                                                            } else {
                                                                $btn_class = 'btn-request-closed';
                                                                $btn_name = 'View Requests';
                                                            }
                                                        ?>
                                                        @if(count($check_raise_concern) > 0)
                                                            <button class="btn-q {{ $btn_class }} view_raise raise_btn_class{{ (int)$query->query_reference }}" data-id="{{ (int)$query->query_reference }}">
                                                                {{ $btn_name }}
                                                            </button>
                                                        @endif

                                                        <!-- lead date & time -->
                                                        <div class="dashboard-inner-table">
                                                            <u><h5>Lead Generated</h5></u>
                                                            <?php
                                                                $lead_date_time = date("d M Y, H:i:s", strtotime($query->created_at ?? now()));
                                                            ?>
                                                            <p class="q-dtls textCenter">{{ $lead_date_time }}, ({{ date('D', strtotime($query->created_at ?? now())) }})</p>
                                                        </div>

                                                        <!-- lead last update date & time -->
                                                        <div class="dashboard-inner-table">
                                                            <u><h5>Lead Last updated</h5></u>
                                                            <?php
                                                                $last_updated_at = date("d M Y, H:i:s", strtotime($query->updated_at ?? now()));
                                                            ?>
                                                            <p class="q-dtls textCenter">{{ $last_updated_at }}, ({{ date('D', strtotime($query->created_at ?? now())) }})</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
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

    <div class="testing">
        <input type="hidden" value="{{ url('/') }}" name="" id="test">
    </div>

    <!-- Lead Action starts -->
    @include('query.query_modal.modal-popup.action-modal.view-enquiry-details')
    @include('query.query_modal.modal-popup.action-modal.view-enquiry-timeline')
    @include('query.query_modal.modal-popup.action-modal.edit-raised-concern')
@endsection

@section('custom_js_code')
    <!-- page script -->
    <script type="text/javascript" src='{{ asset("/resources/assets/backend/js/concern-raised.js") }}'></script>
    <script type="text/javascript" src='{{ asset("/resources/assets/backend/js/view-history-view-lead.js") }}'></script>
@endsection