<?php
?>

<html>
<head>
<link type="text/css" media="all"
	href="https://cdn.bootcss.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
	rel="stylesheet">
	
	<!--引入wangEditor.css-->
<link rel="stylesheet" type="text/css" href="<?=STATIC_PATH ?>lib/wang/dist/css/wangEditor.min.css">

<!--引入jquery和wangEditor.js-->   <!--注意：javascript必须放在body最后，否则可能会出现问题-->
<script type="text/javascript" src="<?=STATIC_PATH ?>lib/wang/dist/js/lib/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?=STATIC_PATH ?>lib/wang/dist/js/wangEditor.min.js"></script>
</head>

<body>
	<form action="memo_save" method="post">
	<div style="width: 700px;margin: 10 10;">
	<input type="hidden" name="memo_id" value="<?=$data['memo_id'] ?>" />
		<div class="form-group">
			<label for="memo_title">标题</label> 
			<input type="text" class="form-control" id="memo_title" name="memo_title" value="<?=$data['memo_title'] ?>" placeholder="标题">
		</div>
		<div class="form-group">
			<label for="memo_content">内容</label> 
			<textarea class="form-control" rows="3" style="height:400px;max-height:500px;" id="memo_content" name="memo_content" placeholder="内容"><?=$data['memo_content'] ?></textarea>
		</div>
		<div class="form-group">
			<label for="tag_names">标签(多个用逗号隔开)</label> 
			<input type="text" class="form-control" id="tag_names" name="tag_names" value="<?=$data['tag_names'] ?>" placeholder="生活,工作,...">
		</div>

		<button type="submit" class="btn btn-default">Submit</button>
	</div>
	</form>
</body>
<!--这里引用jquery和wangEditor.js-->
<script type="text/javascript">
    var editor = new wangEditor('memo_content');
 // 上传图片（举例）
    editor.config.uploadImgUrl = '/index.php/memo/upload';

    // 配置自定义参数（举例）
    editor.config.uploadParams = {
        token: 'abcdefg',
        user: 'wangfupeng1988'
    };

    // 设置 headers（举例）
    editor.config.uploadHeaders = {
        'Accept' : 'text/x-json'
    };

    // 隐藏掉插入网络图片功能。该配置，只有在你正确配置了图片上传功能之后才可用。
    editor.config.hideLinkImg = false;
    editor.config.uploadImgFileName = 'file'
    editor.create();
</script>
</html>