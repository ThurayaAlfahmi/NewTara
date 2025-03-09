@php
  $menu_active = "myfrind";
  $prog_footer = env('prog_footer');
  @endphp
  @if (chk_para(session("user_info")["ui_para"], $menu_active."_add")=="no" and session("user_info")["ui_type"]!=="1")
       @php
       abort(403, "ليس لديك الصلاحية للوصول إلى هذه الصفحة.");
       @endphp
   @endif
   <head>
       <meta charset="utf-8">
   </head>
   <link rel="stylesheet" href="{{ asset('css/w3.css') }}" />
   <script type="text/javascript" src="{{ asset('js/hijri-date.js') }}"></script>
   <script type="text/javascript" src="{{ asset('js/calendar.js') }}"></script>
   <script type="text/javascript" src="{{ asset('js/datepicker.js') }}"></script>
   <script type="text/javascript" src="{{ asset('js/calendar_ini.js') }}"></script>
   <script type="text/javascript" src="{{ asset('js/axios.min.js') }}"></script>
   <script type="text/javascript" src="{{ asset('js/BsMultiSelect.min.js') }}"></script>
  
  
  <form class="row g-3 needs-validation" id="frm_rep" autocomplete="off" method="post">
    @csrf
  
            <div class="col">
              <div class="form-floating mb-1 float-end text-end max">
                  <input class="form-control pull-right float-end text-end nowrite max"  onclick="xcalnder(event,'my_f_add_date_to','my_f_add_date_m_to')" name="my_f_add_date_to"   id="my_f_add_date_to" placeholder="تاريخ الاضافة" tabindex="1">
                  <input class="hh" name="my_f_add_date_m" id="my_f_add_date_m_to">
                  <label class="msg-right" for="message">تاريخ الاضافة إلى</label>
                  <div class="invalid-feedback" id="my_f_add_date_error"></div>
              </div>
            </div>
            <div class="col">
                <div class="form-floating mb-1 float-end text-end max">
                    <input class="form-control pull-right float-end text-end nowrite max"  onclick="xcalnder(event,'my_f_add_date_h','my_f_add_date_m')" name="my_f_add_date"   id="my_f_add_date_h" placeholder="تاريخ الاضافة" tabindex="1">
                    <input class="hh" name="my_f_add_date_h" id="my_f_add_date_m">
                    <label class="msg-right" for="message">تاريخ الاضافة من</label>
                    <div class="invalid-feedback" id="my_f_add_date_error"></div>
                </div>
            </div>
            
           <div class="form-floating mb-1 float-end text-end">
              <input type="text" class="form-control pull-right float-end text-end" name="my_f_name"   id="my_f_name" placeholder="الاسم" tabindex="2">
              <label class="msg-right" for="message">الاسم</label>
              <div class="invalid-feedback" id="my_f_name_error"></div>
          </div> 
        <div class="form-floating mb-1 float-end text-end"> <?php //data-inputmask-mask="966#########" ?>
          <input type="tel" class="form-control pull-right float-end text-end only-numeric" name="my_f_mobile"   id="my_f_mobile" placeholder="الجوال" tabindex="3">
          <label class="msg-right" for="message">الجوال</label>
          <div class="invalid-feedback" id="my_f_mobile_error"></div>
        </div>
         
    <div class="form-floating mb-1 float-end text-end">
       <textarea class="form-control pull-right float-end text-end" name="my_f_address"   id="my_f_address" placeholder="العنوان" tabindex="4"></textarea>
       <label class="msg-right" for="message">العنوان</label>
       <div class="invalid-feedback" id="my_f_address_error"></div>
    </div>
     
      <div class="form-floating mb-1 float-end text-end">
      <input type="email" class="form-control pull-right float-end text-end" name="my_f_email"   id="my_f_email" placeholder="البريد الالكتروني" tabindex="5">
      <label class="msg-right" for="message">البريد الالكتروني</label>
       <div class="invalid-feedback" id="my_f_email_error"></div>
      </div>
       
            <div class="form-floating mb-1 float-end text-end">
               <select class="form-select float-end" name="my_f_social"   id="my_f_social" placeholder="الحالة الاجتماعية" tabindex="6">
                  <option value="">الكل</option>
                  @php list_my_f_social(""); @endphp
                </select>
               <label class="msg-right" for="message">الحالة الاجتماعية</label>
               <div class="invalid-feedback" id="my_f_social_error"></div>
            </div>
            
<div class="d-grid d-md-flex justify-content-md-end mx-auto">
 
  <button type="reset" class="btn btn-danger me-md-2 w-100">
    <i class="fas fa-eraser"></i>
    <b>تنظيف الحقول</b>
  </button>
  <button type="submit" formaction="{{ route('myfrind.rep_excel') }}" formtarget="_blank" class="btn btn-info me-md-2 w-100 rtl">
    <b>عرض التقرير Excel </b>
     <i class="far fa-file-excel"></i>
  </button>
  <button type="submit" formaction="{{ route('myfrind.rep_pdf') }}" formtarget="_blank" class="btn btn-primary me-md-2 w-100 rtl">
    <b>عرض التقرير PDF </b>
     <i class="far fa-file-pdf"></i>
  </button>
</div>
</form>
