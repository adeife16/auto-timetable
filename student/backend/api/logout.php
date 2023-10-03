<?php
	require_once 'backend/config.php';
	$matric = $_SESSION['matric'];
	$log = mysqli_query($con, "INSERT INTO logs(user_id, user_type, activity, date_created) VALUES('$matric', 'student', 'Logged Out', NOW())");
	if($log)
	{
		session_destroy();
        echo'<script>sessionStorage.clear(); localStorage.clear();</script>';
		header('location: index.php');

	}
	else
	{
		print mysqli_error($con);
	}
