@extends('layouts.header')

@php
$page_title = "نتائج البحث";
$menu_active = "search_results";
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

            <!-- Available Cars Section -->
            <div class="available-cars mt-5">
                <h2 class="text-center mb-4">السيارات المتاحة</h2>
                <div class="row">
                    @foreach($availableCars as $car)
                    <div class="col-md-4 mb-4">
                        <div class="card border-0 shadow-sm rounded overflow-hidden">
                            <img src="{{ asset('storage/' . $car->image_url) }}" class="card-img-top" alt="صورة السيارة">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $car->name }}</h5>
                                <p class="text-muted">العلامة التجارية: {{ $car->brand }}</p>
                                <p class="text-muted">الموديل: {{ $car->model }}</p>
                                <p class="text-success fw-bold">السعر: {{ $car->daily_rate }} ريال/يوم</p>
                                <a href="{{ route('book.car', $car->id) }}" class="btn btn-primary w-100">احجز الآن</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="text-center mt-3">
                    {{-- You can add a 'View More' button here if needed --}}
                    {{-- <a href="{{ route('user.cars') }}" class="btn btn-light text-dark fw-bold px-5 py-2">عرض المزيد</a> --}}
                </div>
            </div>

        </div>
    </div>

    @include('layouts.footer')

@endsection
