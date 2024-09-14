<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ViewItemDetailsController;
use App\Http\Controllers\AddItemController;
use App\Http\Controllers\EditItemDetailsController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\PieChartController;
use App\Http\Controllers\LineChartController;
use App\Http\Controllers\AddCateringBookingController;
use App\Http\Controllers\CateringBookingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeliveryStatusController;



//chart
Route::get('/chart',[ChartController::class,'userChart']);

//pie chart
Route::get('/piechart',[PieChartController::class, 'pieChart']);

//Line chart
Route::get('/line-chart', [LineChartController::class, 'chart']);

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified','client'])
    ->name('dashboard');

    Route::view('management', 'management')
    ->middleware(['auth', 'verified','management'])
    ->name('management');

    Route::view('operation', 'operation')
    ->middleware(['auth', 'verified','operation'])
    ->name('operation');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';


// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('item-details', [ViewItemDetailsController::class,'viewItemDetails']);
Route::get('edit-item-details', [EditItemDetailsController::class,'editItemDetails']);
Route::put('update-details/{id}', [EditItemDetailsController::class, 'updateItemDetails'])->name('update-details');
Route::get('delete-item-details/{id}', [EditItemDetailsController::class,'deleteItemDetails']);
Route::get('image-form', [ImageUploadController::class, 'index']);
Route::post('upload', [ImageUploadController::class, 'upload']);
Route::post('submit-item', [AddItemController::class, 'addItem'])->name('submit.item');
Route::get('add-item', [AddItemController::class, 'additemform']);
Route::get('view-menu-page', [HomeController::class, 'viewmenupage']);
Route::get('/catering-booking', [CateringBookingController::class, 'index']);
Route::get('/customer-booking', [CateringBookingController::class, 'customerindex']);
Route::get('customerviewallproduct', [HomeController::class, 'customerviewallproduct']);
Route::get('add-booking', [AddCateringBookingController::class, 'addbookingform']);
Route::post('submit-booking', [AddCateringBookingController::class, 'addBooking'])->name('submit.booking');
Route::get('edit-booking-details', [CateringBookingController::class,'editBooking']);
Route::put('update-booking/{id}', [CateringBookingController::class, 'updateBooking'])->name('update-booking');
Route::get('delete-booking-details/{id}', [CateringBookingController::class,'deleteBooking']);
Route::get('cancel-booking-details/{id}', [CateringBookingController::class,'cancelBooking']);


Route::get('/managementmenu',[HomeController::class,'index']);
Route::get('/menu',[HomeController::class,'customerindex']);

Route::get('/redirect',[HomeController::class,'redirect']);

/*
Route::get('/', function () {
    return view('main');
});
*/

 
Route::resource('/receipt', ReceiptController::class);

/*
Route::get('/register',[AuthController::class, 'register'])->name('register');

Route::post('/register',[AuthController::class, 'registerPost'])->name('register');

Route::get('/login',[AuthController::class, 'login'])->name('login');

Route::post('/login',[AuthController::class, 'loginPost'])->name('login');
*/



//Route for invoices - the arrangement matters pay index create show etc.
Route::post('/invoices/{invoice}/pay', [InvoiceController::class, 'pay'])->name('invoice.pay');
Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoice.index');
Route::get('/invoices/create', [InvoiceController::class, 'create'])->name('invoice.create');
Route::get('/invoices/{id}', [InvoiceController::class, 'show'])->name('invoice.show');
Route::get('/invoices/{id}/edit', [InvoiceController::class, 'edit'])->name('invoice.edit');
Route::put('/invoices/{id}', [InvoiceController::class, 'update'])->name('invoice.update');
Route::delete('/invoices/{id}', [InvoiceController::class, 'destroy'])->name('invoice.destroy');
//must define the destroy method here or the button will no work, this is the url link wth function ability
Route::post('/invoices', [InvoiceController::class, 'store'])->name('invoice.store');


Route::get('/feedback/form', function () {
    return view('feedback_form');
})->name('feedback.form');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
Route::get('/feedback/show', [FeedbackController::class, 'show'])->name('feedback.show');



//delivery
Route::middleware(['operation'])->group(function () {
    Route::resource('delivery_status', DeliveryStatusController::class);
});

// Apply the Management middleware to the route that leads to the "View Feedback" page
Route::get('feedback/show', [FeedbackController::class, 'show'])->middleware('management')->name('feedback.show');



// Apply the Client middleware to the routes related to feedback in the client dashboard
Route::middleware(['client'])->group(function () {
    Route::get('feedback/form', [FeedbackController::class, 'showFeedbackForm'])->name('feedback.form');
    Route::post('feedback/store', [FeedbackController::class, 'store'])->name('feedback.store');
});


//Routes for customer
Route::get('/customers', [CustomerController::class, 'index'])->name('customer.index');
Route::get('/customers/create', [CustomerController::class, 'create'])->name('customer.create');
Route::get('/customers/{id}', [CustomerController::class, 'show'])->name('customer.show');
Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
Route::put('/customers/{id}', [CustomerController::class, 'update'])->name('customer.update');
Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');
Route::post('/customers', [CustomerController::class, 'store'])->name('customer.store');