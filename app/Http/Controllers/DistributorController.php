<?php

namespace App\Http\Controllers;

use App\Distributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        ];
        return view('distributors.dashboard',$data);
    }

    public function getClientsUnderDistributor($id,Request $filter){
        DB::table('clients')->where('referral_seller_client_id',$id);
    }

    public function chart(){

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
}
