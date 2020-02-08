<?php
use jin123456bat\assets;
use think\facade\Request;
use jin123456bat\hotelController;
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
<style>
.coupon_line{
	display:flex;
}
</style>
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
							<p>活动管理</p>
						</div>
					</div>
					<div class="line pull-right">
						<?php if (companyController::checkButtonPrivilege('create_activity')){?>
						<a class="button button-outline-red button-small" href="<?=url('activity/create')?>" title="create_activity">创建活动</a>
						<?php }?>
						<form id="search" class="col-md-5 pull-right" style="display: inline-block;">
							<button class="button pull-right primary">搜索</button>
							<input type="text" placeholder="活动名称" class="input_text pull-right col-md-3">
						</form>
					</div>
					<table id="table" class="table" data-ajax-url="<?=url('activity/index')?>">
						<thead>
							<tr>
								<th>
									<input type="checkbox" class="all_checked">
								</th>
								<th>活动名称</th>
								<th>触发点</th>
								<th>奖励</th>
								<th>奖励次数</th>
								<th>创建时间</th>
								<th>有效时间</th>
								<th>创建者</th>
								<th>状态</th>
								<th>触发次数</th>
								<th width="300px">操作</th>
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
				case 'subscribe_wechat':return '关注公众号';
				}
				return '';
			}
		},{
			data:'type',
			render:function(data,full){
				if(data == 'money')
				{
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
				else if(data == 'payuser')
				{
					var money = parseFloat(full.content/100).toFixed(2);
					if(money<1)
					{
						return '微信金额奖励<br>实际支付金额*'+parseFloat(full.content/100).toFixed(2);
					}
					return '微信金额奖励<br>'+parseFloat(full.content/100).toFixed(2);
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
			}
		},{
			data:'active_num_per',
			render:function(data,full){
				return data==0?'不限制':data;
			}
		},{
			data:'createtime',
		},{
			data:'starttime',
			render:function(data,full){
				if(full.starttime == null && full.endtime == null)
				{
					return '永久有效';
				}
				if(full.starttime == null)
				{
					var starttime = '不限制';
				}
				else
				{
					var starttime = full.starttime;
				}
				if(full.endtime == null)
				{
					var endtime = '不限制';
				}
				else
				{
					var endtime = full.endtime;
				}
				return starttime+'~'+endtime;
			}
		},{
			data:'company_admin_name',
			render:function(data,full){
				return data==1?'有效':'无效';
			}
		},{
			data:'status',
			render:function(data,full){
				return data==1?'有效':'无效';
			}
		},{
			data:'num',
		},{
			data:'id',
			render:function(data,full){
				content = '';
				<?php if (companyController::checkButtonPrivilege('update_activity')){?>
				content += '<a class="button button-xs edit" title="update_activity" data-id="'+full.id+'">查看/编辑</a>';
				<?php }?>
				<?php if (companyController::checkButtonPrivilege('activity_log')){?>
				content += '<a class="button button-xs log" title="activity_log" data-id="'+full.id+'">日志</a>';
				<?php }?>
				<?php if (companyController::checkButtonPrivilege('delete_activity')){?>
				content += '<a class="button button-xs remove" title="delete_activity" data-id="'+full.id+'">删除</a>';
				<?php }?>
				
				return content;
			}
		},{
			data:'endtime',
			visible:false,
		},{
			data:'content',
			visible:false,
		},{
			data:'company_admin_id',
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

	$('table').on('click','.edit',function(){
		var id = $(this).data('id');
		window.location = '<?=url('activity/update')?>?id='+id;
	}).on('click','.remove',function(){
		$.post('<?=url('activity/delete')?>',{id:$(this).data('id')},function(response){
			if(response.code==1)
			{
				table.reload();
			}
			spop({
			    template: response.message,
			    style: response.code==1?'success':'error',
			    autoclose: 3000,
			    position:'bottom-right',
			    icon:true,
			    group:false,
			});
		});
	}).on('click','.log',function(){
		var id = $(this).data('id');
		window.location = '<?=url('activity/log')?>?id='+id;
	});
});

</script>
</body>
</html>