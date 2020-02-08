<?php
use jin123456bat\assets;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="renderer" content="webkit|ie-comp|ie-stand">
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
				<fieldset class="layui-elem-field" style="display: none;">
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
				<fieldset class="layui-elem-field">
				  <legend>订单数量</legend>
				   <div class="layui-field-box">
				   	<div class="layui-col-md12">
				   		<div class="layui-inline">
					      <label class="layui-form-label">筛选日期</label>
					       <div class="layui-input-inline">
					        	<input type="text" class="layui-input" id="laydate-day" value="<?php echo date('Y-m-d'); ?>">
					      	</div>
					    </div>
				   		<div class="layui-btn-group layui-btn-group-select a">
						    <button class="layui-btn layui-btn-sm" type="1">日</button>
						    <button class="layui-btn layui-btn-sm layui-btn-primary" type="2">周</button>
						    <button class="layui-btn layui-btn-sm layui-btn-primary" type="3">月</button>
						</div>
				   		<div id="orderChart"></div>
		 			</div>
				  </div>
				</fieldset>
				<fieldset class="layui-elem-field">
				  <legend>订单总额</legend>
				   <div class="layui-field-box">
				   	<div class="layui-col-md12">
				   		<div class="layui-inline">
					      <label class="layui-form-label">筛选日期</label>
					       <div class="layui-input-inline">
					        	<input type="text" class="layui-input" id="orderChartMoney-day" value="<?php echo date('Y-m-d'); ?>">
					      	</div>
					    </div>
				   		<div class="layui-btn-group layui-btn-group-select b">
						    <button class="layui-btn layui-btn-sm" type="1">日</button>
						    <button class="layui-btn layui-btn-sm layui-btn-primary" type="2">周</button>
						    <button class="layui-btn layui-btn-sm layui-btn-primary" type="3">月</button>
						</div>
				   		<div id="orderChartMoney" style="height: 400px;"></div>
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
<script src="/static/chart/echarts.min.js"></script>
  <script type="text/javascript">
  	$(function(){
  		//订单数量
  		layui.use('laydate', function(){
  			var laydate = layui.laydate;
	  		laydate.render({
			    elem: '#laydate-day'
			    ,type: 'date'
			    ,max: "<?php echo date('Y-m-d'); ?>"
			    ,done: function(value, date, endDate){
			    	$('.a button').each(function(k,v){
			    		if(!$(this).hasClass('layui-btn-primary')){
				    		var type = $(this).attr('type');
				    		orderChartWeek("<?=url('chart/getOrderChart')?>?time="+value+'&type='+type+"&is_company=1");
				    	}
			    	})
			    }
			});
	  		//订单总额
			laydate.render({
			    elem: '#orderChartMoney-day'
			    ,type: 'date'
			    ,max: "<?php echo date('Y-m-d'); ?>"
			    ,done: function(value, date, endDate){
			    	$('.b button').each(function(k,v){
			    		if(!$(this).hasClass('layui-btn-primary')){
				    		var type = $(this).attr('type');
				    		orderChartMoneyA("<?=url('chart/getOrderMoney')?>?time="+value+'&type='+type+"&is_company=1");
				    	}
			    	})
			    }
			});
	  	})
  	})
  	/**
  	 * dom 订单数量
  	 * @type chart
  	 */
  	var dom = document.getElementById("orderChart");
	var myChart = echarts.init(dom);
	var app = {};
	//选择展示方式
  	$('.a').find('button').click(function(){
		$(this).removeClass('layui-btn-primary').siblings().addClass('layui-btn-primary');
		$('.a button').each(function(k,v){
    		if(!$(this).hasClass('layui-btn-primary')){
	    		var type = $(this).attr('type');
				var date = $("#laydate-day").val();
	    		if(date){
	    			orderChartWeek("<?=url('chart/getOrderChart')?>?time="+date+'&type='+type+"&is_company=1");
	    		}
	    	}
    	})
	})

	myChart.showLoading();
	//获取周订单数据
	orderChartWeek("<?=url('chart/getOrderChart')?>?is_company=1");
	function orderChartWeek(url){
		$.post(url).done(function (res) {
			if(res.code==1){
				layer.alert(res.message);
			}
			myChart.hideLoading();
		    myChart.setOption({
		        tooltip : {
		        trigger: 'axis',
		        axisPointer: {
		            type: 'cross',
		            label: {
		                backgroundColor: '#6a7985'
		            }
		        }
		    },
		    legend: {
		        data:['有效订单','付款订单']
		    },
		    toolbox: {
		        feature: {
		            saveAsImage: {}
		        }
		    },
		    yAxis : [
		        {
		            type : 'value'
		        }
		    ],

		    grid: {
		        left: '3%',
		        right: '4%',
		        bottom: '3%',
		        containLabel: true
		    },

		    xAxis : [
		        {
		            type : 'category',
		            boundaryGap : false,
		            data : res.date
		        }
		    ],

		    series : [

		        {
		            name:'有效订单',
		            type:'line',
		            stack: '总量',
		            areaStyle: {},
		            data: res.validOrderData
		        },
		        {
		            name:'付款订单',
		            type:'line',
		            stack: '总量',
		            areaStyle: {},
		            data: res.payOrderData
		        },
		    ]
		    });
		});
	}
	//end

	/**
	 * 订单总额
	 */
	var orderChartMoneyDom = document.getElementById("orderChartMoney");
	var orderChartMoney = echarts.init(orderChartMoneyDom);
	orderChartMoney.showLoading();
	//选择展示方式
  	$('.b>button').click(function(){
		$(this).removeClass('layui-btn-primary').siblings().addClass('layui-btn-primary');
		$('.b>button').each(function(k,v){
    		if(!$(this).hasClass('layui-btn-primary')){
	    		var type = $(this).attr('type');
				var date = $("#laydate-day").val();
	    		if(date){
	    			orderChartMoneyA("<?=url('chart/getOrderMoney')?>?time="+date+'&type='+type+"&is_company=1");
	    		}
	    	}
    	})
	})
	orderChartMoneyA("<?=url('chart/getOrderMoney')?>?is_company=1");

	function orderChartMoneyA(url){
		$.post(url).done(function (res) {
			if(res.code==1){
				layer.alert(res.message);
			}
			orderChartMoney.hideLoading();
		    orderChartMoney.setOption({

		    	tooltip : {
			        trigger: 'axis',
			        formatter: "{b} : 总额: {c}元"
			    },
		        xAxis: {
			        type: 'category',
			        data: res.date,
			    },
			    yAxis: {
			        type: 'value'
			    },
			    series: [{
			        data: res.payOrderData,
			        type: 'line',
			        smooth: true
			    }]
		    });
		});
	}

  </script>
</body>
</html>