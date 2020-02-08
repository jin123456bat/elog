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
				        	<input type="text" name="keyWord" autocomplete="off" class="layui-input" placeholder="配送地址">
				   	 	</div>
				    	<button class="layui-btn layui-btn-normal" id="seachShip"><i class="layui-icon">&#xe615;</i>搜索</button>
					    <button class="layui-btn layui-btn-normal" onclick="load()"><i class="layui-icon">&#xe669;</i>刷新</button>
				    </div>
				     <div class="layui-col-xs6" style="text-align: right;">
						<?php if (companyController::checkButtonPrivilege('addShipPrice')){?>
						<button class="layui-btn layui-btn-normal" onclick="addShipPrice()" title="addShipPrice"><i class="layui-icon">&#xe608;</i> 添加运费</button>
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
var url = '<?=url('ShopShipPrice/priceList',array('company_id'=>companyHelper::getCompanyId(),'ship_id'=>Request::get("ship_id")))?>';
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
	      {field:'province_name', width:'25%', title: '配送地址',templet:'#province_name'}
	      ,{field:'hotel_name', width:'20%', title: '所属酒店',templet:'#hotel_name'}
	      ,{field:'first_weight', width:'10%', title: '首重',templet:'#first_weight'}
	      ,{field:'first_price', width:'10%', title: '首价',templet:'#first_price'}
	      ,{field:'next_weight', width:'10%', title: '续重',templet:'#next_weight'}
	      ,{field:'next_price', width:'10%', title: '续重价',templet:'#next_price'}
	      ,{field:'setting ', width:'15%', title: '操作',templet:'#setting',align:'center'}
	    ]]
	});
	//监听事件
  	table.on('tool(Ship)', function(obj){
	  var data = obj.data;
	  var ship_id = data.ship_id;
	  var layEvent = obj.event; 
	  var tr = obj.tr;
	  var province_id = data.province_id;
	  //删除
	  if(layEvent === 'del'){
	  	if(ship_id && province_id){
	  		$.ajax({
	  			type:'post',
	  			url:'<?=url("ShopShipPrice/delShipPrice")?>',
	  			data:{ship_id:ship_id,province_id:province_id},
	  			dataType:'json',
	  			success:function(res){
	  				layer.msg(res.message);
	  				if(res.code==0){
	  					obj.del();
	  				}
	  			}
	  		})
	  	}
	  }
	  //编辑
	  if(layEvent === 'save'){
	  	self.location.href = "<?=url('ShopShipPrice/saveShipPrice')?>?ship_id="+ship_id+'&province_id='+province_id;
	  }
	});
	//搜索地址
	$("#seachShip").click(function(){
	  	var province_name = $("input[name=keyWord]").val();
	  	if(!province_name){
	  		layer.msg('请填写地址名称！'); 
	  		return false;
	  	}
	  	//重载数据
	  	table.reload('Ship', {
		   url: url
		  ,where: {province_name:province_name}
		});
	})
});
//添加运费
function addShipPrice(){
	self.location.href = '<?=url("ShopShipPrice/addShipPrice",array("ship_id"=>Request::get('ship_id')))?>';
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
	<?php if (companyController::checkButtonPrivilege('saveShipPrice')){?>
	<button class="layui-btn layui-btn-xs layui-btn-normal" lay-event="save" title="saveShipPrice"><i class="layui-icon">&#xe642;</i></button>
	<?php }?>
	<?php if (companyController::checkButtonPrivilege('delShipPrice')){?>
	<button class="layui-btn layui-btn-xs layui-btn-danger" lay-event="del" title="delShipPrice"><i class="layui-icon">&#xe640;</i></button>
	<?php }?>
</script>
<script type="text/html" id="province_name">
	<a href="#" class="a_color">{{d.province_name}}</a>
</script>
<script type="text/html" id="first_weight">
	{{#  if(d.first_weight=='0.00' && d.first_price==false && d.next_weight=='0.00' && d.next_price==false){ }}
		包邮
	{{#  }else{ }}
		{{d.first_weight}}Kg
	{{#  } }}
</script>
<script type="text/html" id="first_price">
	{{#  if(d.first_weight=='0.00' && d.first_price==false && d.next_weight=='0.00' && d.next_price==false){ }}
		包邮
	{{#  }else{ }}
		{{d.first_price/100}}元
	{{#  } }}
</script>
<script type="text/html" id="next_weight">
	{{#  if(d.first_weight=='0.00' && d.first_price==false && d.next_weight=='0.00' && d.next_price==false){ }}
		包邮
	{{#  }else{ }}
		{{d.next_weight}}Kg
	{{#  } }}
</script>
<script type="text/html" id="next_price">
	{{#  if(d.first_weight=='0.00' && d.first_price==false && d.next_weight=='0.00' && d.next_price==false){ }}
		包邮
	{{#  }else{ }}
		{{d.next_price/100}}元
	{{#  } }}
</script>
</body>
</html>