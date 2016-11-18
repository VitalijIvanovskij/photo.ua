<?php
require_once "modules_class.php";

class SectionContent extends Modules{
	
	private $articles;
	private $section_info;
	private $page;	

	public function __construct($db){
		parent::__construct($db);
		$this->articles = $this->article->getAllOnSectionID($this->data["id"]);
		$this->section_info = $this->section->get($this->data["id"]);
		if(!$this->section_info) $this->notFound();
		$this->page = (isset($this->data["page"]))? $this->data["page"]: 1;
	}

	protected function getTitle(){
		if($this->page > 1) return $this->section_info["title"]."Страница ".$this->page;
		else return $this->section_info["title"];
	}
	protected function getDescription(){
		return $this->section_info["meta_desc"];
	}
	protected function getKeywords(){
		return $this->section_info["meta_key"];
	}

	protected function getTop(){
		$params["title"] = $this->section_info["title"];
		$params["description"] = $this->section_info["description"];
		return $this->render("section", $params, true);
	}

	protected function getMiddle(){
		if($this->section_info["title"] == "Контакти")
			return $this->render("contacts", Array(), true);
		if($this->section_info["title"] == "Галерея")
			return $this->getGalery($this->articles, $this->page);

		return $this->getBlogArticles($this->articles, $this->page);
	}

	protected function getBottom(){
		
		return $this->getPagination(count($this->articles), $this->config->count_blog, $this->config->address."?view=section&amp;id=".$this->data["id"]);
	}

	private function getGalery($articles, $page){
		$start = ($page -1) * $this->config->count_blog;
		$end = (count($articles) > $start + $this->config->count_blog)? ($start + $this->config->count_blog) : count($articles);
		$text = "";
		for ($i=$start; $i < $end; $i++){
			$params["title"] = $articles[$i]["title"];
			$params["intro_text"] = $articles[$i]["intro_text"];
			$params["date"] = $this->formatDate($articles[$i]["date"]);
			$params["img_link"] = $this->config->address.$articles[$i]["img_link"];
			$params["link_article"] = $this->config->address."?view=article&amp;id=".$articles[$i]["id"]."&amp;gallery=1";
			$text .= $this->render("article_intro", $params, true);

		}
		return $text;
	}

}

?>