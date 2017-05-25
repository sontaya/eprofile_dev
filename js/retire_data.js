// JavaScript Document
function retire(emp_id){
	//alert(emp_id);
	var conf = window.confirm("ยืนยันที่จะเกษียณบุคคลนี้");
	if(conf){
	var data = "emp_id="+emp_id;
	ajaxPostData("retire_save.php",data,"text","",result_retire,"","");
	
	}else{return false;}
}

function result_retire(response){
	if(response == "1"){
		check_data();
	}
}