<?php
$blocked_extensions = array('exe', 'msi', 'php', 'dll');
$allowed_mimes = array('image/jpeg', 'image/gif', 'image/png');
$catID = "";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $catID = $_GET["catId"];
    $sql = "SELECT name, image FROM categories where id = $catID";
    include "connection.php";
    $mysqli_result = mysqli_query($con, $sql);
    $row =  mysqli_fetch_assoc($mysqli_result);
    $catName = $row['name'];
    $catImage = $row['image'];
}
echo $catID;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $catID = $_GET["catId"];

    $newName = $_POST["cat_new_name"];
    $newImage = $_FILES["cat_new_image"];
    echo $newImage["tmp_name"];
    var_dump($newImage);
    if (isset($newName) && $newImage["size"] != 0) {
        $image_name = $newImage["name"];
        $image_tmp = $newImage["tmp_name"];
        $image_size = $newImage["size"];

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
            $sql = "UPDATE `categories` SET `name`='" . $newName . "', `image`='" . $new_image_name . "' WHERE id=$catID";
            echo $sql;
            mysqli_query($con, $sql);
            header("Location:index.php");
            // $sql = "UPDATE categories set name = ";
        }
    } elseif ($newImage["size"] != 0) {
        $image_name = $newImage["name"];
        $image_tmp = $newImage["tmp_name"];
        $image_size = $newImage["size"];

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
            $sql = "UPDATE `categories` SET image='$new_image_name' WHERE id=$catID";
            mysqli_query($con, $sql);
            header("Location:index.php");
            // $sql = "UPDATE categories set name = ";
        }
    } elseif (isset($newName)) {
        include "connection.php";
        $sql = "UPDATE `categories` SET name='$newName' WHERE id=$catID";
        mysqli_query($con, $sql);
        header("Location:index.php");
    } else {
        header("Location:index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Category</title>
    <style>
        input {
            margin: 5px;
        }
    </style>
</head>

<body>
    <form method="post" enctype="multipart/form-data" action="update_category.php?catId=<?php echo $catID ?>">
        <input type="text" name="cat_new_name" value="<?php echo $catName; ?>" placeholder="Enter the category name">
        <br>
        <img width=50px src="upload/category/<?php echo $catImage ?>" alt="Unable to show">
        <input type="file" name="cat_new_image">
        <br>
        <input type="submit" value="Submit">
    </form>

</body>

</html>