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

            <form class="row g-3 needs-validation" id="frm_add" autocomplete="off" method="post">
                @csrf

                <!-- City Field -->
                <div class="form-floating mb-1 float-end text-end">
                    <input type="text" class="form-control pull-right float-end text-end " name="city" value="{{ old('city') }}" id="city" tabindex="1">
                    <label class="msg-right required" for="city">المدينة</label>
                    <div class="invalid-feedback" id="city_error"></div>
                </div>

                <!-- Branch Name Field -->
                <div class="form-floating mb-1 float-end text-end">
                    <input type="text" class="form-control pull-right float-end text-end" name="branch_name" value="{{ old('branch_name') }}" id="branch_name" tabindex="2">
                    <label class="msg-right required" for="branch_name">اسم الفرع</label>
                    <div class="invalid-feedback" id="branch_name_error"></div>
                </div>

                <!-- Submit Button -->
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
        axios.post('/location.store', formData)
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

        $(".only-arabic-letters").keypress(function(event){
      // Arabic characters fall in the Unicode range 0600 - 06FF
          var arabicCharUnicodeRange = /[\u0600-\u06FF]/;
          var key = event.which;
            // 0 = numpad, 8 = backspace, 32 = space
            if (key==8 || key==0 || key === 32)
            {
              return true;
            }
            var str = String.fromCharCode(key);
            if ( arabicCharUnicodeRange.test(str) )
            {
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

