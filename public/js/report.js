function choosezzz() {	
var pitch=document.getElementsByClassName("reportbtn");
pitch[0].style.borderColor="red";
for(var i=0;i<pitch.length;i++){
pitch[i].onclick=function(){
	for(var j=0;j<pitch.length;j++){
		pitch[j].style.borderColor="";
	}
	this.style.borderColor="red";
}
	
}
};choosezzz() 