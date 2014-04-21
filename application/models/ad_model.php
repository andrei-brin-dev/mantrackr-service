<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('basemodel.php');

class Ad_model extends BaseModel{
	
	protected $_table = 'ads';
	protected $_id_column = 'id';
	
	public function save(){
		
		if ($this->getId() == ''){
			
			if (!$this->db->insert($this->_table, $this->getData())){
				log_message("error", "Unable to insert ad information to db.");
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
	
	public function loadAllAds(){
		
		$sql = "SELECT a.*, m.group_name FROM ads a LEFT OUTER JOIN membergroup m ON m.id = a.membergroup_id ";
		
		$query = $this->db->query($sql);
		
		if (!$query) return array();
		
		$results = array();
		
		foreach($query->result_array() as $row){

			if ($row['startdate'] == '0000-00-00') $row['startdate'] = '';
			if ($row['enddate'] == '0000-00-00') $row['enddate'] = '';
			
			if ($row['startdate'] != '')
				$row['startdate'] = date("m/d/Y", strtotime($row['startdate']));
			
			if ($row['enddate'] != '')
				$row['enddate'] = date("m/d/Y", strtotime($row['enddate']));
			
			$results[] = $row;
		}
		
		return $results;
		
	}
	
	public function deleteAd(){

		$prevPath = $this->getTopimage();
		if ($prevPath != '')
			@unlink($this->config->item('adUploadDir') . $prevPath);
		
		$prevPath = $this->getBackimage();
		if ($prevPath != '')
			@unlink($this->config->item('adUploadDir') . $prevPath);
		
		return $this->removeRecord();
	}
	
	public function getPageList(){
	
		$sql = "SELECT id, title FROM pages";
	
		$query = $this->db->query($sql);
	
		if (!$query) return array();
	
		$results = array();
	
		foreach($query->result_array() as $row){
	
			$results[] = $row;
		}
	
		return $results;
	}
	
	public function replaceAdTopImage($newPath){
		
		$prevPath = $this->getTopimage();
		
		if ($prevPath != ''){
			
			@unlink($this->config->item('adUploadDir') . $prevPath);
			
		}
		
		$this->setTopimage($newPath);
		
	}
	
	public function replaceAdBackImage($newPath){
	
		$prevPath = $this->getBackimage();
	
		if ($prevPath != ''){
				
			@unlink($this->config->item('adUploadDir') . $prevPath);
				
		}
	
		$this->setBackimage($newPath);
	
	}
	
	
}