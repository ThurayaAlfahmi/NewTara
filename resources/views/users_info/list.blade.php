@extends('layouts.header')
@php
$page_title = "المستخدمون";
$menu_active = "users";
$prog_footer = env('prog_footer');
$btn_title="إضافة مسخدم جديد";
@endphp

@if (chk_para(session('user_info')['ui_para'], $menu_active."_show")=="no" and session('user_info')['ui_type']!=="1")
    @php
    abort(403, 'ليس لديك الصلاحية للوصول إلى هذه الصفحة.');
    @endphp
@endif


@section('contx')
@include('menu')


<link href="{{ asset('css/jquery.dataTables.css') }}" rel="stylesheet">
<div class="app-wrapper">

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <div class="row g-3 mb-4 align-items-center justify-content-center">
                <div class="col-auto">
                    <div class="page-utilities">
                        <div class="row g-1">
                            <div class="p-1 col-auto order-3">
                                <?php if (chk_para(session('user_info')['ui_para'],$menu_active."_add")=="ok" or session('user_info')['ui_type']=="1"){ ?>
                                <a class="btn btn-primary" data-bs-toggle="modal" data-remote="{{ route('users_info.create') }}"
                                    data-bs-target="#modal-add"><i class="fas fa-plus"></i>
                                    <b>
                                        <?php echo $btn_title; ?>
                                    </b>
                                </a>
                                <?php } ?>
                            </div>
                            
                            <div class="p-1 col-auto order-2">
                                <form action="{{ route('users_info.list') }}" method="GET">
                                    <div class="input-group">
                                        <span class="input-group-text" id="addon-wrapping"><i
                                                class="fas fa-search"></i></span>
                                        <input name="q" type="text" class="form-control"
                                            placeholder="جزء من الرقم أو الاسم أو اسم المستخدم">
                                        <button class="btn btn-info" type="submit" id="button-addon2">
                                            <?php if(isset($_REQUEST["q"]) and $_REQUEST["q"]!=="" ){echo "عرض الكل";}else{echo "بحث";} ?>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <?php if (chk_para(session('user_info')['ui_para'],$menu_active."_rep")=="ok" or session('user_info')['ui_type']=="1"){ ?>
                            <div class="p-1 col-auto order-1">
                                <a class="btn btn-success" data-bs-toggle="modal" data-remote="{{ route('users_info.rep') }}"
                                    data-bs-target="#modal-rep"><i class="far fa-file-alt"></i> <b>التقارير</b></a>
                            </div>
                            <?php } ?>

                            <div id="datepicker"></div>


                        </div>
                        <!--//row-->
                    </div>
                    <!--//table-utilities-->
                </div>
                <!--//col-auto-->
            </div>
            <!--//row-->

            <nav id="orders-table-tab"
                class="hh orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
                <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab"
                    href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">All</a>
                <a class="flex-sm-fill text-sm-center nav-link" id="orders-paid-tab" data-bs-toggle="tab"
                    href="#orders-paid" role="tab" aria-controls="orders-paid" aria-selected="false">Paid</a>
                <a class="flex-sm-fill text-sm-center nav-link" id="orders-pending-tab" data-bs-toggle="tab"
                    href="#orders-pending" role="tab" aria-controls="orders-pending" aria-selected="false">Pending</a>
                <a class="flex-sm-fill text-sm-center nav-link" id="orders-cancelled-tab" data-bs-toggle="tab"
                    href="#orders-cancelled" role="tab" aria-controls="orders-cancelled"
                    aria-selected="false">Cancelled</a>
            </nav>


            <div class="tab-content" id="orders-table-tab-content">
                <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-1">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table class="table app-table-hover mb-0  table-striped table-bordered text-center"
                                    data-toggle="table" id="datat_list">
                                    <thead>
                                        <tr class="bg-infox">
                                            <th data-visible="ture" data-orderable="false">الاداوات</th>

                                            <th class="text-center" data-visible="false">رقم الجوال</b></th>
                                            <th class="text-center" data-visible="true">نوع الصلاحيات</b></th>
                                            <th class="text-center" data-visible="true">اسم المستخدم</b></th>
                                            <th class="text-center" data-visible="true">الاسم</b></th>
                                            <th class="text-center" data-visible="ture"><b>الرقم</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @unless ($listings->isEmpty())
                                        @foreach ($listings as $list)

                                        <td class="cell">
                                            <a class="btn btn-success" data-bs-toggle="modal"
                                                data-remote="{{ route('users_info.show', enc($list->id) ) }}"
                                                data-bs-target="#modal-show"><i class="fas fa-file-alt"></i></a>


                                        </td>
                                        <td class="cell">
                                            <?php echo $list->ui_mobile; ?>
                                        </td>
                                        <td class="cell">
                                            <?php echo get_txt_type($list->ui_type); ?>
                                        </td>
                                        <td class="cell">
                                            <?php echo $list->ui_user; ?>
                                        </td>
                                        <td class="cell">
                                            <?php echo $list->ui_name; ?>
                                        </td>
                                        <td class="cell">
                                            <?php echo $list->id; ?>
                                        </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <!--//table-responsive-->
                        </div>
                        <!--//app-card-body-->
                    </div>
                    <!--//app-card-->
                    <div id="page-selection">
                        {{ $listings->links('pagination::bootstrap-5') }}
                    </div>
                    <nav class="app-pagination text-center mt-2">
                        <div class="text-center">

                        </div>
                    </nav>

                </div>
                <!--//tab-pane-->
            </div>
            <!--//tab-content-->
        </div>
        <!--//container-fluid-->
    </div>
    <!--//app-content-->

    <div class="modal fade" id="modal-add" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        {{ $btn_title }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modal-body-add">
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
    <div class="modal fade" id="modal-show" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">تفاصيل المستخدم</h5>
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
    <div class="modal fade" id="modal-edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">تعديل مستخدم</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modal-body-edit">
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

    <div class="modal fade" id="modal-rep" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">التقارير</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modal-body-rep">
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

    <div class="modal fade" id="modal-sms" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">إرسال معلومات المستخدم</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modal-body-rep">
                    <div class="text-center">
                        <img src="{{ asset('images/loding2.gif') }}" />
                        <p class="rtl">جاري التحميل ...</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">موافق</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('DataTables/datatables.js?v=8') }}"></script>
    <script>
        $( function () {
                        var table = $("#datat_list").DataTable({
                          "order": [],
                          "columnDefs": [ {
                          "targets"  : "no-sort",
                          "orderable": false,
                        }],		
                          "paging": false,
                          "bInfo" : false,
                          "oLanguage": {"sSearch": ""}
                        });
                        new $.fn.dataTable.Buttons( table, {
                        buttons: [
                          {extend: "print",text: '<i class="fas fa-print fa-lg text-muted"></i>',titleAttr: "طباعة على ورق",title: "طباعة"},
                          {extend: "excel",text: '<i class="far fa-file-excel fa-lg text-muted"></i>',titleAttr: "تصدير على إكسل",title: "Excel"},
                          {extend: "colvis",text: '<i class="fas fa-list fa-lg text-muted"></i>',titleAttr: "عرض الحقول"}
                        ]
                    });
                      table.buttons().container().appendTo($(".col-sm-6:eq(0)",table.table().container()));
                        $(".dataTables_filter input").attr("placeholder", "بحث سريع");
                        $(".dataTables_filter input").addClass( "text-center" );
                    });
    </script>

    <script>
        $(function(){
                    
                    $(".modal").on("hide.bs.modal", function () {
                      $(".modal").removeData();
                    });
                    
                    $(".num_only").keypress(function (e) {
                      if (e.which != 8 && e.which != 0 && e.which != 46 && (e.which < 48 || e.which > 57)) {
                        return false;
                      }
                    });
                    
                    });
                    
                    
                    $("#modal-add").on("show.bs.modal", function (e) {
                      var button = $(e.relatedTarget);
                      var modal = $(this);
                      modal.find(".modal-body-add").load(button.data("remote"));
                    }); 
                    
                    $("#modal-show").on("show.bs.modal", function (e) {
                      var button = $(e.relatedTarget);
                      var modal = $(this);
                      modal.find(".modal-body-show").load(button.data("remote"));
                    }); 
                    
                    $("#modal-edit").on("show.bs.modal", function (e) {
                      var button = $(e.relatedTarget);
                      var modal = $(this);
                      modal.find(".modal-body-edit").load(button.data("remote"));
                    });
                    
                    $("#modal-rep").on("show.bs.modal", function (e) {
                      var button = $(e.relatedTarget);
                      var modal = $(this);
                      modal.find(".modal-body-rep").load(button.data("remote"));
                    }); 
                    
                    $("#modal-sms").on("show.bs.modal", function (e) {
                      var button = $(e.relatedTarget);
                      var modal = $(this);
                      modal.find(".modal-body-rep").load(button.data("remote"));
                    }); 
                    
    </script>



    @endunless
    @include('layouts.footer')

    @endsection