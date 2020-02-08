<?php
use jin123456bat\assets;
use think\facade\Request;
use jin123456bat\companyController;
use jin123456bat\helper;
use app\company\companyHelper;
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
<link rel="stylesheet" href="<?=assets::css('form.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('panel.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('button.loading.css')?>" type="text/css" media="all" />
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
							<p>cms的配置项</p>
						</div>
					</div>
					<div class="col-md-10">
						<form id="bannerForm" class="form" method="post" action="<?=url('cms/setting')?>">
							<div class="panel col-md-7 center-block">
								<div class="panel-head">
									<div class="panel-title">基础信息</div>
								</div>
								<div class="panel-body">
									<div class="form-group col-md-10">
										<label class="label col-md-2">LOGO</label>
										<div class="col-md-7" id="image_area"></div>
										<span class="text-helper col-offset-2">建议125x35</span>
									</div>
									<div class="form-group col-md-10">
										<label class="label col-md-2">站点标题</label>
										<input type="text" name="title" class="input_text col-md-7" value="<?=$cms_setting['title']??''?>">
									</div>
									<div class="form-group col-md-10">
										<label class="label col-md-2">电话</label>
										<input type="text" name="phone" class="input_text col-md-7" value="<?=$cms_setting['phone']??''?>">
									</div>
									<div class="form-group col-md-10">
										<label class="label col-md-2">地址</label>
										<input type="text" name="address" class="input_text col-md-7" value="<?=$cms_setting['address']??''?>">
									</div>
									<div class="form-group col-md-10">
										<label class="label col-md-2">传真</label>
										<input type="text" name="fax" class="input_text col-md-7" value="<?=$cms_setting['fax']??''?>">
									</div>
									<div class="form-group col-md-10">
										<label class="label col-md-2">邮箱</label>
										<input type="text" name="email" class="input_text col-md-7" value="<?=$cms_setting['email']??''?>">
									</div>
								</div>
							</div>
							<div class="panel col-md-7 center-block">
								<div class="panel-head">
									<div class="panel-title">SEO信息</div>
								</div>
								<div class="panel-body">
									<div class="form-group col-md-10">
										<label class="label col-md-2">描述</label>
										<input type="text" name="description" class="input_text col-md-7" value="<?=$cms_setting['description']??''?>">
									</div>
									<div class="form-group col-md-10">
										<label class="label col-md-2">关键字</label>
										<input type="text" name="keywords" class="input_text col-md-7" value="<?=$cms_setting['keywords']??''?>">
									</div>
								</div>
							</div>
							<div class="panel col-md-7 center-block">
								<div class="panel-head">
									<div class="panel-title">酒店服务</div>
								</div>
								<div class="panel-body">
									<div class="form-group col-md-10">
										<label class="label col-md-2">选择服务</label>
										<div class="col-md-7">
											<?php 
											$service = [];
											$temp = json_decode(\app\cms\model\Setting::getter(companyHelper::getCompanyId(),'service','{}'),true);
											foreach ($temp as $t)
											{
												$service[$t['name']] = $t['desc'];
											}
											?>
											
											<table style="width: 100%">
												<tr>
													<td>
														<input type="checkbox" class="service" name="wifi" id="wifi" <?=isset($service['wifi'])?'checked="checked"':''?>>
													</td>
													<td>
														<label for="wifi">免费wifi</label>
													</td>
													<td>
														<input type="text" class="input_text col-md-7" name="wifi" value="<?=$service['wifi']??''?>">
													</td>
												</tr>
												<tr>
													<td>
														<input type="checkbox" class="service" name="free-breakfast" id="free-breakfast" <?=isset($service['free-breakfast'])?'checked="checked"':''?>>
													</td>
													<td>
														<label for="free-breakfast">免费早餐</label>
													</td>
													<td>
														<input type="text" class="input_text col-md-7" name="free-breakfast" value="<?=$service['free-breakfast']??''?>">
													</td>
												</tr>
												<tr>
													<td>
														<input type="checkbox" class="service" name="private-pool" id="private-pool" <?=isset($service['private-pool'])?'checked="checked"':''?>>
													</td>
													<td>
														<label for="private-pool">私人泳池</label>
													</td>
													<td>
														<input type="text" class="input_text col-md-7" name="private-pool" value="<?=$service['private-pool']??''?>">
													</td>
												</tr>
												<tr>
													<td>
														<input type="checkbox" class="service" name="kids-playground" id="kids-playground" <?=isset($service['kids-playground'])?'checked="checked"':''?>>
													</td>
													<td>
														<label for="kids-playground">儿童乐园</label>
													</td>
													<td>
														<input type="text" class="input_text col-md-7" name="kids-playground" value="<?=$service['kids-playground']??''?>">
													</td>
												</tr>
												<tr>
													<td>
														<input type="checkbox" class="service" name="airport-taxi" id="airport-taxi" <?=isset($service['airport-taxi'])?'checked="checked"':''?>>
													</td>
													<td>
														<label for="airport-taxi">机场接送</label>
													</td>
													<td>
														<input type="text" class="input_text col-md-7" name="airport-taxi" value="<?=$service['airport-taxi']??''?>">
													</td>
												</tr>
												<tr>
													<td>
														<input type="checkbox" class="service" name="butler" id="butler" <?=isset($service['butler'])?'checked="checked"':''?>>
													</td>
													<td>
														<label for="butler">管家服务</label>
													</td>
													<td>
														<input type="text" class="input_text col-md-7" name="butler" value="<?=$service['butler']??''?>">
													</td>
												</tr>
											</table>
										</div>
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
	</div>
	{include file='common/footer' /}
	<!-- 通用js -->
	<script type="text/javascript" src="<?=assets::common('jquery.min.js','js')?>"></script>
	<!-- 全局js调用 -->
	<script type="text/javascript" src="<?=assets::js('global.js')?>"></script>
	<!-- 当前页面使用的第三方类库的js -->
	<script type="text/javascript" src="<?=assets::js('datatables.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('spop.min.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('button.loading.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('upload.js')?>"></script>
	<script>
$.ajaxSetup({
	headers: {
        '__token__': '<?=Request::token('__token__')?>' ,
    } ,
});
$(function(){
	$('#image_area').upload({
		<?php if (isset($cms_setting['logo']) && !empty($cms_setting['logo'])){?>
		init:[{'id':<?=$cms_setting['logo']?>,'url':'<?=helper::getImageUrl($cms_setting['logo'])?>'}],
		<?php }?>
		width:100,
		height:100,
		size:10*1024*1024,//文件大小  字节
		type:[//文件类型
			'image/jpg',
			'image/jpeg',
			'image/png',
			'image/bmp',
			'image/gif',
		],
		ajax:{
			url:'<?=url('common/component/upload')?>',//ajax请求地址
			data:{
				type:'cms_logo',
			}
		},
		default_image:'<?=assets::common('plus.png','image')?>',//默认的图片
		max_num:1,//单张图片
		sort:false,//不允许排序
	});

	$('form').on('submit',function(){
		var service = [];
		$('input[type=checkbox].service:checked').each(function(){
			service.push({
				name:$(this).attr('name'),
				desc:$(this).parents('tr').find('input[type=text][name='+$(this).attr('name')+']').val(),
			});
		});
		
		var data = {
			logo:$(this).find('#image_area .images').attr('id'),
			title:$.trim($(this).find('input[name=title]').val()),
			phone:$.trim($(this).find('input[name=phone]').val()),
			email:$.trim($(this).find('input[name=email]').val()),
			address:$.trim($(this).find('input[name=address]').val()),
			fax:$.trim($(this).find('input[name=fax]').val()),
			keywords:$.trim($(this).find('input[name=keywords]').val()),
			description:$.trim($(this).find('input[name=description]').val()),
			service:service
		}
		var btn = $(this).find('button[type=submit]');
		btn.loading('start');
		$.post($(this).attr('action'),data,function(response){
			btn.loading('stop');
			spop({
			    template: response.message,
			    style: response.code==1?'success':'error',
			    autoclose: 3000,
			    position:'bottom-right',
			    icon:true,
			    group:false,
			});
		});
		return false;
	});
});
</script>
</body>
</html>