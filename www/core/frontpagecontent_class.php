<?php

class FrontPageContent extends Modules{
	
	private $articles;
	private $page;	

	public function __construct($db){
		parent::__construct($db);
		$this->articles = $this->article->getAllSortDate();
		
		$this->page = (isset($this->data["page"]))? $this->data["page"]: 1;
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
		//return $this->getTemplate("main_article");
	}

	protected function getMiddle(){
		return $this->getBlogArticles($this->articles, $this->page);
	}

	protected function getBottom(){
		return $this->getPagination(count($this->articles), $this->config->count_blog, $this->config->address."?view=main");
	}

}

?>