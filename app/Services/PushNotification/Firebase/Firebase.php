<?php

namespace App\Services\PushNotification\Firebase;

use JetBrains\PhpStorm\NoReturn;

class Firebase
{
    /**
     * @param $token
     * @param string $title
     * @param string $body
     * @param string|null $image
     * @param $link
     * @return void
     */
    #[NoReturn]
    public static function notification($token, string $title, string $body, string $image = null, $link = null): void
    {
        (new Notification)->sendNotification($token, $title, $body, $image, $link);
    }
}