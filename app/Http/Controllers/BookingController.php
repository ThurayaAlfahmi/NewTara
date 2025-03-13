<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use TCPDF;
use Illuminate\Support\Facades\View;
use Alkoumi\LaravelHijriDate\Hijri;

class BookingController extends Controller
{
 
        public function index()
        {
            
            return view('dashboard');
        }
    
        public function show(string $id)
        {
            $id = dec($id); 
            $booking = Booking::findOrFail($id);
    
            return view('booking.show', compact('booking'));
        }
    
       

        public function list(Request $request)
        {
            $searchQuery = $request->input('q');
        
            $Booking = Booking::query();
        
            if (!empty($searchQuery)) {
                $Booking->where(function ($query) use ($searchQuery) {
                    $query->where('id', 'LIKE', "%$searchQuery%")
                        ->orWhere('status', 'LIKE', "%$searchQuery%")
                        ->orWhereHas('user', function ($subQuery) use ($searchQuery) {
                            $subQuery->where('name', 'LIKE', "%$searchQuery%");
                        
                        })
                        ->orWhereHas('car', function ($subQuery) use ($searchQuery) {
                            $subQuery->where('name', 'LIKE', "%$searchQuery%");
                        })
                        ->orWhereHas('pickupLocation', function ($subQuery) use ($searchQuery) {
                            $subQuery->where('city', 'LIKE', "%$searchQuery%");
                        })
                        ->orWhereHas('dropoffLocation', function ($subQuery) use ($searchQuery) {
                            $subQuery->where('city', 'LIKE', "%$searchQuery%");
                        });
                    });
                }

            $bookings = $Booking->orderBy('id', 'desc')->paginate(20);
        
            return view('booking.list', compact('bookings'));
        }
    
        public function rep()
        {
            return view('booking.rep');
        }


        public function rep_excel(Request $request)
        {
            $query = $request->input('q');
            
            $bookingsQuery = Booking::query();
    
            if (!empty($query)) {
                $bookingsQuery->where('user_name', 'LIKE', "%$query%")
                              ->orWhere('car_name', 'LIKE', "%$query%");
            }
    
            $bookings = $bookingsQuery->orderBy('id', 'desc')->get();
            $bookingsCount = $bookingsQuery->count();
    
            return view('booking.excel', compact('bookings', 'bookingsCount'));
        }
    
        public function rep_pdf(Request $request)
        {
            $query = $request->input('q');
    
            $bookingsQuery = Booking::query();
    
            if (!empty($query)) {
                $bookingsQuery->where('user_name', 'LIKE', "%$query%")
                              ->orWhere('car_name', 'LIKE', "%$query%");
            }
    
            $bookings = $bookingsQuery->orderBy('id', 'desc')->get();
            $bookingsCount = $bookingsQuery->count();
    
            $view = View::make('booking.pdf', compact('bookings', 'bookingsCount'));
            $html_content = $view->render();
    
            $pdf = new TCPDF;
            $pdf::SetHeaderData('', 0, '', '', '', '', '', '', function($pdf) use ($bookingsCount) {
                $dgx = Hijri::Date('Y/m/d');
                $header = '
                <style>
                    .tbg { background: #C6C6C6; }
                    .text-center { text-align: center; }
                    .text-right { text-align: right; }
                    .mtx { margin-top: 5px !important; }
                </style>
                <table cellspacing="0" cellpadding="0" border="0" width="100%">
                    <thead>
                        <tr>
                            <td class="text-center">
                                '.env('prog_header_pdf').'<br>
                                عدد السجلات : '. $bookingsCount .'
                            </td>
                            <td class="text-center" style="font-size: medium">
                                <h4><b>تقرير <br> الحجوزات</b></h4>
                            </td>
                            <td class="text-center" style="vertical-align: top;">
                                <img height="90px" src="'.env('prog_logo_sm').'">
                                <br>
                                تاريخ التقرير : '. $dgx .'
                            </td>
                        </tr>
                    </thead>
                </table>
                <hr>';
                $pdf->SetFont('skyb', 'B', 12);
                $pdf->writeHTML($header, true, false, true, false, '');
            });
    
            $pdf::setFooterCallback(function($pdf) {
                $pdf->SetY(-11);
                $pdf->SetRightMargin(5);
                $pdf->SetLeftMargin(5);
                $pdf->SetFont('skyb', 'I', 8);
                $pdf->Cell(0, 10, 'صفحة '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
                $pdf->Cell(0, 10, env('prog_name'), 0, true, 'L', 0, '', 0, false, 'T', 'L');
                $pdf->Cell(0, 10, env('spfooter'), 0, true, 'R', 0, '', 0, true, 'B', 'R');
            });
    
            $pdf::SetTitle('تقرير الحجوزات');
            $pdf::SetRTL(TRUE);
            $pdf::setMargins(5, 40, 5);
            $pdf::setHeaderMargin(5);
            $pdf::setFooterMargin(10);
            $pdf::setAutoPageBreak(TRUE, 25);
            $pdf::setImageScale(1.3);
    
            $pdf::AddPage();
            $pdf::SetFont('skyb', '', 10);
            $pdf::writeHTML($html_content, false, false, false, false, '');
            $pdf::Output('booking_rep.pdf');
        }
    
    
   
    public function showBookingForm(Car $car)
    {
        $locations = Location::all(); 
    return view('book-car', compact('car', 'locations'));
    }

  
    public function confirmBooking(Request $request, Car $car)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'pickup_location_id' => 'required|exists:locations,id',
            'dropoff_location_id' => 'required|exists:locations,id',
        ]);
    
        $totalDays = Carbon::parse($request->start_date)->diffInDays(Carbon::parse($request->end_date));
        $totalPrice = $totalDays * $car->daily_rate;
    
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'car_id' => $car->id,
            'pickup_location_id' => $request->pickup_location_id,
            'dropoff_location_id' => $request->dropoff_location_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_days' => $totalDays,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);
        $booking->save();
    
        return redirect()->route('booking.summary', $booking->id);
    }
    public function showBookingSummary(Booking $booking)
{
    
    return view('booking-summary', compact('booking'));
}
// public function show($id)
// {
//     // Find the booking by ID
//     $booking = Booking::findOrFail($id);
    
//     if (Auth::user()->role !== 'admin' && $booking->user_id !== Auth::id()) {
//         return redirect()->route('bookings.index')->with('error', 'Unauthorized action.');
//     }

//     // Return the view with the booking data
//     return view('bookings.show', compact('booking'));
// }



 
}
