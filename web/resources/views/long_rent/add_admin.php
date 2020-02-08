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
<style type="text/css">
.layui-upload-img {
    width: 92px;
    height: 92px;
}
.tip_img{
	display: block;
    text-align: center;
    width: 100%;
    background: rgba(0,0,0,0.8);
    color: white;
    font-size: 12px;
}
.tip_del{
	position:absolute;
	top:0;
	left:0;
	display: none;
}
.tip_curr{
	position:absolute;
	bottom:0;
	left:0;
	display: none;
}
.tipBox{
	float: left;
	margin-left: 15px;
}
#pics{
	overflow: hidden;
}
</style>
<!-- 所有页面使用的样式 -->
<link rel="stylesheet" href="<?=assets::css('main.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="/static/layui/css/layui.css" type="text/css" media="all" />
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
					<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
					  <legend>添加管理员</legend>
					</fieldset>
					<form class="layui-form" action="">
						<div class="layui-form-item">
						    <label class="layui-form-label">姓名</label>
						    <div class="layui-input-inline">
						      <input type="text" name="name" lay-verify="name" autocomplete="off" placeholder="请输入真实姓名" class="layui-input">
						    </div>
						</div>
						<div class="layui-form-item">
						    <label class="layui-form-label">手机号</label>
						    <div class="layui-input-inline">
						      <input type="text" name="mobile" lay-verify="mobile" autocomplete="off" placeholder="请输入手机号" class="layui-input">
						    </div>
						    <div class="layui-form-mid layui-word-aux">手机号作为登录的账号</div>
						</div>
						<div class="layui-form-item">
						    <label class="layui-form-label">登录密码</label>
						    <div class="layui-input-inline">
						      <input type="password" name="password" lay-verify="password" autocomplete="off" placeholder="登录密码" class="layui-input">
						    </div>
						</div>
						<div class="layui-form-item">
						    <label class="layui-form-label">酒店权限</label>
						    <div class="layui-input-block layui-form" id="admin" lay-filter="adminBox">
						      
						    </div>
						</div>
						<div class="layui-form-item">
						    <label class="layui-form-label">是否上线</label>
						    <div class="layui-input-block">
						      <input type="radio" name="status" value="1" title="上线" checked="">
						      <input type="radio" name="status" value="2" title="不上线">
						    </div>
						</div>
						<div class="layui-form-item">
						    <label class="layui-form-label">预约消息</label>
						    <div class="layui-input-block">
						      <input type="radio" name="is_pact" value="1" title="接收" >
						      <input type="radio" name="is_pact" value="2" title="不接收" checked="">
						    </div>
						</div>
						<div class="layui-form-item">
						    <label class="layui-form-label">委托消息</label>
						    <div class="layui-input-block">
						      <input type="radio" name="is_entrust" value="1" title="接收" >
						      <input type="radio" name="is_entrust" value="2" title="不接收" checked="">
						    </div>
						</div>
						<div class="layui-form-item">
						    <label class="layui-form-label">维修消息</label>
						    <div class="layui-input-block">
						      <input type="radio" name="is_repairs" value="1" title="接收" >
						      <input type="radio" name="is_repairs" value="2" title="不接收" checked="">
						    </div>
						</div>
						<div class="layui-form-item">
						    <label class="layui-form-label">保洁消息</label>
						    <div class="layui-input-block">
						      <input type="radio" name="is_clean" value="1" title="接收" >
						      <input type="radio" name="is_clean" value="2" title="不接收" checked="">
						    </div>
						</div>
						<div class="layui-form-item">
						    <label class="layui-form-label">意见反馈</label>
						    <div class="layui-input-block">
						      <input type="radio" name="is_issue" value="1" title="接收" >
						      <input type="radio" name="is_issue" value="2" title="不接收" checked="">
						    </div>
						</div>
						<div class="layui-form-item">
						    <label class="layui-form-label">备注</label>
						    <div class="layui-input-inline">
						      <input type="text" name="remark" autocomplete="off" placeholder="请输入备注" class="layui-input">
						    </div>
						</div>
						<div class="layui-form-item">
						    <div class="layui-input-block">
						      <button class="layui-btn layui-btn-normal" id="addHotel" lay-submit="" lay-filter="hotel">立即提交</button>
						    </div>
						</div>
						<input type="hidden" name="auth">
					</form>
				</div>
			</div>
		</div>
	</div>
	{include file='common/footer' /}
	<!-- 通用js -->
<script src="/static/layui/layui.all.js"></script>
<script type="text/javascript" src="<?=assets::common('jquery.min.js','js')?>"></script>
<script>
	var authArr = [];
	//表单类
	layui.use('form', function(){
	 	var form = layui.form;
		//表单验证
		form.verify({
		  name: function(value, item){ 
		    if(!value){
		    	return '姓名不能为空！';
		    }
		  },
		  password: function(value, item){ 
		    if(!value){
		    	return '密码不能为空！';
		    }
		  }
		});
		$.ajax({
			type:'post',
			url:'<?=url('common/LongRentApi/hotelNameList')?>',
			data:{company_id:'<?=companyHelper::getCompanyId()?>'},
			dataType:'json',
			success:function(res){
				if(res.code==0){
					var str = '';
					var data = res.data;
					for(var i in data){
						str += '<input type="checkbox" lay-filter="auth" name="a" value="'+data[i]['id']+'" title="'+data[i]['name']+'">';
					}
					$("#admin").html(str);
					form.render('checkbox','adminBox');
				}
			},error:function(res){
				layer.alert('系统故障！');
			}
		})
		//事件监听
		form.on('checkbox(auth)', function(data){
			
			if(data.elem.checked===true){
				authArr.push(data.value);
			}

			if(data.elem.checked==false){
				$.each(authArr,function(k,v){
					if(v==data.value){
						authArr.splice(k,1);
					}
				})
			}
			$("input[name='auth']").val(authArr);
		});        
      
		//监听提交
	  	form.on('submit(hotel)', function(data){
	  		if(data.field.auth==false){
	  			layer.msg('请至少选择一个酒店！');
	  			return false;
	  		}
	    	//表单提交
	    	$.ajax({
	    		type:"post",
	    		url:"<?=url('LongRent/addAdminPost')?>",
	    		data:{post:JSON.stringify(data.field)},
	    		dataType:'json',
	    		success:function(res){
	    			if(res.code==0){
	    				layer.msg(res.message);
	    				setTimeout(function(){
	    					location.reload();
	    				},1100);
	    			}else{
	    				layer.msg(res.message);
	    			}
	    		},
	    		error:function(res){
	    			layer.alert('系统故障！');
	    		},
	    		beforeSend:function(res){
	    		}
	    	})
	    	return false;
	  	});
	});
</script>
</body>
</html>