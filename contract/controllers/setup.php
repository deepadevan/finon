<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Setup extends Admin_Controller {

	function __construct() {

		parent::__construct(TRUE);

	}

	function index() {}

	function install() {

		$queries = array(
				   '0' => "CREATE TABLE IF NOT EXISTS `contract_content` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `contract_id` int(11) NOT NULL,
				  `customer_id` int(11) NOT NULL,
				  `serial_no` int(11) NOT NULL,
				  `inventory_id` int(11) NOT NULL,
				  `qty` int(11) NOT NULL,
				  `unit_price` int(11) NOT NULL,
				  `total_price` int(11) NOT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8;",
				'1'=>"CREATE TABLE IF NOT EXISTS `contract_record` (
				  `contract_id` int(11) NOT NULL AUTO_INCREMENT,
				  `customer_id` int(11) NOT NULL,
				  `start_date` date NOT NULL,
				  `end_date` date NOT NULL,
				  `billing_cycle` varchar(100) NOT NULL,
				  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				  PRIMARY KEY (`contract_id`)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8;"
				);


		foreach ($queries as $query) {

			$this->db->query($query);

		}

	}

	function uninstall() {
	}
}
?>