<?php
Class api_methode
{
	public $url = "https://corednacom.corewebdna.com/assessment-endpoint.php";
	public $methode = "";
	public $req_id = "";
	// it use to manage API Services
	function func_comminicator($header_array = array(),$body=array())
	{
		$req_id = $this->req_id = time().rand(10000,99999);
		$response_time = 0;
		$url = $this->url;
		$response = "";
		$methode = $this->methode;
		$methode = strtoupper($methode);
		$curl = curl_init();
		$status = 0;
		if(is_array($body)){$data_json = json_encode($body);}
		else{return $this->func_response_manager(400,$header_array,$body,$response_time);} // check error handling
		curl_setopt_array($curl, array(
			CURLOPT_URL => $this->url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => $methode,
			CURLOPT_POSTFIELDS =>$body,
			CURLOPT_HTTPHEADER => $header_array
		));
		$response = curl_exec($curl);
		$info = curl_getinfo($curl);
	    $httpReturnCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	    $status = $httpReturnCode;
		if (!curl_errno($curl))
		{
		  $info = curl_getinfo($curl);
		  $response_time = $info['total_time'];			
		}
		curl_close($curl);
		return $this->func_response_manager($status,$header_array,$body,$response_time);
	}
	//its manage all of response and error handler
	function func_response_manager($status,$header_array,$body,$response_time)
	{
		$methode = $this->methode;
		switch ($status) 
		{
			case '100':
				$status_body = "Continue";
				break;
			case '101':
				$status_body = "Switching Protocols";
				break;
			case '102':
				$status_body = "Processing ";
				break;
			case '103':
				$status_body = "Early Hints ";
				break;
			case '200':
				$status_body = "Done ";
				break;
			case '201':
				$status_body = "Created";
				break;
			case '202':
				$status_body = "Accepted";
				break;
			case '400':
				$status_body = "Bad Request";
				break;
			case '401':
				$status_body = "Unauthorized";
				break;
			case '403':
				$status_body = "Forbiden";
				break;
			case '404':
				$status_body = "Not Found";
				break;
			default:
				$status_body = "";
				break;
		}
		$req_id = $this->req_id;
		$response_array = array(
			"request" => array(
				"req_id" => $req_id,
				"methode" => $methode,
				"header" => $header_array,
				"body" => $body,
			),
			"response" => array(
				"status" =>$status,
				"description" => $status_body,
				"time" => $response_time,
				"body" => $body,
			)
		);
		$this->func_log_request($req_id,json_encode($response_array));
		return $response_array;
	}
	// log all of request and response in Log folder
	function func_log_request($req_id,$body)
	{
		$path = "log";
		$myfile = fopen("$path/$req_id.txt", "w");
		fwrite($myfile, $body);
		fclose($myfile);
	}
	//manage get token
	function func_get_token()
	{
		$this->methode = "OPTIONS";
		$header = array('Content-Type: application/json');
		$token = $this->func_comminicator($header);
		return $token;
	}
	function func_post($data)
	{
		$this->methode = "POST";
		$token_response = $this->func_get_token();
		$token_status = $token_response['response']['status'];
		$body = array();
		if($token_status == 200)
		{
			$token = $token_response['response']['body'];
			$token = "d417fcbc-94b7-4357-aff3-536c33364428";
			$header = array('Content-Type: application/json','Authorization: Bearer ' . $token);
			$body_reponse = $this->func_comminicator($header,$data);
			$body = $body_reponse;
		}
		return $body;
	}
}

?>