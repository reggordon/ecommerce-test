
<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';
include 'includes/functions.php';
$products = getProducts($conn);
?>
<h2>Our Products</h2>
<div>
    <?php foreach ($products as $product): ?>
        <div>
            <h3><?php echo $product['name']; ?></h3>
            <p><?php echo $product['description']; ?></p>
            <p>$<?php echo $product['price']; ?></p>
            <a href="product.php?id=<?php echo $product['id']; ?>">View Details</a>
        </div>
    <?php endforeach; ?>
</div>
<?php include 'includes/footer.php'; ?>
