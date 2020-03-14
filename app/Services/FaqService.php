<?php

namespace App\Services;


class FaqService
{
    public function faqArray($limit=null)
    {
        $faqArray = [
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
                'question_number' => 5,
                'question' => 'Not getting Push Alerts on Mobile App ?',
                'ans' => '<p>Real time push alerts is a paid service and in some cases we cannot ensure real time push alerts due to server capacity or congestion and other factors which might lead to delay push alerts or in some cases no push alerts. We will always try to ensure this service but can’t guarantee always.</p>'
            ],
            [
                'question_number' => 6,
                'question' => 'Missing Event alerts on App ?',
                'ans' => '<p>In some cases some alert events might be missed due to server capacity and congestion in our server. Most of them might be with ignition on off alerts as its the most triggered alerts in our system.</p>'
            ],
            [
                'question_number' => 7,
                'question' => 'Vehicle Engine not getting Started ?',
                'ans' => '<p>In some cases we get complaints that vehicle is not starting and blame GPS device for this. But actually there are some other vehicle related issues where your vehicle might not start. Please check the below to confirm the issue :</p><ul><li>Fuse box and check whether any fuse has been disabled</li><li>Check battery status, your battery might be drained</li><li>Check electric wires connected with ignition or fuel pump</li></ul>'
            ],
            [
                'question_number' => 8,
                'question' => 'Vehicle Showing Expired in App?',
                'ans' => '<p>You need to pay your monthly bills to renew your device. Please call our hotline to check outstanding due or Pay directly through our Direct Digital Payment Link :</p><a href="https://crm.easytrax.com.bd/payment" target="_blank">Click here(Bkash, Debit/Credit/Visa/Master/Amex Cards)</a>'
            ],
            [
                'question_number' => 9,
                'question' => 'Seeing Straight Lines in Playback History ?',
                'ans' => '<p>You might see straight lines in playback reports when 1st vehicles starts in the morning. GPS signal takes up to 3-5 minutes in some cases to activate after vehicle starts moving. So you might see straight lines after long parking. But if this shows in all trips then please contact directly with our support engineer at 09606667788</p>'
            ],
            [
                'question_number' => 10,
                'question' => 'Vehicle Showing Expired on App?',
                'ans' => '<p>You need to pay your monthly bills to renew your device. Please call our hotline to check outstanding due or Pay directly through our Direct Digital Payment Link :</p> <a href="https://crm.easytrax.com.bd/payment" target="_blank">Click here(Bkash, Debit/Credit/Visa/Master/Amex Cards)</a>'
            ],
            [
                'question_number' => 11,
                'question' => 'Contact Support',
                'ans' => '<p>Hotline : <a href="tel:09606667788">09606667788</a> (9am-11pm)<br>Email : <a href="mailto:support@easytrax.com.bd">support@easytrax.com.bd</a> (9am-6pm)<br>Live Chat Bot : Click on floating chat button at lower-right side</p>'
            ],
            [
                'question_number' => 12,
                'question' => 'Need Onsite Service Request ?',
                'ans' => '<p>Onsite Support Request :</p> <a href="https://www.easytrax.com.bd/service-appointment-request" target="_blank">Click here(Bkash, Debit/Credit/Visa/Master/Amex Cards)</a>'
            ],
            [
                'question_number' => 13,
                'question' => 'Need to Download Easytrax App ?',
                'ans' => '<p>Android and IOS App : <a href="http://telematics.easytrax.com.bd" onclick="javascript:window.open(\'http://telematics.easytrax.com.bd/\'); return false;">http://telematics.easytrax.com.bd</a><br>
Web : <a href="https://track.easytrax.com.bd" onclick="javascript:window.open(\'https://track.easytrax.com.bd/\'); return false;">https://track.easytrax.com.bd</a></p>'
            ],
            [
                'question_number' => 14,
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
            $faqArray = array_slice($faqArray, 0, $limit, true);
        }

        return $faqArray;
    }
}
