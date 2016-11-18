<?php
	require_once "start.php";

	$db = new DataBase();
	$article = new Article($db);
	$article->deleteArticle($_REQUEST["article_id"]);
	header("Location: http://photo.ua/?view=admin");
?>