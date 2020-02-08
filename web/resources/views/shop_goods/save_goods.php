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
<link rel="stylesheet" href="/static/layui/formSelects-v4.css" type="text/css" media="all" />
<link rel="stylesheet" href="/static/layui/jquery-ui.css">
<!-- 所有页面使用的样式 -->
<link rel="stylesheet" href="<?=assets::css('main.css')?>" type="text/css" media="all" />
<style type="text/css">
#goodDescBox {
	overflow: hidden
}

#testListAction {
	display: none
}

.img_box {
	position: absolute;
	top: 0;
	right: 0;
	width: 100px
}

.img_box img {
	height: 100%;
	width: 100%
}

#editor {
	width: 50%;
	z-index: 100 !important
}

blockquote {
	width: 50%
}

.layui-upload-img {
	width: 92px;
	height: 92px
}

.tip_img {
	display: block;
	text-align: center;
	width: 100%;
	background: rgba(0, 0, 0, 0.8);
	color: white;
	font-size: 12px
}

.tip_del {
	position: absolute;
	top: 0;
	left: 0;
	display: none
}

.tip_curr {
	position: absolute;
	bottom: 0;
	left: 0;
	display: none
}

.tipBox {
	float: left;
	margin-left: 15px;
	position: relative
}

#goodDescBox {
	overflow: hidden
}

.show {
	display: block
}

.floatNone {
	float: none !important
}

.wauto {
	width: auto !important
}

.w300 {
	width: 300px !important
}

.skuImgBtn {
	cursor: pointer
}

.hide {
	display: none
}

#propertyBox .layui-form-item .layui-input-inline {
	width: 100px !important;
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
						<legend>添加商品</legend>
					</fieldset>
					<form class="layui-form" action="">
						<div class="layui-form-item">
							<label class="layui-form-label">商品分类</label>
							<div class="layui-input-block" style="width: 50%;">
								<select name="category_id" xm-select="category_id" xm-select-skin="normal" xm-select-search="" lay-verify="category_id">
                  <?php

																		function getSon($id, $array = array(), $level = 0, $categorys)
																		{
																			$str = '';
																			static $lists;
																			foreach($array as $k => $v)
																			{
																				if($v['parent_category_id'] == $id)
																				{
																					if($v['parent_category_id'] > 0)
																					{
																						$flg = str_repeat('|--', $level);
																						$v['name'] = $flg . $v['name'];
																						$selected = '';
																						foreach($categorys as $cat)
																						{
																							if($cat['category_id'] == $v['category_id'])
																							{
																								$selected = 'selected=""';
																							}
																						}
																						echo '<option ' . $selected . ' value="' . $v['category_id'] . '">' . $v["name"] . '</option>';
																						$lists[] = $v;
																						unset($array[$k]);
																					}
																					getSon($v['category_id'], $array, $level + 1, $categorys);
																				}
																			}
																		}
																		getSon(0, $categoryList, 0, $categorys);
																		?>
                </select>
							</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">商品名称</label>
							<div class="layui-input-inline">
								<input type="text" name="name" lay-verify="name" value="{$goods.name}" autocomplete="off" placeholder="请输入商品名称" class="layui-input">
							</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">商品重量</label>
							<div class="layui-input-inline">
								<input type="number" name="weight" lay-verify="weight" value="{$goods.weight}" autocomplete="off" placeholder="请输商品重量" class="layui-input">
							</div>
							<div class="layui-form-mid layui-word-aux">KG</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">商品短描述</label>
							<div class="layui-input-inline">
								<textarea name="short_desc" placeholder="请输入内容" maxlength="1024" class="layui-textarea">{$goods.short_desc}</textarea>
							</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">运费模板</label>
							<div class="layui-input-block" style="width: 50%;">
								<select name="ship_id" xm-select="ship_id" xm-select-skin="normal" xm-select-search="" lay-verify="ship_id">
                  {foreach $shipList as $key=>$vo }
                    {foreach $ships as  $s}
                    <?php
																				if($vo['id'] == $s['ship_id'])
																				{
																					$selected = 'selected';
																				}
																				else
																				{
																					$selected = '';
																				}
																				?>
                    {/foreach}
                    <option <?php echo $selected;?> value="{$vo.id}">{$vo.name}</option>
									{/foreach}
								</select>
							</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">商品预览图</label>
							<div class="layui-input-block">
								<div class="layui-upload">
									<button type="button" class="layui-btn layui-btn-normal" id="testList">
										<i class="layui-icon">&#xe681</i>
										选择预览图
									</button>
									<div class="layui-upload-list">
										<table class="layui-table">
											<thead>
												<tr>
													<th>文件名</th>
													<th>FILEID</th>
													<th>状态</th>
													<th>操作</th>
												</tr>
											</thead>
											<tbody id="demoList">
												{foreach $images as $key=>$vo }
												<tr id="">
													<td style="position: relative;">
                                <?php $img_url = helper::getImageUrl($vo['logo_id']);?>
                               <img src="<?php echo $img_url?>">
													</td>
													<td>{$vo.logo_id}</td>
													<td>上传完成</td>
													<td>
                                <?php if($vo['logo_id']==$goods['logo_id']){?>
                                <span class="layui-btn layui-btn-xs layui-btn-normal img-setting" data="{$vo.logo_id}" onclick="setImg(this)">封面图</span>
                                <?php }else{?>
                                <span class="layui-btn layui-btn-xs layui-btn-normal img-setting" data="{$vo.logo_id}" onclick="setImg(this)">设置封面图</span>
                                <?php }?>
                                <span class="layui-btn layui-btn-xs layui-btn-danger demo-delete" onclick="delImg(this)">删除</span>
													</td>
													<input type="hidden" name="logos[]" logoid="{$vo['logo_id']}" value="{$vo['logo_id']}" img_url="<?php echo $img_url?>">
												</tr>
												{/foreach}
											</tbody>
										</table>
									</div>
									<button type="button" class="layui-btn" id="testListAction">开始上传</button>
								</div>
								<div class="layui-form-mid layui-word-aux">
									每张图片大小不能超过600KB,格式只能是'png,jpg,jpeg,gif',
									<b>拖动图片可调整图片前端展示的顺序</b>
								</div>
							</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">商品详情图</label>
							<div class="layui-input-block">
								<button type="button" class="layui-btn layui-btn-normal" id="goodDescImgBtn">
									<i class="layui-icon">&#xe681</i>
									选择详情图
								</button>
								<blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;">
									新增图：
									<div class="layui-upload-list" id="goodDescBox"></div>
								</blockquote>
								<blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;">
									原有图：
									<div class="layui-upload-list" id="picss" style="overflow: hidden;">
                      <?php
																						foreach($descs as $k => $v)
																						{
																							$img_logo_url = helper::getImageUrl($v['logo_id']);
																							?>
                        <div class="tipBox">
											<img src="<?php echo $img_logo_url;?>" class="layui-upload-img">
											<span class="tip_img tip_curr" onclick="imgDescDel(this)">删除</span>
											<input type="hidden" name="good_desc_img[]" value="{$v['logo_id']}">
										</div>
                      <?php } ?>
                    </div>
								</blockquote>
								<div class="layui-form-mid layui-word-aux">
									每张图片大小不能超过500KB,格式只能是'png,jpg,jpeg,gif',
									<b>拖动图片可调整图片前端展示的顺序</b>
								</div>
							</div>
						</div>
						<!-- 属性添加框 -->
						<div class="layui-form-item">
							<label class="layui-form-label">商品属性</label>
							<div class="layui-input-inline floatNone">
								<div class="layui-form-mid layui-word-aux">属性名:</div>
								<input type="text" id="specification" name="" onpaste="return false" autocomplete="off" class="layui-input" placeholder="如：‘规格、颜色等’">
							</div>
							<div class="layui-input-inline floatNone w300">
								<div class="layui-form-mid layui-word-aux">属性值:</div>
								<input type="text" name="" id="propertyList" autocomplete="off" class="layui-input" value="" placeholder="用‘@’号隔开一次可添加多个属性" onpaste="return false">
							</div>
							<div class="layui-input-inline floatNone wauto" style="margin-top: 35px;" onclick="addProperty(this)">
								<span class="layui-btn layui-btn-normal layui-btn-sm">
									<i class="layui-icon"></i>
								</span>
							</div>
							<div class="layui-input-inline floatNone wauto" style="margin-top: 35px;" onclick="delProperty(this)">
								<span class="layui-btn layui-btn-normal layui-btn-sm">
									<i class="layui-icon"></i>
								</span>
							</div>
							<div class="layui-input-inline floatNone" style="margin-top: 35px;">
								<div class="layui-form-mid layui-word-aux">同时填写积分和价格,购买时为组合支付。,单独填写为对应的支付方式。</div>
							</div>
						</div>
						<!-- 属性添加框 -->
						<!-- 属性填写框 -->
						<div id="propertyBox">
							{foreach $skus as $key=>$vo }
							<div class="layui-form-item">
								<label class="layui-form-label"></label>
								<div class="layui-input-inline floatNone wauto">
									<div class="layui-upload-list show ">
                        <?php if($vo['sku_img_id']){?>
                          <img class="layui-upload-img skuImgBtn" onclick="upSkuImg(this)" src="<?=helper::getImageUrl($vo['sku_img_id'])?>">
                        <?php }else{?>
                          <img class="layui-upload-img skuImgBtn" onclick="upSkuImg(this)" src="<?=assets::image('up.jpg')?>">
                        <?php }?>
                        <input type="file" name="file" value="" class="hide">
										<input type="hidden" name="sku_img_id||{$vo.sku}" class="sku_img_id hide" value="{$vo.sku_img_id}">
										<input type="hidden" name="sku_img_path||{$vo.sku}" class="sku_img_path hide" value="{$vo.sku_img_path}">
									</div>
								</div>
								<div class="layui-input-inline floatNone">
									<div class="layui-form-mid layui-word-aux" style="width: 700px;">
										<span>{$vo.sku}(价格、库存、每日库存、积分、sku编码、最大购买数量：0不限制、是否需要填写地址：0不需要)</span>
									</div>
									<input type="number" name="price||{$vo.sku}" autocomplete="off" class="layui-input" placeholder="价格" value="{$vo.price/100}">
								</div>
								<div class="layui-input-inline floatNone">
									<div class="layui-form-mid layui-word-aux">&emsp;</div>
									<input type="number" name="stock||{$vo.sku}" autocomplete="off" class="layui-input" placeholder="库存" value="{$vo.stock}">
								</div>
								<div class="layui-input-inline floatNone">
									<div class="layui-form-mid layui-word-aux">&emsp;</div>
									<input type="number" name="stock_per_day||{$vo.sku}" autocomplete="off" class="layui-input" placeholder="每日库存" value="{$vo.stock_per_day}">
								</div>
								<div class="layui-input-inline floatNone">
									<div class="layui-form-mid layui-word-aux">&emsp;</div>
									<input type="number" name="score||{$vo.sku}" autocomplete="off" class="layui-input" placeholder="积分" value="{$vo.score}">
								</div>
								<div class="layui-input-inline floatNone">
									<div class="layui-form-mid layui-word-aux">&emsp;</div>
									<input type="text" name="code||{$vo.sku}" autocomplete="off" class="layui-input" placeholder="sku编码" value="{$vo.code}">
								</div>
								<div class="layui-input-inline floatNone">
									<div class="layui-form-mid layui-word-aux">&emsp;</div>
									<input type="number" name="max_num||{$vo.sku}" autocomplete="off" class="layui-input" placeholder="最大购买数量" value="{$vo.max_num}">
								</div>
								<div class="layui-input-inline floatNone">
									<div class="layui-form-mid layui-word-aux">&emsp;</div>
									<input type="number" name="is_ship||{$vo.sku}" autocomplete="off" class="layui-input" placeholder="是否需要填写地址" value="{$vo.is_ship}">
								</div>
								<!--  <div class="layui-input-inline floatNone">
                  <div class="layui-form-mid layui-word-aux">&emsp;</div>
                  <input type="number" name="auto_skip||{$vo.sku}" autocomplete="off" class="layui-input" placeholder="自动发货" value="{$vo.auto_skip}">
                </div> -->
							</div>
							{/foreach}
						</div>
						<!-- 属性填写框 -->
						<div class="layui-form-item">
							<div class="layui-block">
								<label class="layui-form-label">上架时间</label>
								<div class="layui-input-inline">
									<input type="text" class="layui-input" name="start_time" id="start_time" value="<?php if($goods['start_time']==false){ echo date('Y-m-d H:i:s');}else{ echo $goods['start_time'];}?>">
								</div>
							</div>
						</div>
						<div class="layui-form-item">
							<div class="layui-block">
								<label class="layui-form-label">下架时间</label>
								<div class="layui-input-inline">
									<input type="text" class="layui-input" name="end_time" id="end_time" value="<?php if($goods['end_time']==false){ echo '';}else{ echo $goods['end_time'];}?>">
								</div>
								<div class="layui-form-mid layui-word-aux">0为不自动下架</div>
							</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">是否上架</label>
							<div class="layui-input-block">
								<input type="radio" name="status" value="1" title="上架" <?php if($goods['status']==1){ echo 'checked';}?>>
								<input type="radio" name="status" value="0" title="不上架" <?php if(!$goods['status']){ echo 'checked';}?>>
							</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">自动发货</label>
							<div class="layui-input-block">
								<input type="radio" name="auto_ship" value="1" <?php if($goods['auto_ship']==1){ echo 'checked';}?> title="自动">
								<input type="radio" name="auto_ship" value="0" <?php if(!$goods['auto_ship']){ echo 'checked';}?> title="不自动">
							</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">特惠中心</label>
							<div class="layui-input-block">
								<input type="radio" name="special_center" value="1" <?php if($goods['special_center']==1){ echo 'checked';}?> title="是">
								<input type="radio" name="special_center" value="0" <?php if(!$goods['special_center']){ echo 'checked';}?> title="否">
							</div>
							<div class="layui-form-mid layui-word-aux">
								是否可以在特惠中心购买,在特惠中心购买则不允许在商城购买
								<br>
								特惠中心只允许有一个规格，其他规格将被忽略
							</div>
						</div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">展示库存</label>
                            <div class="layui-input-block">
                                <input type="radio" name="show_stock" value="1" <?php if($goods['show_stock']==1){ echo 'checked';}?> title="是">
                                <input type="radio" name="show_stock" value="0" <?php if(!$goods['show_stock']){ echo 'checked';}?> title="否">
                            </div>
                        </div>
						<div class="layui-form-item">
							<label class="layui-form-label">排序</label>
							<div class="layui-input-inline">
								<input type="number" min="0" name="sort" value="{$goods.sort}" lay-verify="sort" value="0" autocomplete="off" placeholder="数值越小越靠前" class="layui-input">
							</div>
							<div class="layui-form-mid layui-word-aux">数值越小越靠前</div>
						</div>
						<div class="layui-form-item">
							<div class="layui-input-block">
								<button class="layui-btn layui-btn-normal" id="addGoods" lay-submit="" lay-filter="addGoods">立即提交</button>
							</div>
						</div>
						<div id="property_input">
							{foreach $propertys as $vo }
							<input type="hidden" name="property_input||{$vo.property}" value="{$vo.value}">
							{/foreach}
						</div>
						<input type="hidden" name="logo_main" value="{$goods.logo_main}">
						<input type="hidden" name="logo_id" value="{$goods.logo_id}" lay-verify="logo_id">
						<input type="hidden" name="company_id" value="{$goods.company_id}">
						<input type="hidden" name="id" value="{$goods.id}">
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="/static/common/js/jquery.min.js"></script>
<script src="/static/layui/layui.all.js"></script>
<script src="/static/layui/formSelects-v4.min.js" type="text/javascript" charset="utf-8"></script>
<script src="<?=assets::layui('uploads.js')?>"></script>
<script src="/static/layui/jquery-ui.js"></script>
<script type="text/javascript">
layui.use('laydate', function(){
  var laydate = layui.laydate;
  //日期时间选择器
  laydate.render({
    elem: '#start_time'
    ,type: 'datetime'
  });
  //日期时间选择器
  laydate.render({
    elem: '#end_time'
    ,type: 'datetime'
    ,done: function(value, date, endDate){
      if(value<=$('#start_time').val()){
        layer.msg('结束时间不能大于开始时间！');
      }
    }
  });
})
var propertyStatic = [];
//新增商品属性
function addProperty(ev) {
    //属性名称
    var name = $("#specification").val();
    //属性值
    var value = $("#propertyList").val();
    if (name) {
        var arr = value.split('@');
        var property_value = '';
        $.each(arr, function(k, v) {
            property_value += v + ',';
        })
        var property_input = '<input type="hidden" name="property_input||' + name + '" value="' + property_value + '">';
        propertyStatic.push(arr);
        arr = calcDescartes(propertyStatic);
        var str = '';
        $.each(arr, function(k, v) {
            var specification = '';
            //检测是不是有两种或两种以上的规格
            if (v.length >= 2 && $.isArray(v)) {
                $.each(v, function(kk, vv) {

                    specification += vv + ',';
                })
            } else {
                specification = v;
            }
            str += '<div class="layui-form-item"><label class="layui-form-label"></label><div class="layui-input-inline floatNone wauto"><div class="layui-upload-list show ">';
            str += '<img class="layui-upload-img skuImgBtn" onclick="upSkuImg(this)" src="<?=assets::image('up.jpg')?>">';
            str += '<input type="file" name="file" value="" class="hide"><input type="hidden" name="sku_img_id||' + specification + '" value="" class="sku_img_id hide"><input type="hidden" name="sku_img_path||' + specification + '" value="" class="sku_img_path hide"></div></div>';
            str += '<div class="layui-input-inline floatNone">';
            str += '<div class="layui-form-mid layui-word-aux" style="width:700px;"><span>' + specification + '(价格、库存、积分、sku编码、最大购买数量、是否需要填写地址：0为不需要)</span></div>';
            str += '<input type="number" name="price||' + specification + '" autocomplete="off" class="layui-input" placeholder="价格"></div>'
            str += '<div class="layui-input-inline floatNone"><div class="layui-form-mid layui-word-aux">&emsp;</div><input type="number" name="stock||' + specification + '" autocomplete="off" class="layui-input" placeholder="库存"></div>';
            str += '<div class="layui-input-inline floatNone"><div class="layui-form-mid layui-word-aux">&emsp;</div><input type="number" name="stock_per_day||' + specification + '" autocomplete="off" class="layui-input" placeholder="每日库存"></div>';
            str += '<div class="layui-input-inline floatNone"><div class="layui-form-mid layui-word-aux">&emsp;</div><input type="number" name="score||' + specification + '" autocomplete="off" class="layui-input" placeholder="积分"></div>';
            str += '<div class="layui-input-inline floatNone"><div class="layui-form-mid layui-word-aux">&emsp;</div><input type="text" name="code||' + specification + '" autocomplete="off" class="layui-input" placeholder="sku编码"></div>';
            str += '<div class="layui-input-inline floatNone"><div class="layui-form-mid layui-word-aux">&emsp;</div><input type="text" name="max_num||' + specification + '" autocomplete="off" class="layui-input" placeholder="最大购买数量"></div>';
            str += '<div class="layui-input-inline floatNone"><div class="layui-form-mid layui-word-aux">&emsp;</div><input type="text" name="is_ship||' + specification + '" autocomplete="off" class="layui-input" value="1" placeholder="是否需要填写地址"></div>';
        })
        $("#propertyBox").html(str);
        $("#property_input").append(property_input);
        //添加之后清空属性
        $("#specification").val('');
        $("#propertyList").val('');
    }
}
//上传sku图片
function upSkuImg(ev){
  var _this = $(ev);
  _this.siblings('input[name="file"]').click();
  _this.siblings('input[name="file"]').change(function() {
    var file = $(this)[0].files[0];
    $(_this).attr('src', getObjectURL(file));
      var formData = new FormData();
      formData.append("file", $(this)[0].files[0]);
      $.ajax({
          type: "post",
          url: '<?=url('common/component/upload_imgs')?>',
          data: formData,
          async: false,
          cache: false,
          contentType: false,
          processData: false,
          success: function(res) {
            if(res.code==1){
             _this.siblings('.sku_img_id').val(res.data.id);
             _this.siblings('.sku_img_path').val(res.data.url);
            }else{
              layer.msg('上传失败！');
              $(_this).attr('src','<?=assets::image('up.jpg')?>');
            }
          },
          error: function(jqXHR) {
            layer.msg('系统故障！');
            $(_this).attr('src','<?=assets::image('up.jpg')?>');
          }
      })
  })
}
//处理商品笛卡尔积
function calcDescartes(array) {
    if (array.length < 2) return array[0] || [];
    return [].reduce.call(array, function(col, set) {
        var res = [];
        col.forEach(function(c) {
            set.forEach(function(s) {
                var t = [].concat(Array.isArray(c) ? c : [c]);
                t.push(s);
                res.push(t);
            })
        });
        return res;
    });
}
//删除商品属性
function delProperty(ev) {
    $("#propertyBox").find('.layui-form-item').remove();
    propertyStatic = [];
    $("#property_input").empty();

}
//处理商品属性值
function prototype(ev) {
    $(ev).val($(ev).val().replace(/,|\'|\"|\<|\>|\/|\?|\\|\`/g, ''));
}
//获取上传的临时图片地址
function getObjectURL(file) {
    var url = null;
    if (window.createObjectURL != undefined) { // basic
        url = window.createObjectURL(file);
    } else if (window.URL != undefined) { // mozilla(firefox)
        url = window.URL.createObjectURL(file);
    } else if (window.webkitURL != undefined) { // webkit or chrome
        url = window.webkitURL.createObjectURL(file);
    }
    return url;
}
//多图上传
layui.use('upload', function() {
    var $ = layui.jquery,
        upload = layui.upload;
    //列表型多图片上传
    uploadImgs(upload, '<?=url('common/component/upload')?>', '#testList', '#testListAction', '#demoList', 'shop_goods_preview');
    $("#demoList").sortable();
    $("#demoList").disableSelection();

    var limit_num = 5;
    //展示型多图上传
    showUploadS(upload, '<?=url('common/component/upload')?>', '#goodDescImgBtn', '#goodDescBox', 'shop_goods_desc', 10);
    $("#goodDescBox").sortable();
    $("#goodDescBox").disableSelection();
});
//表单验证
layui.use('form', function() {
    var form = layui.form;
    //表单验证
    form.verify({
        catagory_id: function(value, item) {
            if (!value) {
                return '至少选择一个分类！';
            }
        },
        name: function(value, item) {
            if (!value) {
                return '请填写商品名称！';
            }
        },
        short_desc: function(value, item) {
            if (!value) {
                return '请填写商品短描述！';
            }
        },
        logo_id: function(value, item) {
            if (!value) {
                return '请设置封面图！';
            }
        }
    });
    //监听提交
    form.on('submit(addGoods)', function(data) {
      var special_center = $('input[name=special_center]:checked').val();
      var logos = '';//预览图
      var desc = '';//详情图
      var price = new Object;//价格
      var stock = new Object;//库存
      var stock_per_day = new Object;//库存
      var score = new Object;//积分
      var code = new Object;//sku编码
      var sku_img_id = new Object;//sku图片id
      var sku_img_path = new Object;//sku图片地址
      var property = new Object;//sku属性
      var max_num = new Object;
      var is_ship = new Object;//sku图片地址
      var auto_skip = new Object;
      $.each(data.field,function(k,v){
        //预览图
        if(k.indexOf('logos')==0){
          logos += v+',';
        }
        //详情图
        if(k.indexOf('good_desc_img')==0){
          desc += v+',';
        }
        //处理价格
        if(k.indexOf('price')==0){
          var arr = k.split('||');
          var key = arr[1];
          price[key] = v;
        }

        //处理库存
        if(k.split('||')[0] == 'stock')
        {
          var arr = k.split('||');
          var key = arr[1];
          stock[key] = v;
        }
        //处理每日库存
        if(k.split('||')[0] == 'stock_per_day'){
          var arr = k.split('||');
          var key = arr[1];
          stock_per_day[key] = v;
        }
        //处理积分
        if(k.indexOf('score')==0){
          var arr = k.split('||');
          var key = arr[1];
          score[key] = v;
        }
        //处理code
        if(k.indexOf('code')==0){
          var arr = k.split('||');
          var key = arr[1];
          code[key] = v;
        }
        //max_num
        if(k.indexOf('max_num')==0){
          var arr = k.split('||');
          var key = arr[1];
          max_num[key] = v;
        }
        //is_ship
        if(k.indexOf('is_ship')==0){
          var arr = k.split('||');
          var key = arr[1];
          is_ship[key] = v;
        }
        //auto_skip
        if(k.indexOf('auto_skip')==0){
          var arr = k.split('||');
          var key = arr[1];
          auto_skip[key] = v;
        }
        //处理sku图片
        if(k.indexOf('sku_img_id')==0){
          var arr = k.split('||');
          var key = arr[1];
          sku_img_id[key] = v;
        }
         //处理sku图片
        if(k.indexOf('sku_img_path')==0){
          var arr = k.split('||');
          var key = arr[1];
          sku_img_path[key] = v;
        }
         //处理sku属性
        if(k.indexOf('property_input')==0){
          var arr = k.split('||');
          var key = arr[1];
          property[key] = v;
        }
      })
      if(!stock){
        layer.msg('请添加商品库存！');
        return false;
      }
      if(!desc){
        layer.msg('请上传商品详情图！');
        return false;
      }
      /**处理数据**/
      $.ajax({
          type: "post",
          url: "<?=url('ShopGoods/addGoodsPost')?>",
          data: {
            post:data.field,
            logos:logos,
            desc:desc,
            price:price,
            stock:stock,
            stock_per_day:stock_per_day,
            score:score,
            code:code,
            sku_img_id:sku_img_id,
            property:property,
            sku_img_path:sku_img_path,
            max_num:max_num,
            is_ship:is_ship,
            auto_skip:auto_skip,
            special_center:special_center,
          },
          dataType: 'json',
          success: function(res) {
            if(res.code==0){
              layer.msg(res.message);
              setTimeout(function(){
                location.reload();
              },1100);
            }else{
              layer.msg(res.message);
            }
          },
          error: function(res) {
              layer.alert('系统故障！');
          },
      })
      return false;
    });
});
//删除详情图片
function imgDescDel(ev) {
  $(ev).parent('.tipBox ').remove();
}
$(function(){
  //移入图片
  $('#picss').on('mouseover','.tipBox',function(){
    $(this).find('.tip_img').show();
  })
  //移出图片
  $('#picss').on('mouseout','.tipBox',function(){
    $(this).find('.tip_img').hide();
  })
  $("#picss").sortable();
  $("#picss").disableSelection();
})
</script>
</body>
</html>