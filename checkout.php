<?php

session_start();
require_once __DIR__ . '/vendor/autoload.php';
include 'includes/db.php';
include 'includes/globalpayments-config.php';

use GlobalPayments\Api\Entities\Transaction;
use GlobalPayments\Api\Entities\Enums\TransactionType;

// Order details
$orderId = uniqid(); // Generate a unique order ID
$amount = 100.00; // Replace with the actual amount
$currency = 'EUR'; // Change to your currency

// Create the transaction
$transaction = new Transaction();
$transaction->amount = $amount;
$transaction->currency = $currency;
$transaction->transactionType = TransactionType::SALE;
$transaction->orderId = $orderId;
$transaction->timestamp = gmdate('YmdHis');
$transaction->generateHash();

// Generate the HPP URL
$hppUrl = $transaction->getTransactionUrl();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
</head>
<body>
    <h1>Checkout</h1>
    <p>Order Total: €<?php echo $amount; ?></p>
    <form action="<?php echo $hppUrl; ?>" method="POST">
        <button type="submit">Pay Now</button>
    </form>
</body>
</html>
