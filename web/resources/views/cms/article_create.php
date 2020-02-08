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
<style>
.w-e-text-container{
	height:auto !important;
	min-height:500px;
}
</style>
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
							<p>添加文章</p>
						</div>
					</div>
					<div class="col-md-10">
						<form id="articleForm" class="form" method="post" action="<?=url('cms/article_create')?>">
							<div class="panel col-md-7 center-block">
								<div class="panel-head">
									<div class="panel-title">基础信息</div>
								</div>
								<div class="panel-body">
									<div class="form-group col-md-10">
										<label class="label col-md-2">主图</label>
										<div class="col-md-7" id="image_area">
										</div>
									</div>
									<div class="form-group col-md-10">
										<label class="label col-md-2">标题</label>
										<input type="text" class="input_text col-md-7" name="title" value="" placeholder="">
									</div>
									<div class="form-group col-md-10">
										<label class="label col-md-2">分类</label>
										<select class="select col-md-6" name="category_id">
											<option value="">无分类</option>
											<?php foreach ($category_list as $category){?>
											<option value="<?=$category['id']?>"><?=$category['name']?></option>
											<?php }?>
										</select>
										<button class="button create_category">添加</button>
									</div>
									<div class="form-group col-md-10">
										<label class="label col-md-2">短描述</label>
										<textarea class="textarea col-md-7" rows="5" name="short_desc"></textarea>
									</div>
									<div class="form-group col-md-10">
										<label class="label col-md-2">标签</label>
										<input type="text" class="input_text col-md-7" name="tags" value="" placeholder="">
										<span class="col-offset-2 text-helper">多个标签使用逗号分隔</span>
									</div>
									<div class="form-group col-md-10">
										<label class="label col-md-2">排序</label>
										<input type="text" class="input_text col-md-7" name="sort" value="" placeholder="">
										<span class="col-offset-2 text-helper">从小到大</span>
									</div>
									<div class="form-group col-md-10">
										<label class="label col-md-2">置顶</label>
										<div class="col-md-7 checkbox">
											<input type="checkbox" name="top" id="top">
											<label for="top">文章是否置顶</label>
										</div>
									</div>
									<div class="form-group col-md-10">
										<label class="label col-md-2">推送到底部信息栏</label>
										<div class="col-md-7 checkbox">
											<input type="checkbox" name="footer1" id="footer1">
											<label for="footer1">推送到底部信息栏</label>
										</div>
									</div>
									<div class="form-group col-md-10">
										<label class="label col-md-2">推送到底部资讯栏</label>
										<div class="col-md-7 checkbox">
											<input type="checkbox" name="footer2" id="footer2">
											<label for="footer2">推送到底部资讯栏</label>
										</div>
									</div>
								</div>
							</div>
							
							
							<div class="panel col-md-7 center-block">
								<div class="panel-head">
									<div class="panel-title">文章内容</div>
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
<script type="text/html" id="category_tpl">
<div class="form-group col-md-10">
	<label class="label col-md-2">分类</label>
	<select class="select col-md-6" name="category_id">
		<option value="">无分类</option>
		<?php foreach ($category_list as $category){?>
		<option value="<?=$category['id']?>"><?=$category['name']?></option>
		<?php }?>
	</select>
	<button class="button delete_category">删除</button>
</div>
</script>
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
	
	$('.create_category').on('click',function(){
		$($('#category_tpl').html()).insertAfter($(this).parents('.form-group'));
		return false;
	});

	$('#articleForm').on('click','.delete_category',function(){
		$(this).parents('.form-group').remove();
		return false;
	});

	
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
				type:'cms_article',
			}
		},
		default_image:'<?=assets::common('plus.png','image')?>',//默认的图片
		max_num:1,//单张图片
		sort:false,//不允许排序
	});

	$('form').on('submit',function(){
		var category = [];
		$('select[name=category_id]').each(function(){
			category.push($(this).val());
		});
		
		var data = {
			logo:$(this).find('#image_area .images').attr('id'),
			title:$.trim($(this).find('input[name=title]').val()),
			short_desc:$.trim($(this).find('textarea[name=short_desc]').val()),
			tags:$.trim($(this).find('input[name=tags]').val()),
			sort:$.trim($(this).find('input[name=sort]').val()),
			category:category,
			content:content.txt.html(),
			top:$(this).find('input[name=top]:checked').length,
			footer1:$(this).find('input[name=footer1]:checked').length,
			footer2:$(this).find('input[name=footer2]:checked').length,
		}
		var btn = $(this).find('button[type=submit]');
		btn.loading('start');
		$.post($(this).attr('action'),data,function(response){
			btn.loading('stop');
			if(response.code==1)
			{
				window.location = '<?=url('cms/article_index')?>';
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