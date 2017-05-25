<? //function By Wichayapon  Nuch-Opas: AIS5
function unichr($dec) { 
  if ($dec < 128) { 
    $utf = chr($dec); 
  } else if ($dec < 2048) { 
    $utf = chr(192 + (($dec - ($dec % 64)) / 64)); 
    $utf .= chr(128 + ($dec % 64)); 
  } else { 
    $utf = chr(224 + (($dec - ($dec % 4096)) / 4096)); 
    $utf .= chr(128 + ((($dec % 4096) - ($dec % 64)) / 64)); 
    $utf .= chr(128 + ($dec % 64)); 
  } 
  return $utf;
} 

function strlen_utf8 ($str) {
   $i = 0;
   $count = 0;
   $len = strlen ($str);
   while ($i < $len) {
		$chr = ord ($str[$i]);
		$count++;
		$i++;
		if ($i >= $len)   break;
			if ($chr & 0x80) {
			   $chr <<= 1;
			   while ($chr & 0x80) {
					$i++;
					$chr <<= 1;
			   }
			}
		}
   return $count;
}

 function substr_utf8($str,$from,$len){
     return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.
                          '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s',
                          '$1',$str);
 }
   
function tis2utf8($tis) {
   for( $i=0 ; $i< strlen($tis) ; $i++ ){
      $s = substr($tis, $i, 1);
      $val = ord($s);
      if( $val < 0x80 ){
         $utf8 .= $s;
      } elseif ( ( 0xA1 <= $val and $val <= 0xDA ) or ( 0xDF <= $val and $val <= 0xFB ) ){
         $unicode = 0x0E00 + $val - 0xA0;
         $utf8 .= chr( 0xE0 | ($unicode >> 12) );
         $utf8 .= chr( 0x80 | (($unicode >> 6) & 0x3F) );
         $utf8 .= chr( 0x80 | ($unicode & 0x3F) );
      }
   }
   return $utf8;
}

 function chdate($odate){
  $day = substr_utf8($odate,8,2);
  $month = substr_utf8($odate,5,2);
  $year = substr_utf8($odate,0,4);
  $thdate = $day."/".$month ."/".substr_utf8(($year + 543),2,2);
  return $thdate;
 }
 
 function btwdate($begindate, $enddate){

	  	$bday = substr_utf8($begindate,8,2);
		$eday = substr_utf8($enddate,8,2);
  		$bmonth = substr_utf8($begindate,5,2);
		$emonth = substr_utf8($enddate,5,2);
  		$byear = substr_utf8((substr_utf8($begindate,0,4))+543,2,2);
		$eyear = substr_utf8((substr_utf8($enddate,0,4))+543,2,2);
		if ($byear != $eyear) { $sbdate = $bday."/".$bmonth."/".$byear."-".$eday."/".$emonth."/".$eyear; }else{
		if ($bmonth != $emonth) { $sbdate = $bday."/".$bmonth."-".$eday."/".$emonth."/".$byear; }else{ 
		if ($bday != $eday) { $sbdate = $bday."-".$eday."/".$bmonth."/".$byear; }else{
		$sbdate =  $bday."/".$bmonth."/".$byear;}}}
		return $sbdate;
 }
  function pea_substr($str,$len) { 
  $ctext = 0;
   $txt = "";
  for( $i=0 ; $i< strlen_utf8($str) ; $i++ ){
  $s = substr_utf8($str, $i, 1);
	  if (($s == unichr(3636)) || ($s == unichr(3637)) || 
	      ($s == unichr(3638)) || ($s == unichr(3639)) || 
		  ($s == unichr(3640)) || ($s == unichr(3641)) || 
		  ($s == unichr(3656)) || ($s == unichr(3657)) || 
		  ($s == unichr(3658)) || ($s == unichr(3659)) || 
		  ($s == unichr(3655)) || ($s == unichr(3660)) || 
		  ($s == unichr(3633))){  $txt.=$s;
  		}else{
		$ctext++; $txt.=$s;
		if ($ctext == $len) break;
		}
	}
	if ($ctext < $len) $txt.=""; 
	else $txt.= "";//ถ้าเกินจะให้แสดงอะไร เช่น ...
 	return $txt;
 }
?>