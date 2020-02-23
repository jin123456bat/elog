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
<!-- 当前页面使用的样式 -->
<link rel="stylesheet" href="<?=Assets::css('admin/index.css')?>" type="text/css" media="all" />
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
</body>
</html>