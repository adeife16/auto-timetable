<?php 
	require_once '../database.php';

	$db= new Database();

$class = ["AE-1", "AE-2", "AE-3", "AE-4", "AE-5", "AE-6", "AF-1", "AF-2", "AF-3", "AF-4", "AF-5", "AF-6", "AG-1", "AG-2", "AG-3", "AG-4", "AG-5", "BA-1", "BA-2", "BA-3", "BA-4", "BA-5", "BA-6", "BB-1", "BB-2", "BB-3", "BB-4", "BB-5", "BB-6", "BC-1", "BC-2", "BC-3", "BC-4", "BC-5", "BC-6", "BD-1", "BD-2", "BD-3", "BD-4", "BD-5", "BD-6", "BE-1", "BE-2", "BE-3", "BE-4", "BE-5", "BE-6", "BF-1", "BF-2", "BF-3", "BF-4", "BF-5", "BF-6"];

$err = false;
for ($i=0; $i < count($class); $i++)
{ 
	$data = [
		"classroom_id" => $i,
		"classroom_name" => $class[$i],
		"classroom_type_id" => 1
	];

	$insert = $db->insert("Classrooms", $data);
	if(!$insert){$err = true;}
}

if(!$err)
{
	echo "Success";
}

?>