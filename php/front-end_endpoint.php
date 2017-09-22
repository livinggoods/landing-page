<?php
require 'sqlConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

	if (isset($_GET['data'])) {
		if ($_GET['data'] == 'categories') {

			$query = "SELECT * FROM categories;";
			if($result = $conn -> query($query)){
				$category_array = array();
				while ($row = $result->fetch_assoc()) {
					$category_id = $row['id'];
					$name = $row['name'];
					$category_priority = $row['priority'];
					$category_array[$category_id]['id'] = $category_id;
					$category_array[$category_id]['name'] = $name;
					$category_array[$category_id]['priority'] = $category_priority;
				}
			}

			$links_array = array();
			$link_query = "SELECT * FROM links;";
			if ($result = $conn -> query($link_query)) {

				while ($lnkrow = $result->fetch_assoc()) {
					$link_id = $lnkrow['id'];
					$link_url = $lnkrow['url'];
					$link_name = $lnkrow['name'];
					if (array_key_exists($link_id, $links_array)) {
						$links_array[$link_id]['count']++;

						$links_array[$link_id]['urls'][$link_name]['url'] = $link_url;
						$links_array[$link_id]['urls'][$link_name]['name'] = $link_name;
					}else{
						$links = array();
						$links['count'] = 1;
						$links['urls'] = array();

						$links['urls'][$link_name]['url'] = $link_url;
						$links['urls'][$link_name]['name'] = $link_name;

						$links_array[$link_id] = $links;
					}
				}
			}else{
				$Error = array('SQL ERROR: ' => mysqli_error($conn));
				echo json_encode($Error);
			}

			$query = "SELECT * FROM application;";

			if($result = $conn -> query($query)){
				$data_array = array();
				while ($row = $result->fetch_assoc()) {
					$category = $row['category'];
					$category_name = $category_array[$category]['name'];
					$cat_priority = $category_array[$category]['priority'];
					$app_name = $row['name'];
					$app_image = $row['image'];
					$app_description = $row['description'];
					$app_priority = $row['priority'];
					$app_id = $row['id'];
					if (array_key_exists($category_name, $data_array)) {
						if (!array_key_exists($app_name, $data_array[$category_name]['apps'])) {
							$tmp_app['name'] = $app_name;
							$tmp_app['image'] = $app_image;
							$tmp_app['links'] = $links_array[$app_id];
							$tmp_app['description'] = $app_description;
							$tmp_app['priority'] = $app_priority;

							$data_array[$category_name]['apps'][$app_name] = $tmp_app;
						}
					}else{
						$tmp_app['name'] = $app_name;
						$tmp_app['image'] = $app_image;
						$tmp_app['links'] = $links_array[$app_id];
						$tmp_app['description'] = $app_description;
						$tmp_app['priority'] = $app_priority;

						array_push($category_name, $data_array);
						$data_array[$category_name]['name'] = $category_name;
						$data_array[$category_name]['priority'] = $cat_priority;
						$data_array[$category_name]['apps'] = array();

						$data_array[$category_name]['apps'][$app_name] = $tmp_app;
					}
				}
				echo json_encode(array("categories"=>$data_array));
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