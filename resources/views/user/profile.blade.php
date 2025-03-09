@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center my-4">بياناتي</h2>

    <div class="row">
        <!-- قسم البيانات الشخصية -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h3 class="mb-0">🧑‍💼 البيانات الشخصية</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>الاسم:</strong> {{ auth()->user()->name }}
                        </li>
                        <li class="list-group-item">
                            <strong>البريد الإلكتروني:</strong> {{ auth()->user()->email }}
                        </li>
                        <li class="list-group-item">
                            <strong>رقم الهاتف:</strong> {{ auth()->user()->phone_number ?? 'غير متوفر' }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- رابط تعديل البيانات -->
        <div class="col-md-12 text-center mt-3">
            <a href="{{ route('profile.edit') }}" class="btn btn-primary">تعديل البيانات</a>
        </div>

        <!-- قسم الحجوزات -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h3 class="mb-0">🚗 الحجوزات</h3>
                </div>
                <div class="card-body">
                    @if($bookings->isEmpty())
                        <p class="text-muted text-center">لا توجد حجوزات حتى الآن.</p>
                    @else
                        <ul class="list-group">
                            @foreach($bookings as $booking)
                                <li class="list-group-item">
                                    <strong>السيارة:</strong> {{ $booking->car->name ?? 'غير معروف' }} 
                                    <span class="text-muted float-end">مدة الحجز: {{ $booking->total_days }} يوم</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
