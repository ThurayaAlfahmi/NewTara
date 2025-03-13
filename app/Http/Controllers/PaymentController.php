<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $payments = Payment::latest()->get() ;// List all payments
        return view('payment.list', compact('payments'));
    }

    public function list(Request $request)
    {
        $searchQuery = $request->input('q');
    
        $payments = Payment::query();
    
        if (!empty($searchQuery)) {
            $payments->where(function ($query) use ($searchQuery) {
                $query->where('id', 'LIKE', "%$searchQuery%")
                    ->orWhere('booking_id', 'LIKE', "%$searchQuery%")
                    ->orWhere('amount', 'LIKE', "%$searchQuery%")
                    ->orWhere('payment_method', 'LIKE', "%$searchQuery%")
                    ->orWhere('status', 'LIKE', "%$searchQuery%")
                    ->orWhereHas('booking.user', function ($subQuery) use ($searchQuery) {
                        $subQuery->where('name', 'LIKE', "%$searchQuery%");
                    });
            });
        }
    
        $payments = $payments->orderBy('id', 'desc')->paginate(20);
    
        return view('payment.list', compact('payments'));
    }
public function show(string $id)
{
    $id = dec($id);  // Decode the ID (if needed, similar to your booking show method)
    $payment = Payment::findOrFail($id);  // Fetch the payment from the database

    return view('payment.show', compact('payment'));
}


    /**
     * Show the form for creating a new resource.
     */

    // public function updatePaymentStatus($paymentId)
    // {
    //     // Find the payment record by ID
    //     $payment = Payment::findOrFail($paymentId);
    
    //     // Update the payment status to 'completed'
    //     $payment->status = 'completed';
    //     $payment->save();
    
    //     // Optionally, update the booking status if needed
    //     $booking = $payment->booking; // Assuming relationship is defined
    //     if ($payment->status == 'completed') {
    //         $booking->status = 'confirmed';  // Change booking status to confirmed
    //         $booking->save();
    //     }
    
    //     // Redirect back to the payment list with a success message
    //     return redirect()->route('payment.list')->with('success', 'تم تأكيد الدفع بنجاح!');
    // }
    public function updatePaymentStatus(Request $request, $paymentId)
    {
        $payment = Payment::findOrFail($paymentId);
    
        // Log the payment status before update (optional, for debugging)
        Log::info('Payment before update:', ['status' => $payment->status, 'payment_method' => $payment->payment_method]);
    
        // Check if the payment method is 'cash' and status is 'pending'
        if ($payment->payment_method == 'cash' && $payment->status == 'pending') {
            // Update the payment status to 'completed'
            $payment->status = 'completed';
            $payment->save();  // Save the updated status
    
            // Log the payment status after update (optional, for debugging)
            Log::info('Payment after update:', ['status' => $payment->status]);
    
            // Update the booking status to 'confirmed'
            $payment->booking->update(['status' => 'confirmed']);
    
            return redirect()->route('payment.list', $payment->id)->with('success', 'تم تحديث حالة الدفع بنجاح');
        }
    
        return redirect()->route('payments.show', $payment->id)->with('error', 'لا يمكن تحديث حالة الدفع');
    }
    
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //
        $payment = new Payment();
        $payment->booking_id = $request->booking_id;
        $payment->amount = $request->amount;
        $payment->payment_method = $request->payment_method;
        $payment->status = 'pending'; // Set default status
        $payment->save();

        // Handle payment logic (e.g., integrate with PayPal or Stripe)

        return redirect()->route('payments.index')->with('success', 'Payment created successfully');
   
    }
  
    /**
     * Display the specified resource.
     */
    // public function show( $id)
    // {
    //     //
    //     $payment = Payment::findOrFail($id); // Show a single payment
    //     return view('payments.show', compact('payment'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
   

     // Show the payment form (GET)
     public function showPaymentForm(Booking $booking)
     {
         return view('payment', compact('booking'));
     }
 
     // Process the payment (POST)
     public function processPayment(Request $request, Booking $booking)
{
    $request->validate([
        'payment_method' => 'required|in:credit_card,paypal,cash',
    ]);

    $status = $request->payment_method === 'cash' ? 'pending' : 'completed';

    $payment = Payment::create([
        'booking_id' => $booking->id,
        'amount' => $booking->total_price,
        'payment_method' => $request->payment_method,
        'status' => $status,
    ]);

    // If payment is not cash, update booking status to "confirmed"
    if ($status === 'completed') {
        $booking->update(['status' => 'confirmed']);
    }

    // Redirect based on payment method
    return $status === 'pending'
        ? redirect()->route('payment.pending')
        : redirect()->route('payment.success')->with('success', 'تم الدفع بنجاح!');
}

     
}