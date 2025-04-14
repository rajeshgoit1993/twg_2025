<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log; // Import the Log facade
use Illuminate\Http\Request;
use Validator;

class TaxController extends Controller
{
    public function index()
    {
        //$all_taxes = Taxes::all();
        return view('taxes.listTaxes');
    }
}