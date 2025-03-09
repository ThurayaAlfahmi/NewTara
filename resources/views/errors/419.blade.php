@extends('layouts.header2')
     @section('login')
     <?php
     $prog_header = env('prog_header');
     $prog_footer = env('prog_footer');
     ?>
       <body>
       <section class="ftco-section">
         <div class="container">
           <div class="row justify-content-center hid">
             <div class="col-md-3 text-left mb-1 well well-sm">
               <img src="{{ env('prog_logo') }}" />
             </div>
             <div class="col-md-7 text-right mt-3">
                {!! $prog_header !!}
     
             </div>
           </div>
           <div class="row justify-content-center" dir="rtl">
             <div class="col-md-12 col-lg-10">
               <div class="wrap d-md-flex">
                 <div class="text-wrap p-2 p-lg-12 text-center d-flex align-items-center order-md-last bodyx w-100" >
     
                   <div class="text w-100">
                                     <h2 class="text-white">عفواً : إنتهت صلاحية الجلسة</h2>
                                     <p>كرر المحاولة لاحقاً</p>
                     <h3><a href="{{ route('login') }}">رجوع</a></h3>
                   </div>
     
     
                   </div>
     
                 </div>
                 <div class="w-100 text-right mt-2">
                   <p>{!! $prog_footer !!}</p>
                 </div>
             </div>
           </div>
         </div>
       </section>
     
     @endsection
