@php
//$prog_header = env('prog_header');
//$page_title = "المستخدمون";
//$menu_active = "users";
//$prog_footer = env('prog_footer');
//include_once(public_path("class/uCal.class.php"));
//$dg = new uCal;
//$dg->setLang("ar");
//$fdate=date("Y_m_d_h_i");
@endphp

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
          <td width="10%" class="tbg text-center">الرقم</td>
          <td width="20%" class="tbg text-center" >الاسم</td>
          <td width="30%" class="tbg text-center" >اسم المستخدم</td>
          <td width="20%" class="tbg text-center" >نوع الصلاحيات</td>
          <td width="20%" class="tbg text-center" >رقم الجوال</td>                   
      </tr>
  </thead>
<tbody>
  @foreach ($listings as $key => $list)
  <tr>
    <td width="10%" class="text-center">{{ $key + 1 }}</td>
    <td width="20%" class="text-center">{{ $list->ui_name }}</td>
    <td width="30%" class="text-center">{{ $list->ui_user }}</td>
    <td width="20%" class="text-center">{{ get_txt_type($list->ui_type) }}</td>
    <td width="20%" class="text-center">{{ $list->ui_mobile }}</td>
  </tr>
@endforeach

  </tbody>
</table>

