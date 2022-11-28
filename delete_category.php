<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $catID = $_GET["catId"];
    include "connection.php";
    // $sql = "DELETE FROM categories WHERE id=$catID";
    $sql = "UPDATE categories 
    set is_deleted = 1, 
    deleted_at=now()
    WHERE id=$catID";
    mysqli_query($con, $sql);
    header("Location:index.php");
    // die("Deleted Successfully");
}
