<?php

    require 'vendor/autoload.php';


    // No credentials to force SDK to use STS for EC2 IAM Roles
    $sqs_credentials = array();

    // Instantiate the client
    $sqs_client = new SqsClient($sqs_credentials);

    $response = $sqsi_client->listQueues();
    print_r($response);





