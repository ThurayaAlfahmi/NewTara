@extends('layouts.header')

@php
$page_title = "الرئيسية";
$menu_active = "welcome";
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

            <!-- Search Section -->
            <div class="search-section text-white text-center mb-5">
                <h2 class="mb-4">ابحث عن سيارتك المثالية</h2>
                <form action="{{ route('search.cars') }}" method="GET" class="row g-3 justify-content-center">
                    <div class="col-md-5">
                        <label for="pickup_location" class="form-label" style="color: black">موقع الاستلام</label>
                        <select name="pickup_location" id="pickup_location" class="form-select">
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}">{{ $location->city }} - {{ $location->branch_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label for="dropoff_location" class="form-label"  style="color: black">موقع التسليم</label>
                        <select name="dropoff_location" id="dropoff_location" class="form-select">
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}">{{ $location->city }} - {{ $location->branch_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label for="start_date" class="form-label" style="color: black">تاريخ البداية</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" min="{{ \Carbon\Carbon::now()->toDateString() }}">
                    </div>
                    <div class="col-md-5">
                        <label for="end_date" class="form-label" style="color: black">تاريخ النهاية</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" min="{{ \Carbon\Carbon::now()->toDateString() }}">
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-light text-dark fw-bold px-5 py-2 mt-3">بحث</button>
                    </div>
                </form>
            </div>

            <!-- Available Cars Section -->
            {{-- <div class="available-cars mt-5">
                <h2 class="text-center mb-4">السيارات المتاحة</h2>
                <div class="row">
                    @foreach($cars->take(3) as $car)
                        <div class="col-md-4 mb-4">
                            <div class="card border-0 shadow-sm rounded overflow-hidden">
                                <img src="{{ asset('storage/' . $car->image_url) }}" class="card-img-top" alt="صورة السيارة">
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ $car->model }}</h5>
                                    <p class="text-muted">الماركة: {{ $car->brand }}</p>
                                    <p class="text-muted">السنة: {{ $car->year }}</p>
                                    <p class="text-success fw-bold">السعر: {{ $car->daily_rate }} ريال/يوم</p>
                                    <a href="{{ route('book.car', ['car' => $car->id]) }}" class="btn btn-primary w-100">احجز الآن</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-3">
                    {{-- <a href="{{ route('user.cars') }}" class="btn btn-light text-dark fw-bold px-5 py-2">عرض المزيد</a> --}}
                </div>
            </div> 

        </div>
    </div>

    @include('layouts.footer')

@endsection
