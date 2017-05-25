// JavaScript Document
window.onload = function(){
  document.getElementById("user_name").focus();
}
$(function() {
  $('#user_name').keypress(function(e) {
    if(e.keyCode == 13) {
      sub_login($('#user_name').val(),$('#pass_word').val());
    }
  });

  $('#pass_word').keypress(function(e) {
    if(e.keyCode == 13) {
      sub_login($('#user_name').val(),$('#pass_word').val());
    }
  });
});
 
function sub_login(u,p){
  if(u == "" || p == ""){
    $('div#login_error').html("กรุณากรอกข้อมูลให้ครบ");	
  }else{
    document.getElementById("wait").innerHTML = "<img src='images/login.gif' align='absmiddle' height='45' />";
        
    $.get('login.php',
    {
      user_name: u, 
      pass_word: p
    },
    function(data) {
        login(data[1]);
    });
  }
}

function login(response){

  document.getElementById("wait").innerHTML = "";
  if(response == 0){
    $('div#login_error').html("ชื่อผู้ใช้ หรือ รหัสผ่าน ไม่ถูกต้อง");	
  }else if(response == 1){
    //	check_retire_who();
    //check_contract_who();
    window.location ="main/";
  //alert(response);
  }else{
    //alert('This ststem !');
    //window.location ="main/";
    $('div#login_error').html(response);	
  }
}