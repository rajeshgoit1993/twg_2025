<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log; // Import the Log facade
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
use Excel;

class LinkController extends Controller
{
    
    public function links()
    {
        return view('backend_files.links.index');
    }

    /*---------*/

    // pacakge link view  in browser (old)
    /*public function get_package_link(Request $request)
    {
        $package_link_type=$request->package_link_type;
        $package_changefreq=$request->package_changefreq;
        $package_priority=$request->package_priority;
        $data=DB::table('rt_packages')->get();
        $a=1;
        // $customer_array[]=array('S.no.','Package Name','Link');
        if($package_link_type==0) {
            foreach($data as $d) {
                $href_id1=CustomHelpers::custom_encrypt($d->id);
                $form_action=url("/Holidays/".str_slug($d->title)).'?package_id='.$href_id1;
                $link='<url>
                <loc>'.$form_action.'</loc>
                <changefreq>'.$package_changefreq.'</changefreq>
                <priority>'.$package_priority.'</priority>
                </url>';
                $customer_array[]=array(
                    'S.no.'=>$a++,
                    'Package Name'=>$d->title,
                    'Link'=>$link,
                );
            }
        } elseif($package_link_type==1) {
            foreach($data as $d) {
                $href_id1=CustomHelpers::custom_encrypt($d->id);
                $form_action=url("/Holidays/".str_slug($d->title)).'?package_id='.$href_id1;
                $customer_array[]=array(
                    'S.no.'=>$a++,
                    'Package Name'=>$d->title,
                    'Link'=>$form_action,
                );
            }
        }
        return view('backend_files.links.package_link',compact('customer_array'));
        // return Excel::create('Packages Links', function($excel) use ($customer_array){
        //      $excel->setTitle('Packages Links');
        //      $excel->sheet('Packages Links',function($sheet) use ($customer_array){
        //          $sheet->fromArray($customer_array,null,'A1',false,false);
        //      });
        //  })->download('xlsx');
    }*/

    /*// pacakge link view  in browser
    public function get_package_link(Request $request)
    {
        $package_link_type = $request->package_link_type;
        $package_changefreq = $request->package_changefreq;
        $package_priority = $request->package_priority;
        $data = DB::table('rt_packages')->get();
        $customer_array = []; // Initialize the array
        $a = 1;

        if ($package_link_type == 0) {
            foreach ($data as $d) {
                $href_id1 = CustomHelpers::custom_encrypt($d->id);
                $form_action = url("/Holidays/" . str_slug($d->title)) . '?package_id=' . $href_id1;
                $link = '<url>
                    <loc>' . $form_action . '</loc>
                    <changefreq>' . $package_changefreq . '</changefreq>
                    <priority>' . $package_priority . '</priority>
                    </url>';
                $customer_array[] = [
                    'S.no.' => $a++,
                    'Package Name' => $d->title,
                    'Link' => $link,
                ];
            }
        } elseif ($package_link_type == 1) {
            foreach ($data as $d) {
                $href_id1 = CustomHelpers::custom_encrypt($d->id);
                $form_action = url("/Holidays/" . str_slug($d->title)) . '?package_id=' . $href_id1;
                $customer_array[] = [
                    'S.no.' => $a++,
                    'Package Name' => $d->title,
                    'Link' => $form_action,
                ];
            }
        }

        // Sort the array alphabetically by 'Package Name'
        usort($customer_array, function ($a, $b) {
            return strcmp($a['Package Name'], $b['Package Name']);
        });

        // Check if the request wants to download or view in browser
        if ($request->has('download') && $request->download == 'csv') {
            return $this->downloadCSV($customer_array, 'Packages_Links.csv');
        }

        // Return the view to display in the browser
        return view('backend_files.links.package_link', compact('customer_array'));
    }

    private function downloadCSV($customer_array, $filename)
    {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Pragma: no-cache');
        header('Expires: 0');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['S.no.', 'Package Name', 'Link']); // Header

        foreach ($customer_array as $data) {
            fputcsv($output, [
                $data['S.no.'],
                $data['Package Name'],
                $data['Link']
            ]);
        }

        fclose($output);
        exit;
    }*/

    /*---------*/

    // pacakge link download  in csv
    public function get_package_link(Request $request)
    {
        $package_link_type = $request->package_link_type;
        $package_changefreq = $request->package_changefreq;
        $package_priority = $request->package_priority;
        $data = DB::table('rt_packages')->get();
        $customer_array = []; // Initialize the array
        $a = 1;

        if ($package_link_type == 0) {
            foreach ($data as $d) {
                $href_id1 = CustomHelpers::custom_encrypt($d->id);
                $form_action = url("/Holidays/" . str_slug($d->title)) . '?package_id=' . $href_id1;
                $link = '<url>
                    <loc>' . $form_action . '</loc>
                    <changefreq>' . $package_changefreq . '</changefreq>
                    <priority>' . $package_priority . '</priority>
                    </url>';
                $customer_array[] = [
                    'S.no.' => $a++,
                    'Package Name' => $d->title,
                    'Link' => $link,
                ];
            }
        } elseif ($package_link_type == 1) {
            foreach ($data as $d) {
                $href_id1 = CustomHelpers::custom_encrypt($d->id);
                $form_action = url("/Holidays/" . str_slug($d->title)) . '?package_id=' . $href_id1;
                $customer_array[] = [
                    'S.no.' => $a++,
                    'Package Name' => $d->title,
                    'Link' => $form_action,
                ];
            }
        }

        // Sort the array alphabetically by 'Package Name'
        usort($customer_array, function ($a, $b) {
            return strcmp($a['Package Name'], $b['Package Name']);
        });

        // Call the method to download as CSV
        return $this->downloadCSV($customer_array, 'Packages_Links.csv');
    }

    private function downloadCSV($customer_array, $filename)
    {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Pragma: no-cache');
        header('Expires: 0');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['S.no.', 'Package Name', 'Link']); // Header

        foreach ($customer_array as $data) {
            fputcsv($output, [
                $data['S.no.'],
                $data['Package Name'],
                $data['Link']
            ]);
        }

        fclose($output);
        exit;
    }

    /*---------------------*/

    /*public function get_destination_link(Request $request)
    {
        $destination_link_type=$request->destination_link_type;
        $destination_changefreq=$request->destination_changefreq;
        $destination_type=$request->destination_type;
        $destination_priority=$request->destination_priority;
        $data=DB::table('rt_packages')->get();
        $dest=[];
        foreach($data as $data_value):
        if($destination_type=='Country'):
        $countries=unserialize($data_value->country);
        foreach($countries as $row=>$col ):
        $dest[]=['country'=>$countries[$row]];
        endforeach;
        elseif($destination_type=='State'):
        $countries=unserialize($data_value->country);
        $states=unserialize($data_value->state);
        foreach($states as $row=>$col):
        $dest[]=['country'=>$countries[$row],'state'=>$states[$row]];
        endforeach;
        elseif($destination_type=='City'):
        $cities=unserialize($data_value->city);
        $countries=unserialize($data_value->country);
        $states=unserialize($data_value->state);
        foreach($cities as $row=>$col ):
        $dest[]=['country'=>$countries[$row],'state'=>$states[$row],'city'=>$cities[$row]];
        endforeach;
        endif;
        //
        //
        endforeach;
        $dest = array_map("unserialize", array_unique(array_map("serialize", $dest)));
        if($destination_type=='Country') {
            $a=1;
            // $customer_array[]=array('S.no.','Country','Link');
            foreach($dest as $row=>$col) {
                if($destination_link_type==0) {
                    $url1= url('/Holidays/').'/'.str_slug($col['country']).'-tour-packages';
                    $link='<url>
                    <loc>'.$url1.'</loc>
                    <changefreq>'.$destination_changefreq.'</changefreq>
                    <priority>'.$destination_priority.'</priority>
                    </url>';
                    $customer_array[]=array(
                        'S.no.'=>$a++,
                        'country'=>$col['country'],
                        'Link'=>$link,
                        );
                    } elseif($destination_link_type==1) {
                        $url1= url('/Holidays/').'/'.str_slug($col['country']).'-tour-packages';
                        $customer_array[]=array(
                        'S.no.'=>$a++,
                        'country'=>$col['country'],
                        'Link'=>$url1,
                        );
                    }
                }
        }
        elseif($destination_type=='State')
        {
        $a=1;
        // $customer_array[]=array('S.no.','Country','State','Link');
        foreach($dest as $row=>$col) {
            if($destination_link_type==0) {
                $url1= url('/Holidays/').'/'.str_slug($col['state']).'-tour-packages';
                $link='<url>
                <loc>'.$url1.'</loc>
                <changefreq>'.$destination_changefreq.'</changefreq>
                <priority>'.$destination_priority.'</priority>
                </url>';
                $customer_array[]=array(
                'S.no.'=>$a++,
                'Country'=>$col['country'],
                'State'=>$col['state'],
                'Link'=>$link,
                );
                } elseif($destination_link_type==1) {
                    $url1= url('/Holidays/').'/'.str_slug($col['state']).'-tour-packages';
                    $customer_array[]=array(
                    'S.no.'=>$a++,
                    'country'=>$col['country'],
                    'State'=>$col['state'],
                    'Link'=>$url1,
                    );
                }
        }
        } elseif($destination_type=='City') {
            $a=1;
            // $customer_array[]=array('S.no.','Country','State','City','Link');
            foreach($dest as $row=>$col) {
                if($destination_link_type==0) {
                    $url1= url('/Holidays/').'/'.str_slug($col['city']).'-tour-packages';
                    $link='<url>
                    <loc>'.$url1.'</loc>
                    <changefreq>'.$destination_changefreq.'</changefreq>
                    <priority>'.$destination_priority.'</priority>
                    </url>';
                    $customer_array[]=array(
                        'S.no.'=>$a++,
                        'Country'=>$col['country'],
                        'State'=>$col['state'],
                        'City'=>$col['city'],
                        'Link'=>$link,
                    );
                }
                elseif($destination_link_type==1) {
                    $url1= url('/Holidays/').'/'.str_slug($col['state']).'-tour-packages';
                    $customer_array[]=array(
                        'S.no.'=>$a++,
                        'country'=>$col['country'],
                        'State'=>$col['state'],
                        'City'=>$col['city'],
                        'Link'=>$url1,
                    );
                }
            }
        }
        return view('backend_files.links.destination_link',compact('customer_array','destination_type'));
        // return Excel::create('Destination Links', function($excel) use ($customer_array){
        //        $excel->setTitle('Destination Links');
        //        $excel->sheet('Destination Links',function($sheet) use ($customer_array){
        //            $sheet->fromArray($customer_array,null,'A1',false,false);
        //        });
        //    })->download('xlsx');
    }*/

    // destination link download  in csv
    public function get_destination_link(Request $request)
    {
        $destination_link_type = $request->destination_link_type;
        $destination_changefreq = $request->destination_changefreq;
        $destination_type = $request->destination_type;
        $destination_priority = $request->destination_priority;

        $data = DB::table('rt_packages')->get();

        $dest = [];

        foreach ($data as $data_value) {
            if ($destination_type == 'Country') {
                $countries = unserialize($data_value->country);
                foreach ($countries as $row => $col) {
                    $dest[] = ['country' => $countries[$row]];
                }
            } elseif ($destination_type == 'State') {
                $countries = unserialize($data_value->country);
                $states = unserialize($data_value->state);
                foreach ($states as $row => $col) {
                    $dest[] = ['country' => $countries[$row], 'state' => $states[$row]];
                }
            } elseif ($destination_type == 'City') {
                $cities = unserialize($data_value->city);
                $countries = unserialize($data_value->country);
                $states = unserialize($data_value->state);
                foreach ($cities as $row => $col) {
                    $dest[] = ['country' => $countries[$row], 'state' => $states[$row], 'city' => $cities[$row]];
                }
            }
        }

        $dest = array_map("unserialize", array_unique(array_map("serialize", $dest)));

        // Prepare data for CSV
        $customer_array = [];
        if ($destination_type == 'Country') {
            $customer_array[] = ['S.no.', 'Country', 'Link']; // Header
            $a = 1;
            foreach ($dest as $row => $col) {
                $url1 = url('/Holidays/') . '/' . str_slug($col['country']) . '-tour-packages';
                if ($destination_link_type == 0) {
                    $link = '<url>
                                <loc>' . $url1 . '</loc>
                                <changefreq>' . $destination_changefreq . '</changefreq>
                                <priority>' . $destination_priority . '</priority>
                             </url>';
                    $customer_array[] = [
                        'S.no.' => $a++,
                        'country' => $col['country'],
                        'Link' => $link,
                    ];
                } elseif ($destination_link_type == 1) {
                    $customer_array[] = [
                        'S.no.' => $a++,
                        'country' => $col['country'],
                        'Link' => $url1,
                    ];
                }
            }
        } elseif ($destination_type == 'State') {
            $customer_array[] = ['S.no.', 'Country', 'State', 'Link']; // Header
            $a = 1;
            foreach ($dest as $row => $col) {
                $url1 = url('/Holidays/') . '/' . str_slug($col['state']) . '-tour-packages';
                if ($destination_link_type == 0) {
                    $link = '<url>
                                <loc>' . $url1 . '</loc>
                                <changefreq>' . $destination_changefreq . '</changefreq>
                                <priority>' . $destination_priority . '</priority>
                             </url>';
                    $customer_array[] = [
                        'S.no.' => $a++,
                        'Country' => $col['country'],
                        'State' => $col['state'],
                        'Link' => $link,
                    ];
                } elseif ($destination_link_type == 1) {
                    $customer_array[] = [
                        'S.no.' => $a++,
                        'country' => $col['country'],
                        'State' => $col['state'],
                        'Link' => $url1,
                    ];
                }
            }
        } elseif ($destination_type == 'City') {
            $customer_array[] = ['S.no.', 'Country', 'State', 'City', 'Link']; // Header
            $a = 1;
            foreach ($dest as $row => $col) {
                $url1 = url('/Holidays/') . '/' . str_slug($col['city']) . '-tour-packages';
                if ($destination_link_type == 0) {
                    $link = '<url>
                                <loc>' . $url1 . '</loc>
                                <changefreq>' . $destination_changefreq . '</changefreq>
                                <priority>' . $destination_priority . '</priority>
                             </url>';
                    $customer_array[] = [
                        'S.no.' => $a++,
                        'Country' => $col['country'],
                        'State' => $col['state'],
                        'City' => $col['city'],
                        'Link' => $link,
                    ];
                } elseif ($destination_link_type == 1) {
                    $customer_array[] = [
                        'S.no.' => $a++,
                        'country' => $col['country'],
                        'State' => $col['state'],
                        'City' => $col['city'],
                        'Link' => $url1,
                    ];
                }
            }
        }

        // Prepare to download the CSV
        $filename = "Destination_Links_" . date('Ymd') . ".csv";
        header('Content-Type: text/csv');
        header("Content-Disposition: attachment; filename=\"$filename\"");

        // Open output stream for writing
        $output = fopen('php://output', 'w');

        // Output the data to the CSV file
        foreach ($customer_array as $line) {
            fputcsv($output, $line);
        }

        fclose($output);
        exit();
    }

}
