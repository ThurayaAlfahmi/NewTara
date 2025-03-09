<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Location;
use App\Models\bookings;
use App\Models\payments;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
    //
    public function index(){
   
        $cars =Car::all();
        $car_types = Car::select('car_type')->distinct()->get(); // جلب الفئات المميزة من قاعدة البيانات
        $locations = Location::all(); // Fetch all locations for the dropdown
        return view('welcome', compact('locations', 'cars', 'car_types'));
}

// public function adminDashboard()
// {  $cars = Cars::latest()->take(3)->get();
//     $locations = Locations::latest()->take(3)->get();
//     $bookings = Bookings::with(['car', 'pickupLocation', 'dropoffLocation'])->latest()->take(3)->get();
//     $payments = Payments::latest()->take(3)->get();

//     return view('admin.index', compact('cars', 'locations', 'bookings', 'payments'));
   
// }


public function searchCars(Request $request)
{
    $pickupLocation = $request->input('pickup_location');
    $dropoffLocation = $request->input('dropoff_location');
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    // Fetch available cars
    $availableCars = Car::where('location_id', $pickupLocation)
        ->where('availability', true)
        ->whereDoesntHave('bookings', function ($query) use ($startDate, $endDate) {
            $query->whereBetween('start_date', [$startDate, $endDate])
                  ->orWhereBetween('end_date', [$startDate, $endDate]);
        })
        ->get();
        

    return view('available-cars', compact('availableCars'));

}




    }
    