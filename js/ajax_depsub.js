// JavaScript Document
function load_pay(id){
		data = "id="+id;
		//alert(data);
		ajaxPostData("ajax_pay.php",data,"text","",load_pay_res,"");
}

function load_pay_res(response){
	//alert(response);
		$('input#num_munny').val(response.trim());	
		//$('div#num_munny').html(response);	
}


function load_depsub(id){
		data = "id="+id;
		ajaxPostData("ajax_depsub.php",data,"text","",load_depsub_res,"");
}


function load_depsub_one(id){
		data = "id="+id;
		ajaxPostData("ajax_depsub_st_one.php",data,"text","",load_depsub_res,"");
}

function load_depsub_two(id){
		data = "id="+id;
		ajaxPostData("ajax_depsub_st_two.php",data,"text","",load_depsub_res_two,"");
}

function load_depsub_res(response){	
		$('div#ajax_depsub').html(response);	
}

function load_depsub_res_two(response){	
		$('div#ajax_depsub_two').html(response);	
}

function load_depsub2(id){
//alert("load_depsub2");
		data = "id="+id;
		ajaxPostData("ajax_depsub2.php",data,"text","",load_depsub_res2,"");
}

function load_depsub_res2(response){	
		$('div#ajax_depsub2').html(response);	
}

function load_depsub3(id){
//alert("load_depsub2");
		data = "id="+id;
		ajaxPostData("ajax_depsub3.php",data,"text","",load_depsub_res3,"");
}

function load_depsub_res3(response){	
		$('div#ajax_depsub3').html(response);	
}

function load_depsub4(id){
//alert("load_depsub2");
		data = "id="+id;
		ajaxPostData("ajax_depsub4.php",data,"text","",load_depsub_res4,"");
}

function load_depsub_res4(response){	
		$('div#ajax_depsub4').html(response);	
}

function load_depsub5(id){
//alert("load_depsub2");
		data = "id="+id;
		ajaxPostData("ajax_depsub5.php",data,"text","",load_depsub_res5,"");
}

function load_depsub_res5(response){	
		$('div#ajax_depsub5').html(response);	
}