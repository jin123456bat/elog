<?php
use App\Helper\Assets;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<title>日志管理系统</title>
<!-- 所有页面使用的样式 -->
<link rel="stylesheet" href="<?=Assets::css('main.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=Assets::css('spop.min.css')?>" type="text/css" media="all" />
<!-- 当前页面的插件使用的样式 -->
<link rel="stylesheet" href="<?=Assets::css('datatables.css')?>" type="text/css" media="all" />
<!-- 当前页面使用的样式 -->
<link rel="stylesheet" href="<?=Assets::css('admin/index.css')?>" type="text/css" media="all" />
</head>
<body>
	@include('common.header')
	<div class="container">
		@include('common.sidebar')
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
							<p>管理员列表</p>
						</div>
					</div>
					<div class="line">
						<a class="button button-outline-red button-small" href="<?=url('admin/create')?>" title="create_admin">添加管理员</a>
						<form id="search" class="col-md-5 pull-right" style="display: inline-block;">
							<button class="button pull-right primary">搜索</button>
							<input type="text" placeholder="用户名/真实姓名/邮箱/手机号码" class="input_text pull-right col-md-3">
						</form>
					</div>
					<div class="tablebox">
						<table id="table" class="table" data-ajax-url="<?=url('admin/index')?>">
							<thead>
								<tr>
									<th>
										<input type="checkbox" class="all_checked">
									</th>
									<th>头像</th>
									<th>用户名</th>
									<th>真实姓名</th>
									<th>邮箱</th>
									<th>手机号码</th>
									<th>微信</th>
									<th>角色</th>
									<th>创建时间</th>
									<th>登陆时间</th>
									<th>锁定状态</th>
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
	</div>
	@include('common.footer')
	<!-- 通用js -->
	<script type="text/javascript" src="<?=Assets::js('jquery.min.js','js')?>"></script>
	<!-- 全局js调用 -->
	<script type="text/javascript" src="<?=Assets::js('global.js')?>"></script>
	<!-- 当前页面使用的第三方类库的js -->
	<script type="text/javascript" src="<?=Assets::js('datatables.js')?>"></script>
	<script type="text/javascript" src="<?=Assets::js('spop.min.js')?>"></script>
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
		data:'gravatar',
		render:function(data,full){
			if(data!=null)
			{
				return '<img class="image circle" src="'+data+'" onerror="this.src=\'<?=Assets::image('default_gravatar.png', 'image')?>\';">';
			}
			return '';
		}
	},{
		data:'username',
	},{
		data:'realname',
	},{
		data:'email',
	},{
		data:'mobile',
	},{
		data:'wechat_openid',
		render:function(data,full){
			return data==null?'未绑定':'已绑定';
		}
	},{
		data:'role',
		render:function(data,full){
			if(full.issupper==1)
			{
				return '<div class="label info">超级管理员</div>';
			}
			if(data == null)
			{
				return '<div class="label disable">无角色</div>';
			}
			return '<div class="label primary">'+data+'</div>';
		}
	},{
		data:'createtime',
	},{
		data:'logintime',
		render:function(data,full){
			if(data==null)
			{
				return '尚未登陆';
			}
			return data;
		}
	},{
		data:'islock',
		render:function(data,full){
			return data==1?'已锁定':'正常';
		}
	},{
		data:'id',
		render:function(data,full){
			content = '';
			content += '<a class="button button-xs edit" title="update_admin" data-id="'+full.id+'">查看/编辑</a>';
			content += '<a class="button button-xs remove" title="delete_admin" data-id="'+full.id+'">删除</a>';
			return content;
		}
	},{
		data:'issupper',
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
});
</script>
</body>
</html>