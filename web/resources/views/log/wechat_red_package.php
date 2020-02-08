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
							<p>微信红包日志</p>
							<p>红包状态和领取时间信息同步有最长10分钟延迟</p>
						</div>
					</div>
					<div class="line">
						<form id="search" class="col-md-5">
							<input type="text" placeholder="单号" class="input_text col-md-3">
							<button class="button primary">搜索</button>
						</form>
					</div>
					<div class="tablebox">
						<table id="table" class="table" data-ajax-url="<?=url('log/wechat_red_package')?>">
							<thead>
								<tr>
									<th>业务单号</th>
									<th>公众账号appid</th>
									<th>商户号</th>
									<th>子商户号</th>
									<th>发送人名称</th>
									<th>金额</th>
									<th>数量</th>
									<th>微信单号</th>
									<th>用户昵称</th>
									<th>发送时间</th>
									<th>祝福语</th>
									<th>活动名称</th>
									<th>备注</th>
									<th>状态</th>
									<th>领取时间</th>
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
		data:'orderno',
		pk:true,
	},{
		data:'wxappid',
	},{
		data:'mch_id',
	},{
		data:'sub_mch_id',
		render:function(data){
			return data==null?'':data;
		}
	},{
		data:'send_name',
	},{
		data:'price',
		render:function(data,full){
			return parseFloat(data/100).toFixed(2);
		}
	},{
		data:'total_num',
	},{
		data:'send_listid',
		render:function(data){
			return data==null?'':data;
		}
	},{
		data:'nickname',
	},{
		data:'createtime',
	},{
		data:'wishing',
	},{
		data:'act_name',
	},{
		data:'remark',
	},{
		data:'status',
		render:function(data,full){
			switch(data)
			{
				case 0:return '发放中';
				case 1:return '已发放待领取';
				case 2:return '发放失败';
				case 3:return '已领取';
				case 4:return '退款中';
				case 5:return '已退款';
			}
		}
	},{
		data:'receive_time',
		render:function(data,full){
			return data==null?'':data;
		}
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