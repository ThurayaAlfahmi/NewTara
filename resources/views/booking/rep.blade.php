@php
  $menu_active = "booking";
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

<form class="row g-3 needs-validation" id="frm_rep_booking" autocomplete="off" method="post">
    @csrf

    <!-- Booking Date Start -->
    <div class="form-floating mb-1 float-end text-end">
        <input type="text" class="form-control pull-right float-end text-end" name="booking_date_start" id="booking_date_start" placeholder="تاريخ الحجز من">
        <label class="msg-right" for="booking_date_start">تاريخ الحجز من</label>
    </div>

    <!-- Booking Date End -->
    <div class="form-floating mb-1 float-end text-end">
        <input type="text" class="form-control pull-right float-end text-end" name="booking_date_end" id="booking_date_end" placeholder="تاريخ الحجز إلى">
        <label class="msg-right" for="booking_date_end">تاريخ الحجز إلى</label>
    </div>

    <!-- Car Selection -->
    <div class="form-floating mb-1 float-end text-end">
        <input type="text" class="form-control pull-right float-end text-end" name="car" id="car" placeholder="اسم السيارة">
        <label class="msg-right" for="car">اسم السيارة</label>
    </div>

    <!-- User Selection -->
    <div class="form-floating mb-1 float-end text-end">
        <input type="text" class="form-control pull-right float-end text-end" name="user" id="user" placeholder="اسم العميل">
        <label class="msg-right" for="user">اسم العميل</label>
    </div>

    <div class="d-grid d-md-flex justify-content-md-end mx-auto">
        <button type="reset" class="btn btn-danger me-md-2 w-100">
            <i class="fas fa-eraser"></i>
            <b>تنظيف الحقول</b>
        </button>
        <button type="submit" formaction="{{ route('booking.rep_excel') }}" formtarget="_blank" class="btn btn-info me-md-2 w-100 rtl">
            <b>عرض التقرير Excel </b>
            <i class="far fa-file-excel"></i>
        </button>
        <button type="submit" formaction="{{ route('booking.rep_pdf') }}" formtarget="_blank" class="btn btn-primary me-md-2 w-100 rtl">
            <b>عرض التقرير PDF </b>
            <i class="far fa-file-pdf"></i>
        </button>
    </div>
</form>
