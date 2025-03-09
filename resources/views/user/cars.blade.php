@extends('layouts.app')

@section('title', 'سياراتنا المتاحة')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">السيارات المتاحة</h2>
    
    <!-- Car type filter -->
    <form method="GET" action="{{ route('user.cars') }}">
        <div class="mb-4">
            <label for="car_type" class="form-label">نوع السيارة</label>
            <select name="car_type" id="car_type" class="form-select">
                <!-- Default option "كل الأنواع" -->
                <option value="">كل الأنواع</option>
                
                <!-- Loop through the car types from the database -->
                @foreach($carTypes as $type)
                    <option value="{{ $type->car_type }}" {{ request('car_type') == $type->car_type ? 'selected' : '' }}>
                        {{ $type->car_type }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">تصفية</button>
    </form>

    <div class="row mt-4">
        @foreach($cars as $car)
            <div class="col-md-3 mb-4"> <!-- Changed from col-md-4 to col-md-3 for 4 cards per row -->
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
</div>
@endsection
