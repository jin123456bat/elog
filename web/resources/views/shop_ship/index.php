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
  <style type="text/css">
  	.a_color{
  		color:#1E9FFF;cursor: pointer;
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
			<div class="white-block">
				<div class="layui-row">
				    <div class="layui-col-xs6">
			    		<div class="layui-input-inline">
					        <input type="text" name="keyWord" autocomplete="off" class="layui-input" placeholder="运费模板名称">
					    </div>
					    <button class="layui-btn layui-btn-normal" id="seachShip"><i class="layui-icon">&#xe615;</i>搜索</button>
					    <button class="layui-btn layui-btn-normal" onclick="load()"><i class="layui-icon">&#xe669;</i>刷新</button>
				    </div>
				     <div class="layui-col-xs6" style="text-align: right;">
				     	<?php if (companyController::checkButtonPrivilege('addShip')){?>
							<button class="layui-btn layui-btn-normal" onclick="addShip()" title="addShip"><i class="layui-icon">&#xe608;</i> 添加模板</button>
						<?php }?>
					</div>
					<div class="layui-row">
						<table class="layui-hide" id="Ship" lay-filter="Ship"></table>
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
var url = '<?=url('ShopShip/shipList',array( 'company_id'=>companyHelper::getCompanyId()))?>';
layui.use('table', function(){
	var table = layui.table;
	table.render({
	    elem: '#Ship'
	    ,url:url
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
	      {field:'id', width:'10%', title: 'ID',sort:true}
	      ,{field:'name', width:'40%', title: '名称',templet:'#name',edit:'text'}
	      ,{field:'hotel_name', width:'20%', title: '所属酒店',templet:'#hotel_name'}
	      ,{field:'createtime', width:'10%', title: '时间',sort:true}
	      ,{field:'modifytime', width:'10%', title: '最新修改时间',sort:true}
	      ,{field:'setting ', width:'10%', title: '操作',templet:'#setting',align:'center'}
	    ]]
	});
	//监听事件
  	table.on('tool(Ship)', function(obj){
	  var data = obj.data;
	  var id = data.id;
	  var layEvent = obj.event; 
	  var tr = obj.tr;
	  //删除
	  if(layEvent === 'del'){
	  	layer.confirm('真的删除行么?', function(index){
	  		$.ajax({
		  		type:'post',
		  		url:'<?=url("ShopShip/delShip")?>',
		  		data:{id:id},
		  		dataType:"json",
		  		success:function(res){
		  			layer.msg(res.message);
		  			if(res.code==0){
		  				obj.del();
	        			layer.close(index);
		  			}
		  		}
		  	})
	    });
	  }
	  //添加运费
	  if(layEvent ==='add'){
	  	self.location.href = '<?=url("ShopShipPrice/addShipPrice")?>?ship_id='+id;
	  }
	  //查看运费
	  if(layEvent ==='look'){
	  	self.location.href = '<?=url("ShopShipPrice/index")?>?ship_id='+id;
	  }
	});
	//监听单元格编辑
 	table.on('edit(Ship)', function(obj){
	    var value = obj.value //得到修改后的值
	    ,data = obj.data //得到所在行所有键值
	    ,field = obj.field; //得到字段
	    $.ajax({
	    	type:'post',
	    	url:'<?=url('ShopShip/addShip')?>',
	    	data:{company_id:'<?=companyHelper::getCompanyId()?>',name:value,id:data.id},
	    	dataType:'json',
	    	success:function(res){
	    		layer.msg(res.message);
	    	}
	    	,error:function(res){
	    		layer.msg('系统故障！');
	    	}
	    })
	});
	//搜索酒店
	$("#seachShip").click(function(){
	  	var name = $("input[name=keyWord]").val();
	  	if(!name){
	  		layer.msg('请填写模板名称！'); 
	  		return false;
	  	}
	  	//重载数据
	  	table.reload('Ship', {
		   url: url
		  ,where: {name:name}
		});
	})
});
//添加模板
function addShip(){
	layer.prompt(function(val, index){
		$.ajax({
			type:'post',
			url:'<?=url("ShopShip/addShip")?>',
			data:{name:val},
			dataType:'json',
			success:function(res){
				layer.msg(res.message);
				setTimeout(function(){
					location.reload();
				},1100);
			},error:function(res){
				layer.msg('系统故障！');
			}
		})
	  	layer.close(index);
	});
}
//刷新
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
<script type="text/html" id="hotel_name">
	{{#  if(d.hotel_name==null){ }}
	集团模板
	{{#  }else{ }}
	 {{d.hotel_name}}
	{{#  } }}
</script>
<script type="text/html" id="setting">
	<button class="layui-btn layui-btn-xs layui-btn-normal" lay-event="look" title="查看"><i class="layui-icon">&#xe615;</i></button>
	<?php if (companyController::checkButtonPrivilege('addShipPrice')){?>
	<button class="layui-btn layui-btn-xs layui-btn-normal" lay-event="add" title="addShipPrice"><i class="layui-icon">&#xe654;</i></button>
	<?php }?>
	<?php if (companyController::checkButtonPrivilege('delShip')){?>
	<button class="layui-btn layui-btn-xs layui-btn-danger" lay-event="del" title="delShip"><i class="layui-icon">&#xe640;</i></button>
	<?php }?>
</script>
<script type="text/html" id="name">
	<a href="#" class="a_color">{{d.name}}</a>
</script>
</body>
</html>