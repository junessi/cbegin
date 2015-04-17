

$(function (){
	/* 判断是否可以发布资讯*/
	$('.btn-release').click(function (){
		$.post('/Home/News/checkRelease' ,'', function(data){
			
			if(data.status){
				location.href = data.url;
			}
			else{
				
				toast.error(data.info, '温馨提示');
			}
		} ,'json');
		
		return false;
	});
	
	/*点赞*/
	$('.do-zan').click(function (){
		var is_zan = $(this).attr('data-zan');
		if(is_zan == 0){
			var obj = $(this);
			var id = $(this).attr('data-id');
			var zanCount = obj.find('em').text();
			$.post('/Home/News/doZan',{id:id},function(data){
				
				if(data.status){
					obj.find('i').addClass('active');
					toast.success(data.info, '');
					zanCount++;
					obj.find('em').text(zanCount);
					obj.attr({'data-zan':'1'});
					
				}
				else{
					toast.error(data.info, '');
				}
			},'json');
		}
		else{
			toast.error('不要重复点赞');
		}
		
	});
	
	/* 收藏 */
	$('.do-collection').click(function (){
		
		var obj = $(this);
		var id = $(this).attr('data-id');
		var colCount = obj.find('em').text();
		
		$.post('/Home/News/doCollect',{id:id},function(data){
			
			if(data.status){
				obj.find('i').addClass('active');
				toast.success(data.info, '');
				colCount++;
				obj.find('em').text(colCount);
				
			}
			else{
				toast.error(data.info, '');
			}
		},'json');
		
	});
	
});