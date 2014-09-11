<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class mdl_contract extends MY_Model{

    /*
	* This function will retrieve username in autocomplete
	*/
	public function getUserName($nameStartsWith){
	    
		$records = array();
        $query = $this->db->query("SELECT * FROM users WHERE name LIKE '%$nameStartsWith%'");
        foreach ($query->result() as $row) {
            $datas = array('label' => $row->name, 'id' => $row->id);
            array_push($records, $datas);
        }
        return $records;   
    }  
	//---------------------------------------------------------
	
	/*
	*This function will be used to get inventory name in select menu
	*/
	public function getInventoryName(){
	    
		$records = array();
        $query = $this->db->query("SELECT * FROM inventory");
        foreach ($query->result() as $row) {
            $datas = array('label' => $row->inventory_item, 'id' => $row->id);
            array_push($records, $datas);
        }
        return $records;   
    } 
	//---------------------------------------------------------
	
	/*
	*This function will be used to get insert contract record
	*/
	 
	
	public function insertContractRecord($contractRecordArr){
		
		$return = false;
		$query = $this->db->insert('contract_record',$contractRecordArr);
		if(!$query){
			$return = false;
		}else{
			$return = $this->db->insert_id();
		}
		return $return;
	}
	//---------------------------------------------------------
	
	/*
	*This function will be used to insert multiple contract records which is default
	*/
	
	public function insertDefaultContract($defaultContractArr){
		
		$return = false;
		$query = $this->db->insert('contract_content',$defaultContractArr);
		if(!$query){
			$return = false;
		}else{
			$return = true;
		}
		return json_encode($return);
		
	}
	//---------------------------------------------------------
	
	/*
	*This function will be used to insert multiple contract records which is generated
	*/
	
	public function insertGeneratedContract($generatedContractArr){
		
		$return = false;
		$query = $this->db->insert_batch('contract_content',$generatedContractArr);
		if(!$query){
			$return = false;
		}else{
			$return = true;
		}
		return json_encode($return);
		
	}
	//---------------------------------------------------------
	
	/*
	*This function will be used to get listing in index page
	*/
	
	public function getContractRecord(){
		$records = array();
        $query = $this->db->query("SELECT contract_record.*,users.name  FROM contract_record,users WHERE contract_record.customer_id = users.id");
		
        foreach ($query->result() as $row) {
            $datas = array('contract_id' => $row->contract_id, 'name' => $row->name, 'start_date' => $row->start_date, 'end_date' => $row->end_date);
            array_push($records, $datas);
        }
		return $records;
		
	}
	//---------------------------------------------------------
	
	

}