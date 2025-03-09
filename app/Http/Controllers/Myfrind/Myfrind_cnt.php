<?php
  
  namespace App\Http\Controllers\Myfrind;
  
  use App\Http\Controllers\Controller;
  use Illuminate\Http\Request;
  use Illuminate\Support\Facades\Hash;
  use Illuminate\Validation\Rules;
  use Illuminate\Support\Facades\View;
  
  use Elibyy\TCPDF\Facades\TCPDF;
  use Alkoumi\LaravelHijriDate\Hijri;
  
  use App\Models\Myfrind;
  
  
  class Myfrind_cnt extends Controller
  {
  
      public function index()
      {
          return view('dashboard');
      }
  
      public function create()
      {
          return view('myfrind.create');
      }
  
      public function store(Request $request)
      {
          //if u need uniqe add in array 'unique:'Table::class
          //if u need null add in array nullable
          $request->validate([
            'my_f_add_date' => ['string', 'max:55'  ,'nullable' ],
                    'my_f_name' => ['string', 'max:255' , 'required', ],
                    'my_f_mobile' => ['regex:/^[0-9]+$/' , 'required', ],
                    'my_f_address' => ['string'  ,'nullable' ],
                    'my_f_email' => ['string', 'max:255'  ,'nullable' ],
                    'my_f_social' => ['string', 'max:255' , 'required', ],
                    
              ]);
          
           //if u need check is have value or exisit //if ($request->has('ui_para')) {}
            $v_myfrind = new Myfrind();
          
                   $v_myfrind->my_f_add_date = $request->input('my_f_add_date');
                   
                   $v_myfrind->my_f_name = $request->input('my_f_name');
                   
                   $v_myfrind->my_f_mobile = $request->input('my_f_mobile');
                   
                   $v_myfrind->my_f_address = $request->input('my_f_address');
                   
                   $v_myfrind->my_f_email = $request->input('my_f_email');
                   
                   $v_myfrind->my_f_social = $request->input('my_f_social');
                   
              $v_myfrind->myfrind_log = set_reg_stamp('إضافة');
              $v_myfrind->save();
              //return redirect()->route('myfrind.index');
              return response()->json('2');
            }
            
            public function show(string $id)
            {
                $id = dec($id);
                return view('myfrind.show',[
                    'listings' => Myfrind::findOrFail($id)
                ]);
            }
        
            public function edit(string $id)
            {
                $id = dec($id);
                return view('myfrind.edit',[
                    'listings' => Myfrind::findOrFail($id)
                ]);
            }
        
      public function update(Request $request)
      {
          $v_myfrind = Myfrind::findOrFail(dec(request()->input('id')));
          $request->validate([
          'my_f_add_date' => ['string', 'max:55'  ,'nullable' ],
                        'my_f_name' => ['string', 'max:255' , 'required', ],
                        'my_f_mobile' => ['regex:/^[0-9]+$/' , 'required', ],
                        'my_f_address' => ['string'  ,'nullable' ],
                        'my_f_email' => ['string', 'max:255'  ,'nullable' ],
                        'my_f_social' => ['string', 'max:255' , 'required', ],
                        
                  ]);
              
                 $v_myfrind->my_f_add_date = $request->input('my_f_add_date');
                 
                 $v_myfrind->my_f_name = $request->input('my_f_name');
                 
                 $v_myfrind->my_f_mobile = $request->input('my_f_mobile');
                 
                 $v_myfrind->my_f_address = $request->input('my_f_address');
                 
                 $v_myfrind->my_f_email = $request->input('my_f_email');
                 
                 $v_myfrind->my_f_social = $request->input('my_f_social');
                 
              $v_myfrind->myfrind_log .= set_reg_stamp('تحديث');
              $v_myfrind->save();
              //return redirect()->route('myfrind.index');
              return response()->json('2');
            }
            
      public function destroy(string $id)
          {
            $idx= dec($id);
            $delx = Myfrind::findOrFail($idx);
            $delx->delete();
            return response()->json('2');
          }
  
      public function list(Request $request)
      {
          $query = $request->input('q');
      
          if (!empty($query)) {
              $listings = Myfrind::
              where('id', 'LIKE', "%$query%")
        ->orWhere('my_f_add_date', 'LIKE', "%$query%")
                ->orWhere('my_f_name', 'LIKE', "%$query%")
                ->orWhere('my_f_mobile', 'LIKE', "%$query%")
                ->orWhere('my_f_address', 'LIKE', "%$query%")
                ->orWhere('my_f_email', 'LIKE', "%$query%")
                ->orWhere('my_f_social', 'LIKE', "%$query%")
                
                      ->orderBy("id", "desc")
                      ->paginate(20);
          } else {
              $listings = Myfrind::orderBy("id", "desc")->paginate(20);
          }
      
          return view('myfrind.list', compact('listings'));
      }
      
      public function rep()
      {
          return view('myfrind.rep');
      }
      
      public function rep_excel(Request $request)
      {
        $my_f_add_date= $request->input('my_f_add_date');
                    $my_f_name= $request->input('my_f_name');
                    $my_f_mobile= $request->input('my_f_mobile');
                    $my_f_address= $request->input('my_f_address');
                    $my_f_email= $request->input('my_f_email');
                    $my_f_social= $request->input('my_f_social');
                    
              $query = Myfrind::query();
              
                    if (!empty($my_f_add_date)) {
                       $query->orWhere('my_f_add_date', 'LIKE', "%$query%");
                    }
                    
                    if (!empty($my_f_name)) {
                       $query->orWhere('my_f_name', 'LIKE', "%$query%");
                    }
                    
                    if (!empty($my_f_mobile)) {
                       $query->orWhere('my_f_mobile', 'LIKE', "%$query%");
                    }
                    
                    if (!empty($my_f_address)) {
                       $query->orWhere('my_f_address', 'LIKE', "%$query%");
                    }
                    
                    if (!empty($my_f_email)) {
                       $query->orWhere('my_f_email', 'LIKE', "%$query%");
                    }
                    
                    if (!empty($my_f_social)) {
                       $query->orWhere('my_f_social', 'LIKE', "%$query%");
                    }
                    
                      $listings = $query->orderBy("id", "desc")->get();
                      $listingsCount = $query->count();
  
                  return view('myfrind.excel', compact('listings', 'listingsCount'));
      }
      
          public function rep_pdf(Request $request)
            {
          $my_f_add_date= $request->input('my_f_add_date');
                  $my_f_name= $request->input('my_f_name');
                  $my_f_mobile= $request->input('my_f_mobile');
                  $my_f_address= $request->input('my_f_address');
                  $my_f_email= $request->input('my_f_email');
                  $my_f_social= $request->input('my_f_social');
                  
            $query = Myfrind::query();
            
                          if (!empty($my_f_add_date)) {
                             $query->orWhere('my_f_add_date', 'LIKE', "%$query%");
                          }
                          
                          if (!empty($my_f_name)) {
                             $query->orWhere('my_f_name', 'LIKE', "%$query%");
                          }
                          
                          if (!empty($my_f_mobile)) {
                             $query->orWhere('my_f_mobile', 'LIKE', "%$query%");
                          }
                          
                          if (!empty($my_f_address)) {
                             $query->orWhere('my_f_address', 'LIKE', "%$query%");
                          }
                          
                          if (!empty($my_f_email)) {
                             $query->orWhere('my_f_email', 'LIKE', "%$query%");
                          }
                          
                          if (!empty($my_f_social)) {
                             $query->orWhere('my_f_social', 'LIKE', "%$query%");
                          }
                          
                        $listings = $query->orderBy("id", "desc")->get();
          
                  $listingsCount = $query->count();
          
                  $view = View::make('myfrind.pdf', compact('listings', 'listingsCount'));
                  $html_content = $view->render();
                     
          $pdf = new TCPDF;
          
          $pdf::setHeaderCallback(function($pdf) use ( $listingsCount){
  
              $listingsCountx = $listingsCount;
              $dgx =  Hijri::Date('Y/m/d'); 
              $hs='
              <style>
              .tbg{
                  background:#C6C6C6 ;
              }
              .text-center{
                text-align: center;
              }
              .text-right{
                  text-align: right;
                }
              .mtx{
                  margin-top:5px !important;
              }
              </style>
              <table cellspacing="0" cellpadding="0" border="0" width="100%">
              <thead>
                  <tr>
                   <td class="text-center">
                       '.env('prog_header_pdf').'<br>
                           عدد السجلات : '. $listingsCountx .'
                   </td>
                   
                    <td class="text-center" style="font-size: medium">
                      <h4><b>تقرير <br> الأصدقاء</b></h4>
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
              $pdf->writeHTML($hs, true, false, true, false, '');          
          });
          $pdf::setFooterCallback(function($pdf){
              $pdf->SetY(-11);
              $pdf->SetRightMargin(5);
              $pdf->SetLeftMargin(5);
              $pdf->SetFont('skyb', 'I', 8);
              $pdf->Cell(0, 10, 'صفحة '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
              $pdf->Cell(0, 10, env('prog_name'), 0, true, 'L', 0, '', 0, false, 'T', 'L');
              $pdf->Cell(0, 10, env('spfooter'), 0, true, 'R', 0, '', 0, true, 'B', 'R');            
          });
          
          $pdf::SetTitle('الأصدقاء');
          $pdf::SetRTL(TRUE);
          $pdf::setMargins(5, 40, 5); //PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT
          $pdf::setHeaderMargin(5);
          $pdf::setFooterMargin(10);
          $pdf::setAutoPageBreak(TRUE, 25);
          $pdf::setImageScale(1.3);
      
          $pdf::AddPage();
          $pdf::SetFont('skyb', '', 10);
          $pdf::writeHTML($html_content, false, false, false, false, '');
          $pdf::Output('myfrind_rep.pdf');
      }
  }

