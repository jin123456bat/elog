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
<link rel="stylesheet" href="<?=assets::css('tab.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('button.loading.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('jquery.modal.css')?>" type="text/css" media="all" />
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
							<a class="tab-title active" href="#all"> 全部订单 </a>
							<a class="tab-title" href="#response">
								待响应
								<span class="tab-title-label display-none">0</span>
							</a>
							<a class="tab-title" href="#finish">
								待完结
								<span class="tab-title-label display-none">0</span>
							</a>
							<a class="tab-title" href="#quit">
								申请取消
								<span class="tab-title-label display-none">0</span>
							</a>
							<a class="tab-title" href="#evaluate">
								待评价
								<span class="tab-title-label display-none">0</span>
							</a>
						</div>
						<div class="tab-body">
							<div class="tab-page active" id="all">
								<div class="line"></div>
								<div class="top-tips">
									<div class="top-tips-title">操作提示</div>
									<div class="top-tips-body">
										<p>服务订单列表</p>
									</div>
								</div>
								<div class="line">
									<form class="col-md-10 search">
										<input type="text" name="keywords" placeholder="订单号/下单用户/房间/餐桌" class="input_text">
										<button class="button primary">搜索</button>
										<div class="checkbox col-md-1">
											<input type="checkbox" id="show_quit_order">
											<label for="show_quit_order">显示全部订单</label>
										</div>
									</form>
								</div>
								<div class="tablebox">
									<table class="table" data-ajax-url="<?=url('service_order/index')?>">
										<thead>
											<tr>
												<th>
													<input type="checkbox" class="all_checked">
												</th>
												<th style="min-width: 158px;">订单号</th>
												<th style="min-width: 158px;">酒店名称</th>
												<th style="min-width: 127px;">订单时间</th>
												<th>用户名</th>
												<th>服务类型</th>
												<th>服务位置</th>
												<th style="min-width: 227px; max-width: 250px;">服务内容</th>
												<th style="min-width: 64px;">订单状态</th>
												<th style="min-width: 120px;">金额明细</th>
												<th style="min-width: 120px;">支付明细</th>
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
							<div class="tab-page" id="response">
								<div class="line"></div>
								<div class="top-tips">
									<div class="top-tips-title">操作提示</div>
									<div class="top-tips-body">
										<p>服务订单列表</p>
									</div>
								</div>
								<div class="line pull-right">
									<form class="col-md-10 search">
										<input type="text" name="keywords" placeholder="订单号/下单用户/房间/餐桌" class="input_text">
										<button class="button primary">搜索</button>
									</form>
								</div>
								<div class="tablebox">
									<table class="table" data-ajax-url="<?=url('service_order/index')?>">
										<thead>
											<tr>
												<th>
													<input type="checkbox" class="all_checked">
												</th>
												<th style="min-width: 158px;">订单号</th>
												<th style="min-width: 158px;">酒店名称</th>
												<th style="min-width: 127px;">订单时间</th>
												<th>用户名</th>
												<th>服务类型</th>
												<th>服务位置</th>
												<th style="min-width: 227px; max-width: 250px;">服务内容</th>
												<th style="min-width: 64px;">订单状态</th>
												<th style="min-width: 120px;">金额明细</th>
												<th style="min-width: 120px;">支付明细</th>
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
							<div class="tab-page" id="finish">
								<div class="line"></div>
								<div class="top-tips">
									<div class="top-tips-title">操作提示</div>
									<div class="top-tips-body">
										<p>服务订单列表</p>
									</div>
								</div>
								<div class="line pull-right">
									<form class="col-md-10 search">
										<input type="text" name="keywords" placeholder="订单号/下单用户/房间/餐桌" class="input_text">
										<button class="button primary">搜索</button>
									</form>
								</div>
								<div class="tablebox">
									<table class="table" data-ajax-url="<?=url('service_order/index')?>">
										<thead>
											<tr>
												<th>
													<input type="checkbox" class="all_checked">
												</th>
												<th style="min-width: 158px;">订单号</th>
												<th style="min-width: 158px;">酒店名称</th>
												<th style="min-width: 127px;">订单时间</th>
												<th>用户名</th>
												<th>服务类型</th>
												<th>服务位置</th>
												<th style="min-width: 227px; max-width: 250px;">服务内容</th>
												<th style="min-width: 64px;">订单状态</th>
												<th style="min-width: 120px;">金额明细</th>
												<th style="min-width: 120px;">支付明细</th>
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
								<div class="line"></div>
								<div class="top-tips">
									<div class="top-tips-title">操作提示</div>
									<div class="top-tips-body">
										<p>服务订单列表</p>
									</div>
								</div>
								<div class="line pull-right">
									<form class="col-md-10 search">
										<input type="text" name="keywords" placeholder="订单号/下单用户/房间/餐桌" class="input_text">
										<button class="button primary">搜索</button>
									</form>
								</div>
								<div class="tablebox">
									<table class="table" data-ajax-url="<?=url('service_order/index')?>">
										<thead>
											<tr>
												<th>
													<input type="checkbox" class="all_checked">
												</th>
												<th style="min-width: 158px;">订单号</th>
												<th style="min-width: 158px;">酒店名称</th>
												<th style="min-width: 127px;">订单时间</th>
												<th>用户名</th>
												<th>服务类型</th>
												<th>服务位置</th>
												<th style="min-width: 227px; max-width: 250px;">服务内容</th>
												<th style="min-width: 64px;">订单状态</th>
												<th style="min-width: 120px;">金额明细</th>
												<th style="min-width: 120px;">支付明细</th>
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
							<div class="tab-page" id="evaluate">
								<div class="line"></div>
								<div class="top-tips">
									<div class="top-tips-title">操作提示</div>
									<div class="top-tips-body">
										<p>服务订单列表</p>
									</div>
								</div>
								<div class="line pull-right">
									<form class="col-md-10 search">
										<input type="text" name="keywords" placeholder="订单号/下单用户/房间/餐桌" class="input_text">
										<button class="button primary">搜索</button>
									</form>
								</div>
								<div class="tablebox">
									<table class="table" data-ajax-url="<?=url('service_order/index')?>">
										<thead>
											<tr>
												<th>
													<input type="checkbox" class="all_checked">
												</th>
												<th style="min-width: 158px;">订单号</th>
												<th style="min-width: 158px;">酒店名称</th>
												<th style="min-width: 127px;">订单时间</th>
												<th>用户名</th>
												<th>服务类型</th>
												<th>服务位置</th>
												<th style="min-width: 227px; max-width: 250px;">服务内容</th>
												<th style="min-width: 64px;">订单状态</th>
												<th style="min-width: 120px;">金额明细</th>
												<th style="min-width: 120px;">支付明细</th>
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
	<script type="text/javascript" src="<?=assets::js('jquery.modal.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('spop.min.js')?>"></script>
	<script type="text/javascript" src="<?=assets::common('jquery.dialog.js','js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('tab.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('button.loading.js')?>"></script>
	<script>
	$.ajaxSetup({
		headers: {
			'__token__': '<?=Request::token('__token__')?>' ,
		} ,
	});
</script>
	<script type="text/javascript">
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
			}
		},{
			data:'service_name',
		},{
			data:'pos_name',
			render:function(data,full){
				return data+'-'+full.position_name;
			}
		},{
			data:'content',
			render:function(data,full){
				var remark = $.trim(full.remark);
				if(remark.length==0)
				{
					remark = '无';
				}
				return '<p>'+data+'</p><p>备注:'+remark+'</p>';
			}
		},{
			data:'service_order_status_text',
			render:function(data,full){
				var content = data;
				if(full.status==2)
				{
					content += '<br>（'+full.cancel_reason+'）';
				}
				return content;
			}
		},{
			data:'order_price',
			render:function(data,full){
				if(full.order_price == 0)
				{
					return '无需支付';
				}
				content = '<div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>订单金额:</div><div>'+parseFloat(full.order_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>特惠金额:</div><div>'+parseFloat(full.special_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>优惠金额:</div><div>'+parseFloat(full.coupon_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>应付金额:</div><div>'+parseFloat(full.actual_price/100).toFixed(2)+'</div></div>';
				content += '</div>';
				return content;
			}
		},{
			data:'pay_price',
			render:function(data,full){
				if(full.order_price == 0)
				{
					return '无需支付';
				}
				
				content = '<div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>余额支付:</div><div>'+parseFloat(full.money_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>支付方式:</div><div>'+full.paymethod_name+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>在线支付:</div><div>'+parseFloat(full.pay_price/100).toFixed(2)+'</div></div>';
				content += '</div>';
				return content;
			}
		},{
			data:'orderno',
			render:function(data,full){
				content = '<a class="button button-xs look" data-orderno="'+data+'">查看</a>';
				return content;
			}
		},{
			data:'user_nickname',
			visible:false,
		},{
			data:'evaluate',
			visible:false,
		},{
			data:'status',
			visible:false,
		},{
			data:'response',
			visible:false,
		},{
			data:'finish',
			visible:false,
		},{
			data:'user_nickname',
			visible:false,
		},{
			data:'position_name',
			visible:false,
		},{
			data:'paymethod_name',
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
			data:'cancel_reason',
			visible:false,
		},{
			data:'pay_status',
			visible:false,
		},{
			data:'pay_online',
			visible:false,
		},{
			data:'remark',
			visible:false,
		},{
			data:'service_code',
			visible:false,
		},{
			data:'hotel_id',
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
		all.addAjaxParameter('with_not_payed',$(this).find('#show_quit_order').is(':checked'));
		all.page(0);
		all.reload();
		return false;
	});

	$('#show_quit_order').on('change',function(){
		all.addAjaxParameter('keywords',$('#all .search input[name=keywords]').val());
		all.addAjaxParameter('with_not_payed',$(this).is(':checked'));
		all.page(0);
		all.reload();
	});

	var response = datatables({
		table:$('#response .table'),
		ajax:{
			data:{
				status:1,
				response:0,
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
			}
		},{
			data:'service_name',
		},{
			data:'pos_name',
			render:function(data,full){
				return data+'-'+full.position_name;
			}
		},{
			data:'content',
			render:function(data,full){
				var remark = $.trim(full.remark);
				if(remark.length==0)
				{
					remark = '无';
				}
				return '<p>'+data+'</p><p>备注:'+remark+'</p>';
			}
		},{
			data:'service_order_status_text',
			render:function(data,full){
				var content = data;
				if(full.status==2)
				{
					content += '<br>（'+full.cancel_reason+'）';
				}
				return content;
			}
		},{
			data:'order_price',
			render:function(data,full){
				if(full.order_price == 0)
				{
					return '无需支付';
				}
				content = '<div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>订单金额:</div><div>'+parseFloat(full.order_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>特惠金额:</div><div>'+parseFloat(full.special_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>优惠金额:</div><div>'+parseFloat(full.coupon_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>应付金额:</div><div>'+parseFloat(full.actual_price/100).toFixed(2)+'</div></div>';
				content += '</div>';
				return content;
			}
		},{
			data:'pay_price',
			render:function(data,full){
				if(full.order_price == 0)
				{
					return '无需支付';
				}
				
				content = '<div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>余额支付:</div><div>'+parseFloat(full.money_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>支付方式:</div><div>'+full.paymethod_name+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>在线支付:</div><div>'+parseFloat(full.pay_price/100).toFixed(2)+'</div></div>';
				content += '</div>';
				return content;
			}
		},{
			data:'orderno',
			render:function(data,full){
				content = '<a class="button button-xs look" data-orderno="'+data+'">查看</a>';
				return content;
			}
		},{
			data:'user_nickname',
			visible:false,
		},{
			data:'evaluate',
			visible:false,
		},{
			data:'status',
			visible:false,
		},{
			data:'response',
			visible:false,
		},{
			data:'finish',
			visible:false,
		},{
			data:'user_nickname',
			visible:false,
		},{
			data:'position_name',
			visible:false,
		},{
			data:'paymethod_name',
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
			data:'cancel_reason',
			visible:false,
		},{
			data:'pay_status',
			visible:false,
		},{
			data:'pay_online',
			visible:false,
		},{
			data:'remark',
			visible:false,
		},{
			data:'service_code',
			visible:false,
		},{
			data:'hotel_id',
			visible:false,
		}],
		sort:{
			createtime:'desc',
		},
		pagesize:10,
		onRowLoaded:function(row){

		},
		afterTableLoaded:function(table,response){
			var obj = $('a.tab-title[href="#response"] .tab-title-label');
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

	$('#response .search').on('submit',function(){
		response.addAjaxParameter('keywords',$(this).find('input[name=keywords]').val());
		response.page(0);
		response.reload();
		return false;
	});


	var finish = datatables({
		table:$('#finish .table'),
		ajax:{
			data:{
				status:1,
				response:1,
				finish:0,
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
			}
		},{
			data:'service_name',
		},{
			data:'pos_name',
			render:function(data,full){
				return data+'-'+full.position_name;
			}
		},{
			data:'content',
			render:function(data,full){
				var remark = $.trim(full.remark);
				if(remark.length==0)
				{
					remark = '无';
				}
				return '<p>'+data+'</p><p>备注:'+remark+'</p>';
			}
		},{
			data:'service_order_status_text',
			render:function(data,full){
				var content = data;
				if(full.status==2)
				{
					content += '<br>（'+full.cancel_reason+'）';
				}
				return content;
			}
		},{
			data:'order_price',
			render:function(data,full){
				if(full.order_price == 0)
				{
					return '无需支付';
				}
				content = '<div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>订单金额:</div><div>'+parseFloat(full.order_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>特惠金额:</div><div>'+parseFloat(full.special_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>优惠金额:</div><div>'+parseFloat(full.coupon_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>应付金额:</div><div>'+parseFloat(full.actual_price/100).toFixed(2)+'</div></div>';
				content += '</div>';
				return content;
			}
		},{
			data:'pay_price',
			render:function(data,full){
				if(full.order_price == 0)
				{
					return '无需支付';
				}
				
				content = '<div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>余额支付:</div><div>'+parseFloat(full.money_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>支付方式:</div><div>'+full.paymethod_name+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>在线支付:</div><div>'+parseFloat(full.pay_price/100).toFixed(2)+'</div></div>';
				content += '</div>';
				return content;
			}
		},{
			data:'orderno',
			render:function(data,full){
				content = '<a class="button button-xs look" data-orderno="'+data+'">查看</a>';
				return content;
			}
		},{
			data:'user_nickname',
			visible:false,
		},{
			data:'evaluate',
			visible:false,
		},{
			data:'status',
			visible:false,
		},{
			data:'response',
			visible:false,
		},{
			data:'finish',
			visible:false,
		},{
			data:'user_nickname',
			visible:false,
		},{
			data:'position_name',
			visible:false,
		},{
			data:'paymethod_name',
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
			data:'cancel_reason',
			visible:false,
		},{
			data:'pay_status',
			visible:false,
		},{
			data:'pay_online',
			visible:false,
		},{
			data:'remark',
			visible:false,
		},{
			data:'service_code',
			visible:false,
		},{
			data:'hotel_id',
			visible:false,
		}],
		sort:{
			createtime:'desc',
		},
		pagesize:10,
		onRowLoaded:function(row){

		},
		afterTableLoaded:function(table,response){
			var obj = $('a.tab-title[href="#finish"] .tab-title-label');
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

	$('#finish .search').on('submit',function(){
		finish.addAjaxParameter('keywords',$(this).find('input[name=keywords]').val());
		finish.page(0);
		finish.reload();
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
			}
		},{
			data:'service_name',
		},{
			data:'pos_name',
			render:function(data,full){
				return data+'-'+full.position_name;
			}
		},{
			data:'content',
			render:function(data,full){
				var remark = $.trim(full.remark);
				if(remark.length==0)
				{
					remark = '无';
				}
				return '<p>'+data+'</p><p>备注:'+remark+'</p>';
			}
		},{
			data:'service_order_status_text',
			render:function(data,full){
				var content = data;
				if(full.status==2)
				{
					content += '<br>（'+full.cancel_reason+'）';
				}
				return content;
			}
		},{
			data:'order_price',
			render:function(data,full){
				if(full.order_price == 0)
				{
					return '无需支付';
				}
				content = '<div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>订单金额:</div><div>'+parseFloat(full.order_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>特惠金额:</div><div>'+parseFloat(full.special_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>优惠金额:</div><div>'+parseFloat(full.coupon_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>应付金额:</div><div>'+parseFloat(full.actual_price/100).toFixed(2)+'</div></div>';
				content += '</div>';
				return content;
			}
		},{
			data:'pay_price',
			render:function(data,full){
				if(full.order_price == 0)
				{
					return '无需支付';
				}
				
				content = '<div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>余额支付:</div><div>'+parseFloat(full.money_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>支付方式:</div><div>'+full.paymethod_name+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>在线支付:</div><div>'+parseFloat(full.pay_price/100).toFixed(2)+'</div></div>';
				content += '</div>';
				return content;
			}
		},{
			data:'orderno',
			render:function(data,full){
				content = '<a class="button button-xs look" data-orderno="'+data+'">查看</a>';
				return content;
			}
		},{
			data:'user_nickname',
			visible:false,
		},{
			data:'evaluate',
			visible:false,
		},{
			data:'status',
			visible:false,
		},{
			data:'response',
			visible:false,
		},{
			data:'finish',
			visible:false,
		},{
			data:'user_nickname',
			visible:false,
		},{
			data:'position_name',
			visible:false,
		},{
			data:'paymethod_name',
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
			data:'cancel_reason',
			visible:false,
		},{
			data:'pay_status',
			visible:false,
		},{
			data:'pay_online',
			visible:false,
		},{
			data:'remark',
			visible:false,
		},{
			data:'service_code',
			visible:false,
		},{
			data:'hotel_id',
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
		quit.page(0);
		quit.reload();
		return false;
	});

	var evaluate = datatables({
		table:$('#evaluate .table'),
		ajax:{
			data:{
				finish:1,
				status:1,
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
			}
		},{
			data:'service_name',
		},{
			data:'pos_name',
			render:function(data,full){
				return data+'-'+full.position_name;
			}
		},{
			data:'content',
			render:function(data,full){
				var remark = $.trim(full.remark);
				if(remark.length==0)
				{
					remark = '无';
				}
				return '<p>'+data+'</p><p>备注:'+remark+'</p>';
			}
		},{
			data:'service_order_status_text',
			render:function(data,full){
				var content = data;
				if(full.status==2)
				{
					content += '<br>（'+full.cancel_reason+'）';
				}
				return content;
			}
		},{
			data:'order_price',
			render:function(data,full){
				if(full.order_price == 0)
				{
					return '无需支付';
				}
				content = '<div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>订单金额:</div><div>'+parseFloat(full.order_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>特惠金额:</div><div>'+parseFloat(full.special_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>优惠金额:</div><div>'+parseFloat(full.coupon_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>应付金额:</div><div>'+parseFloat(full.actual_price/100).toFixed(2)+'</div></div>';
				content += '</div>';
				return content;
			}
		},{
			data:'pay_price',
			render:function(data,full){
				if(full.order_price == 0)
				{
					return '无需支付';
				}
				
				content = '<div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>余额支付:</div><div>'+parseFloat(full.money_price/100).toFixed(2)+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>支付方式:</div><div>'+full.paymethod_name+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>在线支付:</div><div>'+parseFloat(full.pay_price/100).toFixed(2)+'</div></div>';
				content += '</div>';
				return content;
			}
		},{
			data:'orderno',
			render:function(data,full){
				content = '<a class="button button-xs look" data-orderno="'+data+'">查看</a>';
				content += '<a class="button button-xs distribution" data-orderno="'+data+'">重新分配佣金</a>';
				return content;
			}
		},{
			data:'user_nickname',
			visible:false,
		},{
			data:'evaluate',
			visible:false,
		},{
			data:'status',
			visible:false,
		},{
			data:'response',
			visible:false,
		},{
			data:'finish',
			visible:false,
		},{
			data:'user_nickname',
			visible:false,
		},{
			data:'position_name',
			visible:false,
		},{
			data:'paymethod_name',
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
			data:'cancel_reason',
			visible:false,
		},{
			data:'pay_status',
			visible:false,
		},{
			data:'pay_online',
			visible:false,
		},{
			data:'remark',
			visible:false,
		},{
			data:'service_code',
			visible:false,
		},{
			data:'hotel_id',
			visible:false,
		}],
		sort:{
			createtime:'desc',
		},
		pagesize:10,
		onRowLoaded:function(row){
		},
		afterTableLoaded:function(table,response){
			var obj = $('a.tab-title[href="#evaluate"] .tab-title-label');
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

	$('#evaluate .search').on('submit',function(){
		evaluate.addAjaxParameter('keywords',$(this).find('input[name=keywords]').val());
		evaluate.page(0);
		evaluate.reload();
		return false;
	});

	$('.table').on('click','.look',function(){
		window.location = '<?=url('ServiceOrder/detail')?>?orderno='+$(this).data('orderno');
		return false;
	}).on('click','.distribution',function(){
		var btn = $(this);
		var orderno = $(this).data('orderno');
		$.confirm({
			title:'订单佣金重新分配',
			content:'确定重新分配订单佣金？',
			success:function(e){
				btn.loading('start');
				$.post('<?=url('ServiceOrder/distribution')?>',{orderno:orderno},function(response){
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
	}).on('tab.click.response',function(){
		response.clearAjaxParameter();
		response.reload();
	}).on('tab.click.finish',function(){
		finish.clearAjaxParameter();
		finish.reload();
	}).on('tab.click.quit',function(){
		quit.clearAjaxParameter();
		quit.reload();
	}).on('tab.click.evaluate',function(){
		evaluate.clearAjaxParameter();
		evaluate.reload();
	});
</script>
</body>
</html>
