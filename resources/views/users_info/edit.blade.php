@php
$menu_active = "users";
$prog_footer = env('prog_footer');
$title="المستخدمون";
@endphp
@if (chk_para(session('user_info')['ui_para'], $menu_active."_edit")=="no" and session('user_info')['ui_type']!=="1")
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
<script type="text/javascript" src="{{ asset('js/BsMultiSelect.min.js') }}"></script>


<div class="alert alert-warning rtl hh" id="upload_pic" role="alert">
    <p><b>تعليمات رفع الصور</b></p>
    <li>الحجم الأقصى المسموح به هو : 3 ميغا</li>
    <li>صيغ الصور المدعومة هي : PNG,JPG,JPEG,HEIC</li>
</div>

<div class="alert alert-warning rtl hh" id="upload_doc" role="alert">
    <p><b>تعليمات رفع الملفات</b></p>
    <li>الحجم الأقصى المسموح به هو : 3 ميغا</li>
    <li>صيغ الملفات المدعومة هي : DOC,DOCX,PDF,XCLX</li>
</div>

<form class="row g-3 needs-validation" autocomplete="off" id="frm_edit" method="post">
    @csrf
    <div class="hh">
        <input name="id" value="{{ enc($listings->id) }}">
        <input name="ui_id" value="{{ enc($listings->ui_id) }}">
    </div>
    <div class="form-floating mb-1 float-end text-end">
            <input type="text" class="form-control pull-right float-end text-end" name="email" value="{{$listings->ui_user}}"
            id="email" tabindex="1">
        <label class="msg-right" for="message">اسم المستخدم/يجب أن يكون بريد إلكتروني</label>
        <div class="invalid-feedback" id="email_error"></div>        
    </div>

    <div class="form-floating mb-1 float-end text-end">
        <input type="password" class="form-control pull-right float-end text-end" name="password" value=""
            id="password" tabindex="1">
        <label class="msg-right" for="message">كلمة المرور</label>
        <p class="text-center text-warning">ملاحظة : في حال رغبة تغير كلمة المرور فقط </p>
        <div class="invalid-feedback" id="ui_password_error"></div>        
    </div>

    <div class="form-floating mb-1 float-end text-end">
            <input type="text" class="form-control pull-right float-end text-end" name="name" value="{{$listings->ui_name}}"
            id="name" tabindex="1">
        <label class="msg-right" for="message">الاسم</label>
        <div class="invalid-feedback" id="name_error"></div>        
    </div>
    <div class="form-floating mb-1 float-end text-end">
        <input type="text" class="form-control pull-right float-end text-end" name="ui_mobile" value="{{$listings->ui_mobile}}"
            id="ui_mobile" data-inputmask-mask="966#########" tabindex="1">
        <label class="msg-right" for="message">رقم الجوال</label>
        <div class="invalid-feedback" id="ui_mobile_error"></div>        

    </div>

    <div class="form-floating mb-1 float-end text-end">
        <select class="form-select float-end" name="ui_type" onchange="set_txt_para()" id="ui_type" tabindex="4">
           <option value="">اختر من القائمة</option>
           @php list_txt_type($listings->ui_type); @endphp
         </select>
        <label class="msg-right" for="message">نوع الحساب</label>
        <div class="invalid-feedback" id="ui_type_error"></div> 
     </div>


    <div class="form-floating mb-1 float-end text-end hh" id="div_ui_para" dir="rtl">
        <label class="col-form-label float-end" for="ui_para">تفاصيل الصلاحيات</label>
                <select name="ui_para[]" id="ui_para" class="form-select ui_para"  multiple="multiple" data-live-search="true">
                    @php list_txt_para_edit($listings->ui_para); @endphp
                </select>
                <div class="invalid-feedback" id="ui_para_error"></div>        
            </div>  

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
        axios.post('/users_info.update', formData)
        .then(function (response) {
            console.log('OK' , response);
            swal({text: "تم التحديث",icon: "success",timer: 1500,button: false,});
            $("#modal-edit").modal("toggle");
            setTimeout(function(){location.reload();}, 1500);
        })
        .catch(function (error) {
            if (error.response) {
                    console.log('Errxxx = ',error.response.data);
                    swal({text: 'خطأ في الاستجابة',icon: "error",timer: 2000,button: false,});
                    //return false;
                if (error.response.data.errors) {
                        var errors = error.response.data.errors;

                    for (var fieldName in errors) {
                        var errorMessage = errors[fieldName][0];
                        var errorElement = document.getElementById(fieldName + '_error');
                        var mainElement = document.getElementById(fieldName);

                        if (errorElement) {
                            errorElement.innerText = errorMessage;
                            errorElement.style.display = 'block';
                            mainElement.style.border = '1px solid red';
                        }else{
                            errorElement.innerText = '';
                            errorElement.style.display = 'none';
                            mainElement.style.border = '0px';
                        }
                    }
                }
            } else if (error.request) {
                console.log(error);
                    swal({text: 'خطأ في الطلب',icon: "error",timer: 2000,button: false,});
                    return false;
                } else {
                    console.log('Error', error.message);
                    swal({text: 'خطأ في الأمر',icon: "error",timer: 2000,button: false,});
                    return false;
                }
                    //console.log(error.config);
        });
    });
</script>
<script>
    function set_txt_para(){
      
      if($("#ui_type :selected").val() !="1"){
        
        $("#div_ui_para").removeClass("hh");
        $("#ui_para").attr("required",false);
      }else{
        $("#div_ui_para").addClass("hh");
        $("#ui_para").attr("required",false);
      }
    }
  </script>
  <script>
  $("#ui_para").bsMultiSelect();
  set_txt_para();
  </script>