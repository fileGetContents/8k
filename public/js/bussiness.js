//function orderchange() {
//    var lis = document.getElementById("nav2").getElementsByTagName("li");
//    var divs = document.getElementById("contain").getElementsByClassName("no");
//    for (var i = 0; i < lis.length; i++) {
//        lis[i].index = i;
//        lis[i].onclick = function () {
//            for (var j = 0; j < lis.length; j++) {
//                lis[j].className = "";
//            }
//            for (var i = 0; i < divs.length; i++) {
//                divs[i].style.display = "none";
//            }
//            divs[this.index].style.display = "block";
//        }
//    }
//};orderchange();

$('.del').click(function () {
    alert("删除后，该生意机会将会重生一列表中消失确定删除么");
    this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode);
})
