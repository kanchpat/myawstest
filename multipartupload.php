<?php

// Include the AWS SDK using the Composer autoloader.
require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use Aws\Common\Exception\MultipartUploadException;
use Aws\S3\MultipartUploader;

// Instantiate the client.
$s3 = S3Client::factory([
'version' => '2006-03-01',
'region' => 'us-east-1'
]);

$bucket = 'kanchtest';
$key= 'QuestionsandAnswers.pdf';			
// Instantiate the client.
$uploader = new MultipartUploader($s3,$key, [
    'bucket'=> 'kanchtest',
    'key'=> 'QuestionsandAnswers.pdf'
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