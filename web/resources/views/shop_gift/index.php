<?php
use jin123456bat\assets;
use think\facade\Request;
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
						<?php if (companyController::checkButtonPrivilege('addGift')){?>
						<button class="layui-btn layui-btn-normal" onclick="addGift()" title="addGift"><i class="layui-icon">&#xe608;</i> 添加礼品</button>
						<?php }?>
						<?php if (companyController::checkButtonPrivilege('addCard')){?>
						<button class="layui-btn layui-btn-normal" onclick="addCard()" title="addCard"><i class="layui-icon">&#xe608;</i> 添加充值卡</button>
						<?php }?>

					</div>
					<div class="layui-row">
						<table class="layui-hide" id="shopGift" lay-filter="shopGift"></table>
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
	    elem: '#shopGift'
	    ,url:'<?=url('shopGift/giftList',array('company_id'=>companyHelper::getCompanyId(),'goods_id'=>Request::get('id')))?>'
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
	      {field:'id', width:'10%', title: 'ID', sort: true}
	      ,{field:'sku', width:'30%', title: '购买赠送'}
	      ,{field:'type', width:'10%', title: '赠送类型',templet:'#type'}
	      ,{field:'coupon', width:'20%', title: '礼品',templet: '#coupon'}
	      ,{field:'num', width:'10%', title: '赠送数量',templet: '#num'}
	      ,{field:'status', width:'10%', title: '状态',templet: '#status'}
	      ,{field:'stting', width:'10%', title: '操作',templet: '#setting',align:'center'}
	    ]]
	});
	//监听事件
  	table.on('tool(shopGift)', function(obj){
	  var data = obj.data;
	  var layEvent = obj.event; 
	  var tr = obj.tr;
	  //删除
	  if(layEvent === 'del'){
	  	$.ajax({
	  		type:'post',
	  		url:"<?=url('ShopGift/delGift')?>",
	  		data:{id:data.id},
	  		dataType:'json',
	  		success:function(res){
	  			if(res.code==0){
	  				obj.del();
	  			}
	  			layer.msg(res.message);
	  		}
	  	})
	  }
	  if(layEvent === 'saveStatus'){
	  	if(data.status==1){
	  		var status = 0;
	  	}else{
	  		var status =1;
	  	}
	  	$.ajax({
	  		type:'post',
	  		url:"<?=url('ShopGift/saveStatus')?>",
	  		data:{id:data.id,status:status},
	  		dataType:'json',
	  		success:function(res){
	  			if(res.code==0){
	  				obj.update({
			       		status: status
			    	});
	  			}
	  			
	  			layer.msg(res.message);
	  		}
	  	})
	  }
	});
});
function addGift(){
	self.location.href = "<?=url('ShopGift/addGift')?>?goods_id=<?=Request::get('id')?>";
}
function addCard(){
	self.location.href = "<?=url('ShopGift/addCard')?>?goods_id=<?=Request::get('id')?>";
}
function load(){
	window.location.reload();
}
</script>
<script type="text/html" id="num">
	<a href="#" class="a_color">{{d.num}} 个</a>
</script>
<script type="text/html" id="type">
	{{#  if(d.type=='coupon'){ }}
	<button class="layui-btn layui-btn-xs layui-btn-normal" lay-event="">优惠券</button>
	{{#  }else if(d.type=='voucher'){ }}
	<button class="layui-btn layui-btn-xs layui-btn-normal" lay-event="">物品券</button>
	{{#  }else if(d.type=='card'){ }}
	<button class="layui-btn layui-btn-xs layui-btn-normal" lay-event="">充值卡</button>
	{{#  } }}
</script>
<script type="text/html" id="status">
	{{#  if(d.status==1){ }}
	<button class="layui-btn layui-btn-xs layui-btn-normal" lay-event="saveStatus">正常</button>
	{{#  }else{ }}
	<button class="layui-btn layui-btn-xs layui-btn-danger" lay-event="saveStatus">禁用</button>
	{{#  } }}
</script>
<script type="text/html" id="setting">
	<?php if (companyController::checkButtonPrivilege('delGift')){?>
	<button class="layui-btn layui-btn-xs layui-btn-danger" lay-event="del" title="delGift"><i class="layui-icon">&#xe640;</i></button>
	<?php }?>
</script>
</body>
</html>