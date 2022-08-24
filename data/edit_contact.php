<?php
include_once("database.php");

$contact_id = $_POST['edit_contact_real_id'];
$group_id = $_POST['edit_contact_group'];
$first_name = mysqli_real_escape_string($conn, $_POST['edit_contact_first_name']);
$last_name = mysqli_real_escape_string($conn, $_POST['edit_contact_last_name']);
$email_address = mysqli_real_escape_string($conn, $_POST['edit_contact_email_address']);
$home_phone = mysqli_real_escape_string($conn, $_POST['edit_contact_home_phone']);
$work_phone = mysqli_real_escape_string($conn, $_POST['edit_contact_work_phone']);
$twitter = mysqli_real_escape_string($conn, $_POST['edit_contact_twitter']);
$facebook = mysqli_real_escape_string($conn, $_POST['edit_contact_facebook']);
$linkedin = mysqli_real_escape_string($conn, $_POST['edit_contact_linkedin']);

$sql = "";
if(strlen($contact_id) > 0) {	
	$sql = "UPDATE contacts SET group_id = ".$group_id.", first_name = '".$first_name."', last_name = '".$last_name."', "
		. " email_address = '".$email_address."', home_phone = '".$home_phone."', work_phone = '".$work_phone."', "
		. " twitter = '".$twitter."', facebook = '".$facebook."', linkedin = '".$linkedin."' WHERE id = ".$contact_id;
} else {
	$sql = "INSERT INTO contacts(group_id, first_name, last_name, email_address, home_phone, work_phone, twitter, "
		. " facebook, linkedin) VALUES(".$group_id.", '".$first_name."', '".$last_name."', '".$email_address."', "
		. " '".$home_phone."', '".$work_phone."', '".$twitter."', '".$facebook."', '".$linkedin."')";
}
$result = mysqli_query($sql) or die("Could not edit contact in database");
if(mysqli_affected_rows() > 0 && $_POST['edit_contact_ajax'] == "0") {
	header("Location: ../index.html");
} else {
	header('Content-Type: application/json; charset=utf8');
	$data = array();
	if(mysqli_affected_rows() > 0) {
		$data['success'] = true;
		if(strlen($contact_id) > 0) { 
			$data['new_contact'] = false;
			$data['id'] = $contact_id;
		} else {
			$data['new_contact'] = true;
			$data['id'] = mysqli_insert_id();
		}
		$data['name'] = $first_name+" "+$last_name;
	} else {
		$data['success'] = false;
		$data['new_contact'] = (strlen($contact_id) < 1);
		$data['error'] = 'Error: could not edit contact in database';
	}
	echo json_encode($data);
}
?>