@extends("layouts.header")
  @php
    $page_title = "الأصدقاء";
    $menu_active = "myfrind";
    $prog_footer = env("prog_footer");
    $btn_title="إضافة الأصدقاء جديد";
@endphp

 @if (chk_para(session("user_info")["ui_para"], $menu_active."_show")=="no" and session("user_info")["ui_type"]!=="1")
     @php
     abort(403, "ليس لديك الصلاحية للوصول إلى هذه الصفحة.");
     @endphp
 @endif
   
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
            <div class="d-grid  p-1 col-md-auto col-sm-12 order-3 btn-responsive">
              <?php if (chk_para(session("user_info")["ui_para"],$menu_active."_add")=="ok" or session("user_info")["ui_type"]=="1"){ ?>
                <a class="btn btn-primary btn-responsive" data-bs-toggle="modal" data-remote="{{ route('myfrind.create') }}"  data-bs-target="#modal-add"><i class="fas fa-plus"></i>
                 <b><?php echo $btn_title; ?></b>
                </a>
            <?php } ?>
            
             </div>
              <div class="d-grid  p-1 col-md-auto col-sm-12 order-2 btn-responsive">
                <form action="{{ route('myfrind.list') }}" method="GET">
                 <div class="input-group">
                   <span class="input-group-text" id="addon-wrapping"><i class="fas fa-search"></i></span>
                     <input name="q" type="text" class="form-control" placeholder="جزء من الرقم أو تاريخ الاضافة أو الاسم">
                     <button class="btn btn-info" type="submit" id="button-addon2"><?php if(isset($_REQUEST["q"]) and $_REQUEST["q"]!=="" ){echo "عرض الكل";}else{echo "بحث";} ?></button>
                 </div>
                </form>
              </div>
              <div class="d-grid  p-1 col-md-auto col-sm-12 order-1 btn-responsive">
              <?php if (chk_para(session("user_info")["ui_para"],$menu_active."_rep")=="ok" or session("user_info")["ui_type"]=="1"){ ?>
                <a class="btn btn-success btn-responsive" data-bs-toggle="modal" data-remote="{{ route('myfrind.rep') }}"  data-bs-target="#modal-rep"><i class="far fa-file-alt"></i> <b>التقارير</b></a>
              <?php } ?>
              </div>
              
              <div id="datepicker"></div>

            
            </div><!--//row-->
          </div><!--//table-utilities-->
        </div><!--//col-auto-->
      </div><!--//row-->
     

      
      <nav id="orders-table-tab" class="hh orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
        <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">All</a>
        <a class="flex-sm-fill text-sm-center nav-link"  id="orders-paid-tab" data-bs-toggle="tab" href="#orders-paid" role="tab" aria-controls="orders-paid" aria-selected="false">Paid</a>
        <a class="flex-sm-fill text-sm-center nav-link" id="orders-pending-tab" data-bs-toggle="tab" href="#orders-pending" role="tab" aria-controls="orders-pending" aria-selected="false">Pending</a>
        <a class="flex-sm-fill text-sm-center nav-link" id="orders-cancelled-tab" data-bs-toggle="tab" href="#orders-cancelled" role="tab" aria-controls="orders-cancelled" aria-selected="false">Cancelled</a>
    </nav>
    
    
    <div class="tab-content" id="orders-table-tab-content">
          <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
          <div class="app-card app-card-orders-table shadow-sm mb-1">
            <div class="app-card-body">
              <div class="table-responsive">
                  <table class="table app-table-hover mb-0  table-striped table-bordered text-center" data-toggle="table" id="datat_list">
                <thead>
                  <tr class="bg-infox">
                      <th data-visible="ture" data-orderable="false">الاداوات</th>
                      
      				<th class="text-center" data-visible="false">الحالة الاجتماعية</th>
      				<th class="text-center" data-visible="true">البريد الالكتروني</th>
      				<th class="text-center" data-visible="true">العنوان</th>
      				<th class="text-center" data-visible="true">الجوال</th>
      				<th class="text-center" data-visible="true">الاسم</th>
      				<th class="text-center" data-visible="true">تاريخ الاضافة</th>
	  				<th class="text-center" data-visible="ture"><b>الرقم</b></th>
	  			</tr>
			</thead>
    <tbody>

    @unless ($listings->isEmpty())
    @foreach ($listings as $list)
    
      <td class="cell">
          <a class="btn btn-success" data-bs-toggle="modal"
              data-remote="{{ route('myfrind.show', enc($list->id) ) }}"
              data-bs-target="#modal-show"><i class="fas fa-file-alt"></i></a>
      </td>
      
      
      
		 <td class="cell">
        <?php echo get_my_f_social($list->my_f_social); ?>
     </td>
		<td class="cell">
      <?php echo $list->my_f_email; ?>
    </td>
		<td class="cell">
      <?php echo $list->my_f_address; ?>
    </td>
		<td class="cell">
      <?php echo $list->my_f_mobile; ?>
    </td>
		<td class="cell">
      <?php echo $list->my_f_name; ?>
    </td>
		<td class="cell">
      <?php echo $list->my_f_add_date; ?>
    </td>
		<td class="cell">
      <?php echo $list->id; ?>
    </td>
	</tr>

          @endforeach
          @endunless
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
    <nav class="app-pagination text-center mt-2"></nav>
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
                    <h5 class="modal-title" id="staticBackdropLabel">تفاصيل السجل</h5>
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
                    <h5 class="modal-title" id="staticBackdropLabel">تعديل السجل</h5>
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
      {extend: "print",text: '<i class="fas fa-print fa-lg"></i>',titleAttr: "طباعة على ورق",title: "طباعة"},
      {extend: "excel",text: '<i class="far fa-file-excel fa-lg"></i>',titleAttr: "تصدير على إكسل",title: "Excel"},
      {extend: "colvis",text: '<i class="fas fa-list fa-lg"></i>',titleAttr: "عرض الحقول"}
    ]
});
  table.buttons().container().appendTo($(".col-sm-6:eq(0)",table.table().container()));
    $(".dataTables_filter input").attr("placeholder", "تصفية النتائج");
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

</script>

<script>
function del(vall) {
  if(vall==""){
    swal({text: "لايوجد شيء لحذفه",icon: "error",timer: 2000,button: false,});
    return false;
  }
  swal({title: "تأكيد الحذف",text: "هل ترغب بالتأكيد حذف السجل؟",icon: "warning",dangerMode: true,buttons: ["لا", "نعم"], })
    .then((willDelete) => {
        if (willDelete) {
          window.swal({title: "جاري الحذف",text: "الرجاء الإنتظار",icon: "{{ asset('images/loding2.gif') }}",buttons: false,allowOutsideClick: false});
          axios.delete(`/myfrind/${vall}`)
        .then(response => {
          swal({text: "تم الحذف",icon: "success",timer: 1500,button: false,});
            setTimeout(function(){location.reload();}, 1500);
        })
        .catch(error => {
          swal({text: "خطأ في الطلب",icon: "error",timer: 2000,button: false,});
          });
        }
      });
  };
</script>

@include('layouts.footer')

@endsection

