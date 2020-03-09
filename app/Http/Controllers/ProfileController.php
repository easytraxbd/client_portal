<?php

namespace App\Http\Controllers;

use App\Client;
use App\Services\TelegramService;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $telegramService;
    public function __construct(TelegramService $telegramService)
    {
        $this->telegramService = $telegramService;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function overview()
    {
        $data = [
            'title'=>"profile",
            'header'=>"profile",
            'subHeader'=>"overview",
        ];
        return view('profile.overview',$data);
    }
    public function personalInfo()
    {
        $data = [
            'title'=>"profile",
            'header'=>"profile",
            'subHeader'=>"Personal Information",
        ];
        return view('profile.personal_info',$data);
    }
    public function PasswordChangeForm()
    {
        $data = [
            'title'=>"profile",
            'header'=>"profile",
            'subHeader'=>"Change Password",
        ];
        return view('profile.change_password',$data);
    }
    public function changePassword(Request $request)
    {
        $errorArray=[];
        $request->validate([
            'new_password' => 'required|string|min:6',
            'confirm_new_password' => 'required|string|min:6',
            'password' => 'required|string|min:6',
        ]);
        $new_password = Hash::make($request->new_password);
//        return $new_password;
        $password = Auth::user()->password;
        //validation
        //check if the new password fields have equal value
        if ($request->new_password != $request->confirm_new_password){
            $errorArray["confirm_new_password"] = "Password didn't match";
        }

        //check if password is valid
        $new_password = Hash::make($request->new_password);
        if (Hash::check($request->password,$password)){
            DB::table('clients')->where('id',Auth::user()->id)->update(['password' => $new_password]);
            return back()->with('success','Password Changed Successfully!');
        }
        $errorArray["password"] = "Password didn't match";
        return back()->withErrors($errorArray);
    }

    public function update(Request $request){
        $data = [
            'birth_date' => $request->birth_date,
            'marital_status' => $request->marital_status,
            'marriage_anniversary' => $request->marriage_anniversary,
        ];
        $id = Auth::user()->id;
        DB::table('clients')->where('id',$id)->update($data);
        return back()->with('success','update info successfully');
    }
    public function updateByTicket(Request $request){
        $id = Auth::user()->id;
        $description = '';
        $client = DB::table('clients')->find($id);
        if ($client->name != $request->name){
            $description .= 'Name: '.$request->name.'<br>';
        }
        if ($client->company_name != $request->company_name){
            $description .= 'Company Name: '.$request->company_name.'<br>';
        }
        if ($client->work_phone != $request->work_phone){
            $description .= 'Contact Number: '.$request->work_phone.'<br>';
        }
        if ($client->alt_phone != $request->alt_phone){
            $description .= 'Alternative Contact Number : '.$request->alt_phone.'<br>';
        }
        if ($client->email != $request->email){
            $description .= 'Email : '.$request->email.'<br>';
        }
        if ($client->nid_number != $request->nid_number){
            $description .= 'NID : '.$request->nid_number.'<br>';
        }
        if ($client->platform_username != $request->platform_username){
            $description .= 'Platform User ID : '.$request->platform_username.'<br>';
        }
        if ($client->home_address != $request->home_address){
            $description .= 'Address : '.$request->home_address.'<br>';
        }
        if ( $description == ''){
            return redirect()->back()->with('error','Nothing to change!');
        }

        $data = [
            'title' => 'Profile Update Request',
            'description' => $description,
        ];
        $data['status'] = 1;
        $data['priority'] = 1;
        $data['ticket_type_id'] = 226;
        $data['client_id'] = $id;
        $data['call_type'] = 2;
        $ticket = Ticket::create($data);
        if (isset($ticket->id)){

$message = 'Customer "'.Auth::user()->name.'" has requested to update Profile Information.


Customer Name: '.Auth::user()->name.'
Customer ID: '.$id.'
Ticket Creation Date & Time :'.$ticket->created_at.'

Change Requested Fields:

'.$data["description"].'


Ticket Link: https://crm.easytrax.com.bd/tickets/'.$ticket->id.'

Profile Link: https://crm.easytrax.com.bd/crm/clients/'.$id.'

Profile Edit Link: https://crm.easytrax.com.bd/crm/clients/'.$id.'/edit';
            $this->sendTelegramNotification($message);
            return back()->with('success','Ticket created successfully');
        }
        return redirect()->back()->with('error','Something went wrong');
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
