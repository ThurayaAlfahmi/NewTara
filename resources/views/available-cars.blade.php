@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach($availableCars as $car)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ asset('storage/' . $car->image_url) }}" alt="صورة السيارة" class="card-img-top" width="100%">
                <div class="card-body">
                    <h5 class="card-title">{{ $car->name }}</h5>
                    <p class="card-text">{{ $car->description }}</p>
                    <p class="card-text"><strong>العلامة التجارية:</strong> {{ $car->brand }}</p>
                    <p class="card-text"><strong>الموديل:</strong> {{ $car->model }}</p>
                    <p class="card-text"><strong>السعر اليومي:</strong> ${{ $car->daily_rate }}</p>
                    <a href="{{ route('book.car', $car->id) }}" class="btn btn-primary">احجز الآن</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
