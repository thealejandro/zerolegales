<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//Auth::routes();

// Auth::routes(['register' => false]);

//Auth::routes(['verify' => true]); 

/*---------------------------------Front End -----------------------------------------------*/
Route::get('/', 'Front\LegalDocumentController@index')->name('front.index');

Route::get('document-list', 'Front\LegalDocumentController@index')->name('document.index');

Route::get('price-list', 'Front\PriceController@index')->name('price.index');

Route::get('purchase/{id}', 'Front\PriceController@purchase')->name('purchase');
Route::post('price-index-list', 'Front\PriceController@indexList')->name('price.list');

Route::get('document-list/search', 'Front\LegalDocumentController@search')->name('document.search');

Route::get('myfolders-list', 'Front\SubscriptionController@myFolders')->name('myfolder.list');
      
Route::get('user/create', 'Front\UserController@create')->name('user.create');

Route::post('user/store', 'Front\UserController@store')->name('user.store');

Route::get('login', 'Front\LoginController@login')->name('login');

Route::post('login', 'Front\LoginController@authenticate')->name('login');

Route::get('login/facebook', 'Front\FacebookController@redirectToFacebook');

Route::get('login/facebook/callback', 'Front\FacebookController@handleFacebookCallback');

Route::get('login/google', 'Front\GoogleController@redirectToGoogle');

Route::get('login/google/callback', 'Front\GoogleController@handleGoogleCallback');

Route::get('forgot-password', 'Front\ForgotPasswordController@forgotPassword')->name('user.forgot.password');

Route::post('forgot-password/send-mail', 'Front\ForgotPasswordController@sendForgotMail')->name('user.forgot.password.send_mail');

Route::get('forgot-mail-send-success', 'Front\ForgotPasswordController@sendForgotMailSuccess')->name('user.forgot.password.send_mail.success');

Route::get('new-password/{id}', 'Front\ForgotPasswordController@newPasswordView')->name('user.new.password');

Route::post('new-password/confirm-new-password', 'Front\ForgotPasswordController@newpasswordUpdate')->name('user.confirm.newpassword');

Route::get('new-password-success', 'Front\ForgotPasswordController@newPasswordSuccess')->name('user.new.password.success');

Route::get('user/get-subscription-data', 'Front\ProfileController@subscriptionData')->name('user.getSubscriptionData');

Route::get('mail/verification/{token}', 'Front\VerificationController@verifyUser')->name('mail.verification');

Route::get('lawyer-link/show/{id}', 'Front\LegalizationController@lawyerLink')->name('lawyer.link.show');

Route::get('lawyer-link/status', 'Front\LegalizationController@changeStatus')->name('lawyer.link.status');

Route::get('view-pdf/{u_id}/{id}', 'Front\DocumentFillingController@pdfDownload')->name('document.download');

Route::get('register/complete', 'Front\UserController@registerComplete')->name('register.complete');

// Route::post('cybersource/payment/confirm', function (){
// 	$data = request()->all();
// 	// dd($data);
// 	return view('cybersource.secure.confirm', compact('data'));
// })->name('secure.payment.confirm');

// Route::post('cybersource/payment/response', function (){
// 	$data = request()->all();
// // dd($data);
// return view('front.user.payment-response', compact('data'));
// })->name('cybersource.payment.response');

Route::get('cybersource/payment/user/payment/update/{id}/{txn}', 'Front\ProfileController@paymentResponse')->name('user.payment.update');

Route::get('cybersource/payment/response/user/payment/update/BuyFillDocument/{id}/{txn}', 'Front\PurchaseController@storeBuyFillDocumentPurchase')->name('user.payment.update.BuyFillDocument');

Route::get('cybersource/payment/response/user/payment/update/FillBuyDocument/{id}/{txn}', 'Front\PurchaseController@storeFillBuyDocumentPurchase')->name('user.payment.update.FillBuyDocument');

Route::get('cybersource/payment/response/user/payment/update/FillBuyPurchase/{id}/{txn}', 'Front\PurchaseController@storeFillBuyPurchase')->name('user.payment.update.FillBuyPurchase');

Route::get('cybersource/payment/response/user/payment/update/Checklist/{id}/{txn}', 'Front\PurchaseController@storeChecklistPurchase')->name('user.payment.update.Checklist');

Route::get('cybersource/payment/response/user/payment/update/LegalisationPurchase/{id}/{txn}', 'Front\PurchaseController@storeLegalisationPurchase')->name('user.payment.update.Checklist');

Route::get('cybersource/payment/response/user/payment/update/LegalisationMyFolder/{id}/{txn}', 'Front\PurchaseController@storeLegalisationMyFolder')->name('user.payment.update.LegalisationMyFolder');

Route::get('cybersource/payment/response/user/payment/update/BuyFillDocument/redirect/{id}/{txn}', 'Front\PurchaseController@storeBuyFillDocumentPurchaseRedirect')->name('user.payment.update.BuyFillDocument');

Route::get('cybersource/payment/response/user/payment/update/FillBuyDocument/redirect/{id}/{txn}', 'Front\PurchaseController@storeFillBuyDocumentPurchaseRedirect')->name('user.payment.update.FillBuyDocument');

Route::get('cybersource/payment/response/user/payment/update/FillBuyPurchase/redirect/{id}/{txn}', 'Front\PurchaseController@storeFillBuyPurchaseRedirect')->name('user.payment.update.FillBuyPurchase');

Route::get('cybersource/payment/response/user/payment/update/Checklist/redirect/{id}/{txn}', 'Front\PurchaseController@storeChecklistPurchaseRedirect')->name('user.payment.update.Checklist');

Route::get('cybersource/payment/response/user/payment/update/LegalisationPurchase/redirect/{id}/{txn}', 'Front\PurchaseController@storeLegalisationPurchaseRedirect')->name('user.payment.update.Checklist');

Route::get('cybersource/payment/response/user/payment/update/LegalisationMyFolder/redirect/{id}/{txn}', 'Front\PurchaseController@storeLegalisationMyFolderRedirect')->name('user.payment.update.LegalisationMyFolder');

Route::name('user.')->middleware(['auth'])->group(function () {

    Route::get('data-invoice', 'Front\InvoiceDataController@index')->name('data-invoice');

    Route::get('document', 'Front\LegalDocumentController@index')->name('document');

    Route::get('document/search', 'Front\LegalDocumentController@search')->name('document.search');

    Route::get('document/show/{id}', 'Front\LegalDocumentController@show')->name('document.show');

    Route::get('document-filling/fill-buy/{id}', 'Front\DocumentFillingController@createFillBuy')->name('nosubscription.create.fill.buy');

    Route::get('document-filling/subscription/{id}', 'Front\DocumentFillingController@createDocumentFilling')->name('subscription.create.document.fill');

    Route::get('document-filling/buy-fill/{id}/{invoice_id}', 'Front\DocumentFillingController@createBuyFill')->name('nosubscription.create.buy.fill');

    Route::post('document-filling/nosubscription/fill-buy/store', 'Front\DocumentFillingController@storeFillBuy')->name('nosubscription.fill.buy.store');

    Route::post('document-filling/nosubscription/buy-fill/store', 'Front\DocumentFillingController@storeBuyFill')->name('nosubscription.buy.fill.store');

    Route::get('document-filling/nosubscription/fill-buy/show/{id}/{u_id}', 'Front\DocumentFillingController@showFillBuy')->name('nosubscription.show.fill.buy');

    Route::get('document-filling/nosubscription/buy-fill/show/{id}/{u_id}', 'Front\DocumentFillingController@showBuyFill')->name('nosubscription.show.buy.fill');

    Route::post('labels', 'Front\DocumentFillingController@getLabels')->name('labels');

    Route::post('label-values', 'Front\DocumentFillingController@getLabelValues')->name('label-values');

    Route::post('fetch-user-data', 'Front\SubscriptionController@getDataForAutoFetch')->name('fetch_user_data');

    Route::post('myfolder/store','Front\SubscriptionController@storeMyFolder')->name('myfolder.store');

    Route::get('myfolders', 'Front\SubscriptionController@myFolders')->name('myfolder.index');

    Route::get('myfolders/show/{f_id}', 'Front\SubscriptionController@show')->name('myfolder.show');

    Route::get('myfolders/search', 'Front\SubscriptionController@searchFolder')->name('folder.search');

    Route::post('myfolder/legalisation', 'Front\SubscriptionController@legalisationMyFolder')->name('myfolder.legalisation');

    

    Route::get('document-filling/nosubscription/fill-buy/edit/{id}/{u_id}', 'Front\DocumentFillingController@editFillBuy')->name('nosubscription.fill.buy.edit');

    Route::post('document-filling/nosubscription/fill-buy/update', 'Front\DocumentFillingController@updateFillBuy')->name('nosubscription.fill.buy.update');

    Route::get('document-filling/nosubscription/buy-fill/edit/{id}/{u_id}', 'Front\DocumentFillingController@editBuyFill')->name('nosubscription.buy.fill.edit');

    Route::post('document-filling/nosubscription/buy-fill/update', 'Front\DocumentFillingController@updateBuyFill')->name('nosubscription.buy.fill.update');
    
    Route::post('legaldocument/change', 'Front\DocumentFillingController@change')->name('legaldocument.change');

    Route::post('legaldocument/store', 'Front\LegalizationController@store')->name('legaldocument.store');

    Route::post('legalisation/mail', 'Front\LegalizationController@sentMailLegalisation')->name('legalisation');

    Route::post('document-purchase/buy-fill', 'Front\PurchaseController@storeBuyFillDocumentPurchase')->name('buy.fill.document.purchase');

    Route::post('document-purchase/fill-buy', 'Front\PurchaseController@storeFillBuyDocumentPurchase')->name('fill.buy.document.purchase');

    Route::post('fill-buy/purchase', 'Front\PurchaseController@storeFillBuyPurchase')->name('fill.buy.purchase');

    // Route::post('legalisation/purchase', 'Front\PurchaseController@storeLegalisationPurchase')->name('legalisation.purchase');

    Route::get('checklist/download/{id}', 'Front\ChecklistController@downloadCheckList')->name('checklist.download');
    
    Route::get('document-purchase/show/{id}/', 'Front\LegalizationController@purchaseDetails')->name('document.purchase.details');

    Route::get('legalisation/state','Front\LegalizationController@legalisationState')->name('legalisation.state');

    Route::get('legalisation/loading','Front\LegalizationController@loadingLegalisation')->name('legalisation.loading');
    
    Route::get('document-purchase/after/{id}/{u_id}', 'Front\DocumentFillingController@afterPurchase')->name('document.purchase.after');

    Route::get('after/purchase/edit/{id}/{u_id}', 'Front\DocumentFillingController@editAfterPurchase')->name('after.purchase.edit');

    Route::post('after/purchase/update', 'Front\DocumentFillingController@updateAfterPurchase')->name('after.purchase.update');

    Route::get('document-filling/continue-process/{u_id}/{id}', 'Front\DocumentFillingController@removeWatermark')->name('document.filling.process');

    Route::get('document-progress', 'Front\DocumentFillingController@documentInProgress')->name('document.progress');
    
    Route::get('document/download/{u_id}/{id}', 'Front\DocumentFillingController@pdfDownload')->name('document.download');

    //Route::get('document/after-download/{u_id}/{id}', 'Front\DocumentFillingController@afterDownload')->name('document.after.download');

    Route::get('prices', 'Front\PriceController@index')->name('price');

    Route::post('prices-list', 'Front\PriceController@indexList')->name('price.list');

    
    Route::any('user/logout', 'Front\LoginController@logout')->name('logout');

    Route::get('profile','Front\ProfileController@getProfile')->name('profile');
    
    Route::post('user/profile-image','Front\ProfileController@changeProfileImage')->name('profile-image');

    Route::get('user/profile-image/current/{data}','Front\ProfileController@currentPasswordCheck')->name('profile-image-current');

    Route::post('user/account-data','Front\ProfileController@saveAccountData')->name('account-data');

    Route::post('user/personal-data','Front\ProfileController@savePersonalData')->name('personal-data');
    
    Route::get('document-filling/view-pdf/{u_id}/{id}', 'Front\DocumentFillingController@documentPdfVAiew')->name('document.filling.pdf');
    
    Route::post('download-status/update', 'Front\DocumentFillingController@updateDownloadStatus')->name('download.status.update');


    Route::get('user/remove-upload-file/{id}', 'Front\ProfileController@removePdf')->name('remove.upload.file');

    Route::get('user/payment', 'Front\ProfileController@paymentTest')->name('payment');


    Route::get('user/cancel-without-credit','Front\ProfileController@cancelWithoutCredit')->name('cancel-without-credit');

    Route::get('user/cancel-keep-credit','Front\ProfileController@cancelKeepCredit')->name('cancel-keep-credit');

    Route::get('document/download-pdf/{u_id}/{id}', 'Front\LegalizationController@getDownload')->name('document.download.pdf');

    Route::get('cancel/subscription/mail', 'Front\MailController@cancelSubscription')->name('cancel.subscription.mail');

    Route::get('renewal/subscription/mail', 'Front\MailController@renewalSubscription')->name('renewal.subscription.mail');

    Route::get('change/subscription/mail', 'Front\MailController@changeSubscription')->name('change.subscription.mail');

    Route::get('payment/success/mail', 'Front\MailController@successPayment')->name('payment.success.mail');

    Route::get('subscription/purchase', 'Front\MailController@subscriptionPurchase')->name('subscription.purchase.mail');
    
    Route::get('user/purchase/history', 'Front\PurchaseController@userPurchaseHistory')->name('purchase.history');

    Route::get('cybersource/payment/user/save-invoice-data/{id}/{isCheck}/{nit?}/{name?}/{address?}','Front\InvoiceDataController@saveSubscribedInvoiceData')->name('save-invoice-data');

    Route::get('cybersource/payment/response/user/save-invoice-data-document/{id}/{isCheck}/{nit?}/{name?}/{address?}','Front\InvoiceDataController@saveDocumentInvoiceData')->name('save-invoice-data');


    Route::get('cybersource/payment/response', function (){
            return view('front.user.payment-response');
    })->name('cybersource.payment.response');



    Route::get('cybersource/payment/response/updateBuyFillDocument', function (){
        $data = request()->all();
        return view('front.user.payment-response-BuyFillDocument')->with(['data'=>$data]);
    })->name('cybersource.payment.response.updateBuyFillDocument');

    Route::get('cybersource/payment/response/updateFillBuyDocument', function (){
        $data = request()->all();
        return view('front.user.payment-response-FillBuyDocument')->with(['data'=>$data]);
    })->name('cybersource.payment.response.updateFillBuyDocument');

    Route::get('cybersource/payment/response/updateFillBuyPurchase', function (){
        $data = request()->all();
        return view('front.user.payment-response-FillBuyPurchase')->with(['data'=>$data]);
    })->name('cybersource.payment.response.updateFillBuyPurchase');

    Route::get('cybersource/payment/response/updateLegalisationPurchase', function (){
        $data = request()->all();
        return view('front.user.payment-response-LegalisationPurchase')->with(['data'=>$data]);
    })->name('cybersource.payment.response.updateLegalisationPurchase');

    Route::get('cybersource/payment/response/updateChecklist', function(){
        $data = request()->all();
        return view('front.user.payment-response-Checklist')->with(['data'=>$data]);
    })->name('cybersource.payment.response.updateChecklist');




    //Payment In Document filling 
    Route::get('buy-fill/document-purchase/invoice/{id}', 'Front\PurchaseController@invoiceBuyFillDocumentPurchase')->name('buy.fill.document.purchase.invoice');
    Route::get('fill-buy/document-purchase/invoice/{id}/{u_id}', 'Front\PurchaseController@invoiceFillBuyDocumentPurchase')->name('fill.buy.document.purchase.invoice');
    Route::get('fill-buy/purchase/invoice/{id}/{u_id}', 'Front\PurchaseController@invoiceFillBuyPurchase')->name('fill.buy.purchase.invoice');
    Route::get('buy-fill/legalisation/invoice/{id}/{u_id}', 'Front\PurchaseController@invoiceLegalisationPurchase')->name('buy.fill.legalisation.invoice');
    Route::get('checklist/invoice/{id}', 'Front\PurchaseController@invoiceChecklist')->name('checklist.invoice');
    Route::get('myfolder/legalisation/invoice/{id}/{u_id}', 'Front\PurchaseController@invoiceMyFolderLegalisationPurchase')->name('myfolder.legalisation.invoice'); 
});

/*----------------------------------Admin---------------------------------------------------*/

Route::any('system-admin-login',  'Admin\Auth\LoginController@index')->name('admin_login');

Route::post('/login/admin', 'Admin\Auth\LoginController@adminLogin')->name('admin_login');
 
Route::name('admin.')->middleware(['admin'])->group(function () {

    Route::get('admin/dashboard', 'Admin\AdminController@adminDashboard')->name('dashboard');

    // Report section
    Route::get('manage-user-report','Admin\AdminController@manageUserReport')->name('users.report');

    Route::get('report1','Admin\ReportController@report1')->name('report1');
    Route::post('reports/report1-datatable', 'Admin\ReportController@datatableReport1')->name('reports.report1.datatable');

    Route::get('report2','Admin\ReportController@report2')->name('report2');
    Route::post('reports/report2-datatable', 'Admin\ReportController@datatableReport2')->name('reports.report2.datatable');

    Route::get('report3','Admin\ReportController@report3')->name('report3');
    Route::post('reports/report3-datatable', 'Admin\ReportController@datatableReport3')->name('reports.report3.datatable');

    Route::get('report4','Admin\ReportController@report4')->name('report4');
    Route::post('reports/report4-datatable', 'Admin\ReportController@datatableReport4')->name('reports.report4.datatable');

    Route::get('admin/get-user-report-list','Admin\AdminController@getUserReportList')->name('users.report.list');
    Route::post('admin/filter-user', 'Admin\AdminController@filterUser')->name('users.report.list.filter');

    Route::get('manage-subscription-report','Admin\AdminController@manageSubscriptionReport')->name('subscription.report');
    Route::get('admin/get-subscription-report-list','Admin\AdminController@getSubscriptionReportList')->name('subscription.report.list');

    //end report section

    Route::get('lawyers-directory','Admin\LawyersDirectoryController@index')->name('lawyers.directory.index');
    Route::get('lawyers-directory/create', 'Admin\LawyersDirectoryController@create')->name('lawyers.directory.create');
    Route::post('lawyers-directory/store', 'Admin\LawyersDirectoryController@store')->name('lawyers.directory.store');
    Route::get('lawyers-directory/edit/{id}', 'Admin\LawyersDirectoryController@edit')->name('lawyers.directory.edit');
    Route::post('lawyers-directory/update/{id}', 'Admin\LawyersDirectoryController@update')->name('lawyers.directory.update');
    Route::post('lawyers-directory/delete/{id}', 'Admin\LawyersDirectoryController@destroy');
    Route::get('lawyers-directory/changeStatus', 'Admin\LawyersDirectoryController@changeStatus');
    
    Route::post('assign/price', 'Admin\LawyersDirectoryController@assignPrice')->name('lawyers.directory.assign.price');
    Route::post('price/update', 'Admin\LawyersDirectoryController@updatePrice')->name('lawyers.directory.update.price');

    Route::get('category','Admin\CategoryController@index')->name('category.index');
    Route::get('category/create', 'Admin\CategoryController@create')->name('category.create');
    Route::post('category/store', 'Admin\CategoryController@store')->name('category.store');
    Route::get('category/edit/{id}', 'Admin\CategoryController@edit')->name('category.edit');
    Route::post('category/update/{id}', 'Admin\CategoryController@update')->name('category.update');
    Route::post('category/delete/{id}', 'Admin\CategoryController@destroy');

    Route::get('template','Admin\LegalDocumentTemplateController@index')->name('template.index');
    Route::get('template/create', 'Admin\LegalDocumentTemplateController@create')->name('template.create');
    Route::post('template/store', 'Admin\LegalDocumentTemplateController@store')->name('template.store');
    Route::get('template/edit/{id}', 'Admin\LegalDocumentTemplateController@edit')->name('template.edit');
    Route::post('template/update/{id}', 'Admin\LegalDocumentTemplateController@update')->name('template.update');
    Route::get('template/changeStatus', 'Admin\LegalDocumentTemplateController@changeStatus');

    Route::post('template/body/store', 'Admin\LegalDocumentTemplateController@storeBody')->name('body.store');

    Route::post('template/document-variable/store', 'Admin\LegalDocumentTemplateController@storeVariableDocument')->name('document.variable.store');
    Route::post('template/document-variable/edit', 'Admin\LegalDocumentTemplateController@editVariableDocument');
    Route::post('template/document-variable/update', 'Admin\LegalDocumentTemplateController@updateVariableDocument')->name('document.variable.update');
    Route::post('template/document-variable/delete/{id}', 'Admin\LegalDocumentTemplateController@destroyVariableDocument');
    Route::get('template/get-all-variables', 'Admin\LegalDocumentTemplateController@getInputVariables');
    Route::get('template/edit-iput-variables', 'Admin\LegalDocumentTemplateController@getEditFormInputVariables');
    
    Route::get('input-variable','Admin\InputVariableController@index')->name('input.variable.index');
    Route::get('input-variable/create', 'Admin\InputVariableController@create')->name('input.variable.create');
    Route::post('input-variable/store', 'Admin\InputVariableController@store')->name('input.variable.store');
    Route::get('input-variable/edit/{id}', 'Admin\InputVariableController@edit')->name('input.variable.edit');
    Route::post('input-variable/update/{id}', 'Admin\InputVariableController@update')->name('input.variable.update');
    Route::delete('input-variable/delete/{id}', 'Admin\InputVariableController@destroy');

    Route::get('terms-conditions','Admin\TermsAndConditionsController@index')->name('terms-conditions.index');
    Route::get('terms-conditions/create', 'Admin\TermsAndConditionsController@create')->name('terms-conditions.create');
    Route::post('terms-conditions/store', 'Admin\TermsAndConditionsController@store')->name('terms-conditions.store');
    Route::get('terms-conditions/edit/{id}', 'Admin\TermsAndConditionsController@edit')->name('terms-conditions.edit');
    Route::post('terms-conditions/update/{id}', 'Admin\TermsAndConditionsController@update')->name('terms-conditions.update');

    Route::get('price-matrix','Admin\PriceMatrixController@index')->name('price.matrix.index');
    Route::get('price-matrix/create', 'Admin\PriceMatrixController@create')->name('price.matrix.create');
    Route::post('price-matrix/store', 'Admin\PriceMatrixController@store')->name('price.matrix.store');
    Route::get('price-matrix/edit/{id}', 'Admin\PriceMatrixController@edit')->name('price.matrix.edit');
    Route::post('price-matrix/update/{id}', 'Admin\PriceMatrixController@update')->name('price.matrix.update');
    Route::post('price-matrix/delete/{id}', 'Admin\PriceMatrixController@destroy');


    Route::get('users','Admin\UserController@index')->name('users.index');
    Route::get('users/changeStatus', 'Admin\UserController@changeStatus');


    Route::get('invoice-data','Admin\InvoiceDataController@index')->name('invoice-data.index');
    Route::post('invoice-data/datatable', 'Admin\InvoiceDataController@datatableInvoiceData')->name('invoice-data.datatable');


    Route::any('admin/logout', 'Admin\Auth\LoginController@adminLogout')->name('logout');

});