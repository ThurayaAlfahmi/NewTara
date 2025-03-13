@php
    $title = "سيارة";
    $menu_active = "car";
    $prog_footer = env("prog_footer");
    $btn_title = "إضافة سيارة جديدة";
@endphp

@if (chk_para(session("user_info")["ui_para"], $menu_active."_show") == "no" && session("user_info")["ui_type"] !== "1")
    @php
        abort(403, "ليس لديك الصلاحية للوصول إلى هذه الصفحة.");
    @endphp
@endif
@php
$carTypeMapping = [
    'Family Small' => 'عائلية صغيرة',
    'Family Large' => 'عائلية كبيرة',
    'Sports' => 'رياضية',
    'Luxury' => 'فاخرة',
    'Economy' => 'اقتصادية',
];
@endphp

<div id="forprint">
    <div class="">
        @include('layouts.hshow')
        <hr class="hhp" />
        <div>
            <table class="table table-bordered" style="direction:rtl">
                <tbody>
                    <tr>
                        <td class="text-center bg-infox" style="width: 35%;"><b>الرقم المميز</b></td>
                        <td><b>{{ $car->id }}</b></td>
                    </tr>
                    <tr>
                        <td class="text-center bg-infox" style="width: 35%;"><b>الاسم</b></td>
                        <td><b>{{ $car->name }}</b></td>
                    </tr>
                    <tr>
                        <td class="text-center bg-infox" style="width: 35%;"><b>البراند</b></td>
                        <td><b>{{ $car->brand }}</b></td>
                    </tr>
                    <tr>
                        <td class="text-center bg-infox" style="width: 35%;"><b>الموديل</b></td>
                        <td><b>{{ $car->model }}</b></td>
                    </tr>
                    <tr>
                        <td class="text-center bg-infox" style="width: 35%;"><b>السنة</b></td>
                        <td><b>{{ $car->year }}</b></td>
                    </tr>
                    <tr>
                        <td class="text-center bg-infox" style="width: 35%;"><b>السعر اليومي</b></td>
                        <td><b>{{ $car->daily_rate }}</b></td>
                    </tr>
                    <tr>
                        <td class="text-center bg-infox" style="width: 35%;"><b>التوفر</b></td>
                        <td><b>{{ $car->availability ? 'متاح' : 'غير متاح' }}</b></td>
                    </tr>
                    <tr>
                        <td class="text-center bg-infox" style="width: 35%;"><b>الصورة</b></td>
                        <td>
                            @if($car->image_url)
                                <img src="{{ asset('storage/' . $car->image_url) }}" alt="صورة السيارة" width="100">
                            @else
                                <span>لا توجد صورة</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center bg-infox" style="width: 35%;"><b>الموقع</b></td>
                        <td><b>{{ $car->location->city }} - {{ $car->location->branch_name }}</b></td>
                    </tr>

                    <tr>
                        <td class="text-center bg-infox" style="width: 35%;"><b>نوع السيارة</b></td>
                        <td><b> <?php echo get_carType($car->car_type); ?></b></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mx-auto d-print-none">
            @if (chk_para(session("user_info")["ui_para"], "car_del") == "ok" || session("user_info")["ui_type"] == "1")
                <a class="btn btn-danger del" onclick="del('{{ enc($car->id) }}');" href="#modal-del" data-bs-target="#modal-del"><i class="fas fa-trash"></i> حذف</a>
            @endif

            @if (chk_para(session("user_info")["ui_para"], "car_edit") == "ok" || session("user_info")["ui_type"] == "1")
                <a class="btn btn-info" data-bs-toggle="modal" data-remote="{{ route('car.edit', enc($car->id)) }}" data-bs-target="#modal-edit"><i class="fas fa-edit"></i> تعديل</a>
            @endif

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