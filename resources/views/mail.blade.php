<!doctype html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Invoice</title>
      <style>
         td {
         font-size: 12px;
         }
      </style>
   </head>
   <body style="background-color:#F5F5F5; font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif">
      <table width="800" border="0" style="margin:0 auto;">
         <tr>
            <td>
               <table width="800" border="0" style=" background-color: #5E891B;line-height: 42px;">
                  <tr>
                     <td style="color:#fff;">
                        <img style="float: left;padding-right: 5px;" src="right.jpg"> 
                        <p style="float: left;line-height: 10px;">Thanks. The booking has been {{$cca_order_status}}.</p>
                     </td>
                  </tr>
               </table>
               <table style="border: 1px solid #08B2ED;padding: 10px;line-height: 35px;" width="800" border="0">
                  <tr>
                     <td width="230">Shop No. 206 - 207, Ganga Shopping Complex, Sector 16 B, Vasundhra, Pin – 201012 Delhi - NCR Region (INDIA)</td>
                     <td width="305" align="center"><img src="{{ asset("/resources/assets/frontend/") }}/images/logo.png"></td>
                     <td style="text-align: right;" width="249">
                        <table border="0">
                           <tr>
                              <td width="243">Phone: +91 120 4103400</td>
                           </tr>
                           <tr>
                              <td>Cell: +91 9650731717</td>
                           </tr>
                           <tr>
                              <td>WhatsApp: +91 9818433636</td>
                           </tr>
                        </table>
                     </td>
                  </tr>
               </table>
               <table style="border: 1px solid #08B2ED; padding: 10px; background-color:#fff;line-height: 42px;" width="800" border="0">
                  <tr>
                     <td width="446">
                        <table width="94%" border="0" style="width: 100%;line-height: 42px;">
                           <tr>
                                <td>Booking Ref No:</td>
                                <td>{{$cca_order_id}}</td>
                           </tr>
                           <tr>
                              <td>Check In:</td>
                              <td>{{date('D, d-M-Y',strtotime($checkInDate))}}</td>
                           </tr>
                           <tr>
                              <td>Check Out:</td>
                              <td>{{date('D, d-M-Y',strtotime($checkOutDate))}}</td>
                           </tr>
                        </table>
                     </td>
                     <td width="442">
                        <table border="0" style="width: 100%;line-height: 42px;">
                           <tr>
                                <td>Booking Status:</td>
                                <td>{{$cca_order_status}}</td>
                           </tr>
                           <tr>
                                <td>No Of Room:</td>
                                <td>{{$noOfBookedRooms}}</td>
                           </tr>
                           <tr>
                                <td>No Of Nights:</td>
                                <td>{{$noOfNights}}</td>
                           </tr>
                        </table>
                     </td>
                  </tr>
               </table>
               <table width="800" border="0" style=" background-color:#337AB7; color:#fff;">
                  <tr>
                     <td style="line-height: 30px;padding-left: 10px;">Hotel Detail</td>
                  </tr>
               </table>
               <table width="800" border="0" style="border: 1px solid #08b2ed; background-color:#fff;line-height: 42px;">
                  <tr>
                     <td width="220"><img src="{{ url('/public'.CustomHelpers::get_first_image($hotelId,'rt_hotel_uploads','image_path','hotel_id')) }}" width="198" height="118"></td>
                     <td width="670">
                        <table width="100%" border="0">
                           <tr>
                              <td>{{CustomHelpers::getTableRecordById($hotelId,'rt_hotels','name') }}</td>
                           </tr>
                           <tr>
                              <td>{{CustomHelpers::getTableRecordById($hotelId,'rt_hotels','map_address') }}</td>
                           </tr>
                           <tr>
                              <td>{{CustomHelpers::getTableRecordById($hotelId,'rt_hotels','contact_no') }}</td>
                           </tr>
                        </table>
                     </td>
                  </tr>
               </table>
               <table width="800" border="0" style=" background-color:#337AB7; color:#fff;">
                  <tr>
                     <td style="line-height: 30px;padding-left: 10px;">Room Detail</td>
                  </tr>
               </table>
               <table style="border: 1px solid #08B2ED; padding: 10px; background-color:#fff;line-height: 42px;" width="800" border="0">
                  <tbody>
                     <tr>
                        <td width="446">
                           <table style="width: 100%;" width="94%" border="0">
                              <tbody>
                                 <tr>
                                    <td>Room Name:</td>
                                    <td>{{CustomHelpers::getTableRecordById($roomId,'rt_rooms','roomTypeName') }}</td>
                                 </tr>
                                 <tr>
                                    <td>Bed Type:</td>
                                    <td>{{CustomHelpers::getTableRecordById($roomId,'rt_rooms','bedType') }}</td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                        <td width="442">
                           <table style="width: 100%;line-height: 42px;" border="0">
                              <tbody>
                                 <tr>
                                    <td>No Of Adults:</td>
                                    <td>{{$noOfAdults}} Adults</td>
                                 </tr>
                                 <tr>
                                    <td>No Of Childs:</td>
                                    <td>{{$noOfChilds}} Childs</td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
               <table width="800" border="0" style=" background-color:#337AB7; color:#fff;">
                  <tr>
                     <td style="line-height: 30px;padding-left: 10px;">Customer Detail</td>
                  </tr>
               </table>
               <table style="border: 1px solid #08B2ED; padding: 10px; background-color:#fff;line-height: 42px;" width="800" border="0">
                  <tbody>
                     <tr>
                        <td width="446">
                           <table style="width: 100%;" border="0">
                              <tbody>
                                 <tr>
                                    <td width="34%">Name: {{ $cca_billingName }}</td>
                                    <td width="33%">Email: {{$cca_billingEmail}}</td>
                                    <td width="33%">Phone: {{$cca_billingTel}}</td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
               <table width="800" border="0" style=" background-color:#E6EDF6; padding:10px; border: 1px solid #08B2ED;line-height: 42px;">
                  <tr>
                     <td>{{CustomHelpers::getTableRecordById($roomId,'rt_rooms','roomTypeName') }}</td>
                     <td style="text-align: right;">
                        @php

                        $RoomRate = $cca_paidAmount-$taxAmount;
                        $perRoom = ($RoomRate/$noOfBookedRooms)/$noOfNights;
                        
                        @endphp

                        {{$noOfBookedRooms}} Room x {{$noOfNights}} Nights x &#8377; {{$perRoom}}/ Per Room = 
                        &#8377; {{$RoomRate}}</td>
                  </tr>
                  <tr>
                     <td>Taxes & Fees</td>
                  <td style="text-align: right;">&#8377; {{$taxAmount}}</td>
                  </tr>
                  <tr>
                     <td style=" font-size:24px;">Total Price</td>
                     <td style=" text-align: right;">
                         <span  style=" font-size:24px;">&#8377; {{$cca_paidAmount}}</span>                  
                    </td>
                  </tr>
               </table>
               <table width="800" border="0" style=" background-color:#337AB7; color:#fff;">
                  <tr>
                     <td style="line-height: 30px;padding-left: 10px;">Booking Notes</td>
                  </tr>
               </table>
               <table width="800" border="0" style=" background-color:#fff; border:1px solid #08B2ED; padding:10px;line-height: 42px;">
                  <tr>
                     <td>
                        <p>Booking payable as per reservation details; Please collect all extras directly from clients prior to departure.</p>
                        <p>All vouchers issued are on the condition that all arrangements operated by person or bodies are made as agents only and that they shall not be responsible or any damage, loss, injury ,delay or inconvenience caused to passengers as a result of any such arrangements. We will not accept any responsibility for additional expenses due to the changes or delays in air, road, rail, sea or indeed any other causes, all such expenses will have to be borne by passengers.</p>
                     </td>
                  </tr>
               </table>
               <table width="800" border="0" style=" background-color:#337AB7; color:#fff;">
                  <tr>
                     <td style="line-height: 30px;padding-left: 10px;">Nationality & Domicile</td>
                  </tr>
               </table>
               <table width="800" border="0" style=" background-color:#fff; border:1px solid #08B2ED; padding:10px;line-height: 42px;">
                  <tr>
                     <td>
                        <p>Passenger travelling to destination where guest is holding a local residency; Booking should be searched with Country of Residence as Nationality in order to avail the valid rates. (i.e. Indian National holding UAE Residence Permit should select Emirati as nationality for search). In case of wrong residency or nationality selected by user at the time of booking; the supplement charges may be applicable and need to be paid directly to the hotel by guest on check in/check out.</p>
                        <p>Additional supplement charges may be charged by the Hotel (which the Guest have to pay directly at the hotel) If the lead guest’s Nationality is different than the Nationality of the other accompanied guests. For more details you can reach out to our operation Team for clarification.</p>
                     </td>
                  </tr>
               </table>
               <table width="800" border="0" style=" background-color:#337AB7; color:#fff;">
                   <tr>
                      <td style="line-height: 30px;padding-left: 10px;">Check In/Check Out Timings & Policies :</td>
                   </tr>
                </table>
                <table width="800" border="0" style=" background-color:#fff; border:1px solid #08B2ED; padding:10px;line-height: 42px;">
                   <tr>
                      <td>
                         <ul>
                            <li>The usual check-in time is 14:00 hours. Rooms may not be available for early check-ins, unless specifically required in advance. However, luggage may be deposited at the hotel reception and collected once the room is allotted</li>
                            <li>Note that reservation may be cancelled automatically after 18:00 hours if hotel is not informed about the approximate time of late arrivals.</li>
                            <li>Official checkout time is at 12:00 hours. Any late checkout may involve additional charges. Please check with the hotel reception in advance. </li>
                         </ul>
                         <hr>
                         <h3>Check your Reservation details carefully and inform us immediately if you have any queries.</h3>
                      </td>
                   </tr>
                </table>
            </td>
          </tr>
      </table>
   </body>
</html>