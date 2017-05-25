// JavaScript Document
 
function new_person(emp_id){
	emp_id = emp_id.replace(/ /g, "");
	if(emp_id == ""){
		alert("กรุณากรอกหมายเลขบุคลากรที่ต้องการเพิ่มข้อมูล");	
		document.getElementById("emp_id").value="";
		document.getElementById("emp_id").focus();
		return false;
	}
	
	
		var data = "emp_id="+emp_id;
		ajaxPostData("new_person_save.php",data,"text","wait",new_person_res,emp_id,"");
}

function new_person_res(response,emp_id){
  	//alert(response);
	if(response == 0){
		alert("ไม่สามารถเพิ่มข้อมูลได้");
	}else if(response == 1){
		alert("เพิ่มข้อมูลเรียบร้อยแล้ว");
		edit_(emp_id);
	}else if(response == 2){
		alert("หมายเลขบุคลากรนี้ มีอยู่ในประวัติบุคลากรแล้ว");
	}
}

function edit_(emp_id){
	//alert(emp_id);
	var data_s = "emp_id="+emp_id;
	ajaxPostData("change_session.php",data,"text","",result_edit,"","");

}

function result_edit(response){
	alert(response);
	if(response == 1){
		window.location ="../main/";
	}
}