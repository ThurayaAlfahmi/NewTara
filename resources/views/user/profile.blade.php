@extends('layouts.header')

@php
$page_title = "حجوزاتك";
$menu_active = "bookings";
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

            <!-- Bookings Section -->
            <div class="available-cars mt-5">
                <h2 class="text-center mb-4">🚗 الحجوزات</h2>
                <div class="row">
                    @if($bookings->isEmpty())
                        <div class="col-12">
                            <div class="alert alert-info text-center">
                                لا توجد حجوزات حتى الآن.
                            </div>
                        </div>
                    @else
                        @foreach($bookings as $booking)
                            <div class="col-md-4 mb-4">
                                <div class="card border-0 shadow-sm rounded overflow-hidden">
                                    <!-- Car Image Placeholder (Optional) -->
                                    <img src="{{ asset('storage/' . ($booking->car->image_url ?? 'default_car_image.jpg')) }}" class="card-img-top" alt="صورة السيارة">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{ $booking->car->model ?? 'غير معروف' }}</h5>
                                        <p class="text-muted">الماركة: {{ $booking->car->brand ?? 'غير معروف' }}</p>
                                        <p class="text-muted">مدة الحجز: {{ $booking->total_days }} يوم</p>
                                        <p class="text-muted">التاريخ: {{ $booking->created_at->format('d/m/Y') }}</p>
                                        <p class="text-success fw-bold">السعر الإجمالي: {{ $booking->total_price }} ريال</p>
                                        <a href="{{ route('booking.details', ['booking' => $booking->id]) }}" class="btn btn-primary w-100">عرض التفاصيل</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="text-center mt-3">
                    <a href="{{ route('user.bookings') }}" class="btn btn-light text-dark fw-bold px-5 py-2">عرض المزيد</a>
                </div>
            </div>

        </div>
    </div>

    @include('layouts.footer')
@endsection

