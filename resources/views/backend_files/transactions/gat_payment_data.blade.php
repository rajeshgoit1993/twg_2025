<table class="table">
    <tr>
        <td><span style="display:block;font-weight: bold;">Status</span>
            @if($data->status == 1)
                <span style='color:green'>Completed</span>
            @else
                <span style='color:red'>Pending</span>
            @endif
        </td>
        <td></td>
    </tr>

    <tr>
        <td><span style="display:block;font-weight: bold;">Quote Ref No</span>
            {{$data->quote_ref_no}}
        </td>
        <td><span style="display:block;font-weight: bold;">Transaction id</span>
            {{$data->transaction_id}}
        </td>
    </tr>

    <tr>
        <td><span style="display:block;font-weight: bold;">Payment type</span>
            @if($data->payment_type == 0)
                Online Payment
            @else
                Offline Payment
            @endif
        </td>
        <td><span style="display:block;font-weight: bold;">Gateway Name</span>
            @if($data->gateway_id != '')
                <?php 
                $gateway_data = DB::table('gateway_settings')->where('id', (int)$data->gateway_id)->first();
                ?>
                {{$gateway_data->gateway_name}}
            @endif
        </td>
    </tr>

    @if($data->transaction_type == 0)
        <tr>
            <td><span style="display:block;font-weight: bold;">Payment Mode</span>
                @if($data->mode_id != '')
                    <?php 
                    $mode_data = DB::table('twg_payment_mode')->where('id', (int)$data->mode_id)->first();
                    ?>
                    {{$mode_data->mode}}
                @else
                    Cash
                @endif
            </td>
            <td><span style="display:block;font-weight: bold;">Total Amount</span>
                {{$data->amount}}
            </td>
        </tr>

        <tr>
            <td><span style="display:block;font-weight: bold;">Description</span>
                <?php
                    $first = $data->description;
                    $payment_type = $data->payment_type;
                    if($payment_type == 0) {
                        $p_type = 'online';
                    } else {
                        $p_type = 'offline'; 
                    }

                    if($data->part_payment == 'full') {
                        $part_type = 'Full '.$p_type;
                    } elseif($data->part_payment == 'full_s') {
                        $part_type = 'Full sub-Partial '.$p_type; 
                    } elseif($data->part_payment == '1') {
                        $part_type = 'First partial payment '.$p_type; 
                    } elseif($data->part_payment == '1_s') {
                        $part_type = 'First sub-partial '.$p_type; 
                    } elseif($data->part_payment == '2') {
                        $part_type = 'Second partial '.$p_type; 
                    } elseif($data->part_payment == '2_s') {
                        $part_type = 'Second sub-partial '.$p_type; 
                    } elseif($data->part_payment == '3') {
                        $part_type = 'Third partial '.$p_type; 
                    } elseif($data->part_payment == '3_s') {
                        $part_type = 'Third sub-partial '.$p_type; 
                    }  
                    $output = $first.' ('.$part_type.')'; 
                ?>
                {{$output}}
            </td>
            <td><span style="display:block;font-weight: bold;">Transaction Amount</span>
                {{((int)$data->amount) - ((int)$data->mdr_amount + (int)$data->gst_on_mdr_amount)}}
            </td>
        </tr>

        <tr>
            <td><span style="display:block;font-weight: bold;">MDR</span>
                {{$data->mdr}}%
            </td>
            <td><span style="display:block;font-weight: bold;">MDR Amount</span>
                {{$data->mdr_amount}}
            </td>
        </tr>

        <tr>
            <td><span style="display:block;font-weight: bold;">GST on MDR</span>
                {{$data->gat_on_mdr}}%
            </td>
            <td><span style="display:block;font-weight: bold;">GST amount on MDR</span>
                {{$data->gst_on_mdr_amount}}
            </td>
        </tr>

    @else
        <?php  
            $quote_data = DB::table('option1_quotation')->where('id', $data->quote_id)->first();
            $query_data = DB::table('rt_package_query')->where('id', $quote_data->query_reference)->first();
            $cancellation_charge = $query_data->cancellation_charge;
        ?>
        <tr>
            <td><span style="display:block;font-weight: bold;">Cancellation Charge</span>
                {{$cancellation_charge}}
            </td>
            <td></td>
        </tr>
        
        <tr>
            <td><span style="display:block;font-weight: bold;">Payment Mode</span>
                @if($data->mode_id != '')
                    <?php 
                    $mode_data = DB::table('twg_payment_mode')->where('id', (int)$data->mode_id)->first();
                    ?>
                    {{$mode_data->mode}}
                @else
                    Cash
                @endif
            </td>
            <td><span style="display:block;font-weight: bold;">Refund Amount</span>
                {{$data->amount}}
            </td>
        </tr>
    @endif
</table>