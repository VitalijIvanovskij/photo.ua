<?php

// Класс шаблонизатор

abstract class Modules{

	protected $config;
	protected $article;
	protected $section;
	protected $user;
	protected $menu;
	protected $banner;
	protected $message;
	protected $data;
	protected $user_info;


	public function __construct($db){
		$this->config = new Config($db);
		$this->article = new Article($db);
		$this->section = new Sections($db);
		$this->user = new User($db);
		$this->menu = new Menu($db);
		//$this->banner = new Banner($db);
		$this->message = new Message();
		$this->data = $this->secureData($_GET);
		$this->user_info = $this->getUser();
	}

	protected function getAuthUser(){
		$params["login"] = "";
		if ($this->user_info){
			$params["username"] = $this->user_info["login"];
			$params["address"] = $this->config->address;
			return $this->render("user_panel", $params, true);
		}
		if(isset($_SESSION["error_auth"])){
			if($_SESSION["error_auth"] == 1){
				$params["message_auth"] = $this->getMessage("ERROR_AUTH");
				unset($_SESSION["error_auth"]);
				$params["login"] = $_SESSION["login"];
			}
		}
		else{ 
			$params["message_auth"] = "";
			$params["address"] = $this->config->address;
		}

		return $this->render("form_auth", $params, true);
	}
/*
	protected function getBanners(){
		$banners = $this->banner->getAll();
		$text = "";
		for($i = 0; $i < count($banners); $i++){
			$params["code"] = $banners[$i]["code"];
			$text .= $this->render("banners", $params, true);
		}

		return $text;
	}
*/
	protected function getBlogArticles($articles, $page){
		$start = ($page -1) * $this->config->count_blog;
		$end = (count($articles) > $start + $this->config->count_blog)? ($start + $this->config->count_blog) : count($articles);
		$text = "";
		for ($i=$start; $i < $end; $i++){
			$params["title"] = $articles[$i]["title"];
			$params["intro_text"] = $articles[$i]["intro_text"];
			$params["date"] = $this->formatDate($articles[$i]["date"]);
			$params["img_link"] = $this->config->address.$articles[$i]["img_link"];
			if(isset($_SESSION["login"]) && $_SESSION["login"] == "Admin")
				$params["link_article"] = $this->config->address."?view=admin&amp;article_id=".$articles[$i]["id"];
			else
				$params["link_article"] = $this->config->address."?view=article&amp;id=".$articles[$i]["id"];

			if(isset($_SESSION["login"]) && $_SESSION["login"] == "Admin"){

				$text .= $this->render("article_intro_admin", $params, true);
			}
			else
				$text .= $this->render("article_intro", $params, true);

		}
		return $text;
	}

	protected function getBottom() {
		return "";
	}

	public function getContent(){
		$params["title"] = $this->getTitle();
		$params["menu"] = $this->getMenu();
		$params["meta_desc"] = $this->getDescription();
		$params["meta_key"] = $this->getKeyWords();
		$params["auth_user"] = $this->getAuthUser();
		//$params["banners"] = $this->getBanners();
		$params["top"] = $this->getTop();
		$params["middle"] = $this->getMiddle();
		$params["bottom"] = $this->getBottom();
		return $this->render("main", $params, true);
	}

	protected function getMessage(){
		$message = "";
		if(isset($_SESSION["message"]))
			$message = $_SESSION["message"];
		unset($_SESSION["message"]);
		$params["message"] = $this->message->getText($message);
		return $this->render("message_string", $params, true);
	}

	protected function getMenu(){
		$menu = $this->menu->getAll();
		$text = "";
		for($i = 0; $i < count($menu); $i++){
			$params["title"] = $menu[$i]["title"];
			$params["link"] = $this->config->address.$menu[$i]["link"];
			$text .= $this->render("menu_item", $params, true);
		}
		return $text;
	}	
	

	protected function getPagination($count_articles, $count_on_page, $link){
		$count_pages = ceil($count_articles / $count_on_page);
		$pages = "";
		if($count_pages > 1){
			$params["number"] = 1;
			$params["link"] = $link;
			$pages = $this->render("number_page", $params, true)."|";
			$sym = (strpos($link, "?") !== false)? "&amp;":"?";
			for($i=2; $i <= $count_pages; $i++){
				$params["number"] = $i;
				$params["link"] = $link.$sym."page=$i";
				$pages .= $this->render("number_page", $params, true);
				if($i < $count_pages)
					$pages .= "|";
			}
			$els["number_pages"] = $pages;
			return $this->render("pagination", $els, true);
		}
		else{
			$els["number_pages"] = $pages;
			return $this->render("pagination", $els, true);
		}
	}

	protected function getTop()	{
		return "";
	}

	private function getUser(){
		$login = "";
		$password = "";
		if(isset($_SESSION["login"]))
			$login = $_SESSION["login"];
		if(isset($_SESSION["password"]))
			$password = $_SESSION["password"];
		if ($this->user->checkUser($login, $password)){
			return $this->user->getUserOnLogin($login);
		}
		else return false;

	}

	abstract protected function getTitle();
	abstract protected function getDescription();
	abstract protected function getKeywords();
	abstract protected function getMiddle();

	protected function formatDate($time){
		return date("Y-m-d H:i", $time);
	}

	protected function notFound(){
		$this->redirect($this->config->address."?view=notfound");
	}

	protected function redirect($link){
		header("Location: $link");
		exit;
	}

	public function render($file, $params, $return = false){
            $template = $this->config->dir_tmpl.$file.".tpl";
            extract($params);
            ob_start();
            include($template);
            if ($return) return ob_get_clean();
            else echo ob_get_clean();
        }

	private function secureData($data){
		foreach($data as $key => $value){
			if(is_array($value)) $this->secureData($value);
			else $data[$key] = htmlspecialchars($value);
		}
		return $data;
	}	
}
	
?>