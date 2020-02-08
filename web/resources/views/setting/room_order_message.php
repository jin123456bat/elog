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
									<form id="settingForm" class="form" method="post" action="<?=url()?>">
										<div class="panel col-md-7 center-block">
											<div class="panel-head">
												<div class="panel-title">模板消息通知开关</div>
											</div>
											<div class="panel-body">
												<div class="form-group col-md-10">
													<label class="label col-md-2">开关</label>
													<input type="checkbox" id="user_template_message" <?=($message['template_message_open']??0)==1?'checked="checked"':''?>>
													<label for="user_template_message">勾选开启模板消息通知</label>
												</div>
											</div>
										</div>
										<div class="line"></div>
										<div class="panel col-md-7 center-block" id="room_order_sure_accept">
											<div class="panel-head">
												<div class="panel-title">
													住房订单接单&nbsp;&nbsp;&nbsp;
													<span class="text-helper">订单接单成功后推送给客户消息</span>
												</div>
											</div>
											<div class="panel-body">
												<div class="form-group col-md-10">
													<label class="label col-md-2">模板ID</label>
													<input type="text" class="input_text col-md-7" name="room_order_sure_accept" value="<?=$message['template_message']['room_order_sure_accept']['id']??''?>" placeholder="模板ID">
												</div>
												<?php if (isset($message['template_message']['room_order_sure_accept']['variable']) && !empty($message['template_message']['room_order_sure_accept']['variable'])){?>
												<?php foreach ($message['template_message']['room_order_sure_accept']['variable'] as $index => $variable){?>
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
										<div class="panel col-md-7 center-block" id="room_order_sure_refuse">
											<div class="panel-head">
												<div class="panel-title">
													住房订单拒绝接单&nbsp;&nbsp;&nbsp;
													<span class="text-helper">订单拒绝接单后推送给客户的消息</span>
												</div>
											</div>
											<div class="panel-body">
												<div class="form-group col-md-10">
													<label class="label col-md-2">模板ID</label>
													<input type="text" class="input_text col-md-7" name="room_order_sure_refuse" value="<?=$message['template_message']['room_order_sure_refuse']['id']??''?>" placeholder="模板ID">
												</div>
												<?php if (isset($message['template_message']['room_order_sure_refuse']['variable']) && !empty($message['template_message']['room_order_sure_refuse']['variable'])){?>
												<?php foreach ($message['template_message']['room_order_sure_refuse']['variable'] as $index => $variable){?>
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
										<div class="panel col-md-7 center-block" id="room_order_cancel">
											<div class="panel-head">
												<div class="panel-title">
													住房订单取消通知&nbsp;&nbsp;&nbsp;
													<span class="text-helper">住房订单取消后推送给客户的消息，不论任何方式取消都会发送</span>
												</div>
											</div>
											<div class="panel-body">
												<div class="form-group col-md-10">
													<label class="label col-md-2">模板ID</label>
													<input type="text" class="input_text col-md-7" name="room_order_cancel" value="<?=$message['template_message']['room_order_cancel']['id']??''?>" placeholder="模板ID">
												</div>
												<?php if (isset($message['template_message']['room_order_cancel']['variable']) && !empty($message['template_message']['room_order_cancel']['variable'])){?>
												<?php foreach ($message['template_message']['room_order_cancel']['variable'] as $index => $variable){?>
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
										<div class="panel col-md-7 center-block" id="room_order_quit_refuse">
											<div class="panel-head">
												<div class="panel-title">
													住房拒绝取消通知&nbsp;&nbsp;&nbsp;
													<span class="text-helper">订单拒绝取消后通知客户</span>
												</div>
											</div>
											<div class="panel-body">
												<div class="form-group col-md-10">
													<label class="label col-md-2">模板ID</label>
													<input type="text" class="input_text col-md-7" name="room_order_quit_refuse" value="<?=$message['template_message']['room_order_quit_refuse']['id']??''?>" placeholder="模板ID">
												</div>
												<?php if (isset($message['template_message']['room_order_quit_refuse']['variable']) && !empty($message['template_message']['room_order_quit_refuse']['variable'])){?>
												<?php foreach ($message['template_message']['room_order_quit_refuse']['variable'] as $index => $variable){?>
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
										<div class="panel col-md-7 center-block" id="room_order_checkin">
											<div class="panel-head">
												<div class="panel-title">
													住房订单验证通知&nbsp;&nbsp;&nbsp;
													<span class="text-helper">订单验证成功后通知客户</span>
												</div>
											</div>
											<div class="panel-body">
												<div class="form-group col-md-10">
													<label class="label col-md-2">模板ID</label>
													<input type="text" class="input_text col-md-7" name="room_order_checkin" value="<?=$message['template_message']['room_order_checkin']['id']??''?>" placeholder="模板ID">
												</div>
												<?php if (isset($message['template_message']['room_order_checkin']['variable']) && !empty($message['template_message']['room_order_checkin']['variable'])){?>
												<?php foreach ($message['template_message']['room_order_checkin']['variable'] as $index => $variable){?>
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
													<input type="checkbox" id="admin_template_message" <?=($admin_template_message['template_message_open']??0)==1?'checked="checked"':''?>>
													<label for="admin_template_message">勾选开启模板消息通知</label>
												</div>
											</div>
										</div>
										<div class="line"></div>
										<div class="panel col-md-7 center-block" id="room_order_sure">
											<div class="panel-head">
												<div class="panel-title">
													住房订单接单通知&nbsp;&nbsp;&nbsp;
													<span class="text-helper">当订单可以被接单的时候，给管理员发送的通知</span>
												</div>
											</div>
											<div class="panel-body">
												<div class="form-group col-md-10">
													<label class="label col-md-2">模板ID</label>
													<input type="text" class="input_text col-md-7" name="room_order_sure" value="<?=$admin_template_message['template_message']['room_order_sure']['id']??''?>" placeholder="模板ID">
												</div>
												<?php if (isset($admin_template_message['template_message']['room_order_sure']['variable']) && !empty($admin_template_message['template_message']['room_order_sure']['variable'])){?>
												<?php foreach ($admin_template_message['template_message']['room_order_sure']['variable'] as $index => $variable){?>
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
										<div class="panel col-md-7 center-block" id="room_order_quit">
											<div class="panel-head">
												<div class="panel-title">
													住房订单申请取消通知&nbsp;&nbsp;&nbsp;
													<span class="text-helper">被接单后的订单，用户发起申请取消的时候给管理员发送的通知</span>
												</div>
											</div>
											<div class="panel-body">
												<div class="form-group col-md-10">
													<label class="label col-md-2">模板ID</label>
													<input type="text" class="input_text col-md-7" name="room_order_quit" value="<?=$admin_template_message['template_message']['room_order_quit']['id']??''?>" placeholder="模板ID">
												</div>
												<?php if (isset($admin_template_message['template_message']['room_order_quit']['variable']) && !empty($admin_template_message['template_message']['room_order_quit']['variable'])){?>
												<?php foreach ($admin_template_message['template_message']['room_order_quit']['variable'] as $index => $variable){?>
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
										<!--  
										 @ Desc 	新增取消订单通知管理员
										 @ Date 	2018-11-19 
										 @ Author   DaiChong 
										-->
										<div class="panel col-md-7 center-block" id="cancel_the_order">
											<div class="panel-head">
												<div class="panel-title">
													住房订单取消通知&nbsp;&nbsp;&nbsp;
													<span class="text-helper">当订单取消的时候发送给管理员的通知</span>
												</div>
											</div>
											<div class="panel-body">
												<div class="form-group col-md-10">
													<label class="label col-md-2">模板ID</label>
													<input type="text" class="input_text col-md-7" name="cancel_the_order" value="<?=$admin_template_message['template_message']['cancel_the_order']['id']??''?>" placeholder="模板ID">
												</div>
												<?php if (isset($admin_template_message['template_message']['cancel_the_order']['variable']) && !empty($admin_template_message['template_message']['cancel_the_order']['variable'])){?>
												<?php foreach ($admin_template_message['template_message']['cancel_the_order']['variable'] as $index => $variable){?>
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
										<!-- End -->
										<div class="line"></div>
										<div class="form-submit">
											<div class="center-block submit-body">
												<button type="submit" class="button button-submit button-large">保存</button>
												<button type="reset" class="button button-cancel button-large">重置</button>
											</div>
										</div>
									</form>
								</div>
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
				<div class="key">{room_type_name}</div>
				<div class="value">房型</div>
			</div>
			<div class="item">
				<div class="key">{person_name}</div>
				<div class="value">预定人手机号</div>
			</div>
			<div class="item">
				<div class="key">{person_telephone}</div>
				<div class="value">预定人手机号</div>
			</div>
			<div class="item">
				<div class="key">{card_name}</div>
				<div class="value">预定人姓名</div>
			</div>
			<div class="item">
				<div class="key">{starttime}</div>
				<div class="value">入住时间</div>
			</div>
			<div class="item">
				<div class="key">{endtime}</div>
				<div class="value">离店时间</div>
			</div>
			<div class="item">
				<div class="key">{remark}</div>
				<div class="value">备注</div>
			</div>
			<div class="item">
				<div class="key">{price}</div>
				<div class="value">订单金额</div>
			</div>
			<div class="item">
				<div class="key">{actual_price}</div>
				<div class="value">支付金额</div>
			</div>
			<div class="item">
				<div class="key">{pay_price}</div>
				<div class="value">线上支付金额</div>
			</div>
			<div class="item">
				<div class="key">{hotel_name}</div>
				<div class="value">酒店名称</div>
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
				<div class="key">{sure_reason}</div>
				<div class="value">拒绝接单原因</div>
			</div>
			<div class="item">
				<div class="key">{cancel_refuse_reason}</div>
				<div class="value">拒绝取消订单原因</div>
			</div>
			<div class="item">
				<div class="key">{book_num}</div>
				<div class="value">房间数量</div>
			</div>
			<div class="item">
				<div class="key">{cancel_reason}</div>
				<div class="value">客户取消订单原因</div>
			</div>
			<div class="item">
				<div class="key">{arrivetime}</div>
				<div class="value">抵达时间</div>
			</div>
			
			<div class="item">
				<div class="key">{coupon_price}</div>
				<div class="value">优惠券实际优惠金额</div>
			</div>
			<div class="item">
				<div class="key">{coupon_name}</div>
				<div class="value">优惠券名称</div>
			</div>
			<div class="item">
				<div class="key">{coupon_type}</div>
				<div class="value">优惠券类型（折扣、减免）</div>
			</div>
			<div class="item">
				<div class="key">{coupon_createtime}</div>
				<div class="value">优惠券领取时间</div>
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
						room_order_sure:{
							id:$.trim($('input[name=room_order_sure]').val()),//消息ID
							variable:[]
						},
						//拒绝取消
						room_order_quit:{
							id:$.trim($('input[name=room_order_quit]').val()),//消息ID
							variable:[]
						},
						//取消订单
						cancel_the_order:{
							id:$.trim($('input[name=cancel_the_order]').val()),//消息ID
							variable:[]
						},
					}
				};

				$('#room_order_sure .variable').each(function(index,value){
					var key = $.trim($(value).find('input.key').val());
					if(key.length>0)
					{
						var val = $.trim($(value).find('input.value').val());
						message.template_message.room_order_sure.variable.push({
							key:key,
							val:val,
						});
					}
				});

				$('#room_order_quit .variable').each(function(index,value){
					var key = $.trim($(value).find('input.key').val());
					if(key.length>0)
					{
						var val = $.trim($(value).find('input.value').val());
						message.template_message.room_order_quit.variable.push({
							key:key,
							val:val,
						});
					}
				});
				/**
				 @ Desc 	新增取消订单通知管理员
				 @ Date 	2018-11-19 
				 @ Author   DaiChong
				*/
				$('#cancel_the_order .variable').each(function(index,value){
					var key = $.trim($(value).find('input.key').val());
					if(key.length>0)
					{
						var val = $.trim($(value).find('input.value').val());
						message.template_message.cancel_the_order.variable.push({
							key:key,
							val:val,
						});
					}
				});
				//End
				//
				$.post($(form).attr('action'),{admin_template_message:JSON.stringify(message)},function(response){
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
		
		$('#settingForm').validate({
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
						//接单
						room_order_sure_accept:{
							id:$.trim($('input[name=room_order_sure_accept]').val()),//消息ID
							variable:[]
						},
						//拒绝接单
						room_order_sure_refuse:{
							id:$.trim($('input[name=room_order_sure_refuse]').val()),//消息ID
							variable:[]
						},
						//取消通知
						room_order_cancel:{
							id:$.trim($('input[name=room_order_cancel]').val()),//消息ID
							variable:[]
						},
						//拒绝取消
						room_order_quit_refuse:{
							id:$.trim($('input[name=room_order_quit_refuse]').val()),//消息ID
							variable:[]
						},
						//订单验证
						room_order_checkin:{
							id:$.trim($('input[name=room_order_checkin]').val()),//消息ID
							variable:[]
						},
					},
				};

				$('#room_order_sure_accept .variable').each(function(index,value){
					var key = $.trim($(value).find('input.key').val());
					if(key.length>0)
					{
						var val = $.trim($(value).find('input.value').val());
						message.template_message.room_order_sure_accept.variable.push({
							key:key,
							val:val,
						});
					}
					
				});

				$('#room_order_sure_refuse .variable').each(function(index,value){
					var key = $.trim($(value).find('input.key').val());
					if(key.length>0)
					{
						var val = $.trim($(value).find('input.value').val());
						message.template_message.room_order_sure_refuse.variable.push({
							key:key,
							val:val,
						});
					}
				});

				$('#room_order_cancel .variable').each(function(index,value){
					var key = $.trim($(value).find('input.key').val());
					if(key.length>0)
					{
						var val = $.trim($(value).find('input.value').val());
						message.template_message.room_order_cancel.variable.push({
							key:key,
							val:val,
						});
					}
				});

				$('#room_order_quit_refuse .variable').each(function(index,value){
					var key = $.trim($(value).find('input.key').val());
					if(key.length>0)
					{
						var val = $.trim($(value).find('input.value').val());
						message.template_message.room_order_quit_refuse.variable.push({
							key:key,
							val:val,
						});
					}
				});

				$('#room_order_checkin .variable').each(function(index,value){
					var key = $.trim($(value).find('input.key').val());
					if(key.length>0)
					{
						var val = $.trim($(value).find('input.value').val());
						message.template_message.room_order_checkin.variable.push({
							key:key,
							val:val,
						});
					}
				});

				
				$.post($(form).attr('action'),{message:JSON.stringify(message)},function(response){
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