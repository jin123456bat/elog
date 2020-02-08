<?php
use jin123456bat\assets;
use think\facade\Request;
use jin123456bat\hotelController;
use jin123456bat\companyController;
use think\Db;
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
<link rel="stylesheet" href="<?=assets::css('form.css')?>" type="text/css" media="all">
<link rel="stylesheet" href="<?=assets::css('panel.css')?>" type="text/css" media="all">
<link rel="stylesheet" href="<?=assets::css('datetimepicker.css')?>" type="text/css" media="all">
<link rel="stylesheet" href="<?=assets::css('select.css')?>" type="text/css" media="all" />
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
							<p>添加优惠码</p>
						</div>
					</div>
					<div class="line pull-right"></div>
					<form class="form" id="createCouponForm" action="<?=url()?>" method="post">
						<input type="hidden" name="id" value="<?=Request::get('id')?>">
						<div class="panel col-md-7 center-block">
							<div class="panel-head">
								<div class="panel-title">基础信息</div>
							</div>
							<div class="panel-body">
								<div class="form-group col-md-10">
									<label class="label col-md-2 required">名称</label>
									<input type="text" class="input_text col-md-7" name="name" value="<?=$coupon['name']?>" placeholder="">
									<span class="col-offset-2 text-helper">生成的优惠券名称</span>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">领取时间</label>
									<input type="text" class="input_text col-md-3 datetimepicker" name="gettime_start" value="<?=$coupon['gettime_start']?>" placeholder="领取开始时间">
									<div class="col-md-1" style="text-align: center; width: 7%;">~</div>
									<input type="text" class="input_text col-md-3 datetimepicker" name="gettime_end" value="<?=$coupon['gettime_end']?>" placeholder="领取结束时间">
									<div class="checkbox col-md-1">
										<input type="checkbox" id="gettime" checked="checked">
										<label for="gettime">勾选限制时间</label>
									</div>
									<span class="col-offset-2 text-helper">超出领取时间的优惠码无法兑换成优惠券</span>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">有效期</label>
									<input type="text" class="input_text col-md-7" name="days" value="<?=$coupon['days']?>" placeholder="">
									<span class="col-offset-2 text-helper">从领取时间开始计算，单位天,0永久有效</span>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">每人领取</label>
									<input type="text" class="input_text col-md-7" name="get_num_per" placeholder="0" value="<?=$coupon['get_num_per']?>">
									<span class="col-offset-2 text-helper">一个账号最多领取多少张,0代表不限制领取次数</span>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">累计领取</label>
									<input type="text" class="input_text col-md-7" name="get_num_total" value="<?=$coupon['get_num_total']?>" placeholder="">
									<span class="col-offset-2 text-helper">总计可以被领取多少次,累计领取数量超过次数的无法领取,0代表不限制领取次数</span>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">会员组限制</label>
									<select name="group_id" class="select col-md-7">
										<option value="">不限制</option>
										<?php foreach ($ugroup as $group){?>
										<option value="<?=$group['id']?>" <?=$coupon['group_id']==$group['id']?'selected="selected"':''?>><?=$group['name']?></option>
										<?php }?>
									</select>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">优惠券是否可以赠送</label>
									<select class="select col-md-7" name="transfer">
										<option value="0" <?=$coupon['transfer']==0?'selected="selected"':''?>>否</option>
										<option value="1" <?=$coupon['transfer']==1?'selected="selected"':''?>>是</option>
									</select>
									<span class="col-offset-2 text-helper">用户是否可以把优惠券分享给其他好友</span>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">优惠码</label>
									<div class="input-group col-md-7" style="display: inline-flex;">
										<input type="text" class="input_text col-md-7" name="code" value="<?=$coupon['code']?>" placeholder="系统唯一,不区分大小写，支持中文">
										<button id="createCouponCode" class="button col-md-3">随机生成</button>
									</div>
									<span class="col-offset-2 text-helper">用户可根据优惠码领取优惠券</span>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">规则描述</label>
									<textarea name="description" rows="4" class="textarea col-md-7" cols=""><?=$coupon['description']?></textarea>
									<span class="col-offset-2 text-helper">对优惠券的使用描述、注意事项等</span>
								</div>
							</div>
						</div>
						<?php foreach ($coupon['service_condition'] as $service_condition){?>
						<div class="panel col-md-7 center-block service_coupon">
							<div class="panel-head">
								<div class="panel-title">服务订单折扣信息</div>
								<div class="panel-more"><button class="button-xs button remove-coupon">删除</button></div>
							</div>
							<div class="panel-body">
								<div class="form-group col-md-10">
									<label class="label col-md-2 required">适用酒店</label>
									<select class="select col-md-7 selectpicker" name="hotel_id" multiple>
										<?php foreach ($hotel as $h){?>
										<option value="<?=$h['id']?>" <?=in_array($h['id'], explode(',', $service_condition['hotel_id']))?'selected="selected"':''?>><?=$h['name']?></option>
										<?php }?>
									</select>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2 required">限定服务类型</label>
									<select data-default="<?=$service_condition['hotel_id'].'@'.$service_condition['service_code']?>" name="service_code" class="select col-md-7 selectpicker" multiple>
									</select>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">满</label>
									<input type="text" class="input_text col-md-7" name="use_max" value="<?=helper::money_format($service_condition['use_max'])?>" placeholder="100">
									<span class="text-helper col-offset-2">订单金额满多少可以使用（不参加活动金额）</span>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">折扣方式</label>
									<select name="type" class="select col-md-7">
										<option value="0" <?=$service_condition['type']==0?'selected="selected"':''?>>固定优惠</option>
										<option value="1" <?=$service_condition['type']==1?'selected="selected"':''?>>折扣优惠</option>
									</select>
								</div>
								<div class="form-group col-md-10 <?=$service_condition['type']==1?'display-none':''?>">
									<label class="label col-md-2">减</label>
									<input type="text" class="input_text col-md-7" name="type_0_minus" value="<?=helper::money_format($service_condition['type_0_minus'])?>" placeholder="订单优惠金额">
								</div>
								<div class="form-group col-md-10 <?=$service_condition['type']==0?'display-none':''?>">
									<label class="label col-md-2">折扣比例</label>
									<input type="text" class="input_text col-md-7" name="type_1_rate" value="<?=$service_condition['type_1_rate']?>" placeholder="如85折请填写0.85">
								</div>
							</div>
						</div>
						<?php }?>
						<?php foreach ($coupon['room_condition'] as $room_condition){?>
						<div class="panel col-md-7 center-block room_coupon">
							<div class="panel-head">
								<div class="panel-title">住房订单折扣信息</div>
								<div class="panel-more"><button class="button-xs button remove-coupon">删除</button></div>
							</div>
							<div class="panel-body">
								<div class="form-group col-md-10">
									<label class="label col-md-2 required">适用酒店</label>
									<select class="select col-md-7 selectpicker" name="hotel_id" multiple>
										<?php foreach ($hotel as $h){?>
										<option value="<?=$h['id']?>" <?=in_array($h['id'], explode(',', $room_condition['hotel_id']))?'selected="selected"':''?>><?=$h['name']?></option>
										<?php }?>
									</select>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2 required">限定房型</label>
									<select data-default="<?=$room_condition['room_type_id']?>" name="room_type_id" class="select col-md-7 selectpicker" multiple>
									</select>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">满</label>
									<input type="text" class="input_text col-md-7" name="use_max" value="<?=helper::money_format($room_condition['use_max'])?>" placeholder="100">
									<span class="text-helper col-offset-2">订单金额满多少可以使用（不参加活动金额）</span>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">连续天</label>
									<input type="text" class="input_text col-md-7" name="use_max_days" value="<?=$room_condition['use_max_days']?>" placeholder="1">
									<span class="text-helper col-offset-2">订单中任意房型大于或等于多少天可用</span>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">房间数</label>
									<input type="text" class="input_text col-md-7" name="use_max_num" value="<?=$room_condition['use_max_num']?>" placeholder="1">
									<span class="text-helper col-offset-2">订单中累计房间数量大于或等于多少房间数可用</span>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">折扣方式</label>
									<select name="type" class="select col-md-7">
										<option value="0" <?=$room_condition['type']==0?'selected="selected"':''?>>固定优惠</option>
										<option value="1" <?=$room_condition['type']==1?'selected="selected"':''?>>折扣优惠</option>
									</select>
								</div>
								<div class="form-group col-md-10 <?=$room_condition['type']==1?'display-none':''?>">
									<label class="label col-md-2">减</label>
									<input type="text" class="input_text col-md-7" name="type_0_minus" value="<?=helper::money_format($room_condition['type_0_minus'])?>" placeholder="订单优惠金额">
								</div>
								<div class="form-group col-md-10 <?=$room_condition['type']==0?'display-none':''?>">
									<label class="label col-md-2">折扣比例</label>
									<input type="text" class="input_text col-md-7" name="type_1_rate" value="<?=$room_condition['type_1_rate']?>" placeholder="如85折请填写0.85">
								</div>
								<div class="form-group col-md-10 <?=$room_condition['type']==0?'display-none':''?>">
									<label class="label col-md-2">最大优惠金额</label>
									<input type="text" class="input_text col-md-7" name="type_1_max_money" value="<?=helper::money_format($room_condition['type_1_max_money'])?>" placeholder="400">
									<div class="text-helper col-offset-2">0则不限制最大优惠金额，当为折扣券的时候优惠金额不会超过这个限制</div>
								</div>
								<div class="form-group col-md-10 <?=$room_condition['type']==0?'display-none':''?>">
									<label class="label col-md-2">预定天数限制</label>
									<input type="text" class="input_text col-md-7" name="type_1_room_max_days" value="<?=$room_condition['type_1_room_max_days']?>" placeholder="0">
									<div class="text-helper col-offset-2">0则不限制，折扣金额基数按照最大多少天计算</div>
								</div>
								<div class="form-group col-md-10 <?=$room_condition['type']==0?'display-none':''?>">
									<label class="label col-md-2">房间数量限制</label>
									<input type="text" class="input_text col-md-7" name="type_1_room_max_nums" value="<?=$room_condition['type_1_room_max_nums']?>" placeholder="0">
									<div class="text-helper col-offset-2">0则不限制，折扣金额基数按照多少间房来计算</div>
								</div>
							</div>
						</div>
						<?php }?>
						<div id="create-coupon-group" class="col-md-7 center-block" style="margin-top:15px;display: flex;">
							<button class="button" style="flex: 1 1 auto;" id="create-room-coupon">添加住房折扣信息</button>
							<button class="button" style="flex: 1 1 auto;" id="create-service-coupon">添加服务折扣信息</button>
							<button class="button" style="flex: 1 1 auto;" id="create-food-coupon">添加餐饮折扣信息</button>
							<button class="button" style="flex: 1 1 auto;" id="create-shop-coupon">添加商城折扣信息</button>
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
<script type="text/html" id="tpl_room_coupon">
<div class="panel col-md-7 center-block room_coupon">
	<div class="panel-head">
		<div class="panel-title">住房订单折扣信息</div>
		<div class="panel-more"><button class="button-xs button remove-coupon">删除</button></div>
	</div>
	<div class="panel-body">
		<div class="form-group col-md-10">
			<label class="label col-md-2 required">适用酒店</label>
			<select class="select col-md-7 selectpicker" name="hotel_id" multiple>
				<?php foreach ($hotel as $h){?>
				<option value="<?=$h['id']?>"><?=$h['name']?></option>
				<?php }?>
			</select>
		</div>
		<div class="form-group col-md-10">
			<label class="label col-md-2 required">限定房型</label>
			<select name="room_type_id" class="select col-md-7 selectpicker" multiple>
			</select>
		</div>
		<div class="form-group col-md-10">
			<label class="label col-md-2">满</label>
			<input type="text" class="input_text col-md-7" name="use_max" value="" placeholder="100">
			<span class="text-helper col-offset-2">订单金额满多少可以使用（不参加活动金额）</span>
		</div>
		<div class="form-group col-md-10">
			<label class="label col-md-2">连续天</label>
			<input type="text" class="input_text col-md-7" name="use_max_days" value="" placeholder="1">
			<span class="text-helper col-offset-2">订单中任意房型大于或等于多少天可用</span>
		</div>
		<div class="form-group col-md-10">
			<label class="label col-md-2">房间数</label>
			<input type="text" class="input_text col-md-7" name="use_max_num" value="" placeholder="1">
			<span class="text-helper col-offset-2">订单中累计房间数量大于或等于多少房间数可用</span>
		</div>
		<div class="form-group col-md-10">
			<label class="label col-md-2">折扣方式</label>
			<select name="type" class="select col-md-7">
				<option value="0" selected="selected">固定优惠</option>
				<option value="1">折扣优惠</option>
			</select>
		</div>
		<div class="form-group col-md-10">
			<label class="label col-md-2">减</label>
			<input type="text" class="input_text col-md-7" name="type_0_minus" value="" placeholder="订单优惠金额">
		</div>
		<div class="form-group col-md-10 display-none">
			<label class="label col-md-2">折扣比例</label>
			<input type="text" class="input_text col-md-7" name="type_1_rate" value="" placeholder="如85折请填写0.85">
		</div>
		<div class="form-group col-md-10 display-none">
			<label class="label col-md-2">最大优惠金额</label>
			<input type="text" class="input_text col-md-7" name="type_1_max_money" value="" placeholder="400">
			<div class="text-helper col-offset-2">0则不限制最大优惠金额，当为折扣券的时候优惠金额不会超过这个限制</div>
		</div>
		<div class="form-group col-md-10 display-none">
			<label class="label col-md-2">预定天数限制</label>
			<input type="text" class="input_text col-md-7" name="type_1_room_max_days" value="" placeholder="0">
			<div class="text-helper col-offset-2">0则不限制，折扣金额基数按照最大多少天计算</div>
		</div>
		<div class="form-group col-md-10 display-none">
			<label class="label col-md-2">房间数量限制</label>
			<input type="text" class="input_text col-md-7" name="type_1_room_max_nums" value="" placeholder="0">
			<div class="text-helper col-offset-2">0则不限制，折扣金额基数按照多少间房来计算</div>
		</div>
	</div>
</div>
</script>
<script type="text/html" id="tpl_service_coupon">
<div class="panel col-md-7 center-block service_coupon">
	<div class="panel-head">
		<div class="panel-title">服务订单折扣信息</div>
		<div class="panel-more"><button class="button-xs button remove-coupon">删除</button></div>
	</div>
	<div class="panel-body">
		<div class="form-group col-md-10">
			<label class="label col-md-2 required">适用酒店</label>
			<select class="select col-md-7 selectpicker" name="hotel_id" multiple>
				<?php foreach ($hotel as $h){?>
				<option value="<?=$h['id']?>"><?=$h['name']?></option>
				<?php }?>
			</select>
		</div>
		<div class="form-group col-md-10">
			<label class="label col-md-2 required">限定服务类型</label>
			<select name="service_code" class="select col-md-7 selectpicker" multiple>
			</select>
		</div>
		<div class="form-group col-md-10">
			<label class="label col-md-2">满</label>
			<input type="text" class="input_text col-md-7" name="use_max" value="" placeholder="100">
			<span class="text-helper col-offset-2">订单金额满多少可以使用（不参加活动金额）</span>
		</div>
		<div class="form-group col-md-10">
			<label class="label col-md-2">折扣方式</label>
			<select name="type" class="select col-md-7">
				<option value="0" selected="selected">固定优惠</option>
				<option value="1">折扣优惠</option>
			</select>
		</div>
		<div class="form-group col-md-10">
			<label class="label col-md-2">减</label>
			<input type="text" class="input_text col-md-7" name="type_0_minus" value="" placeholder="订单优惠金额">
		</div>
		<div class="form-group col-md-10 display-none">
			<label class="label col-md-2">折扣比例</label>
			<input type="text" class="input_text col-md-7" name="type_1_rate" value="" placeholder="如85折请填写0.85">
		</div>
	</div>
</div>
</script>
<!-- 通用js -->
<script type="text/javascript" src="<?=assets::common('jquery.min.js','js')?>"></script>
<!-- 全局js调用 -->
<script type="text/javascript" src="<?=assets::js('global.js')?>"></script>
<!-- 当前页面使用的第三方类库的js -->
<script type="text/javascript" src="<?=assets::js('spop.min.js')?>"></script>
<script type="text/javascript" src="<?=assets::js('button.loading.js')?>"></script>
<script type="text/javascript" src="<?=assets::js('datetimepicker.js')?>"></script>
<script type="text/javascript" src="<?=assets::common('jquery.validate.min.js','js')?>"></script>
<script type="text/javascript" src="<?=assets::common('messages_zh.min.js','js')?>"></script>
<script type="text/javascript" src="<?=assets::js('select.js')?>"></script>
<script>
$.ajaxSetup({
	headers: {
        '__token__': '<?=Request::token('__token__')?>' ,
    } ,
});
</script>
<!-- 当前页面独有的js -->
<script type="text/javascript">
$(function(){
	$('#create-food-coupon,#create-shop-coupon').on('click',function(){
		spop({
		    template: '优惠规则尚未开放，请联系觅集科技',
		    style: 'error',
		    autoclose: 3000,
		    position:'bottom-right',
		    icon:true,
		    group:false,
		});
		return false;
	});
	$('#create-service-coupon').on('click',function(){
		var tpl = $($('#tpl_service_coupon').html());
		tpl.find('.selectpicker').each(function(){
			$(this).select({
				search:true,//允许搜索
				class:'col-md-7',//设置额外样式
			});
		});
		tpl.find('select[name=type]').trigger('change');
		tpl.insertBefore($('#create-coupon-group'));
		return false;
	});
	$('#create-room-coupon').on('click',function(){
		var tpl = $($('#tpl_room_coupon').html());
		tpl.find('.selectpicker').each(function(){
			$(this).select({
				search:true,//允许搜索
				class:'col-md-7',//设置额外样式
			});
		});
		tpl.find('select[name=type]').trigger('change');
		tpl.insertBefore($('#create-coupon-group'));
		return false;
	});

	//生成随机优惠码
	$('#createCouponCode').on('click',function(){
		$.post('<?=url('coupon/createCode')?>',function(response){
			$('#createCouponForm input[name=code]').val(response.data.code);
		});
		return false;
	});

	//住房订单可以选择限定房型
	$('#createCouponForm').on('change','.service_coupon select[name=hotel_id]',function(){
		var select = $(this);
		var service_code_select = $(this).parents('.service_coupon').find('select[name=service_code]');
		if($(this).val().length)
		{
			var data = {
				hotel_id:select.val()
			};

			var default_val = service_code_select.data('default')+'';
			if(default_val.length)
			{
				default_val = default_val.split(',');
			}

			$.get('<?=url('hotel/service_code_list')?>',data,function(response){
				service_code_select.empty();
				$.each(response.data,function(index,value){
					if(default_val.length && $.inArray(value.hotel_id+'@'+value.service_code,default_val)>-1)
					{
						service_code_select.append('<option selected="selected" value="'+value.hotel_id+'@'+value.service_code+'">【'+value.hotel_name+'】'+value.name+'</option>');
					}
					else
					{
						service_code_select.append('<option value="'+value.hotel_id+'@'+value.service_code+'">【'+value.hotel_name+'】'+value.name+'</option>');
					}
				});
				service_code_select.trigger('change');
			});
		}
		else
		{
			service_code_select.empty();
		}
		return false;
	}).on('change','.room_coupon select[name=hotel_id]',function(){
		var select = $(this);
		var room_type_id_select = $(this).parents('.room_coupon').find('select[name=room_type_id]');
		if($(this).val().length)
		{
			var data = {
				hotel_id:select.val()
			};

			var default_val = room_type_id_select.data('default')+'';
			if(default_val.length)
			{
				default_val = default_val.split(',');
			}

			$.get('<?=url('hotel/room_type_list')?>',data,function(response){
				room_type_id_select.empty();
				$.each(response.data,function(index,value){
					if(default_val.length && $.inArray(value.id+'',default_val)>-1)
					{
						room_type_id_select.append('<option selected="selected" value="'+value.id+'">【'+value.hotel_name+'】'+value.name+'</option>');
					}
					else
					{
						room_type_id_select.append('<option value="'+value.id+'">【'+value.hotel_name+'】'+value.name+'</option>');
					}
				});
				room_type_id_select.trigger('change');
			});
		}
		else
		{
			room_type_id_select.empty();
		}
	}).on('click','.remove-coupon',function(){
		$(this).parents('.panel').remove();
		return false;
	}).on('change','.room_coupon select[name=type]',function(){
		var room_coupon = $(this).parents('.room_coupon');
		if($(this).val()==1)
		{
			room_coupon.find('input[name=type_0_minus]').parents('.form-group').addClass('display-none');
			room_coupon.find('input[name=type_1_rate]').parents('.form-group').removeClass('display-none');
			room_coupon.find('input[name=type_1_max_money]').parents('.form-group').removeClass('display-none');
			room_coupon.find('input[name=type_1_room_max_nums]').parents('.form-group').removeClass('display-none');
			room_coupon.find('input[name=type_1_room_max_days]').parents('.form-group').removeClass('display-none');
		}
		else
		{
			room_coupon.find('input[name=type_0_minus]').parents('.form-group').removeClass('display-none');
			room_coupon.find('input[name=type_1_rate]').parents('.form-group').addClass('display-none');
			room_coupon.find('input[name=type_1_max_money]').parents('.form-group').addClass('display-none');
			room_coupon.find('input[name=type_1_room_max_nums]').parents('.form-group').addClass('display-none');
			room_coupon.find('input[name=type_1_room_max_days]').parents('.form-group').addClass('display-none');
		}
	}).on('change','.service_coupon select[name=type]',function(){
		var service_coupon = $(this).parents('.service_coupon');
		if($(this).val()==1)
		{
			service_coupon.find('input[name=type_0_minus]').parents('.form-group').addClass('display-none');
			service_coupon.find('input[name=type_1_rate]').parents('.form-group').removeClass('display-none');
		}
		else
		{
			service_coupon.find('input[name=type_0_minus]').parents('.form-group').removeClass('display-none');
			service_coupon.find('input[name=type_1_rate]').parents('.form-group').addClass('display-none');
		}
	});

	//这个代码必须在上面的绑定后面，不然不会触发酒店select的change事件
	$('.selectpicker').each(function(){
		$(this).select({
			search:true,//允许搜索
			class:'col-md-7',//设置额外样式
		});
	});
	
	//验证中文长度
	$.validator.addMethod("chineseMaxLength",function(value, element, param) {
		var flag = false;
		var length = value.length;
		for ( var i = 0; i < length; i++) {
			if (value.charCodeAt(i) > 127) {
				length++;
			}
		}
		if(length <= param){
			return true;
		}
		return false;
	});

	//添加优惠券的form表单的验证器
	$('#createCouponForm').validate({
		rules : {
			code : {
	            remote:{
	                type:"POST",  
	                url:"<?=url('coupon/checkCode')?>", //请求地址  
	                data:{
	                    code:function(){
	                        return $("#createCouponForm input[name=code]").val();
	                    },
	                    id:function(){
	                        return $("#createCouponForm input[name=id]").val();
	                    }
	                }
	            },
	            chineseMaxLength:32,
			},
			name:{
				required:true,
				chineseMaxLength:128,
			},
			get_num_per:{
				digits:true,
				min:0,
			},
			get_num_total:{
				digits:true,
				min:0,
			}
		},
		messages:{  
			code:{
	            remote:"优惠码已存在",
	            chineseMaxLength:'优惠码长度不能超过32个字符',
	        },
	        name:{
	        	required:'请填写优惠券名称',
	        	chineseMaxLength:'名称太长了',
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
			if(element.attr('name') == 'code')
			{
				error.insertAfter(element.parent());
			}
			else
			{
				error.appendTo(element.parent());
			}
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
			var data = {
				id:$.trim($(form).find('input[name=id]').val()),
				code:$.trim($(form).find('input[name=code]').val()),
				name:$.trim($(form).find('input[name=name]').val()),
				gettime_start:$.trim($(form).find('input[name=gettime_start]').val()),
				gettime_end:$.trim($(form).find('input[name=gettime_end]').val()),
				days:$.trim($(form).find('input[name=days]').val()),
				get_num_per:$.trim($(form).find('input[name=get_num_per]').val()),
				get_num_total:$.trim($(form).find('input[name=get_num_total]').val()),
				group_id:$(form).find('select[name=group_id]').val(),
				description:$(form).find('textarea[name=description]').val(),
				transfer:$(form).find('select[name=transfer]').val(),
				room:[],
				service:[],
				food:[],
				shop:[],
			};

			//添加住房优惠信息
			$('.room_coupon').each(function(index,value){
				data.room.push({
					hotel_id:$(value).find('select[name=hotel_id]').val(),
					room_type_id:$(value).find('select[name=room_type_id]').val(),
					use_max_days:$.trim($(value).find('input[name=use_max_days]').val()),
					use_max_num:$.trim($(value).find('input[name=use_max_num]').val()),
					use_max:$.trim($(value).find('input[name=use_max]').val()),
					type:$(value).find('select[name=type]').val(),
	 				type_0_minus:$.trim($(value).find('input[name=type_0_minus]').val()),
	 				type_1_rate:$(value).find('input[name=type_1_rate]').val(),
	 				type_1_max_money:$(value).find('input[name=type_1_max_money]').val(),
	 				type_1_room_max_nums:$(value).find('input[name=type_1_room_max_nums]').val(),
	 				type_1_room_max_days:$(value).find('input[name=type_1_room_max_days]').val(),
				});
			});

			//添加服务优惠信息
			$('.service_coupon').each(function(index,value){
				data.service.push({
					hotel_id:$(value).find('select[name=hotel_id]').val(),
					service_code:$(value).find('select[name=service_code]').val(),
					use_max:$.trim($(value).find('input[name=use_max]').val()),
					type:$(value).find('select[name=type]').val(),
					type_0_minus:$.trim($(value).find('input[name=type_0_minus]').val()),
					type_1_rate:$(value).find('input[name=type_1_rate]').val(),
				});
			});
			
			$(form).find('button[type=submit]').loading('start');
			$.post($(form).attr('action'),data,function(response){
				$(form).find('button[type=submit]').loading('stop');
				if(response.code==1)
				{
					window.location = '<?=url('coupon/index')?>';
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

	$('.datetimepicker').each(function(){
		$(this).datetimepicker();
	});

	$('#gettime').on('change',function(){
		$('input[name=gettime_start],input[name=gettime_end]').prop('disabled',!$(this).is(':checked'));
		if(!$(this).is(':checked'))
		{
			$('input[name=gettime_start],input[name=gettime_end]').datetimepicker('destroy');
			$('input[name=gettime_start]').attr('backup',$('input[name=gettime_start]').val());
			$('input[name=gettime_end]').attr('backup',$('input[name=gettime_end]').val());
			$('input[name=gettime_start],input[name=gettime_end]').val('不限时间').prop('readonly',true);
		}
		else
		{
			$('input[name=gettime_start]').val($('input[name=gettime_start]').attr('backup')).prop('readonly',false);
			$('input[name=gettime_end]').val($('input[name=gettime_end]').attr('backup')).prop('readonly',false);
		}
	});
});

</script>
</body>
</html>