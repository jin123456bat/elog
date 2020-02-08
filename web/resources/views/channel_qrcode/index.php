<?php
use jin123456bat\assets;
use think\facade\Request;
use jin123456bat\companyController;
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
<link rel="stylesheet" href="<?=assets::css('jquery.modal.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('datetimepicker.css')?>" type="text/css" media="all" />
</head>
<style>
.qrcode-outline {
	float: left;
	padding: 10px;
	min-height: 262px;
}

.qrcode {
	border: 1px solid #ccc;
	border-radius: 5px;
	transition: box-shadow .3s;
	background: #fff;
	width: 150px;
	box-sizing: content-box;
}

.qrcode-head {
	line-height: 30px;
	height: 30px;
	text-align: center;
	border-bottom: 1px solid #ccc;
	font-size: 13px;
}

.qrcode-foot {
	width: 100%;
	display: flex;
	justify-content: center;
	font-size: 13px;
	padding: 10px 20px;
	color: #666;
}
</style>
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
							<p>渠道二维码将使用永久二维码</p>
						</div>
					</div>
					<div class="line">
						<?php if (companyController::checkButtonPrivilege('create_channel_qrcode')){?>
						<a id="create_channel_qrcode" class="button button-outline-red button-small" title="create_channel_qrcode">添加渠道二维码</a>
						<?php }?>
					</div>
					<div class="col-md-10 qrcode-list">
						<?php foreach ($qrcode_list as $qrcode){?>
						<div class="qrcode-outline">
							<div class="qrcode">
								<div class="qrcode-head">
									<?=$qrcode['name']?>
								</div>
								<img src="<?=helper::getImageUrl(\app\common\model\Qrcode::get($qrcode['qrcode_id'])['file_id'],'150x150')?>">
								<div class="qrcode-foot">
									<button class="button primary button-xs statistic" data-id="<?=$qrcode['id']?>">统计</button>
									<button class="button button-red button-xs deleteBtn" data-id="<?=$qrcode['id']?>">删除</button>
								</div>
							</div>
						</div>
						<?php }?>
					</div>
				</div>
			</div>
		</div>
	</div>
	{include file='common/footer' /}
	<div id="createModal" class="modal-bg display-none">
		<div class="modal-container" style="top: 35%;">
			<div class="modal-header">
				<div class="modal-title">
					添加渠道二维码
					<button class="close">x</button>
				</div>
			</div>
			<form class="form" id="createQrcodeForm" action="<?=url('ChannelQrcode/create')?>" method="post">
				<div class="modal-body">
					<div class="form-group col-md-10">
						<label class="label col-md-2">渠道名称</label>
						<input type="text" class="input_text col-md-7" name="name" value="" placeholder="渠道名称">
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit">确定</button>
					<button type="button" class="close">取消</button>
				</div>
			</form>
		</div>
	</div>
	<div id="statisticModal" class="modal-bg display-none">
		<div class="modal-container" style="top: 35%;">
			<div class="modal-header">
				<div class="modal-title">
					扫码次数统计
					<button class="close">x</button>
				</div>
			</div>
			<div class="modal-body">
				<form class="form">
					<input type="hidden" name="id" value="">
					<div class="form-group col-md-5" style="width: 47%;">
						<label class="label col-md-3">开始时间</label>
						<input type="text" name="starttime" value="<?=date('Y-m-d',strtotime('-6 day'))?>" class="input_text col-md-7 datepicker">
					</div>
					<div class="form-group col-md-5" style="width: 47%;">
						<label class="label col-md-3">结束时间</label>
						<input type="text" name="endtime" value="<?=date('Y-m-d')?>" class="input_text col-md-7 datepicker">
					</div>
				</form>
				<div id="graph" style="width: 100%; height: 300px;"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="close">关闭</button>
			</div>
		</div>
	</div>
	<!-- 通用js -->
	<script type="text/javascript" src="<?=assets::common('jquery.min.js','js')?>"></script>
	<!-- 全局js调用 -->
	<script type="text/javascript" src="<?=assets::js('global.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('spop.min.js')?>"></script>
	<!-- 当前页面使用插件的js -->
	<script type="text/javascript" src="<?=assets::common('jquery.dialog.js','js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('button.loading.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('jquery.modal.js')?>"></script>
	<script type="text/javascript" src="<?=assets::common('jquery.validate.min.js','js')?>"></script>
	<script type="text/javascript" src="<?=assets::common('messages_zh.min.js','js')?>"></script>
	<script type="text/javascript" src="<?=assets::common('echarts.min.js', 'js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('datetimepicker.js')?>"></script>
	<script>
	$.ajaxSetup({
		headers: {
	        '__token__': '<?=Request::token('__token__')?>' ,
	    },
	});
</script>
	<script type="text/javascript">
$(function(){
	$('.datepicker').each(function(){
		$(this).datetimepicker({
			select:'date',
			max_date:'<?=date('Y-m-d')?>',
		});
	});
	
	$('#create_channel_qrcode').on('click',function(){
		$('#createModal').modal('show');
		return false;
	});

	var statistic = function(id,starttime,endtime){
		$.post('<?=url('ChannelQrcode/detail')?>',{id:id,starttime:starttime,endtime:endtime},function(response){
			$('#statisticModal').modal('show');
			var date = [];
			var value = [];
			$.each(response.data,function(k,v){
				date.push(k);
				value.push(v);
			});
			
			option = {
			    xAxis: {
			        type: 'category',
			        data: date
			    },
			    yAxis: {
			        type: 'value'
			    },
			    toolbox: {
					feature: {
						saveAsImage: {}
					}
				},
				grid: {
					left: '3%',
					right: '4%',
					bottom: '3%',
					top:'1%',
					containLabel: true
				},
			    tooltip : {
					trigger: 'axis',
					axisPointer: {
						type: 'line',
						label: {
							backgroundColor: '#6a7985',
							precision:0,
						},
						snap:true,
					}
				},
			    series: [{
			        data: value,
			        type: 'line',
			        smooth: true
			    }]
			};
			var echarts_div = echarts.init(document.getElementById('graph'));
			echarts_div.setOption(option);
		});
	}

	$('#statisticModal input[name=starttime],#statisticModal input[name=endtime]').on('change',function(){
		var starttime = $('#statisticModal input[name=starttime]').val();
		var endtime = $('#statisticModal input[name=endtime]').val();
		var id = $('#statisticModal input[name=id]').val();
		statistic(id,starttime,endtime);
	});

	$('.statistic').on('click',function(){
		var id = $(this).data('id');
		$('#statisticModal input[name=id]').val(id);
		var starttime = $('#statisticModal input[name=starttime]').val();
		var endtime = $('#statisticModal input[name=endtime]').val();
		statistic(id,starttime,endtime);
		return false;
	});

	$('.deleteBtn').on('click',function(){
		var id = $(this).data('id');
		$.confirm({
			title:'删除二维码',
			content:'您确定删除二维码?',
			success:function(){
				$.post('<?=url('ChannelQrcode/remove')?>',{id:id},function(response){
					if(response.code==1)
					{
						window.location.reload();
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
			}
		});
		return false;
	});

	$('#createQrcodeForm').validate({
		rules : {
			name:{
				required:true,
			},
		},
		messages:{  
	        name:{
	        	required:'请填写渠道名称',
	        }
	    },  
		errorPlacement : function(error, element) {
			error.css({
				color : '#f4516c',
				marginTop : '0.2rem',
				fontSize : '0.85rem',
				fontFamily : 'Poppins',
				lineHeight : '1.5',
				paddingLeft : '5px',
			});
		},
		focusInvalid : true,
		errorClass : 'col-offset-2 error',
		success : function(error, element) {
			error.remove();
		},
		highlight : function(element, b, c) {
			$(element).css({
				borderColor : '#f4516c'
			});
		},
		submitHandler : function(form) {
			var data = {
				name:$.trim($(form).find('input[name=name]').val()),
			};
			$(form).find('button[type=submit]').loading('start',{
				text:'加载中',
			});
			$.post($(form).attr('action'),data,function(response){
				$(form).find('button[type=submit]').loading('stop');
				if(response.code==1)
				{
					window.location.reload();
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
		}
	});
});
</script>
</body>
</html>