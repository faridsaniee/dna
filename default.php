<?php
//By Farid Saniee Pour
// 2022/12/21 (Happy NEW Year)

error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once("api.php"); // Add API manager Class

func_send_data();
function func_send_data()
{
	$service = new api_methode();
	$errod_handler = new erro_handler();
	$name = "Farid Saniee Pour";
	$email = "faridsaniee@gmail.com";
	$url = "https://github.com/faridsaniee/dna";
	$email_check = $errod_handler->check($email,"email");
	if(!$email_check)
	{
		print_r($service->func_response_manager(400,array(),"","Email is incorrect",0));
		return;
	}
	$url_check = $errod_handler->check($url,"url");
	if(!$url_check)
	{
		print_r($service->func_response_manager(400,array(),"","Github URL is incorrect",0));
		return;
	}
	$data =  array("name"=>$name, "email" => $email, "url" =>$url);
	$response = $service->func_post($data);
	print_r($response);
}
?>