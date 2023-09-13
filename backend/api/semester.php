<?php

require_once '../database.php';

$db = new Database();

if(isset($_GET['getall']))
{
	$result = $db->fetch("Semesters");

	if(!empty($result))
	{
		echo json_encode("status" => 200, "data" => $result);
	}

}