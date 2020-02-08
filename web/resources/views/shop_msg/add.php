<?php
use jin123456bat\assets;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>
        <?=$setting['site_title']?> |
        <?=$setting['site_desc']?>
    </title>
    <link rel="stylesheet" href="/static/layui/css/layui.css" type="text/css" media="all" />
    <!-- 所有页面使用的样式 -->
    <link rel="stylesheet" href="<?=assets::css('main.css')?>" type="text/css" media="all" />
</head>

<body>
    {include file='common/header' /}
    <div class="container">
        {include file='common/sidebar' /}
        <div class="main">
            <div class="title">
                <div class="white-block">
                    <div class="wall-block">
                        <p>
                            <?=$menu_queue?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="body">
                <div class="white-block">
                    <div class="layui-collapse" lay-accordion="">
                        <div class="layui-colla-item">
                            <h2 class="layui-colla-title">预设变量</h2>
                            <div class="layui-colla-content layui-show" id="presetVariables">
                                <p>
                                </p>
                            </div>
                        </div>
                    </div>
                    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
                        <legend>添加模板内容</legend>
                    </fieldset>
                    <form class="layui-form" action="">
                        <div class="layui-form-item">
                            <label class="layui-form-label">选择消息</label>
                            <div class="layui-input-inline">
                                <select name="keyword" lay-verify="keyword" lay-filter="keyword">
                                	<option value="0"></option>
                                    <option value="paySuccess">支付成功通知</option>
                                    <option value="shipMsg">发货通知通知</option>
                                    <option value="CancelSuccess">取消成功通知</option>
                                    <option value="CancelError">拒绝取消通知</option>
                                    <option value="SalesSuccess">退货成功通知</option>
                                    <option value="SalesError">拒绝退货通知</option>
                                </select>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">模板ID</label>
                            <div class="layui-input-inline">
                              <input type="text" name="temp_id" maxlength="43" lay-verify="temp_id" autocomplete="off" placeholder="模板id" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">消息内容</label>
                            <div class="layui-input-inline floatNone wauto" onclick="addProperty(this)">
                                <span class="layui-btn layui-btn-normal layui-btn-sm"><i class="layui-icon"></i></span>
                            </div>
                        </div>
                        <div id="propertyBox">
                            <div class="layui-form-item">
                                <label class="layui-form-label"></label>
                                <div class="layui-input-inline floatNone">
                                    <div class="layui-form-mid layui-word-aux">
                                        <span>消息变量</span>
                                    </div>
                                    <input type="text" name="key_name" autocomplete="off" class="layui-input" placeholder="first">
                                </div>
                                <div class="layui-input-inline floatNone">
                                    <div class="layui-form-mid layui-word-aux">
                                        <span>变量值</span>
                                    </div>
                                    <input type="text" name="value" autocomplete="off" class="layui-input" placeholder="{name},您的订单已支付成功">
                                </div>
                                <div class="layui-input-inline floatNone">
                                    <div class="layui-form-mid layui-word-aux">
                                        <span>字体颜色</span>
                                    </div>
                                    <input type="text" name="color" autocomplete="off" class="layui-input" value="#173177">
                                </div>
                                <div class="layui-input-inline floatNone">
                                    <div class="layui-form-mid layui-word-aux">
                                        <span>删除</span>
                                    </div>
                                    <div class="layui-input-inline floatNone wauto" onclick="delProperty(this)">
                                        <span class="layui-btn layui-btn-normal layui-btn-sm"><i class="layui-icon"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <button class="layui-btn layui-btn-normal" id="addMsg" lay-submit="" lay-filter="addMsg">立即提交</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</body>
<script src="/static/common/js/jquery.min.js"></script>
<script src="/static/layui/layui.all.js"></script>
<script>
//添加支出項
function addProperty(ev) {
    var str = '<div class="layui-form-item">';
    str += '<label class="layui-form-label"></label>';
    str += '<div class="layui-input-inline floatNone">';
    str += '<div class="layui-form-mid layui-word-aux"><span>消息变量</span></div>';
    str += '<input type="text" name="key_name" autocomplete="off" class="layui-input" placeholder=""></div>';
    str += '<div class="layui-input-inline floatNone"><div class="layui-form-mid layui-word-aux">';
    str += '<span>变量值</span></div>';
    str += '<input type="text" name="value" autocomplete="off" class="layui-input"></div>';
    str += '<div class="layui-input-inline floatNone"><div class="layui-form-mid layui-word-aux">';
    str += '<span>字体颜色</span></div>';
    str += '<input type="text" name="color" autocomplete="off" class="layui-input" value="#173177"></div>';
    str += '<div class="layui-input-inline floatNone"><div class="layui-form-mid layui-word-aux">';
    str += '<span>删除</span></div>';
    str += '<div class="layui-input-inline floatNone wauto" onclick="delProperty(this)">';
    str += '<span class="layui-btn layui-btn-normal layui-btn-sm"><i class="layui-icon"></i></span>';
    str += '</div></div></div>';
    $("#propertyBox").append(str);
}
//刪除支出項
function delProperty(ev) {
	$(ev).parents('.layui-form-item').remove();
}
layui.use('form', function(){
	var form = layui.form;
    form.on('select(keyword)', function(data){
        if(data.value){
            $.ajax({
                type:'post',
                url:"<?=url('ShopMsg/presetVariables')?>",
                data:{
                    name:data.value
                },
                dataType:'json',
                success:function(res){
                    if(res.data){
                        var arr = res.data;
                        var str = '';
                        $.each(arr,function(k,v){
                            str += '<b>'+v+'</b>'+':'+'{'+k+'}&emsp;';
                        })
                        $("#presetVariables p").empty().html(str);
                    }
                }
            })
        }
    });
	form.verify({
		keyword:function(value,item) {
			if(value==false){
				return '请选择消息';
			}
		},
        temp_id:function(value,item){
            if(value==false){
                return '请填写模板ID';
            }
        }
	})
	form.on('submit(addMsg)', function(data){
		var error = 0;
		var info = {};
		$("#propertyBox .layui-form-item").each(function(k,v){
			var key_name = $(v).find('input[name=key_name]').val();
			var value = $(v).find('input[name=value]').val();
            var color = $(v).find('input[name=color]').val();

			if(key_name==false || value==false || color==false){
				error++;
			}else{
				info[key_name] = {
                    value:value,
                    color:color
                }
			}
		})

		if(error>0){
			layer.msg('请填写消息内容');
			return false;
		}
		_this = $('select[name=keyword]').find('option:selected');
		$.ajax({
			type:'post',
			url:"{:url('ShopMsg/insertMsg')}",
			data:{
				info:info,
				keyword:_this.val(),
				name:_this.html(),
                temp_id:$('input[name=temp_id]').val()
			},
			dataType:'json',
			success:function(res){
                layer.msg(res.message);
			},error:function(res){
                layer.alert('系统错误');
            }
		});
		return false;
	});
});
</script>