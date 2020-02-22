<?php
use jin123456bat\assets;
use think\facade\Request;
use jin123456bat\helper;
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
  <link rel="stylesheet" href="/static/layui/formSelects-v4.css" type="text/css" media="all" />
  <style type="text/css">
	.layui-upload-img{width:92px;height:92px}.tip_img{display:block;text-align:center;width:100%;background:rgba(0,0,0,0.8);color:white;font-size:12px}.tip_del{position:absolute;top:0;left:0;display:none}.tip_curr{position:absolute;bottom:0;left:0;display:none}.tipBox{float:left;margin-left:15px}#pics{overflow:hidden}
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
				<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
					<legend>添加充值卡</legend>
				</fieldset>
				<form class="layui-form" action="">

					<div class="layui-form-item">
						<div class="layui-inline">
					      <label class="layui-form-label">选择sku</label>
					      <div class="layui-input-inline">
					        <select name="sku" lay-verify="sku" lay-search="">
					        <option value=""></option>
					        {foreach $sku as $vo } 
					          <option value="{$vo.sku}">{$vo.sku}</option>
					        {/foreach}
					        </select>
					      </div>
					    </div>
				    </div>
				    <div class="layui-form-item">
						<div class="layui-inline">
					      <label class="layui-form-label">选择类型</label>
					      <div class="layui-input-inline">
					        <select name="type" lay-verify="type" lay-search="">
					        <option value="card">充值卡</option>
					        </select>
					      </div>
					    </div>
				    </div>
				     <div class="layui-form-item">
					    <label class="layui-form-label">面额</label>
					    <div class="layui-input-inline">
					      <input type="number" min="1" name="money" lay-verify="money" autocomplete="off" placeholder="充值卡面额" class="layui-input">
					    </div>
					</div>
				    <div class="layui-form-item">
					    <label class="layui-form-label">赠送数量</label>
					    <div class="layui-input-inline">
					      <input type="number" min="1" name="num" lay-verify="num" autocomplete="off" placeholder="赠送数量" class="layui-input">
					    </div>
					</div>
					<div class="layui-form-item">
					    <div class="layui-input-block">
					      <button class="layui-btn layui-btn-normal" id="addGift" lay-submit="" lay-filter="addGift">立即提交</button>
					    </div>
					</div>
					<input type="hidden" name="company_id" value="<?=companyHelper::getCompanyId()?>">
					<input type="hidden" name="goods_id" value="<?=Request::get('goods_id')?>">
				</form>
			</div>
		</div>
  	</div>
  </div>
</body>
<script src="/static/common/js/jquery.min.js"></script>
<script src="/static/layui/formSelects-v4.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/static/layui/layui.all.js"></script>
<script type="text/javascript">
//表单验证
layui.use('form', function(){
 	var form = layui.form;
	//表单验证
	form.verify({
	  sku: function(value, item){ 
	    if(!value){
	    	return '请选择商品属性！';
	    }
	  },
	  type: function(value, item){ 
	    if(!value){
	    	return '请选择类型';
	    }
	  },
	  money: function(value, item){ 
	    if(!value){
	    	return '请添加充值卡面额';
	    }
	  },
	  num: function(value, item){ 
	    if(!value){
	    	return '请填写赠送数量';
	    }
	  }
	});
	//监听提交
  	form.on('submit(addGift)', function(data){
    	//表单提交
    	$.ajax({
    		type:"post",
    		url:"<?=url('ShopGift/addCardPost')?>",
    		data:{post:data.field},
    		dataType:'json',
    		success:function(res){
    			if(res.code==0){
    				layer.msg(res.message);
    				setTimeout(function(){
    					window.location.href='<?=url("ShopGift/index")?>?id=<?=Request::get('goods_id')?>';
    				},1100);
    			}else{
    				layer.msg(res.message);
    			}
    		},
    		error:function(res){
    			layer.alert('系统故障！');
    		},
    	})
    	return false;
  	});
});
</script>
</body>
</html>