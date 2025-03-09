@php
      $title = "موقع";
      $menu_active = "location";
      $prog_footer = env("prog_footer");
      $btn_title="إضافة موقع جديد";
  @endphp
  
   @if (chk_para(session("user_info")["ui_para"], $menu_active."_show")=="no" and session("user_info")["ui_type"]!=="1")
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
                                    <td class="text-center bg-infox" style="width: 35%;"><b>الرقم المميز</b></td>
                                    <td><b>{{ $location->id }}</b></td>
                                </tr>
                                <tr>
                                    <td class="text-center bg-infox" style="width: 35%;"><b>المدينة</b></td>
                                    <td><b>{{ $location->city }}</b></td>
                                </tr>
                                <tr>
                                    <td class="text-center bg-infox" style="width: 35%;"><b>اسم الفرع</b></td>
                                    <td><b>{{ $location->branch_name }}</b></td>
                                </tr>
                            
                            </tbody>
                        </table>
                    </div>
                    <div class="mx-auto d-print-none">
                        @if (chk_para(session("user_info")["ui_para"], "location_del") == "ok" || session("user_info")["ui_type"] == "1")
                            <a class="btn btn-danger del" onclick="del('{{ enc($location->id) }}');" href="#modal-del" data-bs-target="#modal-del"><i class="fas fa-trash"></i> حذف</a>
                        @endif

                        @if (chk_para(session("user_info")["ui_para"], "location_edit") == "ok" || session("user_info")["ui_type"] == "1")
                            <a class="btn btn-info" data-bs-toggle="modal" data-remote="{{ route('location.edit', enc($location->id)) }}" data-bs-target="#modal-edit"><i class="fas fa-edit"></i> تعديل</a>
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