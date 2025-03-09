@extends('layouts.header_rep')
  @php
  $page_title = "الموقع";
  $menu_active = "location";
  $prog_footer = env('prog_footer');
  use Alkoumi\LaravelHijriDate\Hijri;
  $dgx =  Hijri::Date('Y/m/d'); 
  @endphp
  
  @if (chk_para(session('user_info')['ui_para'], $menu_active."_rep")=="no" and session('user_info')['ui_type']!=="1")
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
  </div>


  <div class="tab-content" id="orders-table-tab-content">
    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
      <div class="app-card app-card-orders-table shadow-sm mb-1">
        <div class="app-card-body">
          <div class="table-responsive">
              <table class="table app-table-hover mb-0  table-striped table-bordered text-center" data-toggle="table" id="datat_ex">
                <thead>
                  <tr class="bg-infox">    
                  
     					      <th class="text-center" width="%" data-visible="true">الرقم</th>
     					      <th class="text-center" width="%" data-visible="true">المدينة</th>
                               <th class="text-center" width="%" data-visible="true">اسم الفرع</th>

	  			      </tr>
            	</thead>
	            <tbody>
                @unless ($listings->isEmpty())
                @foreach ($listings as $key => $list)

              
                			<td><?php echo $list->city; ?></td>
                			<td><?php echo $list->branch_name ; ?></td>
					<td><?php echo $list->id;//$key + 1; ?></td>
				</tr>
        @endforeach
      </tbody>
    </table>      
    <hr>
    <table class="text-center" data-toggle="table"  width="30%" border="1" cellspacing="3" cellpadding="3">
      <tbody>
        <tr>
          <td class="tbg" colspan="2">الملخص</td>
        </tr>
        <tr>
          <td width="45%" class="tbgxv rtl">1222</td>
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
    @endunless
@include('layouts.footer')
@endsection

