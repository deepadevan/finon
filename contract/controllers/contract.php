<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Contract extends Admin_Controller{
	
	public function __construct(){
     parent::__construct();
	 
	 if (!$this->mdl_kindle->check_enable('contract')) {

			redirect('dashboard');

		}
		/*
		 * Load this custom module's language file.
		*/
		$this->_load_lang();
		
	 	$this->load->model('mdl_contract');     
		
		/*
		 * Notify the dashboard module that we have a widget for it to load.
		*/
		$this->kindle->set_notice('dashboard_widget', array('module'=>'contract', 'method'=>'dashboard_widget'));

		/*
		 * Notify the settings module that we have a custom save view
		*/
		//$this->kindle->set_notice('settings_custom_view', array('module'=>'accounts/account_settings', 'method'=>'display'));

		/*
		 * Notify the settings module that we have a custom save method
		*/
		$this->kindle->set_notice('settings_custom_save', array('module'=>'contract/contract_settings', 'method'=>'save'));

		/*
		 * Notify the dashboard that we have a custom menu to be loaded
		*/
		$this->kindle->set_notice('dashboard_custom_menu', array('module'=>'contract', 'view'=>'header_menu'));
		
		$this->_post_handler();
		 
  	}
	
	function _load_lang() {

		if (file_exists('system/pynacc/modules_custom/contract/language/' . $this->config->item('language') . 'contract_lang.php')) {

			$lang = $this->config->item('language');

		}

		else {

			$lang = 'english';

		}

		$this->lang->load('contract/contract', $lang);

	}
	
	
	/*
	*Index page listing of added customer name and contracts records
	*/
	public function index(){
	
        $data = array();
		$data['Page_title'] = 'List';
		$data['recordsArr'] =  $this->mdl_contract->getContractRecord();
	    
		$this->load->view('contracts', $data);
	
	
	}
	//-------------------------------------------------------------------------
	
	
	/*
	*Create Contract page selects user and selects the user
	*/
	public function createContracts(){
		$data = array();
		$data['Page_title'] = 'Create';
		
		$this->load->view('create_contract', $data);	
	}
	//---------------------------------------------------------------------------
	
	/*
	* This function will get the username in textbox
	*/
	public function getUserNameInTextBox(){
		
		$nameStartsWith = $this->input->post('name_startsWith');
		
		$data = $this->mdl_contract->getUserName($nameStartsWith);
		
		echo json_encode($data);
 
	}
	//---------------------------------------------------------------------------
	
	/*
	* This function will create contract for the customer if customer id exists 
	* If it doesn't , redirect back to create page
	*/
	public function addNewContract(){
		$data = array();
		$data['customer_id'] = $this->input->post('customer_id');
		$data['customer_name'] = $this->input->post('customer_name');
		$data['Page_title'] = 'Add New Contract';
	    $data['inventoryArr'] = $this->mdl_contract->getInventoryName();
		if(empty($data['customer_id'])){
			redirect(base_url()."contract/createContracts");
		}
		$this->load->view('add_new_contract', $data);	
	
	}
	//-------------------------------------------------------------------------------
	
	/*
	*This function will compare the contract start and end date
	*/
	public function checkContractDates(){
		
		$return = false;
		$start_date = $this->input->post('start_date');
		$end_date   = $this->input->post('end_date');
		$datetime1 = date_create($start_date);
        $datetime2 = date_create($end_date);
        $interval = date_diff($datetime1, $datetime2);
        
		$diff = $interval->format('%R');
		if($diff == '-'){
			$return = false;
		}else{
			$return = true;
		}
		echo json_encode($return);
	}
	//---------------------------------------------------------------------------------
	
	/*
	*This function will insert contract records and contract content
	*/
	public function addNewContractDetails(){
		
		$customerId = $this->input->post('customer_id');
		$serialNoDefault = $this->input->post('serial_no');
		$inventoryItemIdDefault = $this->input->post('inventory_item');
		$qtyDefault =  $this->input->post('qty');
	    $unitPriceDefault = $this->input->post('unit_price');
		$totalPriceDefault = $this->input->post('total_price');
		$serialNoGenerated = $this->input->post('serial_num_generated');
		$inventoryItemGenerated = $this->input->post('inventory_item_generated');
		$qtyGenerated = $this->input->post('qty_generated');
		$unitPriceGenerated = $this->input->post('unit_price_generated');
		$totalPriceGenerated = $this->input->post('total_price_generated');
		$contractStartDate = $this->input->post('contract_start_date');
		$contractEndDate = $this->input->post('contract_end_date');
		$billingCycle = $this->input->post('billing_cycle');
		
		
		$contractRecordArr = array(
		                      'customer_id' => $customerId,
							  'start_date'  => $contractStartDate,
							  'end_date'    => $contractEndDate,
							  'billing_cycle' => $billingCycle,
							  'created_date' => date("Y-m-d H:i:s")
		                       );
		$contractId = $this->mdl_contract->insertContractRecord($contractRecordArr);
		
		if(!empty($contractId)){
			$defaultContractArr = array(
			                      'contract_id' => $contractId,
								  'customer_id' => $customerId,
								  'serial_no'   => $serialNoDefault,
								  'inventory_id' => $inventoryItemIdDefault,
								  'qty' => $qtyDefault,
								  'unit_price' => $unitPriceDefault,
								  'total_price' => $totalPriceDefault          
			);
			
			
			$chkInsertDefault = $this->mdl_contract->insertDefaultContract($defaultContractArr);
			if($chkInsertDefault == 'false'){
				return false;
			}
			if($serialNoGenerated != null){
				$countOfGeneratedSerialNo = count($serialNoGenerated);
			    $generatedContractArr = array();
				for($i=0;$i<$countOfGeneratedSerialNo;$i++){
		
				$moreData=array('contract_id' => $contractId, 'customer_id' => $customerId, 'serial_no' => $serialNoGenerated[$i],'inventory_id' => $inventoryItemGenerated[$i], 'qty' => $qtyGenerated[$i], 'unit_price' => $unitPriceGenerated[$i], 'total_price' => $totalPriceGenerated[$i] );
				array_push($generatedContractArr, $moreData);
				
			}
			
			$chkInsertGenerated = $this->mdl_contract->insertGeneratedContract($generatedContractArr);
			if($chkInsertGenerated == 'false'){
				return false;
			}
				
			}
		}
	}
	//---------------------------------------------------------------------------------------------------
	
	
	
}