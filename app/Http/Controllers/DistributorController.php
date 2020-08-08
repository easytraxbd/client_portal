<?php

namespace App\Http\Controllers;

use App\Distributor;
use App\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class DistributorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:client');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $payment1 = DB::table('payments')->where('client_id',$id)->whereNull('amount_final')->sum('amount');
        $payment2 = DB::table('payments')->where('client_id',$id)->whereNotNull('amount_final')->sum('amount_final');
        $totalPaymentAmount = $payment1 + $payment2;
        $totalInvoiceAmount = DB::table('sales_invoices')->where('is_recurring_setting', '!=', 1)->where('client_id',$id)->sum('invoice_total');
        $totalInvoiceDue = DB::table('sales_invoices')->where('is_recurring_setting', '!=', 1)->where('client_id',$id)->sum('invoice_total_due');
        $clientPassword = Auth::user()->password;
        if ( Hash::check('123456',$clientPassword)){
            return view('profile.change_password');
        }
        $balance = 0;
        $totalPaidAmount = $totalInvoiceAmount;
        if ($totalInvoiceAmount > $totalPaymentAmount){
            $totalPaidAmount = $totalPaymentAmount;
        }
        if ($totalInvoiceAmount<$totalPaymentAmount){
            $balance = $totalPaymentAmount-$totalInvoiceAmount;
        }
        $totalPaidPercentage = 0;
        $totalDuePercentage = 0;
        if (isset($totalInvoiceAmount) && isset($totalPaidAmount) && $totalPaidAmount>0){
            $totalPaidPercentage = ($totalInvoiceAmount/$totalPaidAmount)*100;
        }
        if (isset($totalInvoiceAmount) && isset($totalInvoiceDue) && $totalInvoiceDue>0){
            $totalDuePercentage = ($totalInvoiceAmount/$totalInvoiceDue)*100;
        }
        $data = [
            'title'=>"Dashboard",
            'totalPaymentAmount'=>$totalPaymentAmount,
            'totalInvoiceAmount'=>$totalInvoiceAmount,
            'totalPaidAmount'=>$totalPaidAmount,
            'totalPaidPercentage'=>$totalPaidPercentage,
            'balance'=>$balance,
            'totalDue'=>$totalInvoiceDue,
            'totalDuePercentage'=>$totalDuePercentage,
            'numberOfClients' => $this->numberOfClient(),
            'distributorMenu' => 1,
        ];
        return view('distributors.dashboard',$data);
    }

    public function getClientsIdArrayUnderDistributor($distributorId){
        return DB::table('clients')->where('referral_seller_client_id',$distributorId)->pluck('id');
    }

    public function numberOfClient(){
        $distributorId = Auth::user()->id;
        return DB::table('clients')->where('referral_seller_client_id',$distributorId)->count();
    }

    public function clientsInvoiceTotalAmount(Request $filter){

        $distributorId = Auth::user()->id;
        $clientsIdArray = $this->getClientsIdArrayUnderDistributor($distributorId);

        if ($filter->filled('start_date') && $filter->filled('end_date')) {
            $invoiceTotal = DB::table('sales_invoices')->whereBetween('date', [$filter->get("start_date"), $filter->get("end_date")])->where('is_recurring_setting', '!=', 1)->whereIn('client_id',$clientsIdArray)->sum('invoice_total');
        }
        else{
            $invoiceTotal = DB::table('sales_invoices')->where('is_recurring_setting', '!=', 1)->whereIn('client_id',$clientsIdArray)->sum('invoice_total');
        }
        return round($invoiceTotal);
    }

    public function clientsInvoiceDueAmount(Request $filter){
        $distributorId = Auth::user()->id;
        $clientsIdArray = $this->getClientsIdArrayUnderDistributor($distributorId);
        if ($filter->filled('start_date') && $filter->filled('end_date')) {
            $invoiceTotalDue = DB::table('sales_invoices')->whereBetween('date', [$filter->get("start_date"), $filter->get("end_date")])->where('is_recurring_setting', '!=', 1)->whereIn('client_id',$clientsIdArray)->sum('invoice_total_due');
        }
        else{
            $invoiceTotalDue = DB::table('sales_invoices')->where('is_recurring_setting', '!=', 1)->whereIn('client_id',$clientsIdArray)->sum('invoice_total_due');
        }
        return round($invoiceTotalDue);
    }

    public function clientsInvoicePaidAmount(Request $filter){
       $clientsInvoiceTotalAmount = $this->clientsInvoiceTotalAmount($filter);
        $clientsInvoiceDueAmount = $this->clientsInvoiceDueAmount($filter);
        $clientsInvoicePaidAmount = $clientsInvoiceTotalAmount - $clientsInvoiceDueAmount;
        return round($clientsInvoicePaidAmount);
    }

    public function getClientDataForDistributors()
    {
        $distributorId = Auth::user()->id;
        $clientsIdArray = $this->getClientsIdArrayUnderDistributor($distributorId);
        $clients = DB::table('clients')->whereIn('id',$clientsIdArray)->select('id','name','work_phone','alt_phone','home_address')->orderBy('id','desc');
        return Datatables::of($clients)
            ->escapeColumns([])
            ->addIndexColumn()
            ->editColumn('work_phone', function ($clients) {
                return '<a href="tel:+88'.$clients->work_phone.'">'.$clients->work_phone.'</a>';
            })
            ->editColumn('alt_phone', function ($clients) {
                return '<a href="tel:+88'.$clients->alt_phone.'">'.$clients->alt_phone.'</a>';
            })
            ->addColumn('payment_status', function ($clients) {
                $clientsDue = DB::table('sales_invoices')->where('client_id',$clients->id)->where('is_recurring_setting', '!=', 1)->sum('invoice_total_due');
                if($clientsDue > 0){
                    $a = '<span class="btn btn-bold btn-sm btn-font-sm  btn-label-danger">Unpaid</span><br><span class="kt-font-info kt-font-bold">৳ '.round($clientsDue).'</span>';
                }
                else{
                    $a = '<span class="btn btn-bold btn-sm btn-font-sm  btn-label-success">Paid</span>';
                }
                return $a;
            })

//            ->editColumn('date', function ($invoice) {
//                return Carbon::parse($invoice->date)->format('j M, Y g:i a');
//            })
//            ->editColumn('invoice_total', function ($invoice) {
//                return '<span class="kt-font-info kt-font-bold">৳ '.$invoice->invoice_total.'</span>';
//            })
//            ->editColumn('invoice_total_due', function ($invoice) {
//                if ($invoice->invoice_total_due > 0){
//                    return '<span class="kt-font-warning kt-font-bold">৳ '.$invoice->invoice_total_due.'</span>';
//                }
//                return '<span class="kt-font-success kt-font-bold">৳ '.$invoice->invoice_total_due.'</span>';
//            })
//
//            ->addColumn('action', function ($invoice) {
//                $a = '<div class="container text-center">';
//                if ($invoice->payment_status != 3){
//                    $a .= '<a href="https://crm.easytrax.com.bd/payment?clientId='.Auth::user()->id.'" target="_blank" title="Pay now" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="far fa-credit-card"></i></a>';
//                }
//                $a .= '<a href="' . url("invoice") . '/' . $invoice->id.'" title="View details" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="la la-eye"></i></a>';
//                $a .= '</div>';
//                return $a;
//            })

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function show(Distributor $distributor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function edit(Distributor $distributor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Distributor $distributor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Distributor $distributor)
    {
        //
    }

    public function clientsInvoice()
    {
        $data = [
            'title' => 'Clients Invoice',
            'subHeader'=>'invoice list',
             'distributorMenu' => 1,
        ];
        return view('distributors.clients_invoices',$data);
    }

    public function clientsPayment()
    {
        $data = [
            'title' => 'Clients payment',
            'subHeader'=>'payment list',
            'distributorMenu' => 1,
        ];
        return view('distributors.clients_payments',$data);
    }
    public function clientsTicket()
    {
        $data = [
            'title' => 'Clients ticket',
            'subHeader'=>'ticket list',
            'distributorMenu' => 1,
        ];
        return view('distributors.clients_tickets',$data);
    }
    public function clientsVehicles()
    {
        $data = [
            'title' => 'Clients Vehicle',
            'subHeader'=>'Vehicle list',
            'distributorMenu' => 1,
        ];
        return view('distributors.clients_vehicles',$data);
    }

    public function clientList()
    {
        $data = [
            'title' => 'Clients',
            'subHeader'=>'client list',
            'distributorMenu' => 1,
        ];
        return view('distributors.client_list',$data);
    }

}
