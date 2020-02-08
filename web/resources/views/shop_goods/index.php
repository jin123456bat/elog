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
    #share{
    	width: 100vw;
    	height: 100vh;
    	position: fixed;
    	top: 0;
    	left: 0;
    	background: rgba(0, 0, 0, 0.5);
    	display: none;
    }
    #qrcodeCanvas{
    	width: 200px;
    	height: 200px;
    	position: fixed;
	    left: calc(50% - 100px );
	    top: calc(50% - 100px );
	    border: 1px solid white;
	    z-index: 10;
    	display: none;
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
					    <button class="layui-btn layui-btn-normal" onclick="load()"><i class="layui-icon">&#xe669;</i>刷新</button>
				    </div>
				     <div class="layui-col-xs6" style="text-align: right;">
						<?php if (companyController::checkButtonPrivilege('addGoods')){?>
						<button class="layui-btn layui-btn-normal" onclick="addGoods()" title="addGoods"><i class="layui-icon">&#xe608;</i> 添加商品</button>
						<?php }?>
					</div>
					<div class="layui-row">
						<table class="layui-hide" id="shopGoods" lay-filter="shopGoods"></table>
					</div>
				</div>
			</div>
		</div>
		<div id="qrcodeCanvas" class="qrcode"></div>
		<div id="share"></div>
  	</div>
  </div>
</body>
<script src="/static/common/js/jquery.min.js"></script>
<script src="/static/layui/layui.all.js"></script>
<script type="text/javascript" src="/static/common/js/jquery.qrcode.js"></script>
<script type="text/javascript" src="/static/common/js/qrcode.js"></script>
<script type="text/javascript">
layui.use('table', function(){
	var table = layui.table;
	table.render({
	    elem: '#shopGoods'
	    ,url:'<?=url('ShopGoods/getGoods')?>'
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
	      {field:'id', width:'5%', title: 'ID', sort: true}
	      ,{field:'name', width:'20%', title: '名称',templet:'#name',edit:'text'}
	      ,{field:'category_name', width:'10%', title: '分类'}
	      ,{field:'sku', width:'10%', title: '属性',templet:'#sku'}
	      ,{field:'short_desc', width:'10%', title: '描述'}
	      // ,{field:'is_ship', width:'7%', title: '是否发货',templet:'#is_ship'}
	      ,{field:'top', width:'7%', title: '推荐',templet:'#top'}
	      ,{field:'likes', width:'7%', title: '猜你喜欢',templet:'#like'}
	      ,{field:'status', width:'9%', title: '状态',templet:'#status'}
	      ,{field:'code', width:'5%', title: '二维码',templet:'#code'}
	      ,{field:'stting', width:'10%', title: '操作',templet: '#setting',align:'center'}
	    ]]
	});
	//监听事件
  	table.on('tool(shopGoods)', function(obj){
	  var data = obj.data;
	  var id = data.id;
	  var layEvent = obj.event; 
	  var tr = obj.tr;
	  //修改 上架 下架
	  if(layEvent === 'saveStatus'){
	  	if(data.status==1){
	  		var status = 0;
	  	}else{
	  		status = 1;
	  	}
	  	$.ajax({
	  		type:"post",
	  		url:'<?=url("ShopGoods/saveStatus")?>',
	  		data:{id:id,status:status},
	  		dataType:'json',
	  		success:function(res){
	  			layer.msg(res.message);
	  			obj.update({
			       status: status
			    });
	  		},error:function(res){
	    		layer.msg('系统故障！');
	    	}
	  	})
	  }
	  //修改发货不发货
	  if(layEvent === 'shipStatus'){
	  	if(data.is_ship==1){
	  		var status = 0;
	  	}else{
	  		status = 1;
	  	}
	  	$.ajax({
	  		type:"post",
	  		url:'<?=url("ShopGoods/shipStatus")?>',
	  		data:{id:id,status:status},
	  		dataType:'json',
	  		success:function(res){
	  			layer.msg(res.message);
	  			obj.update({
			       is_ship: status
			    });
	  		},error:function(res){
	    		layer.msg('系统故障！');
	    	}
	  	})
	  }
	  //删除
	  if(layEvent==='del'){
	  	$.ajax({
	  		type:"post",
	  		url:'<?=url("ShopGoods/delGoods")?>',
	  		data:{id:id},
	  		dataType:'json',
	  		success:function(res){
	  			layer.msg(res.message);
	            obj.del();
	  		},error:function(res){
	    		layer.msg('系统故障！');
	    	}
	  	})
	  }
	  //修改信息
	  if(layEvent === 'save'){
	  	self.location.href="<?=url('ShopGoods/saveGoods')?>?id="+id;
	  }
	   //设置赠送礼品
	  if(layEvent === 'coupon'){
	  	self.location.href="<?=url('ShopGift/index')?>?id="+id;
	  }
	  if(layEvent === 'top'){
	  	if(data.top==1){
	  		var top = 0;
	  	}else{
	  		top = 1;
	  	}
	  	$.ajax({
	  		type:"post",
	  		url:'<?=url("ShopGoods/tops")?>',
	  		data:{id:id,top:top},
	  		dataType:'json',
	  		success:function(res){
	  			layer.msg(res.message);
	  			obj.update({
			       top: top
			    });
	  		},error:function(res){
	    		layer.msg('系统故障！');
	    	}
	  	})
	  }
	  if(layEvent === 'likes'){
	  	if(data.likes==1){
	  		var likes = 0;
	  	}else{
	  		likes = 1;
	  	}
	  	$.ajax({
	  		type:"post",
	  		url:'<?=url("ShopGoods/likes")?>',
	  		data:{id:id,likes:likes},
	  		dataType:'json',
	  		success:function(res){
	  			layer.msg(res.message);
	  			obj.update({
			       likes: likes
			    });
	  		},error:function(res){
	    		layer.msg('系统故障！');
	    	}
	  	})
	  }
	  if(layEvent==='code'){
	  	var domain = document.domain;
	  	var return_url = 'https://'+domain+'/page/shop#/details?id='+id+'&company_id='+"<?=companyHelper::getCompanyId()?>";
	  	$('#qrcodeCanvas').empty();
	  	$('#qrcodeCanvas').qrcode({
			text:return_url,
			width:200,
			height:200
		});	
		$("#qrcodeCanvas").show();
		$("#share").show();
	  }
	});
	//监听单元格编辑
 	table.on('edit(shopGoods)', function(obj){
	    var value = obj.value //得到修改后的值
	    ,data = obj.data //得到所在行所有键值
	    ,field = obj.field; //得到字段
	    $.ajax({
	    	type:'post',
	    	url:'<?=url('ShopGoods/saveName')?>',
	    	data:{name:value,id:data.id},
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
$("#share").click(function(){
	$("#qrcodeCanvas").hide();
	$(this).hide();
})
function addGoods(){
	self.location.href = "<?=url('ShopGoods/addGoods')?>";
}
function load(){
	window.location.reload();
}
</script>
<script type="text/html" id="is_ship">
	{{#  if(d.is_ship==1){ }}
	<button class="layui-btn layui-btn-xs layui-btn-normal" lay-event="shipStatus">发货</button>
	{{#  }else{ }}
	<button class="layui-btn layui-btn-xs layui-btn-danger" lay-event="shipStatus">不发货</button>
	{{#  } }}
</script>
<script type="text/html" id="top">
	{{#  if(d.top==1){ }}
	<button class="layui-btn layui-btn-xs layui-btn-normal" lay-event="top">推荐</button>
	{{#  }else{ }}
	<button class="layui-btn layui-btn-xs layui-btn-danger" lay-event="top">不推荐</button>
	{{#  } }}
</script>
<script type="text/html" id="like">
	{{#  if(d.likes==1){ }}
	<button class="layui-btn layui-btn-xs layui-btn-normal" lay-event="likes">是</button>
	{{#  }else{ }}
	<button class="layui-btn layui-btn-xs layui-btn-danger" lay-event="likes">不是</button>
	{{#  } }}
</script>
<script type="text/html" id="status">
	{{#  if(d.status==1){ }}
	<button class="layui-btn layui-btn-xs layui-btn-normal" lay-event="saveStatus">上线中</button>
    {{#  }else{ }}
	<button class="layui-btn layui-btn-xs layui-btn-danger" lay-event="saveStatus">已下线</button>
    {{#  } }}
</script>
<script type="text/html" id="setting">
	<?php if (companyController::checkButtonPrivilege('saveGoods')){?>
	<button class="layui-btn layui-btn-xs layui-btn-normal" lay-event="save" title="saveGoods"><i class="layui-icon">&#xe642;</i></button>
	<?php }?>
	<?php if (companyController::checkButtonPrivilege('coupon')){?>
	<button class="layui-btn layui-btn-xs layui-btn-warm" lay-event="coupon" title="coupon"><i class="layui-icon">&#xe641;</i></button>
	<?php }?>
	<?php if (companyController::checkButtonPrivilege('delGoods')){?>
	<button class="layui-btn layui-btn-xs layui-btn-danger" lay-event="del" title="delGoods"><i class="layui-icon">&#xe640;</i></button>
	<?php }?>
</script>
<script type="text/html" id="name">
	<a href="#" class="a_color">{{d.name}}</a>
</script>
<script type="text/html" id="code">
	<?php if (companyController::checkButtonPrivilege('code')){?>
	<button class="layui-btn layui-btn-xs layui-btn-normal" lay-event="code">二维码</button>
	<?php }?>
</script>
<script type="text/html" id="sku">
	  {{#  layui.each(d.sku, function(index, item){ }}
	      <span>{{ item.sku }}(</span>
	      <span>价格:{{ item.price/100 || 0 }}元</span>
	      <span>库存:{{ item.stock || '' }}个</span>
	      <span>积分:{{ item.score || 0 }})</span>
	      <br>
	  {{#  }); }}
	  {{#  if(d.sku.length === 0){ }}
	    无数据
	  {{#  } }} 
</script>
</body>
</html>