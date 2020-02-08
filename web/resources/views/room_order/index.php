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
<link rel="stylesheet" href="<?=assets::css('datatables.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('tab.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('button.loading.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('datetimepicker.css')?>" type="text/css" media="all" />
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
							<a class="tab-title active" href="#all">
							全部订单
							</a>
							<a class="tab-title" href="#sure">
								待接单
								<span class="tab-title-label display-none">0</span>
							</a>
							<a class="tab-title" href="#checkin">
								待验证
								<span class="tab-title-label display-none">0</span>
							</a>
							<a class="tab-title" href="#checkout">
								待完结
								<span class="tab-title-label display-none">0</span>
							</a>
							<a class="tab-title" href="#quit">
								申请取消
								<span class="tab-title-label display-none">0</span>
							</a>
							<a class="tab-title" href="#status_checkout">
								已完结
							</a>
						</div>
						<div class="tab-body">
							<div class="tab-page active" id="all">
								<!-- 所有订单列表 -->
								<div class="line"></div>
								<div class="top-tips">
									<div class="top-tips-title">操作提示</div>
									<div class="top-tips-body">
										<p>住房订单列表</p>
									</div>
								</div>
								<div class="line">
									<form class="search col-md-10" style="display: inline-block;">
										<input type="text" name="keywords" placeholder="订单号/预定人/证件号码/下单用户" class="input_text col-md-2">
										<input type="text" name="starttime" placeholder="创建开始时间" class="input_text datepicker">
										<input type="text" name="endtime" placeholder="创建结束时间" class="input_text datepicker">
										<button class="button primary" type="submit">搜索</button>
										<button class="button primary" type="button">导出</button>
										<div class="checkbox col-md-1">
											<input type="checkbox" id="show_quit_order">
											<label for="show_quit_order">显示全部订单</label>
										</div>
									</form>
								</div>
								<div class="tablebox">
									<table class="table" data-ajax-url="<?=url('room_order/index')?>">
										<thead>
											<tr>
												<th>
													<input type="checkbox" class="all_checked">
												</th>
												<th style="min-width: 158px;">订单号</th>
												<th>酒店名称</th>
												<th style="min-width: 127px;">订单时间</th>
												<th>用户名</th>
												<th style="min-width: 227px; max-width: 250px;">预定房型</th>
												<th>实体券</th>
												<th>发票</th>
												<th style="min-width: 64px;">订单状态</th>
												<th style="min-width: 120px;">金额明细</th>
												<th style="min-width: 120px;">支付明细</th>
												<th style="min-width: 170px;">预定人</th>
												<th>操作</th>
											</tr>
										</thead>
										<tbody></tbody>
										<tfoot>
											<tr>
												<td colspan="4"></td>
												<td id="split_page" colspan="20"></td>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
							<div class="tab-page" id="sure">
								<!-- 待接单的订单列表 -->
								<div class="line"></div>
								<div class="top-tips">
									<div class="top-tips-title">操作提示</div>
									<div class="top-tips-body">
										<p>待接单的订单列表</p>
									</div>
								</div>
								<div class="line">
									<form class="col-md-10 search">
										<input type="text" name="keywords" placeholder="订单号/预定人/证件号码/下单用户" class="input_text col-md-2">
										<input type="text" name="starttime" placeholder="创建开始时间" class="input_text datepicker">
										<input type="text" name="endtime" placeholder="创建结束时间" class="input_text datepicker">
										<button class="button primary" type="submit">搜索</button>
										<button class="button primary" type="button">导出</button>
									</form>
								</div>
								<div class="tablebox">
									<table class="table" data-ajax-url="<?=url('room_order/index')?>">
										<thead>
											<tr>
												<th>
													<input type="checkbox" class="all_checked">
												</th>
												<th style="min-width: 158px;">订单号</th>
												<th>酒店名称</th>
												<th style="min-width: 127px;">订单时间</th>
												<th>用户名</th>
												<th style="min-width: 227px; max-width: 250px;">预定房型</th>
												<th>实体券</th>
												<th>发票</th>
												<th style="min-width: 64px;">订单状态</th>
												<th style="min-width: 120px;">金额明细</th>
												<th style="min-width: 120px;">支付明细</th>
												<th style="min-width: 170px;">预定人</th>
												<th>操作</th>
											</tr>
										</thead>
										<tbody></tbody>
										<tfoot>
											<tr>
												<td colspan="4"></td>
												<td id="split_page" colspan="20"></td>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
							<div class="tab-page" id="checkin">
								<!-- 待入住的订单列表 -->
								<div class="line"></div>
								<div class="top-tips">
									<div class="top-tips-title">操作提示</div>
									<div class="top-tips-body">
										<p>待入住/验证的订单列表</p>
									</div>
								</div>
								<div class="line">
									<form class="col-md-10 search">
										<input type="text" name="keywords" placeholder="订单号/预定人/证件号码/下单用户" class="input_text col-md-2">
										<input type="text" name="starttime" placeholder="创建开始时间" class="input_text datepicker">
										<input type="text" name="endtime" placeholder="创建结束时间" class="input_text datepicker">
										<button class="button primary" type="submit">搜索</button>
										<button class="button primary" type="button">导出</button>
									</form>
								</div>
								<div class="tablebox">
									<table class="table" data-ajax-url="<?=url('room_order/index')?>">
										<thead>
											<tr>
												<th>
													<input type="checkbox" class="all_checked">
												</th>
												<th style="min-width: 158px;">订单号</th>
												<th>酒店名称</th>
												<th style="min-width: 127px;">订单时间</th>
												<th>用户名</th>
												<th style="min-width: 227px; max-width: 250px;">预定房型</th>
												<th>实体券</th>
												<th>发票</th>
												<th style="min-width: 64px;">订单状态</th>
												<th style="min-width: 120px;">金额明细</th>
												<th style="min-width: 120px;">支付明细</th>
												<th style="min-width: 170px;">预定人</th>
												<th>操作</th>
											</tr>
										</thead>
										<tbody></tbody>
										<tfoot>
											<tr>
												<td colspan="4"></td>
												<td id="split_page" colspan="20"></td>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
							<div class="tab-page" id="checkout">
								<!-- ·经入住 要离店的订单列表 -->
								<div class="line"></div>
								<div class="top-tips">
									<div class="top-tips-title">操作提示</div>
									<div class="top-tips-body">
										<p>已经入住 要离店的订单列表</p>
									</div>
								</div>
								<div class="line">
									<form class="col-md-10 search">
										<input type="text" name="keywords" placeholder="订单号/预定人/证件号码/下单用户" class="input_text col-md-2">
										<input type="text" name="starttime" placeholder="创建开始时间" class="input_text datepicker">
										<input type="text" name="endtime" placeholder="创建结束时间" class="input_text datepicker">
										<button class="button primary" type="submit">搜索</button>
										<button class="button primary" type="button">导出</button>
									</form>
								</div>
								<div class="tablebox">
									<table class="table" data-ajax-url="<?=url('room_order/index')?>">
										<thead>
											<tr>
												<th>
													<input type="checkbox" class="all_checked">
												</th>
												<th style="min-width: 158px;">订单号</th>
												<th>酒店名称</th>
												<th style="min-width: 127px;">订单时间</th>
												<th>用户名</th>
												<th style="min-width: 227px; max-width: 250px;">预定房型</th>
												<th>实体券</th>
												<th>发票</th>
												<th style="min-width: 64px;">订单状态</th>
												<th style="min-width: 120px;">金额明细</th>
												<th style="min-width: 120px;">支付明细</th>
												<th style="min-width: 170px;">预定人</th>
												<th>操作</th>
											</tr>
										</thead>
										<tbody></tbody>
										<tfoot>
											<tr>
												<td colspan="4"></td>
												<td id="split_page" colspan="20"></td>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
							<div class="tab-page" id="quit">
								<!-- 申请取消的住房订单列表 -->
								<div class="line"></div>
								<div class="top-tips">
									<div class="top-tips-title">操作提示</div>
									<div class="top-tips-body">
										<p>申请取消的住房订单列表</p>
									</div>
								</div>
								<div class="line">
									<form class="col-md-10 search">
										<input type="text" name="keywords" placeholder="订单号/预定人/证件号码/下单用户" class="input_text col-md-2">
										<input type="text" name="starttime" placeholder="创建开始时间" class="input_text datepicker">
										<input type="text" name="endtime" placeholder="创建结束时间" class="input_text datepicker">
										<button class="button primary" type="submit">搜索</button>
										<button class="button primary" type="button">导出</button>
									</form>
								</div>
								<div class="tablebox">
									<table class="table" data-ajax-url="<?=url('room_order/index')?>">
										<thead>
											<tr>
												<th>
													<input type="checkbox" class="all_checked">
												</th>
												<th style="min-width: 158px;">订单号</th>
												<th>酒店名称</th>
												<th style="min-width: 127px;">订单时间</th>
												<th>用户名</th>
												<th style="min-width: 227px; max-width: 250px;">预定房型</th>
												<th>实体券</th>
												<th>发票</th>
												<th style="min-width: 64px;">订单状态</th>
												<th style="min-width: 120px;">金额明细</th>
												<th style="min-width: 120px;">支付明细</th>
												<th style="min-width: 170px;">预定人</th>
												<th>操作</th>
											</tr>
										</thead>
										<tbody></tbody>
										<tfoot>
											<tr>
												<td colspan="4"></td>
												<td id="split_page" colspan="20"></td>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
							
							<div class="tab-page" id="status_checkout">
								<!-- 已完结的订单列表 -->
								<div class="line"></div>
								<div class="top-tips">
									<div class="top-tips-title">操作提示</div>
									<div class="top-tips-body">
										<p>已完结的订单列表</p>
									</div>
								</div>
								<div class="line">
									<form class="col-md-10 search">
										<input type="text" name="keywords" placeholder="订单号/预定人/证件号码/下单用户" class="input_text col-md-2">
										<input type="text" name="starttime" placeholder="创建开始时间" class="input_text datepicker">
										<input type="text" name="endtime" placeholder="创建结束时间" class="input_text datepicker">
										<button class="button primary" type="submit">搜索</button>
										<button class="button primary" type="button">导出</button>
									</form>
								</div>
								<div class="tablebox">
									<table class="table" data-ajax-url="<?=url('room_order/index')?>">
										<thead>
											<tr>
												<th>
													<input type="checkbox" class="all_checked">
												</th>
												<th style="min-width: 158px;">订单号</th>
												<th>酒店名称</th>
												<th style="min-width: 127px;">订单时间</th>
												<th>用户名</th>
												<th style="min-width: 227px; max-width: 250px;">预定房型</th>
												<th>实体券</th>
												<th>发票</th>
												<th style="min-width: 64px;">订单状态</th>
												<th style="min-width: 120px;">金额明细</th>
												<th style="min-width: 120px;">支付明细</th>
												<th style="min-width: 170px;">预定人</th>
												<th>操作</th>
											</tr>
										</thead>
										<tbody></tbody>
										<tfoot>
											<tr>
												<td colspan="4"></td>
												<td id="split_page" colspan="20"></td>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
							
						</div>
					</div>
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
	<script type="text/javascript" src="<?=assets::js('jquery.dialog.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('tab.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('button.loading.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('datetimepicker.js')?>"></script>
	<script>
	$.ajaxSetup({
		headers: {
			'__token__': '<?=Request::token('__token__')?>' ,
		},
	});
	</script>
	<script type="text/javascript">
	$('.datepicker').each(function(){
		$(this).datetimepicker({
			select:'date',
		});
	});

	$('.all_checked').on('click',function(){
		$(this).parents('table').find('tbody input[type=checkbox]').prop('checked',$(this).is(':checked'));
	});

	var all = datatables({
		table:$('#all .table'),
		ajax:{
			data:{
			},
			method:'post',
		},
		columns:[{
			data:'orderno',
			pk:true,
			render:function(data,full){
				return '<input type="checkbox" name="id[]" value="'+data+'">';
			}
		},{
			data:'orderno',
		},{
			data:'hotel_name',
		},{
			data:'createtime',
		},{
			data:'user_username',
			render:function(data,full){
				return '用户名:'+(full.user_username==null?'':full.user_username)+'<br>昵称:'+full.user_nickname;
			},
			style: 'text-align:left',
		},{
			data:'room_type_detail',
			style: 'text-align:left',
			render:function(data,full){
				var content = '';
				$.each(data,function(index,value){
					content += '<div style="display: flex;padding-left: 5px;text-align: left;"><div><img src="'+value.room_type_logo+'"></div><div><div>['+value.room_type_name+']'+value.starttime+'~'+value.endtime+'('+value.days+'天)</div><div>预计'+value.arrive+'到达[押金:￥'+parseFloat(value.deposit_price/100).toFixed(2)+']</div><div style="max-width: 250px;text-align: left;">备注:'+value.remark+'</div></div></div>';
				});
				return content;
			}
		},{
			data:'voucher',
			render:function(data,full){
				var content = [];
				$.each(data,function(index,value){
					content.push(value.voucher_name+' x'+value.num+' (￥'+parseFloat(value.actual_price/100).toFixed(2)+')');
				});
				return content.join('<br>');
			}
		},{
			data:'invoice_type',
			render:function(data,full){
				if(data == null)
				{
					return '';
				}
				else
				{
					content = [];
					if(data==1)
					{
						content.push('发票类型:'+(data==1?'增值税专用发票':'增值税普通发票'));
						content.push('发票抬头:'+full.invoice_company_name);
						content.push('信用代码:'+full.invoice_company_no);
						content.push('注册地址:'+full.invoice_company_address);
						content.push('公司电话:'+full.invoice_company_phone);
						content.push('开户银行:'+full.invoice_company_bank);
						content.push('开户账号:'+full.invoice_company_bankno);
						return '<div style="text-align: left;white-space: normal;max-width:200px;min-width: 150px;">'+content.join('</div><div style="text-align: left;white-space: normal;max-width:200px;min-width: 150px;">')+'</div>';
					}
					else if(data==0)
					{
						content.push('发票类型:'+(data==1?'增值税专用发票':'增值税普通发票'));
						content.push('发票抬头:'+full.invoice_company_name);
						content.push('信用代码:'+full.invoice_company_no);
						return '<div style="text-align: left;white-space: normal;max-width:200px;min-width: 150px;">'+content.join('</div><div style="text-align: left;white-space: normal;max-width:200px;min-width: 150px;">')+'</div>';
					}
				}
			}
		},{
			data:'room_order_status_text',
			render:function(data,full){
				var content = data;
				if(full.status==2)
				{
					content += '<br>（'+full.cancel_reason+'）';
				}
				else if(full.status==0)
				{
					if(full.cancel_reason.length>0)
					{
						content += '<br>（'+full.cancel_reason+'）';
					}
					if(full.sure_reason)
					{
						content += '<br>（'+full.sure_reason+'）';
					}
				}
				return content;
			}
		},{
			data:'price',
			render:function(data,full){
				content = '<div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>住房金额:</div><div>'+parseFloat(full.price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>支付优惠金额:</div><div>'+parseFloat(full.paymethod_special_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>特惠金额:</div><div>-'+parseFloat(full.special_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>优惠券:</div><div>-'+parseFloat(full.coupon_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>实体券金额:</div><div>'+parseFloat(full.voucher_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>押金:</div><div>'+parseFloat(full.deposit_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>订单金额:</div><div>'+parseFloat(full.actual_price/100).toFixed(2)+'</div></div>';
				content += '</div>';
				return content;
			}
		},{
			data:'pay_price',
			render:function(data,full){
				content = '<div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>支付方式:</div><div>'+full.pay_method_name+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>支付渠道:</div><div>'+(full.pay_online==1?'线上支付':'线下支付')+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>余额支付:</div><div>'+parseFloat(full.money_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>在线支付:</div><div>'+parseFloat(full.pay_price/100).toFixed(2)+'</div></div>';
				content += '</div>';
				return content;
			}
		},{
			data:'person_name',
			render:function(data,full){
				content = '<div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>姓名:</div><div>'+full.person_name+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>手机:</div><div>'+full.person_telephone+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>证件:</div><div>'+full.person_card_type_name+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>号码:</div><div>'+full.person_card_no+'</div></div>';
				content += '</div>';
				return content;
			}
		},{
			data:'orderno',
			render:function(data,full){
				content = '';
				content += '<a class="button button-xs" href="<?=url('RoomOrder/detail')?>?orderno='+data+'">查看</a>';
				return content;
			}
		},{
			data:'notcheckin',
			visible:false,
		},{
			data:'user_nickname',
			visible:false,
		},{
			data:'voucher_price',
			visible:false,
		},{
			data:'deposit_price',
			visible:false,
		},{
			data:'special_price',
			visible:false,
		},{
			data:'coupon_price',
			visible:false,
		},{
			data:'actual_price',
			visible:false,
		},{
			data:'money_price',
			visible:false,
		},{
			data:'pay_method_name',
			visible:false,
		},{
			data:'status',
			visible:false,
		},{
			data:'sure',
			visible:false,
		},{
			data:'cancel',
			visible:false,
		},{
			data:'pay_method',
			visible:false,
		},{
			data:'pay_online',
			visible:false,
		},{
			data:'person_telephone',
			visible:false,
		},{
			data:'person_card_type',
			visible:false,
		},{
			data:'person_card_no',
			visible:false,
		},{
			data:'checkin',
			visible:false,
		},{
			data:'pay_status',
			visible:false,
		},{
			data:'checkout',
			visible:false,
		},{
			data:'evaluate',
			visible:false,
		},{
			data:'coupon',
			visible:false
		},{
			data:'cancel_reason',
			visible:false,
		},{
			data:'invoice_company_name',
			visible:false,
		},{
			data:'invoice_company_no',
			visible:false,
		},{
			data:'invoice_company_address',
			visible:false,
		},{
			data:'invoice_company_phone',
			visible:false,
		},{
			data:'invoice_company_bank',
			visible:false,
		},{
			data:'invoice_company_bankno',
			visible:false,
		},{
			data:'paymethod_special_price',
			visible:false,
		}],
		sort:{
			createtime:'desc',
		},
		pagesize:10,
		onRowLoaded:function(row){

		}
	});

	$('#all .search').on('submit',function(){
		all.addAjaxParameter('keywords',$(this).find('input[name=keywords]').val());
		all.addAjaxParameter('starttime',$(this).find('input[name=starttime]').val());
		all.addAjaxParameter('endtime',$(this).find('input[name=endtime]').val());
		all.addAjaxParameter('with_not_payed',$(this).find('#show_quit_order').is(':checked'));
		all.page(0);
		all.reload();
		return false;
	});
	
	//导出
	$('#all .search button[type=button]').on('click',function(){
		var data = {
			keywords:$('#all .search input[name=keywords]').val(),
			starttime:$('#all .search input[name=starttime]').val(),
			endtime:$('#all .search input[name=endtime]').val(),
			with_not_payed:$('#show_quit_order').is(':checked'),
			ajaxData:all.getAjaxData(),
			order:all.getOrderData(),
		};
		var query_string = $.http_build_query(data);
		window.location = '<?=url('room_order/export_room_order')?>?'+query_string;
		return false;
	});

	$('#show_quit_order').on('change',function(){
		all.addAjaxParameter('keywords',$(this).find('input[name=keywords]').val());
		all.addAjaxParameter('starttime',$(this).find('input[name=starttime]').val());
		all.addAjaxParameter('endtime',$(this).find('input[name=endtime]').val());
		all.addAjaxParameter('with_not_payed',$(this).is(':checked'));
		all.page(0);
		all.reload();
	});

	var sure = datatables({
		table:$('#sure .table'),
		ajax:{
			data:{
				status:1,
				sure:0,
			},
			method:'post',
		},
		columns:[{
			data:'orderno',
			pk:true,
			render:function(data,full){
				return '<input type="checkbox" name="id[]" value="'+data+'">';
			}
		},{
			data:'orderno',
		},{
			data:'hotel_name',
		},{
			data:'createtime',
		},{
			data:'user_username',
			render:function(data,full){
				return '用户名:'+(full.user_username==null?'':full.user_username)+'<br>昵称:'+full.user_nickname;
			},
			style: 'text-align:left',
		},{
			data:'room_type_detail',
			style: 'text-align:left',
			render:function(data,full){
				var content = '';
				$.each(data,function(index,value){
					content += '<div style="display: flex;padding-left: 5px;text-align: left;"><div><img src="'+value.room_type_logo+'"></div><div><div>['+value.room_type_name+']'+value.starttime+'~'+value.endtime+'('+value.days+'天)</div><div>预计'+value.arrive+'到达[押金:￥'+parseFloat(value.deposit_price/100).toFixed(2)+']</div><div style="max-width: 250px;text-align: left;">备注:'+value.remark+'</div></div></div>';
				});
				return content;
			}
		},{
			data:'voucher',
			render:function(data,full){
				var content = [];
				$.each(data,function(index,value){
					content.push(value.voucher_name+' x'+value.num+' (￥'+parseFloat(value.actual_price/100).toFixed(2)+')');
				});
				return content.join('<br>');
			}
		},{
			data:'invoice_type',
			render:function(data,full){
				if(data == null)
				{
					return '';
				}
				else
				{
					content = [];
					if(data==1)
					{
						content.push('发票类型:'+(data==1?'增值税专用发票':'增值税普通发票'));
						content.push('发票抬头:'+full.invoice_company_name);
						content.push('信用代码:'+full.invoice_company_no);
						content.push('注册地址:'+full.invoice_company_address);
						content.push('公司电话:'+full.invoice_company_phone);
						content.push('开户银行:'+full.invoice_company_bank);
						content.push('开户账号:'+full.invoice_company_bankno);
						return '<div style="text-align: left;white-space: normal;max-width:200px;min-width: 150px;">'+content.join('</div><div style="text-align: left;white-space: normal;max-width:200px;min-width: 150px;">')+'</div>';
					}
					else if(data==0)
					{
						content.push('发票类型:'+(data==1?'增值税专用发票':'增值税普通发票'));
						content.push('发票抬头:'+full.invoice_company_name);
						content.push('信用代码:'+full.invoice_company_no);
						return '<div style="text-align: left;white-space: normal;max-width:200px;min-width: 150px;">'+content.join('</div><div style="text-align: left;white-space: normal;max-width:200px;min-width: 150px;">')+'</div>';
					}
				}
			}
		},{
			data:'room_order_status_text',
			render:function(data,full){
				var content = data;
				if(full.status==2)
				{
					content += '<br>（'+full.cancel_reason+'）';
				}
				else if(full.status==0)
				{
					if(full.cancel_reason.length>0)
					{
						content += '<br>（'+full.cancel_reason+'）';
					}
					if(full.sure_reason)
					{
						content += '<br>（'+full.sure_reason+'）';
					}
				}
				return content;
			}
		},{
			data:'price',
			render:function(data,full){
				content = '<div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>住房金额:</div><div>'+parseFloat(full.price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>支付优惠金额:</div><div>'+parseFloat(full.paymethod_special_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>特惠金额:</div><div>-'+parseFloat(full.special_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>优惠券:</div><div>-'+parseFloat(full.coupon_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>实体券金额:</div><div>'+parseFloat(full.voucher_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>押金:</div><div>'+parseFloat(full.deposit_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>订单金额:</div><div>'+parseFloat(full.actual_price/100).toFixed(2)+'</div></div>';
				content += '</div>';
				return content;
			}
		},{
			data:'pay_price',
			render:function(data,full){
				content = '<div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>支付方式:</div><div>'+full.pay_method_name+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>支付渠道:</div><div>'+(full.pay_online==1?'线上支付':'线下支付')+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>余额支付:</div><div>'+parseFloat(full.money_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>在线支付:</div><div>'+parseFloat(full.pay_price/100).toFixed(2)+'</div></div>';
				content += '</div>';
				return content;
			}
		},{
			data:'person_name',
			render:function(data,full){
				content = '<div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>姓名:</div><div>'+full.person_name+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>手机:</div><div>'+full.person_telephone+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>证件:</div><div>'+full.person_card_type_name+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>号码:</div><div>'+full.person_card_no+'</div></div>';
				content += '</div>';
				return content;
			}
		},{
			data:'orderno',
			render:function(data,full){
				content = '';
				content += '<a class="button button-xs" href="<?=url('RoomOrder/detail')?>?orderno='+data+'">查看</a>';
				return content;
			}
		},{
			data:'notcheckin',
			visible:false,
		},{
			data:'user_nickname',
			visible:false,
		},{
			data:'deposit_price',
			visible:false,
		},{
			data:'voucher_price',
			visible:false,
		},{
			data:'special_price',
			visible:false,
		},{
			data:'coupon_price',
			visible:false,
		},{
			data:'actual_price',
			visible:false,
		},{
			data:'money_price',
			visible:false,
		},{
			data:'pay_method_name',
			visible:false,
		},{
			data:'status',
			visible:false,
		},{
			data:'sure',
			visible:false,
		},{
			data:'cancel',
			visible:false,
		},{
			data:'pay_method',
			visible:false,
		},{
			data:'pay_online',
			visible:false,
		},{
			data:'person_telephone',
			visible:false,
		},{
			data:'person_card_type',
			visible:false,
		},{
			data:'person_card_no',
			visible:false,
		},{
			data:'checkin',
			visible:false,
		},{
			data:'pay_status',
			visible:false,
		},{
			data:'checkout',
			visible:false,
		},{
			data:'evaluate',
			visible:false,
		},{
			data:'coupon',
			visible:false
		},{
			data:'cancel_reason',
			visible:false,
		},{
			data:'invoice_company_name',
			visible:false,
		},{
			data:'invoice_company_no',
			visible:false,
		},{
			data:'invoice_company_address',
			visible:false,
		},{
			data:'invoice_company_phone',
			visible:false,
		},{
			data:'invoice_company_bank',
			visible:false,
		},{
			data:'invoice_company_bankno',
			visible:false,
		},{
			data:'paymethod_special_price',
			visible:false,
		}],
		sort:{
			createtime:'desc',
		},
		pagesize:10,
		onRowLoaded:function(row){

		},
		afterTableLoaded:function(table,response){
			var obj = $('a.tab-title[href="#sure"] .tab-title-label');
			if(response.total>0)
			{
				obj.removeClass('display-none').html(response.total);
			}
			else
			{
				obj.addClass('display-none')
			}
		}
	});

	$('#sure .search').on('submit',function(){
		sure.addAjaxParameter('keywords',$(this).find('input[name=keywords]').val());
		sure.addAjaxParameter('starttime',$(this).find('input[name=starttime]').val());
		sure.addAjaxParameter('endtime',$(this).find('input[name=endtime]').val());
		sure.page(0);
		sure.reload();
		return false;
	});

	//导出
	$('#sure .search button[type=button]').on('click',function(){
		var data = {
			keywords:$('#sure .search input[name=keywords]').val(),
			starttime:$('#sure .search input[name=starttime]').val(),
			endtime:$('#sure .search input[name=endtime]').val(),
			ajaxData:sure.getAjaxData(),
			order:sure.getOrderData(),
		};
		var query_string = $.http_build_query(data);
		window.location = '<?=url('room_order/export_room_order')?>?'+query_string;
		return false;
	});

	var checkin = datatables({
		table:$('#checkin .table'),
		ajax:{
			data:{
				status:1,
				sure:1,
				checkin:[0,2]
			},
			method:'post',
		},
		columns:[{
			data:'orderno',
			pk:true,
			render:function(data,full){
				return '<input type="checkbox" name="id[]" value="'+data+'">';
			}
		},{
			data:'orderno',
		},{
			data:'hotel_name',
		},{
			data:'createtime',
		},{
			data:'user_username',
			render:function(data,full){
				return '用户名:'+(full.user_username==null?'':full.user_username)+'<br>昵称:'+full.user_nickname;
			},
			style: 'text-align:left',
		},{
			data:'room_type_detail',
			style: 'text-align:left',
			render:function(data,full){
				var content = '';
				$.each(data,function(index,value){
					content += '<div style="display: flex;padding-left: 5px;text-align: left;"><div><img src="'+value.room_type_logo+'"></div><div><div>['+value.room_type_name+']'+value.starttime+'~'+value.endtime+'('+value.days+'天)</div><div>预计'+value.arrive+'到达[押金:￥'+parseFloat(value.deposit_price/100).toFixed(2)+']</div><div style="max-width: 250px;text-align: left;">备注:'+value.remark+'</div></div></div>';
				});
				return content;
			}
		},{
			data:'voucher',
			render:function(data,full){
				var content = [];
				$.each(data,function(index,value){
					content.push(value.voucher_name+' x'+value.num+' (￥'+parseFloat(value.actual_price/100).toFixed(2)+')');
				});
				return content.join('<br>');
			}
		},{
			data:'invoice_type',
			render:function(data,full){
				if(data == null)
				{
					return '';
				}
				else
				{
					content = [];
					if(data==1)
					{
						content.push('发票类型:'+(data==1?'增值税专用发票':'增值税普通发票'));
						content.push('发票抬头:'+full.invoice_company_name);
						content.push('信用代码:'+full.invoice_company_no);
						content.push('注册地址:'+full.invoice_company_address);
						content.push('公司电话:'+full.invoice_company_phone);
						content.push('开户银行:'+full.invoice_company_bank);
						content.push('开户账号:'+full.invoice_company_bankno);
						return '<div style="text-align: left;white-space: normal;max-width:200px;min-width: 150px;">'+content.join('</div><div style="text-align: left;white-space: normal;max-width:200px;min-width: 150px;">')+'</div>';
					}
					else if(data==0)
					{
						content.push('发票类型:'+(data==1?'增值税专用发票':'增值税普通发票'));
						content.push('发票抬头:'+full.invoice_company_name);
						content.push('信用代码:'+full.invoice_company_no);
						return '<div style="text-align: left;white-space: normal;max-width:200px;min-width: 150px;">'+content.join('</div><div style="text-align: left;white-space: normal;max-width:200px;min-width: 150px;">')+'</div>';
					}
				}
			}
		},{
			data:'room_order_status_text',
			render:function(data,full){
				var content = data;
				if(full.status==2)
				{
					content += '<br>（'+full.cancel_reason+'）';
				}
				else if(full.status==0)
				{
					if(full.cancel_reason.length>0)
					{
						content += '<br>（'+full.cancel_reason+'）';
					}
					if(full.sure_reason)
					{
						content += '<br>（'+full.sure_reason+'）';
					}
				}
				return content;
			}
		},{
			data:'price',
			render:function(data,full){
				content = '<div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>住房金额:</div><div>'+parseFloat(full.price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>支付优惠金额:</div><div>'+parseFloat(full.paymethod_special_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>特惠金额:</div><div>-'+parseFloat(full.special_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>优惠券:</div><div>-'+parseFloat(full.coupon_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>实体券金额:</div><div>'+parseFloat(full.voucher_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>押金:</div><div>'+parseFloat(full.deposit_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>订单金额:</div><div>'+parseFloat(full.actual_price/100).toFixed(2)+'</div></div>';
				content += '</div>';
				return content;
			}
		},{
			data:'pay_price',
			render:function(data,full){
				content = '<div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>支付方式:</div><div>'+full.pay_method_name+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>支付渠道:</div><div>'+(full.pay_online==1?'线上支付':'线下支付')+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>余额支付:</div><div>'+parseFloat(full.money_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>在线支付:</div><div>'+parseFloat(full.pay_price/100).toFixed(2)+'</div></div>';
				content += '</div>';
				return content;
			}
		},{
			data:'person_name',
			render:function(data,full){
				content = '<div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>姓名:</div><div>'+full.person_name+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>手机:</div><div>'+full.person_telephone+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>证件:</div><div>'+full.person_card_type_name+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>号码:</div><div>'+full.person_card_no+'</div></div>';
				content += '</div>';
				return content;
			}
		},{
			data:'orderno',
			render:function(data,full){
				content = '';
				content += '<a class="button button-xs" href="<?=url('RoomOrder/detail')?>?orderno='+data+'">查看</a>';
				return content;
			}
		},{
			data:'notcheckin',
			visible:false,
		},{
			data:'user_nickname',
			visible:false,
		},{
			data:'deposit_price',
			visible:false,
		},{
			data:'voucher_price',
			visible:false,
		},{
			data:'special_price',
			visible:false,
		},{
			data:'coupon_price',
			visible:false,
		},{
			data:'actual_price',
			visible:false,
		},{
			data:'money_price',
			visible:false,
		},{
			data:'pay_method_name',
			visible:false,
		},{
			data:'status',
			visible:false,
		},{
			data:'sure',
			visible:false,
		},{
			data:'cancel',
			visible:false,
		},{
			data:'pay_method',
			visible:false,
		},{
			data:'pay_online',
			visible:false,
		},{
			data:'person_telephone',
			visible:false,
		},{
			data:'person_card_type',
			visible:false,
		},{
			data:'person_card_no',
			visible:false,
		},{
			data:'checkin',
			visible:false,
		},{
			data:'pay_status',
			visible:false,
		},{
			data:'checkout',
			visible:false,
		},{
			data:'evaluate',
			visible:false,
		},{
			data:'coupon',
			visible:false
		},{
			data:'cancel_reason',
			visible:false,
		},{
			data:'invoice_company_name',
			visible:false,
		},{
			data:'invoice_company_no',
			visible:false,
		},{
			data:'invoice_company_address',
			visible:false,
		},{
			data:'invoice_company_phone',
			visible:false,
		},{
			data:'invoice_company_bank',
			visible:false,
		},{
			data:'invoice_company_bankno',
			visible:false,
		},{
			data:'paymethod_special_price',
			visible:false,
		}],
		sort:{
			suretime:'desc',
		},
		pagesize:10,
		onRowLoaded:function(row){

		},
		afterTableLoaded:function(table,response){
			var obj = $('a.tab-title[href="#checkin"] .tab-title-label');
			if(response.total>0)
			{
				obj.removeClass('display-none').html(response.total);
			}
			else
			{
				obj.addClass('display-none')
			}
		}
	});
	
	$('#checkin .search').on('submit',function(){
		checkin.addAjaxParameter('keywords',$(this).find('input[name=keywords]').val());
		checkin.addAjaxParameter('starttime',$(this).find('input[name=starttime]').val());
		checkin.addAjaxParameter('endtime',$(this).find('input[name=endtime]').val());
		checkin.page(0);
		checkin.reload();
		return false;
	});

	//导出
	$('#checkin .search button[type=button]').on('click',function(){
		var data = {
			keywords:$('#checkin .search input[name=keywords]').val(),
			starttime:$('#checkin .search input[name=starttime]').val(),
			endtime:$('#checkin .search input[name=endtime]').val(),
			ajaxData:checkin.getAjaxData(),
			order:checkin.getOrderData(),
		};
		var query_string = $.http_build_query(data);
		window.location = '<?=url('room_order/export_room_order')?>?'+query_string;
		return false;
	});
	
	var checkout = datatables({
		table:$('#checkout .table'),
		ajax:{
			data:{
				status:1,
				sure:1,
				checkin:[1,2],
				checkout:[0,2],
			},
			method:'post',
		},
		columns:[{
			data:'orderno',
			pk:true,
			render:function(data,full){
				return '<input type="checkbox" name="id[]" value="'+data+'">';
			}
		},{
			data:'orderno',
		},{
			data:'hotel_name',
		},{
			data:'createtime',
		},{
			data:'user_username',
			render:function(data,full){
				return '用户名:'+(full.user_username==null?'':full.user_username)+'<br>昵称:'+full.user_nickname;
			},
			style: 'text-align:left',
		},{
			data:'room_type_detail',
			style: 'text-align:left',
			render:function(data,full){
				var content = '';
				$.each(data,function(index,value){
					content += '<div style="display: flex;padding-left: 5px;text-align: left;"><div><img src="'+value.room_type_logo+'"></div><div><div>['+value.room_type_name+']'+value.starttime+'~'+value.endtime+'('+value.days+'天)</div><div>预计'+value.arrive+'到达[押金:￥'+parseFloat(value.deposit_price/100).toFixed(2)+']</div><div style="max-width: 250px;text-align: left;">备注:'+value.remark+'</div></div></div>';
				});
				return content;
			}
		},{
			data:'voucher',
			render:function(data,full){
				var content = [];
				$.each(data,function(index,value){
					content.push(value.voucher_name+' x'+value.num+' (￥'+parseFloat(value.actual_price/100).toFixed(2)+')');
				});
				return content.join('<br>');
			}
		},{
			data:'invoice_type',
			render:function(data,full){
				if(data == null)
				{
					return '';
				}
				else
				{
					content = [];
					if(data==1)
					{
						content.push('发票类型:'+(data==1?'增值税专用发票':'增值税普通发票'));
						content.push('发票抬头:'+full.invoice_company_name);
						content.push('信用代码:'+full.invoice_company_no);
						content.push('注册地址:'+full.invoice_company_address);
						content.push('公司电话:'+full.invoice_company_phone);
						content.push('开户银行:'+full.invoice_company_bank);
						content.push('开户账号:'+full.invoice_company_bankno);
						return '<div style="text-align: left;white-space: normal;max-width:200px;min-width: 150px;">'+content.join('</div><div style="text-align: left;white-space: normal;max-width:200px;min-width: 150px;">')+'</div>';
					}
					else if(data==0)
					{
						content.push('发票类型:'+(data==1?'增值税专用发票':'增值税普通发票'));
						content.push('发票抬头:'+full.invoice_company_name);
						content.push('信用代码:'+full.invoice_company_no);
						return '<div style="text-align: left;white-space: normal;max-width:200px;min-width: 150px;">'+content.join('</div><div style="text-align: left;white-space: normal;max-width:200px;min-width: 150px;">')+'</div>';
					}
				}
			}
		},{
			data:'room_order_status_text',
			render:function(data,full){
				var content = data;
				if(full.status==2)
				{
					content += '<br>（'+full.cancel_reason+'）';
				}
				else if(full.status==0)
				{
					if(full.cancel_reason.length>0)
					{
						content += '<br>（'+full.cancel_reason+'）';
					}
					if(full.sure_reason)
					{
						content += '<br>（'+full.sure_reason+'）';
					}
				}
				return content;
			}
		},{
			data:'price',
			render:function(data,full){
				content = '<div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>住房金额:</div><div>'+parseFloat(full.price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>支付优惠金额:</div><div>'+parseFloat(full.paymethod_special_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>特惠金额:</div><div>-'+parseFloat(full.special_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>优惠券:</div><div>-'+parseFloat(full.coupon_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>实体券金额:</div><div>'+parseFloat(full.voucher_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>押金:</div><div>'+parseFloat(full.deposit_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>订单金额:</div><div>'+parseFloat(full.actual_price/100).toFixed(2)+'</div></div>';
				content += '</div>';
				return content;
			}
		},{
			data:'pay_price',
			render:function(data,full){
				content = '<div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>支付方式:</div><div>'+full.pay_method_name+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>支付渠道:</div><div>'+(full.pay_online==1?'线上支付':'线下支付')+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>余额支付:</div><div>'+parseFloat(full.money_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>在线支付:</div><div>'+parseFloat(full.pay_price/100).toFixed(2)+'</div></div>';
				content += '</div>';
				return content;
			}
		},{
			data:'person_name',
			render:function(data,full){
				content = '<div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>姓名:</div><div>'+full.person_name+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>手机:</div><div>'+full.person_telephone+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>证件:</div><div>'+full.person_card_type_name+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>号码:</div><div>'+full.person_card_no+'</div></div>';
				content += '</div>';
				return content;
			}
		},{
			data:'orderno',
			render:function(data,full){
				content = '';
				content += '<a class="button button-xs" href="<?=url('RoomOrder/detail')?>?orderno='+data+'">查看</a>';
				return content;
			}
		},{
			data:'notcheckin',
			visible:false,
		},{
			data:'user_nickname',
			visible:false,
		},{
			data:'deposit_price',
			visible:false,
		},{
			data:'voucher_price',
			visible:false,
		},{
			data:'special_price',
			visible:false,
		},{
			data:'coupon_price',
			visible:false,
		},{
			data:'actual_price',
			visible:false,
		},{
			data:'money_price',
			visible:false,
		},{
			data:'pay_method_name',
			visible:false,
		},{
			data:'status',
			visible:false,
		},{
			data:'sure',
			visible:false,
		},{
			data:'cancel',
			visible:false,
		},{
			data:'pay_method',
			visible:false,
		},{
			data:'pay_online',
			visible:false,
		},{
			data:'person_telephone',
			visible:false,
		},{
			data:'person_card_type',
			visible:false,
		},{
			data:'person_card_no',
			visible:false,
		},{
			data:'checkin',
			visible:false,
		},{
			data:'pay_status',
			visible:false,
		},{
			data:'checkout',
			visible:false,
		},{
			data:'evaluate',
			visible:false,
		},{
			data:'coupon',
			visible:false
		},{
			data:'cancel_reason',
			visible:false,
		},{
			data:'invoice_company_name',
			visible:false,
		},{
			data:'invoice_company_no',
			visible:false,
		},{
			data:'invoice_company_address',
			visible:false,
		},{
			data:'invoice_company_phone',
			visible:false,
		},{
			data:'invoice_company_bank',
			visible:false,
		},{
			data:'invoice_company_bankno',
			visible:false,
		},{
			data:'paymethod_special_price',
			visible:false,
		}],
		sort:{
			createtime:'desc',
		},
		pagesize:10,
		onRowLoaded:function(row){

		},
		afterTableLoaded:function(table,response){
			var obj = $('a.tab-title[href="#checkout"] .tab-title-label');
			if(response.total>0)
			{
				obj.removeClass('display-none').html(response.total);
			}
			else
			{
				obj.addClass('display-none')
			}
		}
	});

	$('#checkout .search').on('submit',function(){
		checkout.addAjaxParameter('keywords',$(this).find('input[name=keywords]').val());
		checkout.addAjaxParameter('starttime',$(this).find('input[name=starttime]').val());
		checkout.addAjaxParameter('endtime',$(this).find('input[name=endtime]').val());
		checkout.page(0);
		checkout.reload();
		return false;
	});

	//导出
	$('#checkout .search button[type=button]').on('click',function(){
		var data = {
			keywords:$('#checkout .search input[name=keywords]').val(),
			starttime:$('#checkout .search input[name=starttime]').val(),
			endtime:$('#checkout .search input[name=endtime]').val(),
			ajaxData:checkout.getAjaxData(),
			order:checkout.getOrderData(),
		};
		var query_string = $.http_build_query(data);
		window.location = '<?=url('room_order/export_room_order')?>?'+query_string;
		return false;
	});

	var quit = datatables({
		table:$('#quit .table'),
		ajax:{
			data:{
				status:2,
			},
			method:'post',
		},
		columns:[{
			data:'orderno',
			pk:true,
			render:function(data,full){
				return '<input type="checkbox" name="id[]" value="'+data+'">';
			}
		},{
			data:'orderno',
		},{
			data:'hotel_name',
		},{
			data:'createtime',
		},{
			data:'user_username',
			render:function(data,full){
				return '用户名:'+(full.user_username==null?'':full.user_username)+'<br>昵称:'+full.user_nickname;
			},
			style: 'text-align:left',
		},{
			data:'room_type_detail',
			style: 'text-align:left',
			render:function(data,full){
				var content = '';
				$.each(data,function(index,value){
					content += '<div style="display: flex;padding-left: 5px;text-align: left;"><div><img src="'+value.room_type_logo+'"></div><div><div>['+value.room_type_name+']'+value.starttime+'~'+value.endtime+'('+value.days+'天)</div><div>预计'+value.arrive+'到达[押金:￥'+parseFloat(value.deposit_price/100).toFixed(2)+']</div><div style="max-width: 250px;text-align: left;">备注:'+value.remark+'</div></div></div>';
				});
				return content;
			}
		},{
			data:'voucher',
			render:function(data,full){
				var content = [];
				$.each(data,function(index,value){
					content.push(value.voucher_name+' x'+value.num+' (￥'+parseFloat(value.actual_price/100).toFixed(2)+')');
				});
				return content.join('<br>');
			}
		},{
			data:'invoice_type',
			render:function(data,full){
				if(data == null)
				{
					return '';
				}
				else
				{
					content = [];
					if(data==1)
					{
						content.push('发票类型:'+(data==1?'增值税专用发票':'增值税普通发票'));
						content.push('发票抬头:'+full.invoice_company_name);
						content.push('信用代码:'+full.invoice_company_no);
						content.push('注册地址:'+full.invoice_company_address);
						content.push('公司电话:'+full.invoice_company_phone);
						content.push('开户银行:'+full.invoice_company_bank);
						content.push('开户账号:'+full.invoice_company_bankno);
						return '<div style="text-align: left;white-space: normal;max-width:200px;min-width: 150px;">'+content.join('</div><div style="text-align: left;white-space: normal;max-width:200px;min-width: 150px;">')+'</div>';
					}
					else if(data==0)
					{
						content.push('发票类型:'+(data==1?'增值税专用发票':'增值税普通发票'));
						content.push('发票抬头:'+full.invoice_company_name);
						content.push('信用代码:'+full.invoice_company_no);
						return '<div style="text-align: left;white-space: normal;max-width:200px;min-width: 150px;">'+content.join('</div><div style="text-align: left;white-space: normal;max-width:200px;min-width: 150px;">')+'</div>';
					}
				}
			}
		},{
			data:'room_order_status_text',
			render:function(data,full){
				var content = data;
				if(full.status==2)
				{
					content += '<br>（'+full.cancel_reason+'）';
				}
				else if(full.status==0)
				{
					if(full.cancel_reason.length>0)
					{
						content += '<br>（'+full.cancel_reason+'）';
					}
					if(full.sure_reason)
					{
						content += '<br>（'+full.sure_reason+'）';
					}
				}
				return content;
			}
		},{
			data:'price',
			render:function(data,full){
				content = '<div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>住房金额:</div><div>'+parseFloat(full.price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>支付优惠金额:</div><div>'+parseFloat(full.paymethod_special_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>特惠金额:</div><div>-'+parseFloat(full.special_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>优惠券:</div><div>-'+parseFloat(full.coupon_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>实体券金额:</div><div>'+parseFloat(full.voucher_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>押金:</div><div>'+parseFloat(full.deposit_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>订单金额:</div><div>'+parseFloat(full.actual_price/100).toFixed(2)+'</div></div>';
				content += '</div>';
				return content;
			}
		},{
			data:'pay_price',
			render:function(data,full){
				content = '<div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>支付方式:</div><div>'+full.pay_method_name+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>支付渠道:</div><div>'+(full.pay_online==1?'线上支付':'线下支付')+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>余额支付:</div><div>'+parseFloat(full.money_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>在线支付:</div><div>'+parseFloat(full.pay_price/100).toFixed(2)+'</div></div>';
				content += '</div>';
				return content;
			}
		},{
			data:'person_name',
			render:function(data,full){
				content = '<div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>姓名:</div><div>'+full.person_name+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>手机:</div><div>'+full.person_telephone+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>证件:</div><div>'+full.person_card_type_name+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>号码:</div><div>'+full.person_card_no+'</div></div>';
				content += '</div>';
				return content;
			}
		},{
			data:'orderno',
			render:function(data,full){
				content = '';
				content += '<a class="button button-xs" href="<?=url('RoomOrder/detail')?>?orderno='+data+'">查看</a>';
				return content;
			}
		},{
			data:'notcheckin',
			visible:false,
		},{
			data:'user_nickname',
			visible:false,
		},{
			data:'deposit_price',
			visible:false,
		},{
			data:'voucher_price',
			visible:false,
		},{
			data:'special_price',
			visible:false,
		},{
			data:'coupon_price',
			visible:false,
		},{
			data:'actual_price',
			visible:false,
		},{
			data:'money_price',
			visible:false,
		},{
			data:'pay_method_name',
			visible:false,
		},{
			data:'status',
			visible:false,
		},{
			data:'sure',
			visible:false,
		},{
			data:'cancel',
			visible:false,
		},{
			data:'pay_method',
			visible:false,
		},{
			data:'pay_online',
			visible:false,
		},{
			data:'person_telephone',
			visible:false,
		},{
			data:'person_card_type',
			visible:false,
		},{
			data:'person_card_no',
			visible:false,
		},{
			data:'checkin',
			visible:false,
		},{
			data:'pay_status',
			visible:false,
		},{
			data:'checkout',
			visible:false,
		},{
			data:'evaluate',
			visible:false,
		},{
			data:'coupon',
			visible:false
		},{
			data:'cancel_reason',
			visible:false,
		},{
			data:'invoice_company_name',
			visible:false,
		},{
			data:'invoice_company_no',
			visible:false,
		},{
			data:'invoice_company_address',
			visible:false,
		},{
			data:'invoice_company_phone',
			visible:false,
		},{
			data:'invoice_company_bank',
			visible:false,
		},{
			data:'invoice_company_bankno',
			visible:false,
		},{
			data:'paymethod_special_price',
			visible:false,
		}],
		sort:{
			createtime:'desc',
		},
		pagesize:10,
		onRowLoaded:function(row){

		},
		afterTableLoaded:function(table,response){
			var obj = $('a.tab-title[href="#quit"] .tab-title-label');
			if(response.total>0)
			{
				obj.removeClass('display-none').html(response.total);
			}
			else
			{
				obj.addClass('display-none')
			}
		}
	});
	
	$('#quit .search').on('submit',function(){
		quit.addAjaxParameter('keywords',$(this).find('input[name=keywords]').val());
		quit.addAjaxParameter('starttime',$(this).find('input[name=starttime]').val());
		quit.addAjaxParameter('endtime',$(this).find('input[name=endtime]').val());
		quit.page(0);
		quit.reload();
		return false;
	});

	//导出
	$('#quit .search button[type=button]').on('click',function(){
		var data = {
			keywords:$('#quit .search input[name=keywords]').val(),
			starttime:$('#quit .search input[name=starttime]').val(),
			endtime:$('#quit .search input[name=endtime]').val(),
			ajaxData:quit.getAjaxData(),
			order:quit.getOrderData(),
		};
		var query_string = $.http_build_query(data);
		window.location = '<?=url('room_order/export')?>?'+query_string;
		return false;
	});

	var status_checkout = datatables({
		table:$('#status_checkout .table'),
		ajax:{
			data:{
				status:1,
				checkin:1,
				sure:1,
				checkout:1,
			},
			method:'post',
		},
		columns:[{
			data:'orderno',
			pk:true,
			render:function(data,full){
				return '<input type="checkbox" name="id[]" value="'+data+'">';
			}
		},{
			data:'orderno',
		},{
			data:'hotel_name',
		},{
			data:'createtime',
		},{
			data:'user_username',
			render:function(data,full){
				return '用户名:'+(full.user_username==null?'':full.user_username)+'<br>昵称:'+full.user_nickname;
			},
			style: 'text-align:left',
		},{
			data:'room_type_detail',
			style: 'text-align:left',
			render:function(data,full){
				var content = '';
				$.each(data,function(index,value){
					content += '<div style="display: flex;padding-left: 5px;text-align: left;"><div><img src="'+value.room_type_logo+'"></div><div><div>['+value.room_type_name+']'+value.starttime+'~'+value.endtime+'('+value.days+'天)</div><div>预计'+value.arrive+'到达[押金:￥'+parseFloat(value.deposit_price/100).toFixed(2)+']</div><div style="max-width: 250px;text-align: left;">备注:'+value.remark+'</div></div></div>';
				});
				return content;
			}
		},{
			data:'voucher',
			render:function(data,full){
				var content = [];
				$.each(data,function(index,value){
					content.push(value.voucher_name+' x'+value.num+' (￥'+parseFloat(value.actual_price/100).toFixed(2)+')');
				});
				return content.join('<br>');
			}
		},{
			data:'invoice_type',
			render:function(data,full){
				if(data == null)
				{
					return '';
				}
				else
				{
					content = [];
					if(data==1)
					{
						content.push('发票类型:'+(data==1?'增值税专用发票':'增值税普通发票'));
						content.push('发票抬头:'+full.invoice_company_name);
						content.push('信用代码:'+full.invoice_company_no);
						content.push('注册地址:'+full.invoice_company_address);
						content.push('公司电话:'+full.invoice_company_phone);
						content.push('开户银行:'+full.invoice_company_bank);
						content.push('开户账号:'+full.invoice_company_bankno);
						return '<div style="text-align: left;white-space: normal;max-width:200px;min-width: 150px;">'+content.join('</div><div style="text-align: left;white-space: normal;max-width:200px;min-width: 150px;">')+'</div>';
					}
					else if(data==0)
					{
						content.push('发票类型:'+(data==1?'增值税专用发票':'增值税普通发票'));
						content.push('发票抬头:'+full.invoice_company_name);
						content.push('信用代码:'+full.invoice_company_no);
						return '<div style="text-align: left;white-space: normal;max-width:200px;min-width: 150px;">'+content.join('</div><div style="text-align: left;white-space: normal;max-width:200px;min-width: 150px;">')+'</div>';
					}
				}
			}
		},{
			data:'room_order_status_text',
			render:function(data,full){
				var content = data;
				if(full.status==2)
				{
					content += '<br>（'+full.cancel_reason+'）';
				}
				else if(full.status==0)
				{
					if(full.cancel_reason.length>0)
					{
						content += '<br>（'+full.cancel_reason+'）';
					}
					if(full.sure_reason)
					{
						content += '<br>（'+full.sure_reason+'）';
					}
				}
				return content;
			}
		},{
			data:'price',
			render:function(data,full){
				content = '<div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>住房金额:</div><div>'+parseFloat(full.price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>支付优惠金额:</div><div>'+parseFloat(full.paymethod_special_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>特惠金额:</div><div>-'+parseFloat(full.special_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>优惠券:</div><div>-'+parseFloat(full.coupon_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>实体券金额:</div><div>'+parseFloat(full.voucher_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>押金:</div><div>'+parseFloat(full.deposit_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>订单金额:</div><div>'+parseFloat(full.actual_price/100).toFixed(2)+'</div></div>';
				content += '</div>';
				return content;
			}
		},{
			data:'pay_price',
			render:function(data,full){
				content = '<div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>支付方式:</div><div>'+full.pay_method_name+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>支付渠道:</div><div>'+(full.pay_online==1?'线上支付':'线下支付')+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>余额支付:</div><div>'+parseFloat(full.money_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>在线支付:</div><div>'+parseFloat(full.pay_price/100).toFixed(2)+'</div></div>';
				content += '</div>';
				return content;
			}
		},{
			data:'person_name',
			render:function(data,full){
				content = '<div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>姓名:</div><div>'+full.person_name+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>手机:</div><div>'+full.person_telephone+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>证件:</div><div>'+full.person_card_type_name+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>号码:</div><div>'+full.person_card_no+'</div></div>';
				content += '</div>';
				return content;
			}
		},{
			data:'orderno',
			render:function(data,full){
				content = '';
				content += '<a class="button button-xs" href="<?=url('RoomOrder/detail')?>?orderno='+data+'">查看</a>';
				content += '<a class="button button-xs commission" data-orderno="'+data+'">重新分配分销佣金</a>';
				return content;
			}
		},{
			data:'notcheckin',
			visible:false,
		},{
			data:'user_nickname',
			visible:false,
		},{
			data:'deposit_price',
			visible:false,
		},{
			data:'voucher_price',
			visible:false,
		},{
			data:'special_price',
			visible:false,
		},{
			data:'coupon_price',
			visible:false,
		},{
			data:'actual_price',
			visible:false,
		},{
			data:'money_price',
			visible:false,
		},{
			data:'pay_method_name',
			visible:false,
		},{
			data:'status',
			visible:false,
		},{
			data:'sure',
			visible:false,
		},{
			data:'cancel',
			visible:false,
		},{
			data:'pay_method',
			visible:false,
		},{
			data:'pay_online',
			visible:false,
		},{
			data:'person_telephone',
			visible:false,
		},{
			data:'person_card_type',
			visible:false,
		},{
			data:'person_card_no',
			visible:false,
		},{
			data:'checkin',
			visible:false,
		},{
			data:'pay_status',
			visible:false,
		},{
			data:'checkout',
			visible:false,
		},{
			data:'evaluate',
			visible:false,
		},{
			data:'coupon',
			visible:false
		},{
			data:'cancel_reason',
			visible:false,
		},{
			data:'invoice_company_name',
			visible:false,
		},{
			data:'invoice_company_no',
			visible:false,
		},{
			data:'invoice_company_address',
			visible:false,
		},{
			data:'invoice_company_phone',
			visible:false,
		},{
			data:'invoice_company_bank',
			visible:false,
		},{
			data:'invoice_company_bankno',
			visible:false,
		},{
			data:'paymethod_special_price',
			visible:false,
		}],
		sort:{
			createtime:'desc',
		},
		pagesize:10,
		onRowLoaded:function(row){

		},
		afterTableLoaded:function(table,response){
			var obj = $('a.tab-title[href="#status_checkout"] .tab-title-label');
			if(response.total>0)
			{
				obj.removeClass('display-none').html(response.total);
			}
			else
			{
				obj.addClass('display-none')
			}
		}
	});
	
	$('#status_checkout .search').on('submit',function(){
		status_checkout.addAjaxParameter('keywords',$(this).find('input[name=keywords]').val());
		status_checkout.addAjaxParameter('starttime',$(this).find('input[name=starttime]').val());
		status_checkout.addAjaxParameter('endtime',$(this).find('input[name=endtime]').val());
		status_checkout.page(0);
		status_checkout.reload();
		return false;
	});

	//导出
	$('#status_checkout .search button[type=button]').on('click',function(){
		var data = {
			keywords:$('#status_checkout .search input[name=keywords]').val(),
			starttime:$('#status_checkout .search input[name=starttime]').val(),
			endtime:$('#status_checkout .search input[name=endtime]').val(),
			ajaxData:status_checkout.getAjaxData(),
			order:status_checkout.getOrderData(),
		};
		var query_string = $.http_build_query(data);
		window.location = '<?=url('room_order/export_room_order')?>?'+query_string;
		return false;
	});

	$('.table').on('click','.commission',function(){
		var btn = $(this);
		var orderno = $(this).data('orderno');
		$.confirm({
			title:'订单佣金重新分配',
			content:'确定重新分配订单佣金？',
			success:function(e){
				btn.loading('start');
				$.post('<?=url('room_order/commission')?>',{orderno:orderno},function(response){
					btn.loading('stop');
					spop({
						template: response.message,
						style: response.code==1?'success':'error',
						autoclose: 3000,
						position:'bottom-right',
						icon:true,
						group:false,
					});
				});
			}
		});
		return false;
	});
	
	tab.init();
	tab.on('tab.click.all',function(){
		all.clearAjaxParameter();
		all.reload();
	}).on('tab.click.sure',function(){
		sure.clearAjaxParameter();
		sure.reload();
	}).on('tab.click.checkin',function(){
		checkin.clearAjaxParameter();
		checkin.reload();
	}).on('tab.click.checkout',function(){
		checkout.clearAjaxParameter();
		checkout.reload();
	}).on('tab.click.evaluate',function(){
		evaluate.clearAjaxParameter();
		evaluate.reload();
	}).on('tab.click.quit',function(){
		quit.clearAjaxParameter();
		quit.reload();
	}).on('tab.click.status_checkout',function(){
		status_checkout.clearAjaxParameter();
		status_checkout.reload();
	});
</script>
</body>
</html>
