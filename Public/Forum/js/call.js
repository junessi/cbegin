

$(function(){
	$(".sel-job ul li").click(function(){
		$(this).addClass("selected").siblings().removeClass("selected");
		var job_index = $(".sel-job ul li").index(this);
		$(".sel-direction ul").eq(job_index).show().siblings().hide();
	});

	$(".sel-direction ul li").click(function(){
		$(this).addClass("selected").siblings().removeClass("selected");
	});

	$(".sel-phase ul li").click(function(){
		$(this).addClass("selected").siblings().removeClass("selected");
	});

	$(".sel-partner ul li").click(function(){
		$(this).addClass("selected").siblings().removeClass("selected");
	});

	$(".show-all-sel").click(function(){
		if($(".sel-phase").css("display") == "none" || $(".sel-partner").css("display") == "none"){
			$(".sel-phase").show();
			$(".sel-partner").show();
			$(".show-all-sel").html("隐藏部分条件");
		} else {
			$(".sel-phase").hide();
			$(".sel-partner").hide();
			$(".show-all-sel").html("显示全部条件");
		}
	});
})