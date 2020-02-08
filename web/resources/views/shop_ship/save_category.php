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
					  <legend>修改分类</legend>
					</fieldset>
					<form class="layui-form" action="">
					<div class="layui-form-item">
					    <label class="layui-form-label">分类名称</label>
					    <div class="layui-input-inline">
					      <input type="text" name="name" lay-verify="name" autocomplete="off" value="{$categoryInfo.name}" placeholder="请输入分类名称" class="layui-input">
					    </div>
					</div>
					<div class="layui-form-item">
					    <label class="layui-form-label">上级分类</label>
					    <div class="layui-input-inline layui-form" lay-filter="parent_category_idBox">
					     <select name="parent_category_id">
					     	<option value="">顶级分类</option>
					        <?php
                      function getSon($id,$array=array(),$level=0,$categoryInfo){
                          $str = '';
                          static $lists;
                          foreach ($array as $k => $v) {
                              if( $v['parent_category_id'] == $id){

                                  $flg = str_repeat('|--',$level);
                                  $v['name'] = $flg.$v['name'];
                                  if( $categoryInfo['category_id'] == $v['category_id'] ){
                                    $select = 'selected=""';
                                  }else{
                                    $select = '';
                                  }
                                  echo '<option '.$select.' value="'.$v['category_id'].'">'.$v["name"].'</option>';
                                  $lists[] = $v;
                                  unset($array[$k]);
                                  getSon($v['category_id'],$array,$level+1,$categoryInfo);
                              }
                          }
                      }
                      getSon(0,$categoryList,0,$categoryInfo);
                  ?>
					      </select>
					    </div>
					</div>
				  	<div class="layui-form-item">
				  		 <label class="layui-form-label">分类图片</label>
				  		 <div class="layui-input-block">
						  	<div class="layui-upload">
							  <button type="button" class="layui-btn" id="category_img">上传图片</button>
							  <div class="layui-upload-list">
							    <img class="layui-upload-img" id="demo1" src="{$categoryInfo.logo_path}">
							    <p id="demoText"></p>
							  </div>
							</div>
						</div> 
					</div>
					<div class="layui-form-item">
					    <label class="layui-form-label">是否显示</label>
					    <div class="layui-input-block">
					      <input type="radio" name="status" value="1" title="显示" {eq name="$categoryInfo.status" value="1"}checked=""{/eq} >
					      <input type="radio" name="status" value="2" title="不显示" {eq name="$categoryInfo.status" value="2"}checked=""{/eq}>
					    </div>
					</div>
					<div class="layui-form-item">
					    <label class="layui-form-label">排序</label>
					    <div class="layui-input-inline">
					      <input type="number" name="sort" lay-verify="sort" value="{$categoryInfo.sort}" autocomplete="off" placeholder="数值越小越靠前" class="layui-input">
					    </div>
					</div>
					<div class="layui-form-item">
					    <div class="layui-input-block">
					      <button class="layui-btn layui-btn-normal" id="addCategory" lay-submit="" lay-filter="addCategory">立即提交</button>
					    </div>
					</div>
					<input type="hidden" name="logo_path" value="{$categoryInfo.logo_path}">
					<input type="hidden" name="logo_id" value="{$categoryInfo.logo_id}">
					<input type="hidden" name="company_id" value="<?=companyHelper::getCompanyId()?>">
          <input type="hidden" name="category_id" value="{$categoryInfo.category_id}">
				</form>
			</div>
		</div>
  	</div>
  </div>
</body>
<script src="/static/common/js/jquery.min.js"></script>
<script src="/static/layui/layui.all.js"></script>
<script type="text/javascript">
//单图上传
layui.use('upload', function(){
  var $ = layui.jquery
  ,upload = layui.upload;
    //普通图片上传
  var uploadInst = upload.render({
    elem: '#category_img'
    ,url: '<?=url('common/component/upload')?>'
    ,data:{type:'shop_category'}
    ,before: function(obj){
      //预读本地文件示例，不支持ie8
      obj.preview(function(index, file, result){
        $('#demo1').attr('src', result); //图片链接（base64）
      });
    }
    ,done: function(res){
      //如果上传失败
      if(res.code <= 0){
        return layer.msg('上传失败');
      }
      //上传成功
      $('input[name="logo_path"]').val(res.data.url);
      $('input[name="logo_id"]').val(res.data.id);
    }
    ,error: function(){
      //演示失败状态，并实现重传
      var demoText = $('#demoText');
      demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
      demoText.find('.demo-reload').on('click', function(){
        uploadInst.upload();
      });
    }
  });
});
//表单验证
layui.use('form', function(){
 	var form = layui.form;
	//表单验证
	form.verify({
	  name: function(value, item){ 
	    if(!value){
	    	return '标签名称不能为空';
	    }
	  }
	});
	//监听提交
  	form.on('submit(addCategory)', function(data){
    	//表单提交
    	$.ajax({
    		type:"post",
    		url:"<?=url('ShopCategory/addCategoryPost')?>",
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