<?php

require_once '../database.php';

$db = new Database();


if(isset($_POST['save']) AND $_POST['save'] != "")
{
	$data = $_POST['save'];
	$level = $data['level'];
	$dept = $data['dept'];
	$sem = $data['sem'];
	$lect = $data['lect'];
	$code = $data['code'];
	$title = $data['title'];

	$data = [
		"course_code" => $code,
		"course_name" => $title,
		"department_id" => $dept,
		"level_id" => $level,
		"semester_id" => $sem,
		"lecturer_id" => $lect
	];

	$insert = $db->insert("Courses", $data);

	if($insert)
	{
		echo json_encode(200);
	}
}

if(isset($_GET['getall']))
{
	$joins = [
	    ['type' => 'INNER', 'table' => 'Departments', 'on' => 'Departments.department_id = Courses.department_id'],
	    ['type' => 'INNER', 'table' => 'Levels', 'on' => 'Levels.level_id = Courses.level_id'],
	    ['type' => 'INNER', 'table' => 'Semesters', 'on' => 'Semesters.semester_id = Courses.semester_id'],	
	    ['type' => 'INNER', 'table' => 'Lecturers', 'on' => 'Lecturers.lecturer_id = Courses.lecturer_id']	
	];

	$where = [
    ['field' => 'Courses.course_id', 'operator' => '>', 'value' => 0]
	];

	$courses = $db->selectWhereJoin("Courses", ["course_id", "course_code", "course_name", "department_name", "level_name", "semester_name", "lecturer_name"], $joins, $where);

	if(!empty($courses))
	{
		echo json_encode(["status" => 200, "data" => $courses]);
	}
}


if(isset($_POST['delete']) AND $_POST['delete'] != "")
{
	$id = $_POST['delete'];

	$delete = $db->deleteWhere("Courses", "course_id", $id);

	if($delete)
	{
		echo json_encode(200);
	}
}