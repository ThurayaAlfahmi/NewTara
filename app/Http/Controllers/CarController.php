<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Location;
use Illuminate\Support\Facades\View;
use Elibyy\TCPDF\Facades\TCPDF;
use Alkoumi\LaravelHijriDate\Hijri;

class CarController extends Controller
{

    public function avaliableCar()
{
    $cars = Car::where('available', true)->get();
    return view('user.index', compact('cars'));
}

public function showCars(Request $request)
{
    
        $carTypes = car::select('car_type')->distinct()->get();
        $car_type = $request->input('car_type');
        if ($car_type) {
            $cars = Car::where('car_type', $car_type)->get();
        } else {
            $cars = Car::all(); // If no car type is selected, show all cars
        }
    
        return view('user.cars', compact('cars', 'carTypes'));
    
    
}

    public function create()
    {
        $locations = Location::all();
        return view('car.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'brand' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'year' => ['required', 'integer'],
            'daily_rate' => ['required', 'numeric'],
            'availability' => ['boolean'],
           'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], 
            'location_id' => ['required', 'exists:locations,id'],
            'car_type' => ['nullable', 'string'],
        ]);

        $car = new Car();
        $car->name = $request->input('name');
        $car->description = $request->input('description');
        $car->brand = $request->input('brand');
        $car->model = $request->input('model');
        $car->year = $request->input('year');
        $car->daily_rate = $request->input('daily_rate');
        $car->availability = $request->input('availability', true);
        $car->location_id = $request->input('location_id');
        $car->car_type = $request->input('car_type');
         // Handle image upload
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('car_images', 'public');
        $car->image_url = $imagePath;
    }
        $car->save();

        return response()->json('2');
    }

    public function show(string $id)
    {
        $id = dec($id);
        return view('car.show', [
            'car' => Car::findOrFail($id)
        ]);
    }

    public function edit(string $id)
    {
        $id = dec($id);
        $locations = Location::all();
        return view('car.edit', [
            'car' => Car::findOrFail($id),
            'locations' => $locations
        ]);
    }

    public function update(Request $request)
    {
        $car = Car::findOrFail(dec($request->input('id')));
        $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'brand' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'year' => ['required', 'integer'],
            'daily_rate' => ['required', 'numeric'],
            'availability' => ['boolean'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'location_id' => ['required', 'exists:locations,id'],
            'car_type' => ['nullable', 'string'],
        ]);

        $car->name = $request->input('name');
        $car->description = $request->input('description');
        $car->brand = $request->input('brand');
        $car->model = $request->input('model');
        $car->year = $request->input('year');
        $car->daily_rate = $request->input('daily_rate');
        $car->availability = $request->input('availability', true);
        $car->location_id = $request->input('location_id');
        $car->car_type = $request->input('car_type');
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('car_images', 'public');
            $car->image_url = $imagePath;
        }
        $car->save();

        return response()->json('2');
    }

    public function destroy(string $id)
    {
        $id = dec($id);
        $car = Car::findOrFail($id);
        $car->delete();
        return response()->json('2');
    }

    public function list(Request $request)
    {
        $query = $request->input('q');

        if (!empty($query)) {
            $listings = Car::where('name', 'LIKE', "%$query%")
                ->orWhere('brand', 'LIKE', "%$query%")
                ->orWhere('model', 'LIKE', "%$query%")
                ->orderBy('id', 'desc')
                ->paginate(20);
        } else {
            $listings = Car::orderBy('id', 'desc')->paginate(20);
        }

        return view('car.list', compact('listings'));
    }

    public function rep()
    {
        $locations = Location::all(); 
        return view('car.rep',  compact('locations'));
    }

    public function rep_excel(Request $request)
    {
        $name = $request->input('name');
        $brand = $request->input('brand');
        $model = $request->input('model');

        $query = Car::query();

        if (!empty($name)) {
            $query->where('name', 'LIKE', "%$name%");
        }

        if (!empty($brand)) {
            $query->where('brand', 'LIKE', "%$brand%");
        }

        if (!empty($model)) {
            $query->where('model', 'LIKE', "%$model%");
        }

        $listings = $query->orderBy('id', 'desc')->get();
        $listingsCount = $query->count();

        return view('car.excel', compact('listings', 'listingsCount'));
    }

    public function rep_pdf(Request $request)
    {
        $name = $request->input('name');
        $brand = $request->input('brand');
        $model = $request->input('model');

        $query = Car::query();

        if (!empty($name)) {
            $query->where('name', 'LIKE', "%$name%");
        }

        if (!empty($brand)) {
            $query->where('brand', 'LIKE', "%$brand%");
        }

        if (!empty($model)) {
            $query->where('model', 'LIKE', "%$model%");
        }

        $listings = $query->orderBy('id', 'desc')->get();
        $listingsCount = $query->count();

        $view = View::make('car.pdf', compact('listings', 'listingsCount'));
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
                            <h4><b>تقرير <br> السيارات</b></h4>
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

        $pdf::SetTitle('السيارات');
        $pdf::SetRTL(TRUE);
        $pdf::setMargins(5, 40, 5);
        $pdf::setHeaderMargin(5);
        $pdf::setFooterMargin(10);
        $pdf::setAutoPageBreak(TRUE, 25);
        $pdf::setImageScale(1.3);

        $pdf::AddPage();
        $pdf::SetFont('skyb', '', 10);
        $pdf::writeHTML($html_content, false, false, false, false, '');
        $pdf::Output('car_rep.pdf');
    }
}