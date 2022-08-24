<?php
include_once("database.php");

$group_name = $_POST['new_group_name'];
$sql = "INSERT INTO groups(name) VALUES('".mysqli_real_escape_string($conn , $group_name )."');";
$result = mysqli_query($sql) or die("Could not add group to database");
if(mysqli_affected_rows() > 0 && $_POST['new_group_ajax'] == "0") {
	header("Location: ../index.html");
} else {
	header('Content-Type: application/json; charset=utf8');
	$data = array();
	if(mysqli_affected_rows() > 0) {
		$data['success'] = true;
		$data['id'] = mysqli_insert_id();
		$data['name'] = $group_name;
	} else {
		$data['success'] = false;
		$data['error'] = 'Error: could not add group to database';
	}
	echo json_encode($data);
}
?>