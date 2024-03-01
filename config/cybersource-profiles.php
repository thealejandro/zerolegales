<?php

/* Cybersource Secure Acceptance W/M Profile Config*/
define('MERCHANT_ID', 'visanetgt_herramientaslegales');
define('PROFILE_ID',  '4F682E42-6B73-4CEC-A649-E7BBA67B0567');
define('ACCESS_KEY',  '8f81b945d22d3afc93797fda6bb276ff');
define('SECRET_KEY',  '80707f8c4f0848e7b334ee261c983eee03f34fa1ef6a4c60a90e25222d6c6beb0a990c76f6434eb4817cb15b9df6438f27199d9c3f7d4235a19ecc5a84bd96161e0d7110b4ee478f90d02c01dd4bc621530a75c8309742a0b51b1f2628be220141821895d0af4ac89526f500596c6d41aa985435fa8240ad9a439b6926c0b20a');

// DF TEST: 1snn5n9w, LIVE: k8vif92e 
define('DF_ORG_ID', 'k8vif92e');

// PAYMENT URL
define('CYBS_BASE_URL', 'https://secureacceptance.cybersource.com');

define('PAYMENT_URL', CYBS_BASE_URL . '/pay');
// define('PAYMENT_URL', '/sa-sop/debug.php');

define('TOKEN_CREATE_URL', CYBS_BASE_URL . '/token/create');
define('TOKEN_UPDATE_URL', CYBS_BASE_URL . '/token/update');

// EOF Secure Acceptance W/M

 /* Cybersource Silnet Order Profile Config*/
// define('MERCHANT_ID', ''); Merchant Id is Unique in two cases
define('PROFILE_ID_S',  '');
define('ACCESS_KEY_S',  '');
define('SECRET_KEY_S',  '');

// DF TEST: 1snn5n9w, LIVE: k8vif92e 
define('DF_ORG_ID_S', 'k8vif92e');

// PAYMENT URL
define('CYBS_BASE_URL_S', 'https://secureacceptance.cybersource.com/silent');

define('PAYMENT_URL_S', CYBS_BASE_URL_S . '/pay');
// define('PAYMENT_URL', '/sa-sop/debug.php');

define('TOKEN_CREATE_URL_S', CYBS_BASE_URL_S . '/token/create');
define('TOKEN_UPDATE_URL_S', CYBS_BASE_URL_S . '/token/update');

// EOF Silnet Order
