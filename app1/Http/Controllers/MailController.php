<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log; // Import the Log facade
use Illuminate\Http\Request;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller {
//    public function basic_email(){
//       $data = array('name'=>"Virat Gandhi");
//       Mail::send(['text'=>'mail'], $data, function($message) {
//          $message->to('abhay@globtierinfotech.com', 'Tutorials Point')->subject
//             ('Laravel Basic Testing Mail');
//          $message->from('xyz@gmail.com','Virat Gandhi');
//       });
//       echo "Basic Email Sent. Check your inbox.";
//    }
   public function html_email($data,$toName,$toEmail){
      $mailData = array(
      'toName' => $toName,
      'toEmail' => $toEmail,
      'toSubject' => 'Booking Confirmation From Rapidex Travel',
      'fromEmail' => 'rapidextravels@hotmail.com',
      'fromName' => 'Rapidex Travels');
      Mail::send('mail', $data, function($message) use($mailData) {
         $message->to($mailData['toEmail'], $mailData['toName'])->subject($mailData['toSubject']);
         $message->from($mailData['fromEmail'],$mailData['fromName']);
      });
   }
//    public function attachment_email(){
//       $data = array('name'=>"Virat Gandhi");
//       Mail::send('mail', $data, function($message) {
//          $message->to('abhay@globtierinfotech.com', 'Tutorials Point')->subject
//             ('Laravel Testing Mail with Attachment');
//          $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
//          $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
//          $message->from('xyz@gmail.com','Virat Gandhi');
//       });
//       echo "Email Sent with attachment. Check your inbox.";
//    }
}