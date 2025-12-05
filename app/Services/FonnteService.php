<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FonnteService
{
    public static function send(string $target, string $message): array
    {
        $response = Http::withHeaders([
            'Authorization' => env('FONNTE_TOKEN'),
        ])->post('https://api.fonnte.com/send', [
            'target'      => $target,
            'message'     => $message,
            'countryCode' => '62',
        ]);

        return $response->json();
    }

    public static function notifyAdmins(string $message): void
    {
        $admins = [
            env('ADMIN_WA_1'),
            env('ADMIN_WA_2'),
            env('ADMIN_WA_3'),
        ];

        foreach ($admins as $admin) {
            if ($admin) {
                self::send($admin, $message);
            }
        }
    }
}
