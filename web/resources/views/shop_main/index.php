<?php
use jin123456bat\assets;
use think\facade\Request;
use jin123456bat\helper;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title><?=$setting['site_title']?> | <?=$setting['site_desc']?></title>
  <link rel="stylesheet" href="/static/layui/css/layui.css" type="text/css" media="all" />
  <!-- 所有页面使用的样式 -->
  <link rel="stylesheet" href="<?=assets::css('main.css')?>"
	type="text/css" media="all" />
	<style type="text/css">
	.layui-footer{
		text-align: center;
	}
	body{
		background: #F2F2F2;
	}
	.layui-big-font{
		font-size: 36px;
	}
	.layui-card-body p{
		padding: 5px 0 10px;
	    overflow: hidden;
	    text-overflow: ellipsis;
	    word-break: break-all;
	    white-space: nowrap;
	    color: #666;
	}
	.layui-l-r{
		display: flex;
    	justify-content: space-between;
	}
	.layui-t-9{
		margin-top: 9px;
	}
	#orderChart{
		width: 100%;
		height: 400px;
	}
	.layui-elem-field{
		background:white;
	}
	.layui-card{
		    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.3)!important;
	}
	.layui-percentage span:first-child{
		line-height: 26px;
   		font-size: 26px;
	}
	.m-t-10{
		margin-bottom: 15px;
	}
	.m-r-t20 .layui-col-md11{
		float: right;
		margin-top: 18px;
	}
	.chart{
		width: 100%;
		height: 400px;
	}
	.layui-form-label{width: auto !important;}
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
				<fieldset class="layui-elem-field">
				  <legend>数据统计</legend>
				  <div class="layui-field-box">
				    <div class="layui-row layui-col-space15">
					    <div class="layui-col-md3">
					      <div class="layui-card">
					        <div class="layui-card-header layui-l-r">当周订单量<span class="layui-badge layui-bg-blue layui-t-9">周</span></div>
					        <div class="layui-card-body">
					        	<p class="layui-big-font">9,999,666</p>
					        	<p class="layui-l-r"><span>上周订单量</span><span>500 <i class="layui-inline layui-icon layui-icon-flag"></i></span></p>
					        </div>
					      </div>
					    </div>
					    <div class="layui-col-md3">
					      <div class="layui-card">
					       <div class="layui-card-header layui-l-r">当周订单量<span class="layui-badge layui-bg-blue layui-t-9">周</span></div>
					        <div class="layui-card-body">
					        	<p class="layui-big-font">9,999,666</p>
					        	<p class="layui-l-r"><span>上周订单量</span><span>500 <i class="layui-inline layui-icon layui-icon-flag"></i></span></p>
					        </div>
					      </div>
					    </div>
					    <div class="layui-col-md3">
					      <div class="layui-card">
					       <div class="layui-card-header layui-l-r">当周订单量<span class="layui-badge layui-bg-blue layui-t-9">周</span></div>
					        <div class="layui-card-body">
					        	<p class="layui-big-font">9,999,666</p>
					        	<p class="layui-l-r"><span>上周订单量</span><span>500 <i class="layui-inline layui-icon layui-icon-flag"></i></span></p>
					        </div>
					      </div>
					    </div>
					    <div class="layui-col-md3">
					      <div class="layui-card">
					       <div class="layui-card-header layui-l-r">当周订单量<span class="layui-badge layui-bg-blue layui-t-9">周</span></div>
					        <div class="layui-card-body">
					        	<p class="layui-big-font">9,999,666</p>
					        	<p class="layui-l-r"><span>上周订单量</span><span>500 <i class="layui-inline layui-icon layui-icon-flag"></i></span></p>
					        </div>
					      </div>
					    </div>
					  </div>
				  </div>
				</fieldset>
			</div>
		</div>
  	</div>
  </div>
</body>
<script src="/static/common/js/jquery.min.js"></script>
<script src="/static/layui/layui.all.js"></script>

</body>
</html>