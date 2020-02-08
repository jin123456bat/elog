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
<link rel="stylesheet" href="<?=assets::css('jquery.modal.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('select.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::common('address.css','css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('form.css')?>" type="text/css" media="all" />
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
					<div class="top-tips">
						<div class="top-tips-title">操作提示</div>
						<div class="top-tips-body">
							<p>会员列表</p>
							<p>会员红包发送每个用户每一分钟只允许发送一次，如果发送失败，请从红包日志检查确认成功，不要重复发送</p>
						</div>
					</div>
					<div class="line">
						<form id="search" class="col-md-10">
							<input style="margin: 5px 0px;" name="keywords" type="text" placeholder="用户名/昵称/真实姓名/邮箱/手机号码" class="input_text col-md-2">
							<select name="group_id" class="col-md-2 selectpicker submit_input" multiple>
								<option value="" disabled="disabled" selected="selected">请选择会员组</option>
								<option value="0">普通会员（无会员组）</option>
								<?php foreach ($groups as $group){?>
								<option value="<?=$group['id']?>"><?=$group['name']?></option>
								<?php }?>
							</select>
							<select name="subscribe" class="col-md-2 selectpicker submit_input" multiple>
								<option value="" disabled="disabled" selected="selected">请选择关注状态</option>
								<option value="0">未关注</option>
								<option value="1">已关注</option>
								<option value="2">取消关注</option>
							</select>
							<input name="address" style="margin: 5px 0px;" type="text" class="input_text col-md-2 address_selector submit_input">
							<select name="sex" class="col-md-2 selectpicker submit_input" multiple>
								<option value="" disabled="disabled" selected="selected">请选择性别</option>
								<option value="0">未知</option>
								<option value="1">男</option>
								<option value="2">女</option>
							</select>
							<button class="button primary">搜索</button>
						</form>
					</div>
					<div class="tablebox">
						<table id="table" class="table" data-ajax-url="<?=url('user/index')?>">
							<thead>
								<tr>
									<th>
										<input type="checkbox" class="all_checked">
									</th>
									<th>头像</th>
									<th>昵称</th>
									<th>用户名</th>
									<th>邮箱</th>
									<th>手机号码</th>
									<th>性别</th>
									<th>省</th>
									<th>市</th>
									<th>区</th>
									<th>证件名称</th>
									<th>证件号码</th>
									<th>注册时间</th>
									<th>登入时间</th>
									<th>会员组</th>
									<th>公众号关注</th>
									<th>来源酒店</th>
									<th>余额</th>
									<th>佣金</th>
									<th>备注</th>
									<th width="300px">操作</th>
								</tr>
							</thead>
							<tbody></tbody>
							<tfoot>
								<tr>
									<td colspan="4">
										<select class="select select-small col-md-10 do-multiple">
											<option value="">批量操作</option>
											<option value="set_group_id">设置会员组</option>
										</select>
									</td>
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
	<div id="groupIdModal" class="modal-bg display-none">
		<div class="modal-container" style="top:30%;">
			<div class="modal-header">
				<div class="modal-title">
					设置会员组
					<button class="close">x</button>
				</div>
			</div>
			<form class="form" id="groupIdForm" action="<?=url('user/set_group_id')?>" method="post">
				<div class="modal-body">
					<div class="form-group col-md-10">
						<label class="label col-md-2">会员组</label>
						<select class="select col-md-7" name="group_id">
							<option value="">不分配会员组</option>
							<?php foreach ($groups as $group){?>
							<option value="<?=$group['id']?>"><?=$group['name']?></option>
							<?php }?>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit">确定</button>
					<button type="button" class="close">取消</button>
				</div>
			</form>
		</div>
	</div>
	<div id="redPackageModal" class="modal-bg display-none">
		<div class="modal-container" style="top:30%;">
			<div class="modal-header">
				<div class="modal-title">
					发送红包
					<button class="close">x</button>
				</div>
			</div>
			<form class="form" id="redPackageForm" action="<?=url('user/red_package')?>" method="post">
				<input type="hidden" name="user_id">
				<div class="modal-body">
					<div class="top-tips">
						<div class="top-tips-title">操作提示</div>
						<div class="top-tips-body">
							<p>会员红包发送每个用户每一分钟只允许发送一次，如果发送失败，请从红包日志检查确认成功，不要重复发送</p>
						</div>
					</div>
					<div class="line"></div>
					<div class="form-group col-md-10">
						<label class="label col-md-2 required">金额</label>
						<input class="input_text col-md-7" type="text" name="money">
					</div>
					<div class="form-group col-md-10">
						<label class="label col-md-2">付款账户</label>
						<select class="select col-md-7" name="hotel_id">
							<?php foreach ($hotels as $hotel){?>
							<option value="<?=$hotel['id']?>"><?=$hotel['name']?></option>
							<?php }?>
						</select>
					</div>
					<div class="form-group col-md-10">
						<label class="label col-md-2">祝福语</label>
						<input class="input_text col-md-7" type="text" name="wishing" placeholder="恭喜发财，大吉大利">
					</div>
					<div class="form-group col-md-10">
						<label class="label col-md-2">活动名称</label>
						<input class="input_text col-md-7" type="text" name="act_name" placeholder="红包发送">
					</div>
					<div class="form-group col-md-10">
						<label class="label col-md-2 required">备注</label>
						<input class="input_text col-md-7" type="text" name="remark">
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit">确定</button>
					<button type="button" class="close">取消</button>
				</div>
			</form>
		</div>
	</div>
	<!-- 通用js -->
	<script type="text/javascript" src="<?=assets::common('jquery.min.js','js')?>"></script>
	<!-- 全局js调用 -->
	<script type="text/javascript" src="<?=assets::js('global.js')?>"></script>
	<!-- 当前页面使用的第三方类库的js -->
	<script type="text/javascript" src="<?=assets::js('datatables.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('jquery.dialog.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('spop.min.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('jquery.modal.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('select.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('button.loading.js')?>"></script>
	<script type="text/javascript" src="<?=assets::common('address.js','js')?>"></script>
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
	
	$('.selectpicker').each(function(){
		$(this).select({
			search:true,//允许搜索
			class:'col-md-2',//设置额外样式
			style:{
				margin:'5px 0px',
			}
		});
	});

	$('.address_selector').each(function(){
		$(this).address({
			class:'col-md-2',//设置额外样式
			style:{
				margin:'5px 0px',
			}
		});
	});
	
	$('#table .do-multiple').on('change',function(){
		var length = $('#table').find('tbody input[type=checkbox]:checked').length;
		if(length == 0)
		{
			spop({
			    template: '请先勾选会员',
			    style: 'error',
			    autoclose: 3000,
			    position:'bottom-right',
			    icon:true,
			    group:false,
			});
			$(this).val('');
			return false;
		}
		
		switch($(this).val())
		{
			case 'set_group_id':
				$('#groupIdModal').modal('show');
				break;
		}
		$(this).val('');
	});

	$('#redPackageForm').on('submit',function(){
		var btn = $(this).find('button[type=submit]');
		btn.loading('start',{
			text:'载入中',
		});
		$.post($(this).attr('action'),$(this).serialize(),function(response){
			btn.loading('stop');
			if(response.code==1)
			{
				$('#redPackageModal').modal('hide');
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
		return false;
	});
	
	$('#groupIdForm').on('submit',function(){
		$.confirm({
			title:'更改会员组',
			content:'您确定要更改这些用户的会员组信息?',
			success:function(){
				var user_id = [];
				$('#table').find('tbody input[type=checkbox]:checked').each(function(index,value){
					user_id.push($(value).val());
				});
	
				var group_id = $('#groupIdForm select[name=group_id]').val();
	
				if(user_id.length == 0)
				{
					spop({
					    template: '请先勾选会员',
					    style: 'error',
					    autoclose: 3000,
					    position:'bottom-right',
					    icon:true,
					    group:false,
					});
				}
	
				$.post('<?=url('user/set_group_id')?>',{user_id:user_id,group_id:group_id},function(response){
					spop({
					    template: response.message,
					    style: response.code==1?'success':'error',
					    autoclose: 3000,
					    position:'bottom-right',
					    icon:true,
					    group:false,
					});
					if(response.code==1)
					{
						table.reload();
					}
				});
			}
		});
		$('#groupIdModal').modal('hide');
		return false;
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
			data:'gravatar',
			render:function(data,full){
				if(data!=null)
				{
					return '<img class="image circle" src="'+data+'" onerror="this.src=\'<?=assets::common('default_gravatar.png', 'image')?>\';">';
				}
				return '';
			}
		},{
			data:'nickname',
		},{
			data:'username',
			render:function(data,full){
				if(data == null)
				{
					return '';
				}
				return data;
			}
		},{
			data:'email',
		},{
			data:'telephone',
			render:function(data,full){
				if(data == null)
				{
					return '';
				}
				return data;
			}
		},{
			data:'sex',
			render:function(data,full){
				if(data==0)
				{
					return '未知';
				}
				return data==1?'男':'女';
			}
		},{
			data:'province',
		},{
			data:'city',
		},{
			data:'zone',
		},{
			data:'card_name',
			render:function(data,full){
				if(data == null)
				{
					return '';
				}
				return data;
			}
		},{
			data:'card_no',
			render:function(data,full){
				if(data == null)
				{
					return '';
				}
				return data;
			}
		},{
			name:'createtime',
			data:'user_company.createtime',
		},{
			name:'logintime',
			data:'user_company.logintime'
		},{
			data:'group_name',
		},{
			data:'subscribe',
			render:function(data,full){
				if(data==0)
				{
					return '未关注';
				}
				else if(data==1)
				{
					return '已关注';
				}
				else if(data==2)
				{
					return '已取关';
				}
	
				return '';
			}
		},{
			data:'first_hotel_name',
		},{
			data:'money',
			render:function(data,full){
				return parseFloat(data/100).toFixed(2);
			}
		},{
			data:'commission',
			render:function(data,full){
				return parseFloat(data/100).toFixed(2);
			}
		},{
			name:'remark',
			data:'user.remark',
			render:function(data,full){
				return data==null?'':data;
			}
		},{
			data:'id',
			render:function(data,full){
				content = '<a href="<?=url('user/detail')?>?id='+full.id+'" class="button button-xs">详细信息</a>';
				content += '<a data-id="'+full.id+'" class="button button-xs red_package">发送红包</a>';
				return content;
			}
		},{
			data:'card_type',
			visible:false,
		}],
		sort:{
			createtime:'desc',
		},
		pagesize:10,
		onRowLoaded:function(row){
			
		},
		afterTableLoaded:function(){
	  
		}
	});
	
	$('#search').on('submit',function(){
		//添加固定筛选项目
		table.addAjaxParameter('keywords',$(this).find('input[name=keywords]').val());
		//添加动态筛选项
		$(this).find('.submit_input').each(function(){
			table.ajaxData($(this).attr('name'),$(this).val());
		});
		//设置页码
		table.page(1);
		//重新载入
		table.reload();
		return false;
	});
	
	$('table').on('click','.edit',function(){
		var id = $(this).data('id');
		window.location = '<?=url('admin/update')?>?id='+id;
	}).on('click','.remove',function(){
		$.post('<?=url('admin/delete')?>',{id:$(this).data('id')},function(response){
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
	}).on('click','.red_package',function(){
		$('#redPackageForm input[name=user_id]').val($(this).data('id'));
		$('#redPackageModal').modal('show');
		return false;
	});
});
</script>
</body>
</html>