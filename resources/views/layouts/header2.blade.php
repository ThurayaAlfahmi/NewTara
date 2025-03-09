<!doctype html>
   <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width,viewport-fit=cover">
    <meta name="{{ env('prog_name') }}" content="{{ env('prog_name') }}">
    <title>{{ env('prog_name') }}</title>
  
    <link rel="shortcut icon" href="favicon.ico">
  
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/sweetalert.min.js?v=1') }}"></script>
    <script src="{{ asset('js/jquery.min.js?v=1') }}"></script>
    <script src="{{ asset('js/b64.js?v=1') }}"></script>
  
    </head>
    <style>
    @import url( {{ asset('css/dfont.css') }} );
    body{
    font-family: "Droid Arabic Kufi", serif; /*kidana*/
    background: url( {{ asset( env('prog_bc_img') ) }} ) ;
    background-size:100% 100%;
    }
    textarea {
     height: 100% !important;
    }
    .navbarx{
    padding: 0.1rem 1rem !important;
    }
    </style>
    <nav class="navbar navbar-expand-md fixed-top bg-light navx navbarx">
    <div class="container-fluid">
    <div class="navbar-header">
    <p class="navbar-brand" href="#">
    <img width="60" src="{{ env('prog_logo_sm') }}">
    </p>
    </div>
    <p class="navbar-text text-right mb-0">
    <b>{{ env('prog_name') }}</b>
    <br>
    <b class="mr-2"><p>{{ env('prog_name_desc') }}</p></b></p>
    </div>
  </nav>
  
   @yield('login')
  
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

