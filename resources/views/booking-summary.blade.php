@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">ملخص الحجز</h1>

    <!-- عرض تفاصيل السيارة -->
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

    <!-- عرض تفاصيل الحجز -->
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

    <!-- زر الدفع -->
    <a href="{{ route('payment.form', $booking->id) }}" class="btn btn-primary btn-block">المتابعة إلى الدفع</a>
</div>
@endsection
