<?php
use jin123456bat\assets;
use jin123456bat\companyController;
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
						<button class="layui-btn layui-btn-normal" onclick="addMsg()" title="addAdve"><i class="layui-icon">&#xe608;</i> 添加消息</button>
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
	    ,url:'<?=url('ShopMsg/msgList')?>'
	    ,parseData: function(res){
		    return {
		      "code": res.code, 
		      "msg": res.message, 
		      "data": res.data,
		      'count':res.count
		    };
		}
		,page:{
	    	theme: '#1E9FFF',
	    	limit:20
	    }
	    ,cols: [[
	      {field:'id', width:'10%', title: 'ID', sort: true}
	      ,{field:'name', width:'25%', title: '消息名称'}
	      ,{field:'keyword', width:'25%', title: '消息别名'}
	      ,{field:'temp_id', width:'30%', title: '模板ID'}
	      ,{field:'stting', width:'10%', title: '操作',templet: '#setting',align:'center'}
	    ]]
	});
	//监听事件
  	table.on('tool(shopCategory)', function(obj){
	  var data = obj.data;
	  var id = data.id;
	  var layEvent = obj.event; 
	  var tr = obj.tr;
	  //删除
	  if(layEvent === 'del'){
	  	$.ajax({
	  		type:'post',
	  		url:"<?=url('ShopMsg/delMsg')?>",
	  		data:{id:id},
	  		dataType:'json',
	  		success:function(res){
	  			if(res.code==0){
	  				obj.del();
	  			}
	  			layer.msg(res.message);
	  		}
	  	})
	  }
	  if(layEvent === 'save'){
	  	window.location.href = "<?=url('shopMsg/saveMsg')?>?id="+data.id;
	  }
	});
});
function addMsg(){
	self.location.href = "<?=url('ShopMsg/add')?>";
}
function load(){
	window.location.reload();
}
</script>
<script type="text/html" id="setting">
	<button class="layui-btn layui-btn-xs layui-btn-normal" lay-event="save" title="save"><i class="layui-icon">&#xe642;</i></button>
	<?php if (companyController::checkButtonPrivilege('delMsg')){?>
	<button class="layui-btn layui-btn-xs layui-btn-danger" lay-event="del" title="delMsg"><i class="layui-icon">&#xe640;</i></button>
	<?php }?>
</script>
</body>
</html>