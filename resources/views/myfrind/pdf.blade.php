@php
  $page_title = "الأصدقاء";
  $menu_active = "myfrind";
  @endphp
  
  @if (chk_para(session('user_info')['ui_para'], $menu_active."_rep")=="no" and session('user_info')['ui_type']!=="1")
      @php
      abort(403, "ليس لديك الصلاحية للوصول إلى هذه الصفحة");
      @endphp
  @endif
  <style>
      .text-center{
        align-items: center;
        text-align: center;
      }
      .tbg{
        background-color :#bcbcbc ;
        padding: 5px;
    }
  </style>
<table class="text-center" cellspacing="0" cellpadding="5" border="1">
  <thead>
      <tr>
        <th class="tbg text-center" width="16.7%"><b>الرقم</b></th>
        <th class="tbg text-center" width="16.7%"><b>تاريخ الاضافة</b></th>
        <th class="tbg text-center" width="16.7%"><b>الاسم</b></th>
        <th class="tbg text-center" width="16.7%"><b>الجوال</b></th>
        <th class="tbg text-center" width="16.7%"><b>العنوان</b></th>
        <th class="tbg text-center" width="16.7%"><b>البريد الالكتروني</b></th>
        <th class="tbg text-center" width="16.7%"><b>الحالة الاجتماعية</b></th>
      </tr>
    </thead>
  <tbody>
                @unless ($listings->isEmpty())
                @foreach ($listings as $key => $list)
  <tr>
      <td class="text-center" width="16.7%"><?php echo $list->id; ?></td>
      <td class="text-center" width="16.7%"><?php echo $list->my_f_add_date; ?></td>
          <td class="text-center" width="16.7%"><?php echo $list->my_f_name; ?></td>
          <td class="text-center" width="16.7%"><?php echo $list->my_f_mobile; ?></td>
          <td class="text-center" width="16.7%"><?php echo $list->my_f_address; ?></td>
          <td class="text-center" width="16.7%"><?php echo $list->my_f_email; ?></td>
          <td class="text-center" width="16.7%"><?php echo get_my_f_social($list->my_f_social); ?></td>
          
        </tr>
                    @endforeach
                    @endunless
      </tbody>
    </table>
  