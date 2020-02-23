<?php
use App\Helper\Assets;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<title>日志管理系统</title>
<!-- 所有页面使用的样式 -->
<link rel="stylesheet" href="<?=Assets::css('main.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=Assets::css('spop.min.css')?>" type="text/css" media="all" />
<!-- 当前页面的插件使用的样式 -->
<link rel="stylesheet" href="<?=Assets::css('datatables.css')?>" type="text/css" media="all" />
</head>
<body>
	@include('common.header')
	<div class="container">
		@include('common.sidebar')
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
					<div class="line pull-left">
						<form id="search" class="col-md-5 pull-left">
							<input type="text" placeholder="请求地址" class="input_text col-md-3">
							<button class="button primary">搜索</button>
						</form>
					</div>
					<div class="tablebox">
						<table id="table" class="table" data-ajax-url="<?=url('log/request/index')?>">
							<thead>
								<tr>
									<th width="50px">
										<input type="checkbox" class="all_checked">
									</th>
									<th width="100%">项目</th>
									<th width="100%">时间</th>
									<th width="100%">请求方式</th>
									<th width="100%">请求参数</th>
									<th width="100%">请求头</th>
									<th width="100%">请求cookie</th>
									<th width="100%">请求session</th>
									<th width="100%">SERVER</th>
									<th width="100%">IP</th>
									<th width="100%">响应</th>
									<th width="100%">执行时间</th>
									<th width="100%">内存占用</th>
									<th width="100%">性能分析</th>
								</tr>
							</thead>
							<tbody></tbody>
							<tfoot>
								<tr>
									<td colspan="2"></td>
									<td id="split_page" colspan="12"></td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	@include('common.footer')
	<!-- 通用js -->
	<script type="text/javascript" src="<?=Assets::js('jquery.min.js','js')?>"></script>
	<!-- 全局js调用 -->
	<script type="text/javascript" src="<?=Assets::js('global.js')?>"></script>
	<!-- 当前页面使用的第三方类库的js -->
	<script type="text/javascript" src="<?=Assets::js('datatables.js')?>"></script>
	<script type="text/javascript" src="<?=Assets::js('spop.min.js')?>"></script>
	<!-- 当前页面独有的js -->
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
		data:'id',
		pk:true,
		render:function(data,full){
			return '<input type="checkbox" name="id[]" value="'+data+'">';
		}
	},{
		data:'project',
	},{
		data:'created_at',
	},{
		data:'url',
		render:function(data,full){
			return full.method + ' ' + data;
		}
	},{
		data:'params',
	},{
		data:'header',
	},{
		data:'cookie',
	},{
		data:'session',
	},{
		data:'server',
	},{
		data:'ip',
	},{
		data:'response',
	},{
		data:'exectime',
	},{
		data:'memory',
	},{
		data:'xhprof',
		render:function(data,full){
			content = '';
			if(data != null)
			{
				content += '<a class="button button-xs detail" data-url="'+data+'">性能分析</a>';
			}
			return content;
		}
	},{
		data:'method',
		visible:false,
	}],
	sort:{
		created_at:'desc',
		id:'desc',
	},
	pagesize:10,
	onRowLoaded:function(row){
		
	}
});

$('#search').on('submit',function(){
	table.search($(this).find('input').val());
	return false;
});

$('table').on('click','.detail',function(){
	window.open($(this).data('url'));
});
</script>
</body>
</html>