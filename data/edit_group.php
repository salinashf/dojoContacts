<?php
include_once("database.php");

$group_id = $_POST['edit_group_id'];
$group_name = $_POST['edit_group_name'];

$sql = "UPDATE groups SET name = '".mysqli_real_escape_string($conn, $group_name )."' WHERE id = ".mysqli_real_escape_string($conn , $group_id);
$result = mysqli_query($sql) or die("Could not rename group in database");
if(mysqli_affected_rows() > 0 && $_POST['edit_group_ajax'] == "0") {
	header("Location: ../index.html");
} else {
	header('Content-Type: application/json; charset=utf8');
	$data = array();
	if(mysqli_affected_rows() > 0) {
		$data['success'] = true;
		$data['id'] = $group_id;
		$data['name'] = $group_name;
	} else {
		$data['success'] = false;
		$data['error'] = 'Error: could not rename group in database';
	}
	echo json_encode($data);
}
?>