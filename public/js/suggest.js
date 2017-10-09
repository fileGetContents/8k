$(".btn").click(function() {

	if($(this).hasClass("btn")){
		$(this).addClass("hover");
		$(this).removeClass("btn");
	}
	else{
		$(this).addClass("btn");
		$(this).removeClass("hover");
	}
})
