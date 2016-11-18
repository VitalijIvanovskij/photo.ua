<div class="article">
	<div class="auto_img">
		<img src="<?=$img_link?>" alt="">
	</div>
	<h2><?=$title?></h2>
	<?=$intro_text?>
	<p class="right">
		<span><?=$date?></span>
		<br /><br />
		<a href="<?=$link_article?>"> Редактировать статью </a><br /><br/>
		<form action="delete_article.php" method="post" onsubmit="return apply()">
			<input type="hidden" name="article_id" value="<?=$delete_article?>">
			<input type="submit" value="Удалить статью" />
		</form>
	</p>
</div>
<hr />
<script type="text/javascript">
	function apply(){
		return confirm("Удалить статью?");
		
	}
</script>