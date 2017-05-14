<?php
?>

<html>
	<head></head>
	<body>
		<form action="memo_save" method="post" >
			<input type="hidden" name="memo_id" value="<?=$data['memo_id'] ?>" />
			<table>
				<tr>
					<td>标题</td><td> <input type="text" value="<?=$data['memo_title'] ?>" name="memo_title" /> </td>
				</tr>
				<tr>
					<td>内容</td><td> <textarea cols="50" rows="10" type="text" name="memo_content"  ><?=$data['memo_content'] ?></textarea> </td>
				</tr>
				<tr>
					<td>标签(多个用逗号隔开)</td><td><input type="text" name="tag_names" value="<?=$data['tag_names'] ?>" /> </td>
				</tr>
				<tr>
					<td> <input type="submit" value="Save" /> </td>
				</tr>
			</table>
		</form>
	</body>
</html>