<?php
use jin123456bat\assets;
use think\facade\Request;
use jin123456bat\companyController;
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
							<p>用户在公众号上的留言记录</p>
						</div>
					</div>
					<div class="line">
						<form id="search" class="col-md-10">
							<input type="text" placeholder="用户昵称/消息内容" class="input_text col-md-2">
							<button class="button primary">搜索</button>
						</form>
					</div>
					<div class="tablebox">
						<table id="table" class="table" data-ajax-url="<?=url()?>">
							<thead>
								<tr>
									<th>用户头像</th>
									<th>用户昵称</th>
									<th>消息时间</th>
									<th>消息类型</th>
									<th>消息内容</th>
									<th>消息ID</th>
								</tr>
							</thead>
							<tbody></tbody>
							<tfoot>
								<tr>
									<td colspan="2"></td>
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
<script type="text/javascript" src="<?=assets::common('jquery.gallery.js','js')?>"></script>
<script type="text/javascript" src="<?=assets::common('audio.js','js')?>"></script>
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
			data:'gravatar',
			render:function(data,full){
				if(data==null)
				{
					return '';
				}
				else
				{
					return '<img class="image circle" src="'+data+'">';
				}
			}
		},{
			data:'nickname',
			render:function(data,full){
				return data==null?'':data;
			}
		},{
			data:'time',
		},{
			data:'type',
			render:function(data,full){
				switch(data)
				{
					case 'text':return '文字';
					case 'image':return '图像';
					case 'location':return '位置';
					case 'video':return '视频';
					case 'link':return '链接';
					case 'voice':return '语音';
					default:return '未知类型';
				}
			}
		},{
			data:'content',
			render:function(data,full){
				switch(full.type)
				{
					case 'text':
						return '<div style="text-align: left;white-space: normal;">'+data+'</div>';
					case 'image':
						data = $.parseJSON(data);
						return '<img data-image="'+data.PicUrl+'" style="width:50px;" src="'+data.PicUrl+'">';
					case 'voice':
						data = $.parseJSON(data);
						content = '<div style="text-align: left;white-space: normal;">'+data.Recognition+'<i data-type="voice" data-media_id="'+data.MediaId+'" class="voice iconfont menu-icon" style="font-size:12px;display: initial;cursor:pointer;">&#xe623;</i></div>';
						return content;
					case 'location':
						data = $.parseJSON(data);
						content = '<div style="text-align: left;white-space: normal;">'+data.Label+'</div>';
						return content;
					case 'link':
						data = $.parseJSON(data);
						content = '<div style="text-align: left;white-space: normal;"><a href="'+data.Url+'">'+data.Title+'</a></div>';
						return content;
					case 'video':
						data = $.parseJSON(data);
						content = '<div style="text-align: left;" data-type="video" data-thumb_media_id="'+data.ThumbMediaId+'" data-media_id="'+data.MediaId+'" class="video" style="cursor:pointer;"></div>';
						return content;
				}
			}
		},{
			data:'msgid',
		},{
			data:'user_id',
			visible:false,
		}],
		sort:{
			time:'desc',
		},
		pagesize:10,
		onRowLoaded:function(row){
			//图片消息
			row.find('td:eq(4) img').gallery();

			//视频消息
			var thumb_media_id = row.find('td:eq(4) .video').data('thumb_media_id');
			if(thumb_media_id)
			{
				$.post('<?=url('wechat/get_media_url')?>',{media_id:thumb_media_id,type:'thumb'},function(response){
					if(response.code==1)
					{
						row.find('td:eq(4) .video').append('<img style="width:50px;" src="'+response.data.url+'">');
					}
				});
			}
			
			//语音消息
			row.find('td:eq(4) .voice').on('click',function(){
				$.post('<?=url('wechat/get_media_url')?>',{media_id:$(this).data('media_id'),type:$(this).data('type')},function(response){
					if(response.code==1)
					{
						Audio.play(response.data.url);
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
			});
		}
	});
	
	$('#search').on('submit',function(){
		table.search($(this).find('input').val());
		return false;
	});
});
</script>
</body>
</html>