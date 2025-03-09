<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Location;
use Illuminate\Support\Facades\View;
use Elibyy\TCPDF\Facades\TCPDF;
use Alkoumi\LaravelHijriDate\Hijri;

class LocationController extends Controller
{
    
        public function index()
        {
            return view('dashboard');
        }
    
        public function create()
        {
            return view('location.create');
        }
    
        public function store(Request $request)
        {
            $request->validate([
                'city' => ['required', 'string', 'max:255'],
                'branch_name' => ['required', 'string', 'max:255'],
            ]);
    
            $location = new Location();
            $location->city = $request->input('city');
            $location->branch_name = $request->input('branch_name');
            $location->save();
    
            return response()->json('2');
        }
    
        public function show(string $id)
        {
            $id = dec($id);
            return view('location.show', [
                'location' => Location::findOrFail($id)
            ]);
        }
    
        public function edit(string $id)
        {
            $id = dec($id);
            return view('location.edit', [
                'location' => Location::findOrFail($id)
            ]);
        }
    
        public function update(Request $request)
        {
            $location = Location::findOrFail(dec($request->input('id')));
            $request->validate([
                'city' => ['required', 'string', 'max:255'],
                'branch_name' => ['required', 'string', 'max:255'],
            ]);
    
            $location->city = $request->input('city');
            $location->branch_name = $request->input('branch_name');
            
            $location->save();
    
            return response()->json('2');
        }
    
        public function destroy(string $id)
        {
            $id = dec($id);
            $location = Location::findOrFail($id);
            $location->delete();
            return response()->json('2');
        }
    
        public function list(Request $request)
        {
            $query = $request->input('q');
    
            if (!empty($query)) {
                $listings = Location::where('city', 'LIKE', "%$query%")
                    ->orWhere('branch_name', 'LIKE', "%$query%")
                    ->orderBy('id', 'desc')
                    ->paginate(20);
            } else {
                $listings = Location::orderBy('id', 'desc')->paginate(20);
            }
    
            return view('location.list', compact('listings'));
        }
    
        public function rep()
        {
            return view('location.rep');
        }
    
        public function rep_excel(Request $request)
        {
            $city = $request->input('city');
            $branch_name = $request->input('branch_name');
    
            $query = Location::query();
    
            if (!empty($city)) {
                $query->where('city', 'LIKE', "%$city%");
            }
    
            if (!empty($branch_name)) {
                $query->where('branch_name', 'LIKE', "%$branch_name%");
            }
    
            $listings = $query->orderBy('id', 'desc')->get();
            $listingsCount = $query->count();
    
            return view('location.excel', compact('listings', 'listingsCount'));
        }
    
        public function rep_pdf(Request $request)
        {
            $city = $request->input('city');
            $branch_name = $request->input('branch_name');
    
            $query = Location::query();
    
            if (!empty($city)) {
                $query->where('city', 'LIKE', "%$city%");
            }
    
            if (!empty($branch_name)) {
                $query->where('branch_name', 'LIKE', "%$branch_name%");
            }
    
            $listings = $query->orderBy('id', 'desc')->get();
            $listingsCount = $query->count();
    
            $view = View::make('location.pdf', compact('listings', 'listingsCount'));
            $html_content = $view->render();
    
            $pdf = new TCPDF;
            $pdf::setHeaderCallback(function($pdf) use ($listingsCount) {
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
                                عدد السجلات : '. $listingsCount .'
                            </td>
                            <td class="text-center" style="font-size: medium">
                                <h4><b>تقرير <br> الفروع</b></h4>
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
    
            $pdf::SetTitle('الفروع');
            $pdf::SetRTL(TRUE);
            $pdf::setMargins(5, 40, 5);
            $pdf::setHeaderMargin(5);
            $pdf::setFooterMargin(10);
            $pdf::setAutoPageBreak(TRUE, 25);
            $pdf::setImageScale(1.3);
    
            $pdf::AddPage();
            $pdf::SetFont('skyb', '', 10);
            $pdf::writeHTML($html_content, false, false, false, false, '');
            $pdf::Output('location_rep.pdf');
        }
    }
    
