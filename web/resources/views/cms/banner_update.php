<?php
use jin123456bat\assets;
use think\facade\Request;
use jin123456bat\companyController;
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
							<p>cms的滚动图管理</p>
						</div>
					</div>
					<div class="col-md-10">
						<form id="bannerForm" class="form" method="post" action="<?=url('cms/banner_update')?>">
							<div class="panel col-md-7 center-block">
								<div class="panel-head">
									<div class="panel-title">基础信息</div>
								</div>
								<div class="panel-body">
									<div class="form-group col-md-10">
										<label class="label col-md-2">滚动图</label>
										<div class="col-md-7" id="image_area">
										</div>
									</div>
									<div class="form-group col-md-10">
										<label class="label col-md-2">名称</label>
										<input type="text" class="input_text col-md-7" name="name" placeholder="" value="<?=$banner['name']?>">
									</div>
									<div class="form-group col-md-10">
										<label class="label col-md-2">描述</label>
										<input type="text" class="input_text col-md-7" name="description" placeholder="" value="<?=$banner['description']?>">
									</div>
									<div class="form-group col-md-10">
										<label class="label col-md-2">跳转地址</label>
										<input type="text" class="input_text col-md-7" name="link" placeholder="" value="<?=$banner['link']?>">
									</div>
									<div class="form-group col-md-10">
										<label class="label col-md-2">排序</label>
										<input type="text" class="input_text col-md-7" name="sort" value="<?=$banner['sort']?>" placeholder="">
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
	$('#image_area').upload({
		init:[<?=json_encode(['id'=>$banner['logo_id'],'url'=>helper::getImageUrl($banner['logo_path'])])?>],
		width:100,
		height:100,
		size:10*1024*1024,//文件大小  字节
		type:[//文件类型
			'image/jpg',
			'image/jpeg',
			'image/png',
			'image/bmp',
			'image/gif',
		],
		ajax:{
			url:'<?=url('common/component/upload')?>',//ajax请求地址
			data:{
				type:'cms_banner',
			}
		},
		default_image:'<?=assets::common('plus.png','image')?>',//默认的图片
		max_num:1,//单张图片
		sort:false,//不允许排序
	});

	$('form').on('submit',function(){
		var data = {
			id:'<?=Request::get('id')?>',
			logo:$(this).find('#image_area .images').attr('id'),
			name:$.trim($(this).find('input[name=name]').val()),
			description:$.trim($(this).find('input[name=description]').val()),
			link:$.trim($(this).find('input[name=link]').val()),
			sort:$.trim($(this).find('input[name=sort]').val()),
		}
		var btn = $(this).find('button[type=submit]');
		btn.loading('start');
		$.post($(this).attr('action'),data,function(response){
			btn.loading('stop');
			if(response.code==1)
			{
				window.location = '<?=url('cms/banner_index')?>';
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