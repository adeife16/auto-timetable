<?php

require_once '../database.php';

$db = new Database();


if(isset($_POST['prog']) AND $_POST['prog'] != "")
{
	$prog = $_POST['prog'];
	$level = $_POST['level'];
	$dept = $_POST['dept'];

	if($prog == "" OR $level == "" OR $dept == "")
	{

	}
	else
	{
		$data = [
			"department_name" => $dept,
			"program_id" => $prog,
			"level_id" => $level
		];

		$insert = $db->insert("Departments", $data);

		if($insert)
		{
			echo json_encode(200);
		}

	}
}

if(isset($_GET['getall']))
{
	$joins = [
    	['type' => 'INNER', 'table' => 'Programs', 'on' => 'Departments.program_id = Programs.program_id'],
    	['type' => 'INNER', 'table' => "Levels", 'on' => 'Departments.level_id = Levels.level_id']
	];
	$where = [
		['field' => 'Departments.department_id', 'operator' => '>', 'value' => 0]
	];

	$result = $db->selectWhereJoin("Departments",["level_name", "program_name", "department_name", "department_id"], $joins, $where);

	if(!empty($result))
	{
		echo json_encode(["status" => 200, "data" => $result]);
	}
}

if (isset($_GET['getdept']) AND $_GET['getdept'] != "")
{
	$level = $_GET['getdept'];
	$prog = $_GET['prog'];

	$whereClauses = [
    ['field' => 'program_id', 'operator' => '=', 'value' => $prog],
    ['field' => 'level_id', 'operator' => '=', 'value' => $level]
];

	$dept = $db->selectWhere("Departments", ["department_id", "department_name"], $whereClauses);

	if(!empty($dept))
	{
		echo json_encode(["status" => 200, "data" => $dept]);
	}
}