<?php

class AdminPanelContent extends Modules{

	private $articles;

	public function __construct($db){
		parent::__construct($db);
		$this->articles = $this->article->getAllSortDate();
		
		$this->page = (isset($this->data["page"]))? $this->data["page"]: 1;
	}

	protected function getBlogArticlesAdmin($articles, $page){
		$start = ($page -1) * $this->config->count_blog;
		$end = (count($articles) > $start + $this->config->count_blog)? ($start + $this->config->count_blog) : count($articles);
		$text = "";
		for ($i=$start; $i < $end; $i++){
			$params["title"] = $articles[$i]["title"];
			$params["intro_text"] = $articles[$i]["intro_text"];
			$params["date"] = $this->formatDate($articles[$i]["date"]);
			$params["img_link"] = $this->config->address.$articles[$i]["img_link"];
			$params["link_article"] = $this->config->address."?view=admin&amp;article_id=".$articles[$i]["id"];
			$params["delete_article"] = $articles[$i]["id"];
			$text .= $this->render("article_intro_admin", $params, true);
		}
		return $text;
	}


	protected function getSections($s_id = 1){
		$sections = $this->menu->getAll();
		$text = "";
		$params["selected"] = "";
		for($i = 0; $i < count($sections); $i++){
			$params["title"] = $sections[$i]["title"];
			$params["section_id"] = $sections[$i]["id"];
			if($i == ($s_id-1)) $params["selected"] = " selected";
			$text .= $this->render("change_article_sections", $params, true);
			$params["selected"] = "";
		}
		return $text;
	}	

	protected function getTitle(){
		if($this->page > 1) return "Cайт закладів культури с.Осинове - ".$this->page;
		else return "Cайт закладів культури с.Осинове";
	}
	protected function getDescription(){
		return "Cайт закладів культури с.Осинове";
	}
	protected function getKeywords(){
		return "Cайт закладів культури с.Осинове";
	}

	protected function getTop(){
		return $this->render("adminpanel", Array(), true);
	}

	protected function getMiddle(){
		if(isset($_GET["article_id"])){
			$i = $_GET["article_id"];
			$article_section_id = $this->article->getSectionId($i);
			$params["title"] = $this->article->getTitle($i);
			$params["intro_text"] = $this->article->getIntroText($i);
			$params["full_text"] = $this->article->getFullText($i);
			$params["img_link"] = $this->config->address.$this->article->getImgLink($i);
			$params["sections"] = $this->getSections($article_section_id);
			return $this->render("change_article", $params, true);
		}
		if(isset($_GET["add"])){
			$params["title"] = "";
			$params["intro_text"] = "";
			$params["img_link"] = "";
			$params["sections"] = $this->getSections();
			return $this->render("add_article", $params, true);
		}
		return $this->getBlogArticlesAdmin($this->articles, $this->page);
	}

	protected function getBottom(){
		
		//return $this->getPagination(count($this->articles), $this->config->count_blog, $this->config->address);
	}

}

?>