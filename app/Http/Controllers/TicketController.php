<?php

namespace App\Http\Controllers;

use App\Services\TelegramService;
use App\Services\TicketService;
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
    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
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
            'title' => 'Service Requests',
            'subHeader'=>'Service Requests list'
        ];
        return view('tickets.index',$data);
    }

    public function getData()
    {
        $id = Auth::user()->id;
        $ticket = Ticket::select()->where('client_id',$id)->orderBy('id','desc');
        return Datatables::of($ticket)
            ->escapeColumns([])
            ->addIndexColumn()
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

    public function getDataForDistributors(Request $request)
    {
        $distributorId = Auth::user()->id;
        $clientsIdArray = DB::table('clients')->where('referral_seller_client_id',$distributorId)->pluck('id');
        if ($request->filled('client_id')){
            if (in_array($request->client_id,$clientsIdArray->toArray())) {
                $clientsIdArray = [$request->client_id];
            }
        }
        $ticket = Ticket::select()->whereIn('client_id',$clientsIdArray)->orderBy('id','desc');
        return Datatables::of($ticket)
            ->escapeColumns([])
            ->addIndexColumn()
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
            ->addColumn('client', function ($ticket) {
                if (isset($ticket->client_id) && $ticket->client_id != null){
                    $clientName = DB::table('clients')->find($ticket->client_id)->name;
                    $a = '<a href="#">'.$clientName.'</a>';
                }
                else{
                    $a = 'N/A';
                }
                return $a;
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
        $ticketTypes = DB::table('ticket_types')->where('parent_id',0)->pluck('title','id')->toArray();
        $data = [
            'title' => 'Service Requests',
            'subHeader'=>'Service Requests Creation',
            'ticketTypes'=> $ticketTypes,
        ];
        return view('tickets.create',$data);
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
        $data['client_id'] = Auth::user()->id;
        $data['ticket_complain_source_id'] = 35;
        $data['date'] = Carbon::now();
        $ticket = Ticket::create($data);
        if (isset($ticket->id)){
$message = 'A new Ticket "'.$data["title"].'" has been generated by Customer -'.Auth::user()->name.' from My Easytrax.

Client Name : '.Auth::user()->name.'.
User ID : '.Auth::user()->id.'
Customer Category : '.Auth::user()->category.'
Contact No : '.Auth::user()->work_phone.'
Email : '.Auth::user()->email.'

Ticket ID: '.$ticket->id.'
Ticket Type: '.DB::table('ticket_types')->find( $data['ticket_type_id'])->title.'
Ticket Status: Open
Ticket Creation Date & Time : '.Carbon::parse($ticket->created_at)->toDayDateTimeString().'
Ticket Details : '.$data["description"].'

Ticket Link: https://crm.easytrax.com.bd/tickets/'.$ticket->id;

            $this->ticketService->sendTelegramNotification($message);
            return redirect('ticket')->with('success','Service Requests created successfully');
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
        $id = Auth::user()->id;
        if ($ticket->client_id != $id && Auth::user()->category != 'distributor'){
            return "Permission Denied";
        }
        $assigned_user_name = null;
        if (isset($ticket->assigned_user_id)){
            $assigned_user = DB::table('users')->find($ticket->assigned_user_id);
            $firstName = $assigned_user->first_name ?? '';
            $lastName = $assigned_user->last_name ?? '';
            $assigned_user_name = $firstName .' '.$lastName;
        }
        $vehicles = null;
        if (isset($ticket->other_data) && $ticket->other_data != '' && $ticket->other_data != []){
            if(isset($ticket->other_data['vehicles']) && $ticket->other_data['vehicles'] != []){
                $vehicles = '';
                foreach ($ticket->other_data['vehicles'] as $vehicleID){
                    $vehicle = DB::table('vehicles')->find($vehicleID);
                    $vehicles .= $vehicle->car_reg_number."(".$vehicle->car_model.")";
                }
            }
        }
        $ticket_complain_source = null;
        if (isset($ticket->ticket_complain_source_id)){
            $ticket_complain_source = DB::table('ticket_complain_sources')->find($ticket->ticket_complain_source_id)->source_complain_title;
        }
        $ticketTypeName = $this->getTypeName($ticket->ticket_type_id);
        $ticketSubTypeName = $this->getTypeName($ticket->ticket_sub_type_id);
        $commentsOfEmployee = TicketComment::with('user')->where('ticket_id',$ticket->id)->where('comment_for',2)->whereNull('client_id')->get();
        $commentsOfClient = TicketComment::with('client')->where('ticket_id',$ticket->id)->where('comment_for',2)->whereNotNull('client_id')->get();
        $data = [
            'title' => 'Service Requests',
            'subHeader'=>'Service Requests Details',
            'ticket'=>$ticket,
            'ticketTypeName'=>$ticketTypeName,
            'ticketSubTypeName'=>$ticketSubTypeName,
            'commentsOfEmployee' => $commentsOfEmployee,
            'commentsOfClient' => $commentsOfClient,
            'assigned_user_name' => $assigned_user_name,
            'vehicles' => $vehicles,
            'ticket_complain_source' => $ticket_complain_source,
        ];
        if ($ticket->client_id == $id){
            return view('tickets.show',$data);
        }
        return view('tickets.distributor_show',$data);
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

}
