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
							<p>cms的房型管理</p>
						</div>
					</div>
					<div class="col-md-10">
						<form id="room_typeForm" class="form" method="post" action="<?=url('cms/room_type_create')?>">
							<div class="panel col-md-7 center-block">
								<div class="panel-head">
									<div class="panel-title">基础信息</div>
								</div>
								<div class="panel-body">
									<div class="form-group col-md-10">
										<label class="label col-md-2">LOGO</label>
										<div class="col-md-7" id="image_area">
										</div>
										<span class="text-helper col-offset-2">建议大小370x267</span>
									</div>
									<div class="form-group col-md-10">
										<label class="label col-md-2">名称</label>
										<input type="text" class="input_text col-md-7" name="name" value="" placeholder="">
									</div>
									<div class="form-group col-md-10">
										<label class="label col-md-2">价格</label>
										<input type="text" class="input_text col-md-7" name="price" value="" placeholder="">
									</div>
									<div class="form-group col-md-10">
										<label class="label col-md-2">短描述</label>
										<textarea class="textarea col-md-7" rows="5" name="short_desc"></textarea>
									</div>
									<div class="form-group col-md-10">
										<label class="label col-md-2">设施</label>
										<input type="text" class="input_text col-md-7" name="tags" value="" placeholder="">
										<span class="text-helper col-offset-2">多个设施用英文逗号分隔</span>
									</div>
									<div class="form-group col-md-10">
										<label class="label col-md-2">排序</label>
										<input type="text" name="sort" class="input_text col-md-7" value="">
										<span class="text-helper col-offset-2">从小到大</span>
									</div>
									<div class="form-group col-md-10">
										<label class="label col-md-2">置顶</label>
										<div class="checkbox col-md-7">
											<input type="checkbox" name="top" id="top">
											<label for="top">是否置顶，在首页显示</label>
										</div>
									</div>
								</div>
							</div>
							<div class="panel col-md-7 center-block">
								<div class="panel-head">
									<div class="panel-title">房型详细描述</div>
								</div>
								<div class="panel-body" id="content">
								
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
<script type="text/javascript" src="<?=assets::common('wangEditor.min.js','js')?>"></script>
<script>
$.ajaxSetup({
	headers: {
        '__token__': '<?=Request::token('__token__')?>' ,
    } ,
});
$(function(){

	var setUploadEditor = function(editor){
		editor.customConfig.uploadImgMaxSize = 10 * 1024 * 1024
		editor.customConfig.uploadImgServer = '<?=url('common/component/upload')?>';
		editor.customConfig.uploadImgParams = {
		    type: 'wangEditor'
		};
		editor.customConfig.uploadFileName = 'file';
		editor.customConfig.uploadImgHooks = {
			customInsert:function(insertImg, result, editor){
				var url = result.data.url;
				insertImg(url);
			}
		};
	}
	
	var E = window.wangEditor;
	var zIndex = 1;
	var content = new E('#content');
	content.customConfig.zIndex = zIndex;
	setUploadEditor(content);
	content.create();
	
	$('#image_area').upload({
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
				type:'cms_category',
			}
		},
		default_image:'<?=assets::common('plus.png','image')?>',//默认的图片
		max_num:1,//单张图片
		sort:false,//不允许排序
	});

	$('form').on('submit',function(){
		var data = {
			logo:$(this).find('#image_area .images').attr('id'),
			name:$.trim($(this).find('input[name=name]').val()),
			price:$.trim($(this).find('input[name=price]').val()),
			short_desc:$.trim($(this).find('textarea[name=short_desc]').val()),
			tags:$.trim($(this).find('input[name=tags]').val()),
			sort:$.trim($(this).find('input[name=sort]').val()),
			top:$(this).find('input[name=top]:checked').length,
			content:content.txt.html(),
		}
		var btn = $(this).find('button[type=submit]');
		btn.loading('start');
		$.post($(this).attr('action'),data,function(response){
			btn.loading('stop');
			if(response.code==1)
			{
				window.location = '<?=url('cms/room_type_index')?>';
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