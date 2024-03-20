<?php
return array(
    /**
     *
     */

     /**
      * Informacion de perfil de cybersource que se utiliza en codigo de los controladores
      * para generar las ordenes de pago.
      */

    "profile_id" => "E9FD976B-2310-405B-9E39-DCDEE7663851",
    "access_key" => "df1b374b581c31f2980af86c8d4e2ad4",
    "secret_key" => "7f081349a4c64141a6bbf7fd57a0a9fdf5e3d9dcc46e4e2e930f2aa7fee9c46c3bc64484eb3443b1a8d1131a3c321ef4b5eae3747d0e431d9f0887c883621a0d3d1934926de44913a969d7aec9de489f7366f8ca1e874ad59a6def7cdc92614102b5a609ee3c437d8b1afabf518433968e0495cd4543450a93182d1f955482e5",


    /**
     * Tipo de ambiente que se utiliza para las credenciales correspondientes.
     * live => produccion, test => desarrollo.
     */
    'env' => 'live',
    // 'env' => 'test',
    /**
     * The timezone to be used by cybersource
     */
    'timezone' => 'America/Los_Angeles',
    /**
     * The organization ID when creating the cybersource account
     */
    'organization_id' => 'visanetgt_herramientaslegales',
    /**
     * The Endpoint to hit
     * Change between test and prod environments
     */
    // 'wsdl_endpoint' => 'https://ics2wstesta.ic3.com/commerce/1.x/transactionProcessor/CyberSourceTransaction_1.216.wsdl',
    'wsdl_endpoint' => 'https://ics2wsa.ic3.com/commerce/1.x/transactionProcessor/CyberSourceTransaction_1.216.wsdl',
    /**
     * Probably not necessary - currently not being used
     */
    'outbound_merchant_id' => '',
    /**
     * The currency format
     */
    'currency' => 'USD',
    /**
     * Reports Endpoints
     * Change between test and prod environments
     */
    'reports' => array(
        'endpoint' => 'https://ebc.cybersource.com/ebc2/',
        // 'endpoint' => 'https://ebctest.cybersource.com/ebc2/',
        'version' => '0.1',
        'api_version' =>  '2011-03',
        'username' => 'jdieguez',
        'password' => 'gdv2hfc.ket-dmk!ZNQ',
    ),

    /**
     * Both the merchant and transaction IDs
     */
    'merchant_id' => 'visanetgt_herramientaslegales',
    'merchant_reference_code' => '',
    'transaction_id' => '',

    /**
     * Timeout for requests
     */
    'timeout' => '10',

    /**
     * Cybersource Username/Password info
     */
    'username' => 'jdieguez',
    'password' => 'gdv2hfc.ket-dmk!ZNQ',

    /**
     * Translated result codes to be returned
     * as part of the CybersourceResponse
     */
    'result_codes' => [
        '100' => 'Successful transaction.',
        '101' => 'The request is missing one or more required fields.',
        '102' => 'One or more fields in the request contains invalid data.',
        '104' => 'The access key and transaction uuid fields for this authorization request matches the access_key and transaction_uuid of another authorization request that you sent within the past 15 minutes.',
        '110' => 'Only a partial amount was approved.',
        '150' => 'Error: General system failure.',
        '151' => 'Error: The request was received but there was a server timeout.',
        '152' => 'Error: The request was received, but a service did not finish running in time.',
        '200' => 'The authorization request was approved by the issuing bank but declined by CyberSource because it did not pass the Address Verification Service (AVS) check.',
        '201' => 'The issuing bank has questions about the request.',
        '202' => 'Expired card.',
        '203' => 'General decline of the card.',
        '204' => 'Insufficient funds in the account.',
        '205' => 'Stolen or lost card.',
        '207' => 'Issuing bank unavailable.',
        '208' => 'Inactive card or card not authorized for card-not-present transactions.',
        '209' => 'American Express Card Identification Digits (CID) did not match.',
        '210' => 'The card has reached the credit limit.',
        '211' => 'Invalid CVN.',
        '221' => 'The customer matched an entry on the processor\'s negative file.',
        '222' => 'Account frozen.',
        '230' => 'The authorization request was approved by the issuing bank but declined by CyberSource because it did not pass the CVN check.',
        '231' => 'Invalid credit card number.',
        '232' => 'The card type is not accepted by the payment processor.',
        '233' => 'General decline by the processor.',
        '234' => 'There is a problem with your CyberSource merchant configuration.',
        '235' => 'The requested amount exceeds the originally authorized amount.',
        '236' => 'Processor failure.',
        '237' => 'The authorization has already been reversed.',
        '238' => 'The authorization has already been captured.',
        '239' => 'The requested transaction amount must match the previous transaction amount.',
        '240' => 'The card type sent is invalid or does not correlate with the credit card number.',
        '241' => 'The request ID is invalid.',
        '242' => 'You requested a capture, but there is no corresponding, unused authorization record.',
        '243' => 'The transaction has already been settled or reversed.',
        '246' => 'The capture or credit is not voidable because the capture or credit information has laready been submitted to your processor. Or, you requested a void for a type of transaction that cannot be voided.',
        '247' => 'You requested a credit for a capture that was previously voided.',
        '250' => 'Error: The request was received, but there was a timeout at the payment processor.',
        '475' => 'The cardholder is enrolled for payer authentication.',
        '476' => 'Payer authentication could not be authenticated.',
        '520' => 'The authorization request was approved by the issuing bank but declined by CyberSource based on your Smart Authorization settings.',
    ],
);
