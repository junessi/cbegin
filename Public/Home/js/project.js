

$(function (){
	
	/* 判断是否可以发布资讯*/
	$('.btn-release').click(function (){
		
		//var categroy_id = $(this).attr('data-cate');
		var btn = "";
		$.post('/Home/Project/checkRelease' ,'', function(data){
			
			if(data.status){
				
				btn = "<a href='" +data.url+ "?category_id=51' class='btn btn-danger'>发布项目找伙伴</a>&nbsp;&nbsp;&nbsp;&nbsp;";
				btn += "<a href='" +data.url+ "?category_id=52' class='btn btn-danger'>发布资金找项目</a>";
				
				$('.modal-body').html(btn);
				$('#myModal').modal('show');
				//location.href = data.url + "?category_id=" + categroy_id;
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
			$.post('/Home/Project/doZan',{id:id},function(data){
				
				if(data.status){
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
		
		$.post('/Home/Project/doCollect',{id:id},function(data){
			
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