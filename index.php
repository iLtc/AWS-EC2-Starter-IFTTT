<?php
$token = $_REQUEST['token'];

if( empty($token) || $token != IFTTT_WEBHOOK_TOKEN ){
    echo 'Error: Token mismatch';
    exit;
}

require 'vendor/autoload.php';

// TODO: Check if config.php exists
require 'config.php';

$ec2 = new Aws\Ec2\Ec2Client([
    'version' => 'latest',
    'region'  => AWS_EC2_INSTANCE_REGION,
    'credentials' => [
        'key'    => AWS_ACCESS_KEY_ID,
        'secret' => AWS_SECRET_ACCESS_KEY,
    ],
]);

// TODO: Check Instance Status

try {
$result = $ec2->startInstances([
    'InstanceIds' => [AWS_EC2_INSTANCE_ID]
]);
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}