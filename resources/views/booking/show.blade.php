
@php
    $title = "تفاصيل الحجز";
    $menu_active = "booking";
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
                        <td class="text-center bg-infox" style="width: 35%;"><b>رقم الحجز</b></td>
                        <td><b>{{ $booking->id }}</b></td>
                    </tr>
                    <tr>
                        <td class="text-center bg-infox" style="width: 35%;"><b>اسم المستخدم</b></td>
                        <td><b>{{ $booking->user->name }}</b></td>
                    </tr>
                    <tr>
                        <td class="text-center bg-infox" style="width: 35%;"><b>السيارة</b></td>
                        <td><b>{{ $booking->car->name }}</b></td>
                    </tr>
                    <tr>
                        <td class="text-center bg-infox" style="width: 35%;"><b>موقع الاستلام</b></td>
                        <td><b>{{ $booking->pickupLocation->city }} - {{ $booking->pickupLocation->branch_name }}</b></td>
                    </tr>
                    <tr>
                        <td class="text-center bg-infox" style="width: 35%;"><b>موقع التسليم</b></td>
                        <td><b>{{ $booking->dropoffLocation->city }} - {{ $booking->dropoffLocation->branch_name }}</b></td>
                    </tr>
                    <tr>
                        <td class="text-center bg-infox" style="width: 35%;"><b>تاريخ البدء</b></td>
                        <td><b>{{ $booking->start_date }}</b></td>
                    </tr>
                    <tr>
                        <td class="text-center bg-infox" style="width: 35%;"><b>تاريخ الانتهاء</b></td>
                        <td><b>{{ $booking->end_date }}</b></td>
                    </tr>
                    <tr>
                        <td class="text-center bg-infox" style="width: 35%;"><b>الحالة</b></td>
                        <td><b>{{ ucfirst($booking->status) }}</b></td>
                    </tr>
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

