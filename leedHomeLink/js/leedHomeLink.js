$(function() {
    $('.popmenu_title').mouseover(function() {
    	$('.popmenu_title').fadeOut("fast", "linear");
    	$('.popmenu').fadeIn("fast", "linear");
    	
	});
	$('.popmenu').mouseleave(function() {
		$('.popmenu').fadeOut("fast", "linear");
		$('.popmenu_title').fadeIn("fast", "linear");
    });
});
