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
							<p>cms的滚动图管理</p>
						</div>
					</div>
					<div class="line">
						<?php if (companyController::checkButtonPrivilege('create_cms_banner')){?>
						<a class="button button-outline-red button-small" href="<?=url('cms/banner_create')?>" title="create_cms_banner">添加滚动图</a>
						<?php }?>
					</div>
					<div class="tablebox">
						<table id="table" class="table" data-ajax-url="<?=url('cms/banner_index')?>">
							<thead>
								<tr>
									<th>
										<input type="checkbox" class="all_checked">
									</th>
									<th>LOGO</th>
									<th>名称</th>
									<th>描述</th>
									<th>链接地址</th>
									<th>创建时间</th>
									<th>排序</th>
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
		data:'id',
		pk:true,
		render:function(data,full){
			return '<input type="checkbox" name="id[]" value="'+data+'">';
		}
	},{
		data:'logo_path',
		render:function(data,full){
			if(data!=null)
			{
				return '<img width="100" height="100" class="image" src="'+data+'" onerror="this.src=\'<?=assets::common('default_gravatar.png', 'image')?>\';">';
			}
			return '';
		}
	},{
		data:'name',
	},{
		data:'description',
		render:function(data,full){
			return data.substr(0,50);
		}
	},{
		data:'link',
	},{
		data:'createtime',
	},{
		data:'sort',
	},{
		data:'id',
		render:function(data,full){
			content = '';
			<?php if (companyController::checkButtonPrivilege('update_cms_banner')){?>
			content += '<a class="button button-xs edit" title="update_cms_banner" data-id="'+full.id+'">查看/编辑</a>';
			<?php }?>
			<?php if (companyController::checkButtonPrivilege('delete_cms_banner')){?>
			content += '<a class="button button-xs remove" title="delete_cms_banner" data-id="'+full.id+'">删除</a>';
			<?php }?>
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
	window.location = '<?=url('cms/banner_update')?>?id='+id;
}).on('click','.remove',function(){
	$.post('<?=url('cms/banner_delete')?>',{id:$(this).data('id')},function(response){
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