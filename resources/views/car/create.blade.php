@php
    $menu_active = "car";
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

<form class="row g-3 needs-validation" id="frm_add" autocomplete="off" method="post" enctype="multipart/form-data">
    @csrf

    <!-- Name Field -->
    <div class="form-floating mb-1 float-end text-end">
        <input type="text" class="form-control pull-right float-end text-end" name="name" value="{{ old('name') }}" id="name" tabindex="1">
        <label class="msg-right" for="name">الاسم</label>
        <div class="invalid-feedback" id="name_error"></div>
    </div>

    <!-- Brand Field -->
    <div class="form-floating mb-1 float-end text-end">
        <input type="text" class="form-control pull-right float-end text-end" name="brand" value="{{ old('brand') }}" id="brand" tabindex="2">
        <label class="msg-right required" for="brand">البراند</label>
        <div class="invalid-feedback" id="brand_error"></div>
    </div>

    <!-- Model Field -->
    <div class="form-floating mb-1 float-end text-end">
        <input type="text" class="form-control pull-right float-end text-end" name="model" value="{{ old('model') }}" id="model" tabindex="3">
        <label class="msg-right required" for="model">الموديل</label>
        <div class="invalid-feedback" id="model_error"></div>
    </div>

    <!-- Year Field -->
    <div class="form-floating mb-1 float-end text-end">
        <input type="number" class="form-control pull-right float-end text-end" name="year" value="{{ old('year') }}" id="year" tabindex="4">
        <label class="msg-right required" for="year">السنة</label>
        <div class="invalid-feedback" id="year_error"></div>
    </div>

    <!-- Daily Rate Field -->
    <div class="form-floating mb-1 float-end text-end">
        <input type="number" class="form-control pull-right float-end text-end" name="daily_rate" value="{{ old('daily_rate') }}" id="daily_rate" tabindex="5" step="0.01">
        <label class="msg-right required" for="daily_rate">السعر اليومي</label>
        <div class="invalid-feedback" id="daily_rate_error"></div>
    </div>

    <!-- Availability Field -->
    <div class="form-floating mb-1 float-end text-end">
        <select class="form-control pull-right float-end text-end" name="availability" id="availability" tabindex="6">
            <option value="1" selected>متاح</option>
            <option value="0">غير متاح</option>
        </select>
        <label class="msg-right required" for="availability">التوفر</label>
        <div class="invalid-feedback" id="availability_error"></div>
    </div>

    <!-- Image Upload Field -->
    <div class="form-floating mb-1 float-end text-end">
        <input type="file" class="form-control pull-right float-end text-end" name="image" id="image" tabindex="7" accept="image/*">
        <label class="msg-right" for="image">صورة السيارة</label>
        <div class="invalid-feedback" id="image_error"></div>
    </div>

    <!-- Location Field -->
    <div class="form-floating mb-1 float-end text-end">
        <select class="form-control pull-right float-end text-end" name="location_id" id="location_id" tabindex="8">
            @foreach($locations as $location)
                <option value="{{ $location->id }}">{{ $location->city }} - {{ $location->branch_name }}</option>
            @endforeach
        </select>
        <label class="msg-right required" for="location_id">الموقع</label>
        <div class="invalid-feedback" id="location_id_error"></div>
    </div>

   
    <div class="form-floating mb-1 float-end text-end">
        <select class="form-control pull-right float-end text-end" name="car_type" id="car_type" tabindex="9">
            <option value="" >اختر نوع السيارة</option>
            @php
            list_car_type(old('car_type'));
            @endphp
        </select>
        <label class="msg-right" for="car_type">نوع السيارة</label>
        <div class="invalid-feedback" id="car_type_error"></div>
    </div>

    <div class="d-grid gap-2 col-6 mx-auto">
        <button class="btn btn-primary btn-block" type="submit">إضافة المعلومات</button>
    </div>
</form>

<script>
    $(function(){
        $(":input[data-inputmask-mask]").inputmask();
        $(":input[data-inputmask-alias]").inputmask();
        $(":input[data-inputmask-regex]").inputmask("Regex");
    });
</script>

<script>
    document.getElementById('frm_add').addEventListener('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        axios.post('/car.store', formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
        .then(function(response) {
            swal({ text: "تمت الاضافة", icon: "success", timer: 1500, button: false });
            $("#modal-add").modal("toggle");
            setTimeout(function() { location.reload(); }, 1500);
        })
        .catch(function(error) {
            if (error.response) {
                console.log("Errxxx = ", error.response.data);
                swal({ text: "خطأ في الاستجابة", icon: "error", timer: 2000, button: false });

                if (error.response.data.errors) {
                    var errors = error.response.data.errors;
                    for (var fieldName in errors) {
                        var errorElement = document.getElementById(fieldName + '_error');
                        var mainElement = document.getElementById(fieldName);

                        if (errorElement) {
                            errorElement.innerText = errors[fieldName][0];
                            errorElement.style.display = 'block';
                            mainElement.style.border = '1px solid red';
                        }
                    }
                }
            } else if (error.request) {
                swal({ text: "خطأ في الطلب", icon: "error", timer: 2000, button: false });
            } else {
                swal({ text: "خطأ في الأمر", icon: "error", timer: 2000, button: false });
            }
        });
    });
</script>

<script>
    $(function(){
        $(".only-numeric").keydown(function(e) {
            // Allow: backspace, delete, tab, escape, enter, and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                // Allow: Ctrl+A, Command+A, Ctrl+V
                ((e.keyCode === 65 || e.keyCode === 86) && (e.ctrlKey === true || e.metaKey === true)) ||
                // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });

        $(".only-arabic-letters").keypress(function(event) {
            // Arabic characters fall in the Unicode range 0600 - 06FF
            var arabicCharUnicodeRange = /[\u0600-\u06FF]/;
            var key = event.which;
            // 0 = numpad, 8 = backspace, 32 = space
            if (key == 8 || key == 0 || key === 32) {
                return true;
            }
            var str = String.fromCharCode(key);
            if (arabicCharUnicodeRange.test(str)) {
                return true;
            }
            return false;
        });

        $(".only-english-alphanumeric").keypress(function(event) {
            var englishAlphanumericRange = /[a-zA-Z0-9]/;
            var key = event.which;
            // 0 = numpad, 8 = backspace, 32 = space
            if (key == 8 || key == 0 || key === 32) {
                return true;
            }
            var str = String.fromCharCode(key);
            if (englishAlphanumericRange.test(str)) {
                return true;
            }
            return false;
        });
    });
</script>