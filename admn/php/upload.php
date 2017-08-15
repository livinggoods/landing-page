<?php
if (!empty($_FILES['files']) && isset($_POST['app'])) {
    /*print_r($_FILES['files']);
    print_r($_POST['description']);*/

    require '../../php/sqlConnection.php';
    require '../../php/randomString.php';

    $gl_target_dir = "/images/";
    $l_target_dir = "../../images/";
    $descriptions = $_POST['description'];
    $category = $_POST['category'];
    $subCategory = $_POST['subCategory'];
    $price = $_POST['price'];

    foreach ($_FILES["files"]["name"] as $key => $value) {

        $upload_ok = 1;
        $filename = generateRandomString();

        //global target file for file_exists()
        $gl_target_file = $gl_target_dir . basename($filename);
        //local target file for uploading.
        $l_target_file = $l_target_dir . basename($filename);

        $file = $_FILES["files"]["tmp_name"][$key];
        $file_type = getimagesize($file)['mime'];

        // Check if file already exists
        if (file_exists($_SERVER['DOCUMENT_ROOT'].$gl_target_file)) {
            //look for available name if it exists
            while (file_exists($_SERVER['DOCUMENT_ROOT'].$gl_target_file)) {
                $filename = generateRandomString();
                $gl_target_file = $gl_target_dir . basename($filename);
                $l_target_file = $l_target_dir . basename($filename);
            }
        }

        // Check if image file is a actual image or fake image
        if ($file_type == 'image/jpeg' || 
            $file_type == 'image/png' ||
            $file_type == 'image/svg' ||
            $file_type == 'image/gif' ||
            $file_type == 'image/psd' ||
            $file_type == 'image/bmp' ||
            $file_type == 'image/tiff' ||
            $file_type == 'image/webp') 
        {
            $ext = explode("/", $file_type);
            $gl_target_file .= '.'.$ext[1];
            $l_target_file .= '.'.$ext[1];
        }else{
            $upload_ok = 0;
        }

        // if everything is ok, try to upload file.... Make sure folder is writable!!
        if(is_writable($l_target_dir) && $upload_ok == 1){

            $query = "INSERT INTO categories (name, image, link, description, category) VALUES (
                        '" . $_POST['data']['name'] . "', 
                        '" . $gl_target_file . "', 
                        " . $_POST['data']['link'] . ", 
                        " . $_POST['data']['description'] . ", 
                        " . $_POST['data']['category'] . ");";

            if (move_uploaded_file($file, $l_target_file) && $conn -> query($query)) {
                    echo "The file ". $l_target_file . " has been uploaded.";
            } else {
                echo "<br>Sorry, there was an error uploading your file. " . $_FILES["files"]["tmp_name"][$key];
                mysqli_error($conn);
            }
        }else{
            echo "folder not writable".$l_target_dir;
        }

    }
}else{
    echo 'files array is empty :';
}

?>