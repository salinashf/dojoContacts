<?php
include_once("database.php");

$sql = "";
if(isset($_GET['group_id']) && $_GET['group_id'] != "0") {
	$sql = "SELECT c.id, c.group_id, g.name, c.first_name, c.last_name, c.email_address, "
		. " c.home_phone, c.work_phone, c.twitter, c.facebook, c.linkedin "
		. " FROM contacts c, groups g "
		. " WHERE c.group_id = ".mysqli_real_escape_string($conn , $_GET['group_id'] )
		. " AND c.group_id = g.id";

} else {
	$sql = "SELECT c.id, c.group_id, g.name, c.first_name, c.last_name, c.email_address, "
		. " c.home_phone, c.work_phone, c.twitter, c.facebook, c.linkedin "
		. " FROM contacts c, groups g "
		. " WHERE c.group_id = g.id";
}
$result = mysqli_query($conn, $sql ) or die("Could not load contacts");

$data = array(
	'items' => array()
);
if(mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
		$data['items'][] = $row;
	}
}
header('Content-Type: application/json; charset=utf8');
echo json_encode($data);
?>