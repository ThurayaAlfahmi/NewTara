@extends('layouts.header')

@php
$page_title = "الدفع";
$menu_active = "payment";
$prog_footer = env('prog_footer');
$xx = Auth::user();
@endphp

@section('contx')
@include('menu')
<link href="{{ asset('DataTables/datatables.css') }}" rel="stylesheet">
<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <!-- Banner Section -->
            <div class="row g-3 mb-4 align-items-center justify-content-center">
                <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
                    <div class="inner">
                        <div class="app-card-body p-3 p-lg-4">
                            <h3 class="mb-3">{{ env('prog_name') }}</h3>
                            <div class="row gx-5 gy-3">
                                <div class="col-12 col-lg-9">
                                    <div>
                                        {{ env('prog_name_desc') }}
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3">
                                    <!-- Optional Section -->
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cash Payment Section -->
            <div class="container text-center mt-5">
                <div class="alert alert-warning p-4">
                    <p>تم اختيار الدفع نقدًا.</p>
                    <a href="{{ route('home') }}" class="btn btn-primary mt-3">العودة إلى الصفحة الرئيسية</a>
                </div>
            </div>

        </div>
    </div>

    @include('layouts.footer')

</div>

@endsection

