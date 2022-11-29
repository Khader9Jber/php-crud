<?php
$catID = "";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $catID = $_GET["cat_id"];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $catID = $_GET["cat_id"];
    $prod_name = $_POST["prod_name"];
    $prod_desc = $_POST["prod_desc"];
    $prod_price = $_POST["prod_price"];
    $prod_quantity = $_POST["prod_quantity"];
    $cat_id = $_POST["cat_id"];
    $image_file = $_FILES["prod_image"];
    $image_name = $image_file["name"];
    $sql = "INSERT INTO products (name, description, price, image, quantity, catID)
    VALUES ('$prod_name', '$prod_desc', $prod_price, '$image_name', $prod_quantity, $cat_id);
    ";
    // echo $sql;
    // exit;
    include "connection.php";
    mysqli_query($con, $sql);
    header("Location:show_products.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>
    input {
        margin: 5px;
    }
    </style>
</head>

<body>
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="prod_name" placeholder="Product Name">
        <br>
        <input type="text" name="prod_desc" placeholder="Product Desc">
        <br>
        <input type="number" name="prod_price" placeholder="Product Price">
        <br>
        <input type="number" name="prod_quantity" placeholder="Product Quantity">
        <br>
        <input type="file" name="prod_image">
        <br>
        <input type="hidden" name="cat_id" value="<?php echo $catID ?>">
        <br>
        <input type="submit" value="Submit">
    </form>
</body>

</html>