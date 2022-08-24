<?php
include_once("database.php");

$group_id = $_POST['group_id'];
$sql = "DELETE FROM groups WHERE id = ".mysqli_real_escape_string($conn, $group_id);
$result = mysqli_query($conn, $sql) or die("Could not delete group from database");

$data = array();
if(mysqli_affected_rows($conn) > 0) {
	header('Content-Type: application/json; charset=utf8');
	$data['success'] = true;
} else {
	$data['success'] = false;
	$data['error'] = 'Error: could not delete group from database';
}

echo json_encode($data);
?>