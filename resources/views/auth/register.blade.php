@extends('layouts.header2')
@section('register')
<?php
$prog_header = env('prog_header');
$prog_footer = env('prog_footer');
?>
<body>
<section class="ftco-section">
  <div class="container">
    <div class="row justify-content-center hid">
      <div class="col-md-3 text-left mb-1 well well-sm">
        <img src="{{ env('prog_logo') }}" />
      </div>
      <div class="col-md-7 text-right mt-3">
         {!! $prog_header !!}
      </div>
    </div>
    <div class="row justify-content-center" dir="rtl">
      <div class="col-md-12 col-lg-10">
        <div class="wrap d-md-flex">
          <div class="text-wrap p-2 p-lg-5 text-center d-flex align-items-center order-md-last bodyx" >
            <div class="text w-100">
              <h2>{{ env('prog_name') }}</h2>
              <p>{{ env('prog_name_desc') }}</p>
              <a href="{{ route('login') }}" class="btn btn-white btn-outline-white">لديك حساب؟ تسجيل الدخول</a>
            </div>
          </div>

          <div class="login-wrap p-2 p-lg-5 text-right">
              <div class="d-flex">
                <div class="w-100">
                  <h4 class="mb-4 text-center">إنشاء حساب جديد</h4>
                </div>
              </div>

  <form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="form-group mb-3">
      <label class="label" for="name">الاسم الكامل</label>
      <input type="text" id="name" name="name" class="form-control" placeholder="الاسم" :value="old('name')" required autofocus>
      @error('name')
        <p class="text-danger fw-bold">{{ $message }}</p>
      @enderror
    </div>

    <div class="form-group mb-3">
      <label class="label" for="email">البريد الإلكتروني</label>
      <input type="email" id="email" name="email" class="form-control" placeholder="البريد الإلكتروني" :value="old('email')" required>
      @error('email')
        <p class="text-danger fw-bold">{{ $message }}</p>
      @enderror
    </div>

    <div class="form-group mb-3">
      <label class="label" for="password">كلمة المرور</label>
      <input type="password" id="password" name="password" class="form-control" placeholder="كلمة المرور" required>
      @error('password')
        <p class="text-danger fw-bold">{{ $message }}</p>
      @enderror
    </div>

    <div class="form-group mb-3">
      <label class="label" for="password_confirmation">تأكيد كلمة المرور</label>
      <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="تأكيد كلمة المرور" required>
      @error('password_confirmation')
        <p class="text-danger fw-bold">{{ $message }}</p>
      @enderror
    </div>
    
    <div class="form-group">
      <button type="submit" class="form-control btn btn-primary submit px-3">تسجيل</button>
    </div>

  </form>
</div>
</div>
<div class="w-100 text-right mt-2">
  <p>{!! $prog_footer !!}</p>
</div>
</div>
</div>
</div>
</section>
@endsection
