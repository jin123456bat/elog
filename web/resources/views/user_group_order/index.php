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
<link rel="stylesheet" href="<?=assets::css('button.loading.css')?>" type="text/css" media="all" />
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
					<!-- 所有订单列表 -->
					<div class="line"></div>
					<div class="top-tips">
						<div class="top-tips-title">操作提示</div>
						<div class="top-tips-body">
							<p>用户购买会员的订单</p>
							<p>退款订单不会回退用户等级</p>
						</div>
					</div>
					<div class="line">
						<form class="search col-md-10" style="display: inline-block;">
							<input type="text" name="keywords" placeholder="订单号/微信昵称" class="input_text col-md-2">
							<button class="button primary" type="submit">搜索</button>
							<div class="checkbox col-md-1">
								<input type="checkbox" id="show_quit_order">
								<label for="show_quit_order">显示全部订单</label>
							</div>
						</form>
					</div>
					<div class="tablebox">
						<table id="table" class="table" data-ajax-url="<?=url()?>">
							<thead>
								<tr>
									<th>
										<input type="checkbox" class="all_checked">
									</th>
									<th>订单号</th>
									<th>订单时间</th>
									<th>用户名</th>
									<th>购买前等级</th>
									<th>购买后等级</th>
									<th>应付金额</th>
									<th>支付状态</th>
									<th>支付明细</th>
									<th>退款状态</th>
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
	{include file='common/footer' /}
	<!-- 通用js -->
	<script type="text/javascript" src="<?=assets::common('jquery.min.js','js')?>"></script>
	<!-- 全局js调用 -->
	<script type="text/javascript" src="<?=assets::js('global.js')?>"></script>
	<!-- 当前页面使用的第三方类库的js -->
	<script type="text/javascript" src="<?=assets::js('datatables.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('spop.min.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('jquery.dialog.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('button.loading.js')?>"></script>
	<script>
	$.ajaxSetup({
		headers: {
			'__token__': '<?=Request::token('__token__')?>' ,
		},
	});
	</script>
	<script type="text/javascript">
	$('.all_checked').on('click',function(){
		$(this).parents('table').find('tbody input[type=checkbox]').prop('checked',$(this).is(':checked'));
	});

	var all = datatables({
		table:$('#table'),
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
			data:'user_nickname',
		},{
			data:'pre_group_name',
			render:function(data,full){
				return data==''?'普通会员':data;
			}
		},{
			data:'ugroup_name',
		},{
			data:'money',
			render:function(data,full){
				return parseFloat(data/100).toFixed(2);
			}
		},{
			data:'pay_status',
			render:function(data,full){
				return data==1?'已支付':'未支付';
			}
		},{
			data:'pay_method_name',
			render:function(data,full){
				if(full.pay_status==0)
				{
					return '';
				}
				content = '<div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>支付方式:</div><div>'+full.pay_method_name+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>支付时间:</div><div>'+full.pay_no+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>支付单号:</div><div>'+full.pay_time+'</div></div>';
				content += '<div style="display: flex;flex-flow: row nowrap;justify-content: space-between;"><div>实际支付:</div><div>'+parseFloat(full.pay_price/100).toFixed(2)+'</div></div>';
				content += '</div>';
				return content;
			}
		},{
			data:'refund_status',
			render:function(data,full){
				return data==1?('已退款'+'<br>'+full.refund_reason):'未退款';
			}
		},{
			data:'orderno',
			render:function(data,full){
				if(full.refund_status==0)
				{
					return '<button class="button button-xs refund" data-orderno="'+data+'">退款</button>';
				}
				return '';
			}
		},{
			data:'pay_no',
			visible:false,
		},{
			data:'pay_time',
			visible:false,
		},{
			data:'pay_price',
			visible:false,
		},{
			data:'refund_reason',
			visible:false,
		}],
		sort:{
			createtime:'desc',
		},
		pagesize:10,
		onRowLoaded:function(row){

		}
	});

	$('.search').on('submit',function(){
		all.addAjaxParameter('keywords',$(this).find('input[name=keywords]').val());
		all.addAjaxParameter('with_not_payed',$(this).find('#show_quit_order').is(':checked'));
		all.page(0);
		all.reload();
		return false;
	});

	$('#table').on('click','.refund',function(){
		var orderno = $(this).data('orderno');
		var btn = $(this);
		var tr = $(this).parents('tr');
		$.reply({
			title:'确认退款?',
			content:'请输入退款原因，退款订单不会回退会员等级',
			success:function(e,reply){
				btn.loading('start');
				$.post('<?=url('UserGroupOrder/refund')?>',{orderno:orderno,refund_reason:reply},function(response){
					btn.loading('stop');
					if(response.code==1)
					{
						tr.trigger('flush.datatables');
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
			}
		});
		return false;
	});
</script>
</body>
</html>
