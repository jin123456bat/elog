<?php
use jin123456bat\assets;
use think\facade\Request;
use jin123456bat\companyController;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <title><?=$setting['site_title']?> | <?=$setting['site_desc']?></title>
    <!-- 所有页面使用的样式 -->
    <link rel="stylesheet" href="<?=assets::css('main.css')?>" type="text/css" media="all" />
    <link rel="stylesheet" href="<?=assets::css('spop.min.css')?>" type="text/css" media="all" />
    <!-- 当前页面的插件使用的样式 -->
    <link rel="stylesheet" href="<?=assets::css('datatables.css')?>" type="text/css" media="all" />
    <link rel="stylesheet" href="<?=assets::css('tab.css')?>" type="text/css" media="all" />
    <link rel="stylesheet" href="<?=assets::css('datetimepicker.css')?>" type="text/css" media="all" />
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
                <div class="tab">
                    <div class="tab-header">
                        <a class="tab-title active" href="#income">
                            佣金收入
                        </a>
                        <a class="tab-title" href="#outcome">
                            佣金支出
                        </a>
                    </div>
                    <div class="tab-body">
                        <div class="tab-page active" id="income">
                            <div class="line"></div>
                            <div class="top-tips">
                                <div class="top-tips-title">操作提示</div>
                                <div class="top-tips-body">
                                    <p>通过酒店联盟佣金收入</p>
                                </div>
                            </div>
                            <div class="line">
                                <form class="search col-md-10" style="display: inline-block;">
                                    <input type="text" name="keywords" placeholder="订单号" class="input_text col-md-2">
                                    <input type="text" name="starttime" placeholder="创建开始时间" class="input_text datepicker">
                                    <input type="text" name="endtime" placeholder="创建结束时间" class="input_text datepicker">
                                    <button class="button primary" type="submit">搜索</button>
<!--                                    <button class="button primary" type="button">导出</button>-->
                                </form>
                            </div>
                            <div class="tablebox">
                                <table class="table" data-ajax-url="<?=url('log/companyCommission')?>">
                                    <thead>
                                    <tr>
                                        <th>订单号</th>
                                        <th>订单金额</th>
                                        <th>佣金比例</th>
                                        <th>佣金来源</th>
                                        <th>获得佣金金额</th>
                                        <th>获得佣金时间</th>
                                        <th>备注</th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td id="split_page" colspan="20"></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="tab-page" id="outcome">
                            <div class="line"></div>
                            <div class="top-tips">
                                <div class="top-tips-title">操作提示</div>
                                <div class="top-tips-body">
                                    <p>通过酒店联盟佣金收入</p>
                                </div>
                            </div>
                            <div class="line">
                                <form class="search col-md-10" style="display: inline-block;">
                                    <input type="text" name="keywords" placeholder="订单号" class="input_text col-md-2">
                                    <input type="text" name="starttime" placeholder="创建开始时间" class="input_text datepicker">
                                    <input type="text" name="endtime" placeholder="创建结束时间" class="input_text datepicker">
                                    <button class="button primary" type="submit">搜索</button>
<!--                                    <button class="button primary" type="button">导出</button>-->
                                </form>
                            </div>
                            <div class="tablebox">
                                <table class="table" data-ajax-url="<?=url('log/companyCommission')?>">
                                    <thead>
                                    <tr>
                                        <th>订单号</th>
                                        <th>订单金额</th>
                                        <th>佣金比例</th>
                                        <th>支出去向</th>
                                        <th>支出佣金金额</th>
                                        <th>支出佣金时间</th>
                                        <th>备注</th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td id="split_page" colspan="20"></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
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
<!-- 当前页面使用的第三方类库的js -->
<script type="text/javascript" src="<?=assets::js('datatables.js')?>"></script>
<script type="text/javascript" src="<?=assets::js('jquery.dialog.js')?>"></script>
<script type="text/javascript" src="<?=assets::js('spop.min.js')?>"></script>
<script type="text/javascript" src="<?=assets::js('button.loading.js')?>"></script>
<script type="text/javascript" src="<?=assets::js('datetimepicker.js')?>"></script>
<script>
    $.ajaxSetup({
        headers: {
            '__token__': '<?=Request::token('__token__')?>' ,
        } ,
    });
</script>
<!-- 当前页面独有的js -->
<script type="text/javascript">
    $('.all_checked').on('click',function(){
        $(this).parents('table').find('tbody input[type=checkbox]').prop('checked',$(this).is(':checked'));
    });
    $('.datepicker').each(function(){
        $(this).datetimepicker({
            select:'date',
        });
    });
    $('.tab').on('click','.tab-title',function(){
        $(this).siblings().removeClass('active');
        $(this).addClass('active');

        var href = $(this).attr('href') || $(this).data('href');
        if($(href).length===1)
        {
            $(href).siblings().removeClass('active');
            $(href).addClass('active');
        }
        else
        {
            window.location = href;
        }
        return false;
    });
    var income = datatables({
        table:$('#income .table'),
        ajax:{
            data:{
                type:0
            },
            method:'post',
        },
        columns:[{
            data:'orderno',
        },{
            data:'total_price',
            render:function (data,full) {
                return parseFloat(data/100).toFixed(2);
            }
        },{
            data:'rate'
        },{
            data:'from_company_name'
        },{
            data:'money',
            render:function (data,full) {
                return parseFloat(data/100).toFixed(2);
            }
        },{
            data:'createtime'
        },{
            data:'remark',
            render:function (data,full) {
                return data?data:'无';
            }
        }],
        sort:{
            createtime:'desc',
        },
        pagesize:10,
        onRowLoaded:function(row){

        }
    });
    $('#income .search').on('submit',function(){
        income.addAjaxParameter('keywords',$(this).find('input[name=keywords]').val());
        income.addAjaxParameter('start_time',$(this).find('input[name=starttime]').val());
        income.addAjaxParameter('end_time',$(this).find('input[name=endtime]').val());
        income.addAjaxParameter('type',0);
        income.page(0);
        income.reload();
        return false;
    });

    var outcome = datatables({
        table:$('#outcome .table'),
        ajax:{
            data:{
                type:1
            },
            method:'post',
        },
        columns:[{
            data:'orderno',
        },{
            data:'total_price',
            render:function (data,full) {
                return parseFloat(data/100).toFixed(2);
            }
        },{
            data:'rate'
        },{
            data:'company_name'
        },{
            data:'money',
            render:function (data,full) {
                return parseFloat(data/100).toFixed(2);
            }
        },{
            data:'createtime'
        },{
            data:'remark',
            render:function (data,full) {
                return data?data:'无';
            }
        }],
        sort:{
            createtime:'desc',
        },
        pagesize:10,
        onRowLoaded:function(row){

        }
    });
    $('#outcome .search').on('submit',function(){
        outcome.addAjaxParameter('keywords',$(this).find('input[name=keywords]').val());
        outcome.addAjaxParameter('start_time',$(this).find('input[name=starttime]').val());
        outcome.addAjaxParameter('end_time',$(this).find('input[name=endtime]').val());
        outcome.addAjaxParameter('type',1);
        outcome.page(0);
        outcome.reload();
        return false;
    });
</script>
</body>
</html>