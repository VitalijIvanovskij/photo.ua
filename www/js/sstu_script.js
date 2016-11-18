var delay = 500;
$(document).ready(function(){
	$(".left_swap img").click(function(){
		if($(".left_side").is(":visible")){
			$(".left_swap").css("background-color", "#1d282b");
			$(".left_side").fadeOut(delay);
		}
		else{
			$(".left_side").fadeIn(delay);
			
			setTimeout(function(){
				$(".left_swap").css("background-color", "rgba(0,0,0,0)");
			},delay);			
		}
	});
});