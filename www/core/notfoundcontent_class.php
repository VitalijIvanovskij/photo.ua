<?php

class NotFoundContent extends Modules{

	public function __construct($db){
		parent::__construct($db);
		header("HTTP/1.0 404 Not Found");
	}

	protected function getTitle(){
		return "Страница не найдена - 404";
	}
	protected function getDescription(){
		return "страница не найдена";
	}
	protected function getKeywords(){
		return "страница не найдена, страница не существует";
	}

	protected function getMiddle(){
		return $this->render("notfound", array(), true);
	}
}

?>