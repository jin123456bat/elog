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
<link rel="stylesheet" href="/static/layui/css/layui.css" type="text/css" media="all" />
<style type="text/css">
.amap-marker .amap-icon img {
    width: 25px;
    height: 34px;
}
.layui-upload-img {
    width: 92px;
    height: 92px;
}
.tip_img{
	display: block;
    text-align: center;
    width: 100%;
    background: rgba(0,0,0,0.8);
    color: white;
    font-size: 12px;
}
.tip_del{
	position:absolute;
	top:0;
	left:0;
	display: none;
}
.tip_curr{
	position:absolute;
	bottom:0;
	left:0;
	display: none;
}
.tipBox{
	float: left;
	margin-left: 15px;
}
#pics{
	overflow: hidden;
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
					<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
					  <legend>添加房屋</legend>
					</fieldset>
					<form class="layui-form" action="">
					  	<input type="hidden" name="hotel_id" value="<?=Request::get('id')?>">
						<div class="layui-form-item">
						    <label class="layui-form-label">房屋名称</label>
						    <div class="layui-input-inline">
						      <input type="text" name="name" lay-verify="name" autocomplete="off" placeholder="请输入房屋名称" class="layui-input">
						    </div>
						</div>
						<div class="layui-form-item">
						    <label class="layui-form-label">月租金</label>
						    <div class="layui-input-inline">
						      <input type="number" name="price" min="1" lay-verify="price" autocomplete="off" placeholder="月租金" class="layui-input">
						    </div>
						    <div class="layui-form-mid layui-word-aux">元/月</div>
						    <div class="layui-form-mid"></div>
						    <div class="layui-input-inline">
						      <input type="number" name="server_price" min="1" lay-verify="server_price" autocomplete="off" placeholder="服务费" class="layui-input">
						    </div>
						    <div class="layui-form-mid layui-word-aux">元/月</div>
						</div>
						<div class="layui-form-item">
						    <label class="layui-form-label">结算期限</label>
						    <div class="layui-input-inline">
						      <input type="text" name="deadline" lay-verify="deadline" autocomplete="off" placeholder="如：‘月付、季付’" class="layui-input">
						    </div>
						    <div class="layui-form-mid layui-word-aux">示例：“2个月付”</div>
						</div>
						<div class="layui-form-item">
						    <label class="layui-form-label">租赁方式</label>
						    <div class="layui-input-block">
						      <input type="radio" name="room_mode" value="1" title="整租" checked="">
						      <input type="radio" name="room_mode" value="2" title="合租">
						    </div>
						</div>
						<div class="layui-form-item">
						    <div class="layui-inline">
						      <label class="layui-form-label">户型</label>
						      <div class="layui-input-inline" style="width: 100px;">
						        <input type="number" min="0" name="type_room" lay-verify="type_room" placeholder="室" autocomplete="off" class="layui-input">
						      </div>
						      <div class="layui-form-mid">-</div>
						      <div class="layui-input-inline" style="width: 100px;">
						        <input type="number" min="0" name="type_hall" lay-verify="type_hall" placeholder="厅" autocomplete="off" class="layui-input">
						      </div>
						      <div class="layui-form-mid">-</div>
						      <div class="layui-input-inline" style="width: 100px;">
						        <input type="number" min="0" name="type_toilet" lay-verify="type_toilet" placeholder="卫" autocomplete="off" class="layui-input">
						      </div>
						      <div class="layui-form-mid">-</div>
						      <div class="layui-input-inline" style="width: 100px;">
						        <input type="number" min="0" name="type_kitchen" lay-verify="type_kitchen" placeholder="厨" autocomplete="off" class="layui-input">
						      </div>
						    </div>
						</div>
						<div class="layui-form-item">
						    <label class="layui-form-label">楼层</label>
						    <div class="layui-input-inline" style="width: 100px;">
						        <input type="number" min="0" name="total_floor" lay-verify="total_floor" placeholder="总楼层" autocomplete="off" class="layui-input">
					      	</div>
					      	<div class="layui-form-mid">-</div>
					      	<div class="layui-input-inline" style="width: 100px;">
					        	<input type="number" min="0" name="curr_floor" lay-verify="curr_floor" placeholder="所在楼层" autocomplete="off" class="layui-input">
					      	</div>
						    <div class="layui-form-mid layui-word-aux">/层</div>
						</div>
						<div class="layui-form-item">
						    <label class="layui-form-label">房屋面积</label>
						    <div class="layui-input-inline">
						      <input type="text" min="0" name="room_area" lay-verify="room_area" autocomplete="off" placeholder="请输入房屋面积" class="layui-input">
						    </div>
						    <div class="layui-form-mid layui-word-aux">/㎡</div>
						</div>
						<div class="layui-form-item">
						    <label class="layui-form-label">可入住时间</label>
						    <div class="layui-input-inline">
						      <input type="text" min="0" name="in_room_date" lay-verify="in_room_date" autocomplete="off" value="随时入住" class="layui-input">
						    </div>
						    <div class="layui-form-mid layui-word-aux">日期格式：‘2018-09-10’,不填为随时入住</div>
						</div>
						<div class="layui-form-item">
						    <label class="layui-form-label">是否上线</label>
						    <div class="layui-input-block">
						      <input type="radio" name="status" value="1" title="上线" checked="">
						      <input type="radio" name="status" value="2" title="不上线">
						    </div>
						</div>
						<div class="layui-form-item">
						    <label class="layui-form-label">标签</label>
						    <div class="layui-input-inline">
						     <textarea placeholder="请输入房型标签" name="tag" id="tag" lay-verify='tag' class="layui-textarea"></textarea>
						    </div>
						     <div class="layui-form-mid layui-word-aux">
						     	如 “品牌家店,精装修等”,以英文逗号(“,”)隔开。
						     	<br>
						     	<br>
						    	快捷复制:“品牌家店,精装修,地铁沿线,专属客服,房屋清洁,智能门锁,品牌物业”</div>
						</div>
						<div class="layui-form-item">
						    <label class="layui-form-label">房屋设施</label>
						    <div class="layui-input-inline">
						     <textarea placeholder="请输入房屋设施" name="facility" id="facility" lay-verify='facility' class="layui-textarea"></textarea>
						    </div>
						     <div class="layui-form-mid layui-word-aux">
						     	如 “WIFI,电梯等”,以英文逗号(“,”)隔开。
						     	<br>
						     	<br>
						    	快捷复制:“WIFI,电梯,健身房,停车位,超市,厨房,电磁炉,橱柜,油烟机,洗衣机,烘干机,空调,冰箱,热水器,电视,微波炉,烤箱”</div>
						</div>
						<div class="layui-form-item">
						    <label class="layui-form-label">地址</label>
						    <div class="layui-input-inline layui-form" lay-filter="provinceBox">
						      <select id="province" name="province" lay-search="" lay-filter="province">
						        <option value="0"></option>
						      </select>
						    </div>
						    <div class="layui-input-inline layui-form" lay-filter="cityBox">
						      <select name="city" id="city" lay-search="" lay-filter="city">
						        <option value="0"></option>
						      </select>
						    </div>
						    <div class="layui-input-inline layui-form" lay-filter="zoneBox">
						      <select name="zone" id="zone" lay-search="" lay-filter="zone">
						        <option value="0"></option>
						      </select>
						    </div>
						    <div class="layui-input-inline">
						      <input type="text" min="0" name="address" autocomplete="off" placeholder="商圈/区域/小区" class="layui-input" id="tipinput">
						    </div>
						     <div class="layui-form-mid layui-word-aux">找不到？可试试输入搜索！</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">商圈/街道/社区</label>
							<div class="layui-input-inline layui-form">
						      	<input type="text" name="businessArea" lay-verify="businessArea" autocomplete="off" placeholder="商圈" class="layui-input">
							</div>
							<div class="layui-input-inline layui-form">
						      	<input type="text" name="township" lay-verify="township" autocomplete="off" placeholder="街道" class="layui-input">
							</div>
							<div class="layui-input-inline layui-form">
						      	<input type="text" name="neighborhood" lay-verify="neighborhood" autocomplete="off" placeholder="社区" class="layui-input">
							</div>
							<div class="layui-form-mid layui-word-aux">搜索完成之后或点击地图可自动获取"商圈/街道"信息</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">选择地址</label>
							<div class="layui-input-inline layui-form">
								<div id="Amap" style="width:1000px;height: 600px;"></div>
							</div>
						</div>
						<div class="layui-form-item">
						  	<div class="layui-upload" style="padding: 9px 40px;">
							  <button type="button" class="layui-btn layui-btn-normal" id="hotel_pic"><i class="layui-icon">&#xe681</i>上传图片</button> 
							  <blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;margin-left: 70px;width: 64.5%;">
							    预览图：
							    <div class="layui-upload-list" id="pics"></div>
							 </blockquote>
							</div>
						</div>
						<div class="layui-form-item layui-form-text">
					   	 	<label class="layui-form-label">房屋介绍</label>
					    	<div class="layui-input-block" style="width: 61.2%;">
					      		<textarea placeholder="请输入房屋介绍" name="descript" id="descript" lay-verify='descript' class="layui-textarea"></textarea>
					    	</div>
					  	</div>
						<div class="layui-form-item">
						    <div class="layui-input-block">
						      <button class="layui-btn layui-btn-normal" id="addTypes" lay-submit="" lay-filter="addTypes">立即提交</button>
						</div>
						</div>
						<input type="hidden" name="lat" value="">
						<input type="hidden" name="lng" value="">
						<input type="hidden" name="logo_url" value="">
						<input type="hidden" name="plot" value="">
					</form>
				</div>
			</div>
		</div>
	</div>
	{include file='common/footer' /}
	<!-- 通用js -->
<script src="/static/layui/layui.all.js"></script>
<script type="text/javascript" src="<?=assets::common('jquery.min.js','js')?>"></script>
<script type="text/javascript" src="<?=assets::common('city.js','js')?>"></script>
<script type="text/javascript" src="https://webapi.amap.com/maps?v=1.4.10&key=<?=Config::pull('map')['amap']['webjs']?>&plugin=AMap.Autocomplete,AMap.PlaceSearch,AMap.Geocoder"></script>
<script>
	layui.use('form', function(){
	 	var form = layui.form;
		var hotel_id = $("input[name=hotel_id]").val();
		if(hotel_id==false){
			layer.confirm('请先选择酒店', {
			  btn: ['好的'] //按钮
			}, function(){
			  window.location.href="<?=url('LongRent/index')?>";
			});
			$(":input").attr('disabled',true);
		}
	 	//选择省份
	  	getProvince(form,'<?=url('common/LongRentApi/getProvince')?>','province');
		//选择省份
		form.on('select(province)', function(data){
			var province_id = data.value;
			getCity(form,'<?=url('common/LongRentApi/getCity')?>',province_id,'city');
		});
		//选择城市
		form.on('select(city)', function(data){
			auto.setCity($(data.elem).find('option:selected').html());
			var city_id = data.value;
			getZone(form,'<?=url('common/LongRentApi/getZone')?>',city_id,'zone');
		});
		//表单验证
		form.verify({
		  hotel_id:function(value, item){ 
		    if(value==0){
		    	return '请选择所属酒店！';
		    }
		  },
		  name:function(value,item){
		  	if(!value){
		    	return '请填写房型名称！';
		    }
		  },
		  price:function(value,item){
		  	if(!value){
		    	return '请填写月租金！';
		    }
		  },
		  server_price:function(value,item){
		  	if(!value){
		    	return '请填写月服务费！';
		    }
		  },
		  type_room:function(value,item){
		  	if(!value){
		    	return '请填写户型-室！';
		    }
		  },
		  type_hall:function(value,item){
		  	if(!value){
		    	return '请填写户型-厅！';
		    }
		  },
		  type_toilet:function(value,item){
		  	if(!value){
		    	return '请填写户型-卫！';
		    }
		  },
		  type_kitchen:function(value,item){
		  	if(!value){
		    	return '请填写户型-厨！';
		    }
		  },
		  total_floor:function(value,item){
		  	if(!value){
		    	return '请填写总楼层！';
		    }
		  },
		  curr_floor:function(value,item){
		  	if(!value){
		    	return '请填写所在楼层！';
		    }
		  },
		  room_area:function(value,item){
		  	if(!value){
		  		return '请填写房屋面积！';
		  	}
		  },
		  in_room_date:function(value,item){
		  	if(!value){
		  		return '请填写可入住时间！';
		  	}
		  },
		  tag:function(value,item){
		  	if(!value){
		  		return '请填写标签！';
		  	}
		  },
		  facility:function(value,item){
		  	if(!value){
		  		return '请填写设施！';
		  	}
		  },
		  province:function(value,item){
		  	if(value==0){
		    	return '请选择省份！';
		    }
		  },
		  city:function(value,item){
		  	if(value==0){
		    	return '请选择城市！';
		    }
		  },
		  zone:function(value,item){
		  	if(value==0){
		    	return '请选择县/区！';
		    }
		  },
		  address:function(value,item){
		  	if(value==0){
		    	return '请填写详细地址！';
		    }
		  },
		  descript:function(value,item){
		  	if(value==0){
		    	return '请填写房屋介绍！';
		    }
		  },
		  businessArea:function(value,item){
		  	if(value==0){
		    	return '请填写商圈信息！';
		    }
		  },
		  township:function(value,item){
		  	if(value==0){
		    	return '请填写街道信息！';
		    }
		  }
		});
		//监听提交
	  	form.on('submit(addTypes)', function(data){
	  		if(data.field.hasOwnProperty('logo_id')==false){
	  			layer.msg('请设置封面图！');
	  			return false;
	  		}
	  		var pic_str = '';
	  		$("input[name=logos]").each(function(k,v){
				pic_str += $(v).val()+',';
			})

			if(pic_str.length<1){
				layer.msg('请上传图片！');
	  			return false;
			}
			data.field.logos = pic_str;
			var province = $("#province option:selected").html();
			var city = $("#city option:selected").html();
			var zone = $("#zone option:selected").html();
			data.field.plot = data.field.address;
			data.field.address = province+city+zone+data.field.address;
			data.field.site = data.field.address;
			data.field.logo_url = $("input[name=logo_url]").val();
	    	//表单提交
	    	$.ajax({
	    		type:"post",
	    		url:"<?=url('common/LongRentApi/addTypes')?>",
	    		data:{post:JSON.stringify(data.field)},
	    		dataType:'json',
	    		success:function(res){
	    			if(res.code==0){
	    				layer.msg(res.message);
	    				setTimeout(function(){
	    					location.reload();
	    				},2000);
	    			}else{
	    				layer.msg(res.message);
	    			}
	    		},
	    		error:function(res){
	    			layer.alert('系统故障！');
	    		}
	    	})
	    	return false;
	  	});
	});
	//上传
	upload('<?=url('common/component/upload')?>');
</script>
<script type="text/javascript">
	  //地图加载
    var map = new AMap.Map("Amap", {
        resizeEnable: true
    });
    //输入提示
    var autoOptions = {
        input: "tipinput",
        citylimit: true
    };
    var auto = new AMap.Autocomplete(autoOptions);
    var placeSearch = new AMap.PlaceSearch({
        map: map,
    });
    //点击标记
    placeSearch.on('markerClick',function(e){

    	var address = e.data.address;
    	var lat = e.data.location.lat;
    	var lng = e.data.location.lng;
    	writeCoordinate(lat,lng);
    	getAddress(lng,lat);
    });

    //构造地点查询类
    AMap.event.addListener(auto, "select", function(e){
    	placeSearch.setCity(e.poi.adcode);
        placeSearch.search(e.poi.name);
        var lat = e.poi.location.lat;
        var lng = e.poi.location.lng;
        writeCoordinate(lat,lng);
        getAddress(lng,lat);
    });

    var marker = null;
    //点击地图
    map.on('click', function(e){
    	if($("#province option:selected").val()==false || $("#city option:selected").val()==false || $("#zone option:selected").val()==false){
    		layer.msg('请先选择城市！');
    		return false;
    	}
    	var lng = e.lnglat.getLng();
    	var lat = e.lnglat.getLat();
    	writeCoordinate(lat,lng);
    	getAddress(lng,lat);
    	if (marker!=null) {
    		marker.setMap(null);
    	}
		marker = new AMap.Marker({
            icon: "//a.amap.com/jsapi_demos/static/demo-center/icons/poi-marker-default.png",
            position: [e.lnglat.getLng(),e.lnglat.getLat()],
            offset: new AMap.Pixel(-13, -30)
        });
        marker.setMap(map);
        marker.on('click',function(ev){
        	lng = ev.lnglat.getLng();
    		lat = ev.lnglat.getLat();
    		writeCoordinate(lat,lng);
    		getAddress(lng,lat);
	    })
    });
    //写入坐标
    function writeCoordinate(lat,lng){
    	$("input[name=lat]").val(lat);
		$("input[name=lng]").val(lng);
		layer.msg('更新坐标成功！');
    }
    //通过坐标获取详细地址
    function getAddress(lng,lat){
    	
    	if($("#city option:selected").val()==false){
    		layer.msg('请先选择城市！');
    		return false;
    	}

    	var geocoder = new AMap.Geocoder({
            city: $("#city option:selected").html(), 
            radius: 500
        });
    	geocoder.getAddress(new AMap.LngLat(lng,lat),function(stauts,e){
    		var businessAreas = e.regeocode.addressComponent.businessAreas;
    		//商圈
    		var businessArea_str = '';
    		//社区名称
    		var neighborhood = e.regeocode.addressComponent.neighborhood;
    		//社区类型
    		var neighborhoodType = e.regeocode.addressComponent.neighborhoodType;
    		//街道
    		var street = e.regeocode.addressComponent.street;
    		//镇区
    		var township = e.regeocode.addressComponent.township;
    		for(var i in businessAreas){
    			businessArea_str += businessAreas[i]['name']+',';
    		}
    		$("input[name='businessArea']").val(businessArea_str);
    		$("input[name='neighborhood']").val(neighborhood);
    		$("input[name='neighborhoodType']").val(neighborhoodType);
    		$("input[name='street']").val(street);
    		$("input[name='township']").val(township);
    	})
    }
</script>
</body>
</html>