<!doctype html>
  <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  
  <head>
    <meta charset="utf-8">
    <meta name="viewport"
      content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width,viewport-fit=cover">
    <meta name="{{ env('prog_name') }}" content="{{ env('prog_name') }}">
    <title>{{ env('prog_name') }}</title>
  
    <link rel="shortcut icon" href="favicon.ico">
  
    <script src="{{ asset('js/sweetalert.min.js?v=1') }}"></script>
    <script src="{{ asset('js/jquery.min.js?v=1') }}"></script>
    <script src="{{ asset('js/b64.js?v=1') }}"></script>
    <script src="{{ asset('plugins/fontawesome/js/all.min.js?v=1') }}"></script>
    <link id="theme-style" rel="stylesheet" href="{{ asset('css/portal.css?v=1') }}">
    <script src="{{ asset('plugins/popper.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jqmask.js') }}"></script>
    <script src="{{ asset('js/printsp.js?v=1') }}"></script>
    <script type="text/javascript" src="{{ asset('js/axios.min.js') }}"></script>
  
  
  </head>
  <style>
    @import url({{ asset('css/dfont.css')}});
  
    body {
      font-family: "Droid Arabic Kufi", serif;
      /*kidana*/
      background: url({{ asset( env('prog_bc_img'))}});
    background-size:100% 100%;
    }
  
    .app-sidepanel .sidepanel-inner {
      background: linear-gradient(135deg, #01693a 0%, #008658 100%);
    }
  
    hr {
      margin: 1rem 0;
      color: #ffff00;
      background-color: #005525;
      border: 1;
      opacity: 0.25;
    }
  
    .bord-botm {
      border-bottom: 1px solid rgba(255, 255, 255, 0.2) !important;
    }
  
    .nav-link-text {
      color: white !important;
    }
  
    .nav-icon {
      color: white !important;
    }
  
    .activex {
      color: black !important;
    }
  
    .logo-text {
      color: #eac66c !important
    }
  
    .hh {
      display: none !important;
    }
  
    .bg-infox {
      background: linear-gradient(135deg, #01693a 0%, #00865a 100%);
      color: white;
    }
  
    .dt-button.buttons-columnVisibility.active {
      background: #0287752b !important;
      padding-bottom: 1px;
    }
  
    .zulns-datepicker {
      z-index: 1151 !important;
    }
  
    .msg-rightxxx {
      left: 88% !important;
    }
  
    .rtl {
      direction: rtl !important;
    }
  
    .w3-display-container {
      background: linear-gradient(135deg, #0679ae 0%, #058c60 100%) !important;
    }
  
    .was-validated .form-control:valid,
    .form-control.is-valid {
      background-image: none;
    }
  
    textarea {
      height: 100% !important;
    }
  
    .hhp {
      display: none;
    }
  
    @media only screen and (min-width: 768px) {
      .navx {
        display: none;
      }
    }
  
    .dropdown-menu {
      max-height: 180px;
      overflow-y: auto;
      overflow-x: hidden;
      direction: rtl;
      text-align: right;
    }
  
    .badge {
      background-color: #dbf5e3 !important;
      border-style: groove;
    }
  
    .max {
      width: 100% !important;
    }
  
    .required {
      color: #bd0404 !important;
    }
  
    .not-active {
      pointer-events: none;
      cursor: default;
      opacity: 0.6;
    }
  
    .finger {
      cursor: pointer;
    }
  
    .dangerx {
      color: #ad322d !important;
    }
  
    .primaryx {
      color: #1300ff !important;
    }
  
    .lightx {
      color: #c4ced7 !important;
    }
  
    .warningx {
      color: #0cc974 !important;
    }
  
    .bg-lightx {
      background-color: color(srgb 0.796 0.945 0.878 / 0.486) !important;
    }
  
    .bg-primaryx {
      background-color: color(srgb 0.953 0.945 0.741 / 0.597) !important;
    }
  
    .bg-ifox {
      background-color: color(srgb 0.769 0.808 0.843 / 0.347) !important;
    }
  
    .bg-successx {
      background-color: color(srgb 0.549 0.977 0.785 / 0.438) !important;
    }
  
    .successx {
      color: #01693a !important;
    }
  
    .btn-successx {
      background-color: #027345 !important;
      color: #eac66c !important
    }
  
    @media (max-width: 767.98px) {
      .btn-responsive {
        width: 100%;
      }
    }
  
    .modal-backdrop {
      z-index: -1;
    }
  </style>
  @php
  $user = Auth::user();
  //dd(session('user_info')['id']);
  //dd($user->name);
  @endphp
  
  <body class="app">
    <header class="app-header fixed-top">
      <div class="app-header-inner">
        <div class="container-fluid py-2">
          <div class="app-header-content">
            <div class="row justify-content-between align-items-center">
  
              <div class="col-auto">
                <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
                  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img">
                    <title>القائمة</title>
                    <path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"
                      d="M4 7h22M4 15h22M4 23h22"></path>
                  </svg>
                  <a class="navbar-brand navx" href="#"><img height="50" src="{{ asset(env('prog_logo_sm')) }}"
                      class="img-responsive"></a>
                </a>
              </div>
              <!--//col-->
  
              <div class="app-search-box col">
                <h1 class="app-page-title mb-0" id="page_title"></h1>
              </div>
              <!--//app-search-box-->
  
              <div class="app-utilities col-auto">
  
  
  
                <div class="app-utility-item app-user-dropdown dropdown">
                  <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                    aria-expanded="false">
                    {{ $user->name }}
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
                    {{-- <li><a class="dropdown-item" href="#">اليوم : <span class="text-info">
                          <?php echo $GLOBALS["dg"]->date("l d-m-Y");?>
                        </span></a></li> --}}
                    <li><a class="dropdown-item" data-bs-toggle="modal" data-remote="{{ route('users_info.pass') }}"
                        data-bs-target="#modal-pass">تغيير كلمة المرور</a></li>
                    <li>
                      <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item text-danger logout" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><b>تسجيل
                          خروج</b></a></li>
                  </ul>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
                <!--//app-user-dropdown-->
              </div>
              <!--//app-utilities-->
            </div>
            <!--//row-->
          </div>
          <!--//app-header-content-->
        </div>
        <!--//container-fluid-->
      </div>
      <!--//app-header-inner-->
      <div id="app-sidepanel" class="app-sidepanel sidepanel-hiddenxxxx">
        <div id="sidepanel-drop" class="sidepanel-drop"></div>
        <div class="sidepanel-inner d-flex flex-column">
          <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
          <div class="app-branding bord-botm mb-2 text-center hhx xxxx">
            <a class="app-logo" href="index.php">
              <img class="logo-icon me-2 mb-2" src="{{ asset(env('prog_logo_sm')) }}" alt="logo">
              <h6 class="logo-text mb-2">
                {{ env('prog_name') }}
              </h6>
            </a>
          </div>
  
          <div class="modal fade" id="modal-pass" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
  
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">
                    تغيير كلمة المرور
                  </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modal-body-pass">
                  <div class="text-center">
                    <form class="row g-3 needs-validation" autocomplete="off" id="frm_pass" method="post">
                      @csrf
                      <div class="hh">
                        <input name="id" value="{{ enc($user->id) }}">
                        <input name="ui_id" value="{{ enc(session('user_info')['id']) }}">
                      </div>
                      <div class="form-floating mb-1 float-end text-end">
                        <input type="password" class="form-control pull-right float-end text-end" name="curr_pass" value=""
                          id="curr_pass" tabindex="1">
                        <label class="msg-right" for="message">كلمة المرور الحالية</label>
                        <div class="invalid-feedback" id="curr_pass_error"></div>
                      </div>
                      <div class="form-floating mb-1 float-end text-end">
                        <input type="password" class="form-control pull-right float-end text-end" name="new_pass" value=""
                          id="new_pass" tabindex="1">
                        <label class="msg-right" for="message">كلمة المرور الجديدة</label>
                        <div class="invalid-feedback" id="new_pass_error"></div>
                      </div>
                      <div class="form-floating mb-1 float-end text-end">
                        <input type="password" class="form-control pull-right float-end text-end" name="conf_pass" value=""
                          id="conf_pass" tabindex="1">
                        <label class="msg-right" for="message">تأكيد كلمة المرور الجديدة</label>
                        <div class="invalid-feedback" id="conf_pass_error"></div>
                      </div>
                      <div class="d-grid gap-2 col-6 mx-auto">
                        <button class="btn btn-warning btn-block" type="submit">تغيير كلمة المرور</button>
                    </div>
                
                </form>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء الأمر</button>
                </div>
              </div>
            </div>
          </div>
          <script>
            document.getElementById('frm_pass').addEventListener('submit', function(e) {
                e.preventDefault();
        
                var formData = new FormData(this);
                axios.post('/users_info.upass', formData)
                .then(function (response) {
                    console.log('OK' , response);
                    swal({text: "تم التحديث",icon: "success",timer: 1500,button: false,});
                    $("#modal-pass").modal("toggle");
                    setTimeout(function(){location.reload();}, 1500);
                })
                .catch(function (error) {
                    if (error.response) {
                            console.log('Errxxx = ',error.response.data);
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
                        }else if(error.response.data.spx){
                          swal({text:error.response.data.spx,icon: "error",timer: 2000,button: false,});
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
          <!--//app-branding-->
          <script>
            function xinput(){
      $("input").on("keyup", function (e) {
          var value = $(this).val() || "";
          var regex = /<(\/?\w+[^\n>]*\/?)>/ig;
          var regex2 = /<(\/?\/?)>/ig;
          if(regex2.test(value)){
              //layer.msg("Invalid characters!");
              $(this).val(value.replace(regex2, "&lt;$1&gt;"));
              e.preventDefault();
              return false;
          }
          if(regex.test(value)){
              //layer.msg("Invalid characters!");
              $(this).val(value.replace(regex, "&lt;$1&gt;"));
              e.preventDefault();
              return false;
          }
      });		
    }
          </script>
  
  
          @yield('contx')
  