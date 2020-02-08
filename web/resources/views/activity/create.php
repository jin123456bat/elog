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
<link rel="stylesheet" href="<?=assets::css('form.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('button.loading.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('panel.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('progress.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('datetimepicker.css')?>" type="text/css" media="all" />
</head>
<style>
.circleProgress_wrapper {
	display: inline-block;
}
</style>
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
							<p>添加活动</p>
						</div>
					</div>
					<div class="line"></div>
					<form class="form" id="form" method="post" action="<?=url('activity/create')?>">
						<div class="panel center-block">
							<div class="panel-head">
								<div class="panel-title">基础信息</div>
							</div>
							<div class="panel-body">
								<div class="form-group col-md-10">
									<label class="label col-md-2">活动LOGO图</label>
									<div class="col-md-7">
										<img class="upload_image" style="border: 1px solid #ccc; cursor: pointer; max-width: 100%;" src="<?=assets::common('plus.png', 'image')?>">
										<input type="hidden" name="upload_logo_id">
										<div class="circleProgress_wrapper display-none">
											<div class="wrapper right">
												<div class="circleProgress rightcircle"></div>
											</div>
											<font id="loading">100%</font>
											<div class="wrapper left">
												<div class="circleProgress leftcircle"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">活动详情页</label>
									<input type="text" class="input_text col-md-7" name="desc_url" value="">
									<span class="text-helper col-offset-2">活动详情页地址，点击LOGO图或者跳转链接的时候调转到该地址</span>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">活动名称</label>
									<input type="text" class="input_text col-md-7" name="name" value="">
									<span class="text-helper col-offset-2">活动名称</span>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">奖励触发点</label>
									<select class="select col-md-7" name="event">
										<option value="register_member">注册会员</option>
										<option value="subscribe_wechat">关注微信公众号</option>
									</select>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">奖励类型</label>
									<select class="select col-md-7" name="type">
										<option value="money">余额</option>
										<option value="score">积分</option>
										<option value="coupon">优惠券</option>
									</select>
								</div>
								<div class="form-group col-md-10 display-none money-content">
									<label class="label col-md-2">余额</label>
									<input type="text" class="input_text col-md-7" name="money_content" value="">
									<span class="text-helper col-offset-2">奖励多少余额</span>
								</div>
								<div class="form-group col-md-10 display-none score-content">
									<label class="label col-md-2">积分</label>
									<input type="text" class="input_text col-md-7" name="score_content" value="">
									<span class="text-helper col-offset-2">奖励多少积分，填写0为按照支付金额1:1发放积分，向上取整</span>
								</div>
								<div class="form-group col-md-10 display-none coupon-content">
									<label class="label col-md-2">优惠券</label>
									<?php if (!empty($coupon)){?>
									<select class="select col-md-6" name="coupon_content">
										<?php foreach ($coupon as $c){?>
										<option value="<?=$c['id']?>"><?=$c['name']?></option>
										<?php }?>
									</select>
									<button class="button col-md-1" id="create_coupon_btn">添加</button>
									<?php }else{?>
									<div class="col-md-7">
										没有找到优惠码，请先去
										<a href="<?=url('coupon/index')?>">添加优惠码</a>
									</div>
									<?php }?>
									<span class="text-helper col-offset-2">奖励哪种优惠券,用户会一次性领取可领取次数的优惠券</span>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">奖励次数</label>
									<input type="text" class="input_text col-md-7" name="active_num_per" placeholder="0不限制次数" value="">
									<span class="text-helper col-offset-2">每人可领取奖励的次数，0不限制，部分活动用户可能通过重复触发来多次领取奖励</span>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">有效期</label>
									<div style="display: inline; position: relative;">
										<input type="text" class="input_text col-md-3 datetimepicker" name="starttime" value="" placeholder="开始时间，不填写则不限制" autocomplete="off">
									</div>
									<div class="col-md-1" style="text-align: center; width: 7%;">~</div>
									<div style="display: inline; position: relative;">
										<input type="text" class="input_text col-md-3 datetimepicker" name="endtime" value="" placeholder="结束时间，不填写则不限制" autocomplete="off">
									</div>
									<span class="text-helper col-offset-2">活动有效期</span>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">有效</label>
									<div class="col-md-7 checkbox">
										<input type="checkbox" id="status" name="status" checked="checked" value="1">
										<label for="status">活动是否有效，勾选后活动才有效</label>
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
	<script type="text/javascript" src="<?=assets::js('datetimepicker.js')?>"></script>
	<script type="text/javascript" src="<?=assets::common('jquery.validate.min.js','js')?>"></script>
	<script type="text/javascript" src="<?=assets::common('messages_zh.min.js','js')?>"></script>
	<script>
$.ajaxSetup({
	headers: {
        '__token__': '<?=Request::token('__token__')?>' ,
    },
});
</script>
	<script type="text/html" id="tpl_coupon_select">
<select class="select col-md-6 valid" name="coupon_content" aria-invalid="false">
	<?php foreach ($coupon as $c){?>
	<option value="<?=$c['id']?>"><?=$c['name']?></option>
	<?php }?>
</select>
<button class="button col-md-1">删除</button>
</script>
	<script type="text/javascript">

$('#create_coupon_btn').on('click',function(){
	$('')
});

$('select[name=type]').on('change',function(){
	$('.money-content,.score-content,.coupon-content').addClass('display-none');
	$('.'+$(this).val()+'-content').removeClass('display-none');
}).trigger('change');

$('.upload_image').on('click',function(){
	var input = $('<input type="file">');
	input.on('change',function(){
		var file = $(this)[0].files[0];
		var formData = new FormData();
		formData.append('file',file);
		formData.append('type','activity');
		var xhr = new XMLHttpRequest();
		xhr.open('POST','<?=url('common/component/upload')?>',true);
		xhr.upload.onloadstart = function(){
			$('.circleProgress_wrapper').removeClass('display-none');
			$('.circleProgress_wrapper #loading').text('0%');
			$('.upload_image').addClass('display-none')
		}
		xhr.upload.onprogress = function(event){
			if (event.lengthComputable) {
				$('.circleProgress_wrapper #loading').text(Math.round(event.loaded / event.total * 100) + "%");
			}
		};
		xhr.onload = function(){
			$('.circleProgress_wrapper').addClass('display-none');
			$('.upload_image').removeClass('display-none')
			if(xhr.status == 200 && xhr.readyState == 4)
			{
				var response = xhr.response;
				response = $.parseJSON(response);
				$('.upload_image').attr('src',response.data.url);
				$('input[name=upload_logo_id]').val(response.data.id);
			}
		};
		xhr.send(formData);
	});
	input.trigger('click');
	return false;
});

$('.datetimepicker').each(function(){
	$(this).datetimepicker();
});

$('#form').validate({
	rules : {
		name : {
			required : true,
			maxlength : 32,
		},
		money_content : {
			number:true,
			min:0,
		},
		score_content:{
			digits:true,
			min:0,
		},
		active_num_per:{
			required:true,
			digits:true,
			min:0,
		}
	},
	errorPlacement : function(error, element) {
		error.css({
			color : '#f4516c',
			marginTop : '0.2rem',
			fontSize : '0.85rem',
			fontFamily : 'Poppins',
			lineHeight : '1.5',
			paddingLeft : '5px',
		});
		error.appendTo(element.parent());
	},
	focusInvalid : true,
	errorClass : 'error',
	success : function(error, element) {
		error.remove();
	},
	highlight : function(element, b, c) {
		$(element).css({
			borderColor : '#f4516c'
		});
	},
	submitHandler : function(form) {
		$(form).find('.button-submit').loading('start');
		$.post($(form).attr('action'),$(form).serialize(),function(response){
			$(form).find('.button-submit').loading('stop');
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
</script>
</body>
</html>