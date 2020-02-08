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
	width: 194px;
	height: 68px;
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

.res-content {
	margin-bottom: 15px;
	text-align: center;
	font-size: 16px;
}

.res-head {
	font-size: 18px;
	margin-bottom: 10px;
	margin-top: 10px;
}

.res-body {
	background-color: #fff;
	background-image: none;
	border: 1px solid #ccc;
	width: 59%;
	margin-left: 20%;
	border-radius: 4px;
}

.res-form {
	border: 2px solid ghostwhite;
	width: 65%;
	margin-top: 15px;
}

.res-input {
	padding-bottom: 8px;
}

.res-input .textarea {
	padding: 7px 18px;
	line-height: 2.428571;
}

.add-content {
	border: 2px solid ghostwhite;
	width: 65%;
	margin-left: 83px;
	font-size: 14px;
	min-height: 36px;
	margin-bottom: 20px;
	padding: 6px;
	cursor: pointer;
}

.del-content {
	height: 30px;
	line-height: 30px;
	padding: 0 10px;
	font-size: 12px;
	border: 1px solid #C9C9C9;
	background-color: #fff;
	color: #555;
	border-radius: 100px;
}

.res-title {
	border: 1px solid #ddd;
	color: #333;
	background-color: #f5f5f5;
	border-color: #ddd;
	padding: 10px 15px;
	border-bottom: 1px solid transparent;
	border-top-left-radius: 3px;
	border-top-right-radius: 3px;
	display: flex;
	flex-flow: row nowrap;
	justify-content: space-between;
}

.res-close {
	cursor: pointer;
}

.error {
	display: block;
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
							<p>图文消息最多可以填写8个</p>
						</div>
					</div>
					<div class="line"></div>
					<form class="form" id="baseForm" action="<?=url('change_message')?>">
						<input type="hidden" name="type" value="news">
						<div class="panel col-md-5 center-block">
							<div class="panel-head">
								<div class="panel-title">修改图文消息</div>
							</div>
							<div class="form-group col-md-10">
								<label class="label col-md-2">关键词</label>
								<input type="text" class="input_text col-md-6" name="keywords" placeholder="示例:酒店,活动" value="{$list.keywords}">
								<label style="color: red">多个关键词以英文,分割</label>
							</div>
							<div class="res-content">
								<div class="res-head">回复的图文内容</div>
								<div class="res-body">
									<div class="res-panel">
										{foreach $list.content as $vo}
										<div class="form-group col-md-10 res-form">
											<div class="res-title">
												回复内容
												<span class="res-close">x</span>
											</div>
											<div>
												<div class="col-md-7 imageArea" data-upload-url='<?=url('common/component/upload')?>'>
													<div class="img-creator-loading">
														<div class="circleProgress_wrapper display-none">
															<div class="wrapper right">
																<div class="circleProgress rightcircle"></div>
															</div>
															<font id="loading">100%</font>
															<div class="wrapper left">
																<div class="circleProgress leftcircle"></div>
															</div>
														</div>
														<img class="upload-image" src="{$vo->logo_path}" data-id="{$vo->logo_id}">
													</div>
												</div>
											</div>
											<div class="res-input">
												<input type="text" class="input_text" name="title" placeholder="添加标题" value="{$vo->title}">
											</div>
											<div class="res-input">
												<input type="text" class="input_text" name="jump_url" placeholder="添加跳转链接" value="{$vo->jump_url}">
											</div>
											<div class="res-input">
												<textarea class="textarea" name="description" placeholder="添加描述">{$vo->description}</textarea>
											</div>
										</div>
										{/foreach}
									</div>
									<div class="add-content">添加回复信息</div>
								</div>
							</div>
						</div>
						<div class="line"></div>
						<div class="line"></div>
						<input type="hidden" name="id" value="{$list.id}">
						<input type="hidden" name="type" value="news">
						<div class="form-submit">
							<div class="center-block submit-body">
								<button type="submit" class="button button-submit button-large">提交审核</button>
								<button type="reset" class="button button-cancel button-large">重置</button>
							</div>
						</div>
					</form>
					<div id="form-none-body" style="display: none;">
						<div class="form-group col-md-10 res-form">
							<div class="res-title">
								回复内容
								<span class="res-close">x</span>
							</div>
							<div>
								<div class="col-md-7 imageArea" data-upload-url='<?=url('common/component/upload')?>'>
									<div class="img-creator-loading">
										<div class="circleProgress_wrapper display-none">
											<div class="wrapper right">
												<div class="circleProgress rightcircle"></div>
											</div>
											<font id="loading">100%</font>
											<div class="wrapper left">
												<div class="circleProgress leftcircle"></div>
											</div>
										</div>
										<img class="upload-image" src="<?=assets::common('plus.png','image')?>">
									</div>
								</div>
							</div>
							<div class="res-input">
								<input type="text" class="input_text" name="title" placeholder="添加标题" value="">
							</div>
							<div class="res-input">
								<input type="text" class="input_text" name="jump_url" placeholder="添加跳转链接" value="">
							</div>
							<div class="res-input">
								<textarea class="textarea" name="description" placeholder="添加描述"></textarea>
							</div>
						</div>
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
		var num = 1;
		var res_panel = $('#form-none-body').html();
		var _this;
		$('body').on('click','.imageArea .upload-image',function(){
			_this = $(this);
			var input = $('<input type="file">');
			input.on('change',function(){
				var file = $(this)[0].files[0];
				var formData = new FormData();
				formData.append('file',file);
				formData.append('type','weixin_message');
				formData.append('imagesize','weixin_message_preview');
				var xhr = new XMLHttpRequest();
				xhr.open('POST',$('.imageArea').data('upload-url'),true);
				xhr.upload.onloadstart = function(){
					_this.parents('.imageArea').find('.img-creator-loading .circleProgress_wrapper').removeClass('display-none');
					_this.parents('.imageArea').find('.img-creator-loading .circleProgress_wrapper #loading').text('0%');
					_this.parents('.imageArea').find('.img-creator-loading .upload-image').addClass('display-none')
				}
				xhr.upload.onprogress = function(event){
					if (event.lengthComputable) {
						_this.parents('.imageArea').find('.img-creator-loading .circleProgress_wrapper #loading').text(Math.round(event.loaded / event.total * 100) + "%");
					}
				};
				xhr.onload = function(){
					_this.parents('.imageArea').find('.img-creator-loading .circleProgress_wrapper').addClass('display-none');
					_this.parents('.imageArea').find('.img-creator-loading .upload-image').removeClass('display-none')
					if(xhr.status == 200 && xhr.readyState == 4)
					{
						var response = xhr.response;
						response = $.parseJSON(response);
						var url = response.data['url'];

						_this.attr("src",url);
						_this.attr("data-id",response.data['id']);
					}
				};
				xhr.send(formData);
			});
			input.trigger('click');
			return false;
		}).on('click','.remove',function(){
			$(this).parents('.images').remove();
			return false;
		});

		$('.imageArea').sortable({
			items:'.images',
			distance :100,
		});
		$('.imageArea').disableSelection();

		$('.image-wall').sortable({
			items:'.image-condensed',
			distance :100,
		});
		$('.image-wall').disableSelection();

		$('#baseForm').validate({
			rules : {
				keywords:{
					required:true,
				},
				title:{
					required:true,
				},
				description:{
					required:true
				},
				jump_url:{
					required:true
				}
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
				var send_datas = new Array();
				var res = true;
				$('.res-panel .res-form').each(function (index,element) {
					var send_data={};
					send_data['title'] = $(element).find('input[name=title]').val();
					send_data['description']=$.trim($(element).find('textarea[name=description]').val());
					send_data['logo_id']=$(element).find('.upload-image').attr('data-id');
					send_data['jump_url']=$(element).find('input[name=jump_url]').val();

					if(!send_data['title'] || !send_data['description'] || !send_data['jump_url']){
						res = false;
						return;
					}
					send_datas.push(send_data);
				});
				if(res) {

					var data = {
						content: send_datas,
						keywords: $.trim($(form).find("input[name=keywords]").val()),
						id: $(form).find("input[name=id]").val(),
						type:$(form).find("input[name=type]").val()
					};

					$('.button-submit').loading('start');
					$.post($(form).attr('action'), data, function (response) {
						$('.button-submit').loading('stop');
						if (response.code == 1) {
							window.location = response.data.url;
						}
						else {
							spop({
								template: response.message,
								style: response.code == 1 ? 'success' : 'error',
								autoclose: 3000,
								position: 'bottom-right',
								icon: true,
								group: false,
							});
						}
					});
				}
				return false;
			}
		});

		//增加一条内容
		$('.add-content').on('click',function () {
			if(num<9){
				$(this).prev().append(res_panel);
				num++;
			}

		});

		//删除当前内容
		$('body').on('click','.res-close',function () {
			$(this).parents('.res-form').remove();
			num--;
		});
	});
</script>
</body>
</html>