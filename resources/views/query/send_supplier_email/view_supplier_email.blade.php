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
        <h4>Reference No: #{{ $data->quo_ref }}</h4>
        <table class="table">
            
            {{-- To Field --}}
            @php
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
            @endphp
            <tr>
                <td>To</td>
                <td>{!! $to_out !!}</td>
            </tr>

            {{-- CC Field --}}
            @php
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
            @endphp
            <tr>
                <td>Cc</td>
                <td>{!! $cc_out !!}</td>
            </tr>

            {{-- BCC Field --}}
            @php
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
            @endphp
            <tr>
                <td>Bcc</td>
                <td>{!! $bcc_out !!}</td>
            </tr>

            {{-- Subject Field --}}
            <tr>
                <td>Subject</td>
                <td>{{ $data->subject }}</td>
            </tr>
        </table>

        <div class="mailBody">
           <p class="messageBody">{!! $data->description !!}</p>
        
            <br>
            <br>

            {{-- Email Footer --}}
            @if (!empty($data->email_footer) && $data->email_footer != "N;")
                @php
                    $footer_data = DB::table('quotation_footer')->find($data->email_footer);
                @endphp

                @if (!empty($footer_data))
                    <p class="signature-details">{!! $footer_data->footer_desc !!}</p>
                @endif
            @endif
        </div>
    </div>
</div>