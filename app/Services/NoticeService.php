<?php

namespace App\Services;


class NoticeService
{
    public function noticeArray($noticeNumber=null,$limit=null)
    {

        $noticeArray = [
            [
                'notice_number' => 5,
                'date' => 'March 29, 2020',
                'title' => 'Your vehicles can help doctors reach their hospitals on time!',
                'body' => $this->vehiclesForDoctorsTransportNoticeBody,
            ],
            [
                'notice_number' => 4,
                'date' => 'March 28, 2020',
                'title' => 'Doctors’ Free Transport in Lockdown Period',
                'body' => $this->doctorsTransportNoticeBody,
            ],
            [
                'notice_number' => 1,
                'date' => 'March 18, 2020',
                'title' => 'Easytrax Operations Update due to rapid spread of COVID-19 across the world !!',
                'body' => $this->coronaNoticeBody,
            ],
            [
                'notice_number' => 2,
                'date' => 'August 8, 2019',
                'title' => 'Easytrax Operational Office Holiday Hours for Eid Ul Azha',
                'body' => $this->eidNotice,
            ],[
                'notice_number' => 3,
                'date' => 'May 30, 2019',
                'title' => 'Easytrax Operational Office Holiday Hours for Eid Ul Fitre',
                'body' => $this->eidNotice2,
            ],

    ];
        if ($limit !=null){
            $noticeArray = array_slice($noticeArray, 0, $limit, true);
        }

        if ($noticeNumber!=null){
            foreach ($noticeArray as $notice){
                if ($notice['notice_number']==$noticeNumber){
                    return $notice;
                }
            }
        }

        return $noticeArray;
    }

    protected $doctorsTransportNoticeBody = "<p>সারা দেশ লকডাউনে। কিন্তু ডাক্তার এবং সেবাদানকারীদের প্রতিদিন যেতে হচ্ছে কাজে। অনেকেরই প্রাইভেট গাড়ি বা মোটরসাইকেল নাই। বাস বা অন্য যানবাহন না থাকায় ভয়ঙ্কর সমস্যায় পড়তে হচ্ছে। করপোরেট হসপিটালগুলা বাদে সব হসপিটালের পক্ষে ট্রান্সপোর্ট ব্যবস্থা করা প্রায় অসম্ভব। আমরা চেষ্টা করছি আপাতত ঢাকার ডাক্তারদের জন্য এই লকডাউনে ট্রান্সপোর্টের ব্যবস্থা করার। ডিজিএইচএস আমাদের সাথে আছে।</p><p>শুরু করার জন্য আমাদের জানা দরকার কার কার প্রয়োজন। যারা ডাক্তার আছেন ঢাকায় কাজ করছেন, বা পরিচিত কেউ আছে যার দরকার, নিচের সার্ভে ফর্মটা ফিলআপ করে দিলে আমরা চেষ্টা করব ব্যবস্থা করার।

</p><p class='text-center'>ফর্ম লিংকঃ <a href='https://forms.gle/qN5RY54Y6Z9RwH6D8'>https://forms.gle/qN5RY54Y6Z9RwH6D8</a></p><p class='text-center'>Reach out to us on Facebook :<br><a href='https://www.facebook.com/CrackPlatoomTransport'>https://www.facebook.com/CrackPlatoomTransport</a></p>";
    protected $vehiclesForDoctorsTransportNoticeBody = "<p>সারা দেশ লকডাউনে। কিন্তু ডাক্তার এবং সেবাদানকারীদের প্রতিদিন যেতে হচ্ছে কাজে। অনেকেরই প্রাইভেট গাড়ি বা মোটরসাইকেল নাই। বাস বা অন্য যানবাহন না থাকায় ভয়ঙ্কর সমস্যায় পড়তে হচ্ছে। করপোরেট হসপিটালগুলা বাদে সব হসপিটালের পক্ষে ট্রান্সপোর্ট ব্যবস্থা করা প্রায় অসম্ভব। আমরা চেষ্টা করছি আপাতত ঢাকার ডাক্তারদের জন্য এই লকডাউনে ট্রান্সপোর্টের ব্যবস্থা করার। ডিজিএইচএস আমাদের সাথে আছে।</p><p>We need to know who can help us by giving vehicles for transporting doctors around the city. Please contribute by sharing your vehicle for a noble cause!</p>
<p class='text-center'>ফর্ম লিংকঃ <a href='https://forms.gle/JVozfMtaVkJkzZJq6'>https://forms.gle/JVozfMtaVkJkzZJq6</a></p><p class='text-center'>Reach out to us on Facebook :<br><a href='https://www.facebook.com/CrackPlatoomTransport'>https://www.facebook.com/CrackPlatoomTransport</a></p>";

    protected $coronaNoticeBody = "<p>Dear Customers,</p>

<p>With the rapid spread of COVID-19 across the world and the consequent disruptions, we at Easytrax have taken all the necessary steps to ensure that our operations continue smoothly for all our customers and to ensure the safety of our team members.</p>

<p>Our Support and NOC teams continue to work 9am-11am*7*365 to serve each of you.  Our Tech, Finance, Vehicle Engineers, Operations, and Business & Key Account Managers are also available as usual to provide all the assistance you need.</p>

<p>Please reach out to us if you need any assitance. While this is a challenging time, we remain optimistic and look forward to serving each of you to the best of our abilities.</p>

<p>Thank you !</p>

<p>Regards,</p>

<p><b>Abul Bashar Md Sharif</b><br>
Chief Operating Officer<br>
support@easytrax.com.bd<br>
+88096067788<br>
+8801709888909</p>";

    protected $eidNotice = "<p>Dear Valued Customer ,</p>

<p><b>EID Mubarak</b> to all in advance.</p>

<p>Hope you all are fine and doing well. As we know that the Eid Ul Azha is arriving. This email is to inform you that, <b>Easytrax's Operational Activity will remain closed for normal business and sales from 9 Aug, 2019 to  16 Aug, 2019.</p>

<p>We will start our regular Operations (Installation, Onsite Support and Real time after sales support) from 17 Aug, 2019</b>and all the business practices will resume on re-opening date.</p>
<p>However, our online support desk will remaining open on those particular days also. But it can be little slow then the regular working days.  If you have any queries related to the closure period please do not hesitate to contact us.</p>

<p><b>Please Note: If you have any payment or urgent Purchasing/Renewal matters within this period, we will request you to complete those before the Eid Vacation to avoid any interruption on your service.</b></p>

<p>Greetings to you for blessed and joyous Eid Ul-Azha.</p>


<p>** Please rate your experience : <a href='https://goo.gl/T8Kbuz' target='_blank'>Click here</a><p>


<p>Eid Mubarak!<br>

Kind Regards,<br>

<b>Abul Bashar Md Sharif</b><br>
Chief Operating Officer<br>
Easytrax Ltd.<br><br>

Hotline: +8809606667788<br>
Email : support@easytrax.com.bd</p>";

    protected $eidNotice2 = "<p>Dear Valued Customer ,</p>

<p><b>EID Mubarak</b> to all in advance.</p>

<p>Hope you all are fine and doing well. As we know that the Eid Ul Fitre is arriving. This email is to inform you that, <b>Easytrax's Operational Activity will remain closed for normal business and sales from 4 June, 2019 to 9 June, 2019.</p>

<p>We will start our regular Operations (Installation, Onsite Support and Real time after sales support) from 10 June, 2019 </b>and all the business practices will resume on re-opening date.</p>
<p>However, our online support desk will remaining open on those particular days also. But it can be little slow then the regular working days.  If you have any queries related to the closure period please do not hesitate to contact us.</p>

<p><b>Please Note: If you have any payment or urgent Purchasing/Renewal matters within this period, we will request you to complete those before the Eid Vacation to avoid any interruption on your service.</b></p>

<p>Greetings to you for blessed and joyous Eid Ul-Fitre.</p>


<p>** Please rate your experience : <a href='https://goo.gl/T8Kbuz' target='_blank'>Click here</a><p>


<p>Eid Mubarak!<br>

Kind Regards,<br>

<b>Abul Bashar Md Sharif</b><br>
Chief Operating Officer<br>
Easytrax Ltd.<br><br>

Hotline: +8809606667788<br>
Email : <a href='mailto:support@easytrax.com.bd'>support@easytrax.com.bd</a></p>";
}
