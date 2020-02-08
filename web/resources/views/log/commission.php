<?php
use jin123456bat\assets;
use think\facade\Request;
use jin123456bat\companyController;
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
							<p>佣金发放日志</p>
						</div>
					</div>
					<div class="line">
						<form id="search" class="col-md-5">
							<input type="text" placeholder="单号/备注" class="input_text col-md-3">
							<button class="button primary">搜索</button>
						</form>
					</div>
					<div class="tablebox">
						<table id="table" class="table" data-ajax-url="<?=url('log/commission')?>">
							<thead>
								<tr>
									<th>用户昵称</th>
									<th>订单号</th>
									<th>订单类型</th>
									<th>订单分佣金额</th>
									<th>佣金比例</th>
									<th>佣金等级</th>
									<th>佣金金额</th>
									<th>类型</th>
									<th>时间</th>
									<th>备注</th>
								</tr>
							</thead>
							<tbody></tbody>
							<tfoot>
								<tr>
									<td colspan="2"></td>
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
	<script>
$.ajaxSetup({
	headers: {
        '__token__': '<?=Request::token('__token__')?>' ,
    } ,
});
</script>
	<!-- 当前页面独有的js -->
	<script type="text/javascript">
$('.all_checked').on('click',function(){
	$(this).parents('table').find('tbody input[type=checkbox]').prop('checked',$(this).is(':checked'));
});

var table = datatables({
	table:$('#table'),
	ajax:{
		data:{
		},
		method:'post',
	},
	columns:[{
		data:'nickname',
	},{
		data:'orderno',
	},{
		data:'order_type',
		render:function(data,full){
			switch(data)
			{
			case 'room':return '住房订单';
			case 'drawal':return '提现订单';
			case 'food':return '餐饮订单';
			case 'service':return '服务订单';
			case 'shop':return '商城订单';
			}
		}
	},{
		data:'total_price',
		render:function(data,full){
			return parseFloat(data/100).toFixed(2);
		}
	},{
		data:'rate',
	},{
		data:'level',
	},{
		data:'money',
		render:function(data,full){
			return parseFloat(data/100).toFixed(2);
		}
	},{
		data:'type',
		render:function(data,full){
			return data==1?'收入':'支出';
		}
	},{
		data:'createtime',
	},{
		data:'remark',
	},{
		data:'user_id',
		visible:false,
	}],
	sort:{
		createtime:'desc',
	},
	pagesize:10,
	onRowLoaded:function(row){
		
	}
});

$('#search').on('submit',function(){
	table.search($(this).find('input').val());
	return false;
});
</script>
</body>
</html>