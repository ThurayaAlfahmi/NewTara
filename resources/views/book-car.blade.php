@extends('layouts.app')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container">
    <h1 class="text-center mb-4">احجز السيارة: {{ $car->name }}</h1>

    <!-- عرض تفاصيل السيارة -->
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

    <!-- نموذج الحجز -->
    <form action="{{ route('confirm.booking', $car->id) }}" method="POST">
        @csrf
        <input type="hidden" name="car_id" value="{{ $car->id }}">
    
        <div class="form-group">
            <label for="pickup_location_id">موقع الاستلام:</label>
            <select name="pickup_location_id" id="pickup_location_id" class="form-control" required>
                @foreach($locations as $location)
                    <option value="{{ $location->id }}">{{ $location->city }} - {{ $location->branch_name }}</option>
                @endforeach
            </select>
        </div>
    
        <div class="form-group">
            <label for="dropoff_location_id">موقع التسليم:</label>
            <select name="dropoff_location_id" id="dropoff_location_id" class="form-control" required>
                @foreach($locations as $location)
                    <option value="{{ $location->id }}">{{ $location->city }} - {{ $location->branch_name }}</option>
                @endforeach
            </select>
        </div>
    
        <div class="form-group">
            <label for="start_date">تاريخ الاستلام:</label>
            <input type="date" name="start_date" id="start_date" class="form-control" required min="{{ \Carbon\Carbon::now()->toDateString() }}">
        </div>
    
        <div class="form-group">
            <label for="end_date">تاريخ التسليم:</label>
            <input type="date" name="end_date" id="end_date" class="form-control" required min="{{ \Carbon\Carbon::now()->toDateString() }}">
        </div>
    
        <button type="submit" class="btn btn-primary btn-block">تأكيد الحجز</button>
    </form>
    
</div>
@endsection
