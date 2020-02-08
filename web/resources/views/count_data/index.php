<?php
use jin123456bat\assets;
use think\facade\Request;
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
	.layui-footer{text-align:center}body{background:#f2f2f2}.layui-big-font{font-size:36px}.layui-card-body p{padding:5px 0 10px;overflow:hidden;text-overflow:ellipsis;word-break:break-all;white-space:nowrap;color:#666}.layui-l-r{display:flex;justify-content:space-between}.layui-t-9{margin-top:9px}.layui-elem-field{background:white}.layui-card{box-shadow:0 1px 2px 0 rgba(0,0,0,0.3)!important}.layui-percentage span:first-child{line-height:26px;font-size:26px}.m-t-10{margin-bottom:15px}.m-r-t20 .layui-col-md11{float:right;margin-top:18px}.chart{width:100%;height:400px}.layui-form-label{width:auto!important}
	.border-bottom-1px{
		border-bottom: 1px solid;
	}
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
				<fieldset class="layui-elem-field">
					<div class="layui-col-md3">
						<div class="layui-inline">
					      <label class="layui-form-label">选择时间</label>
					      <div class="layui-input-inline">
					        <input type="text" class="layui-input" id="selectDate" placeholder="<?php if(!empty(Request::get('selectDate'))){ echo Request::get('selectDate');}else{ echo date('Y-m');}?>">
					      </div>
					    </div>
					</div>
				</fieldset>
				<fieldset class="layui-elem-field">
				  <legend>住房订单</legend>
				  <div class="layui-field-box">
				    <div class="layui-row layui-col-space15">
					   {volist name="room_order['room_data']" id="vo"}
					    <div class="layui-col-md3">
					      <div class="layui-card">
					        <div class="layui-card-header layui-l-r">
					        	<b>{$vo.name}</b>
					    	</div>
					        <div class="layui-card-body">
					        	<p class="layui-l-r">
					        		<span>数量</span>
					        		<span><b>{$vo.count}</b>单</span>
					        	</p>
					        	<p class="layui-l-r">
					        		<span>线上</span>
					        		<span><b>{$vo.up}</b>单</span>
					        	</p>
					        	<p class="layui-l-r">
					        		<span>线下</span>
					        		<span><b>{$vo.down}</b>单</span>
					        	</p>
					        	<p class="layui-l-r">
					        		<span>有效订单:<b>{$vo.valid}</b>单</span>
					        		<span>无效订单:<b>{$vo.cancel}</b>单</span>
					        	</p>
					        	<p class="layui-l-r">
					        		<span>发票使用:<b>{$vo.invoice_company}</b>单</span>
					        		<span>占比:<b>
					        		<?php
					        		if($vo['valid']>0){
					        			echo round($vo['invoice_company'] / $vo['valid'], 2) * 100; 
					        		}else{
					        			echo 0;
					        		}
					        		?>%
					        		</b></span>

					        	</p>
					        	<p class="layui-l-r border-bottom-1px">
					        		<span>总金额</span>
					        		<span>￥<b>{$vo.price/100}</b></span>
					        	</p>
					        	<p class="layui-l-r">
					        		<span>订单数占比</span>
					        		<span>
					        			<?php 
					        			if($room_order['room_count']>0){
					        				echo round($vo['count'] / $room_order['room_count'], 3) * 100; 
					        			}else{
					        				echo 0;
					        			}
					        			?>%
					        		</span>
					        	</p>
					        	<p class="layui-l-r">
					        		<span>订单金额占比</span>
					        		<span>
					        			<?php 
					        			if($room_order['room_price']>0){
					        				echo round($vo['price'] / $room_order['room_price'], 6) * 100; 
					        			}else{
					        				echo 0;
					        			}
					        			?>%
					        		</span>
					        	</p>
					        </div>
					      </div>
					    </div>
					    {/volist}
					  </div>
				  </div>
				</fieldset>
				<fieldset class="layui-elem-field">
				  <legend>服务订单</legend>
				  <div class="layui-field-box">
				    <div class="layui-row layui-col-space15">
					   {volist name="service_order['service_data']" id="vo"}
					    <div class="layui-col-md3">
					      <div class="layui-card">
					        <div class="layui-card-header layui-l-r">
					        	<b>{$vo.name}</b>
					    	</div>
					        <div class="layui-card-body">
					        	<p class="layui-l-r">
					        		<span>数量</span>
					        		<span><b>{$vo.count}</b>单</span>
					        	</p>
					        	<p class="layui-l-r">
					        		<span>线上</span>
					        		<span><b>{$vo.up}</b>单</span>
					        	</p>
					        	<p class="layui-l-r">
					        		<span>线下</span>
					        		<span><b>{$vo.down}</b>单</span>
					        	</p>
					        	<p class="layui-l-r">
					        		<span>客房:<b>{$vo.book}</b>单</span>
					        		<span>餐饮:<b>{$vo.dining}</b>单</span>
					        	</p>
					        	<p class="layui-l-r">
					        		<span>24~02:<b><?=$vo['24~02']?></b>单</span>
					        		<span>02~04:<b><?=$vo['02~04']?></b>单</span>
					        	</p>
					        	<p class="layui-l-r">
					        		<span>04~06:<b><?=$vo['04~06']?></b>单</span>
					        		<span>06~08:<b><?=$vo['06~08']?></b>单</span>
					        	</p>
					        	<p class="layui-l-r">
					        		<span>08~10:<b><?=$vo['08~10']?></b>单</span>
					        		<span>10~12:<b><?=$vo['10~12']?></b>单</span>
					        	</p>
					        	<p class="layui-l-r">
					        		<span>12~14:<b><?=$vo['12~14']?></b>单</span>
					        		<span>14~16:<b><?=$vo['14~16']?></b>单</span>
					        	</p>
					        	<p class="layui-l-r">
					        		<span>16~18:<b><?=$vo['16~18']?></b>单</span>
					        		<span>18~20:<b><?=$vo['18~20']?></b>单</span>
					        	</p>
					        	<p class="layui-l-r">
					        		<span>20~22:<b><?=$vo['20~22']?></b>单</span>
					        		<span>22~24:<b><?=$vo['22~24']?></b>单</span>
					        	</p>
					        	<p class="layui-l-r border-bottom-1px">
					        		<span>总金额</span>
					        		<span>￥<b>{$vo.order_price/100}</b></span>
					        	</p>
					        	<p class="layui-l-r">
					        		<span>订单数占比</span>
					        		<span>
					        			<?php 
					        			if($service_order['service_count']>0){
					        				echo round($vo['count'] / $service_order['service_count'], 3) * 100; 
					        			}else{
					        				echo 0;
					        			}
					        			?>%
					        		</span>
					        	</p>
					        	<p class="layui-l-r">
					        		<span>订单金额占比</span>
					        		<span>
					        			<?php 
					        			if($service_order['service_price']>0){
					        				echo round($vo['order_price'] / $service_order['service_price'], 6) * 100; 
					        			}else{
					        				echo 0;
					        			}
					        			?>%
					        		</span>
					        	</p>
					        </div>
					      </div>
					    </div>
					    {/volist}
					  </div>
				  </div>
				</fieldset>
				<fieldset class="layui-elem-field">
				  <legend>商城订单</legend>
				  <div class="layui-field-box">
				    <div class="layui-row layui-col-space15">
					   {volist name="shop_order['shop_data']" id="vo"}
					    <div class="layui-col-md3">
					      <div class="layui-card">
					        <div class="layui-card-header layui-l-r">
					        	<b>{$vo.name}</b>
					    	</div>
					        <div class="layui-card-body">
					        	<p class="layui-l-r">
					        		<span>数量</span>
					        		<span><b>{$vo.count}</b>单</span>
					        	</p>
					        	<p class="layui-l-r">
					        		<span>有效订单:<b>{$vo.valid}</b>单</span>
					        		<span>无效订单:<b>{$vo.invalid}</b>单</span>
					        	</p>
					        	<p class="layui-l-r border-bottom-1px">
					        		<span>总金额</span>
					        		<span>￥<b>{$vo.price/100}</b></span>
					        	</p>
					        </div>
					      </div>
					    </div>
					    {/volist}
					  </div>
				  </div>
				</fieldset>
			</div>
		</div>
	</div>
</div>
<script src="/static/common/js/jquery.min.js"></script>
<script src="/static/layui/layui.all.js"></script>
<script>
	layui.use('laydate', function(){
  		var laydate = layui.laydate;
		laydate.render({
		   elem: '#selectDate'
		   ,type: 'month'
		   ,done: function(value, date, endDate){
		   	if(value){
		   		window.location.href = "<?=url('countData/index')?>?selectDate="+value;
		   	}
		  }
		});
  	})
</script>
</body>
</html>