@extends('layouts.header')

@php
$page_title = "تأكيد الحجز";
$menu_active = "book_car";
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
                    <h5 class="card-title">{{ $car->brand }} {{ $car->model }} ({{ $car->year }})</h5>
                    <p class="card-text">{{ $car->description }}</p>
                    <ul>
                        <li><strong>السعر اليومي:</strong> ${{ $car->daily_rate }}</li>
                        <li><strong>الموقع:</strong> {{ $car->location->city }} - {{ $car->location->branch_name }}</li>
                        <li><strong>التوفر:</strong> {{ $car->availability ? 'متوفر' : 'غير متوفر' }}</li>
                    </ul>
                </div>
            </div>

            <!-- Booking Form Section -->
            <div class="booking-form">
                <h2 class="text-center mb-4">تأكيد الحجز لسيارة {{ $car->name }}</h2>
                <form action="{{ route('confirm.booking', $car->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="car_id" value="{{ $car->id }}">
            
                    <div class="form-group mb-3">
                        <label for="pickup_location_id">موقع الاستلام:</label>
                        <select name="pickup_location_id" id="pickup_location_id" class="form-select" required>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}">{{ $location->city }} - {{ $location->branch_name }}</option>
                            @endforeach
                        </select>
                    </div>
            
                    <div class="form-group mb-3">
                        <label for="dropoff_location_id">موقع التسليم:</label>
                        <select name="dropoff_location_id" id="dropoff_location_id" class="form-select" required>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}">{{ $location->city }} - {{ $location->branch_name }}</option>
                            @endforeach
                        </select>
                    </div>
            
                    <div class="form-group mb-3">
                        <label for="start_date">تاريخ الاستلام:</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" required min="{{ \Carbon\Carbon::now()->toDateString() }}">
                    </div>
            
                    <div class="form-group mb-3">
                        <label for="end_date">تاريخ التسليم:</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" required min="{{ \Carbon\Carbon::now()->toDateString() }}">
                    </div>
            
                    <button type="submit" class="btn btn-primary btn-block">تأكيد الحجز</button>
                </form>
            </div>

        </div>
    </div>

    @include('layouts.footer')

@endsection

