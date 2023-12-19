<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AlertResponseServiceProvider extends ServiceProvider
{
    /**
     * service alert response.
     * 
     * @var array
     */
    public static function response($status, $html): array
    {
        $title = '';

        if ($status == 'success') {
            $title = 'Hore!';
        }
        if ($status == 'error') {
            $title = 'Oops!';
        }

        $msg = [
            'type' => $status,
            'icon' => $status,
            'title' => $title,
            'html' => $html,
        ];
        return $msg;
    }
}
