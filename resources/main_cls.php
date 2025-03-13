<?php
  use Alkoumi\LaravelHijriDate\Hijri;
  use Illuminate\Support\Facades\Auth;
  function enc_old($string){
	return rtrim(strtr(base64_encode($string), "+/", "-_"), "="); 
  }
  
  function dec_old($string){
	  return base64_decode(str_pad(strtr($string, "-_", "+/"), strlen($string) % 4, "=", STR_PAD_RIGHT)); 
  }
  
  function enc($text) {
	$key = env('APP_KEY');
	$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
	$encrypted = openssl_encrypt($text, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
	$result = base64_encode($iv . $encrypted);
	$result = enc_old($result);
	return $result;
  }
  
  function dec($encryptedText) {
	$key = env('APP_KEY');
	$data = base64_decode(dec_old($encryptedText));
	$ivLength = openssl_cipher_iv_length('aes-256-cbc');
	$iv = substr($data, 0, $ivLength);
	$encrypted = substr($data, $ivLength);
	$decrypted = openssl_decrypt($encrypted, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
	return $decrypted;
  }

  function clean_get($txt){
	  include ("cnf.php");
	  $txt = str_ireplace("select","5e1ect",$txt);
	  $txt = str_ireplace("update","upd4te",$txt);
	  $txt = str_ireplace("insert","1n5ert",$txt);
	  $txt = str_ireplace("delete","delet",$txt);
	  $txt = str_ireplace("where","w6ere",$txt);
	  $txt = str_ireplace("like","1ink",$txt);
	  //$txt = str_ireplace("or","0r",$txt);
	  $txt = str_ireplace("and","4nd",$txt);
	  $txt = str_ireplace("set","5et",$txt);
	  $txt = str_ireplace("into","1nt0",$txt);
	 $txt = str_ireplace("'", "", $txt);
	  $txt = str_ireplace(";", "", $txt);
	  $txt = str_ireplace(">", "", $txt);
	  $txt = str_ireplace("<", "", $txt);
	  $txt = strip_tags($txt);
	  $txt = fix_arb_num($txt);
	  return $txt;
  } 

	function fix_arb_num($text){
	  	$letters = array("١","٢","٣","٤","٥","٦","٧","٨","٩","٠");
	  	$fruit   = array("1","2","3","4","5","6","7","8","9","0");
	  	$output  = str_ireplace($letters, $fruit, $text);
	  	return $output;
  	}
	  
	function set_stamp($type=""){
		if($type=="hdt"){
			return Hijri::Date("Y-m-d H:i:s"); 
		}elseif($type=="hd"){
			return Hijri::Date("Y-m-d"); 
		}elseif($type=="mdt"){
			return $datex = date("Y-m-d H:i:s");
		}elseif($type=="md"){
			return $datex = date("Y-m-d");
		}else{
			$datex = date("Y-m-d H:i:s");
			return $datex;
		}
	}
	  
	function list_txt_type($val){
	  echo '<option '.($val=="1" ? "selected" : "").' value="1">مدير النظام</option>';
	  echo '<option '.($val=="2" ? "selected" : "").' value="2">مستخدم</option>';
	}
	
	function get_txt_type($type){
		if($type==1){return "مدير النظام";}
		if($type==2){return "مستخدم";}
	}

	function list_txt_para(){
		echo '<option value="users_show">المستخدمون - تفاصيل </option>';
		echo '<option value="users_add">المستخدمون - إضافة</option>';
		echo '<option value="users_edit">المستخدمون - تعديل</option>';
		echo '<option value="users_del">المستخدمون - حذف</option>';
		echo '<option value="users_rep">المستخدمون - تقارير</option>';
		
		echo '<option disabled>----</option>';
		
		echo '<option value="users_show">المستخدمون - تفاصيل </option>';
		echo '<option value="myfrind_show">الأصدقاء - تفاصيل </option>';
		echo '<option value="myfrind_add">الأصدقاء - إضافة</option>';
		echo '<option value="myfrind_edit">الأصدقاء - تعديل</option>';
		echo '<option value="myfrind_del">الأصدقاء - حذف</option>';
		echo '<option value="myfrind_rep">الأصدقاء - تقارير</option>';
		
	}
	
	function get_txt_para($val){
					
		if($val=="users_show"){return "المستخدمون - تفاصيل";}
		if($val=="users_add"){return "المستخدمون - إضافة";}
		if($val=="users_edit"){return "المستخدمون - تعديل";}
		if($val=="users_del"){return "المستخدمون - حذف";}
		if($val=="users_rep"){return "المستخدمون - تقارير";}
		
		if($val=="myfrind_show"){return "الأصدقاء - تفاصيل";}
		if($val=="myfrind_add"){return "الأصدقاء - إضافة";}
		if($val=="myfrind_edit"){return "الأصدقاء - تعديل";}
		if($val=="myfrind_del"){return "الأصدقاء - حذف";}
		if($val=="myfrind_rep"){return "الأصدقاء - تقارير";}
	}
	
	function show_txt_para($val){
		foreach (explode(",", $val) as $id) {
			echo get_txt_para($id)."<br>";	 
		}
	}

	function list_txt_para_edit($val){
	  $permissions = explode(",", $val);
	
	  $options = [
	  		'users_show' => 'المستخدمون - تفاصيل',
  			'users_add' => 'المستخدمون - إضافة',
  			'users_edit' => 'المستخدمون - تعديل',
  			'users_del' => 'المستخدمون - حذف',
  			'users_rep' => 'المستخدمون - تقارير',
			
			'myfrind_show' => 'الأصدقاء - تفاصيل',
			'myfrind_add' => 'الأصدقاء - إضافة',
			'myfrind_edit' => 'الأصدقاء - تعديل',
			'myfrind_del' => 'الأصدقاء - حذف',
			'myfrind_rep' => 'الأصدقاء - تقارير',
			
	  ];
	
	  foreach ($options as $key => $label) {
		  $selected = in_array($key, $permissions) ? "selected" : "";
		  echo "<option $selected value='$key'>$label</option>";
	  }
	}

	function set_reg_stamp($txt){
		$datex = date("Y-m-d H:i:s");
	    $user = Auth::user();
		$usr = $user->id ."-". $user->name;
		$new_text = "<tr><td>$datex</td><td>$txt</td><td>$usr</td></tr>";
		return $new_text;
	}

	function get_alert($type,$msg,$backx=""){
		?>
		<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
			  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
				<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
			  </symbol>
			  <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
				<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
			  </symbol>
			  <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
				<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
			  </symbol>
			</svg>
	<?php if($type=='info'){ ?>
			<div class="alert alert-primary d-flex align-items-center alert-dismissible fade show" role="alert">
			  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
			  <div>
				<?php 
					echo $msg; 
					if($backx!=""){echo '<p><a href="javascript:history.back();">رجوع</a></p>';}
				?>
			  </div>
			</div>
	<?php } ?>		
	
	<?php if($type=='success'){ ?>
			<div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
			  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
			  <div>
				<?php 
					echo $msg; 
					if($backx!=""){echo '<p><a href="javascript:history.back();">رجوع</a></p>';}
				?>
			  </div>
			</div>
	<?php } ?>	
		
	<?php if($type=='warning'){ ?>		
			<div class="alert alert-warning d-flex align-items-center alert-dismissible fade show" role="alert">
			  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
			  <div>
				<?php 
					echo $msg; 
					if($backx!=""){echo '<p><a href="javascript:history.back();">رجوع</a></p>';}
				?>
			  </div>
			</div>
	<?php } ?>
	
	<?php if($type=='error'){ ?>		
			<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
			  <div>
				<?php 
					echo $msg; 
					if($backx!=""){echo '<p><a href="javascript:history.back();">رجوع</a></p>';}
				?>
			  </div>
			  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
	
			<?php 
			}
	}
	function chk_para($main_word,$srch_word){
		if(strpos($main_word, $srch_word) !== false){
			return "ok";
		} else{
			return "no";
		}
	}
	
	function icon($file){
		$img="<i class='far fa-file-alt fa-2x'></i>";
		$ext=strtoupper(substr($file, strrpos($file, ".") + 1));
		if($ext=="PDF"){$img="<i class='far fa-file-pdf fa-2x'></i>";}
		if($ext=="DOCX" or $ext=="DOC" ){$img="<i class='far fa-file-word fa-2x text-info'></i>";}
		if($ext=="XLSX" or $ext=="XLS"){$img="<i class='far fa-file-excel fa-2x text-success'></i>";}
		if($ext=="JPG" or $ext=="JPEG" or $ext=="HEIC" or $ext=="SVG" or $ext=="PNG"){$img="<i class='far fa-file-image fa-2x text-warning'></i>";}
		
		return $img;
	}
	
	function nl2br_sp($txt){
		$tab = "
		<table style='font-size:13px;' class='text-center table table-bordered' border='1' cellspacing='0' cellpadding='0'>
		  <tbody>
			<tr class='bg-warning'>
				<td  width='25%'>التاريخ</td>
				<td  width='50%'>العملية</td>
				<td  width='25%'>المستخدم</td>
			</tr>
			$txt
		  </tbody>
		</table>
		";
		return $tab;
	}
	
	function nlx2br($txt){
		$nx = str_ireplace("&#13;&#10;", "<br>", $txt);
		return $nx;
	}
	
	function send_sms($msg,$mobile){
		//return "$msg,$mobile";
		//exit;
		//https://unifonic.docs.apiary.io/#introduction
		$username="aqutub@holymakkah.gov.sa";
		$password="&1Sar#45oP";
		$URL="https://api.unifonic.com/rest/Messages/SendBulk";
	//	$URL="http://basic.unifonic.com/rest/SMS/messages";
		$fields = array(
							"AppSid" => "yiHIpKEzzmsSWIcT3I4vm3Hgvq2a2K",
							"SenderID" => "HolyMakkah",
							"Body" => "$msg",
							"Recipient" => $mobile,
							"responseType" => "JSON",
							"CorrelationID" => "%22%22",
							"baseEncode" => "true",
							"statusCallback" => "sent",
							"async" => "true"
		
						);
					
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$URL);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=utf-8"));
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$result=curl_exec ($ch);
		$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
		curl_close ($ch);
		//print_r($result);
		//exit;
		$res = json_decode($result);
		//print_r($res);
		//exit;
	//stdClass Object ( [success] => true [message] => [errorCode] => ER-00 [data] => stdClass Object ( [Messages] => Array ( [0] => stdClass Object ( [MessageID] => 41000090471122 [Recipient] => 966565709000 [Status] => Queued ) ) [NumberOfUnits] => 0 [Cost] => 0 [Balance] => 0 [TimeCreated] => 2021-06-21 07:08:12.922 [CurrencyCode] => ) )	
	//stdClass Object ( [success] => true [message] => [errorCode] => ER-00 [data] => stdClass Object ( [Messages] => Array ( [0] => stdClass Object ( [MessageID] => 41000090471433 [Recipient] => 966598984330 [Status] => Queued ) ) [NumberOfUnits] => 0 [Cost] => 0 [Balance] => 0 [TimeCreated] => 2021-06-21 07:10:37.540 [CurrencyCode] => ) )
		if( $res->success=="true" ){
			return "ok";
		}else{
			return $res->message;
		}
	}

	function diff_date_v2($datex){
		if($datex=='0000-00-00' or $datex==''){
			return 'no';
			exit;
		}
		$date1=date_create(date("Y-m-d H:i:s"));
		$date2=date_create($datex);
	
		$diff=date_diff($date1,$date2);
		//print_r($diff);
		//exit;
		if($diff->invert<1){
			return '00:00';
			exit;
		}
		if($diff->h >=1){
			return '00:00';
			exit;
		}elseif($diff->i >=15){
			return '00:00';
			exit;
		}
		else{
			$minx = 15- $diff->i;
			$secx = 59 - $diff->s;
			return "$minx:$secx";
			exit;
		}
	}
	

function list_my_f_social($val){
				
		$options = [
	
					["value" => "married", "text" => "متزوج"],
			
					["value" => "Single", "text" => "أعزب"],
			
					["value" => "divorced", "text" => "مطلق"],
			
				];
				foreach ($options as $option) {
					$selected = $val == $option["value"] ? "selected" : "";
					echo "<option $selected value=\"$option[value]\">$option[text]</option>";
				}
			
}

function get_my_f_social($val){
				
	if($val=="married"){return "متزوج";}
	if($val=="Single"){return "أعزب";}
	if($val=="divorced"){return "مطلق";}
}

function   list_car_type($val){
				
$options = [

["value" => "Family Small", "text" => "عائلية صغيرة"],

["value" => "Family Large", "text" => "عائلية كبيرة"],

["value" => "Sports", "text" => "رياضية"],

["value" => "Luxury", "text" => "فاخرة"],

["value" => "Economy", "text" => "اقتصادية"],

];
foreach ($options as $option) {
	$selected = $val == $option["value"] ? "selected" : "";
	echo "<option $selected value=\"$option[value]\">$option[text]</option>";
}
 
}

function get_carType($val){
	if($val=="Family Small"){return "عائلية صغيرة";}
	if($val=="Family Large"){return "عائلية كبيرة";}
	if($val=="Sports"){return "رياضية";}
	if($val=="Luxury"){return "فاخرة";}
	if($val=="Economy"){return "اقتصادية";}

}

		
