<?php
use jin123456bat\assets;
use think\facade\Request;
use jin123456bat\helper;
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
<style>
.row{
	padding: 5px 0px;
}
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
					<div class="top-tips">
						<div class="top-tips-title">操作提示</div>
						<div class="top-tips-body">
							<p>PMS配置</p>
							<p>在配置PMS之前请确认与pms已获得接口，并咨询管理员</p>
							<p>目前绿云不支持消息通知</p>
						</div>
					</div>
					<div class="line"></div>
					<form id="settingForm" class="form" method="post" action="<?=url()?>">
						<div class="panel col-md-7 center-block">
							<div class="panel-head">
								<div class="panel-title">基础信息</div>
							</div>
							<div class="panel-body">
								<div class="form-group col-md-10">
									<label class="label col-md-2">PMS类型</label>
									<select name="pms_id" class="select col-md-7">
										<option value="0" <?=($company_pms['status']??0)==0?'selected="selected"':''?>>不配置</option>
										<option value="1" <?=(($company_pms['status']??0)==1 && ($company_pms['pms_id']??0)==1)?'selected="selected"':''?>>绿云</option>
										<option value="2" <?=(($company_pms['status']??0)==1 && ($company_pms['pms_id']??0)==2)?'selected="selected"':''?>>西软</option>
									</select>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">是否开通直连</label>
									<select name="direct" class="select col-md-7">
										<option value="0" <?=($company_pms['direct']??0)==0?'selected="selected"':''?>>否</option>
										<option value="1" <?=($company_pms['direct']??0)==1?'selected="selected"':''?>>是</option>
									</select>
									<span class="col-offset-2 text-helper">房型库存和价格直接通过pms取得，而非觅集取得</span>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">是否开通消息通知</label>
									<select name="order_callback" class="select col-md-7">
										<option value="0" <?=($company_pms['order_callback']??0)==0?'selected="selected"':''?>>否</option>
										<option value="1" <?=($company_pms['order_callback']??0)==1?'selected="selected"':''?>>是</option>
									</select>
									<span class="col-offset-2 text-helper">消息通知是酒店方推送入住离店等消息到觅集，因此确认酒店开通了消息通知后开启此项配置</span>
								</div>
							</div>
						</div>
						
						<div class="panel col-md-7 center-block pms-config pms-config-1 display-none">
							<div class="panel-head">
								<div class="panel-title">配置信息</div>
							</div>
							<div class="panel-body">
								<div class="form-group col-md-10 pms-2">
									<label class="label col-md-2">ipmsmember接口地址</label>
									<input type="text" name="config[1][user]" value="<?=(isset($company_pms['pms_id']) && $company_pms['pms_id']==1)?$company_pms['config']['user']:''?>" class="input_text col-md-7">
								</div>
								<div class="form-group col-md-10 pms-2">
									<label class="label col-md-2">ipmsgroup接口地址</label>
									<input type="text" name="config[1][order]" value="<?=(isset($company_pms['pms_id']) && $company_pms['pms_id']==1)?$company_pms['config']['order']:''?>" class="input_text col-md-7">
								</div>
								<div class="form-group col-md-10 pms-2">
									<label class="label col-md-2">pms集团ID</label>
									<input type="text" name="config[1][pms_company_id]" value="<?=(isset($company_pms['pms_id']) && $company_pms['pms_id']==1)?$company_pms['config']['pms_company_id']:''?>" class="input_text col-md-7">
								</div>
							</div>
						</div>
						
						<div class="panel col-md-7 center-block pms-config pms-config-2 display-none">
							<div class="panel-head">
								<div class="panel-title">配置信息</div>
							</div>
							<div class="panel-body">
								<div class="form-group col-md-10 pms-2">
									<label class="label col-md-2">接口地址</label>
									<input type="text" name="config[2][url]" value="<?=(isset($company_pms['pms_id']) && $company_pms['pms_id']==2)?$company_pms['config']['url']:''?>" class="input_text col-md-7">
								</div>
								<div class="form-group col-md-10 pms-2">
									<label class="label col-md-2">appkey</label>
									<input type="text" name="config[2][appkey]" value="<?=(isset($company_pms['pms_id']) && $company_pms['pms_id']==2)?$company_pms['config']['appkey']:''?>" class="input_text col-md-7">
								</div>
								<div class="form-group col-md-10 pms-2">
									<label class="label col-md-2">secret</label>
									<input type="text" name="config[2][secret]" value="<?=(isset($company_pms['pms_id']) && $company_pms['pms_id']==2)?$company_pms['config']['secret']:''?>" class="input_text col-md-7">
								</div>
								<div class="form-group col-md-10 pms-2">
									<label class="label col-md-2">渠道代码</label>
									<input type="text" name="config[2][cmmcode]" value="<?=(isset($company_pms['pms_id']) && $company_pms['pms_id']==2)?$company_pms['config']['cmmcode']:''?>" class="input_text col-md-7">
								</div>
								<div class="form-group col-md-10 pms-2">
									<label class="label col-md-2">预定类型代码</label>
									<input type="text" name="config[2][restype]" value="<?=(isset($company_pms['pms_id']) && $company_pms['pms_id']==2)?$company_pms['config']['restype']:''?>" class="input_text col-md-7">
								</div>
								<div class="form-group col-md-10 pms-2">
									<label class="label col-md-2">付款码</label>
									<input type="text" name="config[2][pay_code]" value="<?=(isset($company_pms['pms_id']) && $company_pms['pms_id']==2)?$company_pms['config']['pay_code']:''?>" class="input_text col-md-7">
								</div>
								<div class="form-group col-md-10 pms-2">
									<label class="label col-md-2">集团ID</label>
									<input type="text" name="config[2][company_id]" value="<?=(isset($company_pms['pms_id']) && $company_pms['pms_id']==2)?$company_pms['config']['company_id']:''?>" class="input_text col-md-7">
								</div>
								<div class="form-group col-md-10 pms-2">
									<label class="label col-md-2">证件类型代码</label>
									<div class="col-md-7">
										<?php foreach ($certificates as $cert){?>
										<div class="row">
											<input type="hidden" name="config[2][certificates][certificates_id][]" value="<?=$cert['id']?>">
											<input type="text" class="input_text col-md-4" name="config[2][certificates][name][]" readonly value="<?=$cert['name']?>">
											<input type="text" class="input_text col-md-4" name="config[2][certificates][code][]" value="<?=$company_pms['config']['certificates'][$cert['id']]??''?>">
										</div>
										<?php }?>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel col-md-7 center-block pms-config pms-config-1 display-none">
							<div class="panel-head">
								<div class="panel-title">酒店配置</div>
							</div>
							<div class="panel-body">
								<?php foreach ($hotels as $hotel){?>
								<div class="form-group col-md-10 pms-2">
									<label class="label col-md-2"><?=$hotel['name']?></label>
									<div class="form-group col-md-7">
										<div class="row">
											<label class="label col-md-2">酒店ID</label>
											<input type="text" name="hotel[1][<?=$hotel['id']?>][hotel_id]" value="<?=$hotel_pms[$hotel['id']]['hotel_id']??''?>" class="input_text col-md-7">
										</div>
										<div class="row">
											<label class="label col-md-2">入账代码</label>
											<input type="text" name="hotel[1][<?=$hotel['id']?>][taCode]" value="<?=$hotel_pms[$hotel['id']]['taCode']??''?>" class="input_text col-md-7">
										</div>
									</div>
								</div>
								<?php }?>
							</div>
						</div>
						
						<div class="panel col-md-7 center-block pms-config pms-config-2 display-none">
							<div class="panel-head">
								<div class="panel-title">酒店配置</div>
							</div>
							<div class="panel-body">
								<?php foreach ($hotels as $hotel){?>
								<div class="form-group col-md-10 pms-2">
									<label class="label col-md-2"><?=$hotel['name']?></label>
									<div class="form-group col-md-7">
										<div class="row">
											<label class="label col-md-2">酒店ID</label>
											<input type="text" name="hotel[2][<?=$hotel['id']?>][hotel_id]" value="<?=$hotel_pms[$hotel['id']]['hotel_id']??''?>" class="input_text col-md-7">
										</div>
									</div>
								</div>
								<?php }?>
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
	<script type="text/javascript" src="<?=assets::js('button.loading.js')?>"></script>
	<script type="text/javascript" src="<?=assets::common('jquery.dialog.js','js')?>"></script>
	<script>
$.ajaxSetup({
	headers: {
        '__token__': '<?=Request::token('__token__')?>' ,
    },
});
</script>
<script type="text/javascript">
$(function(){
	$('#settingForm').on('submit',function(){
		var data = $(this).serialize();
		var url = $(this).attr('action');
		$.confirm({
			title:'确认修改PMS配置参数?',
			content:'修改参数后立即生效',
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
				});
			}
		})
		return false;
	});

	$('select[name=pms_id]').on('change',function(){
		$('.pms-config').addClass('display-none');
		$('.pms-config-'+$(this).val()).removeClass('display-none');
		return false;
	}).trigger('change');
});
</script>
</body>
</html>