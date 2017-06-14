/*
window.onload = function(){
	var ran=Math.random();
	change_data("bio_data.php?"+ran,"../images/head2/bio/biodata.png");
	load_dialog();
}
*/

function toggle_form(form,id,ele,targetForm){
	document.getElementById(form).reset();
	if(id != "") document.getElementById(id).value="";
	//$('#data_form').show("fast");
	targetForm = targetForm? targetForm: '#data_form';
	$(targetForm).show("fast").css('display','block');
	//document.getElementById("data_form").style.display = "block";
	//$('#toggle_form').hide("fast");
	//document.getElementById("toggle_form").style.display = "none";
	if(typeof ele != 'undefined'){
		$(ele).hide();
	}else{
		document.getElementById("toggle_form").style.display = "none";
	}
}

function toggle_form2(form,id){
	document.getElementById(form).reset();
	if(id != "") document.getElementById(id).value="";
	//$('#data_form').show("fast");
	document.getElementById("data_form").style.display = "block";
	//$('#toggle_form').hide("fast");
	document.getElementById("toggle_form").style.display = "none";
}



function check_retire_who(){
	var data = "";
	ajaxPostData("_login_retire.php",data,"text","",result_,"","");
}

function result_(response){
	var ran=Math.random();
	if(response != "0"){
		$("p#retire_expire").html("มีบุคลากรถึงกำหนดเกษียนอายุ "+response+" คน<br /><br>ไปยังหน้าจอเกษียนอายุ <a onclick='open_modal()' style='cursor:pointer'><b>คลิกที่นี่</b></a><br /><br />หรือกด <b>ตกลง</b> เพื่อปิด");
		//alert("มีบุคลากรถึงกำหนดเกษียนอายุ "+response+" คน");
		$("#Retired").dialog('open');
		/*var conf = window.confirm("มีบุคลากรถึงกำหนดเกษียนอายุ "+response+" คน\nกด OK เพื่อไปยังหน้าจอเกษียนอายุ");
		if(conf){
			change_data("retire_data.php?"+ran,"../images/head2/work_data/retire.png");
		}*/
	}
}

function open_modal(){
	change_data('retire_data.php','../images/head2/work_data/retire.png');
	document.getElementById('menu7').style.backgroundColor = '#d5aec9';
	document.getElementById('menu7').style.color = '#033';
	document.getElementById('menu7').style.fontWeight = 'bold';
	document.getElementById('menu7').style.paddingLeft = '9px';
	$('#Retired').dialog('close');
}

function check_contract_who(){
	var data = "";
	ajaxPostData("_login_end_contract.php",data,"text","",result_c,"","");
}

function result_c(response){
	var ran=Math.random();
	if(response != "0"){
		alert("มีบุคลากรใกล้หมดสัญญา "+response+" คน");
	}
}

function checkID(id) {

if(id.length != 13) return false;

for(i=0, sum=0; i < 12; i++)

sum += parseFloat(id.charAt(i))*(13-i);

if((11-sum%11)%10!=parseFloat(id.charAt(12))) return false;

return true;

} 

function addCommas(nStr)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}

function roundNumber(rnum, rlength) { // Arguments: number to round, number of decimal places
  var newnumber = Math.round(rnum*Math.pow(10,rlength))/Math.pow(10,rlength);
  return newnumber;
}

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

function calcDays(d1,d2,target){
        t1=document.getElementById(d1).value ;
        t2=document.getElementById(d2).value ;
		if((t1 && t2) != ""){
        var one_day=1000*60*60*24; 
        var x=t1.split("/");     
        var y=t2.split("/");
        var date1=new Date(x[2],(x[1]-1),x[0]);
        var date2=new Date(y[2],(y[1]-1),y[0])
        var month1=x[1]-1;
        var month2=y[1]-1;
        _Diff=Math.ceil((date2.getTime()-date1.getTime())/(one_day))+1; 
  document.getElementById(target).value = _Diff;
		}
}

function CheckfilesPdf(fup){// ตรวจสอบนามสกุลไฟล์
//var fup = document.getElementById('filename');
var fileName = fup.val();
if( fileName != ""){
var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
	if(ext == "pdf" || ext == "PDF"){
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

function Checkfiles(fup){// ตรวจสอบนามสกุลไฟล์
//var fup = document.getElementById('filename');
var fileName = fup.val();
if( fileName != ""){
var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
	if(ext == "gif" || ext == "GIF" || ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "pdf" || ext == "PDF" || ext == "png" || ext == "bmp" || ext == "PNG" || ext == "BMP" || ext == "doc" || ext == "docx"){
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
	if(ext == "gif" || ext == "GIF" || ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "pdf" || ext == "PDF" || ext == "png" || ext == "bmp" || ext == "PNG" || ext == "BMP" || ext == "doc" || ext == "docx"){
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

function  Age(id,yr,mt){// คำนวนอายุจากวันเกิด เมื่อ focus ที่ input box
if($('#'+id).val() != ""){
	var x =$('#'+id).val().split("/");
	var bmo=(parseInt(x[1])-1);//array month start at 0
	var byr=parseInt(eval(x[2] - 543));
	var now = new Date();
	tmo=(now.getMonth());//array month start at 0
	tyr=(now.getFullYear());
	var s_year = parseInt(tyr - byr);
	var s_month = parseInt(tmo - bmo);
	if(s_month < 0){
		s_year -= 1;
		s_month += 12;
	}
	$('#'+yr).val(s_year);
	$('#'+mt).val(s_month);
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



function load_page(target){
	var ran=Math.random();
	$('div#inner_data').html("<img src='../images/indicator_medium.gif' align='absmiddle' style='padding-left: 350px; padding-top: 270px'/>");	
	$(function(){
		var url=target+"?"+ran; // ไฟล์ที่ต้องการรับค้า
		//var dataSet={ name: '' }; // กำหนดชื่อและค่าที่ต้องการส่ง
		$.post(url,function(data){
    		$('div#inner_data').html(data);		
 		 });
	});
	
}

function load_page2(target){
	var ran=Math.random();
	$('div#ex_contract_data').html("<table width='770' border='0' ><tr><td  style='padding-left: 320px; padding-top: 250px;'><div style='border: 5px solid #6CF;width: 110px;height:22px;color: #666666;font-size:16px;font-weight:bold;'> Loading... <img src='../images/facebook.gif' align='absmiddle' /></div></td></tr></table>");	
	$(function(){
		var url=target+"?"+ran; // ไฟล์ที่ต้องการรับค้า
		//var dataSet={ name: '' }; // กำหนดชื่อและค่าที่ต้องการส่ง
		$.post(url,function(data){
			$('html, body').animate({scrollTop: $("#top_main").offset().top}, 1000);
    		$('div#ex_contract_data').html(data);		
 		 });
	});
	
}

function load_page3(target){
	var ran=Math.random();
	$('div#inner_data').html("<img src='../images/indicator_medium.gif' align='absmiddle' style='padding-left: 350px; padding-top: 270px'/>");	
	$(function(){
		var url=target+"?"+ran; // ไฟล์ที่ต้องการรับค้า
		//var dataSet={ name: '' }; // กำหนดชื่อและค่าที่ต้องการส่ง
		$.post(url,function(data){
			$('html, body').animate({scrollTop: $("#top_main").offset().top}, 1000);
    		$('div#inner_data').html(data);		
 		 });
	});
	
}

function load_dialog(){
	var ran=Math.random();
	$(function(){
		var url="dialog.php"+"?"+ran; 
		//var dataSet={ name: '' }; // กำหนดชื่อและค่าที่ต้องการส่ง
		$.post(url,function(data){
    		$('div#dialog').html(data);		
 		 });
	});
	
}

/**
 * ex 19/09/2010
 * getDateObject('19/09/2010','/');
 * 
 * retrun date object
 */
function getDateObject(dateString,dateSeperator)
{
  //This function return a date object after accepting
  //a date string ans dateseparator as arguments
  var curValue=dateString;
  var sepChar=dateSeperator;
  var curPos=0;
  var cDate,cMonth,cYear;

  //extract day portion
  curPos=dateString.indexOf(sepChar);
  cDate=dateString.substring(0,curPos);

  //extract month portion
  endPos=dateString.indexOf(sepChar,curPos+1);
  cMonth=dateString.substring(curPos+1,endPos);

  //extract year portion
  curPos=endPos;
  endPos=curPos+5;
  cYear=curValue.substring(curPos+1,endPos);

  //Create Date Object
  dtObject=new Date(cYear,cMonth,cDate);
  return dtObject;
}


/*===========================================================
Modify for new modules
=============================================================*/

	

function change_data(target,head){
	
	console.log("[change_data] - target: "+ target);
	localStorage.setItem('pageTarget', target);
	console.log("[change_data] - localStorage: "+ localStorage.getItem('pageTarget'));
	
	//console.log("Change Data: " + target);
	
	var currentIndex = (window.location.pathname).replace(/^.*[\\\/]/, '');
	console.log("[change_data] - CurrentIndex: " +currentIndex);
	//window.location.href = "./index.php?target="+target;
	
	
		
		
		
			if(target != ""){
				var wait = "";
				wait +="<table width='770' border='0' ><tr><td  style='padding-left: 320px; padding-top: 250px;'><div style='border: 5px solid #6CF;width: 110px;height:22px;color: #666666;font-size:16px;font-weight:bold;'> Loading... <img src='../images/facebook.gif' align='absmiddle' /></div></td></tr></table>";

				$("#inner_data").html(wait);

				var ran=Math.random();
				$(function(){
					//var url=target+"?"+ran; // ไฟล์ที่ต้องการรับค้า
					var url= localStorage.getItem('pageTarget');
					$.post(url,function(data){
						$('html, body').animate({scrollTop: $("#top_main").offset().top}, 1000);
						$('div.head').html("<img src='"+head+"' />");
						$('#inner_data').html(data);	
					 });
				});

			}else{

					$(function(){
						$('#Not_finish').dialog({
							resizable: false,
							autoOpen: false,
							modal: true,
							hide: 'slide',
							show: 'slide',
							buttons: {
								ตกลง: function() {
									$(this).dialog('close');
								}
							}
						});
					});

					$("#Not_finish").dialog('open');
			}		
		
		
		
	


		
}


function getURLParameter(name) {
  	return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search) || [null, ''])[1].replace(/\+/g, '%20')) || null;
}	

function change_data_location(target){
	console.log("Change Data Location: " + target);
	localStorage.setItem('pageTarget', target);
	window.location.href = "./index-dev.php?target="+target;
	
	
	
	
	
	
	/*
            var KeyDatas = localStorage.getItem('searchKey');
            var KeyData = JSON.parse(KeyDatas);
            $("#inputKeyword").val(KeyData["keyword"]);	
	*/
	
}

