<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//Farid

Class api_methode
{
	public $url = "https://corednacom.corewebdna.com/assessment-endpoint.php";
	function func_comminicator($methode,$header_array,$body)
	{
		$url = $this->url;
		$curl = curl_init();
		$header = array();
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
			CURLOPT_HTTPHEADER => $header,
		));
		$response = curl_exec($curl);
		curl_close($curl);
		retunr $response;
	}
	function func_get_authentication()
	{
		$header = array();
		func_comminicator("options",$header,"");
		return $url;
	}
	function func_post($data)
	{
		$header = array('Authorization: Bearer xkeysib1');
		///func_comminicator("post",$header,$data)
		return $url;
	}
}

$data = array("name"=>"Farid Saniee Pour", "email" => "faridsaniee@gmail.com", "url" => "https://github.com/faridsaniee/dna");
$data_json = json_encode($data);
$service = new api_methode();
echo $service->func_get_authentication();

?>