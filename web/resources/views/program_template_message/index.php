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
					<div class="line"></div>
					<div class="top-tips">
						<div class="top-tips-title">操作提示</div>
						<div class="top-tips-body">
							<p>小程序推送的模板消息</p>
						</div>
					</div>
					<div class="col-md-8">
						<form id="settingForm" class="form" method="post" action="<?=url()?>">
							<div class="panel col-md-7 center-block" id="room_order_create">
								<div class="panel-head">
									<div class="panel-title">
										住房订单创建成功通知&nbsp;&nbsp;&nbsp;
										<span class="text-helper">订单一旦创建成功推送给客户的消息</span>
									</div>
								</div>
								<div class="panel-body">
									<div class="form-group col-md-10">
										<label class="label col-md-2">模板ID</label>
										<input type="text" class="input_text col-md-7" name="template_id" value="<?=$message['room_order_create']['template_id']??''?>" placeholder="模板ID">
									</div>
									<div class="form-group col-md-10">
										<label class="label col-md-2">调转地址</label>
										<input type="text" class="input_text col-md-7" name="page" value="<?=$message['room_order_create']['page']??''?>" placeholder="小程序的页面地址">
									</div>
									<div class="form-group col-md-10">
										<label class="label col-md-2">关键词</label>
										<input type="text" class="input_text col-md-7" name="keyword" value="<?=$message['room_order_create']['keyword']??''?>" placeholder="关键词">
									</div>
									<?php if (isset($message['room_order_create']['config']) && !empty($message['room_order_create']['config'])){?>
									<?php foreach ($message['room_order_create']['config'] as $index => $variable){?>
									<div class="form-group col-md-10">
										<label class="label col-md-2">模板变量</label>
										<div class="col-md-8 config">
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
										<div class="col-md-8 config">
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
				<div class="key">{cancel_reason}</div>
				<div class="value">客户取消订单原因</div>
			</div>
			<div class="item">
				<div class="key">{arrivetime}</div>
				<div class="value">抵达时间</div>
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
		<div class="col-md-8 config">
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
					room_order_create:{
						template_id:$.trim($('#room_order_create input[name=template_id]').val()),//消息ID
						page:$.trim($('#room_order_create input[name=page]').val()),//消息ID
						keyword:$.trim($('#room_order_create input[name=keyword]').val()),//消息ID
						config:[]
					},
				};

				$('#room_order_create .config').each(function(index,value){
					var key = $.trim($(value).find('input.key').val());
					if(key.length>0)
					{
						var val = $.trim($(value).find('input.value').val());
						message.room_order_create.config.push({
							key:key,
							val:val,
						});
					}
				});

				
				$.post($(form).attr('action'),{program_id:'<?=Request::get('id')?>',message:JSON.stringify(message)},function(response){
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