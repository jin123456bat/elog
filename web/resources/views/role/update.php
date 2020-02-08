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
<link rel="stylesheet" href="<?=assets::css('form.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('button.loading.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::common('style.min.css','css')?>" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" media="all" href="<?=assets::path('font-awesome/css/font-awesome.min.css','vendor')?>">
<link rel="stylesheet" href="<?=assets::css('panel.css')?>" type="text/css" media="all" />
<!-- 当前页面使用的样式 -->
<link rel="stylesheet" href="<?=assets::css('admin/update.css')?>" type="text/css" media="all" />
<style>
.blue {
	color: #3d93d7;
}
</style>
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
				<form class="form" id="baseForm" action="<?=url('role/update')?>" data-id="<?=Request::get('id')?>">
					<div class="white-block">
						<div class="form-title">基础信息</div>
						<div class="form-group col-md-10">
							<label class="label col-md-1">角色名称</label>
							<input type="text" class="input_text col-md-2" name="name" value="<?=$role['name']?>" placeholder="角色名称">
						</div>
						<div class="form-group col-md-10">
							<label class="label col-md-1">备注</label>
							<input type="text" class="input_text col-md-2" name="note" value="<?=$role['note']?>" placeholder="备注">
						</div>
					</div>
					<div class="line"></div>
					<div class="white-block">
						<div class="form-title">权限信息</div>
						<div style="display: flex; flex-flow: row nowrap; justify-content: space-between; align-items: flex-start;">
							<div class="panel col-md-2" style="margin-left: 0px;">
								<div class="panel-head">
									<div class="panel-title">页面权限</div>
								</div>
								<div class="panel-body" id="privileges_tree"></div>
							</div>
							<div class="panel col-md-8" style="margin-right: 0px;">
								<div class="panel-head">
									<div class="panel-title">按钮权限</div>
								</div>
								<div class="panel-body" id="privileges_table"></div>
							</div>
						</div>
						<div class="form-submit">
							<div class="center-block submit-body">
								<button type="submit" class="button button-submit button-large">保存</button>
								<button type="reset" class="button button-cancel button-large">重置</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	{include file='common/footer' /}
<script type="text/html" id="tpl_template1">
<div class="col-md-10 privilege-title" data-id="[mid]">
	<h4 style="margin-top: 10px;margin-bottom: 10px;">
		<strong style="font-weight: 700;font-size: 18px;">[m_title]</strong>
	</h4>
</div>
</script>
<script type="text/html" id="tpl_template">
<div class="col-md-2 privilege" data-parent="[mid]">
	<label class="checkbox-for center-block">
		<input type="checkbox" value="[id]">[text]
	</label>
</div>
</script>
<!-- 通用js -->
<script type="text/javascript" src="<?=assets::common('jquery.min.js','js')?>"></script>
<!-- 全局js调用 -->
<script type="text/javascript" src="<?=assets::js('global.js')?>"></script>
<script type="text/javascript" src="<?=assets::js('spop.min.js')?>"></script>
<!-- 当前页面使用插件的js -->
<script type="text/javascript" src="<?=assets::js('button.loading.js')?>"></script>
<script type="text/javascript" src="<?=assets::common('jstree.min.js','js')?>"></script>
<script>
$.ajaxSetup({
	headers: {
        '__token__': '<?=Request::token('__token__')?>' ,
    },
});
</script>
<!-- 当前页面独有的js -->
<script type="text/javascript" src="<?=assets::js('role/update.js')?>"></script>
<script>

	var loaded_button_privileges = [];
	var load_privileges_button = function(id,checked_id){
		$.ajax({
			url:'<?=url('privilege/jstree_button')?>',
			data:{
				id:id,
				expect:loaded_button_privileges,
			},
			method:'post',
			dataType:'json',
			async:true,
			success:function(response){
				var reg = new RegExp("\\[([^\\[\\]]*?)\\]", 'igm');
				for(var i=0;i<response.length;i++)
				{
					if($('#privileges_table').find('.privilege-title[data-id='+response[i].mid+']').length==0)
					{
						var template1 = $($('#tpl_template1').html().replace(reg, function (node, key) {
							return response[i][key];
						}));
						template1.appendTo($('#privileges_table'));
					}

					var template = $($('#tpl_template').html().replace(reg, function (node, key) {
						return response[i][key];
					}));
					
					if(checked_id)
					{
						if($.inArray(response[i].id,checked_id)!=-1)
						{
							template.find('input').prop('checked',true);
						}
					}
					else
					{
						template.find('input').prop('checked',true);
					}
					
					if($('#privileges_table').find('.privilege[data-parent='+response[i].mid+']').length==0)
					{
						template.insertAfter($('#privileges_table').find('.privilege-title[data-id='+response[i].mid+']'));
					}
					else
					{
						template.insertAfter($('#privileges_table').find('.privilege[data-parent='+response[i].mid+']:last'));
					}
					if($.inArray(response[i].mid,loaded_button_privileges)===-1)
					{
						loaded_button_privileges.push(response[i].mid);
					}
				}
			}
		});
	};

	
	$('#privileges_tree').jstree({
		plugins: [
			"checkbox",  //checkbox
			"types",// 不同的图标
			'conditionalselect',
		],
		conditionalselect : function (node, event) {
			if(!node.state.selected)
			{
				//把选择节点的所有子权限都加载出来
				load_privileges_button(node.id);
			}
			else
			{
				$.post('<?=url('privilege/privilege_son_menu')?>',{id:node.id},function(response){
					for(var i=0;i<response.length;i++)
					{
						if(loaded_button_privileges.indexOf(response[i])!==-1)
						{
							loaded_button_privileges.splice(loaded_button_privileges.indexOf(response[i]),1);
						}
						$('#privileges_table').find('.privilege[data-parent='+response[i]+']').remove();
						$('#privileges_table').find('.privilege-title[data-id='+response[i]+']').remove();
					}
				});
			}
			return true;
		},
		core: {
			check_callback : true,
			data : {
				url : function (node) {
				  return '<?=url('privilege/jstree')?>';
				},
				data : function (node) {
				  return { 'id' : node.id };
				},
				method:'post',
			}
		},
		types : {
			folder : {
				icon : "fa fa-folder blue"
			},
			file : {
				icon : "fa fa-file blue"
			}
		},
	}).on('loaded.jstree',function(){
		$('#privileges_tree').jstree().open_all();
	}).on('ready.jstree',function(){
		$.post('<?=url('role/load_jstree')?>',{id:'<?=Request::get('id')?>'},function(response){
			if(response.code==1)
			{
				$_button = response.data.button;
				
				$_check_node = [];
				$.each(response.data.page,function(index,value){
					$_check_node.push($('#privileges_tree').jstree("get_node", value));
					load_privileges_button(value,$_button);
				});
				$('#privileges_tree').jstree().check_node($_check_node);
			}
			else
			{
				spop({
				    template: response.message,
				    style:'error',
				    autoclose: 3000,
				    position:'bottom-right',
				    icon:true,
				    group:false,
				});
			}
		});
	});

	$('.button-submit').on('click',function(){
		var name = $.trim($('input[name=name]').val());
		var note = $.trim($('input[name=note]').val());
		var $this = $(this);
		
		var button = [];
		$('#privileges_table').find('input[type=checkbox]:checked').each(function(index,value){
			button.push($(value).val());
		});
		
		var page = $('#privileges_tree').jstree().get_checked();
		var privileges = {
				button:button,
				page:page,
		};
		$this.loading('start');
		$.post('<?=url('role/update')?>',{id:'<?=Request::get('id')?>',name:name,note:note,privileges:privileges},function(response){
			$this.loading('stop');
			if(response.code==1)
			{
				spop({
				    template: response.message,
				    style: response.code==1?'success':'error',
				    autoclose: 3000,
				    position:'bottom-right',
				    icon:true,
				    group:false,
				    
				});
				return false;
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

	</script>
</body>
</html>