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
<style>
.gallery-name {
	padding: 0px 5px;
	position: absolute;
	bottom: 0px;
	border: 1px solid #ccc;
	width: 100%;
	margin: 0px;
	outline: none;
	height: 26px;
	transition: width .5s;
	display: block;
}

.images {
	height: auto !important;
}

.image-body {
	height: 226px !important;
	position: relative;
}

.noborderbottom {
	border-bottom: none !important;
}

.gallery-name:focus {
	width: 150%;
	z-index: 100;
}

.editor {
	font-size: 14px;
	display: flex;
	line-height: 30px;
	justify-content: center;
}

.editor-txt {
	overflow: hidden;
	white-space: nowrap;
}

.editor-icon {
	background: url(<?= assets :: common('edit.png', 'image')?>);
	width: 30px;
	min-width: 30px;
	height: 30px;
	background-size: 16px;
	background-repeat: no-repeat;
	background-position-x: center;
	background-position-y: center;
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
							<p>影集</p>
							<p>拖拽可排序</p>
							<p>编辑按钮可修改名称</p>
						</div>
					</div>
					<div class="col-md-10" id="image_area">
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
	<script type="text/javascript" src="<?=assets::js('jquery-ui.min.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('upload.js')?>"></script>
	<script>
$.ajaxSetup({
	headers: {
        '__token__': '<?=Request::token('__token__')?>' ,
    } ,
});
$(function(){

	$('#image_area').upload({
		init:<?=json_encode($gallery_list,JSON_UNESCAPED_UNICODE)?>,
		width:200,
		height:200,
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
				type:'cms_logo',
			}
		},
		default_image:'<?=assets::common('plus.png','image')?>',//默认的图片
		sort:{
			items:'.images',
			distance :100,
			stop: function( event, ui ) {
				var sort = $('#image_area').sortable('toArray',{ attribute : "data-gallery_id" });
				$.post('<?=url('cms/gallery_sort')?>',{sort:sort},function(response){
				});
			}
		},//允许排序  需要jquery.ui的支持
		new_image_tpl:'<div class="images" id="[id]" data-gallery_id="[gallery_id]">'+
			'<div class="image-body">'+
			'<div class="image-tools-up remove">删除</div>'+
			'<img width="200" height="200" class="image border" src="[url]">'+
			'<div class="editor"><div class="editor-txt">[name]</div><div class="editor-icon"></div></div>'+
			'<input class="gallery-name" style="display:none;" placeholder="图像名称" type="text" name="name" value="">'+
		'</div>'+
		'<div class="circleProgress_wrapper">'+
			'<div class="wrapper right">'+
				'<div class="circleProgress rightcircle"></div>'+
			'</div>'+
			'<font id="loading">100%</font>'+
			'<div class="wrapper left">'+
				'<div class="circleProgress leftcircle"></div>'+
			'</div>'+
		'</div>'+
		'</div>',
		beforeInsert:function(image,data,is_init){
			image.find('.editor').on('click',function(){
				$(this).hide();
				var editor = $(this);
				var editor_txt =  editor.find('.editor-txt');
				var img = image.find('img');
				img.addClass('noborderbottom');
				image.find('.gallery-name').show().val(editor_txt.html()).focus().one('blur',function(){
					editor_txt.html($(this).val());
					editor.show();
					$(this).hide();
					img.removeClass('noborderbottom');
					$.post('<?=url('cms/gallery_rename')?>',{id:image.data('gallery_id'),name:$(this).val()});
					return false;
				}).one('keydown',function(e){
					if(e.which == 13)
					{
						editor_txt.html($(this).val());
						editor.show();
						$(this).hide();
						img.removeClass('noborderbottom');
						$.post('<?=url('cms/gallery_rename')?>',{id:image.data('gallery_id'),name:$(this).val()});
						return false;
					}
				});
			});
			return image;
		},
		afterInsert:function(image,data,is_init){
			if(!is_init)
			{
				$.post('<?=url('cms/gallery_create')?>',data,function(response){
					if(response.code!=1)
					{
						spop({
						    template: response.message,
						    style: response.code==1?'success':'error',
						    autoclose: 3000,
						    position:'bottom-right',
						    icon:true,
						    group:false,
						});
						image.remove();
					}
					else
					{
						image.data('gallery_id',response.data.id);
					}
				});
			}
		},
		beforeRemove:function(image){
			$.post('<?=url('cms/gallery_delete')?>',{id:image.data('gallery_id')},function(response){
				if(response.code!=1)
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
		},
		beforeReplace:function(image,data){
			image.find('.editor-txt').html(data.name);
			$.post('<?=url('cms/gallery_replace')?>',{id:image.data('gallery_id'),logo:data.id,name:data.name},function(response){
				if(response.code!=1)
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
		}
	});
});
</script>
</body>
</html>