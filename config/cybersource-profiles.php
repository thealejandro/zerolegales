<?php

/* Cybersource Secure Acceptance W/M Profile Config*/
define('MERCHANT_ID', 'visanetgt_herramientaslegales');
define('PROFILE_ID',  'A336537A-19C0-4981-8C4F-3E076250FD67');
define('ACCESS_KEY',  'df1b374b581c31f2980af86c8d4e2ad4');
define('SECRET_KEY',  '7f081349a4c64141a6bbf7fd57a0a9fdf5e3d9dcc46e4e2e930f2aa7fee9c46c3bc64484eb3443b1a8d1131a3c321ef4b5eae3747d0e431d9f0887c883621a0d3d1934926de44913a969d7aec9de489f7366f8ca1e874ad59a6def7cdc92614102b5a609ee3c437d8b1afabf518433968e0495cd4543450a93182d1f955482e5');

// DF TEST: 1snn5n9w, LIVE: k8vif92e
define('DF_ORG_ID', 'k8vif92e');

// PAYMENT URL
/**
 * Aqui se puede cambiar entre el ambiente de pruebas y el ambiente de produccion.
 */
// define('CYBS_BASE_URL', 'https://testsecureacceptance.cybersource.com');
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
