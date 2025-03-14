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

            <!-- Payment Section -->
            <div class="card mx-auto" style="max-width: 500px;">
                <div class="card-body">
                    <h5 class="card-title text-center mb-3">اختر طريقة الدفع</h5>

                    <form action="{{ route('process.payment', $booking->id) }}" method="POST">
                        @csrf
                        
                        <div class="form-group mb-3">
                            <label for="payment_method">طريقة الدفع:</label>
                            <select name="payment_method" id="payment_method" class="form-control" required>
                                <option value="credit_card">بطاقة ائتمانية</option>
                                <option value="paypal">باي بال</option>
                                <option value="cash">نقدًا</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success btn-block">ادفع الآن</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    @include('layouts.footer')

@endsection
