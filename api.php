<?php
/**
 * This file is part of CORE API.
 *
 * CORE API is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 *
 */


require_once  $_SERVER['DOCUMENT_ROOT'].'/core/RestUtils/Rest.inc.php';
require_once  $_SERVER['DOCUMENT_ROOT'].'/core/Manager/DataManager.php';
require_once  $_SERVER['DOCUMENT_ROOT'].'/core/Data/Data.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type,x-prototype-version,x-requested-with');


	class API extends REST {
	

		private $_query_url_param = array();
		private $manager;

		public function __construct(){
			parent::__construct();	// Init parent contructor
			$this->manager = new DataManager();
		}
		

		/*
		 * Dynmically call the method based on the query string
		 */
		public function processApi(){
			if($this->get_request_method() != "POST"){
				$this->response('',406,0);
			}else{

				if (isset($_REQUEST['tag']) && $_REQUEST['tag'] != '') {
					// get tag
					$func = htmlentities($_REQUEST['tag']);

					if((int)method_exists($this,$func) > 0)
					{
						$this->_query_url_param= $this->proper_parse_str($_SERVER['QUERY_STRING']);
						$this->$func();

					}else $this->response('',404,0); // If the method not exist with in this class "Page not found".

				} else {
					$this->response('',404,0); // If the method not exist with in this class "Page not found".
				}
			}

		}
				





		private function customers(){
			$liste=null;
			$liste=$this->manager->selectCustomers();
			$this->get_request_data($liste);
		}

		private function customer(){
			$data= $this->getValueByKey($this->_query_url_param);
			$id = $data->getIdCustomer();

			if($id > 0){
				$liste=null;
				$liste=$this->manager->selectOneCustomer($id);
				$this->get_request_data($liste);
			}else $this->response('',410,0);

		}








	}
	
	// Initiiate Library
	
	$api = new API;
	$api->processApi();
?>