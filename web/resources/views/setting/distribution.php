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
<link rel="stylesheet" href="<?=assets::css('toolbar.css')?>" type="text/css" media="all" />
<!-- 
<link rel="stylesheet" href="<?=assets::css('datatables.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('jquery.modal.css')?>" type="text/css" media="all" />
-->
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
					<div class="top-tips">
						<div class="top-tips-title">操作提示</div>
						<div class="top-tips-body">
							<p>分销模块系统配置</p>
							<p>用户离店后佣金才会发放，发放到账户佣金余额内</p>
						</div>
					</div>
					<div class="line"></div>
					<form id="settingForm" class="form" method="post" action="<?=url()?>">
						<div class="panel col-md-7 center-block">
							<div class="panel-head">
								<div class="panel-title">分销配置</div>
							</div>
							<div class="panel-body">
								<div class="form-group col-md-10">
									<label class="label col-md-2">分销开关</label>
									<input type="checkbox" name="distribution_open" id="distribution_open" value="1" <?=($setting['distribution_open']??0)==1?'checked="checked"':''?>>
									<label for="distribution_open">勾选开启分销系统</label>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">二维码类型</label>
									<select class="select col-md-7" name="distribution_qrcode_type">
										<option value="migee" <?=($setting['distribution_qrcode_type']??'migee')=='migee'?'selected="selected"':''?>>觅集自定义二维码</option>
										<option value="wechat_temp" <?=($setting['distribution_qrcode_type']??'migee')=='wechat_temp'?'selected="selected"':''?>>微信临时二维码</option>
										<option value="wechat_forver" <?=($setting['distribution_qrcode_type']??'migee')=='wechat_forver'?'selected="selected"':''?>>微信永久二维码</option>
									</select>
									<div class="col-offset-2 text-helper">觅集自定义二维码数量不限制，时间不限制，无法引导微信关注</div>
									<div class="col-offset-2 text-helper">微信临时二维码数量不限制，时间30天，可以引导微信关注</div>
									<div class="col-offset-2 text-helper">微信永久二维码数量10W，时间不限制，可以引导微信关注，不推荐</div>
								</div>
							</div>
						</div>
						<?php 
							$distribution_money_level = json_decode($setting['distribution_money_level']??'{"room_order":"order_money","service_order":"order_money","shop_order":"order_money"}',true);
							$distribution_s1_rate = json_decode($setting['distribution_s1_rate']??'{"room_order":"","service_order":"","shop_order":""}',true);
							$distribution_s2_rate = json_decode($setting['distribution_s2_rate']??'{"room_order":"","service_order":"","shop_order":""}',true);
							$distribution_s3_rate = json_decode($setting['distribution_s3_rate']??'{"room_order":"","service_order":"","shop_order":""}',true);
						?>
						<div class="panel col-md-7 center-block room_order">
							<div class="panel-head">
								<div class="panel-title">住房订单配置</div>
							</div>
							<div class="panel-body">
								
								<div class="form-group col-md-10">
									<label class="label col-md-2">分销金额</label>
									<select class="select col-md-7" name="distribution_money_level">
										<option value="order_money" <?=($distribution_money_level['room_order']??'order_money')=='order_money'?'selected="selected"':''?>>订单金额</option>
										<option value="pay_money" <?=($distribution_money_level['room_order']??'order_money')=='pay_money'?'selected="selected"':''?>>支付金额</option>
									</select>
									<div class="col-offset-2 text-helper">订单金额=优惠券金额+在线支付金额+余额支付金额</div>
									<div class="col-offset-2 text-helper">支付金额=在线支付金额+余额支付金额</div>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">一级佣金</label>
									<input type="text" class="input_text col-md-7" name="distribution_s1_rate" value="<?=$distribution_s1_rate['room_order']??''?>" placeholder="一级佣金">
									<div class="col-offset-2 text-helper">5%请填写0.05，0则不分配佣金</div>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">二级佣金</label>
									<input type="text" class="input_text col-md-7" name="distribution_s2_rate" value="<?=$distribution_s2_rate['room_order']??''?>" placeholder="二级佣金">
									<div class="col-offset-2 text-helper">5%请填写0.05，0则不分配佣金</div>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">三级佣金</label>
									<input type="text" class="input_text col-md-7" name="distribution_s3_rate" value="<?=$distribution_s3_rate['room_order']??''?>" placeholder="一级佣金">
									<div class="col-offset-2 text-helper">5%请填写0.05，0则不分配佣金</div>
								</div>
							</div>
						</div>
						
						<div class="panel col-md-7 center-block service_order">
							<div class="panel-head">
								<div class="panel-title">服务订单配置</div>
							</div>
							<div class="panel-body">
								<div class="form-group col-md-10">
									<label class="label col-md-2">分销金额</label>
									<select class="select col-md-7" name="distribution_money_level">
										<option value="order_money" <?=($distribution_money_level['service_order']??'order_money')=='order_money'?'selected="selected"':''?>>订单金额</option>
										<option value="pay_money" <?=($distribution_money_level['service_order']??'order_money')=='pay_money'?'selected="selected"':''?>>支付金额</option>
									</select>
									<div class="col-offset-2 text-helper">订单金额=优惠券金额+在线支付金额+余额支付金额</div>
									<div class="col-offset-2 text-helper">支付金额=在线支付金额+余额支付金额</div>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">一级佣金</label>
									<input type="text" class="input_text col-md-7" name="distribution_s1_rate" value="<?=$distribution_s1_rate['service_order']??''?>" placeholder="一级佣金">
									<div class="col-offset-2 text-helper">5%请填写0.05，0则不分配佣金</div>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">二级佣金</label>
									<input type="text" class="input_text col-md-7" name="distribution_s2_rate" value="<?=$distribution_s2_rate['service_order']??''?>" placeholder="二级佣金">
									<div class="col-offset-2 text-helper">5%请填写0.05，0则不分配佣金</div>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">三级佣金</label>
									<input type="text" class="input_text col-md-7" name="distribution_s3_rate" value="<?=$distribution_s3_rate['service_order']??''?>" placeholder="一级佣金">
									<div class="col-offset-2 text-helper">5%请填写0.05，0则不分配佣金</div>
								</div>
							</div>
						</div>
						
						<div class="panel col-md-7 center-block shop_order">
							<div class="panel-head">
								<div class="panel-title">商城订单配置</div>
							</div>
							<div class="panel-body">
								<div class="form-group col-md-10">
									<label class="label col-md-2">分销金额</label>
									<select class="select col-md-7" name="distribution_money_level">
										<option value="order_money" <?=($distribution_money_level['shop_order']??'order_money')=='order_money'?'selected="selected"':''?>>订单金额</option>
										<option value="pay_money" <?=($distribution_money_level['shop_order']??'order_money')=='pay_money'?'selected="selected"':''?>>支付金额</option>
									</select>
									<div class="col-offset-2 text-helper">订单金额=优惠券金额+在线支付金额+余额支付金额</div>
									<div class="col-offset-2 text-helper">支付金额=在线支付金额+余额支付金额</div>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">一级佣金</label>
									<input type="text" class="input_text col-md-7" name="distribution_s1_rate" value="<?=$distribution_s1_rate['shop_order']??''?>" placeholder="一级佣金">
									<div class="col-offset-2 text-helper">5%请填写0.05，0则不分配佣金</div>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">二级佣金</label>
									<input type="text" class="input_text col-md-7" name="distribution_s2_rate" value="<?=$distribution_s2_rate['shop_order']??''?>" placeholder="二级佣金">
									<div class="col-offset-2 text-helper">5%请填写0.05，0则不分配佣金</div>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">三级佣金</label>
									<input type="text" class="input_text col-md-7" name="distribution_s3_rate" value="<?=$distribution_s3_rate['shop_order']??''?>" placeholder="一级佣金">
									<div class="col-offset-2 text-helper">5%请填写0.05，0则不分配佣金</div>
								</div>
							</div>
						</div>
						
						<div class="panel col-md-7 center-block">
							<div class="panel-head">
								<div class="panel-title">一级营销人员增加提示</div>
							</div>
							<div class="panel-body" id="message_user_1">
								<?php
								$message_user_1 = json_decode($setting['distribution_message_user_1'] ?? '', true);
								?>
								<div class="form-group col-md-10">
									<label class="label col-md-2">模板ID</label>
									<input type="text" class="input_text col-md-7" name="template_id" value="<?=$message_user_1['template_id']?>">
								</div>
								<?php if (!empty($message_user_1['config'])){?>
								<?php foreach ($message_user_1['config'] as $index => $config){?>
								<div class="form-group col-md-10">
									<label class="label col-md-2">模板变量</label>
									<div class="col-md-7 variable">
										<input type="text" class="input_text col-md-4 key" value="<?=$config['key']?>" placeholder="模板消息变量，不带.DATA">
										<input type="text" class="input_text col-md-4 value" value="<?=$config['value']?>" placeholder="变量值">
										<button class="button <?=$index==0?'plus':'minus'?>"><?=$index==0?'添加':'删除'?></button>
									</div>
								</div>
								<?php }?>
								<?php }else{?>
								<div class="form-group col-md-10">
									<label class="label col-md-2">模板变量</label>
									<div class="col-md-7 variable">
										<input type="text" class="input_text col-md-4 key" value="" placeholder="模板消息变量，不带.DATA">
										<input type="text" class="input_text col-md-4 value" value="" placeholder="变量值">
										<button class="button plus">添加</button>
									</div>
								</div>
								<?php }?>
							</div>
						</div>
						<div class="panel col-md-7 center-block">
							<div class="panel-head">
								<div class="panel-title">二级营销人员增加提示</div>
							</div>
							<div class="panel-body" id="message_user_2">
								<?php
								$message_user_2 = json_decode($setting['distribution_message_user_2'] ?? '', true);
								?>
								<div class="form-group col-md-10">
									<label class="label col-md-2">模板ID</label>
									<input type="text" class="input_text col-md-7" name="template_id" value="<?=$message_user_2['template_id']?>">
								</div>
								<?php if (!empty($message_user_2['config'])){?>
								<?php foreach ($message_user_2['config'] as $index => $config){?>
								<div class="form-group col-md-10">
									<label class="label col-md-2">模板变量</label>
									<div class="col-md-7 variable">
										<input type="text" class="input_text col-md-4 key" value="<?=$config['key']?>" placeholder="模板消息变量，不带.DATA">
										<input type="text" class="input_text col-md-4 value" value="<?=$config['value']?>" placeholder="变量值">
										<button class="button <?=$index==0?'plus':'minus'?>"><?=$index==0?'添加':'删除'?></button>
									</div>
								</div>
								<?php }?>
								<?php }else{?>
								<div class="form-group col-md-10">
									<label class="label col-md-2">模板变量</label>
									<div class="col-md-7 variable">
										<input type="text" class="input_text col-md-4 key" value="" placeholder="模板消息变量，不带.DATA">
										<input type="text" class="input_text col-md-4 value" value="" placeholder="变量值">
										<button class="button plus">添加</button>
									</div>
								</div>
								<?php }?>
							</div>
						</div>
						<div class="panel col-md-7 center-block">
							<div class="panel-head">
								<div class="panel-title">三级营销人员增加提示</div>
							</div>
							<div class="panel-body" id="message_user_3">
								<?php
								$message_user_3 = json_decode($setting['distribution_message_user_3'] ?? '', true);
								?>
								<div class="form-group col-md-10">
									<label class="label col-md-2">模板ID</label>
									<input type="text" class="input_text col-md-7" name="template_id" value="<?=$message_user_3['template_id']?>">
								</div>
								<?php if (!empty($message_user_3['config'])){?>
								<?php foreach ($message_user_3['config'] as $index => $config){?>
								<div class="form-group col-md-10">
									<label class="label col-md-2">模板变量</label>
									<div class="col-md-7 variable">
										<input type="text" class="input_text col-md-4 key" value="<?=$config['key']?>" placeholder="模板消息变量，不带.DATA">
										<input type="text" class="input_text col-md-4 value" value="<?=$config['value']?>" placeholder="变量值">
										<button class="button <?=$index==0?'plus':'minus'?>"><?=$index==0?'添加':'删除'?></button>
									</div>
								</div>
								<?php }?>
								<?php }else{?>
								<div class="form-group col-md-10">
									<label class="label col-md-2">模板变量</label>
									<div class="col-md-7 variable">
										<input type="text" class="input_text col-md-4 key" value="" placeholder="模板消息变量，不带.DATA">
										<input type="text" class="input_text col-md-4 value" value="" placeholder="变量值">
										<button class="button plus">添加</button>
									</div>
								</div>
								<?php }?>
							</div>
						</div>
						<div class="panel col-md-7 center-block">
							<div class="panel-head">
								<div class="panel-title">佣金获取消息提示</div>
							</div>
							<div class="panel-body" id="message_money">
								<?php
								$message_money = json_decode($setting['distribution_message_money'] ?? '', true);
								?>
								<div class="form-group col-md-10">
									<label class="label col-md-2">模板ID</label>
									<input type="text" class="input_text col-md-7" name="template_id" value="<?=$message_money['template_id']?>">
								</div>
								<?php if (!empty($message_money['config'])){?>
								<?php foreach ($message_money['config'] as $index => $config){?>
								<div class="form-group col-md-10">
									<label class="label col-md-2">模板变量</label>
									<div class="col-md-7 variable">
										<input type="text" class="input_text col-md-4 key" value="<?=$config['key']?>" placeholder="模板消息变量，不带.DATA">
										<input type="text" class="input_text col-md-4 value" value="<?=$config['value']?>" placeholder="变量值">
										<button class="button <?=$index==0?'plus':'minus'?>"><?=$index==0?'添加':'删除'?></button>
									</div>
								</div>
								<?php }?>
								<?php }else{?>
								<div class="form-group col-md-10">
									<label class="label col-md-2">模板变量</label>
									<div class="col-md-7 variable">
										<input type="text" class="input_text col-md-4 key" value="" placeholder="模板消息变量，不带.DATA">
										<input type="text" class="input_text col-md-4 value" value="" placeholder="变量值">
										<button class="button plus">添加</button>
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
		</div>
	</div>
	{include file='common/footer' /}
	<div class="toolbar">
		<div class="toolbar-pull">
			<div class="toolbar-button" onClick="$(this).parents('.toolbar').toggleClass('active');">预置系统变量信息</div>
		</div>
		<div class="toolbar-body">
			<div class="item-group">营销人员增加提示</div>
			<div class="item">
				<div class="key">{u_user_nickname}</div>
				<div class="value">上级用户昵称</div>
			</div>
			<div class="item">
				<div class="key">{s_user_nickname}</div>
				<div class="value">下级用户昵称</div>
			</div>
			<div class="item">
				<div class="key">{level}</div>
				<div class="value">分销等级</div>
			</div>
			<div class="item">
				<div class="key">{rate}</div>
				<div class="value">佣金比例</div>
			</div>
			<div class="item">
				<div class="key">{now}</div>
				<div class="value">发送时间</div>
			</div>
			<div class="item-group">佣金获取消息提示</div>
			<div class="item">
				<div class="key">{orderno}</div>
				<div class="value">订单号</div>
			</div>
			<div class="item">
				<div class="key">{actual_price}</div>
				<div class="value">订单金额</div>
			</div>
			<div class="item">
				<div class="key">{order_user_nickname}</div>
				<div class="value">订单创建人的昵称</div>
			</div>
			<div class="item">
				<div class="key">{level}</div>
				<div class="value">分销等级</div>
			</div>
			<div class="item">
				<div class="key">{rate}</div>
				<div class="value">佣金比例</div>
			</div>
			<div class="item">
				<div class="key">{now}</div>
				<div class="value">发送时间</div>
			</div>
			<div class="item">
				<div class="key">{money}</div>
				<div class="value">佣金金额</div>
			</div>
		</div>
	</div>
	<!-- 通用js -->
	<script type="text/javascript" src="<?=assets::common('jquery.min.js','js')?>"></script>
	<!-- 全局js调用 -->
	<script type="text/javascript" src="<?=assets::js('global.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('spop.min.js')?>"></script>
	<!-- 当前页面使用插件的js -->
	<script type="text/javascript" src="<?=assets::js('button.loading.js')?>"></script>
	<script type="text/javascript" src="<?=assets::common('jquery.validate.min.js','js')?>"></script>
	<script type="text/javascript" src="<?=assets::common('messages_zh.min.js','js')?>"></script>
	<script type="text/html" id="tpl_template_var">
	<div class="form-group col-md-10">
		<label class="label col-md-2">模板变量</label>
		<div class="col-md-7 variable">
			<input type="text" class="input_text col-md-4 key" placeholder="模板消息变量，不带.DATA">
			<input type="text" class="input_text col-md-4 value" placeholder="变量值">
			<button class="button minus">删除</button>
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
		$('#settingForm').on('click','.plus',function(){
			var tpl = $($('#tpl_template_var').html());
			tpl.insertAfter($(this).parents('.form-group'));
			return false;
		}).on('click','.minus',function(){
			$(this).parents('.form-group').remove();
			return false;
		});
		
		$('#settingForm').validate({
			rules : {
				distribution_s1_rate : {
					number : true,
					range:[0,1],
				},
				distribution_s2_rate : {
					number : true,
					range:[0,1],
				},
				distribution_s3_rate : {
					number : true,
					range:[0,1],
				},
			},
			message:{
				distribution_s1_rate:{
					number:'佣金比例只能是数字',
					range:'佣金比例应该是大于等于0或小于1的数字'
				},
				distribution_s2_rate:{
					number:'佣金比例只能是数字',
					range:'佣金比例应该是大于等于0或小于1的数字'
				},
				distribution_s3_rate:{
					number:'佣金比例只能是数字',
					range:'佣金比例应该是大于等于0或小于1的数字'
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
				var message_user_1 = {
					template_id:$('#message_user_1 input[name=template_id]').val(),
					config:[],
				};
				$('#message_user_1 .variable').each(function(){
					message_user_1.config.push({key:$(this).find('input.key').val(),value:$(this).find('input.value').val()});
				});

				var message_user_2 = {
					template_id:$('#message_user_2 input[name=template_id]').val(),
					config:[],
				};
				$('#message_user_2 .variable').each(function(){
					message_user_2.config.push({key:$(this).find('input.key').val(),value:$(this).find('input.value').val()});
				});


				var message_user_3 = {
					template_id:$('#message_user_3 input[name=template_id]').val(),
					config:[],
				};
				$('#message_user_3 .variable').each(function(){
					message_user_3.config.push({key:$(this).find('input.key').val(),value:$(this).find('input.value').val()});
				});

				var message_money = {
					template_id:$('#message_money input[name=template_id]').val(),
					config:[],
				};
				$('#message_money .variable').each(function(){
					message_money.config.push({key:$(this).find('input.key').val(),value:$(this).find('input.value').val()});
				});
				
				var data = {
					distribution_open:$(form).find('input[name=distribution_open]:checked').length,
					distribution_qrcode_type:$(form).find('select[name=distribution_qrcode_type]').val(),

					distribution_money_level:{
						room_order:$(form).find('.room_order select[name=distribution_money_level]').val(),
						service_order:$(form).find('.service_order select[name=distribution_money_level]').val(),
						shop_order:$(form).find('.shop_order select[name=distribution_money_level]').val(),
					},
					distribution_s1_rate:{
						room_order:$(form).find('.room_order input[name=distribution_s1_rate]').val(),
						service_order:$(form).find('.service_order input[name=distribution_s1_rate]').val(),
						shop_order:$(form).find('.shop_order input[name=distribution_s1_rate]').val(),
					},
					distribution_s2_rate:{
						room_order:$(form).find('.room_order input[name=distribution_s2_rate]').val(),
						service_order:$(form).find('.service_order input[name=distribution_s2_rate]').val(),
						shop_order:$(form).find('.shop_order input[name=distribution_s2_rate]').val(),
					},
					distribution_s3_rate:{
						room_order:$(form).find('.room_order input[name=distribution_s3_rate]').val(),
						service_order:$(form).find('.service_order input[name=distribution_s3_rate]').val(),
						shop_order:$(form).find('.shop_order input[name=distribution_s3_rate]').val(),
					},
					distribution_message_user_1:message_user_1,
					distribution_message_user_2:message_user_2,
					distribution_message_user_3:message_user_3,
					distribution_message_money:message_money,
				};
				$.post($(form).attr('action'),data,function(response){
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