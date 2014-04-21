<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once("basemodel.php");

class Serviceresult_model extends BaseModel{
	
	public function setErrorCode($error_type){
			
		$error_info = getErrorInfo($error_type);
		
		$this->setCode($error_info['code']);
		$this->setMsg($error_info['msg']);
		
	}
	
}
