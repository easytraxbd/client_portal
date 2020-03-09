<?php

namespace App\Services;


use App\TelegramNotificationQueue;
use Carbon\Carbon;

class TelegramService
{
    public function setNotificationQueue($methodName, $options, $sourceInfo = [])
    {
        $newNotificationQueue = new TelegramNotificationQueue();
        $newNotificationQueue->method_name = $methodName;
        $newNotificationQueue->method_options = $options;
        $newNotificationQueue->created_at = Carbon::now();
        //Possible Source Types:
        //'clients','tickets','payment_drafts','payments','sales_invoices','tasks','none','vehicles','devices'
        $newNotificationQueue->source_type = array_key_exists('source_type', $sourceInfo) ? $sourceInfo['source_type'] : 'none';
//        $newNotificationQueue->source_type_id = array_key_exists('source_type_id', $sourceInfo) ? $sourceInfo['source_type_id'] : null;
        $newNotificationQueue->save();
    }
}
