<?php
require_once '../database.php';

$db = new Database();

if(isset($_GET['generate']) AND $_GET['generate'] != "")
{
	// Fetch courses for a particular semester
	$semester_id = $_GET['generate']; // Replace with the appropriate semester ID

	$delete = $db->deleteWhere("Timetable", "semester", $semester_id);

	// Database connection code here

	// Fetch courses from the database
	$sampleCourses = array();
	
	$joins = [
	    ['type' => 'INNER', 'table' => 'Departments', 'on' => 'Departments.department_id = Courses.department_id'],
	    ['type' => 'INNER', 'table' => 'Levels', 'on' => 'Levels.level_id = Courses.level_id'],
	    ['type' => 'INNER', 'table' => 'Lecturers', 'on' => 'Lecturers.lecturer_id = Courses.lecturer_id']
	];
	$whereClauses = [
	    ['field' => 'Courses.semester_id', 'operator' => '=', 'value' => $semester_id]
	];	
	$getCourse = $db->selectWhereJoin("Courses", ["course_name", "department_name", "level_name", "lecturer_name"], $joins, $whereClauses);
	foreach ($getCourse as $key)
	{
		$arr = [
			"course_name" => $key['course_name'],
			"department_name" => $key['department_name'],
			"level_name" => $key['level_name'],
			"lecturer_name" => $key['lecturer_name']
		];
		array_push($sampleCourses, $arr);
	}

	// Fetch classrooms from the database
	$classrooms = array();
	$getClass = $db->fetch("Classrooms");
	foreach ($getClass as $key) {
		array_push($classrooms, $key['classroom_name']);
	}
	$daysOfWeek = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday");
	shuffle($daysOfWeek);
	shuffle($classrooms);
	shuffle($sampleCourses);
	shuffle($sampleCourses);
	$combinedArray = [];
	// Define the days of the week and time slots

	$timeSlots = array(
	    "8:00 AM - 10:00 AM",
	    "10:00 AM - 12:00 PM",
	    "12:00 PM - 2:00 PM",
	    "2:00 PM - 4:00 PM",
	    "4:00 PM - 6:00 PM"
	);

	shuffle($timeSlots);

	// Create an empty timetable structure
	$timetable = array();

	foreach ($daysOfWeek as $day) {
		shuffle($timeSlots);
	    foreach ($timeSlots as $timeSlot) {
			shuffle($timeSlots);
	        foreach ($classrooms as $classroom) {
	        	array_push($combinedArray, ["day" => $day, "time" => $timeSlot, "class" => $classroom]);
	            // $combinedArray[$day."_".$timeSlot."_".$classroom] = null;
	        }
	    }
	}
	$i = 0;
	shuffle($combinedArray);
	// print_r($combinedArray[23]);
	// print_r($sampleCourses);

	$index = [];
	for($j = 0; $j < count($combinedArray); $j++)
	{
		array_push($index, $j);
	}

	shuffle($index);


	foreach ($sampleCourses as $key)
	{
		$combinedArray[$index[$i]]['course'] = $key["course_name"];
		$combinedArray[$index[$i]]['department'] = $key["department_name"];
		$combinedArray[$index[$i]]['level'] = $key["level_name"];
		$combinedArray[$index[$i]]['lecturer'] = $key["lecturer_name"];
		
		array_push($timetable, $combinedArray[$index[$i]]);


		$data = [
			"day" => $combinedArray[$index[$i]]['day'],
			"time" => $combinedArray[$index[$i]]['time'],
			"class" => $combinedArray[$index[$i]]['class'],
			"course" => $combinedArray[$index[$i]]['course'],
			"department" => $combinedArray[$index[$i]]['department'],
			"level" => $combinedArray[$index[$i]]['level'],
			"lecturer" => $combinedArray[$index[$i]]['lecturer'],
			"semester" => $semester_id
		];

		$insert = $db->insert("Timetable", $data);

		$i++;
	}
	shuffle($timetable);
	echo json_encode(["status" => 200, "data" => $timetable]);
}


if(isset($_POST['download']) AND $_POST['download'] !="")
{
	$data = $_POST['download'];
	$level = $data['level'];
	$dept = $data['dept'];
	$sem = $data['sem'];

	$whereClauses = [
	    ['field' => 'department', 'operator' => '=', 'value' => $dept],
	    ['field' => 'level', 'operator' => '=', 'value' => $level],
	    ['field' => 'semester', 'operator' => '=', 'value' => $sem]
	];	

	$select = $db->selectWhere("Timetable", ["*"], $whereClauses);

	if(!empty($select))
	{
		// print_r($select);
		// exit;
		// foreach ($select as $key) {
			
		// }
		echo json_encode(["status" => 200, "data" => $select]);
	}
}