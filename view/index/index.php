<html>
	<head>
		<title>Search</title>
		<link type="text/css" media="all" href="https://cdn.bootcss.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" rel="stylesheet">
		<script type="text/javascript" src="http://libs.baidu.com/jquery/1.7.2/jquery.min.js"></script>
	</head>
	<body style="margin:auto;padding:auto;">
	<div style="width: 1000px;margin: auto;margin-top: 20px;">
		<form action="" method="get" id="search_form">
			<div class="input-group" style="width: 50%;margin-bottom: 30px;">
				<input type="text" class="form-control" placeholder="Search keywords..." aria-describedby="basic-addon2" name="keyword" value="<?=$keyword ?>">
		  		<span class="input-group-addon" id="basic-addon2" style="cursor: pointer;">Search</span>
			</div>
		</form>
		
		<?php foreach ($data as $value): ?>
			<div>
				<div><span><?=$value['attrs']['memo_title'] ?></span> </div>
				<div><span style="color: blue;font-size: 13px;"><?=$value['attrs']['memo_content'] ?></span></div>
			</div>
			<hr/>
		<?php endforeach;?>
	</div>
	</body>
	<script type="text/javascript">
		$('#basic-addon2').click(function(){
			$("#search_form").submit();
		});
	</script>
</html>

