<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\OperationController;



Route::get('/', function () {
    // return view('auth.login');
    return redirect()->route('home');
});

Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class)->middleware('can:User Module');
    Route::resource('users', UserController::class)->middleware('can:User Module');


    Route::get('salesshow', [SalesController::class, 'index'])->name('sales')->middleware('can:Sales Module');
    Route::get('salesdashboard', [SalesController::class, 'dashboard'])->name('sales.dashboard')->middleware('can:Sales Module');
    Route::get('salescreate', [SalesController::class, 'create'])->name('sales.create')->middleware('can:Sales Module');
    Route::post('salessave', [SalesController::class, 'store'])->name('sales.save')->middleware('can:Sales Module');
    Route::get('salesshow/{id}', [SalesController::class, 'show'])->name('sales.show')->middleware('can:Sales Module');
    Route::delete('salesdestroy/{id}', [SalesController::class, 'destroy'])->name('sales.destroy')->middleware('can:Sales Module');
    // Route::get('salesdestroy/{id}', [SalesController::class, 'destroy'])->name('sales.destroy')->middleware('can:Sales Module');
    Route::get('salesshowedit/{id}', [SalesController::class, 'edit'])->name('sales.edit')->middleware('can:Sales Module');
    Route::post('salesupdate/{id}', [SalesController::class, 'update'])->name('sales.update')->middleware('can:Sales Module');
    Route::post('salesnote', [SalesController::class, 'note'])->name('sales.note')->middleware('can:Sales Module');
    Route::post('salesupdfile', [SalesController::class, 'file_upload'])->name('sales.updfile')->middleware('can:Sales Module');
    Route::delete('filedelete/{id}', [SalesController::class, 'file_del'])->name('files.deleted')->middleware('can:Sales Module');
    Route::post('salesnotes', [SalesController::class, 'notes'])->name('sales.notes')->middleware('can:Sales Module');
    Route::post('salesdashboardreport', [SalesController::class, 'dashboard'])->name('sales.dashboard.rep')->middleware('can:Sales Module');

    Route::get('wealth-view', [App\Http\Controllers\WealthController::class,'index'])->name('wealth.index')->middleware('can:Wealth Module');
    Route::get('wealth-dashboard', [App\Http\Controllers\WealthController::class,'dashboard'])->name('wealth.dashboard')->middleware('can:Wealth Module');
    Route::get('wealth-add', [App\Http\Controllers\WealthController::class,'show'])->name('wealth.add')->middleware('can:Wealth Module');
    Route::post('add', [App\Http\Controllers\WealthController::class,'save'])->name('wealth-create')->middleware('can:Wealth Module');

    Route::delete('wealth/{id}', [App\Http\Controllers\WealthController::class, 'destroy'])->name('wealth.destroy')->middleware('can:Wealth Module');
    Route::get('wealth-view/{id}', [App\Http\Controllers\WealthController::class,'view'])->name('wealth.show')->middleware('can:Wealth Module');
    Route::get('wealth-view/{id}/edit', [App\Http\Controllers\WealthController::class,'edit'])->name('wealth.edit')->middleware('can:Wealth Module');
    Route::post('wealth-view/{id}/edit', [App\Http\Controllers\WealthController::class,'update'])->name('wealth.update')->middleware('can:Wealth Module');
    Route::post('wealth-uploadfile', [App\Http\Controllers\WealthController::class,'upload_file'])->name('wealth.upload_file')->middleware('can:Wealth Module');
    Route::delete('wealth-deletefile/{id}', [App\Http\Controllers\WealthController::class,'delete_file'])->name('wealth.delete_file')->middleware('can:Wealth Module');
    Route::delete('wealth/passholder/{id}/delete', [App\Http\Controllers\WealthController::class,'deletePassholder'])->name('wealth.delete.passholder')->middleware('can:Wealth Module');
    Route::post('wealth/passrelated_item_view', [App\Http\Controllers\WealthController::class,'passRelatedItemView'])->name('wealth.passrelated.item.view')->middleware('can:Wealth Module');
    
    Route::post('business-data', [App\Http\Controllers\WealthController::class,'business_tab_add'])->name('business.add')->middleware('can:Wealth Module');
    Route::delete('finance-destroy', [App\Http\Controllers\WealthController::class,'finance_destroy'])->name('wealth.finance_destroy')->middleware('can:Wealth Module');
    Route::delete('business-destroy', [App\Http\Controllers\WealthController::class,'business_destroy'])->name('wealth.business_destroy')->middleware('can:Wealth Module');
    
    Route::delete('company-destroy', [App\Http\Controllers\WealthController::class,'company_destroy'])->name('wealth.company_destroy')->middleware('can:Wealth Module');
    Route::delete('company-shareholder-destroy', [App\Http\Controllers\WealthController::class,'company_shareholder_destroy'])->name('wealth.company_shareholder_destroy')->middleware('can:Wealth Module');

    
    Route::post('operation-updfile', [OperationController::class, 'file_upload'])->name('operations.updfile')->middleware('can:Operation Module');
    Route::delete('filedel/{id}', [OperationController::class, 'file_del'])->name('op.files.delete')->middleware('can:Operation Module');
    Route::get('operation-dashboard', [OperationController::class, 'dashboard'])->name('operation.dashboard')->middleware('can:Operation Module');
    Route::post('operation-dashboard-report', [OperationController::class, 'dashboard'])->name('operation.dashboard.report')->middleware('can:Operation Module');
    Route::get('operation-view', [OperationController::class, 'index'])->name('operation.index')->middleware('can:Operation Module');
    Route::delete('opeeration/{id}', [OperationController::class, 'destroy'])->name('operation.destroy')->middleware('can:Operation Module');

    Route::get('operationcreate', [OperationController::class, 'create'])->name('operation.create')->middleware('can:Operation Module');
    Route::post('operationstore', [OperationController::class, 'store'])->name('operation.store')->middleware('can:Operation Module');
    Route::post('operationsave', [OperationController::class, 'store'])->name('operation.save')->middleware('can:Operation Module');
    Route::get('operation-view/{id}', [OperationController::class,'view'])->name('operation.show')->middleware('can:Operation Module');
    Route::get('operation-view/{id}/edit', [OperationController::class,'edit'])->name('operation.edit')->middleware('can:Operation Module');
    Route::post('operation-update/{id}', [OperationController::class, 'update'])->name('operation.update')->middleware('can:Operation Module');


    Route::get('financenewapp','App\Http\Controllers\financecontroller@newapp')->name('finance.newapp');
    Route::post('financesave','App\Http\Controllers\financecontroller@appstore')->name('finance.save');
    Route::post('financeupdate','App\Http\Controllers\financecontroller@appupdate')->name('finance.update');
    Route::post('financeshow','App\Http\Controllers\financecontroller@showapp')->name('finance');
    Route::get('financeallapps','App\Http\Controllers\financecontroller@showapp')->name('finance.allapps');
    Route::delete('financeallappdestroy/{id}','App\Http\Controllers\financecontroller@destroy')->name('finance.destroy');
    Route::get('financeshow/{id}','App\Http\Controllers\financecontroller@showdetails')->name('finance.show');
    Route::get('financeedit/{id}','App\Http\Controllers\financecontroller@editdetails')->name('finance.edit');
    Route::get('finance-dashboard','App\Http\Controllers\financecontroller@dashboard')->name('finance.dashboard');


    Route::get('education-dashboard', [App\Http\Controllers\EducationController::class,'dashboard'])->name('education.dashboard')->middleware('can:Education Module');
    Route::get('education-add', [App\Http\Controllers\EducationController::class,'add'])->name('education.add')->middleware('can:Education Module');
    Route::post('education-add', [App\Http\Controllers\EducationController::class,'store'])->name('education.create')->middleware('can:Education Module');
    Route::get('education-view/{id}', [App\Http\Controllers\EducationController::class,'view'])->name('education.view')->middleware('can:Education Module');
    Route::get('education-view', [App\Http\Controllers\EducationController::class,'index'])->name('education.index')->middleware('can:Education Module');


    Route::post('notes', [App\Http\Controllers\HomeController::class,'createnotes'])->name('notes');
    Route::post('note-destroy', [App\Http\Controllers\HomeController::class,'removeNote'])->name('removeNote');


});

//Clear Cache facade value:toomany
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    echo '<h1>Cache facade value cleared</h1>';
    die();
});

//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    echo  '<h1>Reoptimized class loader</h1>';
    die();
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    echo  '<h1>Routes cached</h1>';
    die();
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    echo  '<h1>Route cache cleared</h1>';
    die();
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    echo  '<h1>View cache cleared</h1>';
    die();
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    echo  '<h1>Clear Config cleared</h1>';
    die();
});
