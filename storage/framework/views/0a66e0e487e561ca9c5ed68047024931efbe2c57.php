<style type="text/css">
tbody {
   border-bottom: 1px solid #f4f4f4;
}
.mailBody .messageBody {
   font-size: 13px;
   line-height: 20px;
   color: #4a4a4a;
}
.mailBody .signature-details {
   font-size: 12px;
   line-height: 20px;
   color: #4a4a4a;
}
@media (max-width: 768px) {
   .mailBody {
      overflow: auto;
      max-height: 300px;
   }
}
@media (min-width: 768px) {
   .mailBody {
      overflow: auto;
      max-height: 485px;
   }
}
</style>
<div class="row">
    <div class="col-md-12">
        <h4>Reference No: #<?php echo e($data->quo_ref); ?></h4>
        <table class="table">
            
            
            <?php 
                $to_out = '<ul>';
                try {
                    $to = !empty($data->to) ? @unserialize($data->to) : [];
                    if (is_array($to)) {
                        foreach ($to as $t) {
                            $to_out .= '<li>' . e($t) . '</li>';
                        }
                    } else {
                        $to_out .= '<li>Invalid Data</li>';
                    }
                } catch (Exception $e) {
                    $to_out .= '<li>Error decoding "To" field</li>';
                }
                $to_out .= '</ul>';
             ?>
            <tr>
                <td>To</td>
                <td><?php echo $to_out; ?></td>
            </tr>

            
            <?php 
                $cc_out = '<ul>';
                try {
                    $cc = !empty($data->cc) ? @unserialize($data->cc) : [];
                    if (is_array($cc)) {
                        foreach ($cc as $c) {
                            $cc_out .= '<li>' . e($c) . '</li>';
                        }
                    } else {
                        $cc_out .= '<li>Invalid Data</li>';
                    }
                } catch (Exception $e) {
                    $cc_out .= '<li>Error decoding "CC" field</li>';
                }
                $cc_out .= '</ul>';
             ?>
            <tr>
                <td>Cc</td>
                <td><?php echo $cc_out; ?></td>
            </tr>

            
            <?php 
                $bcc_out = '<ul>';
                try {
                    $bcc = !empty($data->bcc) ? @unserialize($data->bcc) : [];
                    if (is_array($bcc)) {
                        foreach ($bcc as $b) {
                            $bcc_out .= '<li>' . e($b) . '</li>';
                        }
                    } else {
                        $bcc_out .= '<li>Invalid Data</li>';
                    }
                } catch (Exception $e) {
                    $bcc_out .= '<li>Error decoding "BCC" field</li>';
                }
                $bcc_out .= '</ul>';
             ?>
            <tr>
                <td>Bcc</td>
                <td><?php echo $bcc_out; ?></td>
            </tr>

            
            <tr>
                <td>Subject</td>
                <td><?php echo e($data->subject); ?></td>
            </tr>
        </table>

        <div class="mailBody">
           <p class="messageBody"><?php echo $data->description; ?></p>
        
            <br>
            <br>

            
            <?php if(!empty($data->email_footer) && $data->email_footer != "N;"): ?>
                <?php 
                    $footer_data = DB::table('quotation_footer')->find($data->email_footer);
                 ?>

                <?php if(!empty($footer_data)): ?>
                    <p class="signature-details"><?php echo $footer_data->footer_desc; ?></p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>