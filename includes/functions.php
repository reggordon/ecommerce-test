<?php
function getProducts($conn) {
    $result = $conn->query("SELECT * FROM products");
    if (!$result) {
        die("Query failed: " . $conn->error);
    }
    return $result->fetch_all(MYSQLI_ASSOC);
}
?>

