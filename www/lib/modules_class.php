<?php
require_once "config_class.php";
require_once "article_class.php";
require_once "section_class.php";
require_once "user_class.php";
require_once "menu_class.php";
require_once "banners_class.php";
require_once "message_class.php";

abstract class Modules{

	protected $config;
	protected $article;
	protected $section;
	protected $user;
	protected $menu;
	protected $banner;
	protected $message;
	protected $data;


	public function __construct($db){
		session_start();
		$this->config = new Config($db);
		$this->article = new Article($db);
		$this->section = new Section($db);
		$this->user = new User($db);
		$this->menu = new Menu($db);
		$this->banner = new Banner($db);
		$this->message = new Message("");
		$this->data = $this->secureData($_GET);
	}

	private function secureData($data){
		foreach($data as $key => $value){
			if(is_array($value)) $this->secureData($value);
			else $data[$key] = htmlspecialchars($value);
		}
		return $data;
	}

	protected function getTemplate($name){
		$text = file_get_contents($this->config->dir_tmpl.$name.".tpl");
		return str_replace("%address%", $this->config->address, $text);
	}

	protected function getReplaceTemplate($sr, $template){
		return $this->getReplaceContent($sr, $this->getTemplate($template));
	}

	private function getReplaceContent($sr, $content){
		$search = array();
		$replace = array();
		$i = 0;
		foreach($sr as $key => $value){
			$search[$i] = "%$key%";
			$replace[$i] = $value;
			$i++;
		}
		return str_replace($search, $replace, $content);
	}

	public function getContent(){
		$sr["title"] = $this->getTitle();
		$sr["menu"] = $this->getMenu();
		$sr["meta_desc"] = $this->getDescription();
		$sr["meta_key"] = $this->getKeyWords();
		$sr["auth_user"] = $this->getAuthUser();
		$sr["banners"] = $this->getBanners();
		$sr["top"] = $this->getTop();
		$sr["middle"] = $this->getMiddle();
		$sr["bottom"] = $this->getBottom();
		return $this->getReplaceTemplate($sr, "main");
	}

	abstract protected function getTitle();
	abstract protected function getDescription();
	abstract protected function getKeywords();
	abstract protected function getMiddle();

	protected function getMenu(){
		$menu = $this->menu->getAll();
		for($i = 0; $i < count($menu); $i++){
			$sr["title"] = $menu[$i]["title"];
			$sr["link"] = $menu[$i]["link"];
			$text .= $this->getReplaceTemplate($sr, "menu_item");
		}
		return $text;
	}

	protected function getAuthUser(){
		$sr["message_auth"] = "";
		return $this->getReplaceTemplate($sr, "form_auth");
	}

	protected function getBanners(){
		$banners = $this->banner->getAll();
		$text = "";
		for($i = 0; $i < count($banners); $i++){
			$sr["code"] = $banners[$i]["code"];
			$text .= $this->getReplaceTemplate($sr, "banners");
		}

		return $text;

	}

	protected function getBlogArticles($articles, $page){
		$start = ($page -1) * $this->config->count_blog;
		$end = (count($articles) > $start + $this->config->count_blog)? ($start + $this->config->count_blog) : count($articles);
		for ($i=$start; $i < $end; $i++){
			$sr["title"] = $articles[$i]["title"];
			$sr["intro_text"] = $articles[$i]["intro_text"];
			$sr["date"] = $this->formatDate($articles[$i]["date"]);
			$sr["link_article"] = $this->config->adress."?view=article&amp;id=".$articles[$i]["id"];
			$text .= $this->getReplaceTemplate($sr, "article_intro");
		}
		return $text;
	}

	protected function getTop(){
		return "";
	}

	protected function getBottom(){
		return "";
	}

	protected function getPagination($count, $count_on_page, $link){
		$count_pages = ceil($count / $count_on_page);
		$sr["number"] = 1;
		$sr["link"] = $link;
		$pages = $this->getReplaceTemplate($sr, "number_page");
		$sym = (strpos($link, "?") !== false)? "&amp;":"?";
		for($i=2; $i <= $count_pages; $i++){
			$sr["number"] = $i;
			$sr["link"] = $link.$sym."page=$i";
			$pages .= $this->getReplaceTemplate($sr, "number_page");
		}
		$els["number_pages"] = $pages;
		return $this->getReplaceTemplate($els, "pagination");
	}

	protected function formatDate($time){
		return date("Y-m-d H:m:s", $time);
	}
}
	
?>