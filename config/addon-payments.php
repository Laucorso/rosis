<?php
return [
	'merchantId' => env('ADDON_PAYMENTS_MERCHANT_ID', 'addonphptest'),
	'accountId' => env('ADDON_PAYMENTS_ACCOUNT_ID', 'internet'),
	'sharedSecret' => env('ADDON_PAYMENTS_SHARED_SECRET', 'secret'),
	'serviceUrl' => env('ADDON_PAYMENTS_SERVICE_URL', 'https://hpp.sandbox.addonpayments.com/pay'),
];