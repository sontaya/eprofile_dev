
function user_age(id_input,id_output){
	var birthday=$("#"+id_input).val();
	$.post("./../includes/function_interface.php",{fc:"user_age",birthday:birthday},
			function(data){
				$("#"+id_output).html(data);
	});	
}

function user_name_thai(username,id_output){
	//alert("kk");
	//$("#"+id_output).html("kkk");
	$.post("./../includes/function_interface.php",{fc:"user_name_thai",username:username},
			function(data){
				$("#"+id_output).html(data);
	});	
}

function not_data(){
	$("#note_data").html("<center><h3><font color='red'>......ไม่มีข้อมูล.....</font></h3></center><br><br>");
}

function check_codeuser(id){
	var codeuser=$("#"+id).val();
	var len;
	var digit;
	len = codeuser.length;
	
	for(var i=0 ; i<len ; i++){
		digit = codeuser.charAt(i);
		if(digit!="0" && digit!="1" && digit!="2" && digit!="3" && digit!="4" && digit!="5" && digit!="6" && digit!="7" && digit!="8" && digit!="9" && digit!="-"){
			
			$('#code_user').dialog({
					autoOpen: false,
					modal: true,
					hide: 'slide',
					show: 'slide',
					width:'400',
					height: '150',
					buttons: {
					ปิด: function() {
						$(this).dialog('close');
					}
				}
			});
			
			$("#code_user").dialog('open');
			
			$("#"+id).val("");
		}
	}
}

function chack_idcrad(input_id){
	var id=$("#"+input_id).val();
	if(id.length != 13) return false;
    for(i=0, sum=0; i < 12; i++)
        sum += parseFloat(id.charAt(i))*(13-i);
    if((11-sum%11)%10!=parseFloat(id.charAt(12))) return false;
    return true;
}


function data_table(output_id,return_text,fc){
	
	$("#"+output_id).dialog({
			autoOpen: false,
			modal:  false,
			hide: 'slide',
			show: 'slide',
			width:'400',
			height: '400',
			buttons: {
			ปิด: function() {
				$("#"+output_id).dialog('close');
				}
			}
	});
	
	var ra=Math.floor(Math.random()*11);
	//alert(return_text);
	$.post("./../master/_data_table.php",{fc:fc,return_text:return_text,return_output:output_id,ra:ra},
		   function(data){
				//alert(data);
				$("#"+output_id).dialog('open');
				$("#"+output_id).html(data);
	});	
	
}

function select_data_table(return_text,return_output,data_value){
	//alert(data_value+":"+return_text);
	document.getElementById(return_text).value=data_value;
	$("#"+return_output).dialog('close');
	//$("#fAdd5").dialog('close');
	//insert_input(return_text,data_value);
	//$("#fAdd5").dialog('open');
}


function open_colos(id){
	document.getElementById(id).style.display="inline";
	document.getElementById(id).style.display="none";
}

function insert_input(id_input,data_value){
	document.getElementById(id_input).value=data_value;
}

function open_executives_data(sid){
	
	if(sid.value!='00' && sid.value!=''){
		document.getElementById("executives_data1").style.display="";
		document.getElementById("executives_data2").style.display="";
		document.getElementById("executives_data3").style.display="";
		document.getElementById("executives_data4").style.display="";
		document.getElementById("executives_data5").style.display="";
		document.getElementById("executives_data6").style.display="";
		document.getElementById("executives1").style.display="";
		document.getElementById("executives2").style.display="";
		document.getElementById("executives3").style.display="";
	}
	else{
		document.getElementById("executives_data1").style.display="none";
		document.getElementById("executives_data2").style.display="none";
		document.getElementById("executives_data3").style.display="none";
		document.getElementById("executives_data4").style.display="none";
		document.getElementById("executives_data5").style.display="none";
		document.getElementById("executives_data6").style.display="none";
		document.getElementById("executives1").style.display="none";
		document.getElementById("executives2").style.display="none";
		document.getElementById("executives3").style.display="none";
	}
}




function handleEnter_b(event){
	var e=window.event?window.event:event;
	var keyCode=e.keyCode?e.keyCode:e.which?e.which:e.charCode;
	if (keyCode == 13){
		if (this.className && this.className=='last'){
		this.form.submit();
		return true;
	}
	var i;
	
	/*
	var c=0;
	for (i = 0; i < this.form.elements.length; i++){
		if(this.form.elements[i].type=='text' || this.form.elements[i].type=='radio' || this.form.elements[i].type=='textarea'){
			if(this.form.elements[i].readOnly!='true'){
				c++;
			}
		}
	}
	*/
	//alert(c);
	//i=0;
	
	for (i = 0; i < this.form.elements.length-3; i++)
		
		if (this == this.form.elements[i]){
			break;
		}
		if (this.type=='textarea' && e.shiftKey){
			return true;
		}
		//else if (this.type=='radio'){
			//this.form.elements[i+this.form.elements[this.name].length].focus();
			//this.form.elements[i+1].focus();
		//}
		else if(this.form.elements[i+1].type=='hidden' || this.form.elements[i+1].type=='button'){
			//return true;
			v=1;
			for(a=i;a<=this.form.elements.length;a++){
				if(this.form.elements[a].type!='hidden' && this.form.elements[a].type!='radio' && this.form.elements[a].readOnly!='true' && a!=e_id && a<this.form.elements.length){
					this.form.elements[a].focus();
					//alert(this.form.elements[a].type+":"+a);
					e_id=a;
					a=this.form.elements.length;
				}
			}
			
		}
		else if(this.form.elements[i+1].readOnly=='true'){
			return true;
		}
		else if(this.form.elements[i+1].type=='file'){
			return true;
		}
		else if(this.form.elements[i+1].style.display=='none' || this.form.elements[i+1].style.visibility==='hidden'){
			return true;
		}
		else{
			//alert(this.form.elements[i+1].type);
			this.form.elements[i+1].focus();
			return false;
		}
	}
	else{
		return true;
	}
}
 
/*
function handleEnter(event){
var e=window.event?window.event:event;
var keyCode=e.keyCode?e.keyCode:e.which?e.which:e.charCode;

if (keyCode == 13){
	var i;
	var x;
	var num=i+1;
	
	for (i = 0; i < this.form.elements.length; i++)
		if (this == this.form.elements[i]){
			break;
		}
		if (this.type=='textarea' && e.shiftKey){
			return true;
		}
		else if(this.form.elements[i].type==""){
			alert("null");
		}
		else if(this.form.elements[i+1].type=="hidden"){
			//alert(this.form.elements[i+1].type);
			for(x = i; x <= this.form.elements.length; x++ ){
				if(this.form.elements[x+1].type!="hidden"){
					this.form.elements[x+1].focus();
					x=this.form.elements.length;
					i=this.form.elements.length;
				}
			}
			//this.form.elements[i+2].focus();
		}
		else {
			this.form.elements[i+1].focus();
		}
		return false;
	}

	else
	return true;
}
*/

function handleEnter(event){
		var e=window.event?window.event:event;
		var keyCode=e.keyCode?e.keyCode:e.which?e.which:e.charCode;
		
		if (keyCode == 13){
			var i;
			var x;
			var num=i+1;
			var data_r=Array();
			data_r=getTag();
			
			for (i = 0; i < this.form.elements.length-2; i++)
			if (this == this.form.elements[i]){
				break;
			}
			
			//alert(this.form.elements[i+1].name);
			//alert(data_r[this.form.elements[i+1].name]);
			if(data_r[this.form.elements[i+1].name]==this.form.elements[i+1].name){
				//alert(data_r[this.form.elements[i+1].name]);
				for(x = i; x <= this.form.elements.length-2; x++ ){
					if(data_r[this.form.elements[x+1].name]!=this.form.elements[x+1].name){
						this.form.elements[x+1].focus();
						x=this.form.elements.length;
						i=this.form.elements.length;
					}
				}
				
			}
			else if (this.type=='textarea' && e.shiftKey){
				return true;
			}
			else if(this.form.elements[i].type==""){
				//alert("null");
			}
			else if(this.form.elements[i+1].type=="hidden"){
			//alert(this.form.elements[i+1].type);
				for(x = i; x <= this.form.elements.length; x++ ){
					if(this.form.elements[x+1].type!="hidden"){
						this.form.elements[x+1].focus();
						x=this.form.elements.length;
						i=this.form.elements.length;
					}
				}
			//this.form.elements[i+2].focus();
			}
			else {
				
				if(this.form.elements[i+1].name!=""){
					this.form.elements[i+1].focus();
				}
				
			}
			return false;
		}

		else
		return true;
	}

function getTag(){
		var a=document.forms[0];
		var div=a.getElementsByTagName("DIV");
		var table=a.getElementsByTagName("TABLE");
		var i;
		var a;
		var data=Array();
		for(i=0; i<div.length; i++){
			if(div[i].style.display=="none"){
				for(a=0; a<div[i].getElementsByTagName("INPUT").length; a++){
					//alert(div[i].getElementsByTagName("INPUT")[a].name);
					data[div[i].getElementsByTagName("INPUT")[a].name]=div[i].getElementsByTagName("INPUT")[a].name;
					//alert(data[div[i].getElementsByTagName("INPUT")[a].name]);
				}
			}
		}
		
		for(i=0; i<table.length; i++){
			if(table[i].style.display=="none"){
				for(a=0; a<table[i].getElementsByTagName("INPUT").length; a++){
					//alert(div[i].getElementsByTagName("INPUT")[a].name);
					data[table[i].getElementsByTagName("INPUT")[a].name]=table[i].getElementsByTagName("INPUT")[a].name;
					//alert(data[div[i].getElementsByTagName("INPUT")[a].name]);
				}
			}
		}
		
		for(i=0; i<table.length; i++){
			if(table[i].style.display=="none"){
				for(a=0; a<table[i].getElementsByTagName("SELECT").length; a++){
					//alert(div[i].getElementsByTagName("INPUT")[a].name);
					data[table[i].getElementsByTagName("SELECT")[a].name]=table[i].getElementsByTagName("SELECT")[a].name;
					//alert(data[div[i].getElementsByTagName("INPUT")[a].name]);
				}
			}
		}
		
		return data;
	} 


document.onkeydown=function(){
	var a=document.forms[0];
	for(var i=0;i<a.elements.length;i++){
		var e=a.elements[i];
		//alert(i+":"+e.type);
		e.onkeypress=handleEnter;
	}
}

function form_enter_tab(focus_id){
	if(event.keyCode==13){
		//alert(event.keyCode);
		document.getElementById(focus_id).focus();
	}
}


var e_id;