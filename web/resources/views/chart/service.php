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
<!-- 当前页面的插件使用的样式 -->
<link rel="stylesheet" href="<?=assets::css('panel.css')?>" type="text/css" media="all" />
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
					<div id="statistic" style="width:100%;height:700px;">
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
<script type="text/javascript" src="<?=assets::common('echarts.min.js','js')?>"></script>
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
	
// 	function dataFormatter(obj,month) {
// 	    var pList = ['北京','天津','河北','山西','内蒙古','辽宁','吉林','黑龙江','上海','江苏','浙江','安徽','福建','江西','山东','河南','湖北','湖南','广东','广西','海南','重庆','四川','贵州','云南','西藏','陕西','甘肃','青海','宁夏','新疆'];
// 	    var temp;
// 	    for (var year = 2002; year <= 2011; year++) {
// 	        var max = 0;
// 	        var sum = 0;
// 	        temp = obj[year];
// 	        for (var i = 0, l = temp.length; i < l; i++) {
// 	            max = Math.max(max, temp[i]);
// 	            sum += temp[i];
// 	            obj[year][i] = {
// 	                name : pList[i],
// 	                value : temp[i]
// 	            }
// 	        }
// 	        obj[year + 'max'] = Math.floor(max / 100) * 100;
// 	        obj[year + 'sum'] = sum;
// 	    }
// 	    return obj;
// 	}

	$.post('<?=url('statistic/service_statistic')?>',function(response){
		if(response.code!=1)
		{
			spop({
			    template: response.message,
			    style: response.code==1?'success':'error',
			    autoclose: 3000,
			    position:'bottom-right',
			    icon:true,
			    group:false,
			});
			return false;	
		}

		var options = [];
		$.each(response.data.month_list,function(k,v){
			var series = [];
			$.each(response.data.service_name,function(kk,vv){
				var data_list = [];
				$.each(response.data.hotel_list,function(kkk,vvv){
					data:data_list.push({
						name:vvv,
						value:response.data.data[v][vv][vvv],
					});
				});

				series.push({
					data:data_list
				});
			});

			var total = [];
			$.each(response.data.service_name,function(kk,vv){
				total.push({
					name:vv,
					value:response.data.total[v][vv],//累计的数量
				});
			});	
			series.push({
				data:total
			});
			
			options.push({
	            title: {text: v+'服务数据指标'},
	            series: series
	        });
		});

		var base_option_series = [];
		$.each(response.data.service_name,function(kk,vv){
			base_option_series.push({
				name:vv,
				type:'bar',
			});
		});
		base_option_series.push({
			name: '请求次数',
            type: 'pie',
            center: ['75%', '35%'],
            radius: '28%',
            z: 100
		});
		
		var global_option = {
		    baseOption: {
		        timeline: {
		            // y: 0,
		            axisType: 'category',
		            realtime: true,
		            // loop: false,
		            autoPlay: true,
		            rewind:false,//反向播放
		            inverse:true,//反过来
		            // currentIndex: 2,
		            playInterval: 3000,
		            currentIndex:0,
		            // controlStyle: {
		            //     position: 'left'
		            // },
		            data: response.data.month_list,
		            label: {
		            	interval:0,
		                formatter : function(s) {
			                return s;
		                    //return (new Date(s)).getFullYear();
		                }
		            }
		        },
		        title: {
		            subtext: '数据总览'
		        },
		        tooltip: {
		        },
		        legend: {
		            x: 'right',
		            data: response.data.service_name,
		        },
		        calculable : true,
		        grid: {
		            top: 80,
		            bottom: 100,
		            tooltip: {
		                trigger: 'axis',
		                axisPointer: {
		                    type: 'shadow',
		                    label: {
		                        show: true,
		                        formatter: function (params) {
		                            return params.value.replace('\n', '');
		                        }
		                    }
		                }
		            }
		        },
		        xAxis: [
		            {
		                'type':'category',
		                'axisLabel':{'interval':0},
		                'data':response.data.hotel_list,
		                splitLine: {show: false}
		            }
		        ],
		        yAxis: [
		            {
		                type: 'value',
		                name: '次'
		            }
		        ],
		        series: base_option_series
		    },
		    options: options
		};

		var echarts_div = echarts.init(document.getElementById('statistic'));
		echarts_div.setOption(global_option);
	});
});
</script>
</body>
</html>