<?php

namespace App\Services\PushNotification\Firebase;

use Illuminate\Support\Facades\Http;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\NoReturn;

class Notification
{
    private string $url = 'https://fcm.googleapis.com/fcm/send';

    /**
     * @param $token
     * @param string $title
     * @param string $body
     * @param string|null $image
     * @param null $link
     */
    #[NoReturn]
    public function sendNotification($token, string $title, string $body, string $image = null, $link = null): void
    {
        $response = Http::contentType('application/json')
            ->withHeaders(['Authorization' => 'key=' . $this->getServerKey()])
            ->post($this->url, $this->prepareData($token, $title, $body, $image, $link));

        $jsonData = $response->json();
//        dd($jsonData, $this->url, ['Authorization' => 'key=' . $this->getServerKey()], $this->prepareData($token, $title, $body, $image, $link));
    }

    /**
     * @return string
     */
    private function getServerKey(): string
    {
        return 'AAAAW5qbJ-s:APA91bGD-3iAXL-Gh1G2i9vH2I7CUuPhEZYw8b5QWPwUWeEM6E-Pg6jE7oyDby2vqRSCgsE_6L3HmfMKrLLGtiwVM5PGH89ETJNZratxxj_hldR6ri7Xt35iW1ruI9mNGRpnF14ktwvD';
    }

    #[ArrayShape(['to' => "", 'notification' => "array", 'data' => "array", 'priority' => "string"])]
    private function prepareData(string $token, string $title, string $body, $image, $link): array
    {
        return [
            'to' => $token,
            'notification' => [
                'title' => $title,
                'body' => $body,
//                'image' => $image,
                'sound' => 'default',
                'badge' => '1'
            ],
//            'data' => ['link' => $link],
            'priority' => 'high'
        ];
    }
}