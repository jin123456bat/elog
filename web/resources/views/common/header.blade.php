<?php
use App\Helper\Assets;
use App\Models\ConfigModel;
?>
<header>
	<div class="nav">
		<div class="pull-left">
			<div class="logo"><?=ConfigModel::get('name')?></div>
			<div class="version">1.0</div>
		</div>
		<div class="center">

			<?php foreach ($menu as $m) {?>
			<div class="navigator <?=$m['active'] ? 'active' : ''?>">
				<a href="<?=$m['link']?>"><?=$m['name']?></a>
			</div>
			<?php }?>

			<div class="logout">
				<a href="<?=url('index/logout')?>"> <i class="iconfont icon-log-out"></i> 退出
				</a>
			</div>
			<div class="admin">
				<a> <img class="image circle" src="<?=!empty($user['gravatar_url']) ? $user['gravatar_url'] : ''?>" onerror="this.src='<?=Assets::image('default_gravatar.png')?>';">
					<?=$user['username']?>
				</a>
			</div>
		</div>
	</div>
</header>
<style type="text/css">
	.layui-form-label{
		box-sizing: content-box;
	}
	.layui-btn .layui-icon{
		margin-right: 0px !important;
	}
	.layui-table-view .layui-table{
		width: 100% !important;
	}
	.layui-table-tips-c:before {
	    position: relative;
	    right: 1px;
	    top: -3px;
	}
</style>