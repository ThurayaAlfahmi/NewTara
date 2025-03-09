@extends('layouts.header_rep')
@php
$page_title = "المستخدمون";
$menu_active = "users";
$prog_footer = env('prog_footer');
include(public_path("class/uCal.class.php")); 
$dg = new uCal;
$dg->setLang("ar");

@endphp

@if (chk_para(session('user_info')['ui_para'], $menu_active."_rep")=="no" and session('user_info')['ui_type']!=="1")
    @php
    abort(403, 'ليس لديك الصلاحية للوصول إلى هذه الصفحة.');
    @endphp
@endif


@section('contx')


<link href="{{ asset('DataTables/datatables.css') }}" rel="stylesheet">
<span class="border mt-2"></span>
<div class="row text-center mt-2 mb-4 border-top-0">
  <div class="col">
    <b><?php echo " تاريخ إعداد التقرير:  ".$dg->date("l d-m-Y"); ?></b>
  </div>
  <div class="col">
    <b>تقرير {{ $page_title }}</b>
  </div>
  <div class="col">
    <b>عدد السجلات : {{ $listingsCount }}</b>
  </div>
</div>
</div>
<div class="tab-content" id="orders-table-tab-content">
    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
    <div class="app-card app-card-orders-table shadow-sm mb-1">
      <div class="app-card-body">
        <div class="table-responsive">
            <table class="table app-table-hover mb-0  table-striped table-bordered text-center" data-toggle="table" id="datat_ex">
              <thead>
                    <tr class="bg-infox">
                        <th class="text-center" data-visible="true">رقم الجوال</b></th>
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
</div>
  </div>
  </div>
</div>


    <script src="{{ asset('DataTables/datatables.js?v=8') }}"></script>
    <script>
        $(document).ready( function () {
        var table = $("#datat_ex").DataTable({
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
        	{extend: "print",exportOptions: {columns: ":visible"},text: '<i class="fa-solid fa-print fa-2xl"></i>',titleAttr: "طباعة على ورق",title: "طباعة"},
        	{extend: "excel",exportOptions: {columns: ":visible"},text: '<button class="btn btn-success text-white"><i class="fa-regular fa-file-excel fa-beat-fade fa-2xl"></i> تصدير إكسل</button>',titleAttr: "تصدير على إكسل",title: "Excel"},
        	{extend: "colvis",text: '<i class="fa fa-list fa-2xl" aria-hidden="true"></i>',titleAttr: "عرض الحقول"}
    	]
        });
        table.buttons().container().appendTo($('.col-sm-6:eq(0)',table.table().container()));
        $('.dataTables_filter input').attr("placeholder", "بحث سريع");
        $('.dataTables_filter input').addClass( "text-center" );
    });
    </script>
    

<script>
    function xinput(){
$("input").on("keyup", function (e) {
  var value = $(this).val() || "";
  var regex = /<(\/?\w+[^\n>]*\/?)>/ig;
  var regex2 = /<(\/?\/?)>/ig;
  if(regex2.test(value)){
      //layer.msg("Invalid characters!");
      $(this).val(value.replace(regex2, "&lt;$1&gt;"));
      e.preventDefault();
      return false;
  }
  if(regex.test(value)){
      //layer.msg("Invalid characters!");
      $(this).val(value.replace(regex, "&lt;$1&gt;"));
      e.preventDefault();
      return false;
  }
});		
}
  </script>
    @endunless
    @include('layouts.footer')
    @endsection
    