<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('basemodel.php');

class Const_model extends BaseModel{

	public function getEthnicityList(){
		
		$results = array();
		
		$sql = "SELECT id, ethnicity_value FROM ethnicity WHERE disabled = 0";
		
		$query_result = $this->db->query($sql);
		
		if (!$query_result) return $results;
		
		foreach($query_result->result_array() as $row){
			//$results[$row['id']] = $row['ethnicity_value'];
			$results[] = $row;
		}
		
		return $results;
	}
	
	public function getOpentoOptionList(){
		
		$results = array();
		
		$sql = "SELECT id, opento_value FROM opento_options WHERE disabled = 0";
		
		$query_result = $this->db->query($sql);
		
		if (!$query_result) return $results;
		
		foreach($query_result->result_array() as $row){
			//$results[$row['id']] = $row['opento_value'];
			$results[] = $row;
		}
		
		return $results;
		
	}
	
	public function getRelationshipStatusList(){
	
		$results = array();
	
		$sql = "SELECT id, relationship FROM relationship_status WHERE disabled = 0";
	
		$query_result = $this->db->query($sql);
	
		if (!$query_result) return $results;
	
		foreach($query_result->result_array() as $row){
			//$results[$row['id']] = $row['relationship'];
			$results[] = $row;
		}
	
		return $results;
	
	}
	
}