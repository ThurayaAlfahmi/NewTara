@extends('layouts.app')

@section('title', 'مرحبا بك في تأجير السيارات')

@section('content')

<div class="container py-5">
    <!-- Search Box Section -->
    <div class="search-section text-white text-center">
        <h2 class="mb-4">ابحث عن سيارتك المثالية</h2>
        <form action="{{ route('search.cars') }}" method="GET" class="row g-3 justify-content-center">
            <div class="col-md-5">
                <label for="pickup_location" class="form-label">موقع الاستلام:</label>
                <select name="pickup_location" id="pickup_location" class="form-select">
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}">{{ $location->city }} - {{ $location->branch_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5">
                <label for="dropoff_location" class="form-label">موقع التسليم:</label>
                <select name="dropoff_location" id="dropoff_location" class="form-select">
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}">{{ $location->city }} - {{ $location->branch_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5">
                <label for="start_date" class="form-label">تاريخ البداية:</label>
                <input type="date" name="start_date" id="start_date" class="form-control" min="{{ \Carbon\Carbon::now()->toDateString() }}">
            </div>
            <div class="col-md-5">
                <label for="end_date" class="form-label">تاريخ النهاية:</label>
                <input type="date" name="end_date" id="end_date" class="form-control" min="{{ \Carbon\Carbon::now()->toDateString() }}">
            </div>
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-light text-dark fw-bold px-5 py-2 mt-3">بحث</button>
            </div>
        </form>
    </div>
    

    <!-- Available Cars Section -->
    <div class="available-cars mt-5">
        <h2 class="text-center mb-4">السيارات المتاحة</h2>
        <div class="row">
            @foreach($cars->take(3) as $car) <!-- Show only 3 cars initially -->
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

@endsection
