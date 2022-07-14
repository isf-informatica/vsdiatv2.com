<?php

namespace App\Libraries;

require APPPATH.'../vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

use Aws\Polly\PollyClient;
use Aws\TranscribeService\TranscribeServiceClient;

class Aws_Library{
    public function aws_store($image = NULL)
    {
        $s3 = new S3Client([
            'credentials'       =>['key'=>'AKIAWGWFPGONSN7DTRQK','secret'=>'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'],
            'version'           => '2006-03-01',
            'region'            => 'ap-south-1',
            'signature_version' => 'v4'
        ]);

        $rand_no = rand(1000,9999);
        $ext     = '.'.pathinfo(basename($image['name']))['extension'];

        $name = str_replace(' ', '-', $image['name']);
        $name = preg_replace('/[^A-Za-z0-9\-]/', '', $name);

        $doc_url = basename($name,$ext).'_'.$rand_no.'_'.strtotime("now").$ext;

        $upload = $s3->putObject(
            array(
                'Bucket'       => 'mentorboxfiles',
                'Key'          => 'classroomFiles/'.$doc_url,
                'SourceFile'   => $image["tmp_name"],
                'StorageClass' => 'REDUCED_REDUNDANCY',
                'ACL'          => 'public-read',  
            )
        );

        return $upload['ObjectURL'];
    }

    public function text_to_speech($text = NULL)
    {
        $client = new PollyClient([
            'credentials'       =>['key'=>'AKIAWGWFPGONSN7DTRQK','secret'=>'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'],
            'version'           => 'latest',
            'region'            => 'ap-south-1',
            'signature_version' => 'v4'
        ]);

        $args = [
            'Type'         => 'standard',
            'LanguageCode' => 'en-IN',
            'OutputFormat' => 'mp3',
            'Text'         => $text,
            'TextType'     => 'text',
            'VoiceId'      => 'Raveena',
        ];

        $result = $client->synthesizeSpeech($args);
        $resultData = $result->get('AudioStream')->getContents();
        
        return base64_encode($resultData);
    }

    public function speech_to_text($url = NULL)
    {
        $awsTranscribeClient = new TranscribeServiceClient([
            'region' => 'ap-south-1',
            'version' => 'latest',
            'credentials' => [
                'key'    => 'AKIAWGWFPGONSN7DTRQK',
                'secret' => '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'
            ]
        ]);

        $job_id = uniqid();

        $transcriptionResult = $awsTranscribeClient->startTranscriptionJob([
                'LanguageCode' => 'en-US',
                'Media' => [
                    'MediaFileUri' => $url,
                ],
                'TranscriptionJobName' => $job_id,
        ]);

        $status = array();
        while(true) {
            $status = $awsTranscribeClient->getTranscriptionJob([
                'TranscriptionJobName' => $job_id
            ]);
        
            if ($status->get('TranscriptionJob')['TranscriptionJobStatus'] == 'COMPLETED') {
                break;
            }
        
            sleep(5);
        }
        
        return $status->get('TranscriptionJob')['Transcript']['TranscriptFileUri'];
    }
}