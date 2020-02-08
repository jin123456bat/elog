<?php
use jin123456bat\assets;
use think\facade\Request;
use jin123456bat\helper;
use jin123456bat\companyController;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title><?=$setting['site_title']?> | <?=$setting['site_desc']?></title>
  <link rel="stylesheet" href="/static/layui/css/layui.css" type="text/css" media="all" />
  <!-- 所有页面使用的样式 -->
  <link rel="stylesheet" href="<?=assets::css('main.css')?>"type="text/css" media="all" />
  <style type="text/css">
  	.blue{
  		color: #1E9FFF;
  	}
  	.layui-layer-demo{background-color:#eee;width: 350px;height: 200px;}
	.layui-layer-demo .layui-layer-title{border:none; background-color:#333; color:#fff; height: auto!important;line-height: unset!important;}
	.layui-layer-demo div{
		padding: 10px;
		box-sizing: border-box;
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
				<div class="layui-row">
				    <div class="layui-col-xs10">
				      	<div class="layui-input-inline" style="width: 300px;">
					        <input type="text" name="orderno" autocomplete="off" class="layui-input" placeholder="订单号\微信名\收货人\手机查询">
					    </div>
					    <button class="layui-btn layui-btn-normal" id="seachOrder"><i class="layui-icon">&#xe615;</i>搜索</button>
					    <button class="layui-btn layui-btn-normal" onclick="window.location.href=''"><i class="layui-icon">&#xe669;</i>刷新</button>
						<?php if (companyController::checkButtonPrivilege('expOrder')){?>
					    <button class="layui-btn layui-btn-normal" id="exp" title="expOrder"><i class="layui-icon">&#xe655;</i>导出</button>
						<?php }?>
					</div>
					<div class="layui-row">
						<table class="layui-hide" id="shopGift" lay-filter="shopGift"></table>
					</div>
				</div>
			</div>
		</div>
  	</div>
  </div>
</body>
<script src="/static/common/js/jquery.min.js"></script>
<script src="/static/layui/layui.all.js"></script>
<script type="text/javascript">
var shipno = 0;
layui.config({
	base: '/static/layui/layui_exts/',
}).extend({
    excel: 'excel',
});
layui.use(['table', 'excel','laydate'], function(){
	
	var table = layui.table;
	var excel = layui.excel;
	var laydate = layui.laydate;

	table.render({
	    elem: '#shopGift'
	    ,url:'<?=url('ShopOrder/orders')?>'
	    ,parseData: function(res){
		    return {
		      "code": res.code, 
		      "msg": res.message, 
		      "data": res.data,
		      'count':res.total
		    };
		}
		,page:{
	    	theme: '#1E9FFF',
	    	limit:20
	    }
	    ,cols: [[
	      {field:'orderno', width:'10%', title: '订单号', sort: true,align:'center'}
	      ,{field:'user_nickname', width:'7%', title: '微信名',templet:'#user_nickname',align:'center'}
	      ,{field:'details', width:'15%', title: '购买的商品',templet:'#details',align:'center'}
	      ,{field:'gift', width:'15%', title: '赠送礼品',templet: '#gift',align:'center'}
	      ,{field:'address_info', width:'15%', title: '收货信息',templet: '#address_info',align:'center'}
	      ,{field:'actual_price', width:'5%', title: '金额',templet:'#actual_price',align:'center'}
	      ,{field:'ship_price', width:'5%', title: '运费',templet: '#ship_price',align:'center'}
	      ,{field:'createtime', width:'10%', title: '下单时间',align:'center'}
	      ,{field:'status', width:'8%', title: '状态/支付',templet: '#status',align:'center'}
	      ,{field:'stting', width:'10%', title: '操作',templet: '#setting',align:'center'}
	    ]]
	});

	$("#seachOrder").click(function(){

  		var orderno = $('input[name="orderno"]').val();
  		if(orderno){
  			table.reload('shopGift', {
		      where: {
		          orderno:orderno
		        }
	      });
  		}
  	})
  	var expDate = "<div>";
  	expDate += '<div><span>日期:</span><input type="text" class="layui-input" id="expDate" placeholder="选择日期"><div/>';
  	expDate += '</div>';
  	$("#exp").click(function(){
  		layer.open({
		  type: 1,
		  skin: 'layui-layer-demo', //样式类名
		  closeBtn: 0, //不显示关闭按钮
		  anim: 2,
		  shadeClose: true, //开启遮罩关闭
		  content: expDate
		});
		//日期范围
		laydate.render({
		    elem: '#expDate'
		    ,range: '~'
		    ,theme: '#393D49'
		    ,min:-100
		    ,max: 0
		    ,done: function(value, date, endDate){
			   if(value){
			   		$.ajax({
			  			type:'post',
			  			url:"<?=url('shopOrder/expOrder')?>",
			  			data:{date:value},
			  			dataType:'json',
			  			success:function(res){
			  				if(res.code==0){
			  					res.data.unshift({
			  						orderno: '订单号',
			  						pay_no: '交易单号', 
			  						user_nickname: '微信名',
			  						name: '收件人姓名',
			  						mobile: '收件人电话',
			  						order_price:'商品总金额',
			  						ship_price:'运费',
			  						coupon_price:'优惠金额',
			  						actual_price:'实付金额',
			  						details:'购买详情',
			  						gift:'赠送礼品',
			  						province_name:'配送省份',
			  						city_name:'配送城市',
			  						zone_name:'配送县区',
			  						address:'详细地址',
			  						pay_status:'支付状态',
			  						status:'订单状态',
			  						ship_type:'发货状态',
			  						take_shop:'收货状态',
			  						quit_shop:'退货状态',
			  						pay_time:'支付时间',
			  						createtime:'订单创建时间',
			  					});
			  					var data = excel.filterExportData(res.data, [
					                'orderno',
					                'pay_no',
					                'user_nickname',
					                'name',
					                'mobile',
					                'order_price',
					                'ship_price',
					                'coupon_price',
					                'actual_price',
					                'details',
					                'gift',
					                'province_name',
					                'city_name',
					                'zone_name',
					                'address',
					                'pay_status',
					                'status',
					                'ship_type',
					                'take_shop',
					                'quit_shop',
					                'pay_time',
					                'createtime',
					            ]);
					            excel.exportExcel({
					                sheet1: data
					            }, value+'.xlsx', 'xlsx');
			  					layer.closeAll();
			  				}else{
			  					layer.alert(res.message);
			  				}
			  			}
			  		})
			   }
			}
		});
  	})
	//监听事件
  	table.on('tool(shopGift)', function(obj){

	  var data = obj.data;
	  var layEvent = obj.event; 
	  var tr = obj.tr;
	  //删除
	  if(layEvent === 'del'){
	  	$.ajax({
	  		type:'post',
	  		url:"<?=url('ShopGift/delGift')?>",
	  		data:{id:data.id},
	  		dataType:'json',
	  		success:function(res){
	  			if(res.code==0){
	  				obj.del();
	  			}
	  			layer.msg(res.message);
	  		}
	  	})
	  }
	  if(layEvent === 'goShop'){
	  	layer.prompt({title: '请输入快递单号', formType: 3}, function(pass, index){
	  		if(pass){
		  		layer.close(index);
	  			shipno = pass;
	  			layer.prompt({title: '请输入快递公司名称', formType: 3}, function(ship_company, index){
	  				$.ajax({
		  				type:'post',
		  				url:'<?=url("ShopOrder/goShop")?>',
		  				data:{
		  					shipno:shipno,
		  					orderno:data.orderno,
		  					ship_company:ship_company
		  				},
		  				dataType:'json',
		  				success:function(res){
		  					if(res.code==0){
		  						setTimeout(function(){
		  							window.location.href = "";
		  						},1100);
		  					}
		  					layer.alert(res.message);
		  				},error:function(res){
		  					layer.alert('网络故障！');
		  				}
		  			})
	  			});
	  		}
		});
	  }
	  if(layEvent ==='cancelShop'){
	  	layer.confirm('请选择退款方式！', {
		  btn: ['全额退款','部分退款'] //按钮
		}, function(){
			cancel(data.orderno);
		}, function(){
			layer.prompt({title: '请输入退款金额！', formType: 3}, function(pass, index){
				if(pass){
					cancel(data.orderno,pass)
				}
			});
		});
	  }
	  if(layEvent === 'turnCancelShop'){
	  	layer.prompt({title: '请输入拒绝原因！', formType: 2}, function(pass, index){
	  		if(pass){
	  			$.ajax({
	  				type:'post',
	  				url:'<?=url("ShopOrder/turn_cancel")?>',
	  				data:{desc:pass,orderno:data.orderno},
	  				dataType:'json',
	  				success:function(res){
	  					if(res.code==0){
	  						setTimeout(function(){
	  							window.location.href = "";
	  						},1100);
	  					}
	  					layer.alert(res.message);
	  				},error:function(res){
	  					layer.alert('网络故障！');
	  				}
	  			})
	  		}
		  layer.close(index);
		});
	  }
	  if(layEvent === 'turnQuitShop'){
	  	layer.prompt({title: '请输入拒绝原因！', formType: 2}, function(pass, index){
	  		if(pass){
	  			$.ajax({
	  				type:'post',
	  				url:'<?=url("ShopOrder/turn_quit")?>',
	  				data:{desc:pass,orderno:data.orderno},
	  				dataType:'json',
	  				success:function(res){
	  					if(res.code==0){
	  						setTimeout(function(){
	  							window.location.href = "";
	  						},1100);
	  					}
	  					layer.alert(res.message);
	  				},error:function(res){
	  					layer.alert('网络故障！');
	  				}
	  			})
	  		}
		  layer.close(index);
		});
	  }
	  if(layEvent ==='quitShop'){
	  	layer.confirm('请选择退款方式！', {
		  btn: ['全额退款','部分退款'] //按钮
		}, function(){
			cancel(data.orderno,data.pay_price/100,1);
		}, function(){
			layer.prompt({title: '请输入退款金额！', formType: 3}, function(pass, index){
				if(pass){
					cancel(data.orderno,pass,1)
				}
			});
		});
	  }
	});

});
//取消订单
function cancel(orderno,price=0,type=0){
	$.ajax({
		type:'post',
		url:'<?=url("ShopOrder/cancel")?>',
		data:{
			orderno:orderno,
			refund_price:price,
			type:type
		},
		dataType:'json',
		success:function(res){
			if(res.code==0){
				setTimeout(function(){
					window.location.href = "";
				},1100);
			}
			layer.alert(res.message);
		},error:function(res){
			layer.alert('网络故障！');
		}
	})
}
</script>
<script type="text/html" id="user_nickname">
	<a href="#" class="blue">{{d.user_nickname}}</a>
</script>
<script type="text/html" id="actual_price">
	{{#  if(d.actual_price){ }}
	<a href="#" class="blue">￥{{d.actual_price/100}}</a>
	{{#  }else{ }}
	<a href="#" class="blue">{{d.order_score}}</a> 积分
	{{#  } }}
</script>
<script type="text/html" id="ship_price">
	<a href="#" class="blue">￥{{d.ship_price/100}}</a>
</script>
<script type="text/html" id="status">
	{{#  if(d.status==1){ }}
		<button class="layui-btn layui-btn-xs layui-btn-normal">有效</button>
	{{#  }else if(d.status==0){ }}
		<button class="layui-btn layui-btn-xs layui-btn-danger">已取消</button>
	{{#  }else if(d.status==2){ }}
		<button class="layui-btn layui-btn-xs layui-btn-danger">申请取消</button>
	{{#  }else if(d.status==3){ }}
		<button class="layui-btn layui-btn-xs layui-btn-danger">已取消</button>
	{{#  } }} 
	{{#  if(d.pay_status==0){ }}
		<button class="layui-btn layui-btn-xs layui-btn-normal">未支付</button>
	{{#  }else if(d.pay_status==1){ }}
		{{# if(d.is_comment==1 ){ }}
			<button class="layui-btn layui-btn-xs layui-btn-normal">已评价</button>
		{{# }else if(d.quit_shop==1){ }}
			<button class="layui-btn layui-btn-xs layui-btn-danger">已退货</button>
		{{# }else{ }}
			<button class="layui-btn layui-btn-xs layui-btn-normal">已支付</button>
		{{#  } }} 
	{{#  }else if(d.pay_status==-1){ }}
		<button class="layui-btn layui-btn-xs layui-btn-normal">部分退款</button>
	{{#  }else if(d.pay_status==-2){ }}
		<button class="layui-btn layui-btn-xs layui-btn-normal">全部退款</button>
	{{#  } }}
</script>
<script type="text/html" id="setting">
	{{#  if(d.status==1 && d.pay_status==1){ }}

		{{# if(d.ship_type==0 && d.take_shop==0){ }}
			<?php if (companyController::checkButtonPrivilege('goShop')){?>
			<button class="layui-btn layui-btn-xs layui-btn-normal" lay-event="goShop" title="goShop">发货</button>
			<?php }?>
		{{#  } }}

		{{# if(d.ship_type==1 && d.take_shop==0 && d.quit_shop==4){ }}
			<?php if (companyController::checkButtonPrivilege('quitShop')){?>
			<button class="layui-btn layui-btn-xs layui-btn-danger" lay-event="quitShop" title="quitShop">同意退货</button>
			<?php }?>

			<?php if (companyController::checkButtonPrivilege('turnQuitShop')){?>
			<button class="layui-btn layui-btn-xs layui-btn-normal" lay-event="turnQuitShop" title="turnQuitShop">拒绝退货</button>
			<?php }?>

		{{#  } }}

	{{#  }else }}

	{{# if(d.pay_status==1 && d.status==2){ }}
			<?php if (companyController::checkButtonPrivilege('cancelShop')){?>
			<button class="layui-btn layui-btn-xs layui-btn-danger" lay-event="cancelShop" title="cancelShop">同意取消</button>
			<?php }?>
			<?php if (companyController::checkButtonPrivilege('turnCancelShop')){?>
			<button class="layui-btn layui-btn-xs layui-btn-normal" lay-event="turnCancelShop" title="turnCancelShop">拒绝取消</button>
			<?php }?>

	{{#  } }}
</script>
<script type="text/html" id="details">
	  {{#  layui.each(d.details, function(index, item){ }}
	      <span class="blue">{{item.goods_name}}</span>
	      <span>({{ item.sku}}X{{ item.num }},{{item.sku_price/100*item.num || item.sku.sku_score*item.num }}{{# if(item.sku_price){ }}元{{# }else{ }}积分{{# } }})</span>
	  {{#  }); }}
	  {{#  if(d.details === 0){ }}
	    无商品
	  {{#  } }} 
</script>
<script type="text/html" id="gift">
	  {{#  if(d.gift || d.gift){ }}
		  {{#  layui.each(d.gift.coupon, function(index, item){ }}
		      <span class="blue">{{item}}</span>
		      <span></span>
		  {{#  }); }}
		   {{#  layui.each(d.gift.voucher, function(index, item){ }}
		      <span class="blue">,{{item}}</span>
		      <span></span>
		  {{#  }); }}
	  {{#  }else{ }}
	  无赠送礼品
	  {{#  } }} 
</script>
<script type="text/html" id="address_info">
	  {{#  if(d.ship_user && d.ship_mobile && d.ship_address_info){ }}
	     <span>{{d.ship_user}}</span>
	     <span>{{d.ship_mobile}}</span>
	     <span>{{d.ship_address_info}}</span>
	  {{#  }else{ }}
	    无
	  {{#  } }} 
</script>
</body>
</html>