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

  <form class="row g-3 needs-validation" id="frm_edit" autocomplete="off" novalidate method="post">
    @csrf
 
                    <div class="form-floating mb-1 float-end text-end">
                      <input class="form-control pull-right float-end text-end nowrite"  onclick="xcalnder(event,'my_f_add_date_h','my_f_add_date_m')" name="my_f_add_date"   required " data-error-msg="يجب تعبئة تاريخ الاضافة" id="my_f_add_date_h" placeholder="تاريخ الاضافة" tabindex="1" value="{{ $listings->my_f_add_date }}">
                      
                      <input class="hh" name="my_f_add_date_h" id="my_f_add_date_h">
                      
                      <label class="msg-right required " data-error-msg="يجب تعبئة تاريخ الاضافة" for="message">تاريخ الاضافة</label>
                       <div class="invalid-feedback" id="my_f_add_date_error"></div>        
                    </div>
                    
       <div class="form-floating mb-1 float-end text-end">
               <input type="text" class="form-control pull-right float-end text-end" name="my_f_name" value="{{$listings->my_f_name}}"
               id="my_f_name_edit" tabindex="2">
           <label class="msg-right required" for="message">الاسم</label>
           <div class="invalid-feedback" id="my_f_name_error"></div>        
       </div>
       
        <div class="form-floating mb-1 float-end text-end"><?php //data-inputmask-mask="966#########" ?>
                <input type="tel" class="form-control pull-right float-end text-end only-numeric" name="my_f_mobile" value="{{$listings->my_f_mobile}}"
                id="my_f_mobile_edit" tabindex="3">
            <label class="msg-right required" for="message">الجوال</label>
            <div class="invalid-feedback" id="my_f_mobile_error"></div>        
        </div>
         
          <div class="form-floating mb-1 float-end text-end">
             <textarea class="form-control pull-right float-end text-end" name="my_f_address"   id="my_f_address_edit" placeholder="العنوان" tabindex="4">{{ $listings->my_f_address }}</textarea>
             <label class="msg-right" for="message">العنوان</label>
             <div class="invalid-feedback" id="my_f_address_error"></div> 
          </div>
          
               <div class="form-floating mb-1 float-end text-end">
                       <input type="email" class="form-control pull-right float-end text-end" name="my_f_email" value="{{$listings->my_f_email}}"
                       id="my_f_email_edit" tabindex="5">
                   <label class="msg-right" for="message">البريد الالكتروني</label>
                   <div class="invalid-feedback" id="my_f_email_error"></div>        
               </div>
                
        <div class="form-floating mb-1 float-end text-end">
           <select class="form-select pull-right float-end " name="my_f_social"   required id="my_f_social_edit" placeholder="الحالة الاجتماعية" tabindex="6">
              <option value="">اختر من القائمة</option>
              <?php echo list_my_f_social($listings->my_f_social); ?>
            </select>
           <label class="msg-right required" for="message">الحالة الاجتماعية</label>
           <div class="invalid-feedback">مطلوب الحالة الاجتماعية</div>
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
        formData.append('id','{{ enc($listings->id) }}');
        axios.post('/myfrind.update', formData)
        .then(function (response) {
            //console.log("OK" + response);
            swal({text: "تم التحديث",icon: "success",timer: 1500,button: false,});
            $("#modal-edit").modal("toggle");
            setTimeout(function(){location.reload();}, 1500);
        })
        .catch(function (error) {
            if (error.response) {
                    console.log("Errxxx = ",error.response.data);
                    swal({text: "خطأ في الاستجابة",icon: "error",timer: 2000,button: false,});
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
                        }
                    }
                }
            } else if (error.request) {
                //console.log(error.request);
                    swal({text: "خطأ في الطلب",icon: "error",timer: 2000,button: false,});
                    return false;
                }
        });
    });
</script>
