<?php

include 'db.php';

$name = $_POST['name'];

$link = mysqli_connect("localhost", "root", "root", "allchats");


// Create chat

if (isset($_POST['add'])) {
	$sql = ("INSERT INTO chats (name) VALUES(?)");
	$query = $pdo->prepare($sql);
	$query->execute([$name]);

	// create table for it
	$sql = ("CREATE TABLE `$name`
		(id int not null primary key auto_increment, sender varchar(16), message varchar(255), created timestamp default current_timestamp)");
	$r = mysqli_query($link, $sql);

	if ($query && $r) {
		header("Location: ". $_SERVER['HTTP_REFERER']);
	}
}

// List chats

$sql = $pdo->prepare("SELECT * FROM chats");
$sql->execute();
$result = $sql->fetchAll(PDO::FETCH_OBJ);
