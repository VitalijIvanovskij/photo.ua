<?php
	mb_internal_encoding("UTF-8");

	require_once "start.php";

	$db = new DataBase();
	$config = new Config();

	if($_SERVER["QUERY_STRING"] == "") 
		$content = new FrontPageContent($db);
	else if(isset($_GET["view"])){
		$view = $_GET["view"];
		switch($view){
			case "admin":
				if(isset($_SESSION["login"])) $login = $_SESSION["login"];
				else $login = "";

				if($login == "Admin"){
					$content = new AdminPanelContent($db);
					break;
				}

				else{
					$content = new NotFoundContent($db);
					break;
				}
			case "article":
				$content = new ArticleContent($db);
				break;
				
			case "main": 
				$content = new FrontPageContent($db);
				break;

			case "message":
				$content = new MessageContent($db);
				break;
			
			case "reg":
				$content = new RegContent($db);
				break;

			case "section":
				
				$content = new SectionContent($db);
				break;
			
			default:
				$content = new NotFoundContent($db);
				break;
		}
	}

	echo $content->getContent();
?>