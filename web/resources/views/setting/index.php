<?php
use jin123456bat\assets;
use think\facade\Request;
use jin123456bat\helper;
use app\company\companyHelper;
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
								<div class="panel-title">基础信息</div>
							</div>
							<div class="panel-body">
								<div class="form-group col-md-10">
									<label class="label col-md-2">站点标题</label>
									<input type="text" class="input_text col-md-7" name="site_title" value="<?=$setting['site_title']??''?>" placeholder="站点标题">
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">站点描述</label>
									<input type="text" class="input_text col-md-7" name="site_desc" value="<?=$setting['site_desc']??''?>" placeholder="站点描述">
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">住房订单取消时间</label>
									<input type="text" class="input_text col-md-7" name="quit_order_time" value="<?=$setting['quit_order_time']??''?>" placeholder="单位分钟,默认为15">
									<span class="text-helper col-offset-2">订单超时未支付系统会自动取消订单,单位分钟，只对住房订单有效</span>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">住房订单取消限制</label>
									<div class="col-md-7">
										<select class="select col-md-3" name="room_order_quit_limit_type">
											<option value="" <?=($setting['room_order_quit_limit_type']??'')==''?'selected="selected"':''?>>关闭限制</option>
											<option value="pay_order" <?=($setting['room_order_quit_limit_type']??'')=='pay_order'?'selected="selected"':''?>>预付订单</option>
											<option value="book_order" <?=($setting['room_order_quit_limit_type']??'')=='book_order'?'selected="selected"':''?>>预定订单</option>
											<option value="all_order" <?=($setting['room_order_quit_limit_type']??'')=='all_order'?'selected="selected"':''?>>所有类型</option>
										</select>
										<select class="select col-md-3" name="room_order_quit_limit_days">
											<option value="0" <?=($setting['room_order_quit_limit_days']??0)==0?'selected="selected"':''?>>当天</option>
											<option value="1" <?=($setting['room_order_quit_limit_days']??0)==1?'selected="selected"':''?>>前一天</option>
											<option value="2" <?=($setting['room_order_quit_limit_days']??0)==2?'selected="selected"':''?>>前二天</option>
											<option value="3" <?=($setting['room_order_quit_limit_days']??0)==3?'selected="selected"':''?>>前三天</option>
										</select>
										<select class="select col-md-3" name="room_order_quit_limit_time">
											<?php for($i = 0;$i<24;$i++){?>
											<option value="<?=$i?>" <?=($setting['room_order_quit_limit_time']??0)==$i?'selected="selected"':''?>><?=$i?>点</option>
											<?php }?>
										</select>
									</div>
									<span class="text-helper col-offset-2">对于某些订单限制取消时间，订单入住时间前可以取消</span>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">客房服务二维码链接有效期</label>
									<input type="text" class="input_text col-md-7" name="service_code_link_timeout" value="<?=$setting['service_code_link_timeout']??''?>" placeholder="单位分钟,默认为0">
									<span class="text-helper col-offset-2">扫描客房服务二维码生成的链接增加有效期,0则不设定有效期</span>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">服务订单完成时间</label>
									<input type="text" class="input_text col-md-7" name="complete_service_order_time" value="<?=$setting['complete_service_order_time']??''?>" placeholder="单位分钟,默认为60">
									<span class="text-helper col-offset-2">服务订单超时没有完成，系统自动完成，单位分钟，只对服务订单有效</span>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">服务订单取消时间</label>
									<input type="text" class="input_text col-md-7" name="quit_service_order_time" value="<?=$setting['quit_service_order_time']??''?>" placeholder="单位分钟,默认为15">
									<span class="text-helper col-offset-2">对于应支付且未支付的服务订单，超时后系统自动取消</span>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">餐饮订单完成时间</label>
									<input type="text" class="input_text col-md-7" name="food_order_finish_time" value="<?=$setting['food_order_finish_time']??''?>" placeholder="单位分钟,默认为120">
									<span class="text-helper col-offset-2">验证后的餐饮订单自动完成时间，默认为120</span>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">餐饮订单取消时间</label>
									<input type="text" class="input_text col-md-7" name="quit_food_order_time" value="<?=$setting['quit_food_order_time']??''?>" placeholder="单位分钟,默认为60">
									<span class="text-helper col-offset-2">对于用户未确认的订单系统自动取消，防止库存无限占用，默认为60</span>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">餐饮订单取消限制</label>
									<div class="col-md-7">
										<select class="select col-md-5" name="food_order_quit_limit_type">
											<option value="" <?=($setting['food_order_quit_limit_type']??'')==''?'selected="selected"':''?>>关闭限制</option>
											<option value="book_order" <?=($setting['food_order_quit_limit_type']??'')=='book_order'?'selected="selected"':''?>>预定订单</option>
										</select>
										<select class="select col-md-5" name="food_order_quit_limit_time">
											<?php for($i = 1;$i<24;$i++){?>
											<option value="<?=$i?>" <?=($setting['food_order_quit_limit_time']??0)==$i?'selected="selected"':''?>><?=$i?>个小时前</option>
											<?php }?>
										</select>
									</div>
									<span class="text-helper col-offset-2">对于某些订单限制取消时间，餐饮订单预定时间XXX前可以取消</span>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">商城订单取消时间</label>
									<input type="text" class="input_text col-md-7" name="quit_shop_order_time" value="<?=$setting['quit_shop_order_time']??''?>" placeholder="单位分钟,默认为15">
									<span class="text-helper col-offset-2">订单超时未支付系统会自动取消订单,单位分钟，只对商城订单有效</span>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">商城订单强制收货时间</label>
									<input type="text" class="input_text col-md-7" name="end_shop_order_time" value="<?=$setting['end_shop_order_time']??''?>" placeholder="单位天,默认为7">
									<span class="text-helper col-offset-2">订单超时未支付系统会自动取消订单,单位天，只对商城订单有效</span>
								</div>
								<?php if (helper::getHotelsNum(companyHelper::getCompanyId())>1){?>
								<div class="form-group col-md-10">
									<label class="label col-md-2">充值订单收款方</label>
									<select name="user_recharge_hotel_id" class="select col-md-7">
										<option value="" disabled="disabled" selected="selected">请选择收款方酒店</option>
										<?php foreach ($hotels as $hotel){?>
										<option value="<?=$hotel['id']?>" <?=($setting['user_recharge_hotel_id']??'')==$hotel['id']?'selected="selected"':''?>><?=$hotel['name']?></option>
										<?php }?>
									</select>
									<span class="text-helper col-offset-2">当会员充值的时候，由哪个酒店方来收款</span>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">会员升级订单收款方</label>
									<select name="user_upgrade_hotel_id" class="select col-md-7">
										<option value="" disabled="disabled" selected="selected">请选择收款方酒店</option>
										<?php foreach ($hotels as $hotel){?>
										<option value="<?=$hotel['id']?>" <?=($setting['user_upgrade_hotel_id']??'')==$hotel['id']?'selected="selected"':''?>><?=$hotel['name']?></option>
										<?php }?>
									</select>
									<span class="text-helper col-offset-2">当用户购买会员的时候由哪个酒店来收款</span>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">商城订单的收款方</label>
									<select name="shop_order_hotel_id" class="select col-md-7">
										<option value="" disabled="disabled" selected="selected">请选择收款方酒店</option>
										<?php foreach ($hotels as $hotel){?>
										<option value="<?=$hotel['id']?>" <?=($setting['shop_order_hotel_id']??'')==$hotel['id']?'selected="selected"':''?>><?=$hotel['name']?></option>
										<?php }?>
									</select>
									<span class="text-helper col-offset-2">商城订单的费用，由哪个酒店方来收款</span>
								</div>
								<?php }?>

								<div class="form-group col-md-10">
									<label class="label col-md-2">前台模板</label>
									<select name="template" class="select col-md-7">
										<option value="white" <?=$setting['template']=='white'?'selected="selected"':''?>>默认</option>
									</select>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">用户注册模式</label>
									<select name="user_register_mode" class="select col-md-7">
										<option value="auto" <?=$setting['user_register_mode']=='auto'?'selected="selected"':''?>>自动注册</option>
										<option value="focus" <?=$setting['user_register_mode']=='focus'?'selected="selected"':''?>>强制注册</option>
									</select>
									<span class="text-helper col-offset-2">自动注册只在微信浏览下有效，不能跨平台，强制模式可以跨平台</span>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">预定最大天数</label>
									<input type="text" class="input_text col-md-7" name="reserve_max_days" value="<?=$setting['reserve_max_days']??180?>" placeholder="预定最大的天数,默认180天">
									<span class="text-helper col-offset-2">预定大的天数限制,默认180天</span>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">使用发票</label>
									<select name="is_invoice" class="select col-md-7">
										<option value="1" <?=isset($setting['is_invoice'])==1?'selected="selected"':''?>>使用</option>
										<option value="2" <?=isset($setting['is_invoice'])==2?'selected="selected"':''?>>不使用</option>
									</select>
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
	<script>
$.ajaxSetup({
	headers: {
        '__token__': '<?=Request::token('__token__')?>' ,
    },
});
</script>
	<script type="text/javascript">
$(function(){
	$('select[name=room_order_quit_limit_type]').on('change',function(){
		if($(this).val().length==0)
		{
			$('select[name=room_order_quit_limit_days]').hide();
			$('select[name=room_order_quit_limit_time]').hide();
		}
		else
		{
			$('select[name=room_order_quit_limit_days]').show();
			$('select[name=room_order_quit_limit_time]').show();
		}
	}).trigger('change');


	$('select[name=food_order_quit_limit_type]').on('change',function(){
		if($(this).val().length==0)
		{
			$('select[name=food_order_quit_limit_time]').hide();
		}
		else
		{
			$('select[name=food_order_quit_limit_time]').show();
		}
	}).trigger('change');

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
			//window.location.reload();
		});
		return false;
	});
});
</script>
</body>
</html>