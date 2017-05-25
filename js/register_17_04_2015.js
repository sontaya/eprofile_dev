// JavaScript Document
 
function register(emp_id,username,password,password2,user_type,main_department,sub_department){
	var check = true;
	if( emp_id == "" || username == "" || password == "" || password2 == "" ){
			alert("กรุณากรอกข้อมูลให้ครบ");	
		return false;
	}
	if(user_type == "chief" && main_department == ""){ 
			alert("กรุณาเลือกหน่วยงานหลัก");	
			return false;
		}
	/*if(type_card == "1") 
	check = checkID(id_card);
	
	if(!check){
		alert("กรุณากรอกหมายเลขประจำตัวประชาชนให้ถูกต้อง");	
		document.getElementById("id_card").focus();
		return false;
	}*/
	
	if(password != password2){
		alert("รหัสผ่านไม่ตรงกัน กรุณากรอกใหม่อีกครั้ง");	
		document.getElementById("password").value = "";
		document.getElementById("password2").value = "";
		$('#password').focus();
		return false;
	}

		var data = "emp_id="+emp_id+"&username="+username+"&password="+password+"&user_type="+user_type+"&main_department="+main_department+"&sub_department="+sub_department;
		ajaxPostData("register_save.php",data,"text","wait",register_res,"");
	
}

function register_res(response){
	response = parseInt(response);
	if(response == 0){
		alert("ไม่สามารถลงทะเบียนได้");
	}else if(response == 1){
		alert("ลงทะเบียนเรียบร้อยแล้ว");
		window.location ="index.php";
		document.getElementById("register").reset();
	}else if(response == 2){
		alert("หมายเลขประจำตัวบุคลากร และระดับผู้ใช้งานที่เลือกไว้ ได้ลงทะเบียนไปแล้ว");
	}else if(response == 3){
		alert("username นี้ได้ลงทะเบียนไปแล้ว");
	}
	
}