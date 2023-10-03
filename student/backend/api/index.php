<?php
Rewrite this code to fit with the database model i provided earlier:

function generateTimetable() {
        //GET database connection string inside function
        global $db;

            // SQL query to delete all rows in the table
            $delete_query = "DELETE FROM unit_room_time_day_allocation_details";
            mysqli_query($db, $delete_query);

            $delete_id_query = "ALTER TABLE unit_room_time_day_allocation_details DROP COLUMN id";
            mysqli_query($db, $delete_id_query);
            
            $update_id_query = "ALTER TABLE unit_room_time_day_allocation_details ADD id INT AUTO_INCREMENT PRIMARY KEY FIRST";
            mysqli_query($db, $update_id_query);


        //STEP 1: Initialize arrays to store units, lecturers, courses, departments, schools, rooms, and time slots
        $units = array();
        $rooms = array();
        // create an array to keep track of assigned units
        $assigned_units = array();
        $assigned_rooms = array();
        
        //STEP 2: FETCH TIME SLOTS AND POPULATE TIMESLOTS ARRAY
        $timeslots = array(
            'Monday' => array(
                '07:00-09:00', '09:00-11:00', '11:00-13:00', '13:00-15:00', '15:00-17:00', '17:00-19:00'
            ),
            'Tuesday' => array(
                '07:00-09:00', '09:00-11:00', '11:00-13:00', '13:00-15:00', '15:00-17:00', '17:00-19:00'
            ),
            'Wednesday' => array(
                '07:00-09:00', '09:00-11:00', '11:00-13:00', '13:00-15:00', '15:00-17:00', '17:00-19:00'
            ),
            'Thursday' => array(
                '07:00-09:00', '09:00-11:00', '11:00-13:00', '13:00-15:00', '15:00-17:00', '17:00-19:00'
            ),
            'Friday' => array(
                '07:00-09:00', '09:00-11:00', '11:00-13:00', '13:00-15:00', '15:00-17:00', '17:00-19:00'
            ),
        );

        //STEP 3: GET ROOM DETAILS AND PUSH THEM TO rooms array
        $rooms_query = "SELECT * FROM room_details
        INNER JOIN room_type_details ON room_type_details.room_type_id =room_details.room_type_id";
        $room_results = mysqli_query($db,$rooms_query);
        //populate room array
        // Loop through the room results and add each room to the $rooms array
        while ($room = mysqli_fetch_assoc($room_results)) {
                $rooms[] = array(
                'room_id' => $room['room_id'],
                'room_name' => $room['room_name'],
                'capacity' => $room['room_capacity'],
                'room_type' => $room['room_type']
            );
        }

        //STEP 4: Get unit details
        $units_query = "SELECT * FROM unit_details 
                        INNER JOIN lecturer_unit_details ON lecturer_unit_details.unit_id = unit_details.unit_code 
                        INNER JOIN user_details ON user_details.pf_number = lecturer_unit_details.lecturer_id
                        INNER JOIN unit_semester_details ON unit_semester_details.unit_id = lecturer_unit_details.unit_id
                        INNER JOIN semester_details ON semester_details.semester_id = unit_semester_details.semester_id
                        INNER JOIN unit_course_details ON unit_course_details.unit_id = lecturer_unit_details.unit_id
                        INNER JOIN course_details ON course_details.course_id = unit_course_details.course_id
                        INNER JOIN course_group_details ON course_group_details.course_id = course_group_details.course_id
                        GROUP BY unit_details.unit_code ORDER BY unit_details.unit_code ASC";

        $unit_results = mysqli_query($db, $units_query);

        if (mysqli_num_rows($unit_results) > 0) {
            // Push Unit_results to the $units array
            while ($row = mysqli_fetch_assoc($unit_results)) {
                $units[] = $row; // Add each row to the $units array
            }

            //SAVE UNIT AND LECTURER TEACHING THE UNIT IN A CSV FILE
            // Create a file pointer for the CSV file
            $fp = fopen('unit_lecturer_details.csv', 'w');

            // Write the headers for the CSV file
            fputcsv($fp, array('Course Code', 'Course Title', 'Lecturer ID', 'Lecturer Name', 'Semester', 'Course Name', 'Course Group'));

            // Loop through the results and write each row to the CSV file
            foreach ($units as $unit) {
                fputcsv($fp, array($unit['unit_id'], $unit['unit_name'], $unit['pf_number'], $unit['user_firstname']." ".$unit['user_lastname'], $unit['semester_id'], $unit['course_shortform'], $unit['academic_year_id']));
            }

            // Close the file pointer
            fclose($fp);


        } else {
            // IF Query did not return any rows OR
            // Query was not successful
            $error_message = mysqli_error($db);

            // Display an error message to the user or log the error for further investigation
            echo "Error: " . $error_message;
        }

        // STEP 5: ASSIGN UNITS TO TIMESLOTS

        // shuffle the units randomly
        shuffle($units);

        // open the CSV file for writing
        $csv_file = fopen('timetable.csv', 'w');

        // write the header row to the CSV file
        fputcsv($csv_file, array('Course Code', 'Course Title', 'Lecturer','Day', 'Time Slot', 'Room'));

        // loop through each unit and assign to a timeslot, room, and day
        foreach ($units as $unit) {
            // check if the unit has already been assigned
            if (in_array($unit['unit_id'], $assigned_units)) {
                continue;
            }
            
        // shuffle the timeslots, days, and rooms arrays randomly
        shuffle($timeslots);

        shuffle($rooms);

        // choose a random day from the timeslots array
        $assigned_day_key = array_rand($timeslots); // choose a random day from the timeslots array
        $assigned_day = array_keys($timeslots)[$assigned_day_key]; // get the weekday name for the chosen day
        $random_timeslot = $timeslots[$assigned_day][array_rand($timeslots[$assigned_day])]; // choose a random timeslot for the selected day
        
        if($assigned_day == 0){
            $assigned_day = "Monday";
        }elseif ($assigned_day == 1) {
            $assigned_day = "Tuesday";
        }elseif ($assigned_day == 2) {
            $assigned_day = "Wednesday";
        }elseif ($assigned_day == 3) {
            $assigned_day = "Thursday";
        }elseif ($assigned_day == 4) {
            $assigned_day = "Friday";
        }

            // loop through each room until a suitable room is found
            foreach ($rooms as $room) {
                // check if the room capacity is enough for the unit
                if ($room['capacity'] >= $unit['group_number']) {
                    // check if the unit type is Theory or ICT-Practical and allocate the room accordingly
                    if ($unit['unit_type'] == 'Theory' && $room['room_type'] == 'Standard') {
                        if (in_array($unit['unit_code'], $assigned_units)) {
                            continue;
                        }else{

                        // assign the unit to the timeslot, room, and day
                        $assignment = array(
                            'code' => $unit['unit_id'],
                            'unit' => $unit['unit_name'],
                            'unit_type'=> $unit['unit_type'],
                            'lecturer' => $unit['lecturer_id'],
                            'lecturer_name' => $unit['user_title']." ".$unit['user_firstname']." ".$unit['user_lastname'],
                            'day' => $assigned_day,
                            'timeslot' => $random_timeslot,
                            'room' => $room['room_name']
                        );
                        $assigned_rooms[$assigned_day][$random_timeslot][] = $room['room_name'];
                        $unit_id = $assignment['code'];
                        $unit_name= $assignment['unit'];
                        $unit_type= $assignment['unit_type'];
                        $day = $assignment['day'];
                        $timeslot = $assignment['timeslot'];
                        $room = $assignment['room'];
                        $lec = $assignment['lecturer_name'];
                        $lec_id =  $assignment['lecturer'];

                        // save the assignment to the CSV file
                        fputcsv($csv_file, array($unit_id, $unit_name,$lec, $day, $timeslot, $room));

                        // save the assignment to the database or elsewhere
                        $assignment_query = "INSERT INTO `unit_room_time_day_allocation_details`(`unit_id`,`lecturer_id`, `room_id`, `time_slot_id`, `weekday`)
                                            VALUES ('$unit_id','$lec_id','$room','$timeslot','$day')";
                        $assignment_results = mysqli_query($db, $assignment_query);

                        // add the assigned unit to the array of assigned units
                        $assigned_units[] = $unit['unit_code'];

                        // break out of the room loop
                        break;
                    }
                    } elseif ($unit['unit_type'] == 'ICT-Practical' && $room['room_type'] == 'ICT Labaratory') {
                        if (in_array($unit['unit_code'], $assigned_units)) {
                            continue;
                        }else{

                        // assign the unit to the timeslot, room, and day
                        $assignment = array(
                            'code' => $unit['unit_code'],
                            'unit' => $unit['unit_name'],
                            'unit_type'=> $unit['unit_type'],
                            'lecturer' => $unit['lecturer_id'],
                            'lecturer_name' => $unit['user_title']." ".$unit['user_firstname']." ".$unit['user_lastname'],
                            'day' => $assigned_day,
                            'timeslot' => $random_timeslot,
                            'room' => $room['room_name']
                        );
                        $assigned_rooms[$assigned_day][$random_timeslot][] = $room['room_name'];
                        $unit_id = $assignment['code'];
                        $unit_name= $assignment['unit'];
                        $unit_type= $assignment['unit_type'];
                        $day = $assignment['day'];
                        $timeslot = $assignment['timeslot'];
                        $room = $assignment['room'];
                        $lec = $assignment['lecturer_name'];
                        $lec_id =  $assignment['lecturer'];

                        // save the assignment to the CSV file
                        fputcsv($csv_file, array($unit_id, $unit_name,$lec, $day, $timeslot, $room));

                        // save the assignment to the database or elsewhere
                        $assignment_query = "INSERT INTO `unit_room_time_day_allocation_details`(`unit_id`,`lecturer_id`, `room_id`, `time_slot_id`, `weekday`)
                                            VALUES ('$unit_id','$lec_id','$room','$timeslot','$day')";
                        $assignment_results = mysqli_query($db, $assignment_query);

                        // add the assigned unit to the array of assigned units
                        $assigned_units[] = $unit['unit_code'];
                        
                        // break out of the room loop
                        break;
                    }
                    }elseif ($unit['unit_type'] == 'ELECT-Practical' && $room['room_type'] == 'Electronics LAB') {
                        if (in_array($unit['unit_code'], $assigned_units)) {
                            continue;
                        }else{

                        // assign the unit to the timeslot, room, and day
                        $assignment = array(
                            'code' => $unit['unit_code'],
                            'unit' => $unit['unit_name'],
                            'unit_type'=> $unit['unit_type'],
                            'lecturer' => $unit['lecturer_id'],
                            'lecturer_name' => $unit['user_title']." ".$unit['user_firstname']." ".$unit['user_lastname'],
                            'day' => $assigned_day,
                            'timeslot' => $random_timeslot,
                            'room' => $room['room_name']
                        );
                        $assigned_rooms[$assigned_day][$random_timeslot][] = $room['room_name'];
                        $unit_id = $assignment['code'];
                        $unit_name= $assignment['unit'];
                        $unit_type= $assignment['unit_type'];
                        $day = $assignment['day'];
                        $timeslot = $assignment['timeslot'];
                        $room = $assignment['room'];
                        $lec = $assignment['lecturer_name'];
                        $lec_id =  $assignment['lecturer'];

                        // save the assignment to the CSV file
                        fputcsv($csv_file, array($unit_id, $unit_name,$lec, $day, $timeslot, $room));

                        // save the assignment to the database or elsewhere
                        $assignment_query = "INSERT INTO `unit_room_time_day_allocation_details`(`unit_id`,`lecturer_id`, `room_id`, `time_slot_id`, `weekday`)
                                            VALUES ('$unit_id','$lec_id','$room','$timeslot','$day')";
                        $assignment_results = mysqli_query($db, $assignment_query);

                        // add the assigned unit to the array of assigned units
                        $assigned_units[] = $unit['unit_code'];
                        
                        // break out of the room loop
                        break;
                    }
                    }

                }
            }

    }//end of units loop

    // close the CSV file
    fclose($csv_file);

}