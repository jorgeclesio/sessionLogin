<?php 

session_start(); //Pra iniciar sessão.

require_once("../libs/common.php");

$mysqli = getDB();

$stmt = $mysqli->prepare("INSERT INTO currentUsers(id, name, digest) VALUES(?, ?, PASSWORD(?))");

$sDigest = $_POST["username"] . $_POST["password"];

$stmt->bind_param("sss", $_POST["username"], $_POST["name"], $sDigest);

$stmt->execute();

if($stmt->affected_rows != 1)
{
	print_r($stmt);
	return;
}

header('Location: index.php');

$currentUser = new stdClass();
$currentUser->name = $_POST["name"];

$_SESSION["currentUser"] = $currentUser;

?>
