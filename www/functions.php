<?php
	set_include_path(get_include_path().PATH_SEPARATOR."core".PATH_SEPARATOR."controllers");
	spl_autoload_extensions("_class.php");
	spl_autoload_register();

	$db = new DataBase();
	$manage = new Manage($db);


	if(isset($_POST["reg"])){
		$r = $manage->regUser();
	}
	
	if (isset($_POST["auth"])){
		$r = $manage->login();
	}
	
	if($_GET["logout"] == 1){
		$r = $manage->logout();
	}
	

	$manage->redirect($r);

?>