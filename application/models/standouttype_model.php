<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('basemodel.php');

class Standouttype_model extends BaseModel{
	
	protected $_table = 'standout_type';
	protected $_id_column = 'id';
		
	public function save(){
		
		if ($this->getId() == ''){
			
			if (!$this->db->insert($this->_table, $this->getData())){
				log_message("error", "Unable to insert new standout type information to db.");
				return false;
			}
			
			
			$new_id = $this->db->insert_id();
			$this->setId($new_id);
			
			return $this;
		}
		else{
			
			$data_array = $this->getData();
			
			unset($data_array['id']);
			
			$this->db->where("id", $this->getId());
			
			if (!$this->db->update($this->_table, $data_array))
				return false;
			
			return true;
		}
		
	}
	
	
	
}