<?php

try {
	$pdo = new PDO('mysql:dbname=allchats; host=localhost', 'root', 'root');
} catch (PDOException $e) {
	die($e->getMessage());
}
