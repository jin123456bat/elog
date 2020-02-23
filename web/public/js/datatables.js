var datatables = function(argments){
	
	var $_ajax_url = argments.ajax.url||$(argments.table).data('ajax-url');
	var $_ajax_method = argments.ajax.method || 'post';
	
	var $_drawal = 0;

	var $_start = 0;
	var $_length = 0;
	var $_total = 0;

	var $_ajax_parameter = {};
	
	var $_ajax_data = argments.ajax.data || {};
	
	var $_order = argments.sort||[];

	var $_pagesize = argments.pagesize||10;
	
	var $_response = null;
	
	var getColumnsDef = function(columnum,columname){
		if(argments.columnDefs)
		{
			for(var i=0;i<argments.columnDefs.length;i++)
			{
				if(typeof argments.columnDefs[i].targets == 'number')
				{
					if(argments.columnDefs[i].targets == columnum)
					{
						return argments.columnDefs[i][columname];
					}
				}
			}
		}
		return undefined;
	}
	
	var getRequestData = function(data){
		var temp = [];
		for(var i=0;i<data.length;i++)
		{
			temp.push({
				data:data[i].data,
				name:data[i].name,
			});
		}
		return temp;
	}
	
	var getPk = function(tr){
		return tr.prop('data-pk');
	}
	
	var flush = function(tr){
		var pk = getPk(tr);
		getDataByPk(pk,function(new_tr){
			tr.replaceWith(new_tr);
		});
	}
	
	var getDataByPk = function(pk,callback){
		var columns = getRequestData(argments.columns);
		var data = {draw:$_drawal,pk:pk,columns:columns,start:0,length:1};
		
		data['ajaxData'] = $_ajax_data;
		
		$.ajax({
			url:$_ajax_url,
			data:data,
			method:$_ajax_method,
			async:true,
			success:function(response){
				if(response.data && response.data.length>0)
				{
					tr = createTr(response.data[0]);
					if((callback && typeof(callback)==='function'))
					{
						callback(tr);
					}
				}
			}
		});
	}
	
	var bindFlushEvent = function(){
		argments.table.on('flush.datatables','tr',function(){
			flush($(this));
		});
	}
	bindFlushEvent();
	
	var createTr = function(data){
		if(!data || data.length==0)
		{
			return null;
		}
		var pk = [];
		var tr = '<tr>';
		for(var j=0;j<argments.columns.length;j++)
		{
			var visible = argments.columns[j].visible == undefined?true:argments.columns[j].visible;
			var column = argments.columns[j].name || argments.columns[j].data;
			if(visible)
			{
				var render = argments.columns[j].render || getColumnsDef(j,'render');
				var style = argments.columns[j].style || getColumnsDef(j,'style');
				
				if(render == undefined)
				{
					tr += '<td '+(style?'style="'+style+'"':'')+'>'+data[column]+'</td>';
				}
				else
				{
					tr += '<td '+(style?'style="'+style+'"':'')+'>'+render(data[column],data)+'</td>';
				}
			}

			if(argments.columns[j].pk)
			{
				pk.push({key:argments.columns[j].name,value:data[column]});
			}
		}
		tr += '</tr>';
		tr = $(tr);
		tr.prop('data-pk',pk);
		if(argments.onRowLoaded)
		{
			argments.onRowLoaded(tr,data);
		}
		return tr;
	}

	var load = function(start,length){
		if(length!=-1)
		{
			start = parseInt(start);
			length = parseInt(length);

			if(start<0)
			{
				return false;
			}
			if(length<=0)
			{
				return false;
			}
			if(start >= $_total && start!=0)
			{
				return false;
			}

			$_start = start;
			$_length = length;
		}
		else
		{
			start = 0;
			length = -1;
		}
		
		clear();

		var columns = getRequestData(argments.columns);
		
		var data = {draw:$_drawal,start:start,length:length,columns:columns,order:$_order};

		$.each($_ajax_parameter,function(index,value){
			data[index] = value;
		});
		
		data['ajaxData'] = $_ajax_data;
		
		$.ajax({
			url:$_ajax_url,
			data:data,
			method:$_ajax_method,
			async:true,
			success:function(response){
				if(response.draw == $_drawal)
				{
					$_response = response;
					
					$_total = parseInt(response.total);
					
					tfooter($_total);
					
					if(response.data.length === 0)
					{
						var empty = '<tr><td colspan="100" style="text-align:center;">尚无数据</td></tr>';
						if(argments.empty)
						{
							empty = argments.empty;
						}
						argments.table.find('tbody').append(empty);
					}
					else
					{
						for(var i=0;i<response.data.length;i++)
						{
							var tr = createTr(response.data[i]);
							argments.table.find('tbody').append(tr);
						}
					}

					if(argments.afterTableLoaded)
					{
						argments.afterTableLoaded(argments.table,response);
					}
					
					//floatright();
					
					$_drawal++;
				}
			}
		});
	}

	var floatright=function(){
		var trs=argments.table.find('tbody tr');
		var bwidth=argments.table.parent('.tablebox').width();
		var width=argments.table.width();
		trs.each(function(i){ 
			var a=$(this).children().length-1;
			var newleft=width-bwidth <0 ? 0 :width-bwidth;
			$(this).children().eq(a).css({"position":"relative","right":newleft,"background-color":"#fff",borderLeft: "1px solid #ccc"});
		});
		
		argments.table.parent(".tablebox").scroll(function(){
			var left=$(this).scrollLeft();
			var top=$(this).scrollTop();
			var trs = $(this).find('tbody tr');
			trs.each(function(i){
				var a=$(this).children().length-1;
				var newleft=width-bwidth-left <0 ? 0 :width-bwidth-left;
				$(this).children().eq(a).css({"position":"relative","right":newleft,"background-color":"#fff",borderLeft: "1px solid #ccc"});
			});
		});
	}

	var tfooter = function(total){
		if($_pagesize == -1)
		{
			return false;
		}
		
		var split_page = argments.table.find('tfoot #split_page');
		if(split_page.length == 0)
		{
			var split_page = argments.table.find('tfoot td');	
		}
		
		split_page.empty();

		var pagenum = Math.ceil(total/$_pagesize);

		var str = '';
		for(var i=1;i<=pagenum;i++)
		{
			current_page = ($_start/$_pagesize)+1;
			str += '<option value="'+i+'" '+((i==current_page)?'selected="selected"':'')+'>'+i+'</option>';
		}

		var tpl = '总计'+total+'个记录，分'+pagenum+'页 |  '
											+'每页 <input id="set_pagesize" type="text" value="'+$_pagesize+'" style="width: 34px; height: 22px; outline: none;"> | '
											+'<i id="first_page" class="btn iconfont page-icon" title="首页" >&#xe99e;</i>'
											+'<i id="prev_page" class="iconfont page-icon" title="上一页">&#xe677;</i>'
											+'<select id="set_page" style="width: 36px; height: 22px; margin: 0px 5px;vertical-align: top;">'+str+'</select>'
											+'<i id="next_page" class="btn iconfont page-icon" title="下一页">&#xe676;</i>'
											+'<i id="last_page" class="btn iconfont page-icon" title="尾页">&#xe9a9;</i>';
		
		
		split_page.append(tpl);

		split_page.find('#first_page').on('click',function(){
			if($_start!=0)
			{
				load(0,$_pagesize);
			}
		});
		split_page.find('#prev_page').on('click',function(){
			load($_start-$_pagesize,$_pagesize);
		});
		split_page.find('#next_page').on('click',function(){
			load($_start+$_pagesize,$_pagesize);
		});
		split_page.find('#last_page').on('click',function(){
			if(Math.floor($_total/$_pagesize)*$_pagesize != $_start)
			{
				load(Math.floor($_total/$_pagesize)*$_pagesize,$_pagesize);
			}
		});
		split_page.find('#set_pagesize').on('change',function(){
			pagesize = parseInt($(this).val());
			if(pagesize>0)
			{
				$_pagesize = pagesize;
				load(0,$_pagesize);
			}
		});
		split_page.find('#set_page').on('change',function(){
			page = parseInt($(this).val());
			if(page>0)
			{
				load((page-1) * $_pagesize,$_pagesize);
			}
		});
	};

	var clear = function(){
		argments.table.find('tbody').empty();
		// argments.table.find('tfoot').empty();
	};

	var addAjaxParameter = function(key,value){
		$_ajax_parameter[key] = value;
	};
	
	var clearAjaxParameter = function(){
		$_ajax_parameter = {};
	};
	
	if(argments.auto_loading!=false)
	{
		load(0,$_pagesize);
	}
	
	$(argments.table).on('flush',function(){
		load($_start,$_length);
	});

	return {
		search:function(keyword){
			addAjaxParameter('keywords',keyword);
			load(0,$_pagesize);
		},
		reload:function(){
			load($_start,$_pagesize);
		},
		//设置ajax_data
		ajaxData:function(key,value){
			$_ajax_data[key] = value;
		},
		//获取ajax_data
		getAjaxData:function(){
			return $_ajax_data;
		},
		//获取排序参数
		getOrderData:function(){
			return $_order;
		},
		//设置页码
		page:function(page_num){
			$_start = (page_num-1) * $_pagesize;
			if($_start<0)
			{
				$_start = 0;
			}
		},
		addAjaxParameter:function(key,value){
			addAjaxParameter(key,value);
		},
		getResultPrimaryKey:function(){
			return $_response.pk;
		},
		clearAjaxParameter:function(){
			clearAjaxParameter();
		},
		//在最前方添加数据
		prependByPk:function(pk,callback){
			flag = false;
			argments.table.find('tbody tr').each(function(index,value){
				if(getPk($(value))[0].value == pk[0].value)
				{
					flag = true;
				}
			});
			
			if(!flag)
			{
				getDataByPk(pk,function(tr){
					tr.css({display:'none'});
					argments.table.find('tbody').prepend(tr);
					tr.fadeIn('slow');
					if((callback && typeof(callback)==='function'))
					{
						callback();
					}
				});
				//删除超出pagesize的数据
				if(argments.table.find('tbody tr').length > $_pagesize)
				{
					argments.table.find('tbody tr').last().remove();
				}
			}
		},
		removeByPk:function(pk){
			
			argments.table.find('tbody tr').each(function(index,value){
				if(getPk($(value))[0].value == pk[0].value)
				{
					$(value).fadeOut('slow');
				}
			});
		}
	};
}