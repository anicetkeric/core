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

class REST {

    /**
     * @var array
     */
    public $_allow = array();
		public $_content_type = "application/json";
		public $_request = array();
		
		private $_method = "";		
		private $_code = 200;




		public function __construct(){

		}
		
		public function get_referer(){
			return $_SERVER['HTTP_REFERER'];
		}


        /**
         * @param $data
         * @param $status
         * @param $state
         */
          public function response($data,$status,$state){
			$this->_code = ($status)?$status:200;
			$this->set_headers();
           echo $this->request($this->_code.' '.$this->get_status_message(), $state ,$data);

			exit;
        }


        public function get_request_data($liste){
            if($liste!=null){
                if($liste==-1) $this->response('',500,0);
                else $this->response($liste, 200,1);
            }else{
                $this->response('',204,0);
            }
        }

            // For a list of http codes checkout http://en.wikipedia.org/wiki/List_of_HTTP_status_codes
            private function get_status_message(){
                $status = array(
                            100 => 'Continue',
                            101 => 'Switching Protocols',
                            200 => 'OK',
                            201 => 'Created',
                            202 => 'Accepted',
                            203 => 'Non-Authoritative Information',
                            204 => 'No Content',
                            205 => 'Reset Content',
                            206 => 'Partial Content',
                            300 => 'Multiple Choices',
                            301 => 'Moved Permanently',
                            302 => 'Found',
                            303 => 'See Other',
                            304 => 'Not Modified',
                            305 => 'Use Proxy',
                            306 => '(Unused)',
                            307 => 'Temporary Redirect',
                            400 => 'Bad Request',
                            401 => 'Unauthorized',
                            402 => 'Payment Required',
                            403 => 'Forbidden',
                            404 => 'Not Found',
                            405 => 'Method Not Allowed',
                            406 => 'Not Acceptable',
                            407 => 'Proxy Authentication Required',
                            408 => 'Request Timeout',
                            409 => 'Conflict',
                            410 => 'Gone',
                            411 => 'Length Required',
                            412 => 'Precondition Failed',
                            413 => 'Request Entity Too Large',
                            414 => 'Request-URI Too Long',
                            415 => 'Unsupported Media Type',
                            416 => 'Requested Range Not Satisfiable',
                            417 => 'Expectation Failed',
                            500 => 'Internal Server Error',
                            501 => 'Not Implemented',
                            502 => 'Bad Gateway',
                            503 => 'Service Unavailable',
                            504 => 'Gateway Timeout',
                            505 => 'HTTP Version Not Supported');
                return ($status[$this->_code])?$status[$this->_code]:$status[500];
            }

            private function request($status, $state ,$data){
                $request = array('status' => '','state' => 0,'return' => '');
                $request["status"] = $status;
                $request["state"] = $state;
                $request["return"] = $data ;

                return $this->json($request);
            }



            public function get_request_method(){
                return $_SERVER['REQUEST_METHOD'];
            }

            private function inputs(){
                switch($this->get_request_method()){
                    case "POST":
                        $this->_request = $this->cleanInputs($_POST);
                        break;
                    case "GET":
                    case "DELETE":
                        $this->_request = $this->cleanInputs($_GET);
                        break;
                    case "PUT":
                        parse_str(file_get_contents("php://input"),$this->_request);
                        $this->_request = $this->cleanInputs($this->_request);
                        break;
                    default:
                        $this->response('',406,0);
                        break;
                }
            }

            public function cleanInputs($data){
                $clean_input = array();
                if(is_array($data)){
                    foreach($data as $k => $v){
                        $clean_input[$k] = $this->cleanInputs($v);
                    }
                }else{
                    if(get_magic_quotes_gpc()){
                        $data = trim(stripslashes($data));
                    }
                    $data = strip_tags($data);
                    $clean_input = trim($data);
                }
                return $clean_input;
            }

            private function set_headers(){
              //  header("HTTP/1.1 ".$this->_code." ".$this->get_status_message());
                header("Content-Type:".$this->_content_type);
            }
            private function set_cross(){
                header('Access-Control-Allow-Origin: *');
                header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
                header('Access-Control-Allow-Headers: Content-Type,x-prototype-version,x-requested-with');
            }


            /*
       *	Encode array into JSON
      */
		public function json($data){
			if(is_array($data)){
				return json_encode($data);
			}
		}
		public function encodeHtml($responseData) {

			$htmlResponse = "<table border='1'>";
			foreach($responseData as $key=>$value) {
				$htmlResponse .= "<tr><td>". $key. "</td><td>". $value. "</td></tr>";
			}
			$htmlResponse .= "</table>";
			return $htmlResponse;
		}


		public function encodeXml($responseData) {
			// creating object of SimpleXMLElement
			$xml = new SimpleXMLElement('<?xml version="1.0"?><api></api>');
			foreach($responseData as $key=>$value) {
				$xml->addChild($key, $value);
			}
			return $xml->asXML();
		}

	public function proper_parse_str($str) {
			# result array
			$arr = array();

			# split on outer delimiter
			$pairs = explode('&', $str);

			# loop through each pair
			foreach ($pairs as $i) {
				# split into name and value
				list($name,$value) = explode('=', $i, 2);

				# if name already exists
				if( isset($arr[$name]) ) {
					# stick multiple values into an array
					if( is_array($arr[$name]) ) {
						$arr[$name][] = $value;
					}
					else {
						$arr[$name] = array($arr[$name], $value);
					}
				}
				# otherwise, simply stick it in a scalar
				else {
					$arr[$name] = $value;
				}
			}

			# return result array
			return $arr;
		}

    private  function Authorized_key(){
        $key = array('id',
            'fname',
            'lname',
            'email',
            'adresse',
            'city',
            'state',
            'postal',
            'country');

        return $key;
    }



    public function getValueByKey($query_key){

        $column_names = $this->Authorized_key();
        $keys = array_keys($query_key);
        $data= new Data();
        foreach($column_names as $desired_key){ // Check the customer received. If blank insert blank into the array.
            if(!in_array($desired_key, $keys)) {
                $val = '';
            }else{
                $val = $query_key[$desired_key];

            }
            //set object data
            if($desired_key=='id' ) $data->setIdCustomer(intval($val)) ;
            if($desired_key=='fname' ) $data->setFirstNameCustomer($val) ;
            if($desired_key=='lname' ) $data->setLastNameCustomer($val) ;
            if($desired_key=='email' ) $data->setEmailCustomer($val) ;
            if($desired_key=='adresse' ) $data->setAddressCustomer($val) ;
            if($desired_key=='city' ) $data->setCityCustomer($val) ;
            if($desired_key=='country' ) $data->setCountryCustomer($val) ;

        }
        return $data;


    }





}
?>