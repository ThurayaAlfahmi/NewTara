<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
        // عرض جميع الدفعات
        public function index()
        {
            $payments = Payment::with('booking')->orderBy('id', 'desc')->paginate(20);
            return view('payments.index', compact('payments'));
        }
    
        // عرض نموذج دفع جديد
        public function create()
        {
            $bookings = Booking::where('status', 'confirmed')->get();
            return view('payments.create', compact('bookings'));
        }
    
        // تخزين الدفع الجديد
        public function store(Request $request)
        {
            $request->validate([
                'booking_id' => 'required|exists:bookings,id',
                'amount' => 'required|numeric|min:0',
                'payment_method' => 'required|in:credit_card,paypal,cash',
            ]);
    
            Payment::create([
                'booking_id' => $request->booking_id,
                'amount' => $request->amount,
                'payment_method' => $request->payment_method,
                'status' => 'pending',
            ]);
    
            return redirect()->route('payments.index')->with('success', 'تمت إضافة الدفعة بنجاح!');
        }
    
        // عرض تفاصيل دفعة معينة
        public function show($id)
        {
            $payment = Payment::with('booking')->findOrFail($id);
            return view('payments.show', compact('payment'));
        }
    
        // تحديث حالة الدفع
        public function updateStatus(Request $request, $id)
        {
            $request->validate([
                'status' => 'required|in:pending,completed,failed',
            ]);
    
            $payment = Payment::findOrFail($id);
            $payment->update(['status' => $request->status]);
    
            return redirect()->route('payments.index')->with('success', 'تم تحديث حالة الدفع بنجاح!');
        }
    
        // حذف دفعة معينة
        public function destroy($id)
        {
            $payment = Payment::findOrFail($id);
            $payment->delete();
    
            return redirect()->route('payments.index')->with('success', 'تم حذف الدفعة بنجاح!');
        }
    }
    
