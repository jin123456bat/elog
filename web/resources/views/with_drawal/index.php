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
<link rel="stylesheet" href="<?=assets::css('datatables.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('form.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('button.loading.css')?>" type="text/css" media="all" />
<style>
.search-line {
	display: inline-block;
}

.label-change {
	font-size: 17px;
	margin: 8px;
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
							<p>申请提现用户列表</p>
						</div>
					</div>
					<div class="line search-line">
						<form id="search" class="col-md-5 pull-right" style="display: inline-block;">
							<button class="button pull-right primary">搜索</button>
							<input type="text" placeholder="用户名/真实姓名/邮箱/手机号码" class="input_text pull-right col-md-3">
						</form>
					</div>
					<div class="tablebox">
						<table id="table" class="table" data-ajax-url="<?=url('index')?>">
							<thead>
								<tr>
									<th>
										<input type="checkbox" class="all_checked">
									</th>
									<th>订单号</th>
									<th>头像</th>
									<th>昵称</th>
									<th>用户名</th>
									<th>邮箱</th>
									<th>手机号码</th>
									<th>证件名称</th>
									<th>证件号码</th>
									<th>提现申请时间</th>
									<th>会员组</th>
									<th>公众号关注</th>
									<th>剩余佣金</th>
									<th>累计提现</th>
									<th>申请提现</th>
									<th>状态</th>
									<th>备注</th>
									<th width="300px">操作</th>
								</tr>
							</thead>
							<tbody></tbody>
							<tfoot>
								<tr>
									<td id="split_page" colspan="20"></td>
								</tr>
							</tfoot>
						</table>
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
	<script type="text/javascript" src="<?=assets::common('jquery.dialog.js','js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('button.loading.js')?>"></script>
	<script>
	$.ajaxSetup({
		headers: {
			'__token__': '<?=Request::token('__token__')?>' ,
		} ,
	});
</script>
	<script type="text/javascript">
	$('.all_checked').on('click',function(){
		$(this).parents('table').find('tbody input[type=checkbox]').prop('checked',$(this).is(':checked'));
	});

	var table = datatables({
		table:$('#table'),
		ajax:{
			data:{
			},
			method:'post',
		},
		columns:[{
			data:'orderno',
			pk:true,
			render:function(data,full){
				return '<input type="checkbox" name="orderno[]" value="'+data+'">';
			}
		},{
			data:'orderno',
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
		},{
			data:'username',
			render:function(data,full){
				if(data==null)
				{
					return '';
				}
				return data;
			}
		},{
			data:'email',
		},{
			data:'telephone',
			render:function(data,full){
				if(data==null)
				{
					return '';
				}
				return data;
			}
		},{
			data:'card_name',
			render:function(data,full){
				if(data==null)
				{
					return '';
				}
				return data;
			}
		},{
			data:'card_no',
			render:function(data,full){
				if(data==null)
				{
					return '';
				}
				return data;
			}
		},{
			data:'applytime',
		},{
			data:'group_name',
		},{
			data:'subscribe',
			render:function(data,full){
				if(data==0)
				{
					return '未关注';
				}
				else if(data==1)
				{
					return '已关注';
				}
				else if(data==2)
				{
					return '已取关';
				}
			}
		},{
			data:'commission',
			render:function(data,full){
				return parseFloat(data/100).toFixed(2);
			}
		},{
			data:'withdrawal_money',
			render:function(data,full){
				return parseFloat(data/100).toFixed(2);
			}
		},{
			data:'price',
			render:function(data,full){
				content = '<font style="color:blue">'+parseFloat(data/100).toFixed(2)+'</font>'
				return content;
			}
		},{
			data:'type',
			render:function(data,full){
				switch(data)
				{
					case 0:return '申请中';
					case 1:return '已通过';
					case 2:return '已拒绝';
				}
				return '异常状态';
			}
		},{
			data:'withdrawal_order.remark',
			name:'remark',
		},{
			data:'orderno',
			render:function(data,full){
				content = '';
				<?php if (companyController::checkButtonPrivilege('withdrawal_agree')){?>
				if(full.type==0)
				{
					content += '<a class="button button-xs agree" title="withdrawal_agree" data-orderno="'+data+'">同意</a>';
				}
				<?php }?>
				<?php if (companyController::checkButtonPrivilege('withdrawal_refund')){?>
				if(full.type==0)
				{
					content += '<a class="button button-xs refund" title="withdrawal_refund" data-orderno="'+data+'">拒绝</a>';
				}
				<?php }?>
				return content;
			}
		}],
		sort:{
			applytime:'desc',
		},
		pagesize:10,
		onRowLoaded:function(row){

		}
	});

	$('#search').on('submit',function(){
		table.search($(this).find('input').val());
		return false;
	});

	
	$('table').on('click','.agree',function(){
		var orderno =  $(this).data('orderno');
		var btn = $(this);
		var tr = $(this).parents('tr');
		$.select({
			title:'提现渠道',
			options:[
			<?php if (helper::getHotelsNum(companyHelper::getCompanyId())>1){?>
			{
				key:'hotel_id',
				name:'酒店',
				option:[
					<?php foreach ($hotels as $hotel){?>
					{key:'<?=$hotel['id']?>',value:'<?=$hotel['name']?>'},
					<?php }?>
				]
			},
			<?php }?>
			{
				key:'paymethod',
				name:'支付方式',
				option:[{
					key:'wechat_red_package',
					value:'微信红包',
				}]
			}],
			
			success:function(e,val){
				val.orderno = orderno;
				btn.loading('start');
				$.post('<?=url('agree')?>',val,function(response){
					btn.loading('stop');
		 			if(response.code==1)
		 			{
		 				tr.trigger('flush.datatables');
		 			}
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
		});
	});
	
	$('table').on('click','.refund',function(){
		var tr = $(this).parents('tr');
		var orderno = $(this).data('orderno');
		var btn = $(this);
		$.reply({
			title:'拒绝提现请求',
			content:'请输入拒绝理由',
			success:function (e,replay) {
				btn.loading('start');
				$.post('<?=url('refund')?>',{orderno:orderno,remark:replay},function(response){
					btn.loading('stop');
					if(response.code==1)
					{
						tr.trigger('flush.datatables');
					}
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
		});
	});
</script>
</body>
</html>