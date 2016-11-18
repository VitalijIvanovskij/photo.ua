<?php

class ContactsContent extends Modules{
	
	private $section_info;

	public function __construct($db){
		parent::__construct($db);
		$this->section_info = $this->section->get($this->data["id"]);
		if(!$this->section_info) $this->notFound();
	}

	protected function getTitle(){
		return $this->section_info["title"];
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
		return $this->getContacts();
	}

	private function getContacts(){
		return $this->render("contacts", Array(), true);
	}

}

?>