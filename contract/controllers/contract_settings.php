<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Contract_Settings extends Admin_Controller {

	function __construct() {

		parent::__construct();

	}

	function display() {

		$this->load->view('settings');

	}

	function save() {

		/*
		 * As per the kindle->set_notice in the account module constructor, this function will
		 * execute when the system settings are saved.
		 */

		if ($this->input->post('dashboard_show_contract')) {

			$this->mdl_din_data->save('dashboard_show_contract', "TRUE");

		}

		else {

			$this->mdl_din_data->save('dashboard_show_contract', "FALSE");

		}

	}

}

?>