<?php
	require_once "start.php";

	if(isset($_POST["add"])){
		$db = new DataBase();
		$article = new Article($db);
		$config = new Config();
		$params["title"] = $_POST["title"];
		$params["section_id"] = $_POST["section_id"];
		$params["intro_text"] = $_POST["intro_text"];
		$params["full_text"] = $_POST["full_text"];
		$params["img_link"] = "images/".$_FILES["img"]["name"];
		$params["date"] = time();
		$article->addArticle($params);
		$uploadfile = "images/";
		$uploadfile .= iconv("UTF-8", "WINDOWS-1251", basename($_FILES["img"]["name"]));

		if($_FILES["img"]["size"] > 3*1024*1024){
		     echo "Размер файла превышает три мегабайта";
		     exit;
		 }
		if(is_uploaded_file($_FILES['img']['tmp_name'])){
			if (!copy($_FILES["img"]["tmp_name"], $uploadfile)){
				echo "Ошибка! Не удалось скопировать загруженый файл из временной директории.";
				exit;
			}

		}/*
		else {
			echo "Ошибка! Не удалось загрузить файл на сервер!";
			exit;
		}*/
	}
	
	header("Location: http://photo.ua/?view=admin");
?>