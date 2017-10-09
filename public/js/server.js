function orderchange(){
 var lis = document.getElementById("ul1").getElementsByTagName("li");
    var divs = document.getElementById("section-right").getElementsByClassName("no");
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

};orderchange()