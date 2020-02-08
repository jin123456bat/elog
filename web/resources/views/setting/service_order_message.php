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
<link rel="stylesheet" href="<?=assets::css('panel.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('form.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('tab.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('toolbar.css')?>" type="text/css" media="all" />
<style>
.item-group {
	font-size: 16px;
	font-weight: bold;
}

.item {
	display: flex;
	flex-flow: row nowrap;
	padding: 5px 0px;
	justify-content: space-around;
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
					<div class="tab">
						<div class="tab-header">
							<a class="tab-title active" href="#user_template">用户模板消息</a>
							<a class="tab-title" href="#admin_template">管理模板消息</a>
							<!-- 
							<a class="tab-title" href="#message">短信消息</a>
							 -->
						</div>
						<div class="tab-body">
							<div class="tab-page active" id="user_template">
								<div class="line"></div>
								<div class="top-tips">
									<div class="top-tips-title">操作提示</div>
									<div class="top-tips-body">
										<p>消息提示是提供给用户的消息提醒</p>
										<p>模板消息需要去微信公众平台后台申请模板消息</p>
										<p>当订单状态发生变化的时候会给用户推送一条模板消息</p>
										<p>未绑定微信账号的用户不会推送模板消息</p>
										<p>未关注微信公众账号的用户不会推送模板消息</p>
									</div>
								</div>
								<div class="col-md-8">
									<form id="userTemplateForm" class="form" method="post" action="<?=url()?>">
										<div class="panel col-md-7 center-block">
											<div class="panel-head">
												<div class="panel-title">模板消息通知开关</div>
											</div>
											<div class="panel-body">
												<div class="form-group col-md-10">
													<label class="label col-md-2">开关</label>
													<input type="checkbox" id="user_template_message" <?=($service_order_user_message['template_message_open']??0)==1?'checked="checked"':''?>>
													<label for="user_template_message">勾选开启模板消息通知</label>
												</div>
											</div>
										</div>
										<div class="line"></div>
										<div class="panel col-md-7 center-block" id="service_order_response">
											<div class="panel-head">
												<div class="panel-title">
													服务订单响应&nbsp;&nbsp;&nbsp;
													<span class="text-helper">订单响应成功后推送给客户</span>
												</div>
											</div>
											<div class="panel-body">
												<div class="form-group col-md-10">
													<label class="label col-md-2">模板ID</label>
													<input type="text" class="input_text col-md-7" name="service_order_response" value="<?=$service_order_user_message['template_message']['service_order_response']['id']??''?>" placeholder="模板ID">
												</div>
												<?php if (isset($service_order_user_message['template_message']['service_order_response']['variable']) && !empty($service_order_user_message['template_message']['service_order_response']['variable'])){?>
												<?php foreach ($service_order_user_message['template_message']['service_order_response']['variable'] as $index => $variable){?>
												<div class="form-group col-md-10">
													<label class="label col-md-2">模板变量</label>
													<div class="col-md-8 variable">
														<input type="text" class="input_text col-md-4 key" value="<?=$variable['key']?>" placeholder="模板消息变量，不带.DATA">
														<input type="text" class="input_text col-md-4 value" value="<?=$variable['val']?>" placeholder="变量值">
														<?php if ($index == 0){?>
														<button class="button button-xs plus">添加</button>
														<?php }else{?>
														<button class="button button-xs minus">删除</button>
														<?php }?>
													</div>
												</div>
												<?php }?>
												<?php }else{?>
												<div class="form-group col-md-10">
													<label class="label col-md-2">模板变量</label>
													<div class="col-md-8 variable">
														<input type="text" class="input_text col-md-4 key" value="" placeholder="模板消息变量，不带.DATA">
														<input type="text" class="input_text col-md-4 value" value="" placeholder="变量值">
														<button class="button button-xs plus">添加</button>
													</div>
												</div>
												<?php }?>
											</div>
										</div>
										<div class="line"></div>
										<div class="panel col-md-7 center-block" id="service_order_finish">
											<div class="panel-head">
												<div class="panel-title">
													服务订单完结&nbsp;&nbsp;&nbsp;
													<span class="text-helper">订单完结后推送给客户</span>
												</div>
											</div>
											<div class="panel-body">
												<div class="form-group col-md-10">
													<label class="label col-md-2">模板ID</label>
													<input type="text" class="input_text col-md-7" name="service_order_finish" value="<?=$service_order_user_message['template_message']['service_order_finish']['id']??''?>" placeholder="模板ID">
												</div>
												<?php if (isset($service_order_user_message['template_message']['service_order_finish']['variable']) && !empty($service_order_user_message['template_message']['service_order_finish']['variable'])){?>
												<?php foreach ($service_order_user_message['template_message']['service_order_finish']['variable'] as $index => $variable){?>
												<div class="form-group col-md-10">
													<label class="label col-md-2">模板变量</label>
													<div class="col-md-8 variable">
														<input type="text" class="input_text col-md-4 key" value="<?=$variable['key']?>" placeholder="模板消息变量，不带.DATA">
														<input type="text" class="input_text col-md-4 value" value="<?=$variable['val']?>" placeholder="变量值">
														<?php if ($index == 0){?>
														<button class="button button-xs plus">添加</button>
														<?php }else{?>
														<button class="button button-xs minus">删除</button>
														<?php }?>
													</div>
												</div>
												<?php }?>
												<?php }else{?>
												<div class="form-group col-md-10">
													<label class="label col-md-2">模板变量</label>
													<div class="col-md-8 variable">
														<input type="text" class="input_text col-md-4 key" value="" placeholder="模板消息变量，不带.DATA">
														<input type="text" class="input_text col-md-4 value" value="" placeholder="变量值">
														<button class="button button-xs plus">添加</button>
													</div>
												</div>
												<?php }?>
											</div>
										</div>
										<div class="line"></div>
										<div class="panel col-md-7 center-block" id="service_order_quit">
											<div class="panel-head">
												<div class="panel-title">
													服务订单取消&nbsp;&nbsp;&nbsp;
													<span class="text-helper">订单不论以何种方式取消都会通知客户</span>
												</div>
											</div>
											<div class="panel-body">
												<div class="form-group col-md-10">
													<label class="label col-md-2">模板ID</label>
													<input type="text" class="input_text col-md-7" name="service_order_quit" value="<?=$service_order_user_message['template_message']['service_order_quit']['id']??''?>" placeholder="模板ID">
												</div>
												<?php if (isset($service_order_user_message['template_message']['service_order_quit']['variable']) && !empty($service_order_user_message['template_message']['service_order_quit']['variable'])){?>
												<?php foreach ($service_order_user_message['template_message']['service_order_quit']['variable'] as $index => $variable){?>
												<div class="form-group col-md-10">
													<label class="label col-md-2">模板变量</label>
													<div class="col-md-8 variable">
														<input type="text" class="input_text col-md-4 key" value="<?=$variable['key']?>" placeholder="模板消息变量，不带.DATA">
														<input type="text" class="input_text col-md-4 value" value="<?=$variable['val']?>" placeholder="变量值">
														<?php if ($index == 0){?>
														<button class="button button-xs plus">添加</button>
														<?php }else{?>
														<button class="button button-xs minus">删除</button>
														<?php }?>
													</div>
												</div>
												<?php }?>
												<?php }else{?>
												<div class="form-group col-md-10">
													<label class="label col-md-2">模板变量</label>
													<div class="col-md-8 variable">
														<input type="text" class="input_text col-md-4 key" value="" placeholder="模板消息变量，不带.DATA">
														<input type="text" class="input_text col-md-4 value" value="" placeholder="变量值">
														<button class="button button-xs plus">添加</button>
													</div>
												</div>
												<?php }?>
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
							<div class="tab-page" id="admin_template">
								<div class="line"></div>
								<div class="top-tips">
									<div class="top-tips-title">操作提示</div>
									<div class="top-tips-body">
										<p>管理模板消息是推送给管理员的模板消息</p>
										<p>当订单状态发送变化的时候会给管理员推送一条模板消息</p>
										<p>模板消息需要去微信公众平台后台申请模板消息</p>
										<p>未绑定微信账号的管理员不会推送模板消息</p>
										<p>未关注微信公众账号的用户不会推送模板消息</p>
									</div>
								</div>
								<div class="col-md-8">
									<form id="adminTemplateForm" class="form" method="post" action="<?=url()?>">
										<div class="panel col-md-7 center-block">
											<div class="panel-head">
												<div class="panel-title">模板消息通知开关</div>
											</div>
											<div class="panel-body">
												<div class="form-group col-md-10">
													<label class="label col-md-2">开关</label>
													<input type="checkbox" id="admin_template_message" <?=($service_order_admin_message['template_message_open']??0)==1?'checked="checked"':''?>>
													<label for="template_message">勾选开启模板消息通知</label>
												</div>
											</div>
										</div>
										<div class="line"></div>
										<div class="panel col-md-7 center-block" id="service_order_response">
											<div class="panel-head">
												<div class="panel-title">
													服务订单待响应通知&nbsp;&nbsp;&nbsp;
													<span class="text-helper">当订单需要被响应的时候给管理员的通知</span>
												</div>
											</div>
											<div class="panel-body">
												<div class="form-group col-md-10">
													<label class="label col-md-2">模板ID</label>
													<input type="text" class="input_text col-md-7" name="service_order_response" value="<?=$service_order_admin_message['template_message']['service_order_response']['id']??''?>" placeholder="模板ID">
												</div>
												<?php if (isset($service_order_admin_message['template_message']['service_order_response']['variable']) && !empty($service_order_admin_message['template_message']['service_order_response']['variable'])){?>
												<?php foreach ($service_order_admin_message['template_message']['service_order_response']['variable'] as $index => $variable){?>
												<div class="form-group col-md-10">
													<label class="label col-md-2">模板变量</label>
													<div class="col-md-8 variable">
														<input type="text" class="input_text col-md-4 key" value="<?=$variable['key']?>" placeholder="模板消息变量，不带.DATA">
														<input type="text" class="input_text col-md-4 value" value="<?=$variable['val']?>" placeholder="变量值">
														<?php if ($index == 0){?>
														<button class="button button-xs plus">添加</button>
														<?php }else{?>
														<button class="button button-xs minus">删除</button>
														<?php }?>
													</div>
												</div>
												<?php }?>
												<?php }else{?>
												<div class="form-group col-md-10">
													<label class="label col-md-2">模板变量</label>
													<div class="col-md-8 variable">
														<input type="text" class="input_text col-md-4 key" value="" placeholder="模板消息变量，不带.DATA">
														<input type="text" class="input_text col-md-4 value" value="" placeholder="变量值">
														<button class="button button-xs plus">添加</button>
													</div>
												</div>
												<?php }?>
											</div>
										</div>
										<div class="line"></div>
										<div class="panel col-md-7 center-block" id="service_order_quit">
											<div class="panel-head">
												<div class="panel-title">
													服务订单申请取消&nbsp;&nbsp;&nbsp;
													<span class="text-helper">订单发起取消申请的时候，给管理员的通知</span>
												</div>
											</div>
											<div class="panel-body">
												<div class="form-group col-md-10">
													<label class="label col-md-2">模板ID</label>
													<input type="text" class="input_text col-md-7" name="service_order_quit" value="<?=$service_order_admin_message['template_message']['service_order_quit']['id']??''?>" placeholder="模板ID">
												</div>
												<?php if (isset($service_order_admin_message['template_message']['service_order_quit']['variable']) && !empty($service_order_admin_message['template_message']['service_order_quit']['variable'])){?>
												<?php foreach ($service_order_admin_message['template_message']['service_order_quit']['variable'] as $index => $variable){?>
												<div class="form-group col-md-10">
													<label class="label col-md-2">模板变量</label>
													<div class="col-md-8 variable">
														<input type="text" class="input_text col-md-4 key" value="<?=$variable['key']?>" placeholder="模板消息变量，不带.DATA">
														<input type="text" class="input_text col-md-4 value" value="<?=$variable['val']?>" placeholder="变量值">
														<?php if ($index == 0){?>
														<button class="button button-xs plus">添加</button>
														<?php }else{?>
														<button class="button button-xs minus">删除</button>
														<?php }?>
													</div>
												</div>
												<?php }?>
												<?php }else{?>
												<div class="form-group col-md-10">
													<label class="label col-md-2">模板变量</label>
													<div class="col-md-8 variable">
														<input type="text" class="input_text col-md-4 key" value="" placeholder="模板消息变量，不带.DATA">
														<input type="text" class="input_text col-md-4 value" value="" placeholder="变量值">
														<button class="button button-xs plus">添加</button>
													</div>
												</div>
												<?php }?>
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
							<div class="tab-page" id="message"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	{include file='common/footer' /}
	<div class="toolbar">
		<div class="toolbar-pull">
			<div class="toolbar-button" onClick="$(this).parents('.toolbar').toggleClass('active');">预置系统变量信息</div>
		</div>
		<div class="toolbar-body">
			<div class="item-group">预置系统变量信息</div>
			<div class="item">
				<div class="key">{usernick}</div>
				<div class="value">用户昵称</div>
			</div>
			<div class="item">
				<div class="key">{telephone}</div>
				<div class="value">用户手机号</div>
			</div>
			<div class="item">
				<div class="key">{orderno}</div>
				<div class="value">订单号</div>
			</div>
			<div class="item">
				<div class="key">{pos_name}</div>
				<div class="value">服务位置(客房/餐厅名)</div>
			</div>
			<div class="item">
				<div class="key">{position_name}</div>
				<div class="value">服务位置(座位号/房间号)</div>
			</div>
			<div class="item">
				<div class="key">{service_name}</div>
				<div class="value">服务名称</div>
			</div>
			<div class="item">
				<div class="key">{content_string}</div>
				<div class="value">服务内容</div>
			</div>
			<div class="item">
				<div class="key">{response_content}</div>
				<div class="value">响应内容</div>
			</div>
			<div class="item">
				<div class="key">{remark}</div>
				<div class="value">订单备注</div>
			</div>
			<div class="item">
				<div class="key">{order_price}</div>
				<div class="value">服务订单金额</div>
			</div>
			<div class="item">
				<div class="key">{cancel_reason}</div>
				<div class="value">取消原因</div>
			</div>
			<div class="item">
				<div class="key">{refuse_reason}</div>
				<div class="value">拒绝取消原因</div>
			</div>
			<div class="item">
				<div class="key">{createtime}</div>
				<div class="value">订单创建时间</div>
			</div>
			<div class="item">
				<div class="key">{now}</div>
				<div class="value">消息推送时间</div>
			</div>
			<div class="item">
				<div class="key">{response_content}</div>
				<div class="value">响应消息</div>
			</div>
		</div>
	</div>
	<!-- 通用js -->
	<script type="text/javascript" src="<?=assets::common('jquery.min.js','js')?>"></script>
	<!-- 全局js调用 -->
	<script type="text/javascript" src="<?=assets::js('global.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('spop.min.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('tab.js')?>"></script>
	<!-- 当前页面使用插件的js -->
	<script type="text/javascript" src="<?=assets::js('button.loading.js')?>"></script>
	<script type="text/javascript" src="<?=assets::common('jquery.validate.min.js','js')?>"></script>
	<script type="text/javascript" src="<?=assets::common('messages_zh.min.js','js')?>"></script>
	<script type="text/html" id="tpl_template_var">
	<div class="form-group col-md-10">
		<label class="label col-md-2">模板变量</label>
		<div class="col-md-8 variable">
			<input type="text" class="input_text col-md-4 key" placeholder="模板消息变量，不带.DATA">
			<input type="text" class="input_text col-md-4 value" placeholder="变量值">
			<button class="button button-xs minus">删除</button>
		</div>
	</div>
	</script>
	<script>
	$.ajaxSetup({
		headers: {
	        '__token__': '<?=Request::token('__token__')?>' ,
	    },
	});
	</script>
	<script type="text/javascript">
	$(function(){
		tab.init();
		
		$('.tab').on('click','.plus',function(){
			var tpl = $($('#tpl_template_var').html());
			tpl.insertAfter($(this).parents('.form-group'));
			return false;
		}).on('click','.minus',function(){
			$(this).parents('.form-group').remove();
			return false;
		});

		$('#adminTemplateForm').validate({
			rules : {
			},
			message:{
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
			errorClass : 'col-offset-2 error',
			success : function(error, element) {
				error.remove();
			},
			highlight : function(element, b, c) {
				$(element).css({
					borderColor : '#f4516c'
				});
			},
			submitHandler : function(form) {
				var message = {
					template_message_open:$('#admin_template_message:checked').length,//模板消息开关
					//模板消息内容
					template_message:{
						//接单
						service_order_response:{
							id:$.trim($(form).find('input[name=service_order_response]').val()),//消息ID
							variable:[]
						},
						//取消申请
						service_order_quit:{
							id:$.trim($(form).find('input[name=service_order_quit]').val()),//消息ID
							variable:[]
						},
					}
				};

				$(form).find('#service_order_response .variable').each(function(index,value){
					var key = $.trim($(value).find('input.key').val());
					if(key.length>0)
					{
						var val = $.trim($(value).find('input.value').val());
						message.template_message.service_order_response.variable.push({
							key:key,
							val:val,
						});
					}
				});

				$(form).find('#service_order_quit .variable').each(function(index,value){
					var key = $.trim($(value).find('input.key').val());
					if(key.length>0)
					{
						var val = $.trim($(value).find('input.value').val());
						message.template_message.service_order_quit.variable.push({
							key:key,
							val:val,
						});
					}
				});

				$.post($(form).attr('action'),{service_order_admin_message:JSON.stringify(message)},function(response){
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
			}
		});
		
		$('#userTemplateForm').validate({
			rules : {
			},
			message:{
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
			errorClass : 'col-offset-2 error',
			success : function(error, element) {
				error.remove();
			},
			highlight : function(element, b, c) {
				$(element).css({
					borderColor : '#f4516c'
				});
			},
			submitHandler : function(form) {
				var message = {
					template_message_open:$('#user_template_message:checked').length,//模板消息开关
					//模板消息内容
					template_message:{
						//服务订单响应
						service_order_response:{
							id:$.trim($(form).find('input[name=service_order_response]').val()),//消息ID
							variable:[]
						},
						//服务订单完成
						service_order_finish:{
							id:$.trim($(form).find('input[name=service_order_finish]').val()),//消息ID
							variable:[]
						},
						//服务订单取消
						service_order_quit:{
							id:$.trim($(form).find('input[name=service_order_quit]').val()),//消息ID
							variable:[]
						},
					},
				};

				$(form).find('#service_order_response .variable').each(function(index,value){
					var key = $.trim($(value).find('input.key').val());
					if(key.length>0)
					{
						var val = $.trim($(value).find('input.value').val());
						message.template_message.service_order_response.variable.push({
							key:key,
							val:val,
						});
					}
				});

				$(form).find('#service_order_finish .variable').each(function(index,value){
					var key = $.trim($(value).find('input.key').val());
					if(key.length>0)
					{
						var val = $.trim($(value).find('input.value').val());
						message.template_message.service_order_finish.variable.push({
							key:key,
							val:val,
						});
					}
				});

				$(form).find('#service_order_quit .variable').each(function(index,value){
					var key = $.trim($(value).find('input.key').val());
					if(key.length>0)
					{
						var val = $.trim($(value).find('input.value').val());
						message.template_message.service_order_quit.variable.push({
							key:key,
							val:val,
						});
					}
				});

				
				$.post($(form).attr('action'),{service_order_user_message:JSON.stringify(message)},function(response){
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
			}
		});
	});
</script>
</body>
</html>