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
<!-- 所有页面使用的样式 -->
<link rel="stylesheet" href="<?=assets::css('main.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('spop.min.css')?>" type="text/css" media="all" />
<!-- 当前页面的插件使用的样式 -->
<link rel="stylesheet" href="<?=assets::css('tab.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('form.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('button.loading.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('datatables.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('panel.css')?>" type="text/css" media="all" />
<!-- 当前页面使用的样式 -->
<link rel="stylesheet" href="<?=assets::css('admin/update.css')?>" type="text/css" media="all" />
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
					<div class="tab">
						<div class="tab-header">
							<a class="tab-title active" href="#base">信息</a>
							<a class="tab-title" href="#log">日志</a>
						</div>
						<div class="tab-body">
							<div class="tab-page active" id="base">
								<div class="line"></div>
								<div class="top-tips">
									<div class="top-tips-title">操作提示</div>
									<div class="top-tips-body">
										<p>超级管理员拥有全部权限，即使没有配置角色</p>
										<p>一个管理员可以拥有多个角色</p>
										<p>
											权限分配给角色，管理员的权限通过角色来判断，可以进入
											<a href="<?=url('role/index')?>">角色管理</a>
											来配置角色的权限
										</p>
									</div>
								</div>
								<div class="line"></div>
								<form class="form" id="form" action="<?=url('admin/update')?>" data-id="<?=Request::get('id')?>">
									<div class="panel col-md-5 center-block">
										<div class="panel-head">
											<div class="panel-title">基础信息</div>
										</div>
										<div class="panel-body">
											<div class="form-group col-md-10">
												<label class="label col-md-2">用户名</label>
												<input type="text" class="input_text col-md-7" name="username" value="<?=$admin['username']?>" readonly placeholder="登陆用户名">
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">真实姓名</label>
												<input type="text" class="input_text col-md-7" name="realname" value="<?=$admin['realname']?>" placeholder="真实姓名">
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">邮箱</label>
												<input type="text" class="input_text col-md-7" name="email" value="<?=$admin['email']?>" placeholder="邮箱">
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">手机号码</label>
												<input type="text" class="input_text col-md-7" name="mobile" value="<?=$admin['mobile']?>" placeholder="手机号码">
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">锁定状态</label>
												<select class="select col-md-7" name="islock">
													<option value="0" <?=$admin['islock']==0?"selected":''?>>未锁定</option>
													<option value="1" <?=$admin['islock']==1?"selected":''?>>已锁定</option>
												</select>
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">新密码</label>
												<input type="text" class="input_text col-md-7" name="password" placeholder="新密码">
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">权限等级</label>
												<select class="col-md-7 select" name="issupper">
													<option value="0" <?=$admin['issupper']==0?'selected':''?>>普通管理员</option>
													<option value="1" <?=$admin['issupper']==1?'selected':''?>>超级管理员</option>
												</select>
											</div>
											<div class="form-group col-md-10" id="role_selector">
												<label class="col-md-2 label">角色</label>
												<div class="col-md-7">
				  									<?php if (!empty($role)){?>
				  									<?php foreach ($role as $r){?>
				  									<div class="col-md-2">
														<label class="checkbox-for center-block" title="<?=$r['note']?>">
															<input name="role[]" type="checkbox" value="<?=$r['id']?>" <?=in_array($r['id'], $admin['role'])?'checked':''?>>  <?=$r['name']?>
														</label>
													</div>
													<?php }?>
													<?php }else{?>
													没有任何角色，请先<a href="<?=url('role/create')?>">添加角色</a>
													<?php }?>
				  								</div>
											</div>
										</div>
									</div>
									
									<?php if (helper::isCompanyMp(companyHelper::getCompanyId())){?>
									<div class="line"></div>
									<div class="panel col-md-5 center-block">
										<div class="panel-head">
											<div class="panel-title">绑定微信号</div>
										</div>
										<div class="panel-body">
											<div class="form-group col-md-10">
												<label class="label col-md-2">绑定微信</label>
												<div class="qrcode col-md-3" style="width: 100px;">
													<?php if (empty($admin['wechat_openid'])){?>
													<img class="gravatar" src="<?=$admin_qrcode?>" style="width: 100px;">
													<div class="nickname" style="text-align: center;font-size:12px;">微信扫描二维码</div>
													<input type="hidden" name="wechat_info" value="">
													<button data-image="<?=$admin_qrcode?>" class="button button-xs col-md-10 wechat_bind_delete display-none" style="margin: 5px 0px;">解除绑定</button>
													<?php }else{?>
														<?php if (isset($admin['wechat_gravatar']) && !empty($admin['wechat_gravatar'])){?>
														<img class="gravatar" src="<?=$admin['wechat_gravatar']?>" style="width: 100px;">
														<?php }?>
														<?php if (!empty($admin['wechat_nickname'])){?>
														<div class="nickname" style="text-align: center;font-size:12px;"><?=$admin['wechat_nickname']?></div>
														<?php }else{?>
														<div class="nickname" style="text-align: center;font-size:12px;">已绑定微信</div>
														<?php }?>
														<input type="hidden" name="wechat_info" value="">
													<button data-image="<?=$admin_qrcode?>" class="button button-xs col-md-10 wechat_bind_delete" style="margin: 5px 0px;">解除绑定</button>
													<?php }?>
												</div>
											</div>
										</div>
									</div>
									<?php }?>
									
									<div class="form-submit">
										<div class="center-block submit-body">
											<button type="submit" class="button button-submit button-large">保存</button>
											<button type="reset" class="button button-cancel button-large">重置</button>
										</div>
									</div>
								</form>
							</div>
							<div class="tab-page" id="log">
								<div class="line">
									<form id="search">
										<input type="text" placeholder="事件" class="input_text col-md-2">
										<button class="button primary">搜索</button>
									</form>
								</div>
								<table id="logTable" class="table" data-ajax-url="<?=url('admin/log')?>" data-admin_id="<?=Request::get('id')?>">
									<thead>
										<tr>
											<th>时间</th>
											<th>类型</th>
											<th>事件</th>
											<th>UA</th>
											<th>IP</th>
										</tr>
									</thead>
									<tbody></tbody>
									<tfoot>
										<tr>
											<td colspan="2"></td>
											<td id="split_page" colspan="10"></td>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
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
<script type="text/javascript" src="<?=assets::js('spop.min.js')?>"></script>
<!-- 当前页面使用插件的js -->
<script type="text/javascript" src="<?=assets::js('tab.js')?>"></script>
<script type="text/javascript" src="<?=assets::js('button.loading.js')?>"></script>
<script type="text/javascript" src="<?=assets::js('jquery.md5.js')?>"></script>
<script type="text/javascript" src="<?=assets::js('datatables.js')?>"></script>
<script type="text/javascript" src="<?=assets::common('socket.io.js','js')?>"></script>
<script type="text/javascript" src="<?=assets::js('websocket.js')?>"></script>
<script>
$.ajaxSetup({
	headers: {
        '__token__': '<?=Request::token('__token__')?>' ,
    },
});
</script>
<!-- 当前页面独有的js -->
<script type="text/javascript">
$(function(){
	<?php if (helper::isCompanyMp(companyHelper::getCompanyId())){?>
	websocket.join('<?=companyHelper::getCompanyId()?>','company_admin_bind_wechat',{
		qrcode_id:'<?=$admin_qrcode_id?>'
	});
    websocket.on('user_qrcode_info',function(response){
        if(response.subscribe == 0)
		{
			$('.qrcode .gravatar').remove();
			$('.qrcode .nickname').html('成功绑定微信');
		}
		else
		{
			$('.qrcode .gravatar').attr('src',response.headimgurl);
			$('.qrcode .nickname').html(response.nickname);
		}
		$('input[name=wechat_info]').val(JSON.stringify(response));
		$('.wechat_bind_delete').removeClass('display-none');
    });

	$('.wechat_bind_delete').on('click',function(){
		$('input[name=wechat_info]').val(-1);
		$('.nickname').html('微信扫描二维码');
		$('.gravatar').attr('src',$(this).data('image'));
		$(this).addClass('display-none');
		return false;
	});
	<?php }?>

	$('#form').on('submit',function(){
		var password = $.trim($('#form input[name=password]').val());
		
		var issupper = $('select[name=issupper]').val();
		var role = [];
		$('#role_selector input[type=checkbox]:checked').each(function(index,value){
			role.push($(value).val());
		});
		
		var data = {
			id:$(this).data('id'),
			realname:$.trim($('#form input[name=realname]').val()),
			email:$.trim($('#form input[name=email]').val()),
			mobile:$.trim($('#form input[name=mobile]').val()),
			islock:$('#form select[name=islock]').val(),
			issupper:issupper,
			role:role,
			wechat_info:$('#form input[name=wechat_info]').val(),
		}

		if(password.length>0)
		{
			data.password = $.md5(password);
		}
		$('#form .button-submit').loading('start');
		$.post($(this).attr('action'),data,function(response){
			$('#form .button-submit').loading('stop');
			if(response.code==1)
			{
				spop({
				    template: response.message,
				    style: response.code==1?'success':'error',
				    autoclose: 3000,
				    position:'bottom-right',
				    icon:true,
				    group:false,
				});
			}
			else
			{
				spop({
				    template: response.message,
				    style: response.code==1?'success':'error',
				    autoclose: 3000,
				    position:'bottom-right',
				    icon:true,
				    group:false,
				});
			}
		});
		return false;
	});

	var table = datatables({
		table:$('#logTable'),
		ajax:{
			data:{
				admin_id:$('#logTable').data('admin_id'),
			},
			method:'post',
		},
		columns:[{
			data:'time',
		},{
			data:'type',
		},{
			data:'content',
		},{
			data:'ua',
		},{
			data:'ip',
		}],
		columnDefs:[{
			targets:1,
			render:function(data,full){
				return data==0?'登陆':'其他';
			}
		}],
		sort:{
			time:'desc',
		},
		pagesize:10,
		onRowLoaded:function(row){
			
		}
	});

	$('#log #search').on('submit',function(){
		table.search($(this).find('input').val());
		return false;
	});

	$('select[name=issupper]').on('change',function(){
		if($(this).val()==1)
		{
			$('#role_selector').hide();
		}
		else
		{
			$('#role_selector').show();
		}
	}).trigger('change');

	tab.init();
});
</script>
</body>
</html>