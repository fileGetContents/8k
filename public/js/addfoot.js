 function addplace(){
 	var placename=document.getElementById("placename");
 	var inpplace=document.getElementById("inpplace");
 	placename.innerHTML=inpplace.value;
 	
 	
 };
       function share(){ 
            	var btn=document.getElementsByClassName("add");
            var mask=document.getElementById("mask");
            var login=document.getElementById("login");
                mask.style.display="block";
                login.style.display="block";
            };
            var close_login=document.getElementById("close_login");
            close_login.onclick=function(){
                mask.style.display="none";
                login.style.display="none";
            };