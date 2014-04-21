<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('basemodel.php');

class Report_model extends BaseModel{

	
	public function getCrucialMetrics($rangeIndex){
		
		$range = false;
		
		if ($rangeIndex == 0){
			$range = getTodayTimeRange();
		}
		else if ($rangeIndex == 1)
		{
			$range = getThisWeekTimeRange();
		}
		else if ($rangeIndex == 2)
		{
			$range = getThisMonthTimeRange();
		}
		else if ($rangeIndex == 3){
			$range = getThisYearTimeRange();
		}
				
		$results = array();
		
		$results['new_members_count'] = $this->getNewMembersCount($range);
		$results['new_premium_count'] = $this->getNewPremiumPurchaseCount($range);
		$results['new_standout_count'] = $this->getStandoutPurchaseCount($range);
		$results['new_gifts_count'] = $this->getGiftPurchaseCount($range);
		
		return $results;
		
	}
	
	public function getMembershipAreaChartData($stepIndex, $range = 10){
		
		$today = time();
		
		if ($stepIndex == 0){
			$stepString = "days";
		}else if ($stepIndex == 1){
			$stepString = 'weeks';
		}else if ($stepIndex == 2){
			$stepString = 'months';
		}
		
		$results = array();
		
		for ($i = $range - 1; $i >= 0; $i--){
			
			$currentDate = date("Y-m-d", strtotime("-" . $i . " " . $stepString, $today));
			
			if ($stepIndex == 0)
			{
				$range = getDayTimeRange($currentDate);
				$period = $currentDate;
			}
			else if ($stepIndex == 1)
			{
				$range = getWeekTimeRange($currentDate);
				$period = getFirstDayOfWeek($currentDate);
			}
			else if ($stepIndex == 2)
			{
				$range = getMonthTimeRange($currentDate);
				$period = date("Y-m", strtotime($currentDate));
			}
			
			$newRow = array();
			
			$newRow['period'] = $period;
			$newRow['tot_members'] = $this->getTotalRegisteredMembersCount($range);
			$newRow['new_members'] = $this->getNewMembersCount($range);
			$newRow['cancellation'] = $this->getCancelledMembersCount($range);

			$results[] = $newRow;
		}
		
		return $results;
	}
	
	public function getGrossRevenueChartData($stepIndex, $range = 10){

		$today = time();
		
		if ($stepIndex == 0){
			$stepString = "days";
		}else if ($stepIndex == 1){
			$stepString = 'weeks';
		}else if ($stepIndex == 2){
			$stepString = 'months';
		}
		
		$results = array();
		
		for ($i = $range - 1; $i >= 0; $i--){
		
			$currentDate = date("Y-m-d", strtotime("-" . $i . " " . $stepString, $today));
		
			if ($stepIndex == 0)
			{
				$range = getDayTimeRange($currentDate);
				$period = $currentDate;
			}
			else if ($stepIndex == 1)
			{
				$range = getWeekTimeRange($currentDate);
				$period = getFirstDayOfWeek($currentDate);
			}
			else if ($stepIndex == 2)
			{
				$range = getMonthTimeRange($currentDate);
				$period = date("Y-m", strtotime($currentDate));
			}
		
			$newRow = array();
		
			$newRow['period'] = $period;
			$newRow['premium_count'] = $this->getPremiumPurchaseGrossRevenue($range);
			$newRow['sos_count'] = $this->getStandoutGrossRevenue($range);
			$newRow['gifts_count'] = $this->getGiftsGrossRevenue($range);
		
			$results[] = $newRow;
		}
		
		return $results;
		
	}
	
	public function getPurchaseVolumnChartData($stepIndex, $range = 10){
	
		$today = time();
	
		if ($stepIndex == 0){
			$stepString = "days";
		}else if ($stepIndex == 1){
			$stepString = 'weeks';
		}else if ($stepIndex == 2){
			$stepString = 'months';
		}
	
		$results = array();
	
		for ($i = $range - 1; $i >= 0; $i--){
				
			$currentDate = date("Y-m-d", strtotime("-" . $i . " " . $stepString, $today));
				
			if ($stepIndex == 0)
			{
				$range = getDayTimeRange($currentDate);
				$period = $currentDate;
			}
			else if ($stepIndex == 1)
			{
				$range = getWeekTimeRange($currentDate);
				$period = getFirstDayOfWeek($currentDate);
			}
			else if ($stepIndex == 2)
			{
				$range = getMonthTimeRange($currentDate);
				$period = date("Y-m", strtotime($currentDate));
			}
				
			$newRow = array();
				
			$newRow['period'] = $period;
			$newRow['premium_count'] = $this->getNewPremiumPurchaseCount($range);
			$newRow['sos_count'] = $this->getStandoutPurchaseCount($range);
			$newRow['gifts_count'] = $this->getGiftPurchaseCount($range);
	
			$results[] = $newRow;
		}
	
		return $results;
	}
	
	public function getPurchaseSelectionChartData($stepIndex, $purchaseTypeIndex, $range = 10){
		
		$today = time();
		
		if ($stepIndex == 0){
			$stepString = "days";
		}else if ($stepIndex == 1){
			$stepString = 'weeks';
		}else if ($stepIndex == 2){
			$stepString = 'months';
		}
		
		$results = array();
		
		for ($i = $range - 1; $i >= 0; $i--){
		
			$currentDate = date("Y-m-d", strtotime("-" . $i . " " . $stepString, $today));
		
			if ($stepIndex == 0)
			{
				$range = getDayTimeRange($currentDate);
				$period = $currentDate;
			}
			else if ($stepIndex == 1)
			{
				$range = getWeekTimeRange($currentDate);
				$period = getFirstDayOfWeek($currentDate);
			}
			else if ($stepIndex == 2)
			{
				$range = getMonthTimeRange($currentDate);
				$period = date("Y-m", strtotime($currentDate));
			}
		
			$newRow = array();
		
			$newRow['period'] = $period;
			
			if ($purchaseTypeIndex == 0){
				
				$purchaseSelectionInfo = $this->getNewPremiumPurchaseSelectionCount($range);
				
				for ($j = 1; $j <= 4; $j++){
					
					if (isset($purchaseSelectionInfo[$j]))
						$newRow['purchase-'.$j] = $purchaseSelectionInfo[$j] + 0;
					else 
						$newRow['purchase-'.$j] = 0;
					
				}
				
			}else if ($purchaseTypeIndex == 1){
				
				$purchaseSelectionInfo = $this->getStandoutPurchaseSelectionCount($range);
				
				for ($j = 1; $j <= 3; $j++){
						
					if (isset($purchaseSelectionInfo[$j]))
						$newRow['purchase-'.$j] = $purchaseSelectionInfo[$j] + 0;
					else
						$newRow['purchase-'.$j] = 0;
						
				}
				
			}else if ($purchaseTypeIndex == 2){
				
				$purchaseSelectionInfo = $this->getGiftPurchaseSelectionCount($range);
				
				for ($j = 1; $j <= 2; $j++){
				
					if (isset($purchaseSelectionInfo[$j]))
						$newRow['purchase-'.$j] = $purchaseSelectionInfo[$j] + 0;
					else
						$newRow['purchase-'.$j] = 0;
				
				}
				
			}
			
			
			$results[] = $newRow;
		}
		
		return $results;
		
	}
	
	
	public function getNewMembersCount($range){
		
		$sql = "SELECT COUNT(id) as 'count' FROM members ";
		if ($range && $range != '' && is_array($range))
			$sql .= " WHERE created_date >= '" . $range['min'] . "' AND created_date <= '" . $range['max'] . "'";
		return $this->getCountRowValue($sql);
		
	}
	
	public function getNewPremiumPurchaseCount($range){
		$sql = "SELECT COUNT(id) as 'count' FROM premium_purchase ";
		if ($range && $range != '' && is_array($range))
			$sql .= " WHERE purchase_date >= '" . $range['min'] . "' AND purchase_date <= '" . $range['max'] . "'";
		return $this->getCountRowValue($sql);
	}
	
	public function getPremiumPurchaseGrossRevenue($range){
		$sql = "SELECT sum(t.premium_price) as 'count' FROM premium_purchase p INNER JOIN premium_type t ON p.premium_type_id = t.id ";
		if ($range && $range != '' && is_array($range))
			$sql .= " WHERE p.purchase_date >= '" . $range['min'] . "' AND p.purchase_date <= '" . $range['max'] . "'";
		return $this->getCountRowValue($sql);
	}
	
	public function getNewPremiumPurchaseSelectionCount($range){
		
		$sql = "SELECT premium_type_id, COUNT(id) as 'count' FROM premium_purchase ";
		if ($range && $range != '' && is_array($range))
			$sql .= " WHERE purchase_date >= '" . $range['min'] . "' AND purchase_date <= '" . $range['max'] . "'";
		
		$sql .= " GROUP BY premium_type_id ";
		
		$results = array();
		
		$query_result = $this->db->query($sql);
		
		if (!$query_result) return $results;
		
		foreach($query_result->result_array() as $row){
			$results[$row['premium_type_id']] = $row['count'];
		}
		
		return $results;
	}
	
	public function getStandoutGrossRevenue($range){
		$sql = "SELECT sum(t.standout_price) as 'count' FROM standout_purchase p INNER JOIN standout_type t ON p.standout_type_id = t.id ";
		if ($range && $range != '' && is_array($range))
			$sql .= " WHERE p.purchase_date >= '" . $range['min'] . "' AND p.purchase_date <= '" . $range['max'] . "'";
		return $this->getCountRowValue($sql);
	}
	
	public function getStandoutPurchaseCount($range){
		$sql = "SELECT COUNT(id) as 'count' FROM standout_purchase ";
		if ($range && $range != '' && is_array($range))
			$sql .= " WHERE purchase_date >= '" . $range['min'] . "' AND purchase_date <= '" . $range['max'] . "'";
		return $this->getCountRowValue($sql);
	}
	
	
	public function getStandoutPurchaseSelectionCount($range){
		
		$sql = "SELECT standout_type_id, COUNT(id) as 'count' FROM standout_purchase ";
		if ($range && $range != '' && is_array($range))
			$sql .= " WHERE purchase_date >= '" . $range['min'] . "' AND purchase_date <= '" . $range['max'] . "'";
		
		$sql .= " GROUP BY standout_type_id ";
		
		$results = array();
		
		$query_result = $this->db->query($sql);
		
		if (!$query_result) return $results;
		
		foreach($query_result->result_array() as $row){
			$results[$row['standout_type_id']] = $row['count'];
		}
		
		return $results;
		
	}
	
	public function getGiftPurchaseCount($range){
		$sql = "SELECT COUNT(id) as 'count' FROM gift_purchase ";
		if ($range && $range != '' && is_array($range))
			$sql .= " WHERE purchase_date >= '" . $range['min'] . "' AND purchase_date <= '" . $range['max'] . "'";
		return $this->getCountRowValue($sql);
	}
	
	public function getGiftsGrossRevenue($range){
		
		$sql = "SELECT sum(t.price) as 'count' FROM gift_purchase p INNER JOIN gift_type t ON t.id = p.gift_type_id ";
		if ($range && $range != '' && is_array($range))
			$sql .= " WHERE p.purchase_date >= '" . $range['min'] . "' AND p.purchase_date <= '" . $range['max'] . "'";
		return $this->getCountRowValue($sql);
	}
	
	public function getGiftPurchaseSelectionCount($range){
		
		$sql = "SELECT gift_type_id, COUNT(id) as 'count' FROM gift_purchase ";
		if ($range && $range != '' && is_array($range))
			$sql .= " WHERE purchase_date >= '" . $range['min'] . "' AND purchase_date <= '" . $range['max'] . "'";
		
		$sql .= " GROUP BY gift_type_id ";
		
		$results = array();
		
		$query_result = $this->db->query($sql);
		
		if (!$query_result) return $results;
		
		foreach($query_result->result_array() as $row){
			$results[$row['gift_type_id']] = $row['count'];
		}
		
		return $results;
		
	}
	
	
	public function getCancelledMembersCount($range){
	
		$sql = "SELECT COUNT(id) as 'count' FROM members WHERE is_canceled = 1 ";
		if ($range && $range != '' && is_array($range))
			$sql .= " AND canceled_date >= '" . $range['min'] . "' AND canceled_date <= '" . $range['max'] . "'";
		return $this->getCountRowValue($sql);
	
	}	
	
	public function getCancelledMembersCountBefore($date){

		$sql = "SELECT COUNT(id) as 'count' FROM members WHERE is_canceled = 1 AND canceled_date < '" . $date . "'";
		return $this->getCountRowValue($sql);
	}
	
	public function getTotalMemebersCountBefore($date){
		$sql = "SELECT COUNT(id) as 'count' FROM members WHERE created_date < '" . $date . "'";
		return $this->getCountRowValue($sql);
	}
	
	public function getTotalRegisteredMembersCountBefore($date){
		return $this->getTotalMemebersCountBefore($date) - $this->getCancelledMembersCountBefore($date);
	}
	
	public function getTotalRegisteredMembersCount($range){
		
		if (!$range || $range == '' || !is_array($range)){
			$range = getTodayTimeRange();
		}
		
		return $this->getTotalRegisteredMembersCountBefore($range['min']) + $this->getNewMembersCount($range) - $this->getCancelledMembersCount($range);
		
	}

}