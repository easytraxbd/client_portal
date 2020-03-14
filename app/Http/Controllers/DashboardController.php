<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Services\FaqService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    protected $faqService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(FaqService $faqService)
    {
        $this->middleware('auth:client');
        $this->faqService = $faqService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
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
            'faqArray' => $this->faqService->faqArray(9),
        ];
        return view('dashboard',$data);
    }
}
