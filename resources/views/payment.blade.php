@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">الدفع</h1>

    <div class="card mx-auto" style="max-width: 500px;">
        <div class="card-body">
            <h5 class="card-title text-center mb-3">اختر طريقة الدفع</h5>

            <form action="{{ route('process.payment', $booking->id) }}" method="POST">
                @csrf
                
                <div class="form-group mb-3">
                    <label for="payment_method">طريقة الدفع:</label>
                    <select name="payment_method" id="payment_method" class="form-control" required>
                        <option value="credit_card">بطاقة ائتمانية</option>
                        <option value="paypal">باي بال</option>
                        <option value="cash">نقدًا</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success btn-block">ادفع الآن</button>
            </form>
        </div>
    </div>
</div>
@endsection
