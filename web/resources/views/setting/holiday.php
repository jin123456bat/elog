<?php
use jin123456bat\assets;
use think\facade\Request;
use jin123456bat\helper;
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
<link rel="stylesheet" href="<?=assets::css('datetimepicker.css')?>" type="text/css" media="all" />
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
							<p>节日字典表</p>
							<p>每年节日都是由国务院统一规定因此需要预先录入到系统中</p>
						</div>
					</div>
					<div class="line"></div>
					<form id="settingForm" class="form" method="post" action="<?=url()?>">
						<div class="panel col-md-7 center-block">
							<div class="panel-head">
								<div class="panel-title">节日字典表</div>
							</div>
							<div class="panel-body">
								<?php if (!empty($holidays)){?>
								<?php foreach ($holidays as $index => $holiday){?>
								<div class="form-group col-md-10 holiday">
									<input type="text" class="input_text col-md-3" name="name[]" value="<?=$holiday['name']?>" placeholder="假日名称">
									<input type="text" class="input_text datetimepicker col-md-3" name="startdate[]" value="<?=$holiday['startdate']?>" placeholder="开始日期">
									<input type="text" class="input_text datetimepicker col-md-3" name="enddate[]" value="<?=$holiday['enddate']?>" placeholder="结束日期">
									<?php if (empty($index)){?>
									<button class="button" id="create_holiday_btn">添加</button>
									<?php }else{?>
									<button class="button remove_holiday_btn">删除</button>
									<?php }?>
								</div>
								<?php }?>
								<?php }else{?>
								<div class="form-group col-md-10 holiday">
									<input type="text" class="input_text col-md-3" name="name[]" value="" placeholder="假日名称">
									<input type="text" class="input_text datetimepicker col-md-3" name="startdate[]" value="" placeholder="开始日期">
									<input type="text" class="input_text datetimepicker col-md-3" name="enddate[]" value="" placeholder="结束日期">
									<button class="button" id="create_holiday_btn">添加</button>
								</div>
								<?php }?>
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
	<script type="text/javascript" src="<?=assets::js('datetimepicker.js')?>"></script>
	<script>
$.ajaxSetup({
	headers: {
        '__token__': '<?=Request::token('__token__')?>' ,
    },
});
</script>
<script type="text/html" id="tpl_holiday">
<div class="form-group col-md-10 holiday">
	<input type="text" class="input_text col-md-3" name="name[]" value="" placeholder="假日名称">
	<input type="text" class="input_text datetimepicker col-md-3" name="startdate[]" value="" placeholder="开始日期">
	<input type="text" class="input_text datetimepicker col-md-3" name="enddate[]" value="" placeholder="结束日期">
	<button class="button remove_holiday_btn">删除</button>
</div>
</script>
<script type="text/javascript">
$(function(){

	$('.datetimepicker').each(function(){
		$(this).datetimepicker({
			select:'date',
		});
	});
	
	$('#create_holiday_btn').on('click',function(){
		var tpl = $($('#tpl_holiday').html());
		tpl.find('.datetimepicker').each(function(){
			$(this).datetimepicker({
				select:'date',
			});
		});
		tpl.insertAfter($('.holiday:last'));
		return false;
	});

	$('#settingForm').on('click','.remove_holiday_btn',function(){
		$(this).parents('.holiday').remove();
		return false;
	});

	$('#settingForm').on('submit',function(){
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