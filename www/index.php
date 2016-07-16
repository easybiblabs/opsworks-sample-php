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

    // lets get the Queue URL
    $request_options = array( 
        'QueueName' => 'testing-sqs-queue'
    );

    // make the request
    $results = $sqs_client->getQueueUrl($request_options);
    print_r($results);
    echo '<hr/>';

    // we have a Queue URL (No error checking oh well)
    $queue_url = $results['QueueUrl'];

    // set up a message
    $date = date('m/d/Y h:i:s a', time());
    $message_body = '('.$date.') This is a message';
    $delay_seconds = 0;

    // set up request options
    $request_options = array( 
        'DelaySeconds' => $delay_seconds,
        'MessageBody' => $message_body,
        'QueueUrl' => $queue_url
    );
    
    // Send the message to the queue
    $results = $sqs_client->sendMessage($request_options);
    print_r($results);
    echo '<hr/>';
    
    // set up request options
    $request_options = array( 
        'QueueUrl' => $queue_url,
        'WaitTimeSeconds' => 20
    );

    // LONG POLLING can be used here with the parameter "WaitTimeSeconds"
    // with a maximum wait time of 20 seconds.
    // purge the queue
    $results = $sqs_client->receiveMessage($request_options);
    print_r($results);
    echo '<hr/>';

    // dump out results
    print_r(json_encode($results->toArray()));
