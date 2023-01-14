<?php

$db = mysqli_connect("localhost", "root", "root", "allchats");
if ($db->connect_error){
    die("Connection failed: ".db->connect_error);
}
$result = array();
$message = isset($_POST['message']) ? $_POST['message'] : null;
$sender = isset($_POST['sender']) ? $_POST['sender'] : null;
$index = $_POST['i'];
$ind = $_GET['i'];

if(!empty($message) && !empty($sender)){
    $sql = "INSERT INTO ".$index."(`message`, `sender`) VALUES ('$message', '$sender')";
    $result['send_status'] = mysqli_query($db, $sql);
}

//print

$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
$items = $db->query("SELECT * FROM ".$ind." WHERE `id` >  ".$start);
while ($row = $items->fetch_assoc()){
    $result['items'][] = $row;
}

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
echo json_encode($result);
?>