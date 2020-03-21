<?php

namespace App\Services;


class NoticeService
{
    public function noticeArray($limit=null)
    {

        $noticeArray = [
        [
            'notice_number' => 1,
            'date' => '18 March, 2020',
            'title' => 'Easytrax Operations Update due to rapid spread of COVID-19 across the world !!',
             'body' => $this->coronaNoticeBody,
        ],

    ];
        if ($limit !=null){
            $noticeArray = array_slice($noticeArray, 0, $limit, true);
        }

        return $noticeArray;
    }

    protected $coronaNoticeBody = '<p>Dear Customers,</p>

<p>With the rapid spread of COVID-19 across the world and the consequent disruptions, we at Easytrax have taken all the necessary steps to ensure that our operations continue smoothly for all our customers and to ensure the safety of our team members.</p>

<p>Our Support and NOC teams continue to work 9am-11am*7*365 to serve each of you.  Our Tech, Finance, Vehicle Engineers, Operations, and Business & Key Account Managers are also available as usual to provide all the assistance you need.</p>

<p>Please reach out to us if you need any assitance. While this is a challenging time, we remain optimistic and look forward to serving each of you to the best of our abilities.</p>

<p>Thank you !</p>

<p>Regards,</p>

<p>Abul Bashar Md Sharif<br>
Chief Operating Officer<br>
support@easytrax.com.bd<br>
+88096067788<br>
+8801709888909</p>';

}
