<?php
$blocked_extensions = array('exe', 'msi', 'php', 'dll');
$allowed_mimes = array('image/jpeg', 'image/gif', 'image/png');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cat_name = $_POST["cat_name"];
    $image_file = $_FILES["cat_image"];
    // var_dump($image_file);
    $image_name = $image_file["name"];
    $image_tmp = $image_file["tmp_name"];
    $image_size = $image_file["size"];

    $mimetype = mime_content_type($image_tmp);
    $splitted_name = explode(".", $image_name);
    $image_extension = strtolower(end($splitted_name));
    // echo exec('whoami');
    if (!in_array($image_extension, $blocked_extensions) && in_array($mimetype, $allowed_mimes)) {
        $new_image_name = rand(1000000, 9000000) . '.' . $image_extension;
        // exit;
        $target = "upload/category/" . $new_image_name;
        move_uploaded_file($image_tmp, $target);
        include "connection.php";
        $sql = "insert into categories (name, image) values ('$cat_name', '$new_image_name')";
        mysqli_query($con, $sql);
        header("Location:index.php");
        die("Added Successfully!!");
    } else {
        die("Failed To Upload!!");
    }
    // exit;
    // move_uploaded_file();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <style>
        input {
            margin: 5px;
        }
    </style>
</head>

<body>
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="cat_name" placeholder="Enter the category name">
        <br>
        <input type="file" name="cat_image">
        <br>
        <input type="submit" value="Submit">
    </form>

</body>

</html>