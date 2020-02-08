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
<style>
.upload_image{
	width: 187px;
    height: 110px;
    border: 1px dashed #ccc;
    text-align: center;
    display: flex;
    flex-flow: column nowrap;
    font-size: 50px;
    color: #ccc;
    justify-content: center;
	cursor: pointer;
}

.upload_image:hover{
	    color: #999;
    border-color: #999;
}

.image-outline{
	padding:5px;
}

.image-list{
	display: inline-flex;
    flex-flow: row wrap;
}

.image-outline{
	position:relative;
	height: 144px;
}

.image-outline .remove{
	position: absolute;
    top: -5px;
    right: -5px;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    background-color: red;
    text-align: center;
    color: #fff;
    line-height: 20px;
    cursor: pointer;
    display: none;
}

.image-outline:hover .remove{
	display: block;
}

.link{
	padding: 0px 5px;
    position: absolute;
    bottom: 0px;
    border: 1px solid rgba(41, 161, 177, 1);
    width: calc( 100% - 10px );
    margin: 0px;
    outline: none;
    height: 26px;
	    transition: width .5s;
}

.link:focus{
	width:150%;
	z-index:100;
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
							<p>系统配置修改，如果你不知道配置的具体作用请不要随意修改</p>
						</div>
					</div>
					<div class="line"></div>
					<form id="settingForm" class="form" method="post" action="<?=url()?>">
						<div class="panel  center-block">
							<div class="panel-head">
								<div class="panel-title">页面配置</div>
							</div>
							<div class="panel-body">
								<div class="form-group col-md-10">
									<label class="label col-md-2">首页LOGO</label>
									<div class="col-md-7 image-list">
										<?php foreach ($company_logo as $logo){?>
										<div class="image-outline">
											<div class="image">
												<img src="<?=$logo['logo_path']?>">
												<input type="hidden" name="logo_id[]" value="<?=$logo['logo_id']?>">
												<div class="remove">x</div>
											</div>
											<input class="link" placeholder="跳转链接" type="text" name="link[]" value="<?=$logo['link']??''?>">
										</div>
										<?php }?>
										<div class="image-outline">
											<div class="upload_image">
											+
											</div>
										</div>
									</div>
									<span class="col-offset-2 text-helper">最佳的图片尺寸为412X220</span>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">客房预定提示</label>
									<textarea class="textarea col-md-7" rows="7" name="room_book_notice"><?=$room_book_notice?></textarea>
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
<script type="text/html" id="tpl_image">
<div class="image-outline">
	<div class="image">
		<img src="{image_url}">
		<input type="hidden" name="logo_id[]" value="{id}">
		<div class="remove">x</div>
	</div>
	<input class="link" placeholder="跳转链接" type="text" name="link[]" value="<?=$logo['link']??''?>">
</div>
</script>
<!-- 通用js -->
<script type="text/javascript" src="<?=assets::common('jquery.min.js','js')?>"></script>
<!-- 全局js调用 -->
<script type="text/javascript" src="<?=assets::js('global.js')?>"></script>
<script type="text/javascript" src="<?=assets::js('spop.min.js')?>"></script>
<!-- 当前页面使用插件的js -->
<script type="text/javascript" src="<?=assets::js('button.loading.js')?>"></script>
<script type="text/javascript" src="<?=assets::js('jquery-ui.min.js')?>"></script>
<script>
$.ajaxSetup({
	headers: {
        '__token__': '<?=Request::token('__token__')?>' ,
    },
});
</script>
<script type="text/javascript">
$(function(){
	$('.upload_image').on('click',function(){
		var input = $('<input type="file" accept="image/*">');
		input.on('change',function(){
			var file = $(this)[0].files[0];
			var formData = new FormData();
			formData.append('file',file);
			formData.append('type','company_logo');
			formData.append('imagesize','187x110');
			var xhr = new XMLHttpRequest();
			xhr.open('POST','<?=url('common/component/upload')?>',true);
			xhr.upload.onloadstart = function(){
			}
			xhr.upload.onprogress = function(event){
			};
			xhr.onload = function(){
				if(xhr.status == 200 && xhr.readyState == 4)
				{
					var response = xhr.response;
					response = $.parseJSON(response);
					if(response.code==1)
					{
						response.data.image_url = response.data.url;
						var reg = /{([a-zA-Z0-9_]+)}/g;
						var tpl_image = $($('#tpl_image').html().replace(reg, function (node, key) {
							return response.data[key];
						}));
						tpl_image.insertBefore($('.image-list .image-outline:last'));
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
				}
			};
			xhr.send(formData);
		});
		input.trigger('click');
		return false;
	});

	$('.image-list').sortable({
		items:'.image-outline',
		distance :100,
	});
	$('.image-list').disableSelection();

	$('.image-list').on('click','.remove',function(){
		$(this).parents('.image-outline').remove();
		return false;
	})
	
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
		});
		return false;
	});
});
</script>
</body>
</html>