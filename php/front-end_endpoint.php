<?php
require 'sqlConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

	if (isset($_GET['data'])) {
		if ($_GET['data'] == 'categories') {
			
			$category_array = array();

			$query = "SELECT * FROM categories;";

			if($result = $conn -> query($query)){
				while ($row = $result->fetch_assoc()) {
					$id = $row['id'];
					$name = $row['name'];
					$category_array[$id]['id'] = $id;
					$category_array[$id]['name'] = $name;
				}
			}

			$query = "SELECT * FROM application;";

			if($result = $conn -> query($query)){
				$data_array = array();
				while ($row = $result->fetch_assoc()) {
					$category = $row['category'];
					$category_name = $category_array[$category]['name'];
					$name = $row['name'];
					$image = $row['image'];
					$link = $row['link'];
					$description = $row['description'];
					if (in_array($category, $category_array)) {
						$data_array[$category]['name'] = $category_name;
						$app['name'] = $name;
						$app['image'] = $image;
						$app['link'] = $link;
						$app['description'] = $description;

						array_push($data_array[$category]['apps'], $app);
					}else{
						array_push($category_array, $row['category']);
						$data_array[$category]['name'] = $category_name;
						$data_array[$category]['apps'] = array();
						$app['name'] = $name;
						$app['image'] = $image;
						$app['link'] = $link;
						$app['description'] = $description;

						array_push($data_array[$category]['apps'], $app);
					}
				}
				echo json_encode($data_array);
			}else{
				$Error = array('SQL ERROR: ' => mysqli_error($conn));
				echo json_encode($Error);
			}
		}else{
			echo "no data requested";
		}
	}else{
		$Error = array('REQUEST_METHOD ERROR: ' => 'GET method is not set.');
		echo json_encode($Error);
	}

}

$conn->close();
 ?>