<?php
use jin123456bat\helper;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
</head>
<style>
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

tr td:first-child {
	text-align: right;
}

tr td {
	vertical-align: top;
}
</style>
<body>
	<table border="1" width="100%">
		<tr>
			<td>订单号:</td>
			<td><?=$room_order['orderno']?> (<?=$room_order['pay_status']==1?'预付':'现付'?>)</td>
		</tr>
		<tr>
			<td>订单途径:</td>
			<td>客人从<?=$room_order['source']=='MP'?'公众号':'小程序'?>下单</td>
		</tr>
		<tr>
			<td>客人姓名:</td>
			<td><?=$room_order['user_nickname']?></td>
		</tr>
		<tr>
			<td>客人信息:</td>
			<td>
			客人姓名:<?=$room_order['person_name']?><br>
			手机号:<?=$room_order['person_telephone']?><br>
			证件类型:<?=Db::name('certificates')->where([
				'id' => $room_order['person_card_type']
			])->value('name')?><br>
			证件号码:<?=$room_order['person_card_no']?>
			</td>
		</tr>
		<tr>
			<td>住宿日期:</td>
			<td><?=$starttime?> 至 <?=$endtime?> <?=$days?>晚</td>
		</tr>
		<tr>
			<td>预订客房:</td>
			<td><?=$room_type_name?> <?=$room_num?>间</td>
		</tr>
		<tr>
			<td>房价:</td>
			<td>
			<?php foreach ($room_order_date as $date){?>
			<div><?=$date['date']?>  <?=helper::money_format($date['actual_price'])?></div>
			<?php }?>
			</td>
		</tr>
		<tr>
			<td>付款方式:</td>
			<td>
								金额:<?=helper::money_format($room_order['price'] + $room_order['voucher_price'] + $room_order['deposit_price'])?> <?=$room_order['voucher_price']>0?('(包含券:'.helper::money_format($room_order['voucher_price']).')'):''?> <?=$room_order['voucher_price']>0?('(包含押金:'.helper::money_format($room_order['deposit_price']).')'):''?><br>
								优惠:<?=helper::money_format($room_order['special_price'] + $room_order['paymethod_special_price'] + $room_order['coupon_price'])?><br>
								应付:<?=helper::money_format($room_order['actual_price'])?><br>
								已付:<?=helper::money_format($room_order['pay_price']+$room_order['money_price'])?><br>
			</td>
		</tr>
		<tr>
			<td>备注:</td>
			<td><?=$room_order['remark']?></td>
		</tr>
		<tr>
			<td>订单状态:</td>
			<td><?=helper::getRoomOrderStatusText($room_order)?></td>
		</tr>
	</table>
</body>
</html>
