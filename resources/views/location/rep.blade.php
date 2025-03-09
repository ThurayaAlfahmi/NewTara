@php
  $menu_active = "location";
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
                <div class="form-floating mb-1 float-end text-end">
                    <input type="text" class="form-control pull-right float-end text-end" name="city" id="city" placeholder="المدينة">
                    <label class="msg-right" for="city">المدينة</label>
                </div>

                <div class="form-floating mb-1 float-end text-end">
                    <input type="text" class="form-control pull-right float-end text-end" name="branch_name" id="branch_name" placeholder="اسم الفرع">
                    <label class="msg-right" for="branch_name">اسم الفرع</label>
                </div>

                <div class="d-grid d-md-flex justify-content-md-end mx-auto">
                    <button type="reset" class="btn btn-danger me-md-2 w-100">
                        <i class="fas fa-eraser"></i>
                        <b>تنظيف الحقول</b>
                    </button>
                    <button type="submit" formaction="{{ route('location.rep_excel') }}" formtarget="_blank" class="btn btn-info me-md-2 w-100 rtl">
                        <b>عرض التقرير Excel </b>
                        <i class="far fa-file-excel"></i>
                    </button>
                    <button type="submit" formaction="{{ route('location.rep_pdf') }}" formtarget="_blank" class="btn btn-primary me-md-2 w-100 rtl">
                        <b>عرض التقرير PDF </b>
                        <i class="far fa-file-pdf"></i>
                    </button>
                </div>
            </form>
