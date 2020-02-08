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
<!-- 当前页面使用的样式 -->
<link rel="stylesheet" href="<?=assets::css('wechat/account.css')?>" type="text/css" media="all" />
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
							<p>配置微信公众账号信息</p>
							<p>先将微信公众账号信息填入下方，保存</p>
							<p>将消息通知地址复制到公众平台后的服务器配置中</p>
							<p>保存公众平台配置</p>
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
									<input type="text" class="input_text col-md-7" value="<?=$url?>" readonly>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">公众平台名称</label>
									<input type="text" class="input_text col-md-7" name="wechat_mp_name" value="<?=$mp['wechat_mp_name']?>" placeholder="微信公众平台名称" readonly>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">微信原始ID</label>
									<input type="text" class="input_text col-md-7" name="source_id" value="<?=$mp['source_id']?>" placeholder="微信原始ID" readonly>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">APPID</label>
									<input type="text" class="input_text col-md-7" name="appid" value="<?=$mp['appid']?>" placeholder="微信公众号的APPID" readonly>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">APPSECRET</label>
									<input type="text" class="input_text col-md-7" name="appsecret" value="<?=$mp['appsecret']?>" placeholder="微信公众号的appsecret" readonly>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">TOKEN</label>
									<input type="text" class="input_text col-md-7" name="token" value="<?=$mp['token']?>" placeholder="令牌TOKEN" readonly>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">EncodingAESKey</label>
									<input type="text" class="input_text col-md-7" name="encoding_key" value="<?=$mp['encoding_key']?>" placeholder="EncodingAESKey" readonly>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">消息加解密方式</label>
									<select class="select col-md-7" name="encoding_type">
										<option value="0" <?=$mp['encoding_type']==0?'selected':''?>>明文模式</option>
										<!-- 
										<option value="2" <?=$mp['encoding_type']==2?'selected':''?>>兼容模式</option>
										<option value="1" <?=$mp['encoding_type']==1?'selected':''?>>加密模式</option>
										 -->
									</select>
								</div>
							</div>
						</div>
						<div class="form-submit">
							<div class="center-block submit-body">
								<button type="submit" class="button button-submit button-large">修改</button>
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

$('#accountForm').on('submit',function(){
	if($('.button-submit').html()=='修改'){
		$('input').not('input:first').attr('readonly',false);
		$('.button-submit').html('保存');
		return false;
	}
	var data = $(this).serialize();
	var url = $(this).attr('action');
	$.confirm({
		title:'信息提示',
		content:'是否确认修改?修改后将不可恢复！',
		success:function(){
			$.post(url,data,function(response){
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
					$('input').not('input:first').attr('readonly',true);
				}
			});
			$('.button-submit').html('修改');
		}
	});
	
	return false;
});
</script>
</body>
</html>