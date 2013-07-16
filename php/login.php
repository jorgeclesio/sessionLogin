<?php 

if (count($_POST) != 0) 
{
	session_start();

	require_once("../libs/common.php");

	$mysqli = getDB();

	$stmt = $mysqli->prepare("SELECT name FROM currentUsers WHERE id = ? AND digest = PASSWORD(?)");

	$sDigest = $_POST["username"] . $_POST["password"];

	$stmt->bind_param("ss", $_POST["username"], $sDigest);

	$stmt->execute();

	$userset = $stmt->get_result();
	if($userset->num_rows != 1)
	{
		print_r($stmt);
		return;
	}

	$aUser = $userset->fetch_assoc();

	header('Location: index.php');

	$currentUser = new stdClass();
	$currentUser->name = $aUser["name"];

	$_SESSION["currentUser"] = $currentUser;
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Please Login to Our Site</title>
</head>
<body>
	<h1>Please Login to Our Site</h1>
	<form action="login.php" method="post">
		<p>
			<label for="username">Email Address:</label><br /> <input type="text"
				name="username" />
		</p>
		<p>
			<label for="password">Password:</label><br /> <input type="password"
				name="password" />
		</p>
		<input type="submit" value="Login" />
	</form>
	<h1>Or Sign Up if you're a new user ...</h1>
	<form action="signup.php" method="post">
		<p>
			<label for="username">Email Address:</label><br /> <input type="text"
				name="username" />
		</p>
		<p>
			<label for="name">Your Name:</label><br /> <input type="text"
				name="name" />
		</p>
		<p>
			<label for="password">Password:</label><br /> <input type="password"
				name="password" />
		</p>
		<input type="submit" value="Sign Up" />
	</form>
</body>
</html>
