<?php
Route::get('/payment-receipt/{id}','PaymentSettingController@payment_receipt');
Route::post('/phonepe-payment','PhonepeController@phonepe');
Route::post('/phonepe-callback','PhonepeController@response');

Route::post('/paytm-payment', 'PaytmController@payment_store');
Route::post("/paytm-callback","PaytmController@paytmcallback");

Route::group(['middleware'=>['login','admin']],function() {
	Route::get('/Quote-Transactions','PaymentSettingController@quotetransactions')->name('quotetransactions');
	Route::get('/get_quote_list','PaymentSettingController@get_quote_list');
	Route::get('/quote_transactions_lists', 'PaymentSettingController@quote_transactions_lists')->name('quote_transactions_lists');	
	Route::get('/Transactions','PaymentSettingController@transactions')->name('transactions');
	Route::get('/transactions_lists', 'PaymentSettingController@transactions_lists')->name('transactions_lists');
	Route::get('/gat_payment_data','PaymentSettingController@gat_payment_data');

	Route::get('/Gateway-Settings','PaymentSettingController@gateway_settings')->name('gateway_settings');
	Route::get('/editgatewaysetting/{id}','PaymentSettingController@editgatewaysetting');
	Route::post('/updategatewaysetting','PaymentSettingController@updategatewaysetting');
	Route::post('/gateway_data','PaymentSettingController@gateway_data');
	Route::get('/Payment-Modes','PaymentSettingController@payment_mode')->name('payment_mode');
	Route::get('/Add-Payment-Mode','PaymentSettingController@add_payment_mode')->name('add_payment_mode');
	Route::post('/store_payment_mode','PaymentSettingController@store_payment_mode');
	Route::get('/editpaymentmode/{id}','PaymentSettingController@editpaymentmode');
	Route::post('/update_payment_mode','PaymentSettingController@update_payment_mode');
});

Route::group(['middleware'=>['login','user']],function(){ });