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
<link rel="stylesheet" href="<?=assets::css('datatables.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('panel.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('tab.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('jquery.modal.css')?>" type="text/css" media="all" />
<style>
.data-container {
	display: flex;
	flex-flow: row wrap;
}

.text-center {
	width: 100%;
	text-align: center;
}

.data {
	flex: 1 1 auto;
	display: flex;
	width: 50%;
	margin-bottom: 5px;
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-size: 14px;
	line-height: 1.42857143;
	color: #333;
}

.piece {
	margin-left: 0px;
	margin-right: 0px;
}

.item {
	width: 70px;
	height: 70px;
	border-radius: 50%;
	line-height: 70px;
	font-size: 12px;
	text-align: center;
	background-color: #ccc;
	color: #000;
	position: relative;
}

.next {
	height: 70px;
	text-align: center;
	line-height: 70px;
	font-size: 24px;
}

.flow {
	display: flex;
	flex-flow: row nowrap;
	justify-content: space-around;
}

.item.active {
	background-color: rgba(41, 161, 177, 1);
	color: #fff;
}

.item:hover .popups {
	display: block;
	position: absolute;
	color: #000;
	border: 1px solid #ccc;
	width: 150px;
	white-space: nowrap;
	border-radius: 5px;
	background-color: #fff;
	top: 75px;
	left: -40px;
	line-height: 35px;
}

.item .popups {
	display: none;
}

table {
	background-color: rgba(244, 245, 250, 1);
	margin-top: 14px;
	font-size: 12px;
	width: 100%;
	border-spacing: 0;
	border-collapse: collapse;
	font-size: 12px;
}

table tr {
	border: 1px solid #ccc;
}

table tbody tr {
	background-color: #fff;
}

table tbody tr:hover {
	background-color: #f5f5f5;
}

table td {
	padding: 8px;
	line-height: 1.42857143;
}

.pupbj {
	position: fixed;
	width: 800px;
	height: 600px;
	top: calc(50% - 300px);
	left: calc(50% - 400px);
	background: #fff;
	display: flex;
	overflow-y: auto;
	z-index: 1005
}

.byx {
	color: red;
	margin-top: 5px;
}

.olddiv, .newdiv {
	width: 400px;
	height: 600px;
	display: flex;
	flex-direction: column;
}

.pupbj span, .pupbj h4 {
	margin-left: 10px;
	margin-top: 10px;
}

.block {
	position: fixed;
	width: 100%;
	height: 100%;
	z-index: 1004;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	background: rgba(0, 0, 0, 0.5)
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
					<div class="col-md-10">
						<button class="button primary col-md-1" onClick="room_order_print();">打印</button>
					</div>
					<div class="panel piece col-md-5">
						<div class="panel-head">
							<div class="panel-title">基础信息</div>
						</div>
						<div class="panel-body data-container">
							<div class="data">
								<div class="key">订单号:</div>
								<div class="value"><?=$room_order['orderno']?></div>
							</div>
							<div class="data">
								<div class="key">订单状态:</div>
								<div class="value"><?=$room_order['status_text']?></div>
							</div>
							<div class="data">
								<div class="key">集团:</div>
								<div class="value"><?=$room_order['company_name']?></div>
							</div>
							<div class="data">
								<div class="key">酒店:</div>
								<div class="value"><?=$room_order['hotel_name']?></div>
							</div>
							<div class="data">
								<div class="key">创建时间:</div>
								<div class="value"><?=$room_order['createtime']?></div>
							</div>
						</div>
					</div>
					<div class="panel piece col-md-5">
						<div class="panel-head">
							<div class="panel-title">预定人信息</div>
						</div>
						<div class="panel-body data-container">
							<div class="data">
								<div class="key">预定人:</div>
								<div class="value"><?=$room_order['user_nickname']?></div>
							</div>
							<div class="data">
								<div class="key">联系人姓名:</div>
								<div class="value"><?=$room_order['person_name']?></div>
							</div>
							<div class="data">
								<div class="key">联系人手机号:</div>
								<div class="value"><?=$room_order['person_telephone']?></div>
							</div>
							<div class="data">
								<div class="key">证件类型:</div>
								<div class="value"><?=$room_order['person_card_type_name']?></div>
							</div>
							<div class="data">
								<div class="key">证件号码:</div>
								<div class="value"><?=$room_order['person_card_no']?></div>
							</div>
						</div>
					</div>
					<div class="panel piece col-md-5">
						<div class="panel-head">
							<div class="panel-title">支付信息</div>
						</div>
						<div class="panel-body data-container">
							<div class="data">
								<div class="key">支付状态:</div>
								<?php
								$pay_status = [
									0 => '未支付',
									1 => '已支付',
									- 1 => '有退款',
									- 2 => '全额退款'
								]?>
								<div class="value"><?=$pay_status[$room_order['pay_status']]?></div>
							</div>
							<div class="data">
								<div class="key">支付方式:</div>
								<div class="value"><?=$room_order['pay_method_name']?></div>
							</div>
							<div class="data">
								<div class="key">线上支付:</div>
								<div class="value"><?=$room_order['pay_online']==1?'是':'否'?></div>
							</div>
							<div class="data">
								<div class="key">支付时间:</div>
								<div class="value"><?=$room_order['pay_time']?></div>
							</div>
							<div class="data">
								<div class="key">支付单号:</div>
								<div class="value"><?=$room_order['pay_no']?></div>
							</div>
							<div class="data">
								<div class="key">支付金额:</div>
								<div class="value"><?=helper::money_format($room_order['pay_price'])?></div>
							</div>
							<div class="data">
								<div class="key">余额支付:</div>
								<div class="value"><?=helper::money_format($room_order['money_price'])?></div>
							</div>
						</div>
					</div>
					<div class="panel piece col-md-5">
						<div class="panel-head">
							<div class="panel-title">优惠券信息</div>
						</div>
						<div class="panel-body data-container">
							<?php if (!empty($coupon)){?>
							<div class="data">
								<div class="key">名称:</div>
								<div class="value"><?=$coupon['name']?></div>
							</div>
							<div class="data">
								<div class="key">领取时间:</div>
								<div class="value"><?=$coupon['createtime']?></div>
							</div>
							<div class="data">
								<div class="key">到期时间:</div>
								<div class="value"><?=empty($coupon['expiretime'])?'永不过期':$coupon['expiretime']?></div>
							</div>
							<div class="data">
								<div class="key">使用范围:</div>
								<div class="value"><?=!$coupon['room_condition']->isEmpty()?'住房,':''?><?=!$coupon['food_condition']->isEmpty()?'餐饮,':''?><?=!$coupon['service_condition']->isEmpty()?'服务,':''?><?=!$coupon['shop_condition']->isEmpty()?'商城':''?></div>
							</div>
							<div class="data">
								<div class="key">领取渠道:</div>
								<div class="value"><?=$coupon['source']?></div>
							</div>
							<div class="data">
								<div class="key">优惠金额:</div>
								<div class="value"><?=helper::money_format($coupon['coupon_price'])?></div>
							</div>
							<div class="data">
								<div class="key">描述:</div>
								<div class="value"><?=$coupon['description']?></div>
							</div>
							<?php }else{?>
							<div class="text-helper text-center">未使用优惠券</div>
							<?php }?>
						</div>
					</div>
					<div class="panel piece col-md-5">
						<div class="panel-head">
							<div class="panel-title">订单金额</div>
						</div>
						<div class="panel-body data-container">
							<div class="data">
								<div class="key">订单原价:</div>
								<div class="value"><?=helper::money_format($room_order['price'])?></div>
							</div>
							<div class="data">
								<div class="key">线上支付特惠:</div>
								<div class="value"><?=helper::money_format($room_order['paymethod_special_price'])?></div>
							</div>
							<div class="data">
								<div class="key">特惠金额:</div>
								<div class="value"><?=helper::money_format($room_order['special_price'])?></div>
							</div>
							<div class="data">
								<div class="key">优惠金额:</div>
								<div class="value"><?=helper::money_format($room_order['coupon_price'])?></div>
							</div>
							<div class="data">
								<div class="key">押金:</div>
								<div class="value"><?=helper::money_format($room_order['deposit_price'])?></div>
							</div>
							<div class="data">
								<div class="key">应付金额:</div>
								<div class="value"><?=helper::money_format($room_order['actual_price'])?></div>
							</div>
							<div class="data">
								<div class="key">退款金额:</div>
								<div class="value"><?=helper::money_format($room_order['refund_price'])?></div>
							</div>
						</div>
					</div>
					<div class="panel">
						<div class="panel-head">
							<div class="panel-title">订单流程</div>
						</div>
						<div class="panel-body">
							<div class="flow">
								<div class="item active create">
									订单创建
									<div class="popups">
										<?=$room_order['createtime']?>
									</div>
								</div>
								<?php if ($room_order['status']==1){?>
								<?php if ($room_order['pay_online']==1){?>
								<div class="next">=></div>
								<div class="item <?=$room_order['pay_status']==1?'active':''?> pay_online">
									线上支付
									<div class="popups">
										<?=$room_order['createtime']?>
									</div>
								</div>
								<?php }?>
								<div class="next">=></div>
								<div class="item <?=$room_order['sure']==1?'active':''?> sure">
									接单
									<?php if ($room_order['sure']==1){?>
									<div class="popups">
										<?=$room_order['suretime']?><br>
										<?=$room_order['sure_reason']?>
									</div>
									<?php }?>
								</div>
								<?php if ($room_order['pay_online']==0){?>
								<div class="next">=></div>
								<div class="item <?=$room_order['checkin']==1?'active':''?> pay_underline">线下支付</div>
								<?php }?>
								<div class="next">=></div>
								<div class="item <?=$room_order['checkin']==1?'active':''?> chekcin">
									验证/入住
									<?php if ($room_order['checkin']==1){?>
									<div class="popups">
										<?=$room_order['checkin_start_time']?><br>
										<?=$room_order['checkin_end_time']?>
									</div>
									<?php }?>
								</div>
								<div class="next">=></div>
								<div class="item <?=$room_order['checkout']==1?'active':''?> checkout">
									离店
									<?php if ($room_order['checkout']==1){?>
									<div class="popups">
										<?=$room_order['checkout_start_time']?><br>
										<?=$room_order['checkout_end_time']?>
									</div>
									<?php }?>
								</div>
								<div class="next">=></div>
								<div class="item evaluate <?=$room_order['evaluate']==1?'active':''?>">
									评价
									<?php if ($room_order['evaluate']==1){?>
									<div class="popups">
										<?=$room_order['evaluatetime']?>
									</div>
									<?php }?>
								</div>
								<?php }else{?>
								<?php if ($room_order['pay_online']==1){?>
								<div class="next">=></div>
								<div class="item <?=$room_order['pay_status']==1?'active':''?> pay_online">
									线上支付
									<div class="popups">
										<?=$room_order['createtime']?>
									</div>
								</div>
								<?php }?>
								<?php if ($room_order['sure']==1){?>
								<div class="next">=></div>
								<div class="item active sure">
									接单
									<div class="popups">
										<?=$room_order['suretime']?><br>
										<?=$room_order['sure_reason']?>
									</div>
								</div>
								<?php }?>
								<?php if ($room_order['pay_online']==0){?>
								<?php if ($room_order['checkin']==1){?>
								<div class="next">=></div>
								<div class="item active pay_underline">线下支付</div>
								<?php }?>
								<?php }?>
								<?php if ($room_order['checkin']==1){?>
								<div class="next">=></div>
								<div class="item active chekcin">
									验证/入住
									<div class="popups">
										<?=$room_order['checkin_start_time']?><br>
										<?=$room_order['checkin_end_time']?>
									</div>
								</div>
								<?php }?>
								<?php if ($room_order['checkout']==1){?>
								<div class="next">=></div>
								<div class="item active checkout">
									离店
									<div class="popups">
										<?=$room_order['checkout_start_time']?><br>
										<?=$room_order['checkout_end_time']?>
									</div>
								</div>
								<?php }?>
								<?php if ($room_order['evaluate']==1){?>
								<div class="next">=></div>
								<div class="item evaluate active">
									评价
									<div class="popups">
										<?=$room_order['evaluatetime']?>
									</div>
								</div>
								<?php }?>
								<?php if ($room_order['sure']==1){?>
								<div class="next">=></div>
								<div class="item active cancel">申请取消</div>
								<?php }?>
								<div class="next">=></div>
								<div class="item active quit">
									已取消
									<div class="popups">
										<p><?=$room_order['canceltime']?></p>
										<p><?=$room_order['cancel_reason']?></p>
									</div>
								</div>
								<?php }?>
							</div>
						</div>
					</div>
					<div class="tab tab-grey" style="margin-top: 14px;">
						<div class="tab-header">
							<a class="tab-title active" href="#room_order_detail"> 明细 </a>
							<a class="tab-title" href="#room_order_date"> 详情 </a>
						</div>
						<div class="tab-body">
							<div class="tab-page active" id="room_order_detail">
								<table style="margin-top: 0px; border-top: none;">
									<thead>
										<tr>
											<td>客房信息</td>
											<td>房间号</td>
											<td>入住人</td>
											<td>手机号</td>
											<td>证件类型</td>
											<td>证件号码</td>
											<td>入住时间</td>
											<td>离店时间</td>
											<td>原价</td>
											<td>下单价</td>
											<td>特惠价</td>
											<td>优惠价</td>
											<td>应付金额</td>
											<td>余额支付</td>
											<td>线上支付</td>
											<td>抵达时间</td>
											<td>天</td>
											<td>是否入住</td>
											<td>是否离店</td>
											<td>备注</td>
										</tr>
									</thead>
									<tbody>
									<?php foreach ($details as $detail){?>
										<tr>
											<td style="text-align: center; width: 50px;">
												<img src="<?=$detail['room_type_logo']?>">
												<br>
												<?=$detail['room_type_name']?>
											</td>
											<td><?=$detail['room_no']?></td>
											<td><?=$detail['person_name']?></td>
											<td><?=$detail['person_telephone']?></td>
											<td><?=$detail['card_type_name']?></td>
											<td><?=$detail['card_no']?></td>
											<td><?=$detail['starttime']?></td>
											<td><?=$detail['endtime']?></td>
											<td><?=helper::money_format($detail['oldprice'])?></td>
											<td><?=helper::money_format($detail['price'])?></td>
											<td><?=helper::money_format($detail['special_price'])?></td>
											<td><?=helper::money_format($detail['coupon_price'])?></td>
											<td><?=helper::money_format($detail['actual_price'])?></td>
											<td><?=helper::money_format($detail['money_price'])?></td>
											<td><?=helper::money_format($detail['pay_price'])?></td>
											<td><?=$detail['arrive']?></td>
											<td><?=$detail['days']?></td>
											<td><?=$detail['checkin']==1?'是':'否'?></td>
											<td><?=$detail['checkout']==1?'是':'否'?></td>
											<td><?=$detail['remark']?></td>
										</tr>
									<?php }?>
									</tbody>
								</table>
							</div>
							<div class="tab-page" id="room_order_date">
								<table style="margin-top: 0px;">
									<thead>
										<tr>
											<td>房型</td>
											<td>房间号</td>
											<td>日期</td>
											<td>价格</td>
											<td>特惠价</td>
											<td>优惠价</td>
											<td>应付价</td>
										</tr>
									</thead>
									<tbody>
									<?php foreach ($room_order_date as $r){?>
										<tr>
											<td style="text-align: center; width: 50px;">
												<img src="<?=$r['room_type_logo']?>">
												<br>
												<?=$r['room_type_name']?>
											</td>
											<td><?=$r['room_no']?></td>
											<td><?=$r['date']?></td>
											<td><?=helper::money_format($r['price'])?></td>
											<td><?=helper::money_format($r['special_price'])?></td>
											<td><?=helper::money_format($r['coupon_price'])?></td>
											<td><?=helper::money_format($r['actual_price'])?></td>
										</tr>
									<?php }?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<table>
						<thead>
							<tr>
								<td>实体券名称</td>
								<td>价格</td>
								<td>数量</td>
								<td>应付金额</td>
								<td>退款数量</td>
								<td>退款金额</td>
							</tr>
						</thead>
						<tbody>
							<?php if (!empty($voucher)){?>
							<?php foreach ($voucher as $v){?>
							<tr>
								<td><?=$v['voucher_name']?></td>
								<td><?=helper::money_format($v['price'])?></td>
								<td><?=$v['num']?></td>
								<td><?=helper::money_format($v['actual_price'])?></td>
								<td><?=$v['refund_num']?></td>
								<td><?=helper::money_format($v['refund_price'])?></td>
							</tr>
							<?php }?>
							<?php }else{?>
							<tr>
								<td colspan="10">
									<div class="text-center text-helper">无数据</div>
								</td>
							</tr>
							<?php }?>
						</tbody>
					</table>
					<?php if (!empty($pms_log)){?>
					<table>
						<thead>
							<tr>
								<td>推送类型</td>
								<td>PMS订单号</td>
								<td>添加时间</td>
								<td>上次推送时间</td>
								<td>成功</td>
								<td>失败次数</td>
								<td>响应数据</td>
								<td>有效</td>
								<td>操作</td>
							</tr>
						</thead>
						<tbody>
							<?php
						$type = [
							'create' => '订单创建',
							'inpay' => '入账',
							'cancel' => '取消'
						];
						?>
							<?php foreach ($pms_log as $log){?>
							<tr>
								<td><?=$type[$log['type']]?></td>
								<td><?=$log['pms_order_id']?></td>
								<td><?=$log['createtime']?></td>
								<td><?=$log['modifytime']?></td>
								<td><?=$log['success']==1?'成功':'失败'?></td>
								<td><?=$log['fail_times']?></td>
								<td><?=$log['response_string']?></td>
								<td><?=$log['status']?></td>
								<td></td>
							</tr>
							<?php }?>
						</tbody>
					</table>
					<?php }?>
					<table>
						<thead>
							<tr>
								<td>退款单号</td>
								<td>退款时间</td>
								<td>退款金额</td>
								<td>退款方式</td>
								<td>退款状态</td>
								<td>退款通知</td>
							</tr>
						</thead>
						<tbody>
							<?php if (!empty($refund)){?>
							<?php foreach ($refund as $r){?>
							<tr>
								<td><?=$r['orderno']?></td>
								<td><?=$r['createtime']?></td>
								<td><?=helper::money_format($r['money'])?></td>
								<td><?=$r['refundmethod_name']?></td>
								<td><?=$r['result']==1?'成功':'失败'?></td>
								<td>
									<button class="button button-xs json" data-json='<?=$r['notify']?>'>查看</button>
								</td>
							</tr>
							<?php }?>
							<?php }else{?>
							<tr>
								<td colspan="10">
									<div class="text-center text-helper">无数据</div>
								</td>
							</tr>
							<?php }?>
						</tbody>
					</table>
					<table class="mytable">
						<thead>
							<tr>
								<td>时间</td>
								<td>类型</td>
								<td>描述</td>
								<td>用户</td>
								<td>集团管理员</td>
								<td>酒店管理员</td>
								<td>数据日志</td>
							</tr>
						</thead>
						<tbody>
						<?php
						$room_order_type = [
							1 => '订单退款',
							2 => '入住',
							3 => '订单取消',
							4 => '更改支付方式',
							5 => '修改余额支付的金额',
							6 => '完成评价',
							7 => '订单验证/入住',
							8 => '用户离店',
							9 => '拒绝接单',
							10 => '设置订单不允许取消',
							11 => '修改入离日期',
							12 => '修改房型',
							13 => '完成支付',
							14 => '订单创建',
							15 => '申请取消',
							16 => '接单',
							17 => '应到未到',
							18 => '设置线下支付',
						];
						?>
						<?php if (!empty($logs)){?>
						<?php foreach ($logs as $log){?>
							<tr>
								<td><?=$log['createtime']?></td>
								<td><?=$room_order_type[$log['type']]?></td>
								<td><?=$log['content']?></td>
								<td><?=$log['user_name']?></td>
								<td><?=$log['company_admin_name']?></td>
								<td><?=$log['hotel_admin_name']?></td>
								<td>
									<a class='olddata button button-xs' data-olddata='<?=$log['olddata']?>' data-newdata='<?=$log['newdata']?>'>比较</a>
								</td>
							</tr>
						<?php }?>
						<?php }else{?>
							<tr>
								<td colspan="10">
									<div class="text-center text-helper">无数据</div>
								</td>
							</tr>
						<?php }?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div id="jsonModal" class="modal-bg display-none">
		<div class="modal-container">
			<div class="modal-header">
				<div class="modal-title">
					退款响应通知
					<button class="close">x</button>
				</div>
			</div>
			<div class="modal-body" style="padding: 15px; background-color: #ccc; color: #333; font-size: 14px; white-space: pre;"></div>
			<div class="modal-footer">
				<button type="button" class="close">关闭</button>
			</div>
		</div>
	</div>
	{include file='common/footer' /}
	<!-- 通用js -->
	<script type="text/javascript" src="<?=assets::common('jquery.min.js','js')?>"></script>
	<!-- 全局js调用 -->
	<script type="text/javascript" src="<?=assets::js('global.js')?>"></script>
	<!-- 当前页面使用的第三方类库的js -->
	<script type="text/javascript" src="<?=assets::js('datatables.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('spop.min.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('tab.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('jquery.modal.js')?>"></script>
	<script>
$.ajaxSetup({
	headers: {
		'__token__': '<?=Request::token('__token__')?>' ,
	} ,
});

var room_order_print = function(){
	$.post('<?=url('RoomOrder/print')?>',{orderno:'<?=Request::get('orderno')?>'},function(response){
		var bk = window.document.body.innerHTML;
		window.document.body.innerHTML = response;
		window.print();
		window.document.body.innerHTML = bk;
	});
};

var APP=function(){
	var format=function(json){
		var reg=null,
			result='';
			pad=0,
			PADDING='    ';
		if (typeof json !== 'string') {
			json = JSON.stringify(json);
		} else {
			json = JSON.parse(json);
			json = JSON.stringify(json);
		}
		// 在大括号前后添加换行
		reg = /([\{\}])/g;
		json = json.replace(reg, '\r\n$1\r\n');
		// 中括号前后添加换行
		reg = /([\[\]])/g;
		json = json.replace(reg, '\r\n$1\r\n');
		// 逗号后面添加换行
		reg = /(\,)/g;
		json = json.replace(reg, '$1\r\n');
		// 去除多余的换行
		reg = /(\r\n\r\n)/g;
		json = json.replace(reg, '\r\n');
		// 逗号前面的换行去掉
		reg = /\r\n\,/g;
		json = json.replace(reg, ',');
		//冒号前面缩进
		reg = /\:/g;
		json = json.replace(reg, ': ');
		//对json按照换行进行切分然后处理每一个小块
		$.each(json.split('\r\n'), function(index, node) {
			var i = 0,
				indent = 0,
				padding = '';
			//这里遇到{、[时缩进等级加1，遇到}、]时缩进等级减1，没遇到时缩进等级不变
			if (node.match(/\{$/) || node.match(/\[$/)) {
				indent = 1;
			} else if (node.match(/\}/) || node.match(/\]/)) {
				if (pad !== 0) {
					pad -= 1;
				}
			} else {
				indent = 0;
			}
			   //padding保存实际的缩进
			for (i = 0; i < pad; i++) {
				padding += PADDING;
			}
			//添加代码高亮
			node = node.replace(/([\{\}])/g,"<span class='ObjectBrace'>$1</span>");
			node = node.replace(/([\[\]])/g,"<span class='ArrayBrace'>$1</span>");
			node = node.replace(/(\".*\")(\:)(.*)(\,)?/g,"<span class='PropertyName'>$1</span>$2$3$4");
			node = node.replace(/\"([^"]*)\"(\,)?$/g,"<span class='String'>\"$1\"</span><span class='Comma'>$2</span>");
			node = node.replace(/(-?\d+)(\,)?$/g,"<span class='Number'>$1</span><span class='Comma'>$2</span>");
			result += padding + node + '<br>';
			pad += indent;
		});
		return result;
	};
	return {
		"format":format,
	};
}();

$('.json').on('click',function(){
	$('#jsonModal').modal('show');
	$('#jsonModal .modal-body').html(APP.format($(this).attr('data-json')));
});

tab.init();

$(".mytable").on('click',".olddata",function(){
      var olddata=$(this).attr("data-olddata");
	  olddata=JSON.parse(olddata);
	  var newdata=$(this).attr("data-newdata")
	  newdata=JSON.parse(newdata);
	  var keys=[]
      for (key in olddata)  
		{  
			
		}
	var $div=$("<div class='pupbj'></div>");

	var $olddiv=$("<div class='olddiv'><h4>操作前</h4></div>");
	var $newdiv=$("<div class='newdiv'><h4>操作后</h4></div>");
	for (key in olddata)  {
		if(olddata[key]!=newdata[key]){
			var oldspan=$("<span class='byx'></span>").html(key+':'+olddata[key]);
	   var newspan=$("<span class='byx'></span>").html(key+':'+newdata[key]); 
			}else{
				var oldspan=$("<span></span>").html(key+':'+olddata[key]);
	   var newspan=$("<span></span>").html(key+':'+newdata[key]);
			}
		$olddiv.append(oldspan);
		$newdiv.append(newspan);
	}
	$div.append($olddiv);
	$div.append($newdiv);
	var $back=$("<div class='block'></div>").on("click",function(){
		$div.remove();
		$back.remove();
	}).appendTo($('body'));
	$div.appendTo($('body'));
});
</script>
</body>
</html>
