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
<link rel="stylesheet" href="<?=assets::css('form.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('panel.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('button.loading.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('jquery.modal.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('datatables.css')?>" type="text/css" media="all" />
</head>
<body>
	<div class="modal-bg display-none" id="div-model">
		<div class="modal-container">
			<div class="modal-header">
				选择短信模板
				<button class="close">x</button>
			</div>
			<div class="modal-body">
				<div class="line"></div>
				<table id="table" class="table" data-ajax-url="<?=url('ajaxModelContent')?>">
					<thead>
						<tr>
							<th width="86px">模板ID</th>
							<th width="70px">模板名称</th>
							<th>模板内容</th>
							<th>短信内容</th>
							<th>操作</th>
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
							<p>微信消息将以公众号客服的形式发送,消息免费一天可以发送10万条</p>
							<p>短信消息将收取一定的短信费用,具体收费请看配置->在线充值,费用不足会导致发送失败,请保持账户余额充足</p>
						</div>
					</div>
					<div class="line"></div>
					<form class="form" id="baseForm" action="<?=url('message/send')?>">
						<div class="panel center-block col-md-5">
							<div class="panel-head">
								<div class="panel-title">发送消息</div>
							</div>
							<div class="panel-body">
								<div class="form-group col-md-10">
									<label class="label col-md-2">发送对象</label>
									<select class="select col-md-7" id="select-object" name="send_object">
										<option value="1">所有人</option>
										<?php if (!empty($group_list)){?>
										<option value="2">会员组</option>
										<?php }?>
									</select>
								</div>
								<div class="form-group col-md-10" style="display: none" id="div-group">
									<label class="label col-md-2">会员组成员</label>
									<div class="col-md-7">
										<?php foreach ($group_list as $group){?>
										<div class="checkbox">
											<input type="checkbox" name="group_id" id="group_id_<?=$group['group_id']?>" value="<?=$group['group_id']?>">
											<label for="group_id_<?=$group['group_id']?>"><?=$group['group_name']?></label>
										</div>
										<?php }?>
									</div>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">发送内容</label>
									<textarea class="textarea col-md-7" rows="4" name="content"></textarea>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">方式选择</label>
									<div class="col-md-7 checkbox">
										<div class="col-md-2 checkbox-inline">
											<input type="radio" name="send_type" id="send_type_2" value="2" checked="checked">
											<label for="send_type_2">微信方式</label>
										</div>
									</div>
								</div>
								<input type="hidden" name="tmpl_id">
								<div class="form-submit">
									<div class="center-block submit-body">
										<button type="submit" class="button button-submit button-large">发送</button>
										<button type="reset" class="button button-cancel button-large">重置</button>
									</div>
								</div>
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
	<script type="text/javascript" src="<?=assets::common('jquery.validate.min.js','js')?>"></script>
	<script type="text/javascript" src="<?=assets::common('messages_zh.min.js','js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('datatables.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('jquery.modal.js')?>"></script>
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
		$('#baseForm').validate({
			rules : {
				content:{
					required:true,
				},
				send_type:{
					required:true,
				}
			},
			messages:{
				content:{
					required:'请填写消息内容',
				},
				send_type:{
					required:'请选择消息发送方式',
				}
			},
			errorPlacement : function(error, element) {
				if(element.is(':radio'))
				{
					error.css({
						color : '#f4516c',
						marginTop : '0.2rem',
						fontSize : '0.85rem',
						fontFamily : 'Poppins',
						lineHeight : '1.5',
						paddingLeft : '5px',
					});
					error.appendTo(element.parent().parent());
				}
				else
				{
					error.css({
						color : '#f4516c',
						marginTop : '0.2rem',
						fontSize : '0.85rem',
						fontFamily : 'Poppins',
						lineHeight : '1.5',
						paddingLeft : '5px',
					});
					error.appendTo(element.parent());
				}
				
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
				var group_id_array = new Array();
				if($('#select-object option:selected').val() == 2){
					$('input[name=group_id]:checked').each(function () {
					   group_id_array.push($(this).val());
					});
				}
				
				var data = {
					id:$(form).find('input[name=unionid]').val(),
					content:$.trim($(form).find('textarea[name=content]').val()),
					send_object:$('#select-object option:selected').val(),
					group_id:group_id_array,
					send_type:$(form).find('input[name=send_type]:checked').val(),
					tmpl_id:$(form).find('input[name=tmpl_id]').val()
				};

				$('.button-submit').loading('start');
				$.post($(form).attr('action'),data,function(response){
					$('.button-submit').loading('stop');
					if(response.code==1)
					{
						window.location = response.data.url;
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

	//选择器隐藏显示对象
	$('#select-object').change(function () {
		var opt = $('#select-object').val();
		if(opt == 2)
		{
			$('#div-group').show();
		}
		else
		{
			$('#div-group').hide();
		}
	});
	
	$('input:radio[name=send_type]').change(function (){
        var opt = this.value;
        if(opt == 1)
        {
            $('#div-model').modal('show');
        }
    });

	datatables({
		table:$('#table'),
		ajax:{
			data:{
			},
			method:'post',
		},
		columns:[{
			data:'tmpl_id'
		},{
			data:'tmpl_name'
		},{
			data:'tmpl_content'
		},{
			data:'tmpl_exp'
		},{
			data:'id',
			render:function (data,full) {
				return '<a class="button button-xs select-message" data-content="'+full.tmpl_content+'" data-id='+full.id+'>选取</a>';
			}
		}],
		sort:{
			createtime:'desc',
		},
		pagesize:10,
		onRowLoaded:function(row){

		}
	});
	
	$("#table").on("click",".select-message",function () {
		$('input[name=tmpl_id]').val($(this).attr("data-id"));
		$('textarea[name=content]').val($(this).attr("data-content"));
		$('#div-model').modal('hide');
	});
</script>
</body>
</html>