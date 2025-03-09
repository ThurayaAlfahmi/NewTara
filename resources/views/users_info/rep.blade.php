@php
$menu_active = "users";
$prog_footer = env('prog_footer');
$title="المستخدمون";

@endphp
@if (chk_para(session('user_info')['ui_para'], $menu_active."_rep")=="no" and session('user_info')['ui_type']!=="1")
    @php
        get_alert('error','عفواً : لاتملك صلاحية للوصل',$backx="");
        exit;
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

<div class="alert alert-info rtl" role="alert">
    <b>ملاحظة : يمكنك تخصيص بحثك بكتابة الحقول أو بعضها كما يمكنك عرض جميع النتائج في حالة الحقول فارغة</b>
</div>
<form class="row g-3 needs-validation" autocomplete="off" id="frm_rep" method="post">
    @csrf

    <div class="form-floating mb-1 float-end text-end">
        <input type="text" class="form-control pull-right float-end text-end" name="ui_user" value=""
            id="ui_user" tabindex="1">
        <label class="msg-right" for="message">اسم المستخدم</label>
        <div class="invalid-feedback" id="ui_user_error"></div>        
    </div>

    <div class="form-floating mb-1 float-end text-end">
        <input type="text" class="form-control pull-right float-end text-end" name="ui_name" value=""
            id="ui_name" tabindex="1">
        <label class="msg-right" for="message">الاسم</label>
        <div class="invalid-feedback" id="ui_name_error"></div>        
    </div>
    <div class="form-floating mb-1 float-end text-end">
        <input type="text" class="form-control pull-right float-end text-end" name="ui_mobile" value=""
            id="ui_mobile" tabindex="1">
        <label class="msg-right" for="message">رقم الجوال</label>
        <div class="invalid-feedback" id="ui_mobile_error"></div>        
    </div>

    <div class="form-floating mb-1 float-end text-end">
        <select class="form-select float-end" name="ui_type" id="ui_type" tabindex="4">
           <option value="">الكل</option>
           @php list_txt_type(''); @endphp
         </select>
        <label class="msg-right" for="message">نوع الحساب</label>
        <div class="invalid-feedback" id="ui_type_error"></div> 
     </div> 

     <div class="d-grid d-md-flex justify-content-md-end mx-auto">
 
        <button type="reset" class="btn btn-danger me-md-2 w-100">
          <i class="fas fa-eraser"></i>
          <b>تنظيف الحقول</b>
         </button>
        <button type="submit" formaction="{{ route('users_info.rep_excel') }}" formtarget="_blank" class="btn btn-info me-md-2 w-100 rtl">
          <b>عرض التقرير Excel </b>
          <i class="far fa-file-excel"></i>
         </button>
        <button type="submit" formaction="{{ route('users_info.rep_pdf') }}" formtarget="_blank" class="btn btn-primary me-md-2 w-100 rtl">
          <b>عرض التقرير PDF </b>
          <i class="far fa-file-pdf"></i>
         </button>
       </div>

</form>