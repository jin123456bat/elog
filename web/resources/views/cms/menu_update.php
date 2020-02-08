<?php
use jin123456bat\assets;
use think\facade\Request;
use jin123456bat\companyController;
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
<link rel="stylesheet" href="<?=assets::css('panel.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('button.loading.css')?>" type="text/css" media="all" />
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
							<p>cms的菜单管理</p>
						</div>
					</div>
					<div class="col-md-10">
						<form id="menuForm" class="form" method="post" action="<?=url('cms/menu_update')?>">
							<div class="panel col-md-7 center-block">
								<div class="panel-head">
									<div class="panel-title">基础信息</div>
								</div>
								<div class="panel-body">
									<div class="form-group col-md-10">
										<label class="label col-md-2">名称</label>
										<input type="text" class="input_text col-md-7" name="name" value="<?=$menu['name']?>" placeholder="">
									</div>
									<div class="form-group col-md-10">
										<label class="label col-md-2">上级菜单</label>
										<select class="select col-md-7" name="sup_menu_id">
											<option value="">顶级菜单</option>
											<?php foreach ($menu_list as $m){?>
											<option value="<?=$m['id']?>" <?=$menu['sup_menu_id'] == $m['id']?'selected="selected"':''?>><?=$m['name']?></option>
											<?php }?>
										</select>
									</div>
									<div class="form-group col-md-10">
										<label class="label col-md-2">跳转地址</label>
										<input type="text" class="input_text col-md-7" name="link" value="<?=$menu['link']?>" placeholder="">
									</div>
									<div class="form-group col-md-10">
										<label class="label col-md-2">排序</label>
										<input type="text" class="input_text col-md-7" name="sort" value="<?=$menu['sort']?>" placeholder="">
										<span class="col-offset-2 text-helper">从小到大</span>
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
	</div>
	{include file='common/footer' /}
<!-- 通用js -->
<script type="text/javascript" src="<?=assets::common('jquery.min.js','js')?>"></script>
<!-- 全局js调用 -->
<script type="text/javascript" src="<?=assets::js('global.js')?>"></script>
<!-- 当前页面使用的第三方类库的js -->
<script type="text/javascript" src="<?=assets::js('datatables.js')?>"></script>
<script type="text/javascript" src="<?=assets::js('spop.min.js')?>"></script>
<script type="text/javascript" src="<?=assets::js('button.loading.js')?>"></script>
<script type="text/javascript" src="<?=assets::js('upload.js')?>"></script>
<script>
$.ajaxSetup({
	headers: {
        '__token__': '<?=Request::token('__token__')?>' ,
    } ,
});
$(function(){
	$('form').on('submit',function(){
		var data = {
			id:'<?=Request::get('id')?>',
			name:$.trim($(this).find('input[name=name]').val()),
			sup_menu_id:$.trim($(this).find('select[name=sup_menu_id]').val()),
			link:$.trim($(this).find('input[name=link]').val()),
			sort:$.trim($(this).find('input[name=sort]').val()),
		}
		var btn = $(this).find('button[type=submit]');
		btn.loading('start');
		$.post($(this).attr('action'),data,function(response){
			btn.loading('stop');
			if(response.code==1)
			{
				window.location = '<?=url('cms/menu_index')?>';
			}
			else
			{
				spop({
				    template: response.message,
				    style: response.code==1?'success':'error',
				    autoclose: 3000,
				    position:'bottom-right',
				    icon:true,
				    group:false,
				});
			}
		});
		return false;
	});
});
</script>
</body>
</html>