<div class="flexCenter">
    <!-- raised requests-desktop -->
    <?php if(Sentinel::getUser()->inRole('super_admin')
        || Sentinel::getUser()->inRole('administrator')
        || Sentinel::getUser()->inRole('supervisor')
        || Sentinel::getUser()->inRole('agent')
        || Sentinel::getUser()->inRole('employee')): ?>
        <?php
            // Fetch previous raises for the quotation reference number
            $previous_raises = DB::table('quote_raise_concern')->where('quotation_ref_no', $data1->quo_ref)->get();
        ?>
        <span class="btnRaiseConcern_button">
            <?php if(count($previous_raises) > 0): ?>
                <button type="button" class="btnRaiseConcern previous_raise" id="<?php echo e($data1->quo_ref); ?>">Request Raised</button>
            <?php endif; ?>
        </span>
    <?php endif; ?>

    <!-- Button to raise concern with modal trigger -->
    <button type="button" class="btnRaiseConcern" data-toggle="modal" data-target="#myModal" content_id="<?php echo e(CustomHelpers::custom_encrypt($data1->id)); ?>">Request Callback</button>

    <!-- ****************************** -->

    <!-- Vouchers, TCS & Invoice -->
    <?php
        // Fetch documents related to the lead voucher
        $docs = DB::table('lead_voucher')->where('lead_id', '=', $data1->query_reference)->get();
    ?>
    <?php if(count($docs) > 0): ?>
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#voucher_list">Vouchers, TCS & Invoice</button>
    <?php endif; ?>
    
    <!-- ****************************** -->

    <!-- Hidden inputs -->
    <input type="hidden" name="quote_no" class="quote_no" value="<?php echo e(CustomHelpers::custom_encrypt(1)); ?>">
    <input type="hidden" class="unique_code" value="<?php echo e(CustomHelpers::custom_encrypt($data1->unique_code)); ?>">

    <!-- new -->
    <?php $remainingAmount = CustomHelpers::get_remaining_amount_second(1, $data1->unique_code); ?>
    <?php if($remainingAmount == 0 || $remainingAmount < 0): ?>
        <button class="btn btn-success">Paid</button>
    <?php else: ?>
        <?php  
            $today = strtotime(date('Y-m-d'));
            $time = $data1->validity_time ?: '23:59:59';
            $validity = strtotime(date("Y-m-d", strtotime(str_replace('/', '-', $data1->option1_validaty))) . ' ' . $time);
        ?>
        <?php if($today <= $validity || $remainingAmount > 0): ?>
            <?php if($data1->send_option == 1): ?>
                <?php 
                    $check = DB::table('rt_payments')
                                ->where([
                                    ['quote_ref_no', '=', $data1->quo_ref],
                                    ['status', '=', 1],
                                    ['transaction_type', '=', 0]
                                ])->count();
                ?>
                <?php if($check > 0): ?>
                    <button class="btnPayBook pay_now" content_action="<?php echo e(route('bookingreview')); ?>">Pay Balance &#8377; <?php echo e($remainingAmount); ?></button>
                <?php else: ?>
                    <button class="btnPayBook pay_now" content_action="<?php echo e(route('bookingreview')); ?>">Pay & Book</button>
                <?php endif; ?>
            <?php else: ?>
                <button class="btnPayBook" style="cursor: not-allowed !important;">Pay & Book</button>
            <?php endif; ?>
        <?php else: ?>
            <button class="btn-quote-expired" content_action="">Expired</button>
        <?php endif; ?>
    <?php endif; ?>

</div>

<!-- ****************************** -->

<!-- modal voucher list in quotation_webpage -> accept -->
<div id="voucher_list" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Voucher List</h4>
            </div>
            <div class="modal-body">
                <?php  
                    // Fetch vouchers related to the lead voucher
                    $docs = DB::table('lead_voucher')->where('lead_id', '=', $data1->query_reference)->get();
                    if (count($docs) != "" && count($docs) != "0"):
                        $output = "";
                        $output .= "<table class='table table-striped'><tr>
                            <th>S.No.</th>
                            <th>File Type</th>
                            <th>File</th>
                            <th>Date</th>
                            </tr>";
                        $i = 0;
                        foreach ($docs as $datas):
                            $voucher = unserialize($datas->voucher);
                            $date = date("d M Y H:i", strtotime($datas->created_at));
                            $file_type = $datas->file_type;
                            if ($file_type == 0) {
                                $subject = 'Voucher';
                            } elseif ($file_type == 1) {
                                $subject = 'TCS';
                            } elseif ($file_type == 2) {
                                $subject = 'Invoice';  
                            }

                            foreach ($voucher as $vouchers):
                                $i++;
                                $path = url('/public/uploads/voucher/' . $vouchers);
                                $output .= "<tr>
                                    <td>$i</td>
                                    <td>$subject</td>
                                    <td><a href='$path' download>Download</a></td>
                                    <td>$date</td>
                                    </tr>";
                            endforeach;
                        endforeach;
                        $output .= "</table>";
                        echo "$output";
                    endif;
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- ****************************** -->