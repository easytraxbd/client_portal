<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TelegramNotificationQueue extends Model
{
    protected $table = 'telegram_notification_queue';
    protected $guarded = ['id'];

    protected $casts = [
        'method_options' => 'json',
    ];

//    return [] for nulled json column
    protected function castAttribute($key, $value)
    {
        if ($this->getCastType($key) == 'array' && is_null($value)) {
            return [];
        } elseif ($this->getCastType($key) == 'array' AND ($value == '[""]' or $value == '[\'\']')) {
            return [];
        }
        return parent::castAttribute($key, $value);
    }
}
