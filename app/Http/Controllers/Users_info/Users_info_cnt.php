<?php
  
  namespace App\Http\Controllers\Auth;
  namespace App\Http\Controllers\Users_info;
  
  use App\Http\Controllers\Controller;
  use Illuminate\Http\Request;
  use Illuminate\Support\Facades\Hash;
  use Illuminate\Validation\Rules;
  use Illuminate\Auth\Events\Registered;
  
  use Elibyy\TCPDF\Facades\TCPDF;
  use Alkoumi\LaravelHijriDate\Hijri;
  
  use App\Models\User;
  use App\Models\Users_info;
  
  
  class Users_info_cnt extends Controller
  {
  
      public function index()
      {
          return view('dashboard');
      }
  
      public function create()
      {
          return view('users_info.create');
      }
  
      public function store(Request $request)
          {
  
              $request->validate([
                  'name' => ['required', 'string', 'max:255'],
                  'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
                  'password' => ['required', Rules\Password::defaults()],
                  
                  //'ui_id' => 'required',
                  //'ui_user' => 'required',
                  //'ui_name' => 'required',
                  'ui_mobile' => 'required|integer',
                  'ui_para' => 'nullable',
                  'ui_type' => 'required|integer',
                  'ui_log' => 'nullable'
              ]);
      
              $user = User::create([
                  'name' => $request->input('name'),
                  'email' => $request->input('email'),
                  'password' => Hash::make($request->input('password')),
              ]);
      
              event(new Registered($user));
              
              $txt_para = '';
  
              if ($request->has('ui_para')) {
                  $txt_para = implode(',', $request->input('ui_para'));
                  $txt_para = rtrim($txt_para, ',');
  
              }
              
              $u_info = new Users_info();
              $u_info->ui_id = $user->id;//$request->input('ui_id');
              $u_info->ui_user = $user->email;//$request->input('ui_user');
              $u_info->ui_name = $user->name;//$request->input('ui_name');
              $u_info->ui_mobile = $request->input('ui_mobile');
              $u_info->ui_para = $txt_para;
              $u_info->ui_type = $request->input('ui_type');
              $u_info->ui_log = set_reg_stamp('إضافة');
      
              $u_info->save();
              //return redirect()->route('users_info.index');
  
              return response()->json('2');
          }  
  
  
      public function show(string $id)
      {
          $id = dec($id);
          return view('users_info.show',[
              'listings' => Users_info::findOrFail($id)
          ]);
      }
  
      public function edit(string $id)
      {
          $id = dec($id);
          return view('users_info.edit',[
              'listings' => Users_info::findOrFail($id)
          ]);
      }
  
      public function update(Request $request)
      {
          $user = User::findOrFail(dec(request()->input('ui_id')));
          $user_info = Users_info::findOrFail(dec(request()->input('id')));
  
          if ($request->has('ui_para') and $request->input('ui_para')!= $user_info->ui_para) {
              $txt_para = '';
              $txt_para = implode(',', $request->input('ui_para'));
              $txt_para = rtrim($txt_para, ',');
          }else{
              $txt_para = $user_info->ui_para;
          }
          if($request->input('email') != $user->email){
              $request->validate([
                  'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],            
              ]);
              $user->email = $request->input('email');
              $user->save();
              $user_info->ui_user = $request->input('email');
              $user_info->save();
          }
          if($request->input('name') != $user->name){
              $user->name = $request->input('name');
              $user->save();
              $user_info->ui_name = $request->input('name');
              $user_info->save();
          }
          if($request->input('password') !=''){
              $request->validate([
                  'password' => ['required', Rules\Password::defaults()],            
              ]);
              $user->password = Hash::make($request->input('password'));
              $user->save();
          }
  
         
          $user_info->ui_mobile = $request->input('ui_mobile');
          $user_info->ui_para = $txt_para;
          $user_info->ui_type = $request->input('ui_type');
          $user_info->ui_log .= set_reg_stamp('تحديث');
          $user_info->save();
          
          //return redirect()->route('users_info.index');
  
          return response()->json('2');
      }
  
      public function upass(Request $request)
      {
          $request->validate([
              'curr_pass' => 'required',
              'new_pass' => 'required',
              'conf_pass' => 'required'
          ]);
          $user = User::findOrFail(dec(request()->input('ui_id')));
          $user_info = Users_info::findOrFail(dec(request()->input('id')));
          
  
          if (!Hash::check($request->input('curr_pass'), $user->password)) {
              return response()->json(['spx' => 'عفواً : كلمة المرور الحالية غير صحيحة'], 422);
          }
  
          if($request->input('new_pass') != $request->input('conf_pass')){
              return response()->json(['spx' => 'عفواً : كلمة المرور الجديدة وتأكيدها غير متطابقين'], 422);
          }
  
          $request->validate([
              'new_pass' => ['required', Rules\Password::defaults()],            
          ]);
          $user->password = Hash::make($request->input('new_pass'));
          $user->save();
  
          $user_info->ui_log .= set_reg_stamp('تغير كلمة المرور');
          $user_info->save();
  
  
  
      }
      public function destroy(string $id)
      {
          //
      }
  
      
  
  
      public function list(Request $request)
      {
          $query = $request->input('q');
      
          if (!empty($query)) {
              $listings = Users_info::
                  where('ui_name', 'LIKE', "%$query%")
                      ->orWhere('ui_user', 'LIKE', "%$query%")
                      ->orWhere('ui_mobile', 'LIKE', "%$query%")
                      ->latest()
                      ->paginate(20);
          } else {
              $listings = Users_info::latest()->paginate(20);
          }
      
          return view('users_info.list', compact('listings'));
      }
  
      public function rep()
      {
          return view('users_info.rep');
      }
  
      public function rep_excel(Request $request)
      {
              $ui_name = $request->input('ui_name');
              $ui_user = $request->input('ui_user');
              $ui_mobile = $request->input('ui_mobile');
              $ui_type = $request->input('ui_type');
  
              $query = Users_info::query();
  
              if (!empty($ui_name)) {
                  $query->where('ui_name', 'LIKE', "%$ui_name%");
              }
  
              if (!empty($ui_user)) {
                  $query->where('ui_user', 'LIKE', "%$ui_user%");
              }
  
              if (!empty($ui_mobile)) {
                  $query->where('ui_mobile', 'LIKE', "%$ui_mobile%");
              }
  
              if (!empty($ui_type)) {
                  $query->where('ui_type', 'LIKE', "%$ui_type%");
              }
  
              $listings = $query->get();
  
              $listingsCount = $query->count();
  
              return view('users_info.excel', compact('listings', 'listingsCount'));
      }
  
      public function rep_pdf(Request $request)
      {
              $ui_name = $request->input('ui_name');
              $ui_user = $request->input('ui_user');
              $ui_mobile = $request->input('ui_mobile');
              $ui_type = $request->input('ui_type');
  
              $query = Users_info::query();
  
              if (!empty($ui_name)) {
                  $query->where('ui_name', 'LIKE', "%$ui_name%");
              }
  
              if (!empty($ui_user)) {
                  $query->where('ui_user', 'LIKE', "%$ui_user%");
              }
  
              if (!empty($ui_mobile)) {
                  $query->where('ui_mobile', 'LIKE', "%$ui_mobile%");
              }
  
              if (!empty($ui_type)) {
                  $query->where('ui_type', 'LIKE', "%$ui_type%");
              }
  
              $listings = $query->get();
              $listingsCount = $query->count();
  
              $view = \View::make('users_info.pdf', compact('listings', 'listingsCount'));
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
                      <h4><b>تقرير </b></h4>
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
              $pdf->Cell(0, 10, 'اسم البرنامج', 0, true, 'L', 0, '', 0, false, 'T', 'L');
              $pdf->Cell(0, 10, 'حقوق الطبع والنشر', 0, true, 'R', 0, '', 0, true, 'B', 'R');            
          });
          
          $pdf::SetTitle('معلومات المستخدمون');
          $pdf::SetRTL(true);
          $pdf::setMargins(5, 40, 5); //PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT
          $pdf::setHeaderMargin(5);
          $pdf::setFooterMargin(10);
          $pdf::setAutoPageBreak(TRUE, 25);
          $pdf::setImageScale(1.3);
      
          $pdf::AddPage();
          $pdf::SetFont('skyb', '', 10);
          $pdf::writeHTML($html_content, false, false, false, false, '');
          $pdf::Output('users_info_rep.pdf');
      }
  }

