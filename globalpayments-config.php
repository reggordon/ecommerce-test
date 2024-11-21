<?php
use GlobalPayments\Api\ServicesConfig;
use GlobalPayments\Api\ServicesContainer;

$config = new ServicesConfig();
$config->merchantId = 'regtest';
$config->accountId = 'wallets';
$config->sharedSecret = '2A9wkRXR6w';
$config->serviceUrl = 'https://pay.sandbox.realexpayments.com/pay'; // For testing

ServicesContainer::configure($config);
?>
