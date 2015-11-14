<?php 

session_start();

unset($_SESSION["currentUser"]);

//Destruir a sessão pode ser uma boa saída.
session_destroy();
header('Location: login.php');

?>
