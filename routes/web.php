<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users_info\Users_info_cnt;
use App\Http\Controllers\PDFController;
//---> any new below
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\BookingController;

use App\Http\Controllers\myfrind\Myfrind_cnt;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\LocationController;



Route::get("/", function () {
    if (Auth::check()) { // Check if the user is logged in
        if (Auth::user()->id == 1) {
            return redirect()->intended(route('dashboard')); // Admin's dashboard
        } else {
            return redirect()->intended(route('home')); // Non-admin users
        }
    } else {
        return redirect()->route('login'); // Redirect to login if not authenticated
    }
});

Route::middleware("auth")->group(function () {

    Route::get("/dashboard",function(){return view("dashboard");})->name("dashboard");
    Route::get("users_info/list", [Users_info_cnt::class, "list"])->name("users_info.list");
    Route::get("users_info/{{users_info}}/show", [Users_info_cnt::class, "show"])->name("users_info.show");
    Route::get("users_info/pass", [Users_info_cnt::class, "pass"])->name("users_info.pass");
    Route::get("users_info/rep", [Users_info_cnt::class, "rep"])->name("users_info.rep");
    Route::post("users_info.rep_excel", [Users_info_cnt::class, "rep_excel"])->name("users_info.rep_excel");
    Route::post("users_info.rep_pdf", [Users_info_cnt::class, "rep_pdf"])->name("users_info.rep_pdf");
    Route::post("users_info.store", [Users_info_cnt::class, "store"]);
    Route::post("users_info.update", [Users_info_cnt::class, "update"]);
    Route::post("users_info.upass", [Users_info_cnt::class, "upass"]);
    Route::resource("users_info", Users_info_cnt::class);

    Route::get("myfrind/list", [Myfrind_cnt::class, "list"])->name("myfrind.list");
    Route::get("myfrind/{{myfrind}}/show", [Myfrind_cnt::class, "show"])->name("myfrind.show");
    Route::get("myfrind/rep", [Myfrind_cnt::class, "rep"])->name("myfrind.rep");
    Route::post("myfrind.rep_excel", [Myfrind_cnt::class, "rep_excel"])->name("myfrind.rep_excel");
    Route::post("myfrind.rep_pdf", [Myfrind_cnt::class, "rep_pdf"])->name("myfrind.rep_pdf");
    Route::post("myfrind.store", [Myfrind_cnt::class, "store"]);
    Route::post("myfrind.update", [Myfrind_cnt::class, "update"]);
    Route::resource("myfrind", Myfrind_cnt::class);
   

      
    Route::get('location/list', [LocationController::class, 'list'])->name('location.list');
    Route::get('location/{location}/show', [LocationController::class, 'show'])->name('location.show');
    Route::get('location/rep', [LocationController::class, 'rep'])->name('location.rep');
    Route::post('location.rep_excel', [LocationController::class, 'rep_excel'])->name('location.rep_excel');
    Route::post('location.rep_pdf', [LocationController::class, 'rep_pdf'])->name('location.rep_pdf');
    Route::post('location.store', [LocationController::class, 'store']);
    Route::post('/location.update', [LocationController::class, 'update']);
    Route::resource('location', LocationController::class);
   
    
    //Cars
    Route::get('car/list', [CarController::class, 'list'])->name('car.list');
    Route::get('car/{car}/show', [CarController::class, 'show'])->name('car.show');
    Route::get('car/rep', [CarController::class, 'rep'])->name('car.rep');
    Route::post('car.rep_excel', [CarController::class, 'rep_excel'])->name('car.rep_excel');
    Route::post('car.rep_pdf', [CarController::class, 'rep_pdf'])->name('car.rep_pdf');
    Route::post('car.store', [CarController::class, 'store']);
    Route::post('/car.update', [CarController::class, 'update']);
    Route::resource('car', CarController::class);

    
 // Bookings


    Route::get('bookings/list', [BookingController::class, 'list'])->name('bookings.list');
    Route::get('bookings/{booking}/show', [BookingController::class, 'show'])->name('bookings.show');
    Route::get('bookings/rep', [BookingController::class, 'rep'])->name('bookings.rep');
    Route::post('bookings/rep_excel', [BookingController::class, 'rep_excel'])->name('bookings.rep_excel');
    Route::post('bookings/rep_pdf', [BookingController::class, 'rep_pdf'])->name('bookings.rep_pdf');
    
    // Resource route for the BookingController (for actions like create, store, edit, update, destroy)
    Route::resource('bookings', BookingController::class);  // Use except if you only want to allow show and index
    
 
 //
  
 //payments
 Route::get('payments/list', [PaymentController::class, 'list'])->name('payment.list');
 Route::get('payments/{payment}/show', [PaymentController::class, 'show'])->name('payments.show');
 Route::patch('payments/{payment}/update', [PaymentController::class, 'updatePaymentStatus'])->name('payments.update');

//  Route::patch('admin/payments/{paymentId}', [PaymentController::class, 'updatePaymentStatus'])->name('admin.update.payment');
 
    
});




//user

// Route::get('/', [DashboardController::class, 'index'])->name('welcome');



// Home route for regular users
Route::get('/home', [DashboardController::class, 'index'])->name('home');

    // Route::get('/profile', [UserController::class, 'edit'])->name('profile.edit');
    // Route::put('/profile/{id}', [UserController::class, 'update'])->name('profile.update');  
    Route::get('/search-cars', [DashboardController::class, 'searchCars'])->name('search.cars');
    Route::get('/book-car/{car}', [BookingController::class, 'showBookingForm'])->name('book.car')->middleware('auth');
    Route::post('/confirm-booking/{car}', [BookingController::class, 'confirmBooking'])->name('confirm.booking')->middleware('auth');
    Route::post('/payment/{booking}', [PaymentController::class, 'showPaymentForm'])->name('payment.form')->middleware('auth');
    Route::get('/booking-summary/{booking}', [BookingController::class, 'showBookingSummary'])->name('booking.summary');
    Route::get('/payment/{booking}', [PaymentController::class, 'showPaymentForm'])->name('payment.form');
    Route::post('/process-payment/{booking}', [PaymentController::class, 'processPayment'])->name('process.payment');
    Route::get('/payment-success', function () {
        return view('payment-success');
    })->name('payment.success');
    Route::get('/payment-pending', function () {
        return view('payment-pending');
    })->name('payment.pending');
    
    //  Route::get('/dashboard', [UserController::class, 'profile'])->middleware('auth')->name('profile');
     Route::get('/user/cars', [CarController::class, 'showCars'])->name('user.cars');
    

require __DIR__."/auth.php";
