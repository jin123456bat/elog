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
<link rel="stylesheet" href="<?=assets::css('panel.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('button.loading.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('progress.css')?>" type="text/css" media="all" />
<!-- 当前页面使用的样式 -->
<style>
.images {
	cursor: pointer;
	display: inline-block;
	width: 100px;
	height: 100px;
	position: relative;
	float: left;
	margin: 5px;
}

.images:hover .image-tools-up {
	display: block;
}

.images .image-tools-up {
	display: none;
	position: absolute;
	text-align: center;
	width: 100%;
	top: 0px;
	background-color: #5E5E5E;
	color: #FFFFFF;
}

.images.active .image-tools-down {
	display: none !important;
}

.images .image-tools-down {
	display: none;
	position: absolute;
	text-align: center;
	width: 100%;
	bottom: 0px;
	background-color: #5E5E5E;
	color: #FFFFFF;
}

.images:hover .image-tools-down {
	display: block;
}

.images.active .image {
	border-color: mediumvioletred !important;
}

.upload-image {
	cursor: pointer;
	display: inline-block;
	width: 100px;
	height: 100px;
	float: left;
}

.img-creator-loading {
	border: 1px solid #ccc;
	margin: 5px;
	display: inline-block;
}

.circleProgress_wrapper {
	display: inline-block;
}

.image-wall {
	overflow: hidden;
}

.image-condensed {
	width: 100%;
}

.card-example {
	display: inline-block;
	vertical-align: top;
	margin-left: 45px;
}

.css-font {
	color: #FF6600
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
						<div class="top-tips-body"></div>
					</div>
					<div class="line"></div>
					<form class="form" id="baseForm" action="<?=url('create_text_message')?>">
						<div class="panel col-md-5 center-block">
							<div class="panel-head">
								<div class="panel-title">添加文本消息</div>
							</div>
							<div class="panel-body">
								<div class="form-group col-md-10">
									<label class="label col-md-2">关键词</label>
									<input type="text" class="input_text col-md-6" name="keywords" placeholder="示例:酒店,活动">
									<label style="color: red">多个关键词以英文,分割</label>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2" style="position: relative; bottom: 120px;">响应内容</label>
									<textarea class="textarea col-md-6" style="line-height: 4.428571;" name="content"></textarea>
								</div>
							</div>
						</div>
						<div class="line"></div>
						<div class="line"></div>
						<div class="form-submit">
							<div class="center-block submit-body">
								<button type="submit" class="button button-submit button-large">提交审核</button>
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
	<script type="text/javascript" src="<?=assets::common('jquery.validate.min.js','js')?>"></script>
	<script type="text/javascript" src="<?=assets::common('messages_zh.min.js','js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('jquery-ui.min.js')?>"></script>
	<script>
	$.ajaxSetup({
		headers: {
			'__token__': '<?=Request::token('__token__')?>' ,
		},
	});
</script>
	<!-- 当前页面独有的js -->
	<script type="text/javascript">

	$(function(){
		$('#baseForm').validate({
			rules : {
				keywords:{
					required:true,
				},
				content:{
					required:true,
				},
			},
			message:{
			},
			errorPlacement : function(error, element) {
				if (element.attr('name') == 'issupper') {
					error.css({
						color : '#f4516c',
						marginTop : '0.2rem',
						fontSize : '0.85rem',
						fontFamily : 'Poppins',
						lineHeight : '1.5',
						paddingLeft : '5px',
					}).removeClass('col-offset-2');
					if (element.parents('.panel').find(
						'.panel-title label').length == 0) {
						error.appendTo(element.parents('.panel').find(
							'.panel-title'));
					}
				} else {
					error.css({
						color : '#f4516c',
						marginTop : '0.2rem',
						fontSize : '0.85rem',
						fontFamily : 'Poppins',
						lineHeight : '1.5',
						paddingLeft : '5px',
					});
					error.appendTo(element.parent());
				}
			},
			focusInvalid : true,
			errorClass : 'col-offset-2 error',
			success : function(error, element) {
				if ($(element).attr('name') == 'issupper') {
					$(element).parents('.panel').css({
						border : '',
						borderRadius : '',
					});
					$(element).parents('.panel').find('.panel-title label').remove();
				} else {
					error.remove();
				}
			},
			highlight : function(element, b, c) {
				if ($(element).attr('name') == 'issupper') {
					$(element).parents('.panel').css({
						border : '1px solid #f4516c',
						borderRadius : '3px',
					});
				} else {
					$(element).css({
						borderColor : '#f4516c'
					});
				}
			},

			submitHandler : function(form) {
				var data = {
					id:$(form).data('id'),
					type:'text',
					content:$.trim($(form).find('textarea[name=content]').val()),
					keywords:$.trim($(form).find("input[name=keywords]").val())
				};
				$('.button-submit').loading('start');
				$.post($(form).attr('action'),data,function(response){
					$('.button-submit').loading('stop');
					if(response.code==1)
					{
						window.location = response.data.url;
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
			}
		});
	});
</script>
</body>
</html>