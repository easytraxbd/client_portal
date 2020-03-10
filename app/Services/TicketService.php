<?php

namespace App\Services;


class TicketService
{
    protected $telegramService;
    public function __construct(TelegramService $telegramService){
        $this->telegramService = $telegramService;
    }
    public function sendTelegramNotification($text)
    {
        $text = urlencode($text);
        //urlencode('<br>')='%3Cbr%3E'
        $text = str_replace('%3Cbr%3E','%0A',$text);

        $options = [
            'chat_id' => \Config::get('telegram.channels.ticket_channel.channel_id'),
            'text' => $text,
            'bot_token' => \Config::get('telegram.bot_token'),
        ];
        $sourceInfo = [
            'source_type' => 'tickets',
            'source_type_id' => '',
        ];
        $this->telegramService->setNotificationQueue('sendMessage', $options, $sourceInfo);
    }
}
