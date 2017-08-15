<?php
session_start();

if(isset($_POST['username'], $_POST['password'])){

	//use htmlentities() and mysqli_real_escape_string() and prepared statements to sanitise inputs
	require 'sqlConnection.php';

	$uid = $_POST['username'];
	$pwd = $_POST['password'];

	$stmt = $conn->stmt_init();
	$stmt->prepare("SELECT * FROM users WHERE username=? AND password=?");
	$stmt->bind_param("ss", $username, $password);

	$username = $uid;
	$password = $pwd;

	$stmt->execute();
	$result = $stmt->get_result();

	if ($result->num_rows === 0) { 
	    //error here
	    echo 'invalid username or password';
	} else   {
	    //set sessions because data has been found in the DB
	    $row = $result -> fetch_all(MYSQLI_ASSOC);
		$_SESSION['user'] = $row[0]['userId'];
		$_SESSION['usertype'] = $row[0]['usertype'];

		echo 'logged in. <a href="products.html">proceed to shop</a>';
	}

}else{
	echo "Error 403: You are not allowed to do that";
}

?>