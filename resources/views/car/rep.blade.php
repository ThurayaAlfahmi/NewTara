
@php
  $menu_active = "car";
  $prog_footer = env('prog_footer');
  $title="السيارات";


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
    <!-- Name Field -->
    <div class="form-floating mb-1 float-end text-end">
        <input type="text" class="form-control pull-right float-end text-end" name="name" id="name" placeholder="الاسم">
        <label class="msg-right" for="name">الاسم</label>
    </div>

    <!-- Brand Field -->
    <div class="form-floating mb-1 float-end text-end">
        <input type="text" class="form-control pull-right float-end text-end" name="brand" id="brand" placeholder="البراند">
        <label class="msg-right" for="brand">البراند</label>
    </div>

    <!-- Model Field -->
    <div class="form-floating mb-1 float-end text-end">
        <input type="text" class="form-control pull-right float-end text-end" name="model" id="model" placeholder="الموديل">
        <label class="msg-right" for="model">الموديل</label>
    </div>

    <!-- Year Field -->
    <div class="form-floating mb-1 float-end text-end">
        <input type="number" class="form-control pull-right float-end text-end" name="year" id="year" placeholder="السنة">
        <label class="msg-right" for="year">السنة</label>
    </div>

    <!-- Daily Rate Field -->
    <div class="form-floating mb-1 float-end text-end">
        <input type="number" class="form-control pull-right float-end text-end" name="daily_rate" id="daily_rate" placeholder="السعر اليومي">
        <label class="msg-right" for="daily_rate">السعر اليومي</label>
    </div>

    <!-- Availability Field -->
    <div class="form-floating mb-1 float-end text-end">
        <select class="form-control pull-right float-end text-end" name="availability" id="availability">
            <option value="" selected>اختر حالة التوفر</option>
            <option value="1">متاح</option>
            <option value="0">غير متاح</option>
        </select>
        <label class="msg-right" for="availability">التوفر</label>
    </div>

    <!-- Location Field -->
    <div class="form-floating mb-1 float-end text-end">
        <select class="form-control pull-right float-end text-end" name="location_id" id="location_id">
            <option value="" selected>اختر الموقع</option>
            @foreach($locations as $location)
                <option value="{{ $location->id }}">{{ $location->city }} - {{ $location->branch_name }}</option>
            @endforeach
        </select>
        <label class="msg-right" for="location_id">الموقع</label>
    </div>

    <!-- Car Type Field -->
    <div class="form-floating mb-1 float-end text-end">
        <select class="form-control pull-right float-end text-end" name="car_type" id="car_type">
            <option value="" selected>اختر نوع السيارة</option>
            @php list_car_type(""); @endphp
        </select>
        <label class="msg-right" for="car_type">نوع السيارة</label>
    </div>

    <!-- Buttons -->
    <div class="d-grid d-md-flex justify-content-md-end mx-auto">
        <button type="reset" class="btn btn-danger me-md-2 w-100">
            <i class="fas fa-eraser"></i>
            <b>تنظيف الحقول</b>
        </button>
        <button type="submit" formaction="{{ route('car.rep_excel') }}" formtarget="_blank" class="btn btn-info me-md-2 w-100 rtl">
            <b>عرض التقرير Excel </b>
            <i class="far fa-file-excel"></i>
        </button>
        <button type="submit" formaction="{{ route('car.rep_pdf') }}" formtarget="_blank" class="btn btn-primary me-md-2 w-100 rtl">
            <b>عرض التقرير PDF </b>
            <i class="far fa-file-pdf"></i>
        </button>
    </div>
</form>