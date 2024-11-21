<?php
session_start();
include 'includes/db.php';

if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    // Placeholder user ID
    $user_id = 1;

    // Calculate total price
    $total_price = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total_price += $item['price'] * $item['quantity'];
    }

    // Insert order into database
    $conn->query("INSERT INTO orders (user_id, total_price) VALUES ($user_id, $total_price)");
    $order_id = $conn->insert_id;

    // Insert order items into database
    foreach ($_SESSION['cart'] as $id => $item) {
        $conn->query("INSERT INTO order_items (order_id, product_id, quantity) VALUES ($order_id, $id, {$item['quantity']})");
    }

    // Clear the cart
    unset($_SESSION['cart']);

    echo "Order placed successfully!";
    echo "<a href='index.php'>Go back to shopping</a>";
} else {
    echo "Your cart is empty.";
}
?>
