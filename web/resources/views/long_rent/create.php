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
</head>
<!-- 所有页面使用的样式 -->
<link rel="stylesheet" href="<?=assets::css('main.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="/static/layui/css/layui.css" type="text/css" media="all" />
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
					  <legend>添加酒店</legend>
					</fieldset>
					<form class="layui-form" action="">
						<div class="layui-form-item">
						    <label class="layui-form-label">酒店名称</label>
						    <div class="layui-input-inline">
						      <input type="text" name="name" lay-verify="name" autocomplete="off" placeholder="请输入酒店名称" class="layui-input">
						    </div>
						</div>
						<div class="layui-form-item">
						    <label class="layui-form-label">联系方式</label>
						    <div class="layui-input-inline">
						      <input type="text" name="mobile" lay-verify="mobile" autocomplete="off" placeholder="请输入酒店联系方式" class="layui-input">
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
						    <label class="layui-form-label">地址</label>
						    <div class="layui-input-inline layui-form" lay-filter="provinceBox">
						      <select id="province" name="province" lay-search="" lay-filter="province" lay-verify='province'>
						        
						      </select>
						    </div>
						    <div class="layui-input-inline layui-form" lay-filter="cityBox">
						      <select name="city" id="city" lay-search="" lay-filter="city" lay-verify='city'>
						        <option value="0">请选择市</option>
						      </select>
						    </div>
						    <div class="layui-input-inline layui-form" lay-filter="zoneBox">
						      <select name="zone" id="zone" lay-search="" lay-filter="zone" lay-verify='zone'>
						        <option value="0">请选择县/区</option>
						      </select>
						    </div>
						    <div class="layui-input-inline">
						      <input type="text" min="0" name="address" autocomplete="off" placeholder="精确到门牌号" class="layui-input" lay-verify='address'>
						    </div>
						    <div class="layui-form-mid layui-word-aux">找不到？可试试输入搜索！</div>
						</div>
						
					  	<div class="layui-form-item">
						  	<div class="layui-upload" style="padding: 9px 40px;">
							  <button type="button" class="layui-btn layui-btn-normal" id="hotel_pic"><i class="layui-icon">&#xe681</i>上传酒店图片</button> 
							  <blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;margin-left: 70px;">
							    预览图：
							    <div class="layui-upload-list" id="pics"></div>
							 </blockquote>
							</div>
						</div>
						<div class="layui-form-item layui-form-text">
					   	 	<label class="layui-form-label">酒店介绍</label>
					    	<div class="layui-input-block">
					      		<textarea placeholder="请输入酒店介绍" name="descript" id="descript" lay-verify='descript' class="layui-textarea"></textarea>
					    	</div>
					  	</div>
						<div class="layui-form-item">
						    <div class="layui-input-block">
						      <button class="layui-btn layui-btn-normal" id="addHotel" lay-submit="" lay-filter="hotel">立即提交</button>
						    </div>
						</div>
						<input type="hidden" name="logo_url" value="">
					</form>
				</div>
			</div>
		</div>
	</div>
	{include file='common/footer' /}
	<!-- 通用js -->
<script src="/static/layui/layui.all.js"></script>
<script type="text/javascript" src="<?=assets::common('jquery.min.js','js')?>"></script>
<script type="text/javascript" src="<?=assets::common('city.js','js')?>"></script>
<script>
	//表单类
	layui.use('form', function(){
	 	var form = layui.form;
	  	getProvince(form,'<?=url('common/LongRentApi/getProvince')?>','province');
		//选择省份
		form.on('select(province)', function(data){
			var province_id = data.value;
			getCity(form,'<?=url('common/LongRentApi/getCity')?>',province_id,'city');
		});
		//选择城市
		form.on('select(city)', function(data){
			var city_id = data.value;
			getZone(form,'<?=url('common/LongRentApi/getZone')?>',city_id,'zone');
		});
		//表单验证
		form.verify({
		  name: function(value, item){ 
		    if(!value){
		    	return '酒店名称不能为空！';
		    }
		  },
		  province:function(value,item){
		  	if(value==0){
		    	return '请选择省份！';
		    }
		  },
		  city:function(value,item){
		  	if(value==0){
		    	return '请选择城市！';
		    }
		  },
		  zone:function(value,item){
		  	if(value==0){
		    	return '请选择县/区！';
		    }
		  },
		  address:function(value,item){
		  	if(value==0){
		    	return '请填写详细地址！';
		    }
		  },
		  descript:function(value,item){
		  	if(value==0){
		    	return '请填写酒店介绍！';
		    }
		  },
		  mobile:function(value,item){
		  	if(value==0){
		    	return '请填写酒店联系方式！';
		    }
		  }
		});

		//监听提交
	  	form.on('submit(hotel)', function(data){
	  		if(data.field.hasOwnProperty('logo_id')==false){
	  			layer.msg('请设置封面图！');
	  			return false;
	  		}
	  		var pic_str = '';
	  		$("input[name=logos]").each(function(k,v){
				pic_str += $(v).val()+',';
			})

			if(pic_str.length<1){
				layer.msg('请上传图片！');
	  			return false;
			}
			data.field.logos = pic_str;
			var province = $("#province option:selected").html();
			var city = $("#city option:selected").html();
			var zone = $("#zone option:selected").html();

			data.field.address = province+city+zone+data.field.address;
			data.field.site = data.field.address;

			data.field.logo_url = $("input[name=logo_url]").val();
	    	//表单提交
	    	$.ajax({
	    		type:"post",
	    		url:"<?=url('LongRent/add_hotel')?>",
	    		data:{post:data.field},
	    		dataType:'json',
	    		success:function(res){
	    			if(res.code==0){
	    				layer.msg(res.message);
	    				setTimeout(function(){
	    					location.reload();
	    				},2000);
	    			}else{
	    				layer.msg(res.message);
	    			}
	    		},
	    		error:function(res){
	    			layer.alert('系统故障！');
	    		}
	    	})
	    	return false;
	  	});
	});
	//上传
	upload('<?=url('common/component/upload')?>');
</script>
</body>
</html>