<?php
?>

<html>
	<head></head>
	<body>
	<?php foreach ($data as $value): ?>
		<div>
			<div><span><?=$value['memo_title'] ?></span> </div>
			<div><span style="color: blue;font-size: 13px;">[<?=$value['tag_names'] ?>]</span></div>
			<div><span style="font-size: 12px;"><?=date('Y-m-d',$value['data_time']) ?></span></div>
		</div>
		<hr/>
	<?php endforeach;?>
	</body>
</html>