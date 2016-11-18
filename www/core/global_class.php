<?php
	/*В этом классе вынесены общие элементы для вывода таблиц из БД. Для вывода каждой таблицы
	нужен свой класс*/
	

	abstract class GlobalClass{

		protected $db;
		protected $table_name;
		protected $config;
		protected $valid;

		protected function __construct($table_name, $db){
			$this->db = $db;
			$this->table_name = $table_name;
			$this->config = new Config();
			$this->valid = new CheckValid();
		}

		protected function add($new_values){
			return $this->db->insert($this->table_name, $new_values);
		}

		protected function edit($id, $upd_fields){
			return $this->db->updsateOnID($this->table_name, $id, $upd_fields);
		}

		public function delete($id){
			return $this->db->deleteOnID($this->table_name, $id);
		}

		public function deleteAll(){
			return $this->db->deleteAll($this->table_name);
		}


		protected function isExists($field, $value){
			return $this->db->isExists($this->table_name, $field, $value);
		}

		protected function getField($field_out, $field_in, $value_in){
			return $this->db->getField($this->table_name, $field_out, $field_in, $value_in);
		}

		protected function getFieldOnID($id, $field){
			return $this->db->getFieldOnId($this->table_name, $id, $field);
		}

		

		public function get($id){
			return $this->db->getElementOnID($this->table_name, $id);
		}

		public function getAll($order = "", $up =true){
			return $this->db->getAll($this->table_name, $order, $up);
		}

		protected function getAllOnField($field, $value, $order = "", $up = true){
			return $this->db->getAllOnField($this->table_name, $field, $value, $order, $up);
		}

		public function getRandomElement($count){
			return $this->db->getRandomElements($this->table_name, $count);
		}

		public function getCount(){
			return $this->db->getCount($this->table_name);
		}



		public function getLastID(){
			return $this->db->getLastID($this->table_name);
		}

		protected function setFieldOnID($id, $field, $value){
			return $this->db->setFieldOnID($this->table_name, $id, $field, $value);
		}

		protected function search($words, $fields){
			return $this->db->search($this->table_name, $words, $fields);
		}
	}	

?>