<?php
	$config = new Config();
?>
<form action="addarticle.php" method="post" enctype="multipart/form-data">
	<table>
		<tr>
			<td>Раздел:</td>
			<td>
				<select name="section_id"><?=$sections?></select>
			</td>
		</tr>
		<tr>
			<td>Заглавие:</td>
			<td><input type="text" value="<?=$title?>" name="title"></td>
		</tr>
		<tr>
			<td>Интро текст:</td>
			<td><textarea name="intro_text" rows="10" cols="40"><?=$intro_text?></textarea></td>
		</tr>
		<tr>
			<td>Текст статьи:</td>
			<td><textarea name="full_text" rows="10" cols="40"></textarea></td>
		</tr>
		<tr>
			<td>Загрузить картинку:</td>
			<td>
				<input type="file" name="img"/></td>
		</tr>
		<tr>
			<td colspan = "2"><input type="submit" value="Добавить" name="add" /></td>
		</tr>
	</table>
	
</form>