<?php

require_once '../database.php';

$db = new Database();


$lecturer = $db->fetch("Lecturers");

if(!empty($lecturer))
{
	echo json_encode(["status" => 200, "data" => $lecturer]);
}