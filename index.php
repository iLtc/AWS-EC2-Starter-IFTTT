<?php
require 'vendor/autoload.php';

// TODO: Check if config.php exists
require 'config.php';

$token = $_REQUEST['token'];

if( empty($token) || $token != IFTTT_WEBHOOK_TOKEN ){
    echo 'Error: Token mismatch';
    exit;
}

$config = [
    'version' => 'latest',
    'region'  => AWS_EC2_INSTANCE_REGION
];

if( !empty(AWS_ACCESS_KEY_ID) )
    $config['credentials'] = [
        'key'    => AWS_ACCESS_KEY_ID,
        'secret' => AWS_SECRET_ACCESS_KEY,
    ];

$ec2 = new Aws\Ec2\Ec2Client( $config );

// TODO: Check Instance Status

$result = $ec2->startInstances([
    'InstanceIds' => [AWS_EC2_INSTANCE_ID]
]);