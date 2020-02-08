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
							<p>小程序管理</p>
						</div>
					</div>
					<div class="line pull-right">
						<?php if (companyController::checkButtonPrivilege('create_program')){?>
						<a href="<?=url('program/create')?>" class="button button-outline-red button-small" title="create_program">添加绑定小程序</a>
						<?php }?>
						<form id="search" class="col-md-5 pull-right">
							<button class="button primary pull-right">搜索</button>
							<input type="text" placeholder="名称/appid" class="input_text col-md-3 pull-right">
						</form>
					</div>
					<div class="tablebox">
						<table id="table" class="table" data-ajax-url="<?=url()?>">
							<thead>
								<tr>
									<th>名称</th>
									<th>appid</th>
									<th>appsecret</th>
									<th>token</th>
									<th>加密方式</th>
									<th>数据类型</th>
									<th>认证</th>
									<th>操作</th>
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
<script type="text/javascript" src="<?=assets::js('jquery.dialog.js')?>"></script>
<script>
$.ajaxSetup({
	headers: {
        '__token__': '<?=Request::token('__token__')?>' ,
    },
});
</script>
<!-- 当前页面独有的js -->
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
			data:'name',
		},{
			data:'appid',
		},{
			data:'appsecret',
		},{
			data:'token',
		},{
			data:'encoding_type',
			render:function(data,full){
				return data==''?'不加密':data;
			}
		},{
			data:'data_type',
		},{
			data:'auth',
			render:function(data,full){
				return data==1?'通过':'未通过';
			}
		},{
			data:'id',
			render:function(data,full){
				content = '<a class="button button-xs update" data-id="'+data+'">修改</a>';
				content += '<a class="button button-xs template_message" data-id="'+data+'">模板消息配置</a>';
				content += '<a class="button button-xs remove" data-id="'+data+'">删除</a>';
				return content;
			}
		}],
		sort:{
			id:'desc',
		},
		pagesize:10,
		onRowLoaded:function(row){
			
		}
	});
	
	$('#table').on('click','.update',function(){
		var id = $(this).data('id');
		window.location = '<?=url('program/update')?>?id='+id;
		return false;
	}).on('click','.template_message',function(){
		var id = $(this).data('id');
		window.location = '<?=url('ProgramTemplateMessage/index')?>?id='+id;
		return false;
	}).on('click','.remove',function(){
		var id = $(this).data('id');
		$.confirm({
			title:'删除小程序绑定',
			content:'确认删除该小程序绑定?',
			success:function(){
				$.post('<?=url('program/delete')?>',{id:id},function(response){
					if(response.code==1)
					{
						table.reload();
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
	
	$('#search').on('submit',function(){
		table.search($(this).find('input').val());
		return false;
	});
});
</script>
</body>
</html>