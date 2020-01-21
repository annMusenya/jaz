<?php

/*
|--------------------------------------------------------------------------
| A. Authentication
|--------------------------------------------------------------------------
|
*/

Auth::routes();

/*
|--------------------------------------------------------------------------
| B. Customer Dashboard
|--------------------------------------------------------------------------
|
*/

Route::get('/','CustomerController@index');
Route::get('/login','CustomerController@login')->name("login");
Route::post('/upload-instructions','CustomerController@uploadFile');
Route::post('/login','CustomerController@authenticateCustomer');
Route::get('/logout','CustomerController@logout');
Route::get('/api/rates','CustomerController@rates');
Route::get('/orders','OrdersController@order')->middleware('revalidate');
Route::get('/orders/{id}','OrdersController@show')->middleware('revalidate');
Route::get('/finished','CustomerController@finished')->middleware('revalidate');
Route::get('/finished/{id}','OrdersController@show')->middleware('revalidate');
Route::get('/payments','CustomerController@payments')->middleware('revalidate');
Route::get('/settings','CustomerController@settings')->middleware('revalidate');
Route::get('/help','CustomerController@help')->middleware('revalidate');
Route::get('/success','PaypalPayment@getPaymentStatus');
Route::get('/success/{id}','PaypalPayment@getPaymentStatusRepay');
Route::post('/paypal-checkout','PaypalPayment@makePayment');
Route::get('/skrill-payment','SkrillPayment@makePayment');
Route::get('/system/api','CustomerController@api');
Route::post('/skrill-order','SkrillPayment@create');
Route::get('/payment-completed','SkrillPayment@paymentCompleted');
Route::post('/order/revise/{id}','OrdersController@setRevision');
Route::patch('/customer/approve/{id}','OrdersController@approve');
Route::post('/customer/review/{id}','CustomerController@review');
Route::post('/pay/order/{id}','PaypalPayment@addPayment');
Route::post('/password-reset','CustomerController@passwordReset');
Route::get('/my-account','CustomerController@myAccount')->middleware('revalidate');
Route::post('/cancel/{id}','OrdersController@setToCancelled');
Route::post('/restore/{id}','OrdersController@restoreOrder');
Route::get('/cancelled','CustomerController@cancelled');
Route::post('/uploads/{id}','OrdersController@uploads'); 
Route::post('/reset-password','CustomerController@resetPassword');

Route::post('/reply-message/{id}','OrdersController@replyMessage');
Route::post('/post-message/{id}','OrdersController@postMessage');


/*
|--------------------------------------------------------------------------
| B. Administrator Dashboard
|--------------------------------------------------------------------------
|
*/

Route::get('/admin', 'AdministratorController@index');
Route::get('/admin/order/{id}','AdministratorController@orderDetails');
Route::get('/admin/clients', 'AdministratorController@clients');
Route::get('/admin/writers', 'AdministratorController@writers');
Route::get('/admin/payments', 'AdministratorController@payments');
Route::get('/admin/referrals', 'AdministratorController@referrals');
Route::get('/admin/settings', 'AdministratorController@settings');
Route::get('/admin/finished', 'AdministratorController@finished');
Route::get('/admin/bidding', 'AdministratorController@bidding');
Route::get('/admin/help', 'AdministratorController@help');
Route::post('/add-academic','AdministratorController@addAcademic');
Route::post('/add-document','AdministratorController@addDocument');
Route::post('/add-subject','AdministratorController@addSubject');
Route::post('/add-deadline','AdministratorController@addDeadline');
Route::post('/add-citation','AdministratorController@addCitation');
Route::post('/add-additionals','AdministratorController@accessControl');
Route::post('/admin/post-message/{id}','AdministratorController@postMessage');
Route::post('/admin/reply-message/{id}','AdministratorController@replyMessage');
Route::get('/admin/login', 'AdministratorController@login');
Route::get('/admin/register','AdministratorController@register');  
Route::post('/admin/register','AdministratorController@createAdmin');
Route::post('/admin/login','AdministratorController@authenticateAdmin');
Route::get('admin/logout', 'AdministratorController@logout');
Route::get('/admin/bids/{id}','AdministratorController@showbids');

Route::patch('/order/activate-bidding/{id}','OrdersController@activateBidding');
Route::post('/order/reject/{id}','OrdersController@rejectOrder');
Route::post('/order/revision/{id}','OrdersController@setRevision');
Route::post('/admin/assign/{id}','OrdersController@assign');
Route::post('/admin/direct-assign/{id}','OrdersController@directAssign');
Route::patch('/order/deliver/{id}','OrdersController@deliver');
Route::post('/request-pay/{id}','OrdersController@requestPay');

Route::post('/register/writer','AdministratorController@registerWriter');

Route::get('/admin/user/{id}','AdministratorController@showProfile');
Route::post('/admin/uploads/{id}','AdministratorController@uploadFile');
Route::post('/approve-msg/{id}','AdministratorController@approveMessage');

Route::post('/suspend-user/{id}','AdministratorController@suspendUser');
Route::post('/restore-user/{id}','AdministratorController@restoreUser');

Route::post('/allow-file-access/{id}','AdministratorController@allowFileAccess');


/*
|--------------------------------------------------------------------------
| D. Writer Dashboard
|--------------------------------------------------------------------------
|
*/

Route::get('/writer','WriterController@index'); 
Route::get('/writer/login','WriterController@login');
Route::post('/writer/login','WriterController@authenticateWriter');
Route::get('/writer/logout','WriterController@logout');
Route::get('/writer/order-details/{id}','WriterController@orderDetails');
Route::get('/writer/bidding','WriterController@bidding');
Route::get('/writer/finished','WriterController@finished');
Route::get('/writer/payments','WriterController@payments');
Route::get('/writer/help','WriterController@help');
Route::get('/writer/messages','WriterController@messages');
Route::get('/writer/active','WriterController@assigned');
Route::get('/writer/done','WriterController@done');
Route::get('/writer/delivered','WriterController@delivered');
Route::get('/writer/revision','WriterController@revision');
Route::get('/writer/disputed','WriterController@disputed');

Route::post('/writer/bid','OrdersController@placeBid');
Route::get('/writer/reassign/{id}','OrdersController@reassign');
Route::post('/writer/done/{id}','OrdersController@setToDone');
Route::post('/writer/revised/{id}','OrdersController@revised');
Route::patch('/writer/accept/{id}','OrdersController@acceptJob');
Route::patch('/writer/reject/{id}','OrdersController@rejectJob');
Route::post('/writer/post-message/{id}','WriterController@postMessage');

Route::post('/writer/reply-message/{id}','WriterController@replyMessage');
Route::post('/writer/uploads/{id}','WriterController@uploads');


/*
|--------------------------------------------------------------------------
| E. Standard URLS
|--------------------------------------------------------------------------
|
*/

Route::get('/file/download/{id}','FilesController@download')->name('downloadfile');
Route::post('/file/delete/{id}','FilesController@delete')->name('deletefile');