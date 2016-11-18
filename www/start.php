<?php
	error_reporting(E_ALL);
	ini_set("display_errors", 1);

	set_include_path(get_include_path().PATH_SEPARATOR."core".PATH_SEPARATOR."controllers");
	spl_autoload_extensions("_class.php");
	spl_autoload_register();

	session_start();
?>
