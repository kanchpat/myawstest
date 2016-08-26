<?php

// Include the AWS SDK using the Composer autoloader.
require 'vendor/autoload.php';

use Aws\Glacier\GlacierClient;
use Aws\Glacier\Exception\GlacierException;
use Aws\Common\Exception\MultipartUploadException;
use Aws\Glacier\MultipartUploader;

// Instantiate the client.
$glacier = GlacierClient::factory(['version' => '2012-06-01','region' => 'us-east-1']);

$vaultname = 'kanchtestarchival';
$key= 'QuestionsandAnswers.pdf';			
// Instantiate the client.
$uploader = new MultipartUploader($glacier,$key, [
    'vault_name'=> $vaultname,
    'key'=> $key
    ] );

// Perform the upload. Abort the upload if something goes wrong.
try {
    $uploader->upload();
    echo "Upload complete.\n";
} catch (MultipartUploadException $e) {
    $uploader->abort();
    echo "Upload failed.\n";
    echo $e->getMessage() . "\n";
}
?>