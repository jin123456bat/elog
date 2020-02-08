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
<link rel="stylesheet" href="<?=assets::css('form.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('button.loading.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('panel.css')?>" type="text/css" media="all" />
<!-- 当前页面使用的样式 -->
<link rel="stylesheet" href="<?=assets::css('hotel_admin/create.css')?>" type="text/css" media="all" />
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
							<p>添加酒店的管理员</p>
							<p>超级管理员拥有全部权限，即使没有配置角色</p>
							<p>一个管理员可以拥有多个角色</p>
						</div>
					</div>
					<div class="line"></div>
					<form class="form" id="form" method="post" action="<?=url('hotel_admin/create')?>" data-hotel_id="<?=Request::get('hotel_id')?>">
						<div class="panel  center-block">
							<div class="panel-head">
								<div class="panel-title">基础信息</div>
							</div>
							<div class="panel-body">
								<div class="form-group col-md-10">
									<label class="label col-md-2">用户名</label>
									<input type="text" class="input_text col-md-7" name="username" value="" placeholder="登陆用户名">
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">真实姓名</label>
									<input type="text" class="input_text col-md-7" name="realname" value="" placeholder="真实姓名">
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">邮箱</label>
									<input type="text" class="input_text col-md-7" name="email" value="" placeholder="邮箱">
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">手机号码</label>
									<input type="text" class="input_text col-md-7" name="mobile" value="" placeholder="手机号码">
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">登陆密码</label>
									<input type="text" class="input_text col-md-7" name="password" placeholder="登陆密码">
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">锁定状态</label>
									<select class="select col-md-7" name="islock">
										<option value="0">未锁定</option>
										<option value="1">已锁定</option>
									</select>
								</div>
							</div>
						</div>
						<div class="line"></div>
						<div class="line"></div>
						<div class="panel  center-block">
							<div class="panel-head">
								<div class="panel-title">权限</div>
							</div>
							<div class="panel-body">
								<div class="form-group">
									<label class="col-md-2 label">权限等级</label>
									<select class="col-md-7 select" name="issupper">
										<option value="0">普通管理员</option>
										<option value="1">超级管理员</option>
									</select>
								</div>
								<div class="form-group" id="role_selector">
									<label class="col-md-2 label">角色</label>
									<div class="col-md-7">
	  									<?php foreach ($role as $r){?>
	  									<div class="col-md-2 ">
											<label class="checkbox-for center-block text-inline" title="<?=$r['note']?>">
												<input name="role[]" type="checkbox" value="<?=$r['id']?>">  <?=$r['name']?>
											</label>
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
	<script type="text/javascript" src="<?=assets::js('jquery.md5.js')?>"></script>
	<script type="text/javascript" src="<?=assets::common('jquery.validate.min.js','js')?>"></script>
	<script type="text/javascript" src="<?=assets::common('messages_zh.min.js','js')?>"></script>
	<script>
$.ajaxSetup({
	headers: {
        '__token__': '<?=Request::token('__token__')?>' ,
    },
});
</script>
	<!-- 当前页面独有的js -->
	<script type="text/javascript" src="<?=assets::js('hotel_admin/create.js')?>"></script>
</body>
</html>