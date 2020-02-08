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
<!-- 所有页面使用的样式 -->
<link rel="stylesheet" href="<?=assets::css('main.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('spop.min.css')?>" type="text/css" media="all" />
<!-- 当前页面的插件使用的样式 -->
<link rel="stylesheet" href="<?=assets::css('panel.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('form.css')?>" type="text/css" media="all" />
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
					<div class="top-tips">
						<div class="top-tips-title">操作提示</div>
						<div class="top-tips-body">
							<p>添加小程序绑定</p>
						</div>
					</div>
					<div class="line"></div>
					<form id="accountForm" class="form" method="post" action="<?=url()?>">
						<div class="panel  center-block">
							<div class="panel-head">
								<div class="panel-title">基础信息</div>
							</div>
							<div class="panel-body">
								<div class="form-group col-md-10">
									<label class="label col-md-2">消息通知地址</label>
									<input type="text" class="input_text col-md-7" name="url" readonly value="保存小程序信息后可用">
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">小程序名称</label>
									<input type="text" class="input_text col-md-7" name="name" placeholder="小程序名称">
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">APPID</label>
									<input type="text" class="input_text col-md-7" name="appid" placeholder="小程序名称的APPID">
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">APPSECRET</label>
									<input type="text" class="input_text col-md-7" name="appsecret" placeholder="小程序名称的appsecret">
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">TOKEN</label>
									<input type="text" class="input_text col-md-7" name="token" placeholder="令牌TOKEN">
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">EncodingAESKey</label>
									<input type="text" class="input_text col-md-7" name="encoding_key" placeholder="EncodingAESKey">
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">消息加解密方式</label>
									<select class="select col-md-7" name="encoding_type">
										<option value="">不加密</option>
									</select>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">数据格式</label>
									<select class="select col-md-7" name="data_type">
										<option value="xml">XML</option>
									</select>
								</div>
							</div>
						</div>
						<div class="form-submit">
							<div class="center-block submit-body">
								<button type="submit" class="button button-submit button-large">保存</button>
								<button type="reset" class="button button-cancel button-large">重置</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	{include file='common/footer' /}
<!-- 通用js -->
<script type="text/javascript" src="<?=assets::common('jquery.min.js','js')?>"></script>
<!-- 全局js调用 -->
<script type="text/javascript" src="<?=assets::js('global.js')?>"></script>
<script type="text/javascript" src="<?=assets::js('spop.min.js')?>"></script>
<!-- 当前页面使用插件的js -->
<script type="text/javascript" src="<?=assets::common('jquery.dialog.js','js')?>"></script>
<script type="text/javascript" src="<?=assets::js('button.loading.js')?>"></script>
<script>
$.ajaxSetup({
	headers: {
        '__token__': '<?=Request::token('__token__')?>' ,
    },
});
</script>
<script type="text/javascript">
$(function(){
	$('#accountForm').on('submit',function(){
		$('.button-submit').loading('start');
		var data = $(this).serialize();
		$.post($(this).attr('action'),data,function(response){
			$('.button-submit').loading('stop');
			spop({
			    template: response.message,
			    style: response.code==1?'success':'error',
			    autoclose: 3000,
			    position:'bottom-right',
			    icon:true,
			    group:false,
			});

			if(response.code==1)
			{
				$('input[name=url]').val(response.data.url);
			}
		});
		return false;
	});
});
</script>
</body>
</html>