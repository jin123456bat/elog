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
</head>
<!-- 所有页面使用的样式 -->
<link rel="stylesheet" href="<?=assets::css('main.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('spop.min.css')?>" type="text/css" media="all" />
<!-- 当前页面的插件使用的样式 -->
<link rel="stylesheet" href="<?=assets::css('datatables.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('jquery.modal.css')?>" type="text/css" media="all">
<link rel="stylesheet" href="<?=assets::css('form.css')?>" type="text/css" media="all">
<style>
.guser {
	border: 1px solid #cccccc;
	min-height: 60px;
	border-radius: 5px;
}

.modal-body {
	padding: 10px;
}

.guser-span {
	float: left;
	border: 1px solid #ccc;
	text-align: center;
	margin-top: 5px;
	margin-left: 3px;
	height: 20px;
	padding: 1px;
	font-size: 12px;
}

.div-delete {
	width: 15px;
	height: 15px;
	background-color: #ccc;
	border-radius: 25px;
	float: right;
	margin-left: 5px;
	cursor: pointer;
}

.ob-div {
	padding-top: 10px;
	padding-bottom: 10px;
}

.submit-footer {
	text-align: center;
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
							<p>优惠码列表</p>
						</div>
					</div>
					<div class="line pull-right">
						<?php if (companyController::checkButtonPrivilege('create_coupon')){?>
						<a href="<?=url('coupon/create')?>" class="button button-outline-red button-small" title="create_coupon">添加优惠码</a>
						<?php }?>
						<form id="search" class="col-md-5 pull-right" style="display: inline-block;">
							<button class="button pull-right primary">搜索</button>
							<input type="text" placeholder="优惠码" class="input_text pull-right col-md-3">
						</form>
					</div>
					<div class="tablebox">
						<table id="table" class="table" data-ajax-url="<?=url('coupon/index')?>">
							<thead>
								<tr>
									<th>
										<input type="checkbox" class="all_checked">
									</th>
									<th>优惠码</th>
									<th>名称</th>
									<th>创建人</th>
									<th>领取时间</th>
									<th>有效期/天</th>
									<th>每人可领取</th>
									<th>累计可领取</th>
									<th>会员组</th>
									<th>赠送</th>
									<th>已领取</th>
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
	<div class="modal-bg display-none" id="sendCouponModal">
		<div class="modal-container" style="left: calc(50% - 600px);width: 1190px;">
			<div class="modal-header">
				<div class="modal-title">
					发送优惠券
					<button class="close">X</button>
				</div>
			</div>
			<div class="modal-body">
				<div class="top-tips col-md-10 center-block">
					<div class="top-tips-body">
						<p>可选择会员组,用户</p>
					</div>
				</div>
				<div class="line"></div>
				<form id="sendCouponFrom" action="<?=url('send')?>" method="post" class="form">
					<input type="hidden" name="send_id">
					<div class="form-group col-md-10">
						<label class="col-md-2 label">发送对象选择</label>
						<select class="col-md-5 select select-object" name="type">
							<option value="1">用户</option>
							<option value="3">会员组</option>
						</select>
					</div>
					<div class="line pull-right"></div>
					<div class="form-group col-md-10 div-select select-1">
						<div class="form-group col-md-10 ob-div">
							<label class="label col-md-2">对象</label>
							<div class="col-md-5 guser"></div>
						</div>
					</div>
					<div class="form-group col-md-10 div-select select-3 display-none">
						<label class="col-md-2 label">会员组</label>
						<select class="col-md-5 select" name="vip_group">
							<?php foreach ($ugroup as $vip_group){?>
							<option value="<?=$vip_group['id']?>">
								<?=$vip_group['name']?>
							</option>
							<?php }?>
						</select>
					</div>
				</form>
				<div class="col-md-10 div-select select-1">
					<div class="line pull-right">
						<form id="search_user" class="col-md-10" action="<?=url('user/index')?>">
							<input type="text" name="keywords" placeholder="用户名/真实姓名/邮箱/手机号码" class="input_text">
							<button type="submit" class="button primary">搜索</button>
						</form>
					</div>
					<table class="table" id="user" data-ajax-url="<?=url('user/index')?>">
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
								<th>会员组</th>
								<th width="300px">操作</th>
							</tr>
						</thead>
						<tbody></tbody>
						<tfoot>
							<tr>
								<td colspan="4">
									<select class="select select-small col-md-10 do-multiple">
										<option value="">批量操作</option>
										<option value="click-select">批量选择</option>
									</select>
								</td>
								<td id="split_page" colspan="20"></td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="submitModal">发放</button>
				<button type="button" class="close">取消</button>
			</div>
		</div>
	</div>
	<!-- 通用js -->
	<script type="text/javascript" src="<?=assets::common('jquery.min.js','js')?>"></script>
	<!-- 全局js调用 -->
	<script type="text/javascript" src="<?=assets::js('global.js')?>"></script>
	<!-- 当前页面使用的第三方类库的js -->
	<script type="text/javascript" src="<?=assets::js('datatables.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('spop.min.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('jquery.modal.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('button.loading.js')?>"></script>
	<script type="text/javascript" src="<?=assets::common('jquery.validate.min.js','js')?>"></script>
	<script type="text/javascript" src="<?=assets::common('messages_zh.min.js','js')?>"></script>
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
		data:'id',
		pk:true,
		render:function(data,full){
			return '<input type="checkbox" name="id[]" value="'+data+'">';
		}
	},{
		data:'code',
		render:function(data,full){
			return data==null?'':data;
		}
	},{
		data:'name',
	},{
		data:'creator',
		render:function(data,full){
			content = data;
			if(full.creator_range == 'hotel')
			{
				content += '<br>酒店管理员';
			}
			else if(full.creator_range == 'company')
			{
				content += '<br>集团管理员';
			}
			return content;
		}
	},{
		data:'gettime_start',
		render:function(data,full){
			if(full.gettime_start == null && full.gettime_end == null)
			{
				return '不限制';
			}
			var start = full.gettime_start;
			if(start == null)
			{
				start = '不限制';
			}
			else
			{
				start = full.gettime_start;
			}
			var end = full.gettime_end;
			if(end == null)
			{
				end = '不限制';
			}
			else
			{
				end = full.gettime_end;
			}
			return start+' ~ '+end;
		}
	},{
		data:'days',
		render:function(data,full){
			if(data == 0)
			{
				return '永久有效';
			}
			return data;
		}
	},{
		data:'get_num_per',
		render:function(data,full){
			if(data==null)
			{
				return '不限制';
			}
			return data;
		}
	},{
		data:'get_num_total',
		render:function(data,full){
			if(data==null)
			{
				return '不限制';
			}
			return data;
		}
	},{
		data:'group_name',
		render:function(data,full){
			if(data == null)
			{
				return '不限制';
			}
			return data;
		}
	},{
		data:'transfer',
		render:function(data,full) {
			if(data == 1)
			{
				return  '是';
			}
			else
			{
				return '否';
			}
		}
	},{
		data:'get_num',
	},{
		data:'id',
		render:function(data,full){
			content = '';
			<?php if (companyController::checkButtonPrivilege('update_coupon')){?>
			content += '<a class="button button-xs edit" title="update_coupon" data-id="'+full.id+'">编辑</a>';
			<?php }?>
			<?php if (companyController::checkButtonPrivilege('delete_coupon')){?>
			content += '<a class="button button-xs remove" title="delete_coupon" data-id="'+full.id+'">删除</a>';
			<?php }?>
			<?php if (companyController::checkButtonPrivilege('send_coupon')){?>
			content += '<a class="button button-xs send" id="sendCouponHref" title="send_coupon" data-id="'+full.id+'">发放优惠券</a>';
			<?php }?>
			return content;
		}
	},{
		data:'creator_range',
		visible:false,
	},{
		data:'gettime_end',
		visible:false,
	},{
		data:'group_id',
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

//切换发送对象
$('.select-object').on('change',function () {
	var type = $('.select-object option:selected').val();
	$('.div-select').addClass('display-none');
	$('.select-'+type).removeClass('display-none');
});

//选择用户table
var table_user = datatables({
	table:$('#user'),
	ajax:{
		data:{
		},
		method:'post'
	},
	columns:[{
		data:'id',
		render:function (data,full) {
			return '<input type="checkbox" name="id[]" value="'+data+'">';
		},
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
		render:function (data,full) {
			if(data==null){
				return '';
			}
			return data;
		}
	},{
		data:'username',
		render:function (data,full) {
			if(data==null){
				return '';
			}
			return data;
		}
	},{
		data:'email',
	},{
		data:'telephone',
		render:function (data,full) {
			if(data==null){
				return '';
			}
			return data;
		}
	},{
		data:'sex',
		render:function (data,full) {
			if(data==1)
			{
				return '男';
			}
			else if(data==2)
			{
				return '女';
			}
			else
			{
				return '未知';
			}
		}
	},{
		data:'group_name'
	},{
		data:'id',
		render:function (data,full) {
			return '<a class="button button-xs click-select" title="" data-name="'+full.nickname+'"+ data-id="'+full.id+'">点击选取</a>'
		}
	}],
	sort:{
	},
	pagesize:5,
});

//用户搜索
$('#search_user').on('submit',function () {
	table_user.search($(this).find('input[name=keywords]').val());
	return false;
});

//选择用户
$('#user').on('click','.click-select',function () {
	var id = $(this).data('id');
	var nickname = $(this).data('name');
	var users = [];
	$('.guser .guser-span').each(function(){
		users.push($(this).data('id'));
	});
	var index = $.inArray(id,users);
	if(index < 0)
	{
		$('.guser').append('<div class="guser-span" data-id="'+id+'">'+nickname+'<div class="div-delete">x</div></div>');
	}
});

//批量选择用户
$('#user .do-multiple').on('change',function(){
	var length = $('#user').find('tbody input[type=checkbox]:checked').length;
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
		case 'click-select':
			var users = [];
			$('.guser .guser-span').each(function(){
				users.push($(this).data('id'));
			});

			$('#user').find('tbody input[type=checkbox]:checked').parents('tr').each(function(){
				var id = $(this).find('.click-select').data('id');
				var nickname = $(this).find('.click-select').data('name');

				var index = $.inArray(id,users);
				if(index < 0)
				{
					$('.guser').append('<div class="guser-span" data-id="'+id+'">'+nickname+'<div class="div-delete">x</div></div>');
				}
			});

			break;
	}
	$(this).val('');
});


//删除选中的用户
$('.guser').on('click','.guser-span',function () {
	$(this).remove();
	return false;
});

//发送优惠券提交
$('#sendCouponModal .submitModal').on('click',function(){
	var users = [];
	$('.guser .guser-span').each(function(){
		users.push($(this).data('id'));
	});
	var data = {
		type:$.trim($('#sendCouponFrom').find('select[name=type] option:selected').val()),
		users:users,
		vip_group:$('#sendCouponFrom').find('select[name=vip_group] option:selected').val(),
		id:$('input[name=send_id]').val()
	};

	$('#sendCouponModal .submitModal').loading('start',{
		text:'正在发放...',
	});
	$.post($('#sendCouponFrom').attr('action'),data,function(response){
		$('#sendCouponModal .submitModal').loading('stop');
		if(response.code==1)
		{
			$('#sendCouponModal').modal('hide');
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

$('table').on('click','.edit',function(){
	var id = $(this).data('id');
	window.location = '<?=url('coupon/update')?>?id='+id;
	return false;
}).on('click','.remove',function(){
	$.post('<?=url('coupon/delete')?>',{id:$(this).data('id')},function(response){
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
	return false;
}).on('click','#sendCouponHref',function () {
	var id = $(this).data('id');
	$('input[name=send_id]').val(id);
	$('#sendCouponModal').modal("show");
});
</script>
</body>
</html>