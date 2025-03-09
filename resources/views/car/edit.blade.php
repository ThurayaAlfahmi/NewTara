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
<script type="text/javascript" src="{{ asset('js/BsMultiSelect.min.js') }}"></script>

<form class="row g-3 needs-validation" id="frm_edit" autocomplete="off" novalidate method="post" enctype="multipart/form-data">
    @csrf

    <!-- Name Field -->
    <div class="form-floating mb-1 float-end text-end">
        <input type="text" class="form-control pull-right float-end text-end" name="name" value="{{ $car->name }}"
               id="name_edit" tabindex="1">
        <label class="msg-right" for="name">الاسم</label>
        <div class="invalid-feedback" id="name_error"></div>        
    </div>

    <!-- Brand Field -->
    <div class="form-floating mb-1 float-end text-end">
        <input type="text" class="form-control pull-right float-end text-end" name="brand" value="{{ $car->brand }}"
               id="brand_edit" tabindex="2">
        <label class="msg-right required" for="brand">البراند</label>
        <div class="invalid-feedback" id="brand_error"></div>        
    </div>

    <!-- Model Field -->
    <div class="form-floating mb-1 float-end text-end">
        <input type="text" class="form-control pull-right float-end text-end" name="model" value="{{ $car->model }}"
               id="model_edit" tabindex="3">
        <label class="msg-right required" for="model">الموديل</label>
        <div class="invalid-feedback" id="model_error"></div>        
    </div>

    <!-- Year Field -->
    <div class="form-floating mb-1 float-end text-end">
        <input type="number" class="form-control pull-right float-end text-end" name="year" value="{{ $car->year }}"
               id="year_edit" tabindex="4">
        <label class="msg-right required" for="year">السنة</label>
        <div class="invalid-feedback" id="year_error"></div>        
    </div>

    <!-- Daily Rate Field -->
    <div class="form-floating mb-1 float-end text-end">
        <input type="number" class="form-control pull-right float-end text-end" name="daily_rate" value="{{ $car->daily_rate }}"
               id="daily_rate_edit" tabindex="5" step="0.01">
        <label class="msg-right required" for="daily_rate">السعر اليومي</label>
        <div class="invalid-feedback" id="daily_rate_error"></div>        
    </div>

    <!-- Availability Field -->
    <div class="form-floating mb-1 float-end text-end">
        <select class="form-control pull-right float-end text-end" name="availability" id="availability_edit" tabindex="6">
            <option value="1" {{ $car->availability ? 'selected' : '' }}>متاح</option>
            <option value="0" {{ !$car->availability ? 'selected' : '' }}>غير متاح</option>
        </select>
        <label class="msg-right required" for="availability">التوفر</label>
        <div class="invalid-feedback" id="availability_error"></div>        
    </div>

    <!-- Image Upload Field -->
    <div class="form-floating mb-1 float-end text-end">
        <input type="file" class="form-control pull-right float-end text-end" name="image" id="image_edit" tabindex="7" accept="image/*">
        <label class="msg-right" for="image">صورة السيارة</label>
        <div class="invalid-feedback" id="image_error"></div>
        @if($car->image_url)
            <img src="{{ asset('storage/' . $car->image_url) }}" alt="صورة السيارة" width="100" class="mt-2">
        @endif
    </div>

    <!-- Location Field -->
    <div class="form-floating mb-1 float-end text-end">
        <select class="form-control pull-right float-end text-end" name="location_id" id="location_id_edit" tabindex="8">
            @foreach($locations as $location)
                <option value="{{ $location->id }}" {{ $car->location_id == $location->id ? 'selected' : '' }}>{{ $location->city }} - {{ $location->branch_name }}</option>
            @endforeach
        </select>
        <label class="msg-right required" for="location_id">الموقع</label>
        <div class="invalid-feedback" id="location_id_error"></div>        
    </div>

    <!-- Car Type Field -->
    <div class="form-floating mb-1 float-end text-end">
        <select class="form-control pull-right float-end text-end" name="car_type" id="car_type_edit" tabindex="9">
            <option value="" disabled>اختر نوع السيارة</option>
            <option value="Family Small" {{ $car->car_type == 'Family Small' ? 'selected' : '' }}>عائلية صغيرة</option>
            <option value="Family Large" {{ $car->car_type == 'Family Large' ? 'selected' : '' }}>عائلية كبيرة</option>
            <option value="Sports" {{ $car->car_type == 'Sports' ? 'selected' : '' }}>رياضية</option>
            <option value="Luxury" {{ $car->car_type == 'Luxury' ? 'selected' : '' }}>فاخرة</option>
            <option value="Economy" {{ $car->car_type == 'Economy' ? 'selected' : '' }}>اقتصادية</option>
        </select>
        <label class="msg-right required" for="car_type">نوع السيارة</label>
        <div class="invalid-feedback" id="car_type_error"></div>        
    </div>

    <!-- Submit Button -->
    <div class="d-grid gap-2 col-6 mx-auto">
        <button class="btn btn-info btn-block" type="submit">تحديث المعلومات</button>
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
    document.getElementById('frm_edit').addEventListener('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('id', '{{ enc($car->id) }}');
        axios.post('/car.update', formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
        .then(function (response) {
            swal({text: "تم التحديث", icon: "success", timer: 1500, button: false});
            $("#modal-edit").modal("toggle");
            setTimeout(function(){ location.reload(); }, 1500);
        })
        .catch(function (error) {
            if (error.response) {
                console.log("Errxxx = ", error.response.data);
                swal({text: "خطأ في الاستجابة", icon: "error", timer: 2000, button: false});
                if (error.response.data.errors) {
                    var errors = error.response.data.errors;
                    for (var fieldName in errors) {
                        var errorElement = document.getElementById(fieldName + '_error');
                        var mainElement = document.getElementById(fieldName + '_edit');
                        if (errorElement) {
                            errorElement.innerText = errors[fieldName][0];
                            errorElement.style.display = 'block';
                            mainElement.style.border = '1px solid red';
                        }
                    }
                }
            } else if (error.request) {
                swal({text: "خطأ في الطلب", icon: "error", timer: 2000, button: false});
            }
        });
    });
</script>