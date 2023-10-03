<?php
$web_link = "http://localhost/fpitime/student/";
if(!isset($_SESSION['user_id']))
{
	// header('HTTP/1.0 403 Forbidden');
	header('Location: index');
	exit;
}