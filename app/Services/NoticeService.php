<?php

namespace App\Services;


class NoticeService
{
    public function noticeArray($limit=null)
    {
        $noticeArray = [
        [
            'question_number' => 1,
            'question' => 'Vehicle Showing Wrong Location ?',
            'ans' => '<p>No GPS company in the world can ensure 100% accuracy of device location in some conditions. These conditions are if vehicle is parked in a garage, underground parking or there are lots of high raised buildings in an area where GPS Signal fluctuates. Device location might not show the exact position. But if while the vehicle is running and location is not showing perfectly you can contact out hotline for a solution.</p>',
        ],
        [
            'question_number' => 2,
            'question' => 'Vehicle Offline ?',
            'ans' => '<p>As our service is dependent on the mobile operators sometimes you might find device offline for sometime which is totally out of our control. But if the device is offline for over 6-12 hour then you should contact our support only. There are lots of pockets and due to GPRS network capacity device might show offine. 10-60 mins offline is not an issue from our end, requesting not to panic and wait for some time to recover.</p>',
        ],
            [
                'question_number' => 3,
                'question' => 'Vehicle Shows moving but Parked ?',
                'ans' => '<p>This is also a limitation of GPS Tracking solution. In some cases when vehicle is parked and GPS signal is weak vehicle might show moving even while parked as GPS signal fluctuates like GSM network. In this case you have to check ignition status to verify vehicle status.</p>'
            ],
            [
                'question_number' => 4,
                'question' => 'Mileage incorrect ?',
                'ans' => '<p>We cannot ensure 100% accurate mileage reports as lots of factors are related to mileage. Mileage reports might vary upto (+-)5-15% in some cases. This is also a technical limitation for this industry.</p>'
            ],
            [
                'question_number' => 6,
                'question' => 'Vehicle Engine not getting Started ?',
                'ans' => '<p>In some cases we get complaints that vehicle is not starting and blame GPS device for this. But actually there are some other vehicle related issues where your vehicle might not start. Please check the below to confirm the issue :</p><ul><li>Fuse box and check whether any fuse has been disabled</li><li>Check battery status, your battery might be drained</li><li>Check electric wires connected with ignition or fuel pump</li></ul>'
            ],
            [
                'question_number' => 7,
                'question' => 'Why Easytrax Takes Monthly Service Charge?',
                'ans' => '<p>There are many questions about Easytrax. The most popular of them (yes popular, because this is the maximum number of times we have to answer) is the question, what is the service charge?</p><p>This service has many components. There is a little need to go in and see if there is any idea</p><p>This service has many components. There is a little need to go in and see if there is any idea</p><ol><li>Server costs</li><li>Map costs (Google Map is not free)</li><li>Limited cost</li><li>Software development and maintenance costs</li><li>Future service costs of new extensions</li><li>Installation and repair costs (home / office installation or service point arrangement)</li><li>Company overhead (without which we will not be able to access your service)</li></ol><p>Only by looking at these costs will you realize that these costs are reasonable for this service. Point 6 or repair costs are the highest cost for a customer’s vehicle problem. For a new car it takes about once every 4 to 6 months, but the old car usually takes about 6 months, and the cost of repairing it on an average is around Tk 2000.</p>'
            ],
//            [
//                'question_number' => 15,
//                'question' => '',
//                'ans' => '<p></p>'
//            ],

    ];
        if ($limit !=null){
            $noticeArray = array_slice($noticeArray, 0, $limit, true);
        }

        return $noticeArray;
    }
}
