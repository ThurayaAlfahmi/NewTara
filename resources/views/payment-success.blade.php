@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    @if(session('payment_method') == 'cash')
        <div class="alert alert-success p-4">
            <h1 class="mb-3">🎉 تم اختيار الدفع نقدًا!</h1>
            <p>{{ session('success') }}</p>
            <p class="mt-3">سيتم توجيهك إلى الصفحة الرئيسية خلال <span id="countdown">5</span> ثوانٍ.</p>
            <a href="{{ route('home') }}" class="btn btn-primary mt-3">اضغط هنا إذا لم يتم التوجيه تلقائيًا</a>
        </div>
    @else
        <div class="alert alert-success p-4">
            <h1 class="mb-3">🎉 تم الدفع بنجاح!</h1>
            <p>{{ session('success') }}</p>
            <p class="mt-3">سيتم توجيهك إلى الصفحة الرئيسية خلال <span id="countdown">5</span> ثوانٍ.</p>
            <a href="{{ route('home') }}" class="btn btn-primary mt-3">اضغط هنا إذا لم يتم التوجيه تلقائيًا</a>
        </div>
    @endif
</div>

<!-- إعادة التوجيه بعد 5 ثوانٍ -->
<meta http-equiv="refresh" content="5;url={{ route('home') }}">

@endsection
