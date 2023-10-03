<?php

require_once '../database.php';

$db = new Database();

if(isset($_POST['feedback']) AND $_POST['feedback'] != "")
{
	$data = $_POST['feedback'];

	$name = $data['name'];
	$level = $data['level'];
	$dept = $data['dept'];
	$msg = $data['msg'];

	$insert_data = [
		"name" => $name,
		"level" => $level,
		"department" => $dept,
		"message" => $msg
	];

	$insert = $db->insert("feedback", $insert_data);

	if($insert)
	{
		echo json_encode(200);
	}
	else
	{
		echo json_encode(500);
	}

}