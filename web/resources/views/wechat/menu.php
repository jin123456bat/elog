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
<link rel="stylesheet" href="<?=assets::css('form.css')?>" type="text/css" media="all" />
<!-- 当前页面的插件使用的样式 -->
<style>
.editor {
	display: flex;
}

.wechat {
	width: 320px;
}

.wechat .wechat_head {
	background: url(<?= assets :: image('bg_mobile_wechat_head.png')?>);
	background-repeat: no-repeat;
	height: 64px;
}

.wechat .wechat_name {
	color: #fff;
	text-align: center;
	padding-top: 32px;
	font-size: 15px;
}

.wechat .wechat_body {
	height: 460px;
	border: 1px solid #ccc;
}

.wechat .wechat_foot {
	height: 44px;
	border: 1px solid #ccc;
	border-top: none;
	background: url(<?= assets :: image('bg_mobile_wechat_foot_switch.png')?>);
	background-repeat: no-repeat;
}

.wechat .plus {
	font-size: 14px;
	font-weight: bolder;
}

.wechat .menus {
	padding-left: 44px;
	height: 100%;
	line-height: 44px;
	display: flex;
	font-size: 14px;
}

.wechat .menu {
	text-align: center;
	cursor: pointer;
	height: 100%;
	flex: 1 0 33.33333%;;
	border-right: 1px solid #ccc;
	white-space: nowrap;
	width: 33.33333%;
	position: relative;
}

.wechat .menu:last-child {
	border-right: none;
}

.wechat .menu.active {
	border: 1px solid #44b549;
	color: #44b549;
}

.wechat .submenu_list {
	list-style-type: none;
	position: absolute;
	width: 100%;
	color: #000;
	margin: 0 auto;
	bottom: 44px;
	border-radius: 10px;
	border: 1px solid #ccc;
	background-color: #fafafa;
	text-overflow: ellipsis;
	overflow: hidden;
	white-space: nowrap;
	text-align: center;
	user-select: none;
}

.wechat .submenu_list .submenu {
	line-height: 44px;
	border-bottom: 1px solid #ccc;
	white-space: nowrap;
	ext-overflow: ellipsis;
	overflow: hidden;
	min-height: 45px;
}

.wechat .submenu_list .submenu:last-child {
	border-bottom: none;
}

.wechat .create_submenu_btn {
	font-size: 24px;
	color: #ccc;
}

.wechat .create_submenu_btn:hover {
	color: #000;
}

.wechat .submenu.active {
	color: #44b549;
}

.wechat_panel {
	background-color: #f4f5f9;
	width: calc(100% - 340px);
	padding: 20px;
	margin-left: 20px;
	font-size: 14px;
}

.wechat_panel .wechat_panel_head {
	float: left;
	width: 100%;
	border-bottom: 1px solid #e7e7eb;
	padding: 10px 0px;
	font-size: 14px;
}

.wechat_panel .wechat_panel_title {
	float: left;
}

.wechat_panel .wechat_panel_remove {
	float: right;
	cursor: pointer;
	color: green;
}

.wechat_panel .wechat_panel_body {
	float: left;
	width: 100%;
}

.wechat_panel .wechat_panel_body * {
	float: none;
}

.wechat_panel .form-group {
	margin-bottom: 20px;
	margin-top: 20px;
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
							<p>配置公众号自定义菜单</p>
						</div>
					</div>
					<div class="line"></div>
					<div class="top-tips">
						<div class="top-tips-title">链接地址</div>
						<div class="top-tips-body">
							<p>客房预定:<?=$room_url?></p>
							<p>客房/餐饮服务:<?=$service_url?></p>
							<p>餐饮预定:<?=$food_url?></p>
							<p>个人中心:<?=$user_center_url?></p>
							<p>智慧会议:<?=$meeting_url?></p>
							<p>创建智慧会议:<?=$create_meeting_url?></p>
							<p>客控:<?=$control_url?></p>
							<p>手机管理端:<?=$hmobile_url?></p>
							<p>商城:https://<?=Request::host()?>/page/shop#/?company_id=<?=companyHelper::getCompanyId()?></p>
						</div>
					</div>
					<div class="line"></div>
					<form id="form" class="form" method="post" action="<?=url('wechat/menu')?>">
						<div class="editor">
							<div class="wechat">
								<div class="wechat_head">
									<div class="wechat_name">微信公众账号</div>
								</div>
								<div class="wechat_body"></div>
								<div class="wechat_foot">
									<div class="menus">
										<?php foreach ($mp_menu as $m){?>
										<?php if (empty($m['sub_button'])){?>
										<?php
												$name = $m['name'];
												$type = $m['type'];
												unset($m['name']);
												unset($m['type']);
												// $value = str_replace('"', '\'', json_encode($m,JSON_UNESCAPED_UNICODE));
												$value = json_encode($m, JSON_UNESCAPED_UNICODE);
												?>
										<div class="menu" data-name="<?=$name?>" data-response_type="<?=$type?>" data-value='<?=$value?>'>
											<div class="menu_name"><?=$name?></div>
											<ul class="submenu_list display-none">
												<li class="create_submenu_btn">+</li>
											</ul>
										</div>
										<?php }else{?>
										<div class="menu" data-name="<?=$m['name']?>" data-response_type="view" data-value="">
											<div class="menu_name"><?=$m['name']?></div>
											<ul class="submenu_list display-none">
												<?php foreach ($m['sub_button'] as $mm){?>
												<?php
													$name = $mm['name'];
													$type = $mm['type'];
													unset($mm['name']);
													unset($mm['type']);
													// $value = str_replace('"', '\'', json_encode($mm,JSON_UNESCAPED_UNICODE));
													$value = json_encode($mm, JSON_UNESCAPED_UNICODE);
													?>
												<li class="submenu active" data-name="<?=$name?>" data-response_type="<?=$type?>" data-value='<?=$value?>'><?=$name?></li>
												<?php }?>
												<li class="create_submenu_btn">+</li>
											</ul>
										</div>
										<?php }?>
										<?php }?>
										<div class="menu isempty">
											<span class="plus">+</span>
											添加菜单
										</div>
									</div>
								</div>
							</div>
							<div class="wechat_panel">
								<div class="wechat_panel_head display-none">
									<div class="wechat_panel_title">菜单名称</div>
									<div class="wechat_panel_remove">删除菜单</div>
								</div>
								<div class="wechat_panel_body display-none">
									<div class="text-helper wechat_panel_notice">已添加子菜单，仅可设置菜单名称。</div>
									<div class="form-group">
										<div class="col-md-7">
											<label class="col-md-2">菜单名称</label>
											<input type="text" class="input_text col-md-6" name="name" autocomplete="off">
											<div class="col-offset-2 text-helper" style="margin-left: 21%;">字数不超过8个汉字或16个字母</div>
										</div>
									</div>
									<div class="form-group" id="response_type">
										<div class="col-md-7">
											<label class="col-md-2">菜单内容</label>
											<label>
												<input type="radio" name="response_type" value="view" checked="checked">
												跳转网页
											</label>
											<label>
												<input type="radio" name="response_type" value="miniprogram">
												弹出小程序
											</label>
										</div>
									</div>
									<div class="form-group" id="response_value">
										<div id="view">
											<div class="col-md-7">
												<label class="col-md-2">跳转网址</label>
												<input type="text" name="url" class="input_text col-md-6" autocomplete="off">
												<div class="col-offset-2 text-helper" style="margin-left: 21%;">网址必须以http(s)://开头</div>
											</div>
										</div>
										<div id="miniprogram" class="display-none">
											<div class="col-md-7">
												<label class="col-md-2">链接</label>
												<input type="text" name="url" class="input_text col-md-6" autocomplete="off">
												<div class="col-offset-2 text-helper" style="margin-left: 21%;">网址必须以http(s)://开头</div>
											</div>
											<div class="col-md-7">
												<label class="col-md-2">APPID</label>
												<input type="text" name="appid" class="input_text col-md-6" autocomplete="off">
												<div class="col-offset-2 text-helper" style="margin-left: 21%;">小程序的APPID</div>
											</div>
											<div class="col-md-7">
												<label class="col-md-2">路径</label>
												<input type="text" name="pagepath" class="input_text col-md-6" autocomplete="off">
												<div class="col-offset-2 text-helper" style="margin-left: 21%;">小程序的页面路径</div>
											</div>
										</div>
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
	{include file='common/footer' /}
	<!-- 通用js -->
	<script type="text/javascript" src="<?=assets::common('jquery.min.js','js')?>"></script>
	<!-- 全局js调用 -->
	<script type="text/javascript" src="<?=assets::js('global.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('spop.min.js')?>"></script>
	<!-- 当前页面使用插件的js -->
	<script type="text/javascript" src="<?=assets::js('button.loading.js')?>"></script>
	<script>
$.ajaxSetup({
	headers: {
        '__token__': '<?=Request::token('__token__')?>' ,
    },
});
</script>
	<!-- 当前页面独有的js -->
	<script type="text/template" id="template">
<div class="menu" data-name="菜单名称" data-response_type="view" data-value="">
	<div class="menu_name">菜单名称</div>
	<ul class="submenu_list">
		<li class="create_submenu_btn">+</li>
	</ul>
</div>
</script>
	<script>
$(function(){
	
	$('#form').on('submit',function(){
		var obj = {
				button:[]
		};
		try{
			$('.wechat .menus .menu').not('.isempty').each(function(index,value){
				if($(value).find('.submenu_list .submenu').length==0)
				{
					var item = {
						type:$(value).data('response_type'),
	 					name:$(value).data('name'),
	 				};
					value = $(value).data('value');
					var new_obj = Object.assign(item, value);
					obj.button.push(new_obj);
				}
				else
				{
					var menu = {
						name:$(value).data('name'),
						sub_button:[]
					};
					$(value).find('.submenu_list .submenu').each(function(k,v){
						var item = {
							type:$(v).data('response_type'),
							name:$(v).data('name'),
						};
						value = $(v).data('value');
						var new_obj = Object.assign(item, value);
						//obj.button.push(new_obj);
						menu.sub_button.push(new_obj);
					});
					obj.button.push(menu);
				}
			});
			form = $(this);
			form.find('.button-submit').loading('start');
			$.post($(this).attr('action'),{menu:JSON.stringify(obj)},function(response){
				form.find('.button-submit').loading('stop');
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
		catch(error)
		{
			spop({
			    template: '系统错误',
			    style: 'error',
			    autoclose: 3000,
			    position:'bottom-right',
			    icon:true,
			    group:false,
			});
		}
		return false;
	});
	
	//实时更改菜单名称
	$('.wechat_panel input[name=name]').on('keyup',function(){
		var val = $.trim($(this).val());
		$('.wechat_panel .wechat_panel_title').html(val);
		if($('.wechat .menu.active').length == 1)
		{
			//当前选择的是主菜单栏
			$('.wechat .menu.active').data('name',val);
			$('.wechat .menu.active .menu_name').text(val);
		}
		else if($('.wechat .submenu.active').length == 1)
		{
			//当前选择的是子菜单
			$('.wechat .submenu.active').data('name',val);
			$('.wechat .submenu.active').text(val);
		}
	});
	
	//实时更改菜单值
	$('.wechat_panel #response_type input').on('change',function(){
		var response_type_val = $('#response_type input[name=response_type]:checked').val();

		$('.wechat_panel #response_value').children().addClass('display-none');
		$('.wechat_panel #response_value #'+response_type_val).removeClass('display-none');
		
		var obj = {};
		$('.wechat_panel #response_value #'+response_type_val+' input').each(function(){
			obj[$(this).attr('name')] = $.trim($(this).val());
		});

		if($('.wechat .menu.active').length == 1)
		{
			//当前选择的是主菜单栏
			$('.wechat .menu.active').data('value',obj);
			//同时更改选项类型
			$('.wechat .menu.active').data('response_type',response_type_val);
		}
		else if($('.wechat .submenu.active').length == 1)
		{
			//当前选择的是子菜单
			$('.wechat .submenu.active').data('value',obj);
			//同时更改选项类型
			$('.wechat .submenu.active').data('response_type',response_type_val);
		}
	});
	
	$('.wechat_panel #response_value input').on('keyup',function(){
		var response_type_val = $('#response_type input[name=response_type]:checked').val();
		var obj = {};
		$('.wechat_panel #response_value #'+response_type_val+' input').each(function(){
			obj[$(this).attr('name')] = $.trim($(this).val());
		});

		if($('.wechat .menu.active').length == 1)
		{
			//当前选择的是主菜单栏
			$('.wechat .menu.active').data('value',obj);
		}
		else if($('.wechat .submenu.active').length == 1)
		{
			//当前选择的是子菜单
			$('.wechat .submenu.active').data('value',obj);
		}
	});
	
	var setVal = function(name,response_type,value){
		$('.wechat_panel .wechat_panel_title').html(name);
		$('.wechat_panel input[name=name]').val(name);
		$('.wechat_panel #response_type input[name=response_type]').prop('checked',false);
		$('.wechat_panel #response_type input[name=response_type][value='+response_type+']').prop('checked',true);
		$('.wechat_panel #response_value').children().addClass('display-none');
		$('.wechat_panel #response_value #'+response_type).removeClass('display-none');

		if(value.length==0)
		{
			$('.wechat_panel #response_value input[type=text]').val('');
		}
		else
		{
			$.each(value,function(key,val){
				$('.wechat_panel #response_value input[name='+key+']').val(val);
			});
		}
	}
	
	$('.wechat').on('click','.menu',function(){
		$('.wechat .menu').removeClass('active');
		$('.wechat .submenu').removeClass('active');
		$('.wechat_panel_head').removeClass('display-none');
		$('.wechat_panel_body').removeClass('display-none');
		$(this).addClass('active');
	
		$('.wechat .menu .submenu_list').addClass('display-none');
		$(this).find('.submenu_list').removeClass('display-none');
		
		if($(this).hasClass('isempty'))
		{
			if($('.menus .menu').not('.isempty').length<3)
			{
				var template = $($('#template').html());
				template.insertBefore($(this));
				template.trigger('click');
				if($('.menus .menu').not('.isempty').length==3)
				{
					$('.menus .isempty').addClass('display-none');
				}
			}
		}
		else
		{
			var name = $(this).data('name');
			var response_type = $(this).data('response_type');
			var value = $(this).data('value');
			setVal(name,response_type,value);
			if($(this).find('.submenu_list .submenu').length==0)
			{
				$('.wechat_panel .wechat_panel_notice').addClass('display-none');
				$('#response_type,#response_value').removeClass('display-none');
			}
			else
			{
				$('.wechat_panel .wechat_panel_notice').removeClass('display-none');
				$('#response_type,#response_value').addClass('display-none');
			}
		}
		return false;
	}).on('click','.submenu',function(){
		$('.wechat .menu').removeClass('active');
		$('.wechat .submenu').removeClass('active');
		$('.wechat_panel_head').removeClass('display-none');
		$('.wechat_panel_body').removeClass('display-none');
		$(this).addClass('active');
		var name = $(this).data('name');
		var response_type = $(this).data('response_type');
		var value = $(this).data('value');
		setVal(name,response_type,value);
		$('.wechat_panel .wechat_panel_notice').addClass('display-none');
		$('#response_type,#response_value').removeClass('display-none');
		return false;
	}).on('click','.create_submenu_btn',function(){
		if($(this).parent().find('.submenu').length<5)
		{
			var submenu = $('<li class="submenu" data-name="菜单名称" data-response_type="view" data-value="">菜单名称</li>');
			submenu.insertBefore($(this)).trigger('click');
			if($(this).parent().find('.submenu').length == 5)
			{
				$(this).addClass('display-none');
			}
		}
		return false;
	});
	
	//如果主菜单已经有3个了那么隐藏添加主菜单按钮
	var num = 0;
	$('.wechat .menus .menu').each(function(index,value){
		if(!$(this).hasClass('isempty'))
		{
			num++;
		}
	});
	if(num>=3)
	{
		$('.wechat .menus .menu.isempty').addClass('display-none');
	}
	
	//删除菜单
	$('.wechat_panel_remove').on('click',function(){
		//删除的是主菜单
		if($('.wechat .menu.active').length==1)
		{
			if($('.wechat .menu.active .submenu').length>0)
			{
				spop({
				    template: '请先删除子菜单',
				    style: 'error',
				    autoclose: 3000,
				    position:'bottom-right',
				    icon:true,
				    group:false,
				});
			}
			else
			{
				$('.wechat .menu.active').remove();
				//删除了主菜单后显示添加主菜单按钮
				$('.wechat .menus .menu.isempty').removeClass('display-none');
			}
		}
		else if($('.submenu.active').length==1)
		{
			$('.submenu.active').remove();
		}
	});
});
</script>
</body>
</html>