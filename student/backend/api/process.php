<?php
require_once '../database.php';

$db = new Database();


if (isset($_GET['generate']) && $_GET['generate'] !== "") {
    // Replace with the appropriate semester ID
    $semester_id = $_GET['generate'];

    // Delete existing timetable entries for the specified semester
    $db->deleteWhere("Timetable", "semester", $semester_id);

    // Database connection code here

    // Fetch courses with specific columns from the database
    $sampleCourses = $db->selectWhereJoin(
        "Courses",
        ["course_name", "department_name", "level_name", "lecturer_name"],
        [
            ['type' => 'INNER', 'table' => 'Departments', 'on' => 'Departments.department_id = Courses.department_id'],
            ['type' => 'INNER', 'table' => 'Levels', 'on' => 'Levels.level_id = Courses.level_id'],
            ['type' => 'INNER', 'table' => 'Lecturers', 'on' => 'Lecturers.lecturer_id = Courses.lecturer_id']
        ],
        [
            ['field' => 'Courses.semester_id', 'operator' => '=', 'value' => $semester_id]
        ]
    );

    // Fetch classroom names from the database
    $classrooms = array_column($db->fetch("Classrooms"), 'classroom_name');

    // Shuffle arrays
    shuffle($classrooms);
    shuffle($sampleCourses);

    // Define days of the week, time slots, and initialize timetable
    $daysOfWeek = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];
    $timeSlots = ["8:00 AM - 10:00 AM", "10:00 AM - 12:00 PM", "12:00 PM - 2:00 PM", "2:00 PM - 4:00 PM", "4:00 PM - 6:00 PM"];
    shuffle($daysOfWeek);
    shuffle($timeSlots);

    // Create an empty timetable structure
    $timetable = [];

    // Create combinations of day, time, and classroom
    foreach ($daysOfWeek as $day) {
        shuffle($timeSlots);
        foreach ($timeSlots as $timeSlot) {
            shuffle($classrooms);
            foreach ($classrooms as $classroom) {
                $combinedArray[] = [
                    "day" => $day,
                    "time" => $timeSlot,
                    "class" => $classroom
                ];
            }
        }
    }

    // Shuffle the combined array
    shuffle($combinedArray);

    // Initialize an index array
    $index = range(0, count($combinedArray) - 1);
    shuffle($index);

    // Populate the timetable with course information and insert into the database
    $i = 0;
    foreach ($sampleCourses as $key) {
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

    // Shuffle the final timetable
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