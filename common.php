<?php

$hostname = 'localhost';
$database = 'backstage';
$user = 'root';
$password = '';

$sql = new mysqli($hostname, $user, $password, $database);

if ($sql->connect_error)
	die("connection failed: " . $sql->connect_error);