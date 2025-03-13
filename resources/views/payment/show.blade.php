@php
    $title = "تفاصيل الدفع";
    $menu_active = "payment";
    $prog_footer = env("prog_footer");
@endphp

@if (chk_para(session("user_info")["ui_para"], $menu_active."_show") == "no" && session("user_info")["ui_type"] !== "1")
    @php
        abort(403, "ليس لديك الصلاحية للوصول إلى هذه الصفحة.");
    @endphp
@endif

<div id="forprint">
    <div class="">
        @include('layouts.hshow')
        <hr class="hhp" />
        <div>
            <table class="table table-bordered" style="direction:rtl">
                <tbody>
                    <tr>
                        <td class="text-center bg-infox" style="width: 35%;"><b>رقم المعرف</b></td>
                        <td><b>{{ $payment->id }}</b></td>
                    </tr>
                    <tr>
                        <td class="text-center bg-infox" style="width: 35%;"><b>رقم الحجز</b></td>
                        <td><b>{{ $payment->booking_id }}</b></td>
                    </tr>
                    <tr>
                        <td class="text-center bg-infox" style="width: 35%;"><b>اسم المستخدم</b></td>
                        <td><b>{{ $payment->booking->user->name }}</b></td> <!-- Show user name -->
                    </tr>
                    <tr>
                        <td class="text-center bg-infox" style="width: 35%;"><b>المبلغ</b></td>
                        <td><b>${{ $payment->amount }}</b></td>
                    </tr>
                    <tr>
                        <td class="text-center bg-infox" style="width: 35%;"><b>طريقة الدفع</b></td>
                        <td><b>{{ ucfirst($payment->payment_method) }}</b></td>
                    </tr>
                    <tr>
                        <td class="text-center bg-infox" style="width: 35%;"><b>الحالة</b></td>
                        <td><b>{{ ucfirst($payment->status) }}</b></td>
                    </tr>
                    <tr>
                        <td class="text-center bg-infox" style="width: 35%;"><b>التاريخ</b></td>
                        <td><b>{{ $payment->created_at->format('Y-m-d H:i') }}</b></td>
                    </tr>
                    @if ($payment->status != 'paid' && $payment->payment_method == 'cash') <!-- Only show the update button if payment is not confirmed and method is cash -->
                        <tr>
                            <td class="text-center bg-infox" colspan="2">
                                <form action="{{ route('payments.update', $payment->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success">تم الدفع</button>
                                </form>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="mx-auto d-print-none">
            <a href="javascript:void(0);" class="btn btn-success" id="print"><i class="fas fa-print"></i> طباعة</a>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#print").click(function(){
            var mode = "iframe"; // popup
            var close = mode == "popup";
            var options = { mode : mode, popClose : close};
            $("#forprint").printArea(options);
        });
    });
</script>
