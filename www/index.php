<?php

    require '../vendor/autoload.php';

    use Aws\Sqs\SqsClient;

    // No credentials to force SDK to use STS for EC2 IAM Roles
    $sqs_credentials = array(
       'region'            => 'us-east-1',
       'version'           => 'latest',
    );

    echo '<pre>';

    // Instantiate the client
    $sqs_client = new SqsClient($sqs_credentials);

    $response = $sqs_client->listQueues();
    print_r($response);

    