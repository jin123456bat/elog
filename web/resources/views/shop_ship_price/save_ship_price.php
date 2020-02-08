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
  <link rel="stylesheet" href="/static/layui/formSelects-v4.css" type="text/css" media="all" />
  <!-- 所有页面使用的样式 -->
  <link rel="stylesheet" href="<?=assets::css('main.css')?>"type="text/css" media="all" />
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
					  <legend>修改运费</legend>
				</fieldset>
				<form class="layui-form" action="">
          <div class="layui-form-item">
            <label class="layui-form-label">是否包邮</label>
            <div class="layui-input-block">
              <input type="checkbox" name="free" {$check} lay-skin="switch" lay-filter="free" lay-text="包邮|不包邮">
            </div>
          </div>
          <div class="layui-form-item free_none">
            <label class="layui-form-label">首重</label>
            <div class="layui-input-inline">
              <input type="number" name="first_weight" lay-verify="first_weight" autocomplete="off" placeholder="首重单位KG" class="layui-input" value="{$shipPrice.first_weight}">
            </div>
          </div>
          <div class="layui-form-item free_none">
            <label class="layui-form-label">首价</label>
            <div class="layui-input-inline">
              <input type="number" name="first_price" lay-verify="first_price" value="{$shipPrice.first_price/100}" autocomplete="off" placeholder="首价" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item free_none">
            <label class="layui-form-label">续重</label>
            <div class="layui-input-inline">
              <input type="number" name="next_weight" lay-verify="next_weight" value="{$shipPrice.next_weight}" autocomplete="off" placeholder="续重单位KG" class="layui-input">
            </div> 
          </div>
          <div class="layui-form-item free_none">
            <label class="layui-form-label">续重价格</label>
            <div class="layui-input-inline">
              <input type="number" name="next_price" lay-verify="next_price" value="{$shipPrice.next_price/100}" autocomplete="off" placeholder="续重价格" class="layui-input">
            </div>
          </div>
					<div class="layui-form-item">
					    <div class="layui-input-block">
					      <button class="layui-btn layui-btn-normal" id="addShipPrice" lay-submit="" lay-filter="addShipPrice">立即提交</button>
					    </div>
					</div>

          <input type="hidden" name="ship_id" value="{$shipPrice.ship_id}">
          <input type="hidden" name="province_id" value="{$shipPrice.province_id}">
          <input type="hidden" name="company_id" value="<?=companyHelper::getCompanyId()?>">
				</form>
			</div>
		</div>
  	</div>
  </div>
</body>
<script src="/static/common/js/jquery.min.js"></script>
<script src="/static/layui/layui.all.js"></script>
<script src="/static/layui/formSelects-v4.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
  $(function(){
    var check = "{$check}";
    if(check){
      $('.free_none').hide().find('input').val('').attr('disabled','');
    }
  })
var formSelects = layui.formSelects;
//表单验证
layui.use('form', function(){
 	var form = layui.form;
  form.on('switch(free)', function(data){
    if(data.elem.checked){
      $('.free_none').hide().find('input').val('').attr('disabled','');
    }
    if(!data.elem.checked){
      $('.free_none').show().find('input').val('').removeAttr('disabled');
    }
  });
	//监听提交
  	form.on('submit(addShipPrice)', function(data){
     if(data.field.free!='on'){
        if( $('input[name="first_weight"]').val()==false ){
          layer.msg('请填写首重！');
          return false;
        }
        if( $('input[name="first_price"]').val()==false ){
          layer.msg('请填写首价！');
          return false;
        }
        if( $('input[name="next_weight"]').val()==false ){
          layer.msg('请填写续重！');
          return false;
        }
        if( $('input[name="next_price"]').val()==false ){
          layer.msg('请填写续重价！');
          return false;
        }
     }
    	//表单提交
    	$.ajax({
    		type:"post",
    		url:"<?=url('ShopShipPrice/saveShipPricePost')?>",
    		data:{post:data.field},
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
    	})
    	return false;
  	});
});
</script>
</body>
</html>