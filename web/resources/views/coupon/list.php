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
</head>
<!-- 所有页面使用的样式 -->
<link rel="stylesheet" href="<?=assets::css('main.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('spop.min.css')?>" type="text/css" media="all" />
<!-- 当前页面的插件使用的样式 -->
<link rel="stylesheet" href="<?=assets::css('datatables.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('select.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('datetimepicker.css')?>" type="text/css" media="all" />
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
							<p>用户根据优惠码领取的优惠券列表</p>
						</div>
					</div>
					<div class="line pull-right">
						<form id="search" class="col-md-10">
							<input type="text" name="keywords" placeholder="优惠券名称" class="input_text">
							<input type="text" name="starttime" placeholder="发放开始时间" class="input_text datepicker">
							<input type="text" name="endtime" placeholder="发放结束时间" class="input_text datepicker">
							<select name="usetime" class="selectpicker submit_input" multiple>
								<option value="" disabled="disabled" selected="selected">请选择使用状态</option>
								<option value="0">未使用</option>
								<option value="1">已使用</option>
							</select>
							<button class="button primary">搜索</button>
						</form>
					</div>
					<div class="tablebox">
						<table id="table" class="table" data-ajax-url="<?=url('coupon/list')?>">
							<thead>
								<tr>
									<th>
										<input type="checkbox" class="all_checked">
									</th>
									<th>用户</th>
									<th>名称</th>
									<th>领取时间</th>
									<th>到期时间</th>
									<th>使用时间</th>
									<th>是否可转移</th>
									<th>领取渠道</th>
									<th width="300px">操作</th>
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
<script type="text/javascript" src="<?=assets::js('datetimepicker.js')?>"></script>
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
$('.all_checked').on('click',function(){
	$(this).parents('table').find('tbody input[type=checkbox]').prop('checked',$(this).is(':checked'));
});

$('.selectpicker').each(function(){
	$(this).select({
		search:true,//允许搜索
		class:'col-md-2',
	});
});

$('.datepicker').each(function(){
	$(this).datetimepicker({
		select:'date',
	});
});

var table = datatables({
	table:$('#table'),
	ajax:{
		data:{
		},
		method:'post',
	},
	columns:[{
		data:'id',
		pk:true,
		render:function(data,full){
			return '<input type="checkbox" name="id[]" value="'+data+'">';
		}
	},{
		data:'user_gravatar',
		render:function(data,full){
			if(data.length>0)
			{
				return '<img src="'+data+'" class="image circle"><div>'+full.user_nickname+'</div>';
			}
			else
			{
				return '<img src="<?=assets::common('default_gravatar.png', 'image')?>" class="image circle"><div>&nbsp;</div>';
			}
		}
	},{
		data:'name',
	},{
		data:'createtime',
	},{
		data:'expiretime',
		render:function(data,full){
			if(data==null)
			{
				return '永不过期';
			}
			return data;
		}
	},{
		data:'usetime',
		render:function(data,full) {
			if(data == null)
			{
				return '未使用';
			}
			var use_type = '';
			switch(full.use_type)
			{
				case 'room':use_type = '住房订单';break;
				case 'food':use_type = '餐饮订单';break;
				case 'service':use_type = '服务订单';break;
				case 'shop':use_type = '商城订单';break;
				case 'transfer':use_type = '转移';break;
			}
			return data+'<br>'+use_type+'<br>'+full.use_no;
		}
	},{
		data:'transfer',	
		render:function(data,full){
			return data==1?'是':'否';
		}
	},{
		data:'source',
	},{
		data:'id',
		render:function(data,full){
			content = '';
			return content;
		}
	},{
		data:'use_type',
		visible:false,
	},{
		data:'use_no',
		visible:false,
	},{
		data:'group_id',
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

$('#search').on('submit',function(){
	//table.search($(this).find('input').val());
	table.addAjaxParameter('keywords',$(this).find('input[name=keywords]').val());
	table.addAjaxParameter('starttime',$(this).find('input[name=starttime]').val());
	table.addAjaxParameter('endtime',$(this).find('input[name=endtime]').val());
	table.addAjaxParameter('usetime',$(this).find('select[name=usetime]').val());
	table.page(0);
	table.reload();
	return false;
});
</script>
</body>
</html>