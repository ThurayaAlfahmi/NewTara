@extends("layouts.header")
@php
    $page_title = "المدفوعات";
    $menu_active = "payment";
    $prog_footer = env("prog_footer");
    $btn_title = "المدفوعات";
@endphp

@if (chk_para(session("user_info")["ui_para"], $menu_active."_show") == "no" && session("user_info")["ui_type"] !== "1")
    @php
        abort(403, "ليس لديك الصلاحية للوصول إلى هذه الصفحة.");
    @endphp
@endif
<div id="page-selection">
    {{ $payments->links('pagination::bootstrap-5') }}
</div>

@section("contx")
@include("menu")
<link href="{{ asset('css/jquery.dataTables.css') }}" rel="stylesheet">

<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="row g-3 mb-4 align-items-center justify-content-center">
                <div class="col-auto">
                    <div class="page-utilities">
                        <div class="row g-1">
                            <div class="d-grid p-1 col-md-auto col-sm-12 order-2 btn-responsive">
                                <form action="{{ route('payment.list') }}" method="GET">
                                    <div class="input-group">
                                        <span class="input-group-text" id="addon-wrapping"><i class="fas fa-search"></i></span>
                                        <input name="q" type="text" class="form-control" placeholder="جزء من رقم الحجز أو اسم المستخدم أو طريقة الدفع">
                                        <button class="btn btn-info" type="submit" id="button-addon2">
                                            <?php if(isset($_REQUEST["q"]) and $_REQUEST["q"]!=="" ){echo "عرض الكل";}else{echo "بحث";} ?>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div><!--//row-->
                    </div><!--//table-utilities-->
                </div><!--//col-auto-->
            </div><!--//row-->

            <nav id="orders-table-tab" class="hh orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
                <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">All</a>
                <a class="flex-sm-fill text-sm-center nav-link" id="orders-pending-tab" data-bs-toggle="tab" href="#orders-pending" role="tab" aria-controls="orders-pending" aria-selected="false">Pending</a>
                <a class="flex-sm-fill text-sm-center nav-link" id="orders-completed-tab" data-bs-toggle="tab" href="#orders-completed" role="tab" aria-controls="orders-completed" aria-selected="false">Completed</a>
            </nav>

            <div class="tab-content" id="orders-table-tab-content">
                <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-1">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table class="table app-table-hover mb-0 table-striped table-bordered text-center" data-toggle="table" id="datat_list">
                                    <thead>
                                        <tr class="bg-infox">
                                            <th data-visible="true" data-orderable="false">الأدوات</th>
                                            <th class="text-center" data-visible="true">رقم المعرف</th>
                                            <th class="text-center" data-visible="true">رقم الحجز</th>
                                            <th class="text-center" data-visible="true">المبلغ</th>
                                            <th class="text-center" data-visible="true">طريقة الدفع</th>
                                            <th class="text-center" data-visible="true">الحالة</th>
                                            <th class="text-center" data-visible="true">التاريخ</th>
                                            <th class="text-center" data-visible="true">اسم المستخدم</th>                                             
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @unless ($payments->isEmpty())
                                            @foreach ($payments as $payment)
                                                <tr>
                                                    <td class="cell">
                                                        <a class="btn btn-success" data-bs-toggle="modal" data-remote="{{ route('payments.show', enc($payment->id)) }}" data-bs-target="#modal-show">
                                                            <i class="fas fa-file-alt"></i>
                                                        </a>
                                                    </td>
                                                    <td class="cell">{{ $payment->id }}</td>
                                                    <td class="cell">{{ $payment->booking_id }}</td>
                                                    <td class="cell">${{ $payment->amount }}</td>
                                                    <td class="cell">{{ ucfirst($payment->payment_method) }}</td>
                                                    <td class="cell">{{ ucfirst($payment->status) }}</td>
                                                    <td class="cell">{{ $payment->created_at->format('Y-m-d H:i') }}</td>
                                                    <td class="cell"><b>{{ $payment->booking->user->name }}</b></td>
                                                </tr>
                                            @endforeach
                                        @endunless
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="page-selection">
                        {{ $payments->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-show" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">تفاصيل الدفع</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body-show">
                <div class="text-center">
                    <img src="{{ asset('images/loding2.gif') }}" />
                    <p class="rtl">جاري التحميل ...</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء الأمر</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('DataTables/datatables.js?v=8') }}"></script>
<script>
    $(function () {
        var table = $("#datat_list").DataTable({
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
                { extend: "print", text: '<i class="fas fa-print fa-lg"></i>', titleAttr: "طباعة على ورق", title: "طباعة" },
                { extend: "excel", text: '<i class="far fa-file-excel fa-lg"></i>', titleAttr: "تصدير على إكسل", title: "Excel" },
                { extend: "colvis", text: '<i class="fas fa-list fa-lg"></i>', titleAttr: "عرض الحقول" }
            ]
        });
        table.buttons().container().appendTo($(".col-sm-6:eq(0)", table.table().container()));
        $(".dataTables_filter input").attr("placeholder", "تصفية النتائج");
        $(".dataTables_filter input").addClass("text-center");
    });

    $(".modal").on("hide.bs.modal", function () {
        $(".modal").removeData();
    });

    $("#modal-show").on("show.bs.modal", function (e) {
        var button = $(e.relatedTarget);
        var modal = $(this);
        modal.find(".modal-body-show").load(button.data("remote"));
    });
</script>

@include('layouts.footer')
@endsection
