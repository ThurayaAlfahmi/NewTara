@extends('layouts.header_rep')

@php
    $page_title = "السيارات";
    $menu_active = "car";
    $prog_footer = env('prog_footer');
    use Alkoumi\LaravelHijriDate\Hijri;
    $dgx = Hijri::Date('Y/m/d');
@endphp

@if (chk_para(session('user_info')['ui_para'], $menu_active."_rep") == "no" && session('user_info')['ui_type'] !== "1")
    @php
        abort(403, "ليس لديك الصلاحية للوصول إلى هذه الصفحة");
    @endphp
@endif

@section('contx')

<link href="{{ asset('css/jquery.dataTables.css') }}" rel="stylesheet">
<span class="border mt-2"></span>
<div class="row text-center mt-2 mb-4 border-top-0">
    <div class="col">
        <b>تاريخ إعداد التقرير : {{ $dgx }}</b>
    </div>
    <div class="col">
        <b>تقرير {{ $page_title }}</b>
    </div>
    <div class="col">
        <b>عدد السجلات : {{ $listingsCount }}</b>
    </div>
</div>

<div class="tab-content" id="orders-table-tab-content">
    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
        <div class="app-card app-card-orders-table shadow-sm mb-1">
            <div class="app-card-body">
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 table-striped table-bordered text-center" data-toggle="table" id="datat_ex">
                        <thead>
                            <tr class="bg-infox">
                                <th class="text-center" width="%" data-visible="true">الرقم</th>
                                <th class="text-center" width="%" data-visible="true">الاسم</th>
                                <th class="text-center" width="%" data-visible="true">البراند</th>
                                <th class="text-center" width="%" data-visible="true">الموديل</th>
                                <th class="text-center" width="%" data-visible="true">السنة</th>
                                <th class="text-center" width="%" data-visible="true">السعر اليومي</th>
                                <th class="text-center" width="%" data-visible="true">التوفر</th>
                                <th class="text-center" width="%" data-visible="true">الموقع</th>
                                <th class="text-center" width="%" data-visible="true">نوع السيارة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @unless ($listings->isEmpty())
                                @foreach ($listings as $key => $car)
                                    <tr>
                                        <td>{{ $car->id }}</td>
                                        <td>{{ $car->name }}</td>
                                        <td>{{ $car->brand }}</td>
                                        <td>{{ $car->model }}</td>
                                        <td>{{ $car->year }}</td>
                                        <td>{{ $car->daily_rate }}</td>
                                        <td>{{ $car->availability ? 'متاح' : 'غير متاح' }}</td>
                                        <td>{{ $car->location->city }} - {{ $car->location->branch_name }}</td>
                                        <td>
                                        
                                                <?php echo get_carType($car->car_type); ?>
                                             
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9" class="text-center">لا توجد بيانات</td>
                                </tr>
                            @endunless
                        </tbody>
                    </table>
                    <hr>
                    <table class="text-center" data-toggle="table" width="30%" border="1" cellspacing="3" cellpadding="3">
                        <tbody>
                            <tr>
                                <td class="tbg" colspan="2">الملخص</td>
                            </tr>
                            <tr>
                                <td width="45%" class="tbgxv rtl">{{ $listingsCount }}</td>
                                <td width="55%" class="tbgx">المجموع</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('DataTables/datatables.js?v=8') }}"></script>
<script>
    $(document).ready(function () {
        var table = $("#datat_ex").DataTable({
            "order": [],
            "columnDefs": [{
                "targets": "no-sort",
                "orderable": false,
            }],
            "paging": false,
            "bInfo": false,
            "oLanguage": { "sSearch": "" }
        });
        new $.fn.dataTable.Buttons(table, {
            buttons: [
                { extend: "print", exportOptions: { columns: ":visible" }, text: '<i class="fa-solid fa-print fa-2xl"></i>', titleAttr: "طباعة على ورق", title: "طباعة" },
                { extend: "excel", exportOptions: { columns: ":visible" }, text: '<button class="btn btn-success text-white"><i class="fa-regular fa-file-excel fa-beat-fade fa-2xl"></i> تصدير إكسل</button>', titleAttr: "تصدير على إكسل", title: "Excel" },
                { extend: "colvis", text: '<i class="fa fa-list fa-2xl" aria-hidden="true"></i>', titleAttr: "عرض الحقول" }
            ]
        });
        table.buttons().container().appendTo($('.col-sm-6:eq(0)', table.table().container()));
        $('.dataTables_filter input').attr("placeholder", "بحث سريع");
        $('.dataTables_filter input').addClass("text-center");
    });
</script>

@include('layouts.footer')
@endsection