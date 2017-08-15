<?php 
	if (isset($_POST['edit'])) {
		$data_to_edit = json_decode($_POST['edit']);
	}else if (isset($_POST['update'])) {
		$data_to_edit = json_decode($_POST['edit']);
	}else{
		echo json_encode('posts not set');
	}
 ?>