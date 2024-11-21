<?php
session_start();
include 'includes/db.php';

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Fetch product details from the database
    $result = $conn->query("SELECT * FROM products WHERE id = $product_id");
    $product = $result->fetch_assoc();

    if (!$product) {
        die("Product not found.");
    }

    // Create cart if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if product is already in the cart
    if (isset($_SESSION['cart'][$product_id])) {
        // Update quantity
        $_SESSION['cart'][$product_id]['quantity'] += $quantity;
    } else {
        // Add new item to the cart
        $_SESSION['cart'][$product_id] = [
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => $quantity
        ];
    }

    // Redirect to the cart page
    header("Location: cart.php");
    exit;
}

// Display the cart
?>
<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
</head>
<body>
    <h1>Your Shopping Cart</h1>

    <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
        <table border="1">
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            <?php
            $grand_total = 0;
            foreach ($_SESSION['cart'] as $id => $item):
                $total = $item['price'] * $item['quantity'];
                $grand_total += $total;
            ?>
                <tr>
                    <td><?php echo $item['name']; ?></td>
                    <td>$<?php echo $item['price']; ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td>$<?php echo $total; ?></td>
                    <td>
                        <form method="post" action="cart.php">
                            <input type="hidden" name="remove_id" value="<?php echo $id; ?>">
                            <button type="submit" name="remove_item">Remove</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3"><strong>Grand Total</strong></td>
                <td colspan="2">$<?php echo $grand_total; ?></td>
            </tr>
        </table>
        <form method="post" action="checkout.php">
            <button type="submit">Proceed to Checkout</button>
        </form>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</body>
</html>

<?php
// Handle removing items from the cart
if (isset($_POST['remove_item'])) {
    $remove_id = $_POST['remove_id'];
    unset($_SESSION['cart'][$remove_id]);

    // Redirect back to the cart page
    header("Location: cart.php");
    exit;
}
?>
