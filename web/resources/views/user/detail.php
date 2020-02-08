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
<link rel="stylesheet" href="<?=assets::css('tab.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('datatables.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('jquery.modal.css')?>" type="text/css" media="all" />
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
							<a class="tab-title active" href="#base">基础信息</a>
							<a class="tab-title" href="#company">集团信息</a>
							<a class="tab-title" href="#money">余额日志</a>
							<a class="tab-title" href="#comission">佣金日志</a>
						</div>
						<div class="tab-body">
							<div class="tab-page active" id="base">
								<form class="form">
									<div class="panel col-md-5 center-block">
										<div class="panel-head">
											<div class="panel-title">基础信息</div>
										</div>
										<div class="panel-body">
											<div class="form-group col-md-10">
												<label class="label col-md-2">头像</label>
												<div class="col-md-7">
													<img class="image circle border center-block" style="width: 100px; height: 100px;" src="<?=$user['gravatar_img']?>">
												</div>
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">用户名</label>
												<input type="text" class="input_text col-md-7" value="<?=$user['username']?>" readonly>
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">昵称</label>
												<input type="text" class="input_text col-md-7" value="<?=$user['nickname']?>" readonly>
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">手机号码</label>
												<input type="text" class="input_text col-md-7" readonly value="<?=$user['telephone']?>">
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">邮箱</label>
												<input type="text" class="input_text col-md-7" readonly value="<?=$user['email']?>">
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">性别</label>
												<input type="text" class="input_text col-md-7" readonly value="<?=!empty($user['sex'])?($user['sex']==1?'男':'女'):''?>">
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">省份</label>
												<select disabled="disabled" data-url="<?=url('platform/dictionary/province')?>" data-default="<?=$user['province_id']?>" name="province" class="select col-md-7"></select>
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">城市</label>
												<select disabled="disabled" data-url="<?=url('platform/dictionary/city')?>" data-default="<?=$user['city_id']?>" name="city" class="select col-md-7"></select>
												
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">地区</label>
												<select disabled="disabled" data-url="<?=url('platform/dictionary/zone')?>" data-default="<?=$user['zone_id']?>" name="zone" class="select col-md-7"></select>
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">国家</label>
												<input type="text" class="input_text col-md-7" readonly value="<?=$user['country']?>">
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">语言</label>
												<input type="text" class="input_text col-md-7" readonly value="<?=$user['language']?>">
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">证件类型</label>
												<select class="select col-md-7" disabled="disabled">
												<option value="">请选择证件类型</option>
												<?php foreach ($certificates as $cert){?>
												<option value="<?=$cert['id']?>"><?=$cert['name']?></option>
												<?php }?>
												</select>
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">证件名称</label>
												<input type="text" class="input_text col-md-7" readonly value="<?=$user['card_name']?>">
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">证件号码</label>
												<input type="text" class="input_text col-md-7" readonly value="<?=$user['card_no']?>">
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">生日</label>
												<input type="text" class="input_text col-md-7" readonly value="<?=$user['birthday']?>">
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">食物喜好</label>
												<input type="text" class="input_text col-md-7" readonly value="<?=$user['food_like']?>">
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">客房喜好</label>
												<input type="text" class="input_text col-md-7" readonly value="<?=$user['room_like']?>">
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">备注</label>
												<textarea class="textarea col-md-7" readonly><?=$user['remark']?></textarea>
											</div>
										</div>
									</div>
								</form>
							</div>
							<div class="tab-page" id="company">
								<form class="form" id="companyForm" action="<?=url()?>">
									<div class="panel col-md-5 center-block">
										<div class="panel-head">
											<div class="panel-title">集团信息</div>
										</div>
										<div class="panel-body">
											<div class="form-group col-md-10">
												<label class="label col-md-2">注册时间</label>
												<input type="text" class="input_text col-md-7" readonly value="<?=$user_company['createtime']?>">
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">登陆时间</label>
												<input type="text" class="input_text col-md-7" readonly value="<?=$user_company['logintime']?>">
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">关注公众号</label>
												<select class="select col-md-7" disabled="disabled">
													<option value="0" <?=$user_company_mp['subscribe']==0?'selected="selected"':''?>>未关注</option>
													<option value="1" <?=$user_company_mp['subscribe']==1?'selected="selected"':''?>>已关注</option>
													<option value="2" <?=$user_company_mp['subscribe']==2?'selected="selected"':''?>>已取关</option>
												</select>
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">关注方式</label>
												<select class="select col-md-7" disabled="disabled">
													<option value="ADD_SCENE_OTHERS" <?=$user_company_mp['subscribe_scene'] == 'ADD_SCENE_OTHERS'?'selected="selected"':''?>>其他</option>
													<option value="ADD_SCENE_SEARCH" <?=$user_company_mp['subscribe_scene'] == 'ADD_SCENE_SEARCH'?'selected="selected"':''?>>公众号搜索</option>
													<option value="ADD_SCENE_ACCOUNT_MIGRATION" <?=$user_company_mp['subscribe_scene'] == 'ADD_SCENE_ACCOUNT_MIGRATION'?'selected="selected"':''?>>公众号迁移</option>
													<option value="ADD_SCENE_PROFILE_CARD" <?=$user_company_mp['subscribe_scene'] == 'ADD_SCENE_PROFILE_CARD'?'selected="selected"':''?>>名片分享</option>
													<option value="ADD_SCENE_QR_CODE" <?=$user_company_mp['subscribe_scene'] == 'ADD_SCENE_QR_CODE'?'selected="selected"':''?>>扫描二维码</option>
													<option value="ADD_SCENEPROFILE" <?=$user_company_mp['subscribe_scene'] == 'ADD_SCENEPROFILE'?'selected="selected"':''?>>LINK图文页内点击</option>
													<option value="ADD_SCENE_PROFILE_ITEM" <?=$user_company_mp['subscribe_scene'] == 'ADD_SCENE_PROFILE_ITEM'?'selected="selected"':''?>>图文页右上角菜单</option>
													<option value="ADD_SCENE_PAID" <?=$user_company_mp['subscribe_scene'] == 'ADD_SCENE_PAID'?'selected="selected"':''?>>支付后关注</option>
												</select>
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">关注时间</label>
												<input type="text" class="input_text col-md-7" readonly value="<?=$user_company_mp['subscribe_time']?>">
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">公众号备注</label>
												<input name="remark" type="text" class="input_text col-md-7" readonly value="<?=$user_company_mp['remark']?>">
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">来源酒店 </label>
												<select class="select col-md-7" disabled="disabled">
												<option>无来源酒店</option>
												<?php foreach ($hotels as $hotel){?>
												<option value="<?=$hotel['id']?>" <?=$user_company['first_hotel_id']==$hotel['id']?'selected="selected"':''?>><?=$hotel['name']?></option>
												<?php }?>
												</select>
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">所属会员组</label>
												<select class="select col-md-7" name="group_id">
												<option value="">无会员组</option>
												<?php foreach ($groups as $group){?>
												<option value="<?=$group['id']?>" <?=$user_company['group_id']==$group['id']?'selected="selected"':''?>><?=$group['name']?></option>
												<?php }?>
												</select>
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">剩余积分</label>
												<input type="text" class="input_text col-md-7" readonly value="<?=$user_company['score']?>">
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">账户余额</label>
												<input type="text" class="input_text col-md-7" readonly value="<?=sprintf('%.2f',$user_company['money']/100)?>">
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">剩余佣金</label>
												<input type="text" class="input_text col-md-7" readonly value="<?=sprintf('%.2f',$user_company['commission']/100)?>">
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">上一级分销用户</label>
												<?php if (!empty($user_company['s1_user'])){?>
												<div class="user col-md-7" style="width: 50px;">
													<img class="image circle" src="<?=helper::getImageUrl($user_company['s1_user']['gravatar']??'','50x50')?>">
													<div class="name" style="text-align:center;"><?=$user_company['s1_user']['nickname']??''?></div>
												</div>
												<?php }else{?>
												<div class="col-md-7 text-helper">
												<button class="button button-xs s_user">选择用户</button>
												</div>
												<?php }?>
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">上二级分销用户</label>
												<?php if (!empty($user_company['s2_user'])){?>
												<div class="user col-md-7" style="width: 50px;">
													<img class="image circle" src="<?=helper::getImageUrl($user_company['s2_user']['gravatar']??'','50x50')?>">
													<div class="name" style="text-align:center;"><?=$user_company['s2_user']['nickname']??''?></div>
												</div>
												<?php }else{?>
												<div class="col-md-7 text-helper">无</div>
												<?php }?>
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">上三级分销用户</label>
												<?php if (!empty($user_company['s3_user'])){?>
												<div class="user col-md-7" style="width: 50px;">
													<img class="image circle" src="<?=helper::getImageUrl($user_company['s3_user']['gravatar']??'','50x50')?>">
													<div class="name" style="text-align:center;"><?=$user_company['s3_user']['nickname']??''?></div>
												</div>
												<?php }else{?>
												<div class="col-md-7 text-helper">无</div>
												<?php }?>
											</div>
											<div class="form-submit">
												<div class="center-block submit-body">
													<button type="submit" class="button button-submit button-large">保存</button>
													<button type="reset" class="button button-cancel button-large">重置</button>
												</div>
											</div>
						
										</div>
									</div>
								</form>
							</div>
							<div class="tab-page" id="money">
								<div class="line pull-right">
									<form id="moneySearch" class="col-md-2" style="display: inline-block;">
										<button class="button pull-right primary col-md-2">搜索</button>
										<input type="text" placeholder="订单号/备注" class="input_text col-md-7">
									</form>
								</div>
								<div class="tablebox">
								<table id="moneyTable" class="table"
									data-ajax-url="<?=url('user/money_log')?>">
									<thead>
										<tr>
											<th>时间</th>
											<th>金额</th>
											<th>订单类型</th>
											<th>订单号</th>
											<th>IP</th>
											<th>UA</th>
											<th>备注</th>
										</tr>
									</thead>
									<tbody></tbody>
									<tfoot>
										<tr>
											<td colspan="4"></td>
											<td id="split_page" colspan="20"></td>
										</tr>
									</tfoot>
								</table>
			                    </div>
								
							</div>
							<div class="tab-page" id="comission">
							
								<div class="line pull-right">
									<form id="commissionSearch" class="col-md-2" style="display: inline-block;">
										<button class="button pull-right primary col-md-2">搜索</button>
										<input type="text" placeholder="订单号/备注" class="input_text col-md-7">
									</form>
								</div>
								<div class="tablebox">
									<table id="commissionTable" class="table"
										data-ajax-url="<?=url('user/commission_log')?>">
										<thead>
											<tr>
												<th>时间</th>
												<th>类型</th>
												<th>金额</th>
												<th>订单类型</th>
												<th>订单号</th>
												<th>IP</th>
												<th>UA</th>
												<th>备注</th>
											</tr>
										</thead>
										<tbody></tbody>
										<tfoot>
											<tr>
												<td colspan="4"></td>
												<td id="split_page" colspan="20"></td>
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
	</div>
	{include file='common/footer' /}
	<div id="userModal" class="modal-bg display-none">
		<div class="modal-container">
			<div class="modal-header">
				<div class="modal-title">
					设置分销人员
					<button class="close">x</button>
				</div>
			</div>
			<div class="modal-body">
				<div class="line">
					<form id="search" class="form">
						<input type="text" name="keywords" class="input_text col-md-4" placeholder="用户名/昵称/真实姓名/邮箱/手机号码">
						<input type="submit" class="button button-primary">
					</form>
				</div>
				<table id="userTable" class="table" data-ajax-url="<?=url('user/index')?>">
					<thead>
						<tr>
							<th>
								<input type="checkbox" class="all_checked">
							</th>
							<th>头像</th>
							<th>昵称</th>
							<th>用户名</th>
							<th>邮箱</th>
							<th>手机号码</th>
							<th>性别</th>
							<th>会员组</th>
							<th width="300px">操作</th>
						</tr>
					</thead>
					<tbody></tbody>
					<tfoot>
						<tr>
							<td colspan="4"></td>
							<td id="split_page" colspan="20"></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
	<!-- 通用js -->
	<script type="text/javascript" src="<?=assets::common('jquery.min.js','js')?>"></script>
	<!-- 全局js调用 -->
	<script type="text/javascript" src="<?=assets::js('global.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('spop.min.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('tab.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('datatables.js')?>"></script>
	<!-- 当前页面使用插件的js -->
	<script type="text/javascript" src="<?=assets::js('button.loading.js')?>"></script>
	<script type="text/javascript" src="<?=assets::common('jquery.validate.min.js','js')?>"></script>
	<script type="text/javascript" src="<?=assets::common('messages_zh.min.js','js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('jquery.modal.js')?>"></script>
	<script>
	$.ajaxSetup({
		headers: {
	        '__token__': '<?=Request::token('__token__')?>' ,
	    },
	});
	</script>
	<script type="text/html" id="user">
	<div class="user col-md-7" style="width: 50px;">
		<img class="image circle" src="[gravatar]">
		<div class="name" style="text-align:center;">[nickname]</div>
	</div>
	</script>
	<script type="text/javascript">
	$(function(){
		tab.init();
		
		$('.s_user').on('click',function(){
			$('#userModal').modal('show');
			return false;
		});
		
		//选择用户table
		var table_user = datatables({
			table:$('#userTable'),
			ajax:{
				data:{
				},
				method:'post'
			},
			columns:[{
				data:'id',
				render:function (data,full) {
					return '<input type="checkbox" name="id[]" value="'+data+'">';
				},
			},{
				data:'gravatar',
				render:function(data,full){
					if(data!=null)
					{
						return '<img class="image circle" src="'+data+'" onerror="this.src=\'<?=assets::common('default_gravatar.png', 'image')?>\';">';
					}
					return '';
				}
			},{
				data:'nickname',
				render:function (data,full) {
					if(data==null){
						return '';
					}
					return data;
				}
			},{
				data:'username',
				render:function (data,full) {
					if(data==null){
						return '';
					}
					return data;
				}
			},{
				data:'email',
			},{
				data:'telephone',
				render:function (data,full) {
					if(data==null){
						return '';
					}
					return data;
				}
			},{
				data:'sex',
				render:function (data,full) {
					if(data==1)
					{
						return '男';
					}
					else if(data==2)
					{
						return '女';
					}
					else
					{
						return '未知';
					}
				}
			},{
				data:'group_name'
			},{
				data:'id',
				render:function (data,full) {
					return '<a class="button button-xs click-select" title="" data-gravatar="'+full.gravatar+'" data-nickname="'+full.nickname+'"+ data-user_id="'+full.id+'">点击选取</a>'
				}
			}],
			sort:{
			},
			pagesize:10,
		});

		$('#search').on('submit',function(){
			//添加固定筛选项目
			table_user.addAjaxParameter('keywords',$(this).find('input[name=keywords]').val());
			//设置页码
			table_user.page(1);
			//重新载入
			table_user.reload();
			return false;
		});
	
		$('#userTable').on('click','.click-select',function(){
			var reg = new RegExp("\\[([^\\[\\]]*?)\\]", 'igm');
			var data = {
				gravatar:$(this).data('gravatar'),
				nickname:$(this).data('nickname'),
				user_id:$(this).data('user_id'),
			}

			$.post('<?=url('user/set_comission_user')?>',{user_id:'<?=Request::get('id')?>',s1_user:data.user_id},function(response){
				if(response.code==1)
				{
					var tpl = $($('#user').html().replace(reg,function(node,key){
						return data[key];
					}));
					tpl.insertAfter($('.s_user').parent());
					$('.s_user').parent().remove();
					$('#userModal').modal('hide');
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
		
		$('#companyForm').on('submit',function(){
			var data = {
				table:'user_company',
				user_id:'<?=Request::get('id')?>',
				group_id:$(this).find('select[name=group_id]').val(),
				remark:$.trim($(this).find('input[name=remark]').val()),
			};
			$('#companyForm').find('.button-submit').loading('start');
			$.post($(this).attr('action'),data,function(response){
				$('#companyForm').find('.button-submit').loading('stop');
				spop({
				    template: response.message,
				    style: response.code==1?'success':'error',
				    autoclose: 3000,
				    position:'bottom-right',
				    icon:true,
				    group:false,
				});
			})
			return false;
		});

		
		var getUrl = function(url){
			var timestamp = Date.parse(new Date())/1000;
			var device = 'company';
			return url+'?timestamp='+timestamp+'&device='+device;
		}

		var zone_select = $('select[name=zone]');
		var city_select = $('select[name=city]').on('change',function(){
			$.get(getUrl(zone_select.data('url')),{id:$(this).val()},function(response){
				zone_select.empty();
				if(response.code==1)
				{
					$.each(response.data,function(index,value){
						if(zone_select.data('default') == value.id)
						{
							zone_select.append('<option selected="selected" value="'+value.id+'">'+value.name+'</option>');
						}
						else
						{
							zone_select.append('<option value="'+value.id+'">'+value.name+'</option>');
						}
					});
					zone_select.trigger('change');
				}
			});
		});
		var province_select = $('select[name=province]').on('change',function(){
			$.get(getUrl(city_select.data('url')),{id:$(this).val()},function(response){
				city_select.empty();
				if(response.code==1)
				{
					$.each(response.data,function(index,value){
						if(city_select.data('default') == value.id)
						{
							city_select.append('<option selected="selected" value="'+value.id+'">'+value.name+'</option>');
						}
						else
						{
							city_select.append('<option value="'+value.id+'">'+value.name+'</option>');
						}
					});
					city_select.trigger('change');
				}
			});
		});

		$.get(getUrl(province_select.data('url')),function(response){
			province_select.empty();
			if(response.code==1)
			{
				$.each(response.data,function(index,value){
					if(province_select.data('default') == value.id)
					{
						province_select.append('<option selected="selected" value="'+value.id+'">'+value.name+'</option>');
					}
					else
					{
						province_select.append('<option value="'+value.id+'">'+value.name+'</option>');
					}
					
				});
				province_select.trigger('change');
			}
		});



		var money = datatables({
			table:$('#moneyTable'),
			ajax:{
				data:{
					user_id:"<?=Request::get('id')?>",
				},
				method:'post',
			},
			columns:[{
				data:'time',
			},{
				data:'type',
			},{
				data:'money',
			},{
				data:'order_type',
			},{
				data:'orderno',
			},{
				data:'ip',
			},{
				data:'ua',
			},{
				data:'remark',
			}],
			columnDefs:[{
				targets:1,
				render:function(data,full){
					return data==1?'支出':'收入';
				}
			},{
				targets:2,
				render:function(data,full){
					return parseFloat(data/100).toFixed(2);
				}
			},{
				targets:3,
				render:function(data,full){
					//1餐饮订单，2住房订单，3商城订单，4服务订单,5赠送，6充值
					switch(data)
					{
						case 1:return '餐饮订单';
						case 2:return '住房订单';
						case 3:return '商城订单';
						case 4:return '服务订单';
						case 5:return '赠送';
						case 6:return '充值';
					}
					return '未知';
				}
			}],
			sort:{
				time:'desc',
			},
			pagesize:10,
			onRowLoaded:function(row){
				
			}
		});

		$('#moneySearch').on('submit',function(){
			var value = $.trim($(this).find('input').val());
			if(value.length>0)
			{
				money.search();
			}
			return false;
		});


		var commission = datatables({
			table:$('#commissionTable'),
			ajax:{
				data:{
					user_id:"<?=Request::get('id')?>",
				},
				method:'post',
			},
			columns:[{
				data:'createtime',
			},{
				data:'type',
			},{
				data:'money',
			},{
				data:'order_type',
			},{
				data:'orderno',
			},{
				data:'ip',
			},{
				data:'ua',
			},{
				data:'remark',
			}],
			columnDefs:[{
				targets:1,
				render:function(data,full){
					return data==1?'收入':'支出';
				}
			},{
				targets:2,
				render:function(data,full){
					return parseFloat(data/100).toFixed(2);
				}
			},{
				targets:3,
				render:function(data,full){
					//1餐饮订单，2住房订单，3商城订单，4服务订单,5赠送，6充值
					switch(data)
					{
						case 'room':return '住房订单';
						case 'food':return '餐饮订单';
						case 'shop':return '商城订单';
						case 'service':return '服务订单';
						case 'drawal':return '提现订单';
					}
					return '未知';
				}
			}],
			sort:{
				createtime:'desc',
			},
			pagesize:10,
			onRowLoaded:function(row){
				
			}
		});

		$('#commissionSearch').on('submit',function(){
			var value = $.trim($(this).find('input').val());
			if(value.length>0)
			{
				commission.search();
			}
			return false;
		});
	});
</script>
</body>
</html>