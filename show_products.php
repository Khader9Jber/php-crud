<?php
$catID = "";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $catID = $_GET["cat_id"];
    $sql = "SELECT p.id , p.name, p.description, p.price, p.image,
    c.id as catid, c.name as catname
    FROM products p INNER JOIN categories c
    WHERE p.catID = c.id;
    ";
    include 'connection.php';
    $result = mysqli_query($con, $sql);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    table,
    th,
    td {
        border: 1px solid black;
        padding: 5px;
        margin: 5px;
    }
    </style>
</head>

<body>
    <button>
        <a href="add_product.php?cat_id=<?php echo $catID ?>">Add Product</a>
    </button>
    <table>
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Product Description</th>
                <th>Product Price</th>
                <th>Product Picture</th>
                <th>Category ID</th>
                <th>Category Name</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row["id"]}</td>
                        <td>{$row["name"]}</td>
                        <td>{$row["description"]}</td>
                        <td>{$row["price"]}</td>
                        <td>{$row["image"]}</td>
                        <td>{$row["catid"]}</td>
                        <td>{$row["catname"]}</td>
                    </tr>";
            }
            ?>

        </tbody>
    </table>
</body>

</html>