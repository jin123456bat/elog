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
<link rel="stylesheet" href="<?=assets::css('tab.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('datatables.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('jquery.modal.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('form.css')?>" type="text/css" media="all" />
<style>
.news {
	width: 200px;
	padding: 10px;
	border: 1px solid #ccc;
	text-align: left;
	display: inline-block;
	float: left;
	background-color: #fff;
}

.news .news-title {
	font-size: 14px;
	color: #000;
	white-space: initial;
}

.news input, .news textarea {
	border: none;
	outline: none;
	width: 100%;
	text-overflow: ellipsis;
	height: 100%;
	overflow: hidden;
	resize: none;
}

.news .news-description, .news textarea {
	color: #999;
	font-size: 12px;
	width: 100%;
	white-space: initial;
	overflow: hidden;
	text-overflow: ellipsis;
}

.news .news-body {
	display: flex;
	flex-flow: row nowrap;
}

.news .news-pic {
	width: 50px;
	height: 50px;
}

.news img {
	width: 100%;
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
					<div class="tab">
						<div class="tab-header">
							<a class="tab-title active" href="#text">
								微信响应消息
								<span class="tab-title-label display-none">0</span>
							</a>
							<!-- 							<a class="tab-title" href="#image"> -->
							<!-- 								图片消息 -->
							<!-- 								<span class="tab-title-label display-none">0</span> -->
							<!-- 							</a> -->
							<!-- 							<a class="tab-title" href="#voice"> -->
							<!-- 								语音消息 -->
							<!-- 								<span class="tab-title-label display-none">0</span> -->
							<!-- 							</a> -->
							<!-- 							<a class="tab-title" href="#video"> -->
							<!-- 								视频消息 -->
							<!-- 								<span class="tab-title-label display-none">0</span> -->
							<!-- 							</a> -->
							<!-- 							<a class="tab-title" href="#music"> -->
							<!-- 								音乐消息 -->
							<!-- 								<span class="tab-title-label display-none">0</span> -->
							<!-- 							</a> -->
							<!-- 							<a class="tab-title" href="#news"> -->
							<!-- 								图文消息（外链） -->
							<!-- 								<span class="tab-title-label display-none">0</span> -->
							<!-- 							</a> -->
							<!-- 							<a class="tab-title" href="#mpnews"> -->
							<!-- 								图文消息（内链） -->
							<!-- 								<span class="tab-title-label display-none">0</span> -->
							<!-- 							</a> -->
						</div>
						<div class="tab-body">
							<div class="tab-page active" id="text">
								<!-- 								<div class="line"></div> -->
								<!-- 								<div class="top-tips"> -->
								<!-- 									<div class="top-tips-title">操作提示</div> -->
								<!-- 									<div class="top-tips-body"></div> -->
								<!-- 								</div> -->
								<div class="line">
									<a id="create_mp_response_text" class="button button-outline-red button-small" title="create_mp_response_text">添加文本消息</a>
									<!-- 									<a id="create_mp_response_image" class="button button-outline-red button-small" title="create_mp_response_image">添加图片消息</a> -->
									<a id="create_mp_response_news" class="button button-outline-red button-small" title="create_mp_response_news">添加图文消息（外链）</a>
								</div>
								<table class="table" data-ajax-url="<?=url('wechat/mp_response')?>">
									<thead>
										<tr>
											<th>
												<input type="checkbox" class="all_checked">
											</th>
											<th>消息名称</th>
											<th>创建时间</th>
											<th>响应次数</th>
											<th>消息类型</th>
											<th>内容</th>
											<th>关键字</th>
											<th>关注触发</th>
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
				</div>
			</div>
		</div>
	</div>
	{include file='common/footer' /}
	<div id="textModal" class="modal-bg display-none">
		<div class="modal-container" style="top: 30%;">
			<div class="modal-header">
				<div class="modal-title">
					添加文本消息
					<button class="close">x</button>
				</div>
			</div>
			<form class="form" id="createTextForm" action="<?=url('wechat/create_mp_response')?>" method="post">
				<div class="modal-body">
					<input type="hidden" name="type" value="text">
					<input type="hidden" name="id">
					<div class="form-group col-md-10">
						<label class="label col-md-2 required">消息名称</label>
						<input class="col-md-7 input_text" type="text" name="name">
					</div>
					<div class="form-group col-md-10">
						<label class="label col-md-2">消息内容</label>
						<textarea rows="7" class="textarea col-md-7" name="content"></textarea>
						<div class="text-helper col-offset-2">支持插入快捷链接</div>
					</div>
					<div class="form-group col-md-10">
						<label class="label col-md-2">关键字</label>
						<input type="text" class="input_text col-md-7" name="keywords">
						<div class="text-helper col-offset-2">多个关键字英文逗号分隔</div>
					</div>
					<div class="form-group col-md-10">
						<label class="label col-md-2">关注触发</label>
						<div class="checkbox col-md-7">
							<input type="checkbox" class="input_checkbox" name="subscribe" id="text-subscribe" value="1">
							<label for="text-subscribe">关注公众号时是否推送</label>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit">确定</button>
					<button type="button" class="close">取消</button>
				</div>
			</form>
		</div>
	</div>
	<div id="imageModal" class="modal-bg display-none">
		<div class="modal-container" style="top: 30%;">
			<div class="modal-header">
				<div class="modal-title">
					添加图片消息
					<button class="close">x</button>
				</div>
			</div>
			<form class="form" id="createImageForm" action="<?=url('wechat/create_mp_response')?>" method="post">
				<div class="modal-body">
					<input type="hidden" name="type" value="image">
					<input type="hidden" name="id">
					<div class="form-group col-md-10">
						<label class="label col-md-2 required">消息名称</label>
						<input class="col-md-7 input_text" type="text" name="name">
					</div>
					<div class="form-group col-md-10">
						<label class="label col-md-2">图片选择</label>
						<div class="col-md-7 imageMaterialList"></div>
						<div class="text-helper col-offset-2">
							图片使用微信永久素材，可以跳转到
							<a target="_blank" href="https://mp.weixin.qq.com/">微信公众平台</a>
							管理
						</div>
					</div>
					<div class="form-group col-md-10">
						<label class="label col-md-2">关键字</label>
						<input type="text" class="input_text col-md-7" name="keywords">
						<div class="text-helper col-offset-2">多个关键字英文逗号分隔</div>
					</div>
					<div class="form-group col-md-10">
						<label class="label col-md-2">关注触发</label>
						<div class="checkbox col-md-7">
							<input type="checkbox" class="input_checkbox" name="subscribe" id="image-subscribe" value="1">
							<label for="image-subscribe">关注公众号时是否推送</label>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit">确定</button>
					<button type="button" class="close">取消</button>
				</div>
			</form>
		</div>
	</div>
	<div id="newsModal" class="modal-bg display-none">
		<div class="modal-container" style="top: 30%;">
			<div class="modal-header">
				<div class="modal-title">
					添加图文消息（外链）
					<button class="close">x</button>
				</div>
			</div>
			<form class="form" id="createNewsForm" action="<?=url('wechat/create_mp_response')?>" method="post">
				<div class="modal-body">
					<input type="hidden" name="type" value="news">
					<input type="hidden" name="id">
					<div class="form-group col-md-10">
						<label class="label col-md-2 required">消息名称</label>
						<input class="col-md-7 input_text" type="text" name="name">
					</div>
					<div class="form-group col-md-10">
						<label class="label col-md-2">消息</label>
						<div class="col-md-7">
							<div class="news">
								<div class="news-title">
									<input maxlength="24" type="text" placeholder="请输入消息标题" name="content[title]">
								</div>
								<div class="news-body">
									<div class="news-description">
										<textarea maxlength="30" name="content[description]" placeholder="请输入消息描述"></textarea>
									</div>
									<div class="news-pic">
										<img class="upload_image" src="<?=assets::common('plus.png', 'image')?>">
										<input type="hidden" name="content[picurl]">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group col-md-10">
						<label class="label col-md-2">跳转地址</label>
						<input type="text" class="input_text col-md-7" name="content[url]">
						<div class="text-helper col-offset-2">完整URL地址，http(s)://开头</div>
					</div>
					<div class="form-group col-md-10">
						<label class="label col-md-2">关键字</label>
						<input type="text" class="input_text col-md-7" name="keywords">
						<div class="text-helper col-offset-2">多个关键字英文逗号分隔</div>
					</div>
					<div class="form-group col-md-10">
						<label class="label col-md-2">关注触发</label>
						<div class="checkbox col-md-7">
							<input type="checkbox" class="input_checkbox" name="subscribe" id="news-subscribe" value="1">
							<label for="news-subscribe">关注公众号时是否推送</label>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit">确定</button>
					<button type="button" class="close">取消</button>
				</div>
			</form>
		</div>
	</div>
	<!-- 通用js -->
	<script type="text/javascript" src="<?=assets::common('jquery.min.js','js')?>"></script>
	<!-- 全局js调用 -->
	<script type="text/javascript" src="<?=assets::js('global.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('spop.min.js')?>"></script>
	<!-- 当前页面使用插件的js -->
	<script type="text/javascript" src="<?=assets::js('button.loading.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('datatables.js')?>"></script>
	<script type="text/javascript" src="<?=assets::common('jquery.validate.min.js','js')?>"></script>
	<script type="text/javascript" src="<?=assets::common('messages_zh.min.js','js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('jquery-ui.min.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('tab.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('jquery.modal.js')?>"></script>
	<script type="text/javascript" src="<?=assets::common('php.js','js')?>"></script>
	<script>
$.ajaxSetup({
	headers: {
		'__token__': '<?=Request::token('__token__')?>' ,
	},
});
</script>
	<script type="text/html" id="image">
<div>
我是图片
</div>
</script>
	<script type="text/html" id="news">
<div class="news">
	<div class="news-title"><%=title%></div>
	<div class="news-body">
		<div class="news-description">
			<%=description%>
		</div>
		<div class="news-pic">
			<img class="upload_image" src="<%=picurl%>">
		</div>
	</div>
</div>
</script>
	<script>
$(function () {
	tab.init();
	
	$('#create_mp_response_text').on('click',function(){
		$('#textModal').modal('show');
		$('#createTextForm input[type=text],#textModal textarea').val('');
		$('#createTextForm input[type=checkbox]').prop('checked',false);
		$('#createTextForm').attr('action','<?=url('wechat/create_mp_response')?>');
	});
	$('#create_mp_response_image').on('click',function(){
		$('#imageModal').modal('show');
		$('#createImageForm').attr('action','<?=url('wechat/create_mp_response')?>');
		$.post('<?=url('wechat/get_media_list')?>',{type:'image'},function(response){
			if(response.code==1)
			{
				$('.imageMaterialList').empty().html(tpl($('#image').html(),response.data));
			}
		});
	});
	$('#create_mp_response_news').on('click',function(){
		$('#newsModal').modal('show');
		$('#createNewsForm').attr('action','<?=url('wechat/create_mp_response')?>');
		$('#createNewsForm input[type=checkbox]').prop('checked',false);
		$('#createNewsForm input[type=text],#textModal textarea').val('');
	});
	
	$('#createTextForm').on('submit',function(){
		var btn = $(this).find('button[type=submit]');
		btn.loading('start',{
			text:'正在提交',
		});
		$.post($(this).attr('action'),$(this).serialize(),function(response){
			btn.loading('stop');
			if(response.code==1)
			{
				table.reload();
				$('#textModal').modal('hide');
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
		return false;
	});
	$('#createNewsForm').on('submit',function(){
		var btn = $(this).find('button[type=submit]');
		btn.loading('start',{
			text:'正在提交',
		});
		$.post($(this).attr('action'),$(this).serialize(),function(response){
			btn.loading('stop');
			if(response.code==1)
			{
				table.reload();
				$('#newsModal').modal('hide');
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
		return false;
	});

	//图片上传
	$('.upload_image').on('click',function(){
		var input = $('<input type="file">');
		var images = $(this);
		input.on('change',function(){
			var file = $(this)[0].files[0];
			var formData = new FormData();
			formData.append('file',file);
			formData.append('type','mp_response');
			formData.append('imagesize','50x50');
			var xhr = new XMLHttpRequest();
			xhr.open('POST','<?=url('common/component/upload')?>',true);
			xhr.upload.onloadstart = function(){
			}
			xhr.upload.onprogress = function(event){
			};
			xhr.onload = function(){
				if(xhr.status == 200 && xhr.readyState == 4)
				{
					var response = xhr.response;
					response = $.parseJSON(response);
					images.attr('src',response.data.url);
					images.next('input').val(response.data.url);
				}
			};
			xhr.send(formData);
		});
		input.trigger('click');
		return false;
	});
	
	var table = datatables({
		table:$('table.table'),
		ajax:{
			data:{
			},
			method:'post',
		},
		columns:[{
			data:'id',
			pk:true,
			render:function(data,full){
				return '<input type="checkbox" name="id[]" value="'+data+'">';
			}
		},{
			data:'name',
		},{
			data:'createtime',
		},{
			data:'response_times',
		},{
			data:'type',
			render:function(data,full){
				switch(data)
				{
					case 'text':return '文本消息';
					case 'news':return '图文消息（外链）';
				}
			}
		},{
			data:'content',
			render:function(data,full){
				switch(full.type)
				{
					case 'text':return data;
					case 'news':return tpl($('#news').html(),$.parseJSON(data));
				}
			}
		},{
			data:'keywords',
		},{
			data:'subscribe',
			render:function(data,full){
				return data==1?'是':'否';
			}
		},{
			data:'id',
			render:function(data,full){
				content = '';
				content += '<a data-config=\''+JSON.stringify(full)+'\' class="button button-xs update" title="update_mp_response" data-type="'+full.type+'" data-id="'+data+'">编辑</a>';
				content += '<a class="button button-xs button-red remove" title="remove_mp_response" data-id="'+data+'">删除</a>';
				return content;
			}
		}],
		sort:{
			createtime:'desc',
		},
		pagesize:10,
		onRowLoaded:function(row){

		}
	});

	$('table.table').on('click','.update',function(){
		var config = $(this).data('config');
		switch($(this).data('type'))
		{
			case 'text':
				$('#createTextForm').attr('action','<?=url('wechat/update_mp_response')?>');
				$('#textModal').modal('show');
				$.each(config,function(index,value){
					if(index!='subscribe')
					{
						$('#textModal [name='+index+']').val(value);
					}
					else
					{
						$('#textModal [name=subscribe]').prop('checked',value);
					}
				});
			break;
			case 'news':
				$('#createNewsForm').attr('action','<?=url('wechat/update_mp_response')?>');
				$('#newsModal').modal('show');
				$.each(config,function(index,value){
					if(index!='subscribe')
					{
						if(index == 'content')
						{
							value = $.parseJSON(value);
							for(var i in value)
							{
								$('#createNewsForm [name=content\\\['+i+'\\\]]').val(value[i]);
							}
						}
						else
						{
							$('#createNewsForm [name='+index+']').val(value);
						}
					}
					else
					{
						$('#createNewsForm [name=subscribe]').prop('checked',value);
					}
				});
				$('#createNewsForm .upload_image').attr('src',$('#createNewsForm input[name=content\\[picurl\\]]').val());
			break;
		}
		
	}).on('click','.remove',function(){
		var id = $(this).data('id');
		var tr = $(this).parents('tr');
		$.post('<?=url('wechat/remove_mp_response')?>',{id:id},function(response){
			if(response.code==1)
			{
				tr.remove();
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
		return false;
	});
});
</script>
</body>
</html>