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
							<p>系统配置修改，如果你不知道配置的具体作用请不要随意修改</p>
						</div>
					</div>
					<div class="line"></div>
					<form id="settingForm" class="form" method="post" action="<?=url()?>">
						<div class="panel  center-block">
							<div class="panel-head">
								<div class="panel-title">基础信息</div>
							</div>
							<div class="panel-body">
								<div class="form-group">
									<label class="label col-md-2">推送规则</label>
									<table class="col-md-7">
										<thead>
											<tr>
												<th style="text-align: center;">通知时间</th>
												<th style="text-align: center;">通知角色</th>
												<th style="text-align: center;">操作</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($rules['rules']) && !empty($rules['rules'])){?>
											<?php foreach ($rules['rules'] as $index => $rule){?>
											<tr>
												<td>
													<input type="text" class="input_text col-md-10" name="time[]" value="<?=$rule['time']?>">
													<span class="text-helper">多少分钟后推送</span>
												</td>
												<td>
													<select name="role_id[]" class="select col-md-10">
														<?php foreach ($role_list as $role){?>
														<option value="<?=$role['id']?>" <?=$rule['role_id']==$role['id']?'selected="selected"':''?>><?=$role['name']?></option>
														<?php }?>
														<option value="0" <?=$rule['role_id']==0?'selected="selected"':''?>>超级管理员</option>
													</select>
													<span class="text-helper">推送给哪些角色</span>
												</td>
												<td>
													<?php if ($index == 0){?>
													<button class="button" id="create-rule-btn">添加</button>
													<?php }else{?>
													<button class="button remove-btn">删除</button>
													<?php }?>
													<span class="text-helper" style="display: block;">&nbsp;</span>
												</td>
											</tr>
											<?php }?>
											<?php }else{?>
											<tr>
												<td>
													<input type="text" class="input_text col-md-10" name="time[]" value="">
													<span class="text-helper">多少分钟后推送</span>
												</td>
												<td>
													<select name="role_id[]" class="select col-md-10">
														<?php foreach ($role_list as $role){?>
														<option value="<?=$role['id']?>"><?=$role['name']?></option>
														<?php }?>
														<option value="0">超级管理员</option>
													</select>
													<span class="text-helper">推送给哪些角色</span>
												</td>
												<td>
													<button class="button" id="create-rule-btn">添加</button>
													<span class="text-helper" style="display: block;">&nbsp;</span>
												</td>
											</tr>
											<?php }?>
										</tbody>
									</table>
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
<script type="text/html" id="tpl_rule">
<tr>
	<td>
		<input type="text" class="input_text col-md-10" name="time[]">
		<span class="text-helper">多少分钟后推送</span>
	</td>
	<td>
		<select name="role_id[]" class="select col-md-10">
			<?php foreach ($role_list as $role){?>
			<option value="<?=$role['id']?>"><?=$role['name']?></option>
			<?php }?>
			<option value="0">超级管理员</option>
		</select>
		<span class="text-helper">推送给哪些角色</span>
	</td>
	<td>
		<button class="button remove-btn">删除</button>
		<span class="text-helper" style="display: block;">&nbsp;</span>
	</td>
</tr>
</script>
<script type="text/javascript">
$(function(){
	$('#create-rule-btn').on('click',function(){
		$(this).parents('table').find('tbody').append($('#tpl_rule').html());
		return false;
	});

	$('table').on('click','.remove-btn',function(){
		$(this).parents('tr').remove();
		return false;
	});
	
	$('#settingForm').on('submit',function(){
		var btn = $(this).find('button[type=submit]');
		btn.loading('start');
		$.post($(this).attr('action'),$(this).serialize(),function(response){
			btn.loading('stop');
			spop({
			    template: response.message,
			    style: response.code==1?'success':'error',
			    autoclose: 3000,
			    position:'bottom-right',
			    icon:true,
			    group:false,
			});
		});
		return false;
	});
});
</script>
</body>
</html>