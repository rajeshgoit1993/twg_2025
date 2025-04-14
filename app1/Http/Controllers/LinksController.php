<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Packages;
use App\Pkgtype;
use App\PkgInclusions;
use App\PkgExclusions;
use App\PkgTours;
use App\Hotel;
use App\PkgPaymentPolicy;
use App\PkgCancelPolicy;
use App\PkgVisa;
use App\PackageUploads;
use App\Cities;
use App\PkgRatingType;
use App\PkgSupplier;
use App\Locations;
use App\DaySchedule;
use App\countries;
use App\Transport;
use App\rates;
use App\Icons;
use App\State;
use App\City;
use App\PackageHotel;
use App\ImportantNotes;
use App\PackageImageGallery;
use App\Helpers\CustomHelpers;
use App\Helpers\PackagePriceHelpers;
use Validator;
use Image;
use App\ActivateService;
use Sentinel;
use Datatables;
use App\transferList;
use Illuminate\Support\Facades\Crypt;
use App\airlineList;
use App\Activity;
use App\iataList;
use App\Gtags;
use App\Suitable;
use App\Holiday;
use App\TourType;
use App\TourCategory;
use App\Supplier;
use App\QuoteCharges;
use App\Coupon;

class LinksController extends Controller
{

}