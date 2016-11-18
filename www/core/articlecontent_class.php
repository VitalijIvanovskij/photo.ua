<?php
require_once "modules_class.php";

class ArticleContent extends Modules{
	
	private $article_info;

	public function __construct($db){
		parent::__construct($db);
		$this->article_info = $this->article->get($this->data["id"]);
		if(!$this->article_info) $this->notFound();
	}

	protected function getTitle(){

		return $this->article_info["title"];
	}
	protected function getDescription(){
		return $this->article_info["meta_desc"];
	}
	protected function getKeywords(){
		return $this->article_info["meta_key"];
	}

	protected function getMiddle(){
		return $this->getArticle();
	}

	private function getArticle(){
		$params["title"] = $this->article_info["title"];
		$params["full_text"] = $this->article_info["full_text"];
		$params["img_link"] = $this->article_info["img_link"];
		$params["date"] = $this->formatDate($this->article_info["date"]);
		$params["back"] = "";
		if(isset($_SERVER["HTTP_REFERER"]))
			$params["back"] = $_SERVER["HTTP_REFERER"];
		if(isset($_GET["gallery"]))
			return $this->render("gallery", $params, true);
		return $this->render("article", $params, true);
	}

}

?>