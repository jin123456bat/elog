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
								<input type="text" name="keyWord" autocomplete="off" class="layui-input" placeholder="搜索姓名、账号">
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
							<button class="layui-btn layui-btn-normal" onclick="addAdmin()">
								<i class="layui-icon">&#xe608;</i>
								添加管理员
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
layui.use('table', function(){
  var table = layui.table;
  table.render({
    elem: '#hotel_list'
    ,url:'<?=url('LongRent/adminListApi',array('company_id'=>companyHelper::getCompanyId()))?>'
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
      {field:'id', width:'10%', title: 'ID', sort: true,align:'center'}
      ,{field:'name', width:'20%', title: '姓名',align:'center',templet: '#name'}
      ,{field:'mobile', width:'20%', title: '账号(手机号)',align:'center'}
      ,{field:'remark', width:'20%', title: '备注',align:'center',templet: '#remark'}
      ,{field:'status', width:'10.1%', title: '状态',align:'center',templet: '#status'}
      ,{field:'create_time', title: '时间', width: '10%',align:'center',sort: true}
      ,{field:'setting', title: '操作', width: '10%',templet: '#setting',align:'center'}
    ]]
  });
  //搜索酒店
  $("#seachHotel").click(function(){
  	var keyWord = $("input[name='keyWord']").val();
  	if(!keyWord){
  		layer.msg('请填写搜索信息！'); 
  		return false;
  	}
  	//重载数据
  	table.reload('hotel_list', {
	  url: '<?=url('LongRent/adminListApi',array('company_id'=>companyHelper::getCompanyId()))?>'
	  ,where: {keyWord:keyWord}
	});
  })
  //展示全部数据
  $("#allHotel").click(function(){
  	//重载数据
  	table.reload('hotel_list', {
	  url: '<?=url('LongRent/adminListApi',array('company_id'=>companyHelper::getCompanyId()))?>'
	  ,where: {keyWord:''}
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
	      var code = ajaxSave('<?=url('LongRent/delaAdmin')?>',{id:id});
	      if(code==0){
	      	obj.del();
	      	layer.close(index);
	      }
	    });
	  }
	  //修改
	  if(layEvent === 'save'){
	  	window.location.href = "<?=url('LongRent/updateAdmin')?>"+'?id='+id;
	  }
	  if(layEvent === 'saveStatus'){
	  	if(obj.data.status==2){
	  		status = 1;
	  	}else{
	  		status = 2;
	  	}
	  	//发送请求
	      var code = ajaxSave('<?=url('LongRent/saveAdminStatus')?>',{id:id,status:status});
	      if(code==0){
	      	obj.update({
	      		status:status
	      	})
	      }
	  }
	});
});
function addAdmin(){
	self.location.href = "<?=url('LongRent/addAdmin')?>";
}
</script>
	<script type="text/html" id="setting">
    <button class="layui-btn layui-btn-xs layui-btn-normal" lay-event="save"><i class="layui-icon">&#xe642;</i></button>
	<button class="layui-btn layui-btn-xs layui-btn-danger" lay-event="del"><i class="layui-icon">&#xe640;</i></button>
</script>
	<script type="text/html" id="status">
	{{#  if(d.status==1){ }}
	<button class="layui-btn layui-btn-xs layui-btn-normal" lay-event="saveStatus">正常</button>
    {{#  }else{ }}
	<button class="layui-btn layui-btn-xs layui-btn-danger" lay-event="saveStatus">禁用</button>
    {{#  } }}
</script>
	<script type="text/html" id="name">
	<span style="color:#1E9FFF;cursor: pointer;">{{d.name}}</span>
</script>
	<script type="text/html" id="remark">
	{{#  if(d.remark==false){ }}
	空
	{{#  }else{ }}
	{{d.remark}}
	{{#  } }}
</script>
</body>
</html>