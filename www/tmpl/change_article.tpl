<form action="changearticle.php" method="post">
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
			<td><textarea name="full_text" rows="10" cols="40"><?=$full_text?></textarea></td>
		</tr>
		<tr>
			<td>Ссылка на картинку:</td>
			<td><input type="text" value="<?=$img_link?>" name="img_link"/></td>
		</tr>
		
		<tr>
			<input type="hidden" name="id" value="<?=$_GET['article_id']?>">
			<td colspan = "2"><input type="submit" value="Редактировать" name="change" /></td>
		</tr>
	</table>
	
</form>