 
var countdown=60;
function settime(val) {  
    if (countdown == 0) {  
        val.removeAttribute("disabled");  
        val.value="获取验证码";  
        countdown = 60;  
        return false;  
    } else {  
        val.setAttribute("disabled", true);  
        val.value="重新发送(" + countdown + ")";  
        countdown--;  
    }  
    setTimeout(function() {  
        settime(val);  
    },1000);  
}  

     function newname(){
 	var pername=document.getElementById("pername");
 	var inpname=document.getElementById("inpname");
 	pername.innerHTML=inpname.value
 	
 	
 };
 function newphone(){
 	var perphone=document.getElementById("perphone");
 	var inpphone=document.getElementById("inpphone");
 	perphone.innerHTML=inpphone.value
 	
 	
 }