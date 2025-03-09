
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
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
  
    <?php
    $prog_header = env('prog_header');
    $prog_footer = env('prog_footer');
    ?>
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
  <div class="container">
    <div class="row mt-1">
      <div class="col-9">
       <img src="{{ asset(env('prog_logo_sm')) }}" />
      </div>
      <div class="col-3 text-center">
        {!! $prog_header !!}
      </div>
  
          @yield('contx')
  