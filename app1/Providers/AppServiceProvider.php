<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\ActivateService;
use View;
class AppServiceProvider extends ServiceProvider
{
    /*Bootstrap any application services*/
    public function boot()
    {
        // Load custom helper file
        if (file_exists(app_path('Helpers/WebsitenameHelper.php'))) {
            require_once app_path('Helpers/WebsitenameHelper.php');
        }

        View::share("front_end_check", ActivateService::where('services', '=', 'front_end')->first());
        View::share("back_end_check", ActivateService::where('services', '=', 'back_end')->first());
    }


    /*Register any application services*/
    public function register()
    {
        //
    }
}
