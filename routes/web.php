<?php
Route::post('/voucherlist', 'QueryController@voucherlist')->middleware('login');

Route::group(['middleware'=>['login','admin']],function() { 
	Route::get('/dashboard', 'DashboardController@dashboard')->middleware('login')->name('dashboard');
	Route::get('/Activate-Services','ActivateServiceController@index')->middleware('login');
	Route::post('/activation_data','ActivateServiceController@activation_data')->middleware('login');
	Route::get('/Company-Profile','CompanyProfileController@index')->middleware('login');
	Route::get('/Create-Company-Profile','CompanyProfileController@create')->middleware('login');
	Route::post('/company_profile_save','CompanyProfileController@save')->middleware('login');
	Route::get('/Edit-Company-Profile/{id}','CompanyProfileController@edit')->middleware('login');
	Route::post('/company_profile_update','CompanyProfileController@update')->middleware('login');
	Route::get('/apanel','DashboardController@dashboard')->middleware('login');
	//Route::get('/register','RegistrationController@register');
	//Route::post('/register','RegistrationController@postRegister'); // For Register User
});

Route::group(['middleware'=>['login','user']],function() { 
	//user profile
	Route::get('/customer-panel','HomeController@customerPanel')->name('userProfile');
	Route::get('/my-booking','HomeController@mybooking')->name('myBooking');
	Route::POST('/update_user_profile','UsersController@update_user_profile');
	Route::POST('/update_user_mobile','UsersController@update_user_mobile');
	Route::POST('/delete_user_mobile','UsersController@delete_user_mobile');
	Route::get('/user_email_verify','UsersController@user_email_verify');
	Route::POST('/email_verify','UsersController@email_verify');
	Route::POST('/add_user_traveller','UsersController@add_user_traveller');
	Route::get('/view_traveller_details','UsersController@view_traveller_details');
	Route::POST('/update_user_traveller','UsersController@update_user_traveller');
	Route::POST('/delete_user_traveller','UsersController@delete_user_traveller');
	Route::POST('/upload_profile_image','UsersController@upload_profile_image');
	Route::get('/Manage-Booking/{id}','HomeController@manage_booking');
	Route::get('/user_mobile_verify','UsersController@user_mobile_verify');
	Route::POST('/mobile_verify','UsersController@mobile_verify');
	Route::get('/test_otp','HomeController@test_otp');
});

Route::get('/send_login_otp','HomeController@send_login_otp');
Route::get('/login_with_otp','HomeController@login_with_otp');
Route::get('/login_with_google','HomeController@login_with_google')->name('loginViaGoogle');
Route::any('/gmaillogin','HomeController@gmaillogin');

// save_traveller
Route::post('/save_traveller', 'PassengersController@save_traveller')->name('save_traveller');
Route::get('/delete_traveller', 'PassengersController@delete_traveller')->name('delete_traveller');
Route::get('/get_passenger_select', 'PassengersController@get_passenger_select');
Route::get('/get_passenger_detail', 'PassengersController@get_passenger_detail');
Route::get('/get_month', 'PassengersController@get_month');
Route::get('/get_day', 'PassengersController@get_day');
Route::get('/check_coupon_code', 'PaytmController@check_coupon_code');
Route::get('/coupon_apply', 'PaytmController@coupon_apply');
Route::get('/part_payment_type', 'PaytmController@part_payment_type');

// payment gateway
Route::post('/Add-Edit-Passenger', 'PassengersController@add_edit_passenger')->name('add_edit_passenger');
Route::post('/paymentview', 'PassengersController@paymentview')->name('paymentview');
Route::post('/bookingreview', 'PassengersController@passenger_info')->name('bookingreview');
Route::get('/get_custom_pay_calculation', 'PaytmController@get_custom_pay_calculation');
Route::get('/get_full_pay_calculation', 'PaytmController@get_full_pay_calculation');
Route::post('/save_booking_details', 'PassengersController@save_booking_details');
Route::post('/save_traveller_details', 'PassengersController@save_traveller_details');
Route::post('/save_pan_details', 'PassengersController@save_pan_details');
Route::post('/payment-option', 'PaymentOptionController@payment_option');
Route::get('/check_mode','PaymentOptionController@check_mode');

// home page
// Route::get('/','HomeController@index')->middleware('cache');
Route::get('/', 'HomeController@index')->middleware('cache')->name('home');

// user registration
Route::get('/register','HomeController@index');

// backend login
Route::get('/login', 'LoginController@login')->name('login'); // For login page (GET request)
Route::post('/login', 'LoginController@postLogin')->name('postLogin'); // For login action (POST request)
Route::post('/logout','LoginController@logout')->name('logout'); // For logout User

//Room type
Route::post('/addRoomType','RoomController@addRoomType')->middleware('login'); // For add Room type
Route::post('/editRoomType','RoomController@editRoomType'); // For edit  Room type
Route::post('/deleteRoomType','RoomController@deleteRoomType'); // For delete  Room type

Route::post('/storeRoomAminities','RoomController@storeRoomAminities'); // For room amenities
Route::post('/editRoomAminities','RoomController@editRoomAminities'); // For room amenities
Route::post('/deleteRoomAmenities','RoomController@deleteRoomAmenities'); // For room amenities
Route::post('/role','RoleController@index')->middleware('login'); // For Show all Role
Route::post('/role-store','RoleController@store')->middleware('login'); // For Show all Role
Route::get('/role-edit/{id}','RoleController@edit'); // For edit  sale
Route::get('/role-create','RoleController@create'); // For edit  sale
Route::post('/deleterole','RoleController@deleteRole'); // For delete  sale

Route::group(['middleware'=>['web']],function() {
	Route::resource('role','RoleController'); // Add role
});

// supplier
Route::get('/Supplier-Email-Non-Lead','SupplierController@supplier_email_non_lead')->middleware('login')->name('supplierEmailComposedList');
Route::get('/Compose-Non-Lead-Email','SupplierController@compose_email_non_lead')->middleware('login')->name('supplierEmailCompose');
Route::get('/get_supplier_email_list_non_lead','SupplierController@get_supplier_email_list_non_lead')->name('get_supplier_email_list_non_lead');
Route::get('/view_supplier_email_non_lead','SupplierController@view_supplier_email_non_lead')->middleware('login');
Route::get('/resend_supplier_email_non_lead','QueryController@resend_supplier_email_non_lead')->middleware('login');

Route::get('/Supplier-Email','SupplierController@supplier_email')->middleware('login')->name('supplierEmailList');
Route::get('/get_supplier_email_list','SupplierController@get_supplier_email_list')->name('get_supplier_email_list');
Route::get('/view_supplier_email','SupplierController@view_supplier_email')->middleware('login');
Route::get('/resend_supplier_email','QueryController@resend_supplier_email')->middleware('login');

Route::get('/Supplier','SupplierController@index')->middleware('login');
Route::get('/addsupplier','SupplierController@addsupplier')->middleware('login');
Route::post('/savesupplierprofile','SupplierController@savesupplierprofile')->middleware('login');
Route::get('/editsupplier/{id}','SupplierController@edit');
Route::post('/editsupplier/{id}','SupplierController@update');
Route::post('/supplier_data','SupplierController@supplier_data');
Route::post('/delete-supplier/{id}','SupplierController@delete');
Route::get('/users','UsersController@users')->middleware('login');
Route::get("/roles/{id}",'UsersController@users_data')->middleware('login');
Route::post('/get_country','UsersController@get_country');

 // For show users
Route::post('/postusers','UsersController@postUsers'); // For add  users
Route::get('/user-create','UsersController@create'); // For add  users
Route::get('/edit-user/{id}','UsersController@edit'); // For edit user
Route::post('/deleteuser','UsersController@deleteUser'); // For delete user
Route::get('/change_subscription','UsersController@change_subscription'); 
Route::post('/user_data_check','UsersController@user_data_check');
//Route::post('/update-user-status', [UserController::class, 'updateUserStatus'])->name('update-user-status');
Route::post('/update-user-status','UsersController@update-user-status');

//Route::get('/user-login-status', [UserController::class, 'getUserStatus']);
Route::get('/user-login-status','UsersController@getUserStatus');

//Hotel
Route::get('/hotel','HotelController@index')->middleware('login'); // For Hotel List
Route::get('/hotel-add','HotelController@create')->middleware('login'); // For Hotel List
Route::get('/edit/{id}', 'HotelController@edit')->middleware('login'); // For Hotel List
Route::get('/hotel-settings','HotelController@settings')->middleware('login'); // For Hotel List
Route::post('/addHotelAminities','HotelController@addHotelAminities'); // For delete  sale
Route::post('/editHotelAminities','HotelController@editHotelAminities'); // For delete  sale
Route::post('/deleteHotelAmenities','HotelController@deleteHotelAmenities'); // For delete  sale
Route::post('/addHotel','HotelController@addHotel')->middleware('login'); // For add sale
Route::get('/editHotel/{id}','HotelController@editHotel')->middleware('login'); // For Hotel List
// Route::post('/editHotel','HotelController@editHotel')->middleware('login'); // For edit  sale
Route::post('/deleteHotel','HotelController@deleteHotel'); // For delete  sale
Route::post('/hotelfileUploads','HotelController@hotelfileUploads'); // For delete  sale
Route::get('/hotelUploads/{id}','HotelController@hotelUploads')->middleware('login'); // For add sale
Route::post('/addHotelType','HotelController@addHotelType')->middleware('login'); // For add sale
Route::post('/editHotelType','HotelController@editHotelType'); // For edit  sale
Route::post('/deleteHotelType','HotelController@deleteHotelType'); // For delete  sale
Route::post('/addPaymentMethod','HotelController@addPaymentMethod')->middleware('login'); // For add PaymentMethod
Route::post('/addGeneralSetting','HotelController@addGeneralSetting')->middleware('login'); // For add
Route::post('/editPaymentMethod','HotelController@editPaymentMethod'); // For edit  PaymentMethod
Route::post('/deletePaymentMethod','HotelController@deletePaymentMethod'); // For delete  PaymentMethod

//Room
Route::get('/rooms','RoomController@rooms')->middleware('login'); // For Hotel List
Route::get('/room-create','RoomController@createRoom')->middleware('login'); // For Hotel List
Route::get('/room-edit/{id}','RoomController@editRooms')->middleware('login'); // For Hotel List
Route::post('/storeRooms','RoomController@storeRooms')->middleware('login'); // For Hotel List
Route::get('/roomUploads/{id}','RoomController@roomUploads')->middleware('login'); // For add sale
Route::post('/roomfileUploads','RoomController@roomfileUploads'); // For delete  sale
Route::post('/deleteRoomImage','RoomController@deleteRoomImage'); // For delete  PaymentMethod
Route::post('/deleteRoom','RoomController@deleteRoom'); // For delete  PaymentMethod
Route::post('/storeContarctTppe','RoomController@storeContarctTppe')->middleware('login'); // For Hotel List
Route::post('/storeRoomView','RoomController@storeRoomView')->middleware('login'); // For Hotel List
Route::get('/room-plans','RoomController@listRatePlans')->middleware('login'); // For Hotel List
Route::get('/room-plan-create','RoomController@createRatePlans')->middleware('login'); // For Hotel List
Route::post('/storeRatePlans','RoomController@storeRatePlans')->middleware('login'); // For Hotel List
Route::get('/rp-edit/{id}', 'RoomController@editRatePlans')->middleware('login'); // For Hotel List
Route::post('/deleteRatePlans','RoomController@deleteRatePlans'); // For delete  PaymentMethod
Route::get('/room-rates','RoomController@listRoomRates')->middleware('login'); // For Hotel List
Route::get('/room-rate-create','RoomController@createRoomRates')->middleware('login'); // For Hotel List
Route::post('/storeRates','RoomController@storeRates')->middleware('login'); // For Hotel List
Route::get('/rr-edit/{id}', 'RoomController@editRoomRates')->middleware('login'); // For Hotel List
Route::post('/deleteRoomRates','RoomController@deleteRoomRates'); // For delete  PaymentMethod
Route::get('/room-rate-plans','RoomRatesPlanController@index')->middleware('login'); // For Hotel List
Route::get('/room-rate-plans-create','RoomRatesPlanController@create')->middleware('login'); // For Hotel List
Route::post('/getRooms','RoomRatesPlanController@getRooms')->middleware('login'); // For Hotel List
Route::post('/saveRegularRoomRates','RoomRatesPlanController@saveRegularRoomRates')->middleware('login'); // For Hotel List
Route::post('/saveSpecialRoomRates','RoomRatesPlanController@saveSpecialRoomRates')->middleware('login'); // For Hotel List
Route::get('/room-rates-plan-edit/{hid}/{rid}', 'RoomRatesPlanController@edit')->middleware('login'); // For Hotel List
Route::get('/room-rates-ratename-edit/{planName}/{datefrom}/{dateto}', 'RoomRatesPlanController@editRatePlan')->middleware('login'); // For Hotel List
Route::post('/updateRatePlan','RoomRatesPlanController@updateRatePlan')->middleware('login'); // For Hotel List
Route::post('/deleteRoomRatePlans','RoomRatesPlanController@deleteRoomRatePlans'); // For delete  PaymentMethod
Route::post('/deleteRoomRatePlanName','RoomRatesPlanController@deleteRoomRatePlanName'); // For delete  PaymentMethod
Route::post('/getHotelCountry','HotelController@getHotelCountry'); // For delete  sale
Route::post('/getHotelState','HotelController@getHotelState'); // For delete  sale
Route::post('/search-rooms', 'HotelfrontController@roomFilter');
Route::post('/make-payment', 'ccAvenueController@ccRequest');
Route::post('/booking-confirmation', 'ccAvenueController@ccResponse');

//Send Email
Route::get('sendbasicemail','MailController@basic_email');
Route::get('sendhtmlemail','MailController@html_email');
Route::get('sendattachmentemail','MailController@attachment_email');

// New Start
Route::get('/viewBooking/{id}','DashboardController@view')->middleware('login');; // For edit user
Route::post('/ConfirmCancelBooking','RoomBookingController@ConfirmCancelBooking')->middleware('login');; // For Cancel Booking
Route::post('/cancelBooking','RoomBookingController@cancelBooking')->middleware('login');; // For Cancel Booking

// New End
Route::get('/policies','RoomController@listPolicies')->middleware('login'); // For Hotel List
Route::get('/policy-create','RoomController@createPolicies')->middleware('login'); // For Hotel List
Route::get('/room-settings','RoomController@roomSettings')->middleware('login'); // For Hotel List

//Packages
//Route::get('/add-package', 'PackageManageController@create')->middleware('login');
//Route::post('/store-package', 'PackageManageController@store')->middleware('login');
Route::post('/delete-package', 'PackageManageController@delete')->middleware('login');
Route::post('/update-package', 'PackageManageController@update')->middleware('login');
Route::get('/editpackage/{id}', 'PackageManageController@edit')->middleware('login');
Route::get('/clonepackage/{id}', 'PackageManageController@duplicates')->middleware('login');
Route::get('/package-settings', 'PackageSettingController@settings')->middleware('login');
Route::post('/add-package-type', 'PackageSettingController@addPackageType')->middleware('login');
Route::post('/edit-package-type', 'PackageSettingController@editPackageType')->middleware('login');
Route::post('/deletePkgType', 'PackageSettingController@deletePkgType')->middleware('login');
Route::post('/deletePkgTypes', 'PackageSettingController@deletePkgTypes')->middleware('login');
Route::post('/add-inclusion', 'PackageSettingController@addInclusion')->middleware('login');
Route::post('/edit-inclusion', 'PackageSettingController@editInclusion')->middleware('login');
Route::post('/deleteInclusion', 'PackageSettingController@deleteInclusion')->middleware('login');
Route::post('/add-transfers', 'PackageSettingController@addTransfers')->middleware('login');
Route::post('/edit-transfers', 'PackageSettingController@editTransfers')->middleware('login');
Route::post('/delete-transfers', 'PackageSettingController@deleteTransfers')->middleware('login');
Route::post('/add-iata', 'PackageSettingController@addIATA')->middleware('login');
Route::post('/edit-iata', 'PackageSettingController@editIATA')->middleware('login');
Route::post('/delete-iata', 'PackageSettingController@deleteIATA')->middleware('login');

Route::post('/add-airlines', 'PackageSettingController@addAirlines')->middleware('login');
Route::post('/edit-airlines', 'PackageSettingController@editAirlines')->middleware('login');
Route::post('/delete-airlines', 'PackageSettingController@deleteAirlines')->middleware('login');
Route::post('/add-generals', 'PackageSettingController@addGtags')->middleware('login');
Route::post('/edit-generals', 'PackageSettingController@editGtags')->middleware('login');
Route::post('/delete-generals', 'PackageSettingController@deleteGtags')->middleware('login');
Route::post('/add-suitables', 'PackageSettingController@addSuitables')->middleware('login');
Route::post('/edit-suitables', 'PackageSettingController@editSuitables')->middleware('login');
Route::post('/delete-suitables', 'PackageSettingController@deleteSuitables')->middleware('login');
Route::post('/add-holiday', 'PackageSettingController@addHoliday')->middleware('login');
Route::post('/edit-holiday', 'PackageSettingController@editHoliday')->middleware('login');
Route::post('/delete-holiday', 'PackageSettingController@deleteHoliday')->middleware('login');
Route::post('/add-tour-type', 'PackageSettingController@add_tour_type')->middleware('login');
Route::post('/edit-tour-type', 'PackageSettingController@edit_tour_type')->middleware('login');
Route::post('/deletetourtype', 'PackageSettingController@deletetourtype')->middleware('login');
Route::post('/add-tour-category', 'PackageSettingController@add_tour_category')->middleware('login');
Route::post('/edit-tour-category', 'PackageSettingController@edit_tour_category')->middleware('login');
Route::post('/deletetourcategory', 'PackageSettingController@deletetourcategory')->middleware('login');

Route::post('/add-exclusion', 'PackageSettingController@addExclusion')->middleware('login');
Route::post('/add-pay-at-hotel-payment-type', 'PackageSettingController@add_pay_at_hotel_payment_type')->middleware('login');
Route::post('/add_packages_seo', 'PackageSettingController@add_packages_seo')->middleware('login');
Route::post('/edit_packages_seo', 'PackageSettingController@edit_packages_seo')->middleware('login');
Route::post('/delete_packages_seo/{id}', 'PackageSettingController@delete_packages_seo')->middleware('login');
Route::post('/edit-exclusion', 'PackageSettingController@editExclusion')->middleware('login');
Route::post('/edit-pay-at-hotel-payment-type', 'PackageSettingController@edit_pay_at_hotel_payment_type')->middleware('login');
Route::post('/deleteExclusion', 'PackageSettingController@deleteExclusion')->middleware('login');
Route::post('/deletePayHotelPayment', 'PackageSettingController@deletePayHotelPayment')->middleware('login');

Route::post('/add-tour', 'PackageSettingController@addTour')->middleware('login');
Route::post('/edit-tour', 'PackageSettingController@editTour')->middleware('login');
Route::post('/deleteTour', 'PackageSettingController@deleteTour')->middleware('login');
Route::post('/add-activity', 'PackageSettingController@addActivity')->middleware('login');
Route::post('/edit-activity', 'PackageSettingController@editActivity')->middleware('login');
Route::post('/deleteActivity', 'PackageSettingController@deleteActivity')->middleware('login');

//Links
Route::get('/links', 'LinkController@links')->middleware('login');
Route::post('/get_package_link', 'LinkController@get_package_link')->middleware('login');
Route::post('/get_destination_link', 'LinkController@get_destination_link')->middleware('login');

Route::get('/tours', 'PackageManageController@index')->middleware('login');
Route::get('/package_list_filter_data', 'PackageManageController@package_list_filter_data')->middleware('login');
Route::get('/package_lists', 'PackageManageController@package_lists')->name('package_lists')->middleware('login');
Route::get('/up_package', 'PackageManageController@up_package')->middleware('login');
Route::get('/addcountry', 'PackageManageController@addcountry')->middleware('login');
Route::get('/addstate', 'PackageManageController@addstate')->middleware('login');
Route::POST('/list_data','PackageManageController@list_data');
Route::get('/packageUploads/{id}','PackageManageController@packageUploads')->middleware('login');
Route::get('/up_image', 'PackageManageController@up_image')->middleware('login');
Route::get('/change_thumb_no', 'PackageManageController@change_thumb_no')->middleware('login');
Route::post('/packagefileUploads','PackageManageController@packagefileUploads');
Route::get('/package_image_location/{id}','PackageManageController@package_image_location');
Route::get('/hotel_image_location/{id}','HotelController@hotel_image_location');
Route::get('/package_image_gallery/{id}','PackageManageController@package_image_gallery');
Route::get('/hotel_image_gallery/{id}','HotelController@hotel_image_gallery');
Route::get('/package_image_gallery_edit/{id1}/{id2}/{id3}','PackageManageController@package_image_gallery_edit');
Route::get('/hotel_image_gallery_edit/{id1}/{id2}/{id3}','HotelController@hotel_image_gallery_edit');
Route::post('/package_image_save/{id}','PackageManageController@package_image_save');
Route::post('/hotel_image_save/{id}','HotelController@hotel_image_save');
Route::post('/packages_image_save/{id1}/{id2}/{id3}','PackageManageController@packages_image_save');
Route::post('/hotel_image_save/{id1}/{id2}/{id3}','HotelController@hotels_image_save');

// package image gallery
Route::get('/img_gallery', 'PackageManageController@img_gallery')->middleware('login');
Route::get('/add_image_ingallery', 'PackageManageController@add_image_ingallery')->name('addNewImage')->middleware('login');
Route::get('/add_video_ingallery', 'PackageManageController@add_video_ingallery')->name('addNewVideo')->middleware('login');
Route::post('/store_package_image_gallery','PackageManageController@store_package_image_gallery');
Route::post('/store_video_image_gallery','PackageManageController@store_video_image_gallery');
Route::get('/edit_image_ingallery/{id}', 'PackageManageController@edit_image_ingallery')->middleware('login');
Route::post('/update_package_image_gallery/{id}','PackageManageController@update_package_image_gallery');
Route::get('/delete_image_ingallery/{id}','PackageManageController@delete_image_ingallery');
Route::post('/country_sorting','PackageManageController@country_sorting');
Route::post('/state_sorting','PackageManageController@state_sorting');
Route::post('/city_sorting','PackageManageController@city_sorting');
Route::post('/get_gall_state','PackageManageController@get_gall_state');
Route::post('/get_gall_city','PackageManageController@get_gall_city');
Route::POST('/edit_gallery_form','PackageManageController@edit_gallery_form');
Route::POST('/delete_image_ingall','PackageManageController@delete_image_ingall');
Route::POST('/search_name_gallery','PackageManageController@search_name_gallery');
Route::get('/img_gallery/fetch_data','PackageManageController@fetch_data');

//Image Gallery
Route::POST('/packagefile_upload','PackageManageController@packagefile_upload');

Route::post('/packagefiledelete/{id}/{id2}','PackageManageController@packagefiledelete');
Route::post('/hotelfiledelete/{id}/{id2}','HotelController@hotelfiledelete');
Route::get('/edit_package_image/{id}/{id2}','PackageManageController@edit_package_image');
Route::get('/edit_package_gallery_image/{id}/{id2}/{id3}','PackageManageController@edit_package_gallery_image');
Route::get('/edit_hotel_gallery_image/{id}/{id2}/{id3}','HotelController@edit_hotel_gallery_image');
Route::post('/update_uploadimage/{id}','PackageManageController@update_uploadimage');

//Reviews
// Route::get('/testimonials','ReviewsController@index')->middleware('login');;
// Route::get('/testimonials-create','ReviewsController@create')->middleware('login');;
// Route::post('/testimonials-store','ReviewsController@store')->middleware('login');;
// Route::get('/testimonials-edit/{id}','ReviewsController@edit')->middleware('login');;
// Route::post('/testimonials-delete','ReviewsController@delete')->middleware('login');;

//Location
Route::get('/package-locations','PackageSettingController@locations')->middleware('login');

//Route::post("/location_enable","PackageSettingController@location_enable");
//Route::post("/location_disable","PackageSettingController@location_disable");
Route::post("/location_status", "PackageSettingController@toggle_location_status");

Route::get('/location_list_filter_data', 'PackageSettingController@location_list_filter_data')->middleware('login');

Route::get('/get_continent_list','PackageSettingController@get_continent_list');
Route::get('/get_continent_country','PackageSettingController@get_continent_country');
Route::get('/get_country_states','PackageSettingController@get_country_states');
Route::get('/get_cities_states','PackageSettingController@get_cities_states');
Route::get('/package-locations-create','PackageSettingController@locationsCreate')->middleware('login');
Route::post('/location-store','PackageSettingController@locationsStore')->name('saveDestination')->middleware('login');
Route::get('/package-locations-edit/{id}','PackageSettingController@locationsEdit')->middleware('login');
Route::post('/location-delete','PackageSettingController@locationsDelete')->middleware('login');
Route::post('/location_data','PackageSettingController@location_data');
Route::post('/get-cities','PackageManageController@getCities');
Route::post('/get-locations','PackageManageController@getLocations');
Route::post('/get-country','PackageManageController@getCountry');
Route::get('/search_tour_destination','PackageManageController@search_tour_destination');
Route::get('/search_similar_package_city','PackageManageController@search_similar_package_city');
Route::get('/extra','PackageSettingController@extra')->middleware('login');
Route::get('/lead_settings','PackageSettingController@lead_settings')->middleware('login');
Route::post('/save-canPolicy','PackageSettingController@saveCancelPolicy');
Route::post('/save-payPolicy','PackageSettingController@savePaymentPolicy');
Route::post('/save-visaPolicy','PackageSettingController@saveVisaPolicy');
Route::post('/save-traveller','PackageSettingController@saveTravellerType');
Route::post('/save-rating','PackageSettingController@saveRatingType');
Route::post('/deletePayPolicy','PackageSettingController@deletePkgPayPolicy');
Route::post('/deletePkgcan','PackageSettingController@deletePkgcan');
Route::post('/save-impnotes','PackageSettingController@savenotes');
Route::post('/deleteimpnotes','PackageSettingController@deleteimpnotes');
Route::post('/save-quotationheader','PackageSettingController@save_quotationheader');
Route::post('/delete_quotationheader','PackageSettingController@delete_quotationheader');
Route::post('/save-quotationfooter','PackageSettingController@save_quotationfooter');
Route::post('/delete_quotationfooter','PackageSettingController@delete_quotationfooter');

// Notifications
Route::get('/get_notification', 'NotificationController@get_notification')->middleware('login');

//Query Handler
Route::get('/quote-pending', 'QueryController@index')->middleware('login');
Route::get('/web-leads', 'QueryController@enquiry')->middleware('login')->name('webLeads');

// Route::get('/Verification-Pending-Add-Lead-Followup', 'QueryController@verification_pending_add_lead_follow_up')->middleware('login');
Route::get('/lead-verification', 'QueryController@pending_verification')->middleware('login');

//Route::get('/quote-sent', 'QueryController@quotation')->middleware('login');
Route::get('/quote-sent', 'QueryController@quotation')->middleware('login')->name('quoteSent');

/*Route::get('/Saved-Quote', 'QueryController@saved_quote')->middleware('login');*/
Route::get('/quote-saved', 'QueryController@saved_quote')->middleware('login')->name('quoteSaved');;

Route::get('/send_saved_quote', 'QueryController@send_saved_quote')->middleware('login');
// Route::get('/saved_quotation', 'QueryController@saved_quotation')->middleware('login');

Route::post('/supplier_email_submit_non_lead', 'QueryController@supplier_email_submit_non_lead')->middleware('login');

Route::get('/supplier_to_email_search', 'QueryController@supplier_to_email_search')->name('supplier_to_email_search');
Route::get('/send_supplier_email_non_send/{id}', 'QueryController@send_supplier_email_non_send')->middleware('login');
Route::get('/send_supplier_email/{id}', 'QueryController@send_supplier_email')->middleware('login');
Route::post('/supplier_email_submit', 'QueryController@submit_supplier_email')->middleware('login');
Route::get('/lead-follow-up', 'QueryController@leads_follow_up')->middleware('login');
Route::get('/myRequests', 'QueryController@raise_concern')->middleware('login');
Route::get('/search-lead', 'QueryController@search_leads')->middleware('login');
Route::get('/process-booking', 'QueryController@booking_hold')->middleware('login');
Route::get('/get_query_service_type_data', 'LeadDynamicFieldController@get_query_service_type_data')->middleware('login');
Route::post('/update_service_status', 'LeadDynamicFieldController@update_service_status')->middleware('login');

Route::get('/get_service_type_data', 'LeadDynamicFieldController@get_service_type_data')->middleware('login');

Route::get('/payment-follow-up', 'QueryController@payment')->middleware('login');
Route::get('/trip-under-cancellation', 'QueryController@under_cancellation')->middleware('login');

Route::get('/booking-calendar', 'QueryController@booking_calendar')->middleware('login');
Route::get('/get_booking_cal_data', 'QueryController@get_booking_cal_data')->middleware('login');

Route::get('/issue-voucher', 'QueryController@confirmation')->middleware('login');
Route::get('/lead-cancelled', 'QueryController@cancelled_leads')->middleware('login');
Route::get('/trip-vouchers', 'QueryController@vouchers')->middleware('login');
Route::get('/trip-cancelled', 'QueryController@tour_cancelled')->middleware('login');
Route::get('/trip-refund', 'QueryController@refund_issued')->middleware('login');
Route::get('/trip-review', 'QueryController@post_tour')->middleware('login');
Route::get('/Post-Tour', 'QueryController@post_tour')->middleware('login');

Route::post('/send_voucher_file', 'QueryController@send_voucher_file')->middleware('login');
//Route::post('/voucherlist', 'QueryController@voucherlist')->middleware('login');
Route::get('/resend', 'QueryController@resend')->middleware('login');
Route::post('/resend_voucher_file', 'QueryController@resend_voucher_file')->middleware('login');

Route::get('/Deleted-Leads', 'QueryController@deleted_leads')->middleware('login');
Route::post('/recover_lead', 'QueryController@recover_lead')->middleware('login');

Route::post('/send_custom_quote','QueryController@send_custom_quote')->middleware('login');
Route::get('/add_quotation', 'QueryController@add_quotation')->middleware('login');

Route::get('/quo_first/{id}','QueryController@quo_first')->middleware('login');
Route::get('/quo_new/{id}','QueryController@quo_new')->middleware('login');;
Route::get('/quo_copy/{id}','QueryController@quo_copy');
Route::post('/copy_reference/{id}','QueryController@copy_reference')->middleware('login');
Route::get('/edit_quation/{id}/{id2}','QueryController@edit_quation')->middleware('login');

Route::POST('/get_enquiry_history','LeadDynamicFieldController@get_enquiry_history')->middleware('login');
Route::get('/get_payment_history','LeadDynamicFieldController@get_payment_history')->middleware('login');
Route::post('/get_enquiry_raise','LeadDynamicFieldController@get_enquiry_raise')->middleware('login');
Route::post('/view_raise_remarks','LeadDynamicFieldController@view_raise_remarks')->middleware('login');

Route::post('/update_raise_concern','LeadDynamicFieldController@update_raise_concern')->middleware('login');
Route::get('/add_lead_follow_up_data','LeadDynamicFieldController@add_lead_follow_up_data')->middleware('login');
Route::get('/add_payment_follow_up','LeadDynamicFieldController@add_payment_follow_up')->middleware('login');
Route::POST('/update_follow_up','LeadDynamicFieldController@update_follow_up')->middleware('login');
Route::POST('/update_follow_ups','LeadDynamicFieldController@update_follow_ups')->middleware('login');
Route::get('/cancel_lead_follow_up_data','LeadDynamicFieldController@cancel_lead_follow_up_data')->middleware('login');
Route::get('/voucher_issued_remarks','LeadDynamicFieldController@voucher_issued_remarks')->middleware('login');

Route::POST('/refund_under_process_form','LeadDynamicFieldController@refund_under_process_form')->middleware('login');
Route::POST('/update_tour_cancel','LeadDynamicFieldController@update_tour_cancel')->middleware('login');
Route::POST('/update_issue_voucher','LeadDynamicFieldController@update_issue_voucher')->middleware('login');
Route::POST('/update_lead_cancel','LeadDynamicFieldController@update_lead_cancel')->middleware('login');
Route::POST('/update_lead_under_cancelllation','LeadDynamicFieldController@update_lead_under_cancelllation')->middleware('login');
Route::get('/change_payment_status','QueryController@change_payment_status')->middleware('login');
Route::get('/add_lead_payment','QueryController@add_lead_payment')->middleware('login');
Route::get('/create_refund_amound','QueryController@create_refund_amound')->middleware('login');
Route::POST('/update_refund_create','QueryController@update_refund_create')->middleware('login');
Route::get('/add_refund_payment','QueryController@add_refund_payment')->middleware('login');
Route::POST('/update_refund_payments','QueryController@update_refund_payments')->middleware('login');
Route::POST('/update_offline_payments','QueryController@update_offline_payments')->middleware('login');
Route::POST('/update_payment_follow_up','QueryController@update_payment_follow_up')->middleware('login');
Route::POST('/query_status','LeadDynamicFieldController@query_status')->middleware('login');
Route::POST('/user_assign','QueryController@user_assign')->middleware('login');
Route::POST('/lead_varified','QueryController@lead_varified')->middleware('login');
Route::POST('/update_booking_label','QueryController@update_booking_label')->middleware('login');
Route::POST('/lead_unvarified','QueryController@lead_unvarified')->middleware('login');

Route::POST('/option1','QueryController@option1')->middleware('login');;
Route::POST('/save_quote','QueryController@save_quote')->middleware('login');;

Route::POST('/option2','QueryController@option2')->middleware('login');;
Route::POST('/option3','QueryController@option3')->middleware('login');;
Route::POST('/option4','QueryController@option4')->middleware('login');;
Route::POST('/copy_option1','QueryController@copy_option1')->middleware('login');;
Route::POST('/option1_store','QueryController@option1_store')->middleware('login');;
Route::POST('/querys_days','QueryController@querys_days')->middleware('login');;
Route::get('/mail_test',"QueryController@mail_test1");
Route::get('/quotes/{id}',"QueryController@quotation_details_first");
Route::get('/get_previous_raise',"QueryController@get_previous_raise");
Route::POST('/store_raise',"QueryController@store_raise");

Route::get('/Quotation-Second/{id}',"QueryController@quotation_details_second");
Route::get('/Quotation-Three/{id}',"QueryController@quotation_details_three");
Route::get('/Quotation-Four/{id}',"QueryController@quotation_details_four");
Route::post('/quote_accept',"QueryController@quote_accept");
Route::post('/quote_reject',"QueryController@quote_reject");

//Front End Routes Defination
Route::post('/register-customer','HomeController@postRegisterCustomer'); // For Register User
Route::post('/signup_with_otp','HomeController@signup_with_otp'); 

Route::get("/activation/{email}/{code}","HomeController@activation");
Route::post('/login-customer','HomeController@postLogin')->name('guestlogin'); // For login User

Route::post('/Change-Password','HomeController@change_password')->middleware('login');
Route::post('Password-Forget',"HomeController@forget_password")->name('forget_password');
Route::get('/activates/{email}/{code}',"HomeController@reset_password");
Route::post('Password-Reset/{email}/{code}','HomeController@password_reset');

// For customer panel
Route::post('/logout-customer','HomeController@logout')->name('userLogout'); // For logout User
Route::get('/about','CmsController@getAbout')->name('aboutUs');
Route::get('/Privacy-Policy','CmsController@privacy')->name('privacyPolicy');
Route::get('/Cookie-Policy','CmsController@cookie')->name('cookiePolicy');
Route::get('/User-Agreement','CmsController@agreement')->name('userAgreement');
// Route::get('/hotels','HotelfrontController@index');
Route::get('/flights','FlightsController@index');
Route::get('/contact-us','CmsController@getContact')->name('contactUs');
Route::post('/saveProfile','HomeController@postSaveProfile')->name('save-profile');
Route::post('/image-update', 'HomeController@postSaveProfileImage');
Route::post('/hotel-details', 'HotelfrontController@postHotelDetails');
Route::get('/hoteldetail/{id}', 'HotelfrontController@hotelDetails');
Route::get('/packages-detail/{id}', 'PackagesController@PackageInfo');
Route::post('/search-hotel', 'HotelfrontController@postSearchHotel');

//************************ Book Rooms *********************

Route::post('/bookRooms','RoomBookingController@bookRooms');
Route::post('/CheckUserAvailblity','RoomBookingController@CheckUserAvailblity');
//API Check Availability
Route::post('/check_availability','HotelfrontController@checkAvailability');
Route::post('/hotel-details-xml','HotelfrontController@hotelDetailsXml');
Route::post('/pre-booking','HotelfrontController@xmlhubPreBooking');

Route::group(["middleware"=>"login"],function() {
	Route::get('/add-package', 'PackageManageController@create');
	Route::post('/store-package', 'PackageManageController@store');
	Route::post('/store_packages', 'PackageManageController@stores');
	Route::get('/get_sunday_data', 'PackageManageController@get_sunday_data');
});

//Manage Rates
Route::group(["middleware"=>"login"],function() {
	Route::get("/rate","RateController@index");
	Route::get("/add-currency","RateController@create");
	Route::post("/store-rate","RateController@store_rate");
	Route::post("/delete-currency/{id}","RateController@delete_rates");
	Route::get("/editcurrency/{id}","RateController@edit_rates");
	Route::post("/update-rate/{id}","RateController@update_rate");

	//manage package hotel
	Route::post("/city_country_data","PackageHotelController@city_country_data");
	Route::get('/add_hotel_country', 'PackageHotelController@add_hotel_country')->middleware('login');

	Route::get("/package_hotel","PackageHotelController@index");
	Route::get("/add_packagehotel","PackageHotelController@create")->name('packageHotel');
	Route::post("/store_packagehotel","PackageHotelController@store_packagehotel");
	Route::post("/delete_packagehotel/{id}","PackageHotelController@delete_packagehotel");
	Route::get("/editpackagehotel/{id}","PackageHotelController@edit_packagehotel");
	Route::post("/update_packagehotel/{id}","PackageHotelController@update_packagehotel");
	Route::get('/packagehotelUploads/{id}','PackageHotelController@packagehotelUploads'); 
	Route::get('/package_hotels', 'PackageHotelController@package_hotels')->name('package_hotels')->middleware('login');
	Route::get('/search_city_with_country', 'PackageManageController@search_quote_destination')->name('search_city_with_country')->middleware('login');
Route::get('/up_image_package_hotel', 'PackageHotelController@up_image')->middleware('login');
	// For add sale
	Route::get('/packagehotel_image_location/{id}','PackageHotelController@packagehotel_image_location');
	Route::get('/packagehotel_image_gallery/{id}','PackageHotelController@packagehotel_image_gallery');
	Route::post('/packagehotel_image_save/{id}','PackageHotelController@packagehotel_image_save');
	Route::get('/edit_packagehotel_gallery_image/{id}/{id2}/{id3}','PackageHotelController@edit_packagehotel_gallery_image');
	Route::get('/packagehotel_image_gallery_edit/{id1}/{id2}/{id3}','PackageHotelController@packagehotel_image_gallery_edit');
	Route::post('/packagehotel_image_save/{id1}/{id2}/{id3}','PackageHotelController@packagehotels_image_save');
	Route::post('/packagehotelfiledelete/{id}/{id2}','PackageHotelController@packagehotelfiledelete');
Route::POST('/packagehotelfileUploads','PackageHotelController@packagehotelfileUploads');

	//Manage Transport
	Route::get("/add-transport","RateController@create_transport");
	Route::post("/store-transport","RateController@store_transport");
	Route::get("/edittransport/{id}","RateController@edit_transport");
	Route::post("/update-transport/{id}","RateController@update_transport");
	Route::post("/delete-transport/{id}","RateController@delete_transport");

	//Manage Tour Taxes
	Route::get("/addtourtaxes","RateController@create_quote_charge");
	Route::post("/store-tourtaxes","RateController@store_quote_charge");
	Route::get("/edittourtaxes/{id}","RateController@edit_quotecharge");
	Route::post("/update-tourtaxes/{id}","RateController@update_quotecharge");
	Route::post("/delete-tourtaxes/{id}","RateController@delete_quotecharge");
	Route::get("/addvalidfrom/{id}","RateController@addvalidfrom");
	Route::post("/store-valid-from","RateController@store_valid_from");
	Route::get("/editvalidfrom/{id}","RateController@editvalidfrom");
	Route::post("/update-valid-from","RateController@update_valid_from");
	Route::post("/delete-valid-from/{id}","RateController@delete_valid_from");

	//Manage Tour Discounts
	Route::get("/addtourdiscounts","RateController@create_tour_discounts");
	Route::post("/store-tourdiscounts","RateController@store_tour_discounts");
	Route::get("/edittourdiscounts/{id}","RateController@edit_quotediscounts");
	Route::post("/update-tourdiscounts/{id}","RateController@update_quotediscounts");
	Route::post("/delete-tourdiscounts/{id}","RateController@delete_quotediscounts");

	//Add Tour
	Route::get("/add-icon","RateController@create_icon");
	Route::post("/store-icon","RateController@store_icon");
	Route::get("/editicon/{id}","RateController@edit_icon");
	Route::post("/update_icon/{id}","RateController@update_icon");
	Route::post("/delete-icon/{id}","RateController@delete_icon");

	//icon
	//Country
	Route::get("/Country-List","RateController@country");
	Route::get("/edit-country","RateController@edit_country");
	Route::get("/delete-country","RateController@delete_country");
	Route::post("/update_country","RateController@update_country");
	Route::post("/country_save","RateController@country_save");

	//Lead Dynamic Field 
	Route::get("/Lead-Cancelled-Reasons","LeadDynamicFieldController@lead_concelled_reasons");
	Route::get("/Add-Lead-Follow-up","LeadDynamicFieldController@add_lead_follow_up");
	Route::get("/Booking-Status","LeadDynamicFieldController@booking_status");
	Route::get("/Lead-Payment-Status","LeadDynamicFieldController@lead_payment_status");
	Route::get("/Payment-Method","LeadDynamicFieldController@payment_method");
	Route::get("/Service-Type","LeadDynamicFieldController@service_type");
	Route::get("/Service-Status","LeadDynamicFieldController@service_status");
	Route::get("/Booking-Label","LeadDynamicFieldController@booking_label");

	//Enquery-OTP-Setting
	Route::get("/otp-validation","LeadDynamicFieldController@enquery_otp_setting");
	Route::get("/store_setting_status","LeadDynamicFieldController@store_setting_status");

	Route::post("/lead_field_save","LeadDynamicFieldController@lead_field_save");
	Route::get("/edit-leatdynamictable","LeadDynamicFieldController@edit_leatdynamictable");
	Route::post("/lead_field_update","LeadDynamicFieldController@lead_field_update");

	//State
	Route::get("/State-List","RateController@state");
	Route::get("/getstate","RateController@getstate")->name('getstate');
	Route::get("/edit-state","RateController@edit_state");
	Route::post("/update_state","RateController@update_state");
	Route::post("/state_save","RateController@state_save");
	Route::get("/delete-state","RateController@delete_state");

	//City
	Route::get("/getcity","RateController@getcity")->name('getcity');
	Route::get("/add_city","RateController@add_city");
	Route::post("/store-city","RateController@store_city");
	Route::post("/city_save","RateController@city_save");
	Route::get("/edit-city","RateController@edit_city");
	Route::post("/update_city","RateController@update_city");
	Route::get("/delete-city","RateController@delete_city");

	Route::post("/packages_list","FrontController@packages")->name('productList');

	Route::get("/mid_images","RateController@mid_image");

	//Short Url
	Route::get("/Short-URLs","ShorturlController@index")->name('short_urls');
	Route::get("/Add-Short-URLs","ShorturlController@create")->name('add_short_url');
	Route::post("/store_short_urls","ShorturlController@store_short_urls");
	Route::get("/edit_short_url/{id}","ShorturlController@edit_short_url");
	Route::post("/update_short_url/{id}","ShorturlController@update_short_url");
	Route::post("/delete_short_url/{id}","ShorturlController@delete_short_url");
	Route::get('s/{id}',"ShorturlController@get_url");

	//testimonials
	Route::get("/testimonials","RateController@testimonials");
	Route::get("/add_testimonial","RateController@add_testimonial");
	Route::post("/store_testimonial","RateController@store_testimonial");
	Route::get("/edit_testimonial/{id}","RateController@edit_testimonial");
	Route::post("/update_testimonial/{id}","RateController@update_testimonial");
	Route::post("/delete_testimonial/{id}","RateController@delete_testimonial");
	Route::post("/get_item_image","RateController@get_item_image");
	Route::post("/uploads_list_image","RateController@uploads_list_image");
	Route::post("/delete_item_image","RateController@delete_item_image");

	//Coupon
	Route::get("/get_coupon_applicable_for","CouponController@get_coupon_applicable_for");
	Route::get("/Coupon","CouponController@index");
	Route::get("/Add-Coupon","CouponController@create");
	Route::post("/store_coupon","CouponController@store");
	Route::get("/Edit-Coupon/{id}","CouponController@edit");
	Route::post("/Update-Coupon/{id}","CouponController@update");
	Route::post("/Delete-Coupon/{id}","CouponController@delete");

	//theme_data
	Route::get("/select_theme_type","RateController@select_theme_type");
	Route::get("/theme_data","RateController@theme_data")->name('themeList');
	Route::get("/add_theme_data","RateController@add_theme_data")->name('newTheme');
	Route::post("/store_theme_data","RateController@store_theme_data")->name('saveTheme');
	Route::get("/edit_theme_data/{id}","RateController@edit_theme_data")->name('editTheme');
	Route::post("/update_theme_data/{id}","RateController@update_theme_data")->name('updateTheme');;
	Route::post("/delete_theme_data/{id}","RateController@delete_theme_data")->name('deleteTheme');

	//newsletter
	Route::get("/newsletter_back","RateController@newsletter_back");
	Route::post("/delete_sub/{id}","RateController@delete_sub");

	//
	Route::get("/add-lead","QueryController@add_new_lead");
	Route::post("/change_package","QueryController@change_package");
});

Route::get('/save_enq_type','QueryController@save_enq_type');
Route::get('/resend_otp','QueryController@resend_otp');
Route::post('/save_otp_Query','QueryController@save_otp_Query');
Route::get('/enq_with_otp','QueryController@savequery_with_otp');

//contact-us enquiry form
Route::post('/saveQuery','QueryController@saveQuery');
Route::post('/saveQuery3','QueryController@saveQuery');
Route::post('/saveQuery1','QueryController@saveQuery1');
Route::post('/saveQuery2','QueryController@saveQuery2');
Route::post('/detele_query/{id}','QueryController@detele_query');
Route::post('/detele_quotation/{id}','QueryController@detele_quotation');
Route::post('/disable_quotation/{id}','QueryController@disable_quotation');

//
Route::post('/add-tour-custom', 'RateController@add_tour_custom');
Route::post("/country_url","PackageManageController@country_url");
Route::post("/packagerating_url","PackageManageController@packagerating_url");
Route::get("/packagerating_url_new","PackageManageController@packagerating_url_new");
Route::post("/currency_url","PackageManageController@currency_url");
Route::post("/dayItineraryCity","PackageManageController@dayItineraryCity");
Route::post("/dayItineraryhotel","PackageManageController@dayItineraryhotel");
Route::post("/query_hotel_name","PackageManageController@query_hotel_name");
Route::post("/quote_hotel_name","PackageManageController@quote_hotel_name");
Route::post("/quote_hotel_data","PackageManageController@quote_hotel_data");
Route::post("/dayItinerarytour","PackageManageController@dayItinerarytour");
Route::post("/sort_tour_bycity","PackageManageController@sort_tour_bycity");
Route::get('get_activitieslist',"PackageManageController@get_activitieslist");
Route::get('autocomplete',"PackageManageController@autocomplete");
Route::get('get_similarpkgs',"PackageManageController@get_similarpkgs");
Route::get('get_similarseing',"PackageManageController@get_similarseing");
Route::get('check_package_availibility',"PackageManageController@check_package_availibility");
Route::get('check_package_code_availibility',"PackageManageController@check_package_code_availibility");
Route::get('search_quote_destination',"PackageManageController@search_quote_destination");

//Route::post("/search_enable","PackageManageController@search_enable");
//Route::post("/search_disable","PackageManageController@search_disable");
Route::post('/search_status', 'PackageManageController@toggle_search_status');


//Route::post("/enable","PackageManageController@enable");
//Route::post("/disable","PackageManageController@disable");
//Route::post('/packagestatus', 'PackageManageController@packageToggleStatus');
Route::post('/package_status', 'PackageManageController@toggle_second_page_package_status');


//Route::post("/front_enable","PackageManageController@front_enable");
//Route::post("/front_disable","PackageManageController@front_disable");
Route::post('/home_page_package_status', 'PackageManageController@toggle_home_page_package_status');


Route::post("/country_query","PackageManageController@country_query");


Route::get("/country_query_s","PackageManageController@country_query_s");  // to check for enquiry nationality
//Route::post("/country_query_s","PackageManageController@country_query_s"); // to check for contact-us nationality

Route::post("/country_code","PackageManageController@country_code");
Route::get("/country_code","PackageManageController@country_code");
Route::post('/add_package_hotel', 'PackageManageController@add_package_hotel');
Route::post('/add_hotel_star', 'PackageManageController@add_hotel_star');
//Route::get("/calendar-data","FrontController@calendar_data");
Route::get("/calendar-data/{id1}/{id2}/{id3}/{id4}","FrontController@calendar_data");
Route::get("/calendar-new-price/{id1}/{id2}","FrontController@calendar_data_new");

//
Route::post("/state_url","PackageManageController@state_url");
Route::post("/state_url1","PackageManageController@state_url1");
Route::post("/city_url","PackageManageController@city_url");

//
Route::post("/all_curr","PackageManageController@air_curr");
Route::post("/air_curr","PackageManageController@air_curr1");
Route::post("/hot_curr","PackageManageController@hot_curr");
Route::post("/tour_curr","PackageManageController@tour_curr");
Route::post("/transfer_curr","PackageManageController@transfer_curr");
Route::post("/visa_curr","PackageManageController@visa_curr");
Route::post("/adult_curr","PackageManageController@adult_curr");
Route::post("/chiildbed_curr","PackageManageController@chiildbed_curr");
Route::post("/chiildwbed_curr","PackageManageController@chiildwbed_curr");
Route::post("/infant_curr","PackageManageController@infant_curr");
Route::post("/single_curr","PackageManageController@single_curr");

//
Route::POST('/total_adult',"PackageManageController@total_adult");
Route::POST('/total_extra_adult',"PackageManageController@total_extra_adult");
Route::POST('/total_child_with_bed',"PackageManageController@total_child_with_bed");
Route::POST('/total_child_without_bed',"PackageManageController@total_child_without_bed");
Route::POST('/total_infant',"PackageManageController@total_infant");
Route::POST('/total_single',"PackageManageController@total_single");

// search destination
Route::get('/get_cities','UsersController@get_cities');
Route::post('/get_cities','UsersController@get_cities');
Route::get("/mid_image","FrontController@mid_image");
Route::get("/search-destination","FrontController@search_destination")->name('searchDestination');
//Route::get("/mobile_destination_search","FrontController@mobile_destination_search");
Route::get("/date_wise_price","FrontController@date_wise_price");

// theme based search using destination in search panel
Route::post("/search_theme","FrontController@search_theme")->name('searchTheme');
Route::post("/search_theme_mobile","FrontController@search_theme_mobile");

// Route::get('/{id}','HomeController@home_index');
Route::POST("/mid_image_save/{id}","RateController@mid_image_save");
Route::POST("/dest_add","RateController@dest_add");
//Route::post('/','PackagesController@index');
Route::get("/mid_package_data","FrontController@mid_package_data")->name('loadMoreItem');

// newsletter
Route::post("/newsletter","RateController@newsletter");

//load more packages on home
Route::post("/add_package","FrontController@add_package");
//Route::get("/add_package","FrontController@add_package");

//
Route::post("/add_theme","FrontController@add_theme");

Route::get("/holidays/{id}","FrontController@packages1");
Route::post("/holidays/{id}","FrontController@packages1");

Route::get("/holidays/{id}/theme/{id1}","FrontController@packages2");
Route::post("/holidays/{id}/theme/{id1}","FrontController@packages2");

Route::get("/theme/{id}","PackagesController@index");
Route::post("/enq_data","QueryController@enq_datas");
Route::get("/enq_datas","QueryController@enq_datas");
Route::post("/enq_update_data","QueryController@enq_update_data");
Route::get("/Testimonial-Detail/{id}","FrontController@testimonial_detail")->name('testimonials');

Route::get('/thankyou','CmsController@thankyou');
// Route::get('/bookingreview','CmsController@bookingreview');
// Route::get('/bookingreviewhtml','CmsController@bookingreviewhtml');
Route::get('/addtravellerhtml','CmsController@addtravellerhtml');
Route::get('/paymodehtml','CmsController@paymodehtml');
Route::get('/mbookingreviewhtml','CmsController@mbookingreviewhtml');
Route::get('get_transfertype',"PackageManageController@get_transfertype");

Route::get("/user-review/{id}",'RateController@user_review');
Route::POST("/store_reviews","RateController@store_reviews");

//Testing HTML-Lead Validations
Route::get('/add-payment','CmsController@add_payment');
Route::get('/lead-follow-up-html','CmsController@lead_follow_up');
Route::get('/phone-notreachable','CmsController@phone_not_reachable');
Route::get('/lead-cancelled-html','CmsController@leadcancelled');
Route::get('/pricing','CmsController@pricenegotiation');
Route::get('/send-quote','CmsController@send_quote');
Route::get('/modalpopup','CmsController@modal_popup');
Route::get('/servicestatus','CmsController@service_status');