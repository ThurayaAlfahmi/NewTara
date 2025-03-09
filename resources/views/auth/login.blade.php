@extends('layouts.header2')
  @section('login')
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
                  @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="btn btn-white btn-outline-white">نسيت كلمة المرور</a>
                  @endif
                </div>
  
  
                </div>
  
              <div class="login-wrap p-2 p-lg-5 text-right">
                  <div class="d-flex">
                    <div class="w-100">
                      <h4 class="mb-4 text-center">تسجيل الدخول للنظام</h4>
                    </div>
  
                  </div>
  
                    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
  
    <form method="POST" action="{{ route('login') }}">
      @csrf
  
                    <div class="form-group mb-3">
                      <label class="label" for="email">بريدك الالكتروني</label>
                      <input type="text" id="email" name="email" class="form-control"  placeholder="الايميل" :value="old('email')" required autofocus autocomplete="email">
                      @error('email')
                        <p class="text-danger fw-bold">
                        {{ $message }}
                      </p>
                      @enderror
                    </div>
  
                    <div class="form-group mb-3">
                    <label class="label" for="password">كلمة المرور</label>
                    <input type="password" id="password" name="password" class="form-control"  placeholder="كلمة المرور" required >
                    @error('password')
                    <p class="text-danger fw-bold">
                      {{ $message }}
                    </p>
                    @enderror
                    </div>
                  
                  <div class="form-group">
                    <button {{ __('Log in') }}
                     class="form-control btn btn-primary submit px-3">دخول</button>
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
