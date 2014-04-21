<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('basemodel.php');

class Member_model extends BaseModel{
	
	protected $_table = 'members';
	protected $_id_column = 'id';
	
	protected $_token_table = 'login_tokens';
	
	protected $_firebase_path = '/members/';
	
	protected $_cache_firebase = '/cache/';
	
	protected $_standoutstrip_firebase = '/standout_members/';
		
	protected $_nearby_cache_firebase = '/cache/nearby/';
	
	protected $_search_cache_firebase = '/cache/search/';
	
	protected $_images = array();
	
	protected $_flags = array();
	
	protected $_premium_purchase_history = array();
	
	protected $_standout_purchase_history = array();
	
	
	public function save(){
		
		if ($this->getId() == ''){
			
			if (!$this->db->insert($this->_table, $this->getData())){
				log_message("error", "Unable to insert member information to db.");
				return false;
			}
			
			$new_id = $this->db->insert_id();
			$this->setId($new_id);
			
			$this->saveMemberInfoOnFirebase();
			
			return $this;
		}
		else{
			
			$now = date("Y-m-d H:i:s");
			
			$this->setUpdatedDate($now);
			
			$data_array = $this->getData();
			
			unset($data_array['id']);
			
			$this->db->where("id", $this->getId());
			
			if (!$this->db->update($this->_table, $data_array))
				return false;
			
			$this->updateMemberInfoOnFirebase();
			
			return true;
			
		}
		
	}
		
	
	public function getAgeString(){

		$age = $this->getAge();
		
		if ($age == '' || $age == 0) return 'Age not specified';
		else return $age . ' yo';
		
	}
	
	public function getHeightString(){
	
		$height = $this->getHeight();
	
		if ($height == '' || $height == 0) return 'Height not specified';
		else return $height;
	
	}
	
	public function getWeightString(){
	
		$weight = $this->getWeight();
	
		if ($weight == '' || $weight == 0) return 'Weight not specified';
		else return $weight;
	
	}
	
	public function loadImages(){

		$this->_images = array();
		
		$sql = "SELECT * FROM member_photos WHERE member_id = ?";
		
		$query = $this->db->query($sql, array($this->getId()));
		
		if (!$query) return $this->_images;
		
		foreach($query->result_array() as $row)
			$this->_images[$row['id']] = $row;
		
		return $this->_images;
		
	}
	
	public function loadPremiumPurchaseHistory(){
		
		$this->_premium_purchase_history = array();
		
		$sql = "SELECT p.*, pt.premium_duration, pt.premium_price, pt.premium_mon_price, pt.premium_type_name FROM premium_purchase p INNER JOIN premium_type pt ON p.premium_type_id = pt.id WHERE p.member_id = ? ORDER BY p.purchase_date DESC ";
		
		$query = $this->db->query($sql, array($this->getId()));
		
		if (!$query) return $this->_premium_purchase_history;
		
		foreach($query->result_array() as $row)
			$this->_premium_purchase_history[$row['id']] = $row;
		
		return $this->_premium_purchase_history;
	}
	
	public function loadStandoutStripPurchaseHistory(){
		
		$this->_standout_purchase_history = array();
		
		$sql = "SELECT p.*, pt.standout_duration, pt.standout_price, pt.standout_type_name FROM standout_purchase p INNER JOIN standout_type pt ON p.standout_type_id = pt.id WHERE p.member_id = ? ORDER BY p.purchase_date DESC ";
		
		$query = $this->db->query($sql, array($this->getId()));
		
		if (!$query) return $this->_standout_purchase_history;
		
		foreach($query->result_array() as $row)
			$this->_standout_purchase_history[$row['id']] = $row;
		
		return $this->_standout_purchase_history;
		
	}
	
	public function loadFlags(){
		
		$this->_flags = array();
		
		$sql = "SELECT f.*, m.name, m.email FROM members_flag f LEFT OUTER JOIN members m ON f.flagger_member_id = m.id WHERE f.flagged_member_id = ?";
		
		$query = $this->db->query($sql, array($this->getId()));
		
		if (!$query) return;
		
		foreach($query->result_array() as $row)
			$this->_flags[] = $row;
		
		return $this->_flags;
		
	}
	
	public function loadByEmail($email){
		
		$sql = "SELECT * FROM " . $this->_table . " WHERE email = ?";
		
		$query = $this->db->query($sql, array($email));
		
		if (!$query) return false;
		
		$row = $query->row_array();
		
		if (!$row) return false;
		
		$this->setData($row);
		
		return $this;
	}
	
	public function resetPassword(){
		
		$new_password  = crypt(time(), time());
		
		$encrypted_password = crypt($new_password, strtolower($this->getEmail()));
		
		$sql = "UPDATE " . $this->_table . " SET password = ? WHERE id = ?";
		
		$query = $this->db->query($sql, array($encrypted_password, $this->getId()));
		
		if (!$query) return false;
		
		$this->setPassword($encrypted_password);
		
		$this->updateMemberInfoOnFirebase();
		
		return $new_password;
		
	}
	
	public function loadByToken($toekn){
		
		$sql = "SELECT member_id FROM " . $this->_token_table . " WHERE token = ? AND logged_out = 0";
		
		$query = $this->db->query($sql, array($toekn));
		
		if (!$query) return false;
		
		$row = $query->row_array();
		
		if (!$row) return false;

		return $this->loadById($row['member_id']);
	}
	
	
	
	public function loadNthFlaggedMember($num){
				
		$sql = "SELECT * FROM " . $this->_table . " WHERE id IN (SELECT DISTINCT(flagged_member_id) FROM members_flag) LIMIT ?, 1";
		
		$query = $this->db->query($sql, array($num - 1));
		
		if (!$query) return false;
		
		$row = $query->row_array();
		
		if (!$row) return false;
		
		$this->setData($row);
		
		return $this;
		
	}
	
	public function getMemberGroupList(){
		
		$sql = "SELECT id, group_name FROM membergroup";
		
		$query = $this->db->query($sql);
		
		if (!$query) return array();
		
		$results = array();
		
		foreach($query->result_array() as $row){
				
			$results[] = $row;
		}
		
		return $results;
	}
	
	public function loadAllMembers(){
		
		$sql = "SELECT m.*, p.path as 'path', p.thumb_path as 'thumb_path' FROM " . $this->_table . " m LEFT OUTER JOIN member_photos p ON m.primary_photo_id = p.id AND m.id = p.member_id";
		
		$query = $this->db->query($sql);
		
		if (!$query) return array();
		
		$results = array();
		
		foreach($query->result_array() as $row){
			
			$results[] = $row;
		}
		
		return $results;
	}
	
	public function loadPremiumMembers(){
		
		$sql = "SELECT m.*, p.path as 'path', p.thumb_path as 'thumb_path' FROM " . $this->_table . " m LEFT OUTER JOIN member_photos p ON m.primary_photo_id = p.id AND m.id = p.member_id WHERE m.is_premium = 1";
		
		$query = $this->db->query($sql);
		
		if (!$query) return array();
		
		$results = array();
		
		foreach($query->result_array() as $row){
				
			$results[] = $row;
		}
		
		return $results;
		
	}
	
	public function loadFreemiumMembers(){
		
		$sql = "SELECT m.*, p.path as 'path', p.thumb_path as 'thumb_path' FROM " . $this->_table . " m LEFT OUTER JOIN member_photos p ON m.primary_photo_id = p.id AND m.id = p.member_id WHERE m.is_premium = 0";
		
		$query = $this->db->query($sql);
		
		if (!$query) return array();
		
		$results = array();
		
		foreach($query->result_array() as $row){
		
			$results[] = $row;
		}
		
		return $results;
		
	}
	
	public function loadInactiveMembers(){
		
		$sql = "SELECT m.*, p.path as 'path', p.thumb_path as 'thumb_path' FROM " . $this->_table . " m LEFT OUTER JOIN member_photos p ON m.primary_photo_id = p.id AND m.id = p.member_id WHERE m.active = 0";
		
		$query = $this->db->query($sql);
		
		if (!$query) return array();
		
		$results = array();
		
		foreach($query->result_array() as $row){
		
			$results[] = $row;
		}
		
		return $results;
		
	}
	
	
	public function loadCanceledMembers(){
		
		$sql = "SELECT m.*, p.path as 'path', p.thumb_path as 'thumb_path' FROM " . $this->_table . " m LEFT OUTER JOIN member_photos p ON m.primary_photo_id = p.id AND m.id = p.member_id WHERE m.is_canceled = 1";
		
		$query = $this->db->query($sql);
		
		if (!$query) return array();
		
		$results = array();
		
		foreach($query->result_array() as $row){
		
			$results[] = $row;
		}
		
		return $results;
	}
	
	public function loadPremiumExpirationMembers(){
		
		$sql = "SELECT m.*, p.path as 'path', p.thumb_path as 'thumb_path' FROM " . $this->_table . " m LEFT OUTER JOIN member_photos p ON m.primary_photo_id = p.id AND m.id = p.member_id LEFT OUTER JOIN premium_purchase pp ON pp.id = m.active_premium_purchase_id WHERE m.is_premium = 0 AND pp.is_expired = 1 AND pp.is_canceled = 0";
		
		$query = $this->db->query($sql);
		
		if (!$query) return array();
		
		$results = array();
		
		foreach($query->result_array() as $row){
		
			$results[] = $row;
		}
		
		return $results;
	}
	
	public function loadPremiumCancelMembers(){
		
		$sql = "SELECT m.*, p.path as 'path', p.thumb_path as 'thumb_path' FROM " . $this->_table . " m LEFT OUTER JOIN member_photos p ON m.primary_photo_id = p.id AND m.id = p.member_id LEFT OUTER JOIN premium_purchase pp ON pp.id = m.active_premium_purchase_id WHERE m.is_premium = 0 AND pp.is_expired = 0 AND pp.is_canceled = 1";
		
		$query = $this->db->query($sql);
		
		if (!$query) return array();
		
		$results = array();
		
		foreach($query->result_array() as $row){
		
			$results[] = $row;
		}
		
		return $results;
	}
	
	public function getPendingPhotosMembers(){
		
		$sql = "SELECT m.*, p.path as 'path', p.thumb_path as 'thumb_path' FROM " . $this->_table . " m LEFT OUTER JOIN member_photos p ON m.primary_photo_id = p.id AND m.id = p.member_id WHERE m.primary_photo_approved = 0 AND m.active = 1 AND m.is_banned = 0 AND m.is_admin = 0 AND m.primary_photo_id > 0 ORDER BY m.created_date ASC";
		
		$query = $this->db->query($sql);
		
		if (!$query) return array();
		
		$results = array();
		
		foreach($query->result_array() as $row){
				
			$results[] = $row;
		}
		
		return $results;
		
	}
	
	
	
	public function getPendingPhotosCount(){
		
		$sql = "SELECT COUNT(*) as 'count' FROM " . $this->_table . " m WHERE m.primary_photo_approved = 0 AND m.active = 1 AND m.is_banned = 0 AND m.is_admin = 0 AND m.primary_photo_id > 0";
		
		$query = $this->db->query($sql);
		
		if (!$query) return 0;
		
		if (!($row = $query->row())) return 0;
		
		return $row->count;
	}
	
	public function getFlaggedMembersCount(){
		
		$sql = "SELECT COUNT(DISTINCT(flagged_member_id)) as 'count' FROM members_flag";
		
		$query = $this->db->query($sql);
		
		if (!$query) return 0;
		
		if (!($row = $query->row())) return 0;
		
		return $row->count;
		
	}
	
	public function loadByEmailAndPassword($email, $password){
		
		$sql = "SELECT * FROM " . $this->_table . " WHERE email = ? AND password = ? ";
		
		$query = $this->db->query($sql, array($email, $password));
		
		if (!$query) return false;
		
		$row = $query->row_array();
		
		if (!$row) return false;
		
		$this->setData($row);
		
		return $this;
		
	}
	
	public function loadMemberDetailInfo(){
		
		$this->setOpentoIdList(explode(",", $this->getOpentoIds()));
		
		$this->setMemberPhotoList($this->loadImages());
		
		$this->setPremiumPurchaseHistory($this->loadPremiumPurchaseHistory());
		
		$this->setStandoutPurchaseHistory($this->loadStandoutStripPurchaseHistory());
		
	}
	
	public function loadNearByMembers(){
		
		$current_lat = get_decimal_from_string($this->getLat());
		$current_lng = get_decimal_from_string($this->getLng());
		
		$sql = "SELECT id, 6371 * 2 * ASIN(SQRT(POWER(SIN(RADIANS({$current_lat} - ABS(members.lat))), 2) + COS(RADIANS({$current_lat})) * COS(RADIANS(ABS(members.lat))) * POWER(SIN(RADIANS({$current_lng} - members.lng)), 2))) AS distance FROM " . $this->_table . " WHERE id <> ? ORDER BY ISNULL(distance), distance ASC";
		
		$query = $this->db->query($sql, array($this->getId()));
		
		if (!$query) return false;
		
		$results = array();
		
		foreach($query->result_array() as $row){
			
			if (!isset($results[$row['id']])) $results[$row['id']] = array(); 
			
			$results[$row['id']]['distance'] = $row['distance']; 
		}
		
		$this->phpfirebase->set($this->getMemberNearbyFirebasePath(), $results);
		
		return true;
	}
	
	public function searchMembers($search_query){
		
		$current_lat = get_decimal_from_string($this->getLat());
		$current_lng = get_decimal_from_string($this->getLng());
		
		$sql = "SELECT id, 6371 * 2 * ASIN(SQRT(POWER(SIN(RADIANS({$current_lat} - ABS(members.lat))), 2) + COS(RADIANS({$current_lat})) * COS(RADIANS(ABS(members.lat))) * POWER(SIN(RADIANS({$current_lng} - members.lng)), 2))) AS distance FROM " . $this->_table . " WHERE id <> ? AND (name LIKE ? OR headline LIKE ? OR description LIKE ? OR interests LIKE ? OR location LIKE ?) ORDER BY ISNULL(distance), distance ASC";
		
		$like_phrase = '%' . $search_query . '%';
		
		$query = $this->db->query($sql, array($this->getId(), $like_phrase, $like_phrase, $like_phrase, $like_phrase, $like_phrase));
		
		if (!$query) return false;
		
		$results = array();
		
		foreach($query->result_array() as $row){
				
			if (!isset($results[$row['id']])) $results[$row['id']] = array();
				
			$results[$row['id']]['distance'] = $row['distance'];
		}
		
		$this->phpfirebase->set($this->getMemberSearchFirebasePath(), $results);
		
		return true;
		
	}
	
	public function purchasePremiumMembership($premium_type){

		$today = time();
		
		$duration = $premium_type->getPremiumDuration();
		
		$purchase_date = date("Y-m-d H:i:s", $today);
		$expiry_date = date("Y-m-d H:i:s", strtotime("+$duration months", $today));
		
		$payment_type_id = 1;
		
		$new_purchase_record = new Premiumpurchase_model();
		
		$new_purchase_record->setMemberId($this->getId());
		$new_purchase_record->setPurchaseDate($purchase_date);
		$new_purchase_record->setDuration($duration);
		$new_purchase_record->setExpiryDate($expiry_date);
		$new_purchase_record->setIsExpired(0);
		$new_purchase_record->setPremiumTypeId($premium_type->getId());
		$new_purchase_record->setPaymentTypeId($payment_type_id);
		
		if (!$new_purchase_record->save()) return false;
		
		$new_purchase_record->setPremiumDuration($duration);
		$new_purchase_record->setPremiumPrice($premium_type->getPremiumPrice());
		$new_purchase_record->setPremiumMonPrice($premium_type->getPremiumMonPrice());
		$new_purchase_record->setPremiumTypeName($premium_type->getPremiumTypeName());
		
		$this->setDataChanges(false);
		
		$this->setIsPremium(1);
		$this->setActivePremiumPurchaseId($new_purchase_record->getId());
		
		$this->save();
		
		return $new_purchase_record;
		
	}
	
	public function purchaseStandoutStrip($standout_type){
		
		$today = time();

		$duration = $standout_type->getStandoutDuration();
		
		$purchase_date = date("Y-m-d H:i:s", $today);
		$expiry_date = date("Y-m-d H:i:s", strtotime("+$duration days", $today));
		
		$payment_type_id = 1;
		
		$new_purchase_record = new Standoutpurchase_model();
		
		$new_purchase_record->setMemberId($this->getId());
		$new_purchase_record->setPurchaseDate($purchase_date);
		$new_purchase_record->setDuration($duration);
		$new_purchase_record->setExpiryDate($expiry_date);
		$new_purchase_record->setIsExpired(0);
		$new_purchase_record->setStandoutTypeId($standout_type->getId());
		$new_purchase_record->setPaymentTypeId($payment_type_id);
		
		if (!$new_purchase_record->save()) return false;
		
		$new_purchase_record->setStandoutDuration($duration);
		$new_purchase_record->setStandoutPrice($standout_type->getStandoutPrice());
		$new_purchase_record->setStandoutTypeName($standout_type->getStandoutTypeName());
		
		$this->setDataChanges(false);
		
		$this->setIsStandout(1);
		$this->setActiveStandoutPurchaseId($new_purchase_record->getId());
		
		$this->save();
		
		$this->insertMemberToStandoutFirebaseArea();
		
		return $new_purchase_record;
	}
	
	public function generateNewToken(){
		
		$now = time();
		
		$sql = "DELETE FROM " . $this->_token_table . " WHERE member_id = ?";
		
		$this->db->query($sql, array($this->getId()));
		
		$newToken = md5($this->getEmail() . "_" . $now);
		
		$data = array();
		
		$data['member_id'] = $this->getId();
		$data['token'] = $newToken;
		$data['created_timestamp'] = $now;
		$data['logged_out'] = 0;
		
		if ($this->db->insert($this->_token_table, $data)) return $newToken;
		
		return false;
		
	}
	
	
	
	
	public function memberLogout(){
		
		$sql = "UPDATE " . $this->_token_table . " SET logged_out = 1 WHERE member_id = ?";
		
		$this->db->query($sql, array($this->getId()));
		
		$this->setOnlineStatusOnFirebase(false);
		
	}
	
	public function getMemberFirebasePath(){

		return $this->_firebase_path . $this->getId();
	}
	
	public function getMemberNearbyFirebasePath(){
		
		return $this->_nearby_cache_firebase . $this->getId();
	}
	
	
	public function getMemberSearchFirebasePath(){

		return $this->_search_cache_firebase . $this->getId();
	}
	
	public function saveMemberInfoOnFirebase(){
		
		$firebase_path = $this->getMemberFirebasePath();
		
		$this->phpfirebase->set($firebase_path, $this->getData());
		
	}
	
	public function insertMemberToStandoutFirebaseArea(){
		
		$this->phpfirebase->set($this->_standoutstrip_firebase . $this->getId(), true);
				
	}
	
	public function updateMemberInfoOnFirebase(){
		
		$update_value_array = array();
		
		$firebase_path = $this->getMemberFirebasePath();
		
		foreach ($this->getData() as $key => $val)
		{
			if ($key == 'id') continue;
			
			if (!$this->hasColumnChanged($key)) continue;
			
			$update_value_array[$key] = $val;
			
		}
		
		$this->phpfirebase->update($firebase_path, $update_value_array);
	}
	
	
	public function setOnlineStatusOnFirebase($online){
		
		$firebase_path = $this->getMemberFirebasePath();
		
		$this->phpfirebase->set($firebase_path . "/online", $online);
	}
	
	
}