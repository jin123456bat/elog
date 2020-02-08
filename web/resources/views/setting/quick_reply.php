<?php
use jin123456bat\assets;
use think\facade\Request;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<title><?=$setting['site_title']?> | <?=$setting['site_desc']?></title>
<!-- 所有页面使用的样式 -->
<link rel="stylesheet" href="<?=assets::css('main.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('spop.min.css')?>" type="text/css" media="all" />
<!-- 当前页面的插件使用的样式 -->
<link rel="stylesheet" href="<?=assets::css('panel.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('form.css')?>" type="text/css" media="all" />
</head>
<body>
	{include file='common/header' /}
	<div class="container">
		{include file='common/sidebar' /}
		<div class="main">
			<div class="title">
				<div class="white-block">
					<div class="wall-block">
						<p><?=$menu_queue?></p>
					</div>
				</div>
			</div>
			<div class="body">
				<div class="white-block">
					<div class="top-tips">
						<div class="top-tips-title">操作提示</div>
						<div class="top-tips-body">
							<p>客户对订单操作的时候，方便直接选择，而无需手动输入</p>
						</div>
					</div>
					<div class="line"></div>
					<form id="settingForm" class="form" method="post" action="<?=url()?>">
						<div class="panel col-md-5">
							<div class="panel-head">
								<div class="panel-title">住房订单</div>
							</div>
							<div class="panel-body">
								<div class="form-group">
									<label class="label col-md-2">取消订单</label>
									<div class="col-md-7">
										<?php if (!empty($quick_reply['room_order_user_quit'])){?>
										<?php foreach ($quick_reply['room_order_user_quit'] as $index=>$content){?>
										<div class="form-group">
											<input type="text" class="input_text col-md-7" name="room_order_user_quit[]" value="<?=$content?>" placeholder="消息内容">
											<button class="button <?=$index==0?'plus':'minus'?>"><?=$index==0?'添加':'删除'?></button>
										</div>
										<?php }?>
										<?php }else{?>
										<div class="form-group">
											<input type="text" class="input_text col-md-7" name="room_order_user_quit[]" value="" placeholder="消息内容">
											<button class="button plus">添加</button>
										</div>
										<?php }?>
									</div>
								</div>
							</div>
						</div>
						
						<div class="form-submit">
							<div class="center-block submit-body">
								<button type="submit" class="button button-submit button-large">保存</button>
								<button type="reset" class="button button-cancel button-large">重置</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	{include file='common/footer' /}
<!-- 通用js -->
<script type="text/javascript" src="<?=assets::common('jquery.min.js','js')?>"></script>
<!-- 全局js调用 -->
<script type="text/javascript" src="<?=assets::js('global.js')?>"></script>
<script type="text/javascript" src="<?=assets::js('spop.min.js')?>"></script>
<!-- 当前页面使用插件的js -->
<script type="text/javascript" src="<?=assets::js('button.loading.js')?>"></script>
<script>
$.ajaxSetup({
	headers: {
        '__token__': '<?=Request::token('__token__')?>' ,
    },
});
</script>
<script type="text/javascript">
$(function(){
	$('#settingForm').on('click','button.plus',function(){
		var input = $(this).parent().clone();
		input.find('input').val('');
		input.find('.button').removeClass('plus').addClass('minus').html('删除');
		input.insertAfter($(this).parent());
		return false;
	}).on('click','button.minus',function(){
		$(this).parent().remove();
		return false;
	}).on('submit',function(){
		$.post($(this).attr('action'),$(this).serialize(),function(response){
			spop({
			    template: response.message,
			    style: response.code==1?'success':'error',
			    autoclose: 3000,
			    position:'bottom-right',
			    icon:true,
			    group:false,
			});
			//window.location.reload();
		});
		return false;
	});
});
</script>
</body>
</html>