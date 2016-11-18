<?php
	require_once "global_class.php";

	class Article extends GlobalClass{
		

		public function __construct($db){
			parent::__construct("articles", $db);
		}

		public function addArticle($params){
			return $this->db->insert("articles", $params);
		}

		public function deleteArticle($id){
			return $this->db->deleteOnID($this->table_name, $id);
		}

		//--------------------------------------------
		//				Методы Get
		//--------------------------------------------

		public function getAllSortDate(){
			return $this->getAll("date", false);
		}

		public function getAllOnSectionID($section_id){
			return $this->getAllOnField("section_id", $section_id, "date", false);
		}

		public function getSectionID($id){
			return $this->getFieldOnID($id, "section_id");
		}
		
		public function getTitle($id){
			return $this->getFieldOnID($id, "title");

		}

		public function getIntroText($id){
			return $this->getFieldOnID($id, "intro_text");
		}

		public function getFullText($id){
			return $this->getFieldOnID($id, "full_text");
		}

		public function getMetaDesc($id){
			return $this->getFieldOnID($id, "meta_desc");
		}

		public function getMetaKey($id){
			return $this->getFieldOnID($id, "meta_key");
		}

		public function getDate($id){
			return $this->getFieldOnID($id, "date");
		}

		public function getImgLink($id){
			return $this->getFieldOnID($id, "img_link");
		}

		//--------------------------------------------
		//				Методы Set
		//--------------------------------------------
		
		public function setSectionID($id, $section_id){
			if(!$this->valid->validSectionID($section_id)) return false;
			return $this->setFieldOnID($id, "section_id", $section_id);
		}

		public function setTitle($id, $title){
			if(!$this->valid->validTitle($title)) return false;
			return $this->setFieldOnID($id, "title", $title);
		}

		public function setIntroText($id, $intro_text){
			if(!$this->valid->validIntroText($intro_text)) return false;
			return $this->setFieldOnID($id, "intro_text", $intro_text);
		}

		public function setFullText($id, $full_text){
			if(!$this->valid->validFullText($full_text)) return false;
			return $this->setFieldOnID($id, "full_text", $full_text);
		}

		public function setMetaDesc($id, $meta_desc){
			if(!$this->valid->validMeta($meta_desc)) return false;
			return $this->setFueldOnID($id, "meta_desc", $meta_desc);
		}

		public function setMetaKey($id, $meta_key){
			if(!$this->valid->validMeta($meta_key)) return false;
			return $this->setFieldOnID($id, "meta_key", $meta_key);
		}

		public function setDate($id, $date){
			if(!$this->valid->validTimeStamp($date)) return false;
			return $this->setFieldOnID($id, "date", $date);
		}

		public function setImgLink($id, $img_link){
			$img_link = str_replace($this->config->address, "", $img_link);
			if(!$this->valid->validImgLink($img_link)) return false;
			return $this->setFieldOnID($id, "img_link", $img_link);
		}

		public function searchArticles($words){
			return $this->search($words, array("title", "full_text"));
		}
	}

?>