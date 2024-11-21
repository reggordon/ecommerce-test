<?php
session_start();
include 'includes/db.php';
include 'includes/functions.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM products WHERE id = $id");
$product = $result->fetch_assoc();
?>

<h2><?php echo $product['name']; ?></h2>
<p><?php echo $product['description']; ?></p>
<p>Price: $<?php echo $product['price']; ?></p>

<form method="post" action="cart.php">
    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
    <label>Quantity:</label>
    <input type="number" name="quantity" value="1" min="1" max="<?php echo $product['stock']; ?>">
    <button type="submit" name="add_to_cart">Add to Cart</button>
</form>
