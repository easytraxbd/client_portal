<?php

namespace App\Http\Controllers;

use App\Services\TelegramService;
use App\Ticket;
use App\TicketComment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class TicketController extends Controller
{
    protected $erpUrl = 'http://crm.easytrax.com.bd/';
    protected $telegramService;
    public function __construct(TelegramService $telegramService)
    {
        $this->telegramService = $telegramService;
        $this->erpUrl;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Ticket',
            'subHeader'=>'Ticket list'
        ];
        return view('ticket.index',$data);
    }

    public function getData()
    {
        $id = Auth::user()->id;
        $ticket = Ticket::select()->where('client_id',$id)->orderBy('id','desc');
        return Datatables::of($ticket)
            ->escapeColumns([])
            ->addIndexColumn()
            ->editColumn('date', function ($ticket) {
                if (isset($ticket->date)) {
                    return Carbon::parse($ticket->date)->toDayDateTimeString();
                } else {
                    return Carbon::parse($ticket->created_at)->toDayDateTimeString();
                }
            })
            ->addColumn('type', function ($ticket) {
                if (isset($ticket->ticket_type_id)) {
                    $type = DB::table('ticket_types')->find($ticket->ticket_type_id)->title;
                    return $type;
                } else {
                    return "N/A";
                }
            })
            ->addColumn('sub_type', function ($ticket) {
                if (isset($ticket->ticket_sub_type_id)) {
                    $type = DB::table('ticket_types')->find($ticket->ticket_sub_type_id)->title;
                    return $type;
                } else {
                    return "N/A";
                }
            })
            ->addColumn('action', function ($ticket) {
                $a = '<div class="container text-center">';
                $a .= '<a href="' . url("ticket") . '/' . $ticket->id.'" title="View details" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="la la-eye"></i></a>';
                $a .= '</div>';
                return $a;
            })


//            ->filter(function ($query) use ($request) {
//                if ($request->filled('payment_id')) {
//                    $query->where('id', $request->get('payment_id'));
//                }
//                if ($request->filled('bkash_payment_id')) {
//                    $query->where('bkash_payment_id', $request->get('bkash_payment_id'));
//                }
//                if ($request->filled('from_number')) {
//                    $query->where('from_number', $request->get('from_number'));
//                }
//                if ($request->filled('transaction_id')) {
//                    $query->where('transaction_id', $request->get('transaction_id'));
//                }
//                if ($request->filled('payment_gateway_source')) {
//                    $query->where('payment_gateway_source', $request->get('payment_gateway_source'));
//                }
//                if ($request->filled('db_entry_type')) {
//                    $query->where('db_entry_type', $request->get('db_entry_type'));
//                }
//                if ($request->filled('client_id')) {
//                    $query->where('client_id', $request->get('client_id'));
//                }
//                if ($request->filled('payment_collector_id')) {
//                    $query->where('payment_collector_id', $request->get('payment_collector_id'));
//                }
//                if ($request->filled('date_from')) {
//                    $query->where('payment_date', '>=', $request->get('date_from'));
//                }
//                if ($request->filled('date_to')) {
//                    $query->where('payment_date', '<=', $request->get('date_to'));
//                }
//                if ($request->filled('payment_method')) {
//                    $query->where('payment_method', $request->get('payment_method'));
//                }
//            })
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Ticket',
            'subHeader'=>'Ticket Creation'
        ];
        return view('ticket.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the uploaded file
        $request->validate([
             'title' => 'required|string|max:100',
             'description' => 'required|string'
        ]);
        $data = $request->all();
        $data['status'] = 1;
        $data['priority'] = 1;
        $data['ticket_type_id'] = 226;
        $data['client_id'] = Auth::user()->id;
        if (Ticket::create($data)){
$message = 'A new Ticket "'.$data["title"].'" has been created by '.Auth::user()->name.'.
Type: '.DB::table('ticket_types')->find( $data['ticket_type_id'])->title.'
Priority: High
Current Status: Open
Description:'.$data["description"];
            $this->sendTelegramNotification($message);
            return redirect('ticket')->with('success','Ticket created successfully');
        }
        return redirect()->back()->with('error','Something went wrong');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        $ticketTypeName = $this->getTypeName($ticket->ticket_type_id);
        $ticketSubTypeName = $this->getTypeName($ticket->ticket_sub_type_id);
        $commentsOfEmployee = TicketComment::with('user')->where('ticket_id',$ticket->id)->where('comment_for',2)->whereNull('client_id')->get();
        $commentsOfClient = TicketComment::with('client')->where('ticket_id',$ticket->id)->where('comment_for',2)->whereNotNull('client_id')->get();
        $data = [
            'title' => 'Ticket',
            'subHeader'=>'Ticket Details',
            'ticket'=>$ticket,
            'ticketTypeName'=>$ticketTypeName,
            'ticketSubTypeName'=>$ticketSubTypeName,
            'commentsOfEmployee' => $commentsOfEmployee,
            'commentsOfClient' => $commentsOfClient,
        ];
        return view('ticket.show',$data);
    }

    public function getTypeName($id){
        $typeName = null;
        $type = DB::table('ticket_types')->find($id);
        if (isset($type)){
            $typeName = $type->title;
        }
        return $typeName;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }

    public function sendTelegramNotification($text)
    {
        $text = urlencode($text);
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
