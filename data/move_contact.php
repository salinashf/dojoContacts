<?php
include_once("database.php");
//Get form values
$contact_id = $_POST['move_contact_id'];
$group_id = $_POST['move_contact_new'];
//Perform updateS
$sql = "UPDATE contacts SET group_id = ".mysqli_real_escape_string($conn, $group_id )." WHERE id = ".mysqli_real_escape_string($conn, $contact_id);
$result = mysqli_query($conn, $sql) or die("Could not move contact in database");
//Check if performed via Ajax
if(mysqli_affected_rows($conn) > 0 && $_POST['move_contact_ajax'] == "0") {
	header("Location: ../index.html");
} else {
	//If Ajax, return JSON response
	header('Content-Type: application/json; charset=utf8');
	$data = array();
	//If rows affected, change was successful
	if(mysqli_affected_rows($conn) > 0) {
		$data['success'] = true;
		$data['id'] = $contact_id;
	} else {
		$data['success'] = false;
		$data['error'] = 'Error: could not move contact in database';
	}
	//Output array in JSON format
	echo json_encode($data);
}
?>