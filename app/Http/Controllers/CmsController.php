<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log; // Import the Log facade
use Illuminate\Http\Request;
use Sentinel;
use Validator;
use App\Packages;
use App\Testimonial;

class CmsController extends Controller
{
	public function getAbout() {
		$testimonial=Testimonial::all();
		return view('cms.about',['testimonial'=>$testimonial]);
	}
	public function getContact() {
		return view('cms.contact_us');
	}

	public function privacy() {
		return view('cms.privacy');
	}

	public function cookie() {
	return view('cms.cookie');
	}

	public function agreement() {
	return view('cms.agreement');
	}

	//Testing Blade
	public function thankyou () {
		return view ('cms.thankyou');
	}
	public function bookingreview () {
		return view ('cms.testingblade.bookingpaymentreview.bookingreview');
	}

	//Testing HTML
	public function bookingreviewhtml () {
		return view ('cms.testinghtml.bookingpaymentreview.bookingreview');
	}
	public function addtravellerhtml () {
		return view ('cms.testinghtml.bookingpaymentreview.addtraveller');
	}
	public function paymodehtml () {
		return view ('cms.testinghtml.bookingpaymentreview.paymode');
	}
	public function mbookingreviewhtml () {
		return view ('cms.testinghtml.bookingpaymentreview.mbookingreview');
	}

	//Testing HTML-Lead Validations
	public function add_payment () {
		return view ('cms.testinghtml.lead-manager-validations.add-payment');
	}
	public function lead_follow_up () {
		return view ('cms.testinghtml.lead-manager-validations.lead-follow-up');
	}
	public function phone_not_reachable () {
		return view ('cms.testinghtml.lead-manager-validations.phonenotreachable');
	}	
	public function leadcancelled () {
		return view ('cms.testinghtml.lead-manager-validations.lead-cancelled');
	}
	public function pricenegotiation () {
		return view ('cms.testinghtml.lead-manager-validations.pricenegotiation');
	}
	public function send_quote () {
		return view ('cms.testinghtml.lead-manager-validations.sendquote-email-sms-whatsapp');
	}
	public function modal_popup () {
		return view ('cms.testinghtml.lead-manager-validations.modal-popup');
	}
	public function service_status () {
		return view ('cms.testinghtml.lead-manager-validations.service-status');
	}
}