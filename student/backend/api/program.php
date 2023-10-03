<?php

require_once '../database.php';

$db = new Database();

$prog = $db->fetch("Programs");

if(!empty($prog))
{
	echo json_encode(["status" => 200, "data" => $prog]);
}