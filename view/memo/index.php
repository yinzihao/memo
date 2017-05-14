<html>
	<head>
	
	<!-- CSS goes in the document HEAD or added to your external stylesheet -->
	<style type="text/css">

	html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, font, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td {
    border: 0;
    outline: 0;
    font-size: 100%;
    vertical-align: baseline;
    background: transparent;
    margin: 0;
    padding: 0;
}

table {
    width: 100%;
}

reset.css:1
table {
    border-collapse: collapse;
    border-spacing: 0;
}
	table th {
    background: #d0d0d0 url(../images/box_c.png) repeat-x top left;
    font-size: 13px;
    font-weight: 400;
    color: #444;
    border-bottom: 1px solid #999a9b;
    text-align: left;
    font-family: "Lucida Sans Unicode","Lucida Grande",Sans-Serif;
    line-height: 19px;
    padding: 8px;
}

table td {
    background: #f0f0f0;
    font-size: 12px;
    border-top: 1px solid transparent;
    border-bottom: 1px solid #fff;
    color: #666;
    font-family: "Lucida Sans Unicode","Lucida Grande",Sans-Serif;
    line-height: 19px;
    padding: 8px;
}
	</style>
	</head>
	<body>
	<table>
		<tr> 
			<td colspan="4"><a href="memo_edit?memo_id=">新增</a></td>
		</tr>
		<tr> 
			<th>标题</th>
			<th>标签</th>
			<th>时间</th>
			<th>操作</th>
		</tr>
		<?php foreach ($data as $value): ?>
		<tr>
			<td><?=$value['memo_title'] ?></td>
			<td><span style="color: blue;font-size: 13px;">[<?=$value['tag_names'] ?>]</span></td>
			<td><span style="font-size: 12px;"><?=date('Y-m-d',$value['data_time']) ?></span></td>
			<td><a href="memo_edit?memo_id=<?=$value['memo_id'] ?>">编辑</a></td>
		</tr>
		<?php endforeach;?>
	</table>
	</body>
</html>