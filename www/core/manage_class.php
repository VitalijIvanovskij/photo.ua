<?php

class Manage{

	private $user;
	private $config;
	private $data;

	public function __construct($db){
		session_start();
		$this->config = new Config();
		$this->user = new User($db);
		$this->data = $this->secureData($_REQUEST);
	}

	private function hashPassword($password){
		return md5($password.$this->config->secret);
	}

	public function login(){
		$login = $this->data["login"];
		$password = $this->data["password"];
		$password = $this->hashPassword($password);
		
		$r = $_SERVER["HTTP_REFERER"];
		if($this->user->checkUser($login, $password)){
			$_SESSION["login"] = $login;
			$_SESSION["password"] = $password;
			if($login == "Admin") $r = $this->config->address."?view=admin";
			return $r;
		}
		else{
			$_SESSION["login"] = $login;
			$_SESSION["error_auth"] = 1;
			return $r;
		}
	}

	public function logout(){
		$login = $_SESSION["login"];
		unset($_SESSION["login"]);
		unset($_SESSION["password"]);
		if($login != "Admin")
			return $_SERVER["HTTP_REFERER"];
		else 
			return $this->config->address;
	}

	public function redirect($link){
		header("Location: $link");
		exit;
	}

	public function regUser(){

		$link_reg = $this->config->address."?view=reg";
		$captcha = $this->data["captcha"];
		if (($_SESSION["rand"] != $captcha && $_SESSION["rand"] != "")){
			return $this->returnMessage("ERROR_CAPTCHA", $link_reg);
		}

		$login = $this->data["login"];

		if($this->user->isExistsUser($login)) {
			return $this->returnMessage("EXISTS_LOGIN", $link_reg);
		}

		$password = $this->data["password"];
		if($password == "") {
			return $this->unknownError($link_reg);
		}
		$password = $this->hashPassword($password);
		$result = $this->user->addUser($login, $password, time());
		
		if($result){
			$_SESSION["login"] = $login;
			$_SESSION["password"] = $password;
			return $this->returnPageMessage("SUCCESS_REG", $this->config->address."?view=message");
		}
		else return $this->unknownError($link_reg);
	}


	private function returnMessage($message, $r){
		$_SESSION["message"] = $message;
		return $r;
	}

	private function returnPageMessage($message, $r){		
		$_SESSION["page_message"] = $message;
		return $r;
	}

	private function secureData($data){
		foreach($data as $key => $value){
			if(is_array($value)) $this->secureData($value);
			else $data[$key] = htmlspecialchars($value);
		}
		return $data;
	}

	private function unknownError($r){
		return $this->returnMessage("UNKNOWN_ERROR", $r);
	}
}


?>