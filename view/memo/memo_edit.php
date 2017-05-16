<?php
?>

<html>
<head>
<link type="text/css" media="all"
	href="https://cdn.bootcss.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
	rel="stylesheet">
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
			<textarea class="form-control" rows="3" id="memo_content" name="memo_content" value="<?=$data['memo_content'] ?>" placeholder="内容"></textarea>
		</div>
		<div class="form-group">
			<label for="tag_names">标签(多个用逗号隔开)</label> 
			<input type="text" class="form-control" id="tag_names" name="tag_names" value="<?=$data['tag_names'] ?>" placeholder="生活,工作,...">
		</div>

		<button type="submit" class="btn btn-default">Submit</button>
	</div>
	</form>
</body>
</html>