function navchoose(){
 var lis = document.getElementById("ul").getElementsByTagName("li");
    var divs = document.getElementById("contener").getElementsByClassName("no");
    for(var i=0; i<lis.length; i++){


        lis[i].index = i;


      lis[i].onclick = function(){


              for(var j=0; j<lis.length; j++){
                lis[j].className = "";
              }


              this.className ="hover";


              for(var i=0; i<divs.length; i++){
                divs[i].style.display="none";
              }


              divs[this.index].style.display = "block";




      }
    }

};navchoose()