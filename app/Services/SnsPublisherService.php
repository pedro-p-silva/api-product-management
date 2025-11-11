<?php

namespace App\Services;

use Aws\Sns\SnsClient;

class SnsPublisherService
{
    protected SnsClient $sns;
    protected string $topicArn;

    public function __construct() {
        $this->sns = new SnsClient([
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'version' => 'latest',
            'endpoint' => env('AWS_ENDPOINT', 'http://localhost:4566'),
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);

        $this->topicArn = env('AWS_SNS_TOPIC_ARN');
    }

    public function publish(string $subject, array $message): array
    {
        $payload = json_encode($message);

        $publish = $this->sns->publish([
            'TopicArn' => $this->topicArn,
            'Message' => $payload,
            'Subject' => $subject,
        ]);

        if ($publish->hasKey('MessageId')) {
            $data = $publish->get('@metadata');
            if ($data['statusCode'] === 200) {
                return [
                    'message' => "SNS Published",
                    'success' => true,
                ];
            }
        }

        return ["message" => "Error in Publishing SNS", 'success' => false];
    }
}
