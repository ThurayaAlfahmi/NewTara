@extends('layouts.header')

@php
$page_title = "ملخص الحجز";
$menu_active = "booking_summary";
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

            <!-- Car Details Section -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">{{ $booking->car->brand }} {{ $booking->car->model }} ({{ $booking->car->year }})</h5>
                    <p class="card-text">{{ $booking->car->description }}</p>
                    <ul>
                        <li><strong>السعر اليومي:</strong> ${{ $booking->car->daily_rate }}</li>
                        <li><strong>الموقع:</strong> {{ $booking->car->location->city }} - {{ $booking->car->location->branch_name }}</li>
                    </ul>
                </div>
            </div>

            <!-- Booking Details Section -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">تفاصيل الحجز</h5>
                    <ul>
                        <li><strong>تاريخ الاستلام:</strong> {{ $booking->start_date }}</li>
                        <li><strong>تاريخ التسليم:</strong> {{ $booking->end_date }}</li>
                        <li><strong>إجمالي الأيام:</strong> {{ $booking->total_days }}</li>
                        <li><strong>موقع الاستلام:</strong> {{ $booking->pickupLocation->city }} - {{ $booking->pickupLocation->branch_name }}</li>
                        <li><strong>موقع التسليم:</strong> {{ $booking->dropoffLocation->city }} - {{ $booking->dropoffLocation->branch_name }}</li>
                        <li><strong>إجمالي السعر:</strong> ${{ $booking->total_price }}</li>
                        <li><strong>الحالة:</strong> {{ ucfirst($booking->status) }}</li>
                    </ul>
                </div>
            </div>

            <!-- Payment Button Section -->
            <div class="text-center">
                <a href="{{ route('payment.form', $booking->id) }}" class="btn btn-primary btn-block">المتابعة إلى الدفع</a>
            </div>

        </div>
    </div>

    @include('layouts.footer')

@endsection
