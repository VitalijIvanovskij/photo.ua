<?php
	require_once "start.php";

	if(isset($_POST["change"])){
		$id = $_POST["id"];
		$db = new DataBase();
		$article = new Article($db);
		$article->setTitle($id, $_POST["title"]);
		$article->setIntroText($id, $_POST["intro_text"]);
		$article->setFullText($id, $_POST["full_text"]);
		$article->setImgLink($id, $_POST["img_link"]);
		$article->setSectionID($id, $_POST["section_id"]);
	}
	header("Location: http://photo.ua/?view=admin");
?>