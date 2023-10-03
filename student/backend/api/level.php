<?php

require_once '../database.php';

$db = new Database();

if(isset($_GET['getall']))
{

	$joins = [
    ['type' => 'INNER', 'table' => 'Programs', 'on' => 'Levels.program_id = Programs.program_id']
	];
	$where = [
		['field' => 'Levels.level_id', 'operator' => '>', 'value' => 0]
	];

	$result = $db->selectWhereJoin("Levels",["level_id", "level_name", "program_name"], $joins, $where);

	if(!empty($result))
	{
		echo json_encode(["status" => 200, "data" => $result]);
	}
}

if(isset($_GET['getlevel']) AND $_GET['getlevel'] != "")
{
	$id = $_GET['getlevel'];

	$levels = $db->fetchWhere("Levels", "program_id", $id, "level_id, level_name");

	if(!empty($levels))
	{
		echo json_encode(["status" => 200, "data" => $levels]);
	}
}