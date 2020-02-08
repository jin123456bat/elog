<?php
use jin123456bat\assets;
use think\facade\Request;
use jin123456bat\helper;
use app\company\companyHelper;
use app\hotel\hotelHelper;
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
<link rel="stylesheet" href="<?=assets::css('admin/create.css')?>" type="text/css" media="all" />
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
							<p>超级管理员拥有全部权限，即使没有配置角色</p>
							<p>一个管理员可以拥有多个角色</p>
							<p>
								权限分配给角色，管理员的权限通过角色来判断，可以进入
								<a href="<?=url('role/index')?>">角色管理</a>
								来配置角色的权限
							</p>
						</div>
					</div>
					<div class="line"></div>
					<form class="form" id="form" method="post" action="<?=url('admin/create')?>">
						<div class="panel col-md-7 center-block">
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
						<div class="panel col-md-7 center-block">
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
										<?php if (!empty($role)){?>
	  									<?php foreach ($role as $r){?>
	  									<div class="col-md-2 ">
											<label class="checkbox-for center-block text-inline" title="<?=$r['note']?>">
												<input name="role[]" type="checkbox" value="<?=$r['id']?>">  <?=$r['name']?>
											</label>
										</div>
										<?php }?>
										<?php }else{?>
										没有任何角色，请先<a href="<?=url('role/create')?>">添加角色</a>
										<?php }?>
	  								</div>
								</div>
							</div>
						</div>
						<?php if (helper::isCompanyMp(companyHelper::getCompanyId())){?>
						<div class="line"></div>
						<div class="panel col-md-7 center-block">
							<div class="panel-head">
								<div class="panel-title">绑定微信号</div>
							</div>
							<div class="panel-body">
								<div class="form-group col-md-10">
									<label class="label col-md-2">绑定微信</label>
									<div class="qrcode col-md-3" style="width: 100px;">
										<img class="gravatar" src="<?=$admin_qrcode?>" style="width: 100px;">
										<div class="nickname" style="text-align: center; font-size: 12px;">微信扫描二维码</div>
										<input type="hidden" name="wechat_info" value="">
										<button data-image="<?=$admin_qrcode?>" class="button button-xs col-md-10 wechat_bind_delete display-none" style="margin: 5px 0px;">解除绑定</button>
									</div>
								</div>
							</div>
						</div>
						<?php }?>
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
<script type="text/javascript" src="<?=assets::common('socket.io.js','js')?>"></script>
<script type="text/javascript" src="<?=assets::js('websocket.js')?>"></script>
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
	<?php if (helper::isCompanyMp(hotelHelper::getCompanyId())){?>
    websocket.join('<?=hotelHelper::getCompanyId();?>','company_admin_bind_wechat',{
		qrcode_id:'<?=$admin_qrcode_id?>'
	});
    websocket.on('user_qrcode_info',function(response){
        if(response.subscribe == 0)
		{
			$('.qrcode .gravatar').remove();
			$('.qrcode .nickname').html('成功绑定微信');
		}
		else
		{
			$('.qrcode .gravatar').attr('src',response.headimgurl);
			$('.qrcode .nickname').html(response.nickname);
		}
		$('input[name=wechat_info]').val(JSON.stringify(response));
		$('.wechat_bind_delete').removeClass('display-none');
    });

	$('.wechat_bind_delete').on('click',function(){
		$('input[name=wechat_info]').val('');
		$('.nickname').html('微信扫描二维码');
		$('.gravatar').attr('src',$(this).data('image'));
		$(this).addClass('display-none');
		return false;
	});
	<?php }?>

	//中文
	jQuery.validator.addMethod("chs", function(value, element) {
		var tel = /^[\u4E00-\u9FA5]{1,6}$/;
		return this.optional(element) || (tel.test(value));
	}, "请输入正确的中文名称");

	// 手机号
	jQuery.validator.addMethod("mobile", function(value, element) {
		var tel = /^1[34578]\d{9}$/;
		return this.optional(element) || (tel.test(value));
	}, "请填写正确的手机号码");

	// 角色
	jQuery.validator.addMethod("role", function(value, element, a) {
		if (value == 0) {
			return $('#role_selector input[type=checkbox]:checked').length != 0;
		}
		return true;
	}, "请为管理员分配角色");

	$('#form').validate({
		rules : {
			username : {
				required : true,
				maxlength : 32,
			},
			realname : {
				required : true,
				chs : true,
			},
			email : {
				required : true,
				email : true,
			},
			mobile : {
				required : true,
				mobile : true,
			},
			password : {
				required : true,
			},
			issupper : {
				role : true,
			}
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
				$(element).parents('.panel').find(
						'.panel-title label').remove();
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
			var role = [];
			$('#role_selector input[type=checkbox]:checked').each(function(index,value){
				role.push($(value).val());
			});
			var data = {
				username:$.trim($(form).find('input[name=username]').val()),
				realname:$.trim($(form).find('input[name=realname]').val()),
				email:$.trim($(form).find('input[name=email]').val()),
				mobile:$.trim($(form).find('input[name=mobile]').val()),
				password:$.md5($.trim($(form).find('input[name=password]').val())),
				islock:$(form).find('select[name=islock]').val(),
				issupper:$(form).find('select[name=issupper]').val(),
				islock:$(form).find('select[name=islock]').val(),
				role:role,
				wechat_info:$(form).find('input[name=wechat_info]').val(),
			};
			$(form).find('.button-submit').loading('start');
			$.post($(form).attr('action'),data,function(response){
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

	$('select[name=issupper]').on('change', function() {
		if ($(this).val() == 1) {
			$('#role_selector').hide();
		} else {
			$('#role_selector').show();
		}
	});
});
</script>
</body>
</html>