
function isNumber(obj){ //ตรวจสอบให้กรอกตัวเลขเท่านั้น
 var orgi_text="1234567890";  
 var str_length=obj.length;  
 var isNum=true;  
 var Char_At="";  
 for(i=0;i<str_length && isNum==true;i++){  
	  Char_At=obj.charAt(i);  
	  if(orgi_text.indexOf(Char_At)==-1){  
	   isNum=false;  
	  }     
 }  
 if(!isNum){
/*		alert("กรอกตัวเลขเท่านั้น");
		 $("input#"+field).val("");
		 $("input#"+field).focus();*/
		 } 
		 return isNum;
}

function verifyEmail(obj) {//ตรวจสอบอีเมลแบบที่ 1
 checkEmail = obj;
 if(checkEmail != ""){
  if ((checkEmail.indexOf('@') < 0) || ((checkEmail.charAt(checkEmail.length-4) != '.') && (checkEmail.charAt(checkEmail.length-3) != '.'))){
/*	 	alert("รูปแบบอีเมลไม่ถูกต้อง");
		$("input#"+field).val("");
		 $("input#"+field).focus();*/
		return false;
 }else{
	 return true;
 }
 }
}

function isEmail(obj) {//ตรวจสอบอีเมลแบบที่ 2
	if(obj != ""){
		
		if (obj.search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/) != -1 ){
			return true;
		}else{
/*			alert("รูปแบบอีเมลไม่ถูกต้อง");
			$("input#"+field).val("");
			$("input#"+field).focus();*/
			return false;
		}
		
	}else{
		return true;
	}
}

function Checkfiles(fup){// ตรวจสอบนามสกุลไฟล์
//var fup = document.getElementById('filename');
var fileName = fup.val();
if( fileName != ""){
var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
	if(ext == "gif" || ext == "GIF" || ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "pdf" || ext == "PDF" || ext == "png" || ext == "bmp" || ext == "PNG" || ext == "BMP"){
		return true;
	} 
	else{
		//alert("ไฟล์อัพโหลดไม่ถูกต้อง");
		//fup.focus();
		return false;
	}
}
return true;
}

function Checkfiles2(fup){// ตรวจสอบนามสกุลไฟล์
//var fup = document.getElementById('filename');
var fileName = fup;
if( fileName != ""){
var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
	if(ext == "gif" || ext == "GIF" || ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "pdf" || ext == "PDF" || ext == "png" || ext == "bmp" || ext == "PNG" || ext == "BMP"){
		return true;
	} 
	else{
		//alert("ไฟล์อัพโหลดไม่ถูกต้อง");
		//fup.focus();
		return false;
	}
}
return true;
}

function CheckfilesPic(fup){// ตรวจสอบนามสกุลไฟล์
//var fup = document.getElementById('filename');
var fileName = fup.val();
if( fileName != ""){
var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
	if(ext == "gif" || ext == "GIF" || ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "png" || ext == "bmp" || ext == "PNG" || ext == "BMP"){
		return true;
	} 
	else{
		//alert("ไฟล์อัพโหลดไม่ถูกต้อง");
		//fup.focus();
		return false;
	}
}
return true;
}

function checkEng(obj) {//ตรวจสอบให้กรอก eng ได้อย่างเดียว
  var str="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-()_ "; //ใส่ตัวอักษรที่มีได้ลงในนี้
  var val=obj.val();
  var valOK = true;
    
  for (i=0; i<val.length & valOK; i++){
    valOK = (str.indexOf(val.charAt(i))!= -1) ;
    //alert(valOK)
  }
    
  if (!valOK) {
/*    alert("กรอกภาษาอังกฤษเท่านั้น");
	obj.value="";
    obj.focus();*/
    return false;
  } return true;
}

function checkThai(obj) {//ตรวจสอบให้กรอกไทย ได้อย่างเดียว
  var str="ๆไำพะัีรนยบลงวสา่้เดกหฟผปแอิืทมใฝฦฬฒ์ฮฉฤฆฏโฌ็๋ษศซฐญฯณ๊ธฑฎชขจตคึุูถภ "; //ใส่ตัวอักษรที่มีได้ลงในนี้
  var val=obj.val();
  var valOK = true;
    
  for (i=0; i<val.length & valOK; i++){
    valOK = (str.indexOf(val.charAt(i))!= -1) ;
    //alert(valOK)
  }
    
  if (!valOK) {
  /*  alert("กรอกภาษาไทยเท่านั้น");
	obj.value="";
    obj.focus();*/
    return false;
  } return true;
}

function englishOnlyChars(obj) {   
	var matchString = new RegExp("[a-zA-Z0-9]");   
		if (obj.match(matchString))    { 
		// contains ASCII chars, probably safe to assume not mixed with multibyte chars
		return true     
		}   else    {   
		// No ASCII chars found at all, tsk tsk     
		return false     
	} 
}


function chkTh(id,alrt){		
	if(!checkThai($('#'+id))){
				$('#'+id).val("");
				$("#"+alrt).dialog('open');
	}
}

function chkEn(id,alrt){		
	if(!checkEng($('#'+id))){
				$('#'+id).val("");
				$("#"+alrt).dialog('open');
	}
}

function chkNum(id,alrt){		
	if(!isNumber($('#'+id).val())){
				$('#'+id).val("");
				$("#"+alrt).dialog('open');
	}
}

function chkEml(id,alrt){		
	if(!isEmail($('#'+id).val())){
				$('#'+id).val("");
				$("#"+alrt).dialog('open');
	}
}

function over_button(target,target2){
	document.getElementById(target).style.display="none";
	document.getElementById(target2).style.display="block";
}

function out_button(target,target2){
	document.getElementById(target).style.display="block";
	document.getElementById(target2).style.display="none";
}