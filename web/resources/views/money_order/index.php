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
						</div>
						<div class="tab-body">
							<div class="tab-page active" id="all">
								<!-- 所有订单列表 -->
								<div class="line"></div>
								<div class="top-tips">
									<div class="top-tips-title">操作提示</div>
									<div class="top-tips-body">
										<p>用户充值记录</p>
									</div>
								</div>
								<div class="line">
									<form class="search col-md-10" style="display: inline-block;">
										<input type="text" placeholder="订单号/预定人/证件号码/下单用户" class="input_text col-md-2">
										<button class="button primary">搜索</button>
										<div class="checkbox col-md-1">
											<input type="checkbox" id="show_quit_order">
											<label for="show_quit_order">显示未付款订单</label>
										</div>
									</form>
								</div>
								<div class="tablebox">
									<table class="table" data-ajax-url="<?=url('money_order/index')?>">
										<thead>
											<tr>
												<th>
													<input type="checkbox" class="all_checked">
												</th>
												<th style="min-width: 158px;">订单号</th>
												<th style="min-width: 127px;">订单时间</th>
												<th>用户名</th>
												<th>充值金额</th>
												<th>支付金额</th>
												<th>支付方式</th>
												<th>支付时间</th>
												<th>支付单号</th>
												<th>收款方</th>
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
<script type="text/javascript" src="<?=assets::js('spop.min.js')?>"></script>
<script type="text/javascript" src="<?=assets::js('tab.js')?>"></script>
<script type="text/javascript" src="<?=assets::js('datatables.js')?>"></script>
<script>
$.ajaxSetup({
	headers: {
		'__token__': '<?=Request::token('__token__')?>' ,
	},
});
</script>
<script type="text/javascript">
$(function(){
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
			data:'createtime',
		},{
			data:'user_username',
			render:function(data,full){
				return '用户名:'+(full.user_username==null?'':full.user_username)+'<br>昵称:'+full.user_nickname;
			},
			style: 'text-align:left',
		},{
			data:'money',
			style: 'text-align:left',
			render:function(data,full){
				return parseFloat(data/100).toFixed(2);
			}
		},{
			data:'pay_price',
			render:function(data,full){
				return parseFloat(data/100).toFixed(2);
			}
		},{
			data:'pay_method_name',
		},{
			data:'pay_time',
			render:function(data,full){
				return data==null?'':data;
			}
		},{
			data:'pay_no',
			render:function(data,full){
				return data;
			}
		},{
			data:'wechat_pay_hotel_name',
			render:function(data,full){
				return data==null?'':data;
			}
		},{
			data:'orderno',
			render:function(data,full){
				return '';
			}
		},{
			data:'user_nickname',
			visible:false,
		},{
			data:'user_id',
			visible:false,
		},{
			data:'pay_method',
			visible:false,
		},{
			data:'wechat_pay_hotel_id',
			visible:false,
		},{
			data:'user_nickname',
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
		all.search($(this).find('input').val());
		return false;
	});

	$('#show_quit_order').on('change',function(){
		all.addAjaxParameter('with_not_payed',$(this).is(':checked'));
		all.reload();
	});

	tab.init();
});
</script>
</body>
</html>
