@php 
  $prog_header = env('prog_header');
  $prog_footer = env('prog_footer');
  @endphp
  <table width="100%" border="0" align="center" dir="rtl" class="hhp">
      <tbody>
          <tr>
              <td width="30%" style="text-align: center"><strong>{!! $prog_header !!}</strong></td>
              <td width="40%" style="text-align: center"><img width="150px" src="{{ asset('images/'.env('prog_logo_name') ) }}" /></td>
              <td width="30%" style="text-align: left"><strong>{!! $title !!}</strong></td>
          </tr>
      </tbody>
    </table>
