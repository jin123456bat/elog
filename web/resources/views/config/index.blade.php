<?php
use App\Helper\Assets;
use App\Models\ConfigModel;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<title>日志管理系统</title>
<!-- 所有页面使用的样式 -->
<link rel="stylesheet" href="<?=Assets::css('main.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=Assets::css('spop.min.css')?>" type="text/css" media="all" />
<!-- 当前页面的插件使用的样式 -->
<link rel="stylesheet" href="<?=Assets::css('datatables.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=Assets::css('tab.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=Assets::css('panel.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=Assets::css('form.css')?>" type="text/css" media="all" />
</head>
<body>
	@include('common.header')
	<div class="container">
		@include('common.sidebar')
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
					<form method="post" action="<?=url('config/index')?>" class="form">
						<div class="tab">
							<div class="tab-header">
								<a class="tab-title active" href="#base"> 基础 </a>
								<a class="tab-title" href="#file"> 文件配置 </a>
							</div>
							<div class="tab-body">
								<div class="tab-page active" id="base">
									<div class="panel col-md-7 center-block">
										<div class="panel-head">
											<div class="panel-title">
												基础配置&nbsp;&nbsp;&nbsp;
												<span class="text-helper">基础配置</span>
											</div>
										</div>
										<div class="panel-body">
											<div class="form-group col-md-10">
												<label class="label col-md-2">项目名</label>
												<input type="text" class="input_text col-md-7" name="name" value="<?=ConfigModel::get('name')?>" placeholder="项目名">
											</div>
										</div>
									</div>
									<div class="form-submit">
										<div class="center-block submit-body">
											<button type="submit" class="button button-submit button-large">保存</button>
											<button type="reset" class="button button-cancel button-large">重置</button>
										</div>
									</div>
								</div>
								<div class="tab-page" id="file">
									<div class="panel col-md-7 center-block">
										<div class="panel-head">
											<div class="panel-title">
												文件存储&nbsp;&nbsp;&nbsp;
												<span class="text-helper">文件存储</span>
											</div>
										</div>
										<div class="panel-body">
											<div class="form-group col-md-10">
												<label class="label col-md-2">文件存储位置</label>
												<select class="select col-md-7" name="exception_file_storage">
													<option value="alioss">阿里云oss</option>
												</select>
											</div>
										</div>
									</div>
									<div class="panel col-md-7 center-block">
										<div class="panel-head">
											<div class="panel-title">
												阿里云oss&nbsp;&nbsp;&nbsp;
												<span class="text-helper">阿里云oss配置</span>
											</div>
										</div>
										<div class="panel-body">
											<div class="form-group col-md-10">
												<label class="label col-md-2">阿里oss的host</label>
												<input type="text" class="input_text col-md-7" name="alioss.host" value="<?=ConfigModel::get('alioss.host')?>" placeholder="">
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">阿里oss的endpoint</label>
												<input type="text" class="input_text col-md-7" name="alioss.endpoint" value="<?=ConfigModel::get('alioss.endpoint')?>" placeholder="">
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">阿里oss的bucket</label>
												<input type="text" class="input_text col-md-7" name="alioss.bucket" value="<?=ConfigModel::get('alioss.bucket')?>" placeholder="">
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">阿里oss的accessKeySecret</label>
												<input type="text" class="input_text col-md-7" name="alioss.accessKeySecret" value="<?=ConfigModel::get('alioss.accessKeySecret')?>" placeholder="">
											</div>
											<div class="form-group col-md-10">
												<label class="label col-md-2">阿里oss的accessKeyId</label>
												<input type="text" class="input_text col-md-7" name="alioss.accessKeyId" value="<?=ConfigModel::get('alioss.accessKeyId')?>" placeholder="">
											</div>
										</div>
									</div>
									<div class="form-submit">
										<div class="center-block submit-body">
											<button type="submit" class="button button-submit button-large">保存</button>
											<button type="reset" class="button button-cancel button-large">重置</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			@include('common.footer')
			<!-- 通用js -->
			<script type="text/javascript" src="<?=Assets::js('jquery.min.js','js')?>"></script>
			<!-- 全局js调用 -->
			<script type="text/javascript" src="<?=Assets::js('global.js')?>"></script>
			<!-- 当前页面使用的第三方类库的js -->
			<script type="text/javascript" src="<?=Assets::js('datatables.js')?>"></script>
			<script type="text/javascript" src="<?=Assets::js('spop.min.js')?>"></script>
			<script type="text/javascript" src="<?=Assets::js('tab.js')?>"></script>
			<script type="text/javascript">
tab.init();
</script>

</body>
</html>