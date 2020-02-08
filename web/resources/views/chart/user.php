<?php
use jin123456bat\assets;
use think\facade\Request;
use jin123456bat\helper;
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
				  <legend>累计用户</legend>
				   <div class="layui-field-box">
				   	<div class="layui-col-md12">
				   		<div class="layui-inline">
					      <label class="layui-form-label">筛选日期</label>
					       <div class="layui-input-inline">
					        	<input type="text" class="layui-input" id="laydate-day" value="<?php echo date('Y-m-d');?>">
					      	</div>
					    </div>
				   		<div class="layui-btn-group layui-btn-group-select">
						    <button class="layui-btn layui-btn-sm" type="1">日</button>
						    <button class="layui-btn layui-btn-sm layui-btn-primary" type="2">周</button>
						    <button class="layui-btn layui-btn-sm layui-btn-primary" type="3">月</button>
						</div>
				   		<div id="orderChart"></div>
		 			</div>
				  </div>
				</fieldset>
				<fieldset class="layui-elem-field">
					<legend>新增用户/性别区分</legend>
					 <div class="layui-field-box">
					 	<div class="layui-col-md8">
					 		<div class="layui-inline">
						      <label class="layui-form-label">筛选日期</label>
						       <div class="layui-input-inline">
						        	<input type="text" class="layui-input" id="laydate-month" value="<?php echo date('Y-m');?>">
						      	</div>
						    </div>
					   		<div id="timeChart" class="chart"></div>
			 			</div>
					 	<div class="layui-col-md4">
					   		<div id="sexChart" class="chart"></div>
			 			</div>
					 </div>
				</fieldset>
				<fieldset class="layui-elem-field">
					<legend>地图分布</legend>
					 <div class="layui-field-box">
			 			<div class="layui-col-md12">
					   		<div id="mapChart" style="height: 800px;" class="chart"></div>
			 			</div>
					 </div>
				</fieldset>
			</div>
		</div>
	</div>
</div>
<script src="/static/common/js/jquery.min.js"></script>
<script src="/static/layui/layui.all.js"></script>
<script src="/static/chart/echarts.min.js"></script>
<script src="/static/chart/china.js"></script>
  <script type="text/javascript">
  	$(function(){
  		layui.use('laydate', function(){
  			var laydate = layui.laydate;
	  		laydate.render({
			    elem: '#laydate-month'
			    ,type: 'month'
			    ,max: "<?php echo date('Y-m');?>"
			    ,done: function(value, date, endDate){
			    	seekUserTime("<?=url('chart/seekusertime')?>?time="+value+"&is_company=1");
			    }
			});

			laydate.render({
			    elem: '#laydate-day'
			    ,max: "<?php echo date('Y-m-d');?>"
			    ,done: function(value, date, endDate){
			    	$('.layui-btn-group-select button').each(function(k,v){
			    		if(!$(this).hasClass('layui-btn-primary')){
				    		var type = $(this).attr('type');
				    		orderChartWeek("<?=url('chart/seekTotalUser')?>?time="+value+'&type='+type+"&is_company=1");
				    	}
			    	})
			    }
			});
	  	})
  	})
  	
  	var dom = document.getElementById("orderChart");
	var myChart = echarts.init(dom);
	//选择展示方式
  	$('.layui-btn-group-select').find('button').click(function(){
		$(this).removeClass('layui-btn-primary').siblings().addClass('layui-btn-primary');
		$('.layui-btn-group-select button').each(function(k,v){
    		if(!$(this).hasClass('layui-btn-primary')){
	    		var type = $(this).attr('type');
	    		var date = $("#laydate-day").val();
	    		if(date){
	    			orderChartWeek("<?=url('chart/seekTotalUser')?>?time="+date+'&type='+type+"&is_company=1");
	    		}
	    	}
    	})
	})
	myChart.showLoading();
	//获取累计用户数据
	orderChartWeek();
	function orderChartWeek(urlDate = "<?=url('chart/seekTotalUser')?>?is_company=1"){
		$.post(urlDate).done(function (res) {
			if(res.code==1){
				layer.alert(res.message);
			}
			myChart.hideLoading();
			myChart.clear();
		    myChart.setOption({
		    	 tooltip : {
			        trigger: 'item',
			        formatter: "{b} : {c}人"
			    },
		        xAxis: {
			        type: 'category',
			        data: res.date,
			        axisLabel:{
					    interval:0
				    },
				    axisTick: {
				　　　　alignWithLabel: true
				　　 }
			    },
			    yAxis: {
			        type: 'value',
			    },
			    series: [{
			        data: res.userData,
			        type: 'bar',
			    }],
		    });
		});
	}
	//时间区段的用户
	var doms = document.getElementById("timeChart");
	var timeChart = echarts.init(doms);
	timeChart.showLoading();
	seekUserTime();
	function seekUserTime(urlDate = "<?=url('chart/seekUserTime')?>?is_company=1"){
		$.post(urlDate).done(function (res) {
			if(res.code==1){
				layer.alert(res.message);
			}
			timeChart.hideLoading();
		    timeChart.setOption({
		    	tooltip : {
			        trigger: 'item',
			        formatter: "{b}号 : {c}人"
			    },
		    	xAxis: {
			        type: 'category',
			        data: res.data.date
			    },
			    yAxis: {
			        type: 'value'
			    },
			    series: [{
			        data: res.data.userData,
			        type: 'line',
			        smooth: true
			    }]
		    });
		});
	}
	
	//用户性别
	var doms = document.getElementById("sexChart");
	var sexChart = echarts.init(doms);
	sexChart.showLoading();
	$.post("<?=url('chart/userSex')?>?is_company=1").done(function (res) {
		if(res.code==1){
			layer.alert(res.message);
		}
		sexChart.hideLoading();
	    sexChart.setOption({
	    	 tooltip : {
		        trigger: 'item',
		        formatter: "{a} <br/>{b} : {c}人 ({d}%)"
		    },
	        legend: {
		        orient: 'vertical',
		        left: 'left',
		        data: ['男','女','未知']
		    },
		    series : [
		        {
		            name: '男女比例',
		            type: 'pie',
		            radius : '55%',
		            center: ['50%', '60%'],
		            data:res.data.sexCount,
		            itemStyle: {
		                emphasis: {
		                    shadowBlur: 10,
		                    shadowOffsetX: 0,
		                    shadowColor: 'rgba(0, 0, 0, 0.5)'
		                }
		            }
		        }
		    ]
	    });
	});

	//用户地区分布
	var doms = document.getElementById("mapChart");
	var mapChart = echarts.init(doms);
	mapChart.showLoading();
	$.post("<?=url('chart/userMap')?>?is_company=1").done(function (res) {
		if(res.code==1){
			layer.alert(res.message);
		}
		mapChart.hideLoading();
	    mapChart.setOption({
	    	backgroundColor: '#FFFFFF',  
            title: {  
                text: '用户地区分布',  
                subtext: '',  
                x:'center'
            },  
            tooltip : {  
                trigger: 'item',
                formatter: "{b} : {c}人"
            },  
            //左侧小导航图标
            visualMap: {  
                show : true,  
                x: 'left',  
                y: 'center',  
                splitList: res.data.part.partData,
                color: res.data.part.colorData
            },  
            //配置属性
            series: [{  
                name: '数据',  
                type: 'map',  
                mapType: 'china',   
                roam: false,  
                label: {  
                    normal: {  
                        show: true  //省份名称  
                    },  
                    emphasis: {  
                        show: false  
                    }  
                },  
                data:res.data.cityData  //数据
            }]
	    });
	});
  </script>
</body>
</html>