<?php
use jin123456bat\assets;
use think\facade\Request;
use jin123456bat\helper;
use jin123456bat\companyController;
use app\company\companyHelper;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title><?=$setting['site_title']?> | <?=$setting['site_desc']?></title>
  <link rel="stylesheet" href="/static/layui/css/layui.css" type="text/css" media="all" />
  <!-- 所有页面使用的样式 -->
  <link rel="stylesheet" href="<?=assets::css('main.css')?>"type="text/css" media="all" />
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
				<div class="layui-row">
				    <div class="layui-col-xs6">
					    <button class="layui-btn layui-btn-normal" onclick="load()"><i class="layui-icon">&#xe669;</i>刷新</button>
				    </div>
				     <div class="layui-col-xs6" style="text-align: right;">
				     	<?php if (companyController::checkButtonPrivilege('addCategory')){?>
						<button class="layui-btn layui-btn-normal" onclick="addCategory()" title="addCategory"><i class="layui-icon">&#xe608;</i> 添加分类</button>
						<?php }?>
					</div>
					<div class="layui-row">
						<table class="layui-hide" id="shopCategory" lay-filter="shopCategory"></table>
					</div>
				</div>
			</div>
		</div>
  	</div>
  </div>
</body>
<script src="/static/common/js/jquery.min.js"></script>
<script src="/static/layui/layui.all.js"></script>
<script type="text/javascript">
layui.use('table', function(){
	var table = layui.table;
	table.render({
	    elem: '#shopCategory'
	    ,url:'<?=url('shopCategory/categoryList',array('company_id'=>companyHelper::getCompanyId()))?>'
	    ,parseData: function(res){
		    return {
		      "code": res.code, 
		      "msg": res.message, 
		      "data": res.data,
		      'count':res.total
		    };
		}
		,page:{
	    	theme: '#1E9FFF',
	    	limit:20
	    }
	    ,cols: [[
	      {field:'category_id', width:'10%', title: 'ID', sort: true}
	      // ,{field:'logo_id', width:'20%', title: 'logo',templet:'#logo'}
	      ,{field:'name', width:'70%', title: '名称',edit: 'text'}
	      ,{field:'parent_category_id', width:'10%', title: '上级ID',templet: '#parent_category_id'}
	      ,{field:'stting', width:'10%', title: '操作',templet: '#setting',align:'center'}
	    ]]
	});
	//监听事件
  	table.on('tool(shopCategory)', function(obj){
	  var data = obj.data;
	  var id = data.category_id;
	  var layEvent = obj.event; 
	  var tr = obj.tr;
	  //修改
	  if(layEvent === 'show'){
	  	window.location.href = "<?=url('ShopCategory/saveCategory')?>"+'?category_id='+id;
	  }
	  //删除
	  if(layEvent === 'del'){
	  	$.ajax({
	  		type:'post',
	  		url:"<?=url('ShopCategory/delCategory')?>",
	  		data:{category_id:id},
	  		dataType:'json',
	  		success:function(res){
	  			if(res.code==0){
	  				obj.del();
	  			}
	  			layer.msg(res.message);
	  		}
	  	})
	  }
	});
	//监听单元格编辑
 	table.on('edit(shopCategory)', function(obj){
	    var value = obj.value //得到修改后的值
	    ,data = obj.data //得到所在行所有键值
	    ,field = obj.field; //得到字段
	    $.ajax({
	    	type:'post',
	    	url:'<?=url('ShopCategory/addCategoryPost')?>',
	    	data:{post:{'company_id':'<?=companyHelper::getCompanyId()?>','name':value,'category_id':data.category_id}},
	    	dataType:'json',
	    	success:function(res){
	    		layer.msg(res.message);
	    	}
	    	,error:function(res){
	    		layer.msg('系统故障！');
	    	}
	    })
	});
});
function addCategory(){
	self.location.href = "<?=url('ShopCategory/addCategory')?>";
}
function load(){
	window.location.reload();
}
</script>
<script type="text/html" id="logo">
	{{#  if(d.logo_id){ }}
	<i class="layui-icon">&#xe66c;</i>
	{{#  }else{ }}
	 无图
	{{#  } }}
</script>
<script type="text/html" id="parent_category_id">
	{{#  if(d.parent_category_id==null){ }}
	顶级
	{{#  }else{ }}
	 {{d.parent_category_id}}
	{{#  } }}
</script>
<script type="text/html" id="setting">
	<?php if (companyController::checkButtonPrivilege('saveCategory')){?>
		<button class="layui-btn layui-btn-xs layui-btn-normal" lay-event="show" title="saveCategory"><i class="layui-icon">&#xe642;</i></button>
	<?php }?>
	<?php if (companyController::checkButtonPrivilege('delCategory')){?>
	<button class="layui-btn layui-btn-xs layui-btn-danger" lay-event="del" title="delCategory"><i class="layui-icon">&#xe640;</i></button>
	<?php }?>
</script>
</body>
</html>