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
							<p>微信消息</p>
						</div>
					</div>
					<div class="line pull-right">
					<?php if (hotelController::checkButtonPrivilege('all_send')){?>
						<a class="button button-outline-red button-small" href="<?=url('message/send')?>" title="create_room_type">消息群发</a>
					<?php }?>
					<form id="search" class="col-md-5 pull-right" style="display: inline-block;">
							<button class="button pull-right primary">搜索</button>
							<input type="text" placeholder="用户" class="input_text pull-right col-md-3">
						</form>
					</div>
					<table id="table" class="table" data-ajax-url="<?=url('message/log')?>">
						<thead>
							<tr>
								<th>发送对象</th>
								<th>管理员</th>
								<th>发送内容</th>
								<th>发送方式</th>
								<th>发送结果</th>
								<th>发送时间</th>
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
			data:'group_id',
		},{
			data:'admin_name',
		},{
			data:'content',
		},{
			data:'type',
		},{
			data:'send_result',
		},{
			data:'createtime',
		},{
			data:'admin_id',
			visible:false,
		}],
		columnDefs:[{
			targets:0,
			render:function (data,full) {
				var content = '全部';
				if(full.group_id){
					content = full.group_id;
				}
				return content;
			}
		},{
			targets:2,
			render:function(data,full){
				return '<div style="white-space: normal;text-align: left;">'+data+'</div>';
			}
		},{
			targets:3,
			render:function (data,full) {
				var content = '';
				if(full.type == 1){
					content = '短信发送';
				}else{
					content = '微信发送';
				}
				return content;
			}
		},{
			targets:4,
			render:function (data,full) {
				var content = '';
				if(full.send_result == 0){
					content = '正在发送';
				}else if(full.send_result == 1){
					content = '已发送';
				}else{
					content = '发送失败';
				}
				return content;
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

	$('table').on('click','.edit',function(){
		var id = $(this).data('id');
		window.location = '<?=url('message/send')?>?id='+id;
	}).on('click','.remove',function(){
		$.post('<?=url('room_type/delete')?>',{id:$(this).data('id')},function(response){
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
	});
</script>
</body>
</html>
