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
<script type="text/javascript" src="{{ asset('js/BsMultiSelect.min.js') }}"></script>


           
  <form class="row g-3 needs-validation" id="frm_edit" autocomplete="off" novalidate method="post">
                @csrf

                <div class="form-floating mb-1 float-end text-end">
                    <input type="text" class="form-control pull-right float-end text-end" name="city" value="{{$location->city}}"
                    id="city_edit" tabindex="2">
                <label class="msg-right required" for="city">المدينة</label>
                <div class="invalid-feedback" id="city_error"></div>        
            </div>
              

            
            <div class="form-floating mb-1 float-end text-end">
                <input type="text" class="form-control pull-right float-end text-end" name="branch_name" value="{{$location->branch_name}}"
                id="branch_name_edit" tabindex="2">
            <label class="msg-right required" for="branch_name">الفرع</label>
            <div class="invalid-feedback" id="branch_name_error"></div>        
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
                    formData.append('id','{{ enc($location->id) }}');
                    axios.post('/location.update', formData)
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
            