<?php
use jin123456bat\assets;
use think\facade\Request;
use jin123456bat\helper;
use app\company\companyHelper;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<title><?=$setting['site_title']?> | <?=$setting['site_desc']?></title>
<link rel="stylesheet" href="/static/layui/css/layui.css" type="text/css" media="all" />
<!-- 所有页面使用的样式 -->
<link rel="stylesheet" href="<?=assets::css('main.css')?>" type="text/css" media="all" />
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
								<input type="text" name="hotel_name" autocomplete="off" class="layui-input" placeholder="请输入酒店名称">
							</div>
							<button class="layui-btn layui-btn-normal" id="seachHotel">
								<i class="layui-icon">&#xe615;</i>
								搜索
							</button>
							<button class="layui-btn layui-btn-normal" id="allHotel">
								<i class="layui-icon">&#xe669;</i>
								刷新
							</button>
						</div>
						<div class="layui-col-xs6" style="text-align: right;">
							<button class="layui-btn layui-btn-normal" onclick="addHotel()">
								<i class="layui-icon">&#xe608;</i>
								添加酒店
							</button>
						</div>
						<div class="layui-row">
							<table class="layui-hide" id="hotel_list" lay-filter="hotel_list"></table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	{include file='common/footer' /}
	<!-- 通用js -->
	<script type="text/javascript" src="<?=assets::common('jquery.min.js','js')?>"></script>
	<script src="/static/layui/layui.all.js"></script>
	<script type="text/javascript" src="<?=assets::common('city.js','js')?>"></script>
	<script>
	var company_id = "<?=companyHelper::getCompanyId()?>";
layui.use('table', function(){
  var table = layui.table;
  table.render({
    elem: '#hotel_list'
    ,url:'<?=url('common/LongRentApi/hotelList',array('company_id'=>companyHelper::getCompanyId()))?>'
    ,cellMinWidth: 80
    ,page:{
    	theme: '#1E9FFF',
    	limit:20
    }
    ,skin: 'row'
    ,even: true
    ,parseData: function(res){
	    return {
	      "code": res.code, 
	      "msg": res.message, 
	      "data": res.data,
	      "count": res.count,
	    };
	}
    ,cols: [[
      {field:'id', width:'5%', title: 'ID', sort: true,align:'center'}
      ,{field:'name', width:'15%', title: '酒店名称',align:'center',templet: '#name',}
      ,{field:'address', width:'20%', title: '酒店地址',align:'center'}
      ,{field:'descript', width:'30%', title: '酒店介绍',align:'center'}
      ,{field:'status', title: '状态', width: '10%',templet: '#status',align:'center'}
      ,{field:'create_time', title: '时间', width: '10%',align:'center',sort: true}
      ,{field:'setting', title: '操作', width: '10%',templet: '#setting',align:'center'}
    ]]
  });
  //搜索酒店
  $("#seachHotel").click(function(){
  	var hotelName = $("input[name=hotel_name]").val();
  	if(!hotelName){
  		layer.msg('请填写酒店名称！'); 
  		return false;
  	}
  	//重载数据
  	table.reload('hotel_list', {
	  url: '<?=url('common/LongRentApi/hotelList',array('company_id'=>companyHelper::getCompanyId()))?>'
	  ,where: {hotelName:hotelName}
	});
  })
  //展示全部数据
  $("#allHotel").click(function(){
  	//重载数据
  	table.reload('hotel_list', {
	  url: '<?=url('common/LongRentApi/hotelList',array('company_id'=>companyHelper::getCompanyId()))?>'
	  ,where: {hotelName:''}
	});
  })
  //监听事件
  table.on('tool(hotel_list)', function(obj){
	  var data = obj.data;
	  var id = data.id;
	  var layEvent = obj.event; 
	  var tr = obj.tr;
	  if(layEvent === 'del'){ //删除
	    layer.confirm('真的删除行么?', function(index){
	      //发送请求
	      var code = ajaxSave('<?=url('common/LongRentApi/delHotel')?>',{id:id});
	      if(code==0){
	      	obj.del();
	      	layer.close(index);
	      }
	    });
	  }
	  //添加房型
	  if(layEvent === 'addTypes'){
	  	window.location.href="<?=url('LongRent/create_types')?>"+'?id='+id;
	  }
	});
});
//添加酒店跳转
function addHotel(){
	self.location.href = "<?=url('LongRent/create')?>";
}
</script>
	<script type="text/html" id="setting">
	<button class="layui-btn layui-btn-xs layui-btn-danger" lay-event="del"><i class="layui-icon">&#xe640;</i></button>
</script>
	<script type="text/html" id="status">
	{{#  if(d.status==1){ }}
		<button class="layui-btn layui-btn-xs layui-btn-normal" lay-event="saveStatus">上线中</button>
    {{#  }else{ }}
		<button class="layui-btn layui-btn-xs layui-btn-danger" lay-event="saveStatus">下线中</button>
    {{#  } }}
</script>
	<script type="text/html" id="name">
	<span style="color:#1E9FFF;cursor: pointer;" onclick="types(this)" data-id="{{d.id}}">{{d.name}}</span>
</script>
	<script type="text/javascript">
	function types(ev){
		var id = $(ev).attr('data-id');
		window.location.href="<?=url('LongRent/typeList')?>"+'?id='+id;
	}
</script>
</body>
</html>