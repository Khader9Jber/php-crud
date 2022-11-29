<?php
include "connection.php";
$sql = "SELECT id, name, image, created_at FROM categories where is_deleted = 0";
$mysqli_result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Categories</title>
    <style>
    table,
    th,
    td {
        border: 1px solid black;
        margin: 5px;
        padding: 5px;
    }
    </style>
</head>

<body>
    <button><a href="./add_category.php">Add Category</a></button>
    <br>
    <table>
        <thead>
            <tr>
                <th>Cat ID</th>
                <th>Cat Name</th>
                <th>Cat Image</th>
                <th>Created At</th>
                <th>Operation</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($mysqli_result)) {
                echo "<tr>
                <td><a href=\"show_products.php?cat_id={$row['id']}\"> {$row['id']}</a></td>
                <td>{$row['name']}</td>
                <td><img width=\"50px\" src=\"upload/category/{$row['image']}\" alt=\"\"></td>
                <td>{$row['created_at']}</td>
                <td>
                <button>
                <a href=\"delete_category.php?catId={$row['id']}\">
                Delete
                </a> 
                </button>
                <button>
                <a href=\"update_category.php?catId={$row['id']}\">
                Update
                </a> </button>
                </td>
               
                </tr>";
            }

            ?>
        </tbody>
    </table>
</body>

</html>