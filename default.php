<?php
//By Farid Saniee Pour
// 2022/12/21 (Happy NEW Year)

error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once("api.php"); // Add API manager Class

$data =  array("name"=>"Farid Saniee Pour", "email" => "faridsaniee@gmail.com", "url" => "https://github.com/faridsaniee/dna");
$service = new api_methode();
print_r($service->func_post($data));
?>