<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('basemodel.php');

class Photo_model extends BaseModel{
	
	protected $_table = 'member_photos';
	protected $_id_column = 'id';
		
	protected $_firebase_path = '/members/';
	
	public function save(){
		
		if ($this->getId() == ''){
			
			if (!$this->db->insert($this->_table, $this->getData())){
				log_message("error", "Unable to insert new photo information to db.");
				return false;
			}
			
			
			$new_id = $this->db->insert_id();
			$this->setId($new_id);
			
			$this->savePhotoInfoOnFirebase();
			
			return $this;
		}
		else{
			
			$data_array = $this->getData();
			
			unset($data_array['id']);
			
			$this->db->where("id", $this->getId());
			
			if (!$this->db->update($this->_table, $data_array))
				return false;
			
			$this->savePhotoInfoOnFirebase();
			
			return true;
			
		}
		
	}

	public function removePhoto(){
	
		$sql = "DELETE FROM " . $this->_table . " WHERE id = ?";
	
		$query = $this->db->query($sql, array($this->getId()));
	
		if (!$query) return false;
	
		$upload_dir = $this->config->item('uploadDir');
	
		if ($this->getPath() != '')
			@unlink($upload_dir . $this->getPath());
	
		if ($this->getThumbPath() != '')
			@unlink($upload_dir . $this->getThumbPath());
	
		$this->deletePhotoInfoOnFirebase();
		
		$this->setData(array());
	
		return true;
	}
	
	public function replacePhoto($path, $thumbPath){
		
		$upload_dir = $this->config->item('uploadDir');
		
		if ($this->getPath() != '')
			@unlink($upload_dir . $this->getPath());
		
		if ($this->getThumbPath() != '')
			@unlink($upload_dir . $this->getThumbPath());
		
		$this->setPath($path);
		$this->setThumbPath($thumbPath);
		$this->setUploadedDate(date("Y-m-d H:i:s"));
		
		return $this->save();
		
	}
	
	public function setPhotoPrivacy($is_public){
		
		$this->setIsPublic($is_public);
		
		return $this->save();
	}
	
	public function loadPhotoById($id, $user_id){
		
		$sql = "SELECT * FROM " . $this->_table . " WHERE id = ? AND member_id = ?";
		
		$query = $this->db->query($sql, array($id, $user_id));
		
		if (!$query) return false;
		
		$row = $query->row_array();
		
		if (!$row) return false;
		
		$this->setData($row);
		
		return $this;
		
	}
	
	
	
	public function getPhotoFirebaseURL(){
		
		return $this->_firebase_path . $this->getMemberId() . "/photos/" . $this->getId();
	}
	
	public function savePhotoInfoOnFirebase(){
		
		$firebase_path = $this->getPhotoFirebaseURL();
		
		$this->phpfirebase->set($firebase_path, $this->getData());
	}
	
	public function deletePhotoInfoOnFirebase(){
		$firebase_path = $this->getPhotoFirebaseURL();
		$this->phpfirebase->delete($firebase_path);
	}
	
	
}