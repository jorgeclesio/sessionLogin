<?php 

session_start();
if(array_key_exists("currentUser", $_SESSION))
{
	$userName = $_SESSION["currentUser"]->name;
}
else
{
	header('Location: login.php');
	return;
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Welcome to Our Page</title>
</head>
<body>
	<h1>
		Welcome to Our Page,
		<?php echo $userName?>!
	</h1>
	<a href="logout.php">Log Out</a>
</body>
</html>
