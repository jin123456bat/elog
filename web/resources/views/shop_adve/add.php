<?php
use jin123456bat\assets;
use think\facade\Request;
use jin123456bat\helper;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title><?=$setting['site_title']?> | <?=$setting['site_desc']?></title>
  <link rel="stylesheet" href="/static/layui/css/layui.css" type="text/css" media="all" />
  <link rel="stylesheet" href="/static/layui/jquery-ui.css">
  <!-- 所有页面使用的样式 -->
  <link rel="stylesheet" href="<?=assets::css('main.css')?>"type="text/css" media="all" />
  <style type="text/css">
	.layui-upload-img{width:92px;height:92px}.tip_img{display:block;text-align:center;width:100%;background:rgba(0,0,0,0.8);color:white;font-size:12px}.tip_del{position:absolute;top:0;left:0;display:none}.tip_curr{position:absolute;bottom:0;left:0;display:none}.tipBox{float:left;margin-left:15px}#goodDescBox{overflow:hidden}.layui-upload-list{display:none}#testListAction{display:none}.img_box{position:absolute;top:0;right:0;width:100px}.img_box img{height:100%;width:100%}#editor{width:50%;z-index:100!important}blockquote{width:50%}.layui-upload-img{width:92px;height:92px}.tip_img{display:block;text-align:center;width:100%;background:rgba(0,0,0,0.8);color:white;font-size:12px}.tip_del{position:absolute;top:0;left:0;display:none}.tip_curr{position:absolute;bottom:0;left:0;display:none}.tipBox{float:left;margin-left:15px}#goodDescBox{overflow:hidden}.show{display: block;}.floatNone{float:none!important;}.wauto{width: auto!important;}.w300{width: 300px !important;}.skuImgBtn{cursor:pointer;}.hide{display: none;}
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
					  <legend>添加广告</legend>
					</fieldset>
					<form class="layui-form" action="">
            <div class="layui-form-item">
                <label class="layui-form-label">广告图</label>
                <div class="layui-input-block">
                  <button type="button" class="layui-btn layui-btn-normal" id="goodDescImgBtn"><i class="layui-icon">&#xe681</i>选择广告图</button> 
                  <blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;">
                      预览图：
                      <div class="layui-upload-list" id="goodDescBox"></div>
                  </blockquote>
                  <div class="layui-form-mid layui-word-aux">每张图片大小不能超过1M,格式只能是'png,jpg,jpeg,gif',<b>拖动图片可调整图片前端展示的顺序</b></div>
                </div>
            </div>
            
  					<div class="layui-form-item">
  					    <div class="layui-input-block">
  					      <button class="layui-btn layui-btn-normal" id="addAdve"  lay-submit="" lay-filter="addAdve">立即提交</button>
  					    </div>
  					</div>
				</form>
			</div>
		</div>
  	</div>
  </div>
</body>
<script src="/static/common/js/jquery.min.js"></script>
<script src="/static/layui/layui.all.js"></script>
<script src="/static/layui/jquery-ui.js"></script>
<script type="text/javascript">
var imgArr = Array();
var limit_num = 10;
//多图上传
layui.use('upload', function() {
    var $ = layui.jquery,
        upload = layui.upload;
    //展示型多图上传
    upload.render({
      elem: "#goodDescImgBtn",
      url: "<?=url('common/component/upload')?>",
      data: { type: 'shop_adve' },
      multiple: true,
      size: 1000,
      number: 5,//每次最大选择张数
      before: function(obj) {
          window.index = layer.load(1, {
            shade: [0.1,'#fff'] //0.1透明度的白色背景
          });
          //预读本地文件示例，不支持ie8
          obj.preview(function(index, file, result) {
              var img_num = $('#goodDescBox').find('.tipBox').length;
              if (img_num >= limit_num) {
                  layer.msg('最大上传数量为' + limit_num);
                  return false;
              }
              $(goodDescImgBtn).siblings('blockquote').find('.layui-upload-list').show();
              var imgbox = $('<div class="tipBox" box_data="' + index + '"><img src="' + result + '" alt="' + file.name + '" class="layui-upload-img"><span class="tip_img tip_curr" >删除</span></div>').css({ 'width': '92px', 'height': '92px', 'position': 'relative' });
              $('#goodDescBox').append(imgbox);
              //删除图片
              $(".tip_curr").click(function() {
                  $(this).parents('.tipBox').remove();
              })
          });
          //移入图片
          $('#goodDescBox').on('mouseover', '.tipBox', function() {
              $(this).find('.tip_img').show();
          })
          //移出图片
          $('#goodDescBox').on('mouseout', '.tipBox', function() {
              $(this).find('.tip_img').hide();
          })
      },
      done: function(res, index) {
          if (res.code == 1 && res.message == 'OK') {
            layer.close(window.index)
              $('div[box_data="' + index + '"]').append('<input type="hidden" name="good_desc_img[]" value="' + res.data.id + '">');
          }
      }
  });
    $("#goodDescBox").sortable();
    $("#goodDescBox").disableSelection();
});

//表单监听
layui.use('form', function() {
    var form = layui.form;
    //监听提交
    form.on('submit(addAdve)', function(data) {
      var adves = '';//价格
      $.each(data.field,function(k,v){
        //详情图
        if(k.indexOf('good_desc_img')==0){
          adves += v+',';
        }
      })
      if(adves.length<1){
        layer.alert('请上传图片！');
        return false;
      }
      $.ajax({
        type:'post',
        url:'<?=url("ShopAdve/add_post")?>',
        data:{
          post:adves
        },
        dataType:'json',
        success:function(res){
          layer.msg(res.message);
          if(res.code==0){
            setTimeout(function(){
              window.location.href='<?=url("ShopAdve/index")?>';
            },1100);
          }
        }
      })
      return false;
    });
});
</script>
</body>
</html>