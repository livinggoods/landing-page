<?php 
	
if (isset($_POST['links'])) {
	require '../../php/sqlConnection.php';

    $data = json_decode($_POST['links']);
    $query = "INSERT INTO links VALUES(?, ?)";

    $stmt = $conn->stmt_init();
    $stmt -> prepare($query);
    $stmt -> bind_param('ss', $name, $URL);

    $name = $data -> name;
    $URL = $data -> URL;

    $stmt -> execute();

    echo "the links have been added.";
}else{
	echo json_encode('links was not set');
}

 ?>