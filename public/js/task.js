
    $('.gone').click(function(){
    	$('#remind').css('display','block');
    	$(this).css('background-color','#B8B8B8');
    	$(this).text('已领取');
    });
    $('#close_remind').click(function(){
    	$('#remind').css('display','none');
    	
    })
