<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use App\Models\Location;
use Illuminate\Http\Request;

class BookingController extends Controller
{
        // عرض جميع الحجوزات
        public function index()
        {
            $bookings = Booking::with(['car', 'user', 'pickupLocation', 'dropoffLocation'])->orderBy('id', 'desc')->paginate(20);
            return view('bookings.index', compact('bookings'));
        }
    
        // عرض نموذج إنشاء حجز جديد
        public function create()
        {
            $cars = Car::where('availability', true)->get();
            $locations = Location::all();
            return view('bookings.create', compact('cars', 'locations'));
        }
    
        // تخزين الحجز الجديد
        public function store(Request $request)
        {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'car_id' => 'required|exists:cars,id',
                'pickup_location_id' => 'required|exists:locations,id',
                'dropoff_location_id' => 'required|exists:locations,id',
                'start_date' => 'required|date|after:today',
                'end_date' => 'required|date|after:start_date',
            ]);
    
            $car = Car::findOrFail($request->car_id);
            $total_days = \Carbon\Carbon::parse($request->start_date)->diffInDays($request->end_date);
            $total_price = $total_days * $car->daily_rate;
    
            Booking::create([
                'user_id' => $request->user_id,
                'car_id' => $request->car_id,
                'pickup_location_id' => $request->pickup_location_id,
                'dropoff_location_id' => $request->dropoff_location_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'total_days' => $total_days,
                'total_price' => $total_price,
                'status' => 'pending',
            ]);
    
            return redirect()->route('bookings.index')->with('success', 'تمت إضافة الحجز بنجاح!');
        }
    
        // عرض تفاصيل حجز معين
        public function show($id)
        {
            $booking = Booking::with(['car', 'user', 'pickupLocation', 'dropoffLocation'])->findOrFail($id);
            return view('bookings.show', compact('booking'));
        }
    
        // تحديث حالة الحجز
        public function updateStatus(Request $request, $id)
        {
            $request->validate([
                'status' => 'required|in:pending,confirmed,cancelled,completed',
            ]);
    
            $booking = Booking::findOrFail($id);
            $booking->update(['status' => $request->status]);
    
            return redirect()->route('bookings.index')->with('success', 'تم تحديث حالة الحجز بنجاح!');
        }
    
        // حذف حجز معين
        public function destroy($id)
        {
            $booking = Booking::findOrFail($id);
            $booking->delete();
    
            return redirect()->route('bookings.index')->with('success', 'تم حذف الحجز بنجاح!');
        }
    }
    
