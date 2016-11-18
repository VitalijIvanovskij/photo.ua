<?php
	require_once "config_class.php";

	class CheckValid{
		private $config;

		public function __construct(){
			$this->config = new Config();
		}

		public function validID($id){

			if (!$this->isIntNumber($id)) return false;
			if($id <= 0) return false;
			return true;
		}

		private function isIntNumber($number){
			
			if(!is_int($number) && !is_string($number))	return false;
			if(!preg_match("/^-?([1-9][0-9]*|0)$/", $number)) return false;
			return true;
		}

		public function validLogin($login){
			if($this->isContainQuotes($login)) return false;
			if(preg_match("/^\d+$/", $login)) return false;
			return $this->validString($login, $this->config->min_login, $this->config->max_login);
		}

		public function validHash($hash){
			if(!$this->validString($hash, 32, 32)) return false;
			if(!$this->isOnlyLettersAndDigits($hash)) return false;
			return true;
		}

		public function validTimeStamp($date){
			
			return $this->isNoNegativeInteger($date);
		}

		public function validSectionID($section_id){
			return $this->isNoNegativeInteger($section_id);
		}

		public function validTitle($title){
			return $this->validString($title, $this->config->min_title, $this->config->max_title);
		}

		public function validImgLink($img_link){
			return $this->validString($img_link, $this->config->min_img_link, $this->config->max_img_link);
		}

		public function validMeta($meta){
			return $this->validString($meta, $this->config->min_meta, $this->config->max_meta);
		}

		public function validIntroText($intro_text){
			return $this->validString($intro_text, $this->config->min_intro, $this->config->max_intro);
		}

		public function validFullText($full_text){
			return $this->validString($full_text, $this->config->min_intro, $this->config->max_intro);
		}

		private function isContainQuotes($strin){
			$array = array("\"", "'", "`", "&quot;", "&apos;");
			foreach($array as $key => $value){
				if(strpos($string, $value)	!== false) return true;
			}
			return false;
		}

		private function validString($string, $min_length, $max_length){
			if(!is_string($string)) return false;
			if(strlen($string) < $min_length) return false;
			if(strlen($string) > $max_length) return false;
			return true;
		}

		private function isNoNegativeInteger($number){
			if(!$this->isIntNumber($number)) return false;
			if($number < 0) return false;
			return true;
		}

		private function isOnlyLettersAndDigits($string){
			if(!is_int($string) && (!is_string($string))) return false;
			if(preg_match("/[a-za-я0-9]+/i", $string));
			return true;
		}
	}
?>