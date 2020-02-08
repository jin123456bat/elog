<?php
use jin123456bat\assets;
use think\facade\Request;
use jin123456bat\hotelController;
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
							<p>活动触发日志</p>
						</div>
					</div>
					<div class="line">
					</div>
					<table id="table" class="table" data-ajax-url="<?=url('activity/log')?>">
						<thead>
							<tr>
								
								<th>用户</th>
								<th>时间</th>
								<th>IP</th>
								<th>名称</th>
								<th>触发点</th>
								<th>奖励</th>
								<th>备注</th>
								<th>订单号</th>
							</tr>
						</thead>
						<tbody></tbody>
						<tfoot>
							<tr>
								<td colspan="2"></td>
								<td id="split_page" colspan="10"></td>
							</tr>
						</tfoot>
					</table>
				</div>
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
<script>
$.ajaxSetup({
	headers: {
        '__token__': '<?=Request::token('__token__')?>' ,
    } ,
});
</script>
<script type="text/javascript">
$(function(){
	$('.all_checked').on('click',function(){
		$(this).parents('table').find('tbody input[type=checkbox]').prop('checked',$(this).is(':checked'));
	});

	var table = datatables({
		table:$('#table'),
		ajax:{
			data:{
				activity_id:'<?=Request::get('id')?>'
			},
			method:'post',
		},
		columns:[{
			data:'user_id',
			name:'nickname',
		},{
			data:'time',
		},{
			data:'ip',
		},{
			data:'name',
		},{
			data:'event',
			render:function(data,full){
				switch(data)
				{
				case 'create_room_order':return '住房订单创建';
				case 'pay_room_order':return '住房订单支付';
				case 'checkin_room_order':return '住房订单入住';
				case 'checkout_room_order':return '住房订单完结';
				
				case 'create_service_order':return '服务订单创建';
				case 'response_service_order':return '服务订单响应';
				case 'pay_service_order':return '服务订单支付';
				case 'finish_service_order':return '服务订单完结';

				case 'register_member':return '会员注册';
				}
				return '';
			}
		},{
			data:'type',
			render:function(data,full){
				if(data == 'money')
				{
					var money = parseFloat(full.content/100).toFixed(2);
					if(money<1)
					{
						return '余额奖励<br>实际支付金额*'+parseFloat(full.content/100).toFixed(2);
					}
					return '余额奖励<br>'+parseFloat(full.content/100).toFixed(2);
				}
				else if(data == 'score')
				{
					if(full.content == null || full.content == 0)
					{
						return '积分奖励<br>等值金额';
					}
					return '积分奖励<br>'+full.content;
				}
				else if(data == 'coupon')
				{
					return '优惠券<br><div>'+full.content+'</div>';
				} 
				else if(data == 'redpackage')
				{
					var redpackage = parseFloat(full.content/100).toFixed(2);
					if(redpackage<1)
					{
						return '红包奖励<br>实际支付金额*'+parseFloat(full.content/100).toFixed(2);
					}
					return '红包奖励<br>'+parseFloat(full.content/100).toFixed(2);
				}
				else if(data == 'payuser')
				{
					var money = parseFloat(full.content/100).toFixed(2);
					if(money<1)
					{
						return '微信金额奖励<br>实际支付金额*'+parseFloat(full.content/100).toFixed(2);
					}
					return '微信金额奖励<br>'+parseFloat(full.content/100).toFixed(2);
				}
			}
		},{
			data:'remark',
		},{
			data:'orderno',
			render:function(data,full){
				return data==null?'':data;
			}
		},{
			data:'content',
			visible:false,
		},{
			data:'user_id',
			visible:false,
		}],
		sort:{
			time:'desc',
		},
		pagesize:10,
		onRowLoaded:function(row){
			
		}
	});

// 	$('#search').on('submit',function(){
// 		table.search($(this).find('input').val());
// 		return false;
// 	});
});
</script>
</body>
</html>