@extends('layouts.header')
@php
$page_title = "الرئيسية";
$menu_active = "home";
$prog_footer = env('prog_footer');
//$usrx = explode("|",get_users_stats());
$xx = Auth::user();
//print_r(session('user_info')['ui_name']);

@endphp
@section('contx')
@include('menu')

<link href="{{ asset('DataTables/datatables.css') }}" rel="stylesheet">
<div class="app-wrapper">
    
    <div class="app-content pt-3 p-md-3 p-lg-4">
      <div class="container-xl">

      <div class="row g-3 mb-4 align-items-center justify-content-center">
        <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
          <div class="inner">
            <div class="app-card-body p-3 p-lg-4">
              <h3 class="mb-3">{{ env('prog_name') }}</h3>
              <div class="row gx-5 gy-3">
                <div class="col-12 col-lg-9">
                  
                  <div>
                    {{ env('prog_name_desc') }}
                  </div>
                </div>
                <div class="col-12 col-lg-3">
        
                </div>
              </div>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            
          </div>
        </div>
        </div>

    <div class="row g-4 mb-4">
     <div class="col-4 col-lg-4">
     <div class="app-card app-card-stat shadow-lg h-100">
       <div class="app-card-body p-3 p-lg-4">
         <div class="row align-items-center gx-3">
           <div class="col-auto">
             <div class="app-icon-holder">
               <i class="fas fa-users fa-lg"></i>
             </div>
             
           </div>
           <div class="col-auto">
             <h4 class="app-card-title">جميع المستخدمون</h4>
           </div>
           <div class="stats-figure">555</div>
         </div>
       </div>
       <a class="app-card-link-mask" href="#"></a>
     </div>
   </div>

   <div class="col-4 col-lg-4">
     <div class="app-card app-card-stat shadow-lg h-100">
       <div class="app-card-body p-3 p-lg-4">
         <div class="row align-items-center gx-3">
           <div class="col-auto">
             <div class="app-icon-holder">
               <i class="fas fa-users fa-lg"></i>
             </div>
             
           </div>
           <div class="col-auto">
             <h4 class="app-card-title">مدراء النظام</h4>
           </div>
           <div class="stats-figure">444</div>
         </div>
       </div>
       <a class="app-card-link-mask" href="#"></a>
     </div>
   </div>
 
   <div class="col-4 col-lg-4">
     <div class="app-card app-card-stat shadow-lg h-100">
       <div class="app-card-body p-3 p-lg-4">
         <div class="row align-items-center gx-3">
           <div class="col-auto">
             <div class="app-icon-holder">
               <i class="fas fa-users fa-lg"></i>
             </div>
             
           </div>
           <div class="col-auto">
             <h4 class="app-card-title">مستخدمون</h4>
           </div>
           <div class="stats-figure">666</div>
         </div>
       </div>
       <a class="app-card-link-mask" href="#"></a>
     </div>
   </div>

    </div>
        
      </div>
    </div>
    @include('layouts.footer')

@endsection
