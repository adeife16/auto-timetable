<?php
require_once 'process.php';

class TimetableGenerator {
    private $db; // Your database connection or interaction object
    private $populationSize = 100; // Number of timetables in each generation
    private $maxGenerations = 100; // Maximum number of generations
    private $mutationRate = 0.2; // Rate of mutation (adjust as needed)

    // Constructor to initialize the database connection
    public function __construct($db) {
        $this->db = $db;
    }

    // Define the generateRandomTimetable method
    private function generateRandomTimetable() {
        // Initialize an empty timetable
        $timetable = [];

        // Get available courses, lecturers, rooms, and time slots
        $availableCourses = $this->getAvailableCourses();
        $availableLecturers = $this->getAvailableLecturers();
        $availableRooms = $this->getAvailableRooms();
        $availableTimeSlots = $this->getAllTimeSlots();

        // Loop until all courses are scheduled
        while (!empty($availableCourses)) {
            // Randomly select a course from the available courses
            $course = array_rand($availableCourses);

            // Randomly select a lecturer for the course
            $lecturer = array_rand($availableLecturers);

            // Randomly select a room and time slot for the course
            $room = $this->getRandomAvailableRoom($timetable, $course, $availableRooms);
            $timeSlot = $this->getRandomAvailableTimeSlot($timetable, $course, $availableTimeSlots);

            // Check if the selected room is occupied at the chosen time slot
            if (!$this->isRoomOccupied($timetable, $room, $timeSlot)) {
                // Add the course assignment to the timetable
                $assignment = [
                    'course_id' => $course,
                    'lecturer_id' => $lecturer,
                    'room_id' => $room,
                    'time_slot_id' => $timeSlot,
                ];
                $timetable[] = $assignment;

                // Remove the scheduled course from the available courses
                unset($availableCourses[$course]);
            }
        }

        return $timetable;
    }

 // Define the getRandomAvailableRoom method
    private function getRandomAvailableRoom($timetable, $course, $timeSlot) {
        // Get a list of available rooms for the given time slot
        $availableRooms = $this->getAvailableRoomsForTimeSlot($timeSlot);

        // Randomly shuffle the list of available rooms for randomness
        shuffle($availableRooms);

        // Iterate through the shuffled list of available rooms
        foreach ($availableRooms as $room) {
            // Check if the room is occupied at the chosen time slot
            if (!$this->isRoomOccupied($timetable, $room, $timeSlot)) {
                return $room; // Return the first available room
            }
        }

        return null; // Return null if no available room is found
    }

    // Define the getRandomAvailableTimeSlot method
    private function getRandomAvailableTimeSlot($timetable, $course) {
        // Get a list of all available time slots
        $availableTimeSlots = $this->getAllTimeSlots();

        // Randomly shuffle the list of available time slots for randomness
        shuffle($availableTimeSlots);

        // Iterate through the shuffled list of available time slots
        foreach ($availableTimeSlots as $timeSlot) {
            // Check if the time slot is occupied for the given course
            if (!$this->isTimeSlotOccupied($timetable, $timeSlot, $course)) {
                return $timeSlot; // Return the first available time slot
            }
        }

        return null; // Return null if no available time slot is found
    }

    // Define the isRoomOccupied method
    private function isRoomOccupied($timetable, $room, $timeSlot) {
        // Iterate through the existing timetable assignments
        foreach ($timetable as $assignment) {
            // Check if the room and time slot match the existing assignment
            if ($assignment['room_id'] == $room && $assignment['time_slot_id'] == $timeSlot) {
                return true; // The room is occupied
            }
        }

        return false; // The room is not occupied
    }

    // Define the calculateClashPenalty method
    private function calculateClashPenalty($timetable) {
        $clashPenalty = 0;

        // Create a multidimensional array to track occupied time slots for each room
        $occupiedTimeSlots = [];

        // Iterate through the timetable assignments
        foreach ($timetable as $assignment) {
            $room = $assignment['room_id'];
            $timeSlot = $assignment['time_slot_id'];

            // Check if the time slot is already occupied for the same room
            if (isset($occupiedTimeSlots[$room][$timeSlot])) {
                $clashPenalty++;
            } else {
                // Mark the time slot as occupied for the room
                $occupiedTimeSlots[$room][$timeSlot] = true;
            }
        }

        return $clashPenalty;
    }

 // Define the calculateRoomUtilizationReward method
    private function calculateRoomUtilizationReward($timetable) {
        // Get a list of all available rooms
        $availableRooms = $this->getAvailableRooms();

        // Create a counter to track the number of utilized rooms
        $utilizedRoomCount = 0;

        // Iterate through the available rooms
        foreach ($availableRooms as $room) {
            // Check if the room is used at least once in the timetable
            foreach ($timetable as $assignment) {
                if ($assignment['room_id'] == $room) {
                    $utilizedRoomCount++;
                    break; // Move to the next room
                }
            }
        }

        // Calculate the room utilization reward as a percentage
        $totalRooms = count($availableRooms);
        if ($totalRooms > 0) {
            $roomUtilizationReward = ($utilizedRoomCount / $totalRooms) * 100;
        } else {
            $roomUtilizationReward = 0; // Avoid division by zero
        }

        return $roomUtilizationReward;
    }

 // Define the calculateLecturerUtilizationReward method
    private function calculateLecturerUtilizationReward($timetable) {
        // Get a list of all available lecturers
        $availableLecturers = $this->getAvailableLecturers();

        // Create a counter to track the number of courses assigned to lecturers
        $coursesAssignedToLecturers = [];

        // Initialize course counters for all available lecturers
        foreach ($availableLecturers as $lecturer) {
            $coursesAssignedToLecturers[$lecturer] = 0;
        }

        // Iterate through the timetable assignments
        foreach ($timetable as $assignment) {
            $lecturer = $assignment['lecturer_id'];

            // Increment the course counter for the assigned lecturer
            $coursesAssignedToLecturers[$lecturer]++;
        }

        // Calculate the lecturer utilization reward as a percentage
        $totalLecturers = count($availableLecturers);
        $lecturerUtilizationReward = 0;

        if ($totalLecturers > 0) {
            // Calculate the average number of courses per lecturer
            $averageCoursesPerLecturer = array_sum($coursesAssignedToLecturers) / $totalLecturers;

            // Calculate the lecturer utilization reward based on the average
            $lecturerUtilizationReward = ($averageCoursesPerLecturer / $this->getLecturerMaxTeachingLoad()) * 100;
        }

        return $lecturerUtilizationReward;
    }

    // Define the getAllTimeSlots method
    private function getAllTimeSlots() {
        // Implementation of getAllTimeSlots to retrieve all available time slots
        // This could involve querying your database or using a predefined list
        // Return the list of available time slots
    }

// Define the calculateGapPenalty method
    private function calculateGapPenalty($timetable) {
        $gapPenalty = 0;
        
        // Sort the timetable assignments by time slots
        usort($timetable, function ($a, $b) {
            return $a['time_slot_id'] - $b['time_slot_id'];
        });
        
        // Iterate through the sorted timetable assignments
        for ($i = 1; $i < count($timetable); $i++) {
            $previousAssignment = $timetable[$i - 1];
            $currentAssignment = $timetable[$i];
            
            // Calculate the time difference between the end of the previous class and the start of the current class
            $timeDifference = $this->calculateTimeDifference(
                $previousAssignment['time_slot_end'], // End time of previous class
                $currentAssignment['time_slot_start'] // Start time of current class
            );
            
            // If there is a gap between classes, calculate and add the penalty
            if ($timeDifference > 0) {
                // Adjust the penalty based on the length of the gap (you can customize this logic)
                $gapPenalty += $timeDifference;
            }
        }
        
        return $gapPenalty;
    }

 // Define the calculateTimeDifference method
    private function calculateTimeDifference($endTime, $startTime) {
        // Parse the time values into DateTime objects
        $endTimeObj = DateTime::createFromFormat('H:i', $endTime);
        $startTimeObj = DateTime::createFromFormat('H:i', $startTime);

        // Calculate the time difference in minutes
        $interval = $startTimeObj->diff($endTimeObj);
        $minutes = $interval->h * 60 + $interval->i;

        return $minutes;
    }
}
