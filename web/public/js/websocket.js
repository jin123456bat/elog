var setInc = function(tab,step)
{
	step = step||1;
	
	var obj = $('a.tab-title[href="#'+tab+'"] .tab-title-label');
	var num = parseInt(obj.html());
	num += step;
	obj.html(num);
	if(num>0)
	{
		obj.removeClass('display-none');
	}
	else
	{
		obj.addClass('display-none');
	}
}

// 播放
function audio(type) {
	var url = '/static/hotel/classic/voice/'+type+'.mp3';
	Audio.play(url,3);
}

var websocket = function(){
	var socket = io('https://'+window.location.host+':2120');
	
	//出现重连重新推送登陆消息
	var login_info = [];
	socket.on('connect', function(){
		$.each(login_info,function(k,v){
			socket.emit('login', v);
		})
	});
	
	return {
		socket:socket,
		join:function(company_id,hotel_id,type,param){
			var data = {
				type:type,
				company_id:company_id,
				hotel_id:hotel_id,
			};
			
			for(var i in param)
			{
				data[i] = param[i];
			}
			
			uid = JSON.stringify(data);
			
			if($.inArray(uid,login_info) == -1)
			{
				login_info.push(uid);
				socket.emit('login', uid);
			}
		},
		on:function(message_type,callback){
			socket.on(message_type,callback);
		},
		listen:function(){
			return {
				order:function(){
					
					var is_room_page = function(){
						return window.location.pathname.indexOf('/hotel/room_order/index')!=-1;
					}
					
					var is_service_page = function(){
						return window.location.pathname.indexOf('/hotel/service_order/index')!=-1;
					}
					
					var is_food_page = function(){
						return window.location.pathname.indexOf('/hotel/food_order/index')!=-1;
					}
					
					socket.on('room_order/sure/create', function(response){
						//播放订单提示
						audio('sure');
						
						var config={
							title:'住房订单通知',//通知标题部分  默认 新消息   可选
							icon:'/favicon.ico',//图标
							content:'您有一个新的住房订单，请及时处理',//通知内容部分
							click:function(){//监听点击通知   data:可传递参数 可选
								redict('/hotel/room_order/index');
							},
						}
						//桌面通知
						new dToast(config);

						//数据+1
						if(is_room_page())
						{
							if($('#sure').hasClass('active'))
							{
								sure.prependByPk([{
						        	key:'orderno',
						        	value:response
						        }]);
							}
							//数字+1
							setInc('sure');
						}
					}).on('room_order/sure/delete', function(response){
						//数据-1
						if(is_room_page())
						{
							if($('#sure').hasClass('active'))
							{
								sure.removeByPk([{
						        	key:'orderno',
						        	value:response
						        }]);
							}
							//数字-1
							setInc('sure',-1);
						}
					}).on('room_order/quit/create', function(response){
						audio('quit');
						
						var config={
							title:'住房订单通知',//通知标题部分  默认 新消息   可选
							content:'有一个住房订单申请取消，请及时处理',//通知内容部分
							icon:'/favicon.ico',//图标
							click:function(){//监听点击通知   data:可传递参数 可选
								redict('/hotel/room_order/index');
							},
						}
						//桌面通知
						new dToast(config);
					   
						if(is_room_page())
						{
							//数据+1
							if($('#quit').hasClass('active'))
							{
								quit.prependByPk([{
						        	key:'orderno',
						        	value:response
						        }]);
							}
							//数字+1
							setInc('quit');
						}
					}).on('room_order/quit/delete', function(response){
						//数据-1
						if(is_room_page())
						{
							if($('#quit').hasClass('active'))
							{
								quit.removeByPk([{
						        	key:'orderno',
						        	value:response
						        }]);
							}
							//数字-1
							setInc('quit',-1);
						}
					}).on('room_order/notcheckin/create',function(response){
						if(is_room_page())
						{
							if($('#notcheckin').hasClass('active'))
							{
								notcheckin.prependByPk([{
						        	key:'orderno',
						        	value:response
						        }]);
							}
							//数字+1
							setInc('notcheckin');
						}
					}).on('room_order/notcheckin/delete',function(response){
						if(is_room_page())
						{
							if($('#notcheckin').hasClass('active'))
							{
								notcheckin.removeByPk([{
						        	key:'orderno',
						        	value:response
						        }]);
							}
							//数字+1
							setInc('notcheckin',-1);
						}
					}).on('room_order/checkin/create', function(response){
						//数据+1
						if(is_room_page())
						{
							if($('#checkin').hasClass('active'))
							{
								checkin.prependByPk([{
						        	key:'orderno',
						        	value:response
						        }]);
							}
							//数字+1
							setInc('checkin');
						}
					}).on('room_order/checkin/delete', function(response){
						//数据-1
						if(is_room_page())
						{
							if($('#checkin').hasClass('active'))
							{
								checkin.removeByPk([{
						        	key:'orderno',
						        	value:response
						        }]);
							}
							//数字-1
							setInc('checkin',-1);
						}
					}).on('room_order/checkout/create', function(response){
						//数据+1
						if(is_room_page())
						{
							if($('#checkout').hasClass('active'))
							{
								checkout.prependByPk([{
						        	key:'orderno',
						        	value:response
						        }]);
							}
							//数字+1
							setInc('checkout');
						}
					}).on('room_order/checkout/delete', function(response){
						//数据-1
						if(is_room_page())
						{
							if($('#checkout').hasClass('active'))
							{
								checkout.removeByPk([{
						        	key:'orderno',
						        	value:response
						        }]);
							}
							//数字-1
							setInc('checkout',-1);
						}
					}).on('service_order/response/create', function(res){
				    	//服务订单
						audio('service');
				    	
				    	var config={
							title:'服务订单通知',//通知标题部分  默认 新消息   可选
							content:'您有一个新的服务订单，请及时处理',//通知内容部分
							icon:'/favicon.ico',//图标
							click:function(){//监听点击通知   data:可传递参数 可选
								redict('/hotel/service_order/index');
							},
						}
						//桌面通知
						new dToast(config);
				    	
				    	if(is_service_page())
						{
				    		if($('#all').hasClass('active'))
							{
				        		all.prependByPk([{
				    	        	key:'orderno',
				    	        	value:res
				    	        }]);
							}
				    		
				    		//数据+1
				    		if($('#response').hasClass('active'))
				    		{
				    			response_table.prependByPk([{
				    	        	key:'orderno',
				    	        	value:res
				    	        }]);
				    		}
				    		//数字+1
				    		setInc('response');
						}
				    }).on('service_order/response/delete', function(res){
				    	if(is_service_page())
				    	{
					    	//数据-1
							if($('#response').hasClass('active'))
							{
								response_table.removeByPk([{
						        	key:'orderno',
						        	value:res
						        }]);
							}
							//数字-1
							setInc('response',-1);
				    	}
				    }).on('service_order/finish/create', function(response){
				    	if(is_service_page())
				    	{
				    		if($('#all').hasClass('active'))
							{
				        		all.prependByPk([{
				    	        	key:'orderno',
				    	        	value:response
				    	        }]);
							}
				    		
					    	//数据+1
							if($('#finish').hasClass('active'))
							{
								finish.prependByPk([{
						        	key:'orderno',
						        	value:response
						        }]);
							}
							//数字+1
							setInc('finish');
				    	}
				    }).on('service_order/finish/delete', function(response){
				    	if(is_service_page())
				    	{
				    		//数据-1
							if($('#finish').hasClass('active'))
							{
								finish.removeByPk([{
						        	key:'orderno',
						        	value:response
						        }]);
							}
							//数字-1
							setInc('finish',-1);
				    	}
				    }).on('service_order/quit/create', function(response){
				    	audio('quit');
				    	
				    	var config={
							title:'服务订单通知',//通知标题部分  默认 新消息   可选
							content:'有一个新的服务订单申请取消，请及时处理',//通知内容部分
							icon:'/favicon.ico',//图标
							click:function(){//监听点击通知   data:可传递参数 可选
								redict('/hotel/service_order/index');
							},
						}
						//桌面通知
						new dToast(config);
				    	
				    	if(is_service_page())
						{
				    		if($('#all').hasClass('active'))
							{
				        		all.prependByPk([{
				    	        	key:'orderno',
				    	        	value:response
				    	        }]);
							}
				    		
				    		//数据+1
				    		if($('#quit').hasClass('active'))
				    		{
				    			quit.prependByPk([{
				    	        	key:'orderno',
				    	        	value:response
				    	        }]);
				    		}
				    		//数字+1
				    		setInc('quit');
						}
				    	
				    }).on('service_order/quit/delete', function(response){
				    	if(is_service_page())
				    	{
				    		//数据-1
				    		if($('#quit').hasClass('active'))
				    		{
				    			quit.removeByPk([{
				    	        	key:'orderno',
				    	        	value:response
				    	        }]);
				    		}
				    		//数字-1
				    		setInc('quit',-1);
				    	}
				    }).on('service_order/evaluate/create',function(response){
				    	if(is_service_page())
				    	{
				    		//数据-1
				    		if($('#evaluate').hasClass('active'))
				    		{
				    			evaluate.prependByPk([{
				    	        	key:'orderno',
				    	        	value:response
				    	        }]);
				    		}
				    		//数字+1
				    		setInc('evaluate');
				    	}
				    }).on('service_order/evaluate/delete',function(response){
				    	if(is_service_page())
				    	{
				    		//数据-1
				    		if($('#evaluate').hasClass('active'))
				    		{
				    			evaluate.removeByPk([{
				    	        	key:'orderno',
				    	        	value:response
				    	        }]);
				    		}
				    		//数字-1
				    		setInc('evaluate',-1);
				    	}
				    }).on('food_order/sure/create', function(res){
				    	audio('food');
				    	
				    	var config={
							title:'餐饮订单通知',//通知标题部分  默认 新消息   可选
							content:'您有一个新的餐饮订单，请及时处理',//通知内容部分
							icon:'/favicon.ico',//图标
							click:function(){//监听点击通知   data:可传递参数 可选
								redict('/hotel/food_order/index');
							},
						}
						//桌面通知
						new dToast(config);
				    	
				    	if(is_food_page())
						{
				    		//数据+1
				    		if($('#sure').hasClass('active'))
				    		{
				    			sure.prependByPk([{
				    	        	key:'orderno',
				    	        	value:res
				    	        }]);
				    		}
				    		//数字+1
				    		setInc('sure');
						}
				    }).on('food_order/sure/delete', function(res){
				    	//数据-1
				    	if(is_food_page())
						{
				    		if($('#sure').hasClass('active'))
				    		{
				    			sure.removeByPk([{
				    	        	key:'orderno',
				    	        	value:res
				    	        }]);
				    		}
				    		//数字-1
				    		setInc('sure',-1);
						}
						
				    }).on('food_order/begin/create', function(response){
				    	//数据+1
				    	if(is_food_page())
						{
				    		if($('#begin').hasClass('active'))
				    		{
				    			begin.prependByPk([{
				    	        	key:'orderno',
				    	        	value:response
				    	        }]);
				    		}
				    		//数字+1
				    		setInc('begin');
						}
				    }).on('food_order/begin/delete', function(response){
				    	if(is_food_page())
						{
				    		//数据-1
				    		if($('#begin').hasClass('active'))
				    		{
				    			begin.removeByPk([{
				    	        	key:'orderno',
				    	        	value:response
				    	        }]);
				    		}
				    		//数字-1
				    		setInc('begin',-1);
						}
				    }).on('food_order/quit/create', function(response){
				    	audio('quit');
				    	
				    	var config={
							title:'餐饮订单通知',//通知标题部分  默认 新消息   可选
							content:'有一个新的餐饮订单申请取消，请及时处理',//通知内容部分
							click:function(data){//监听点击通知   data:可传递参数 可选
								redict('/hotel/food_order/index');
							},
							icon:'/favicon.ico',//图标
						}
						//桌面通知
						new dToast(config);
				    	
				    	if(is_food_page())
						{
							//数据+1
							if($('#quit').hasClass('active'))
							{
								quit.prependByPk([{
						        	key:'orderno',
						        	value:response
						        }]);
							}
							//数字+1
							setInc('quit');
						}
				    }).on('food_order/quit/delete', function(response){
				    	if(is_food_page())
						{
				    		//数据-1
				    		if($('#quit').hasClass('active'))
				    		{
				    			quit.removeByPk([{
				    	        	key:'orderno',
				    	        	value:response
				    	        }]);
				    		}
				    		//数字-1
				    		setInc('quit',-1);
						}
				    }).on('food_order/pay/create', function(response){
				    	if(is_food_page())
						{
				    		//数据+1
				    		if($('#pay').hasClass('active'))
				    		{
				    			pay.prependByPk([{
				    	        	key:'orderno',
				    	        	value:response
				    	        }]);
				    		}
				    		//数字+1
				    		setInc('pay');
						}
				    }).on('food_order/pay/delete', function(response){
				    	if(is_food_page())
						{
				    		//数据-1
				    		if($('#pay').hasClass('active'))
				    		{
				    			pay.removeByPk([{
				    	        	key:'orderno',
				    	        	value:response
				    	        }]);
				    		}
				    		//数字-1
				    		setInc('pay',-1);
						}
				    });
				}
			}
		}(),
	}
}();