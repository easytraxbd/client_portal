<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PaymentController extends Controller
{
    protected $erpUrl = 'http://crm.easytrax.com.bd/';
    public function __construct()
    {
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
            'title' => 'payment',
            'subHeader'=>'payment list'
        ];
        return view('payments.index',$data);
    }

    public function getData()
    {
        $id = Auth::user()->id;
//        $payment = Payment::select()->where('user_id',$id)->orderBy('id', 'desc');
        $payment2 = DB::table('payment_drafts')->select()->where('client_id',$id)->get();
        foreach ($payment2 as $payment){
            $payment->status = 0;
        }

        $payment1 = DB::table('payments')->select()->where('client_id',$id)->get();
        foreach ($payment1 as $payment){
            $payment->status = 1;
        }

//        $payment = Payment::select()->where('client_id',$id);

        $payment = array_merge($payment1->toArray(),$payment2->toArray());
//        dd($payment);

        return Datatables::of($payment)
            ->escapeColumns([])
//            ->addIndexColumn()
            ->editColumn('payment_date', function ($payment) {
                if (isset($payment->payment_time)) {
                    return Carbon::parse($payment->payment_date . ' ' . $payment->payment_time)->toDayDateTimeString();
                } else {
                    return Carbon::parse($payment->payment_date . ' ' . Carbon::parse($payment->created_at)->toTimeString())->toDayDateTimeString();
                }
            })
            ->editColumn('status', function ($payment) {
                if ($payment->status == 1) {
                    return '<span class="btn btn-bold btn-sm btn-font-sm  btn-label-success">Approved</span>';
                }
                if ($payment->status == 0){
                    return '<span class="btn btn-bold btn-sm btn-font-sm  btn-label-warning">Pending</span>';
                }
            })
//            ->editColumn('amount', function ($payment) {
//                if (!isset($payment->amount_final) OR $payment->amount_final == null OR $payment->discount_amount == 0 OR $payment->discount_amount == null) {
//                    return $payment->amount;
//                } else {
//                    return '<span style="white-space: nowrap;">Final: ' . $payment->amount_final .
//                        '</span><br><span style="white-space: nowrap;">Source: ' . $payment->amount .
//                        '</span><br><span style="white-space: nowrap;">Discount Percentage: ' . $payment->discount_percentage .
//                        '%</span><br><span style="white-space: nowrap;">Discount Amount: ' . $payment->discount_amount .
//                        '</span>';
//                }
//            })
            ->editColumn('amount_final', function ($payment) {
                if (!isset($payment->amount_final) OR $payment->amount_final == null OR $payment->discount_amount == 0 OR $payment->discount_amount == null) {
                    return '<span class="kt-font-success kt-font-bold">৳ '.$payment->amount.'</span>';
                } else {
//                    return '<span style="white-space: nowrap;">Final: ' . $payment->amount_final .
//                        '</span><br><span style="white-space: nowrap;">Source: ' . $payment->amount .
//                        '</span><br><span style="white-space: nowrap;">Discount Percentage: ' . $payment->discount_percentage .
//                        '%</span><br><span style="white-space: nowrap;">Discount Amount: ' . $payment->discount_amount .
//                        '</span>';
                    return '<span class="kt-font-success kt-font-bold">৳ '.$payment->amount_final.'</span>';
                }
            })

            ->editColumn('invoice', function ($payment) {
                $invoicePayments = DB::table('sales_invoice_payments')->where('payment_id', $payment->id)
                    ->orderBy('id', 'ASC')->get();
                if ($invoicePayments->count() == 1) {
                    $invoicePayment = $invoicePayments[0];
                    if (!isset($invoicePayment->invoice_id) || $invoicePayment->invoice_id == 0 ||
                        $invoicePayment->invoice_id == null) {
                        return '<p>' . 'To Balance: Paid ' . $invoicePayment->paid_to_client_balance . 'Tk of ' .
                            $payment->amount . 'Tk</p>';
                    }
                    $thisInvoice = Invoice::find($invoicePayment->invoice_id);
                    if ($thisInvoice->invoice_total == $payment->amount) {
                        return '<p style="color: blue" data-toggle="tooltip" title="Solid Payment (1 Full Payment for only 1 Invoice)">' . 'To Invoice ' . $thisInvoice->invoice_no . ': Paid ' . $invoicePayment->paid_to_invoice . 'Tk of ' . $payment->amount . 'Tk</p>';
                    } else {
                        return '<p>' . 'To Invoice ' . $thisInvoice->invoice_no . ': Paid ' . $invoicePayment->paid_to_invoice . 'Tk of ' . $payment->amount . 'Tk</p>';
                    }
                } else {
                    $string = '';
                    foreach ($invoicePayments as $invoicePayment) {
                        $thisInvoice = Invoice::find($invoicePayment->invoice_id);
                        if ($thisInvoice) {
                            $string .= '<p>' . 'To Invoice ' . $thisInvoice->invoice_no . ': Paid ' .
                                $invoicePayment->paid_to_invoice . 'Tk of ' . $payment->amount . 'Tk</p>';
                        } else {
//                            dd($invoicePayment);
                            $string .= '<p>' . 'To Balance: Paid ' . $invoicePayment->paid_to_client_balance . 'Tk of ' . $payment->amount . 'Tk</p>';
                        }
                    }
                    return $string;
                }
            })
            ->editColumn('payment_method_in_detail', function ($payment) {
                return $this->getDetailedPaymentGatewayInfoWithPic($payment, $br = true);
            })
            ->editColumn('payment_method', function ($payment) {
                if (isset($payment->payment_method)){
                    $payment_method = DB::table('coa')->find($payment->payment_method);
                    return $payment_method->coa_name;
                }
                return 'N/A';
            })
            ->editColumn('payment_collector', function ($payment) {
                $collector = '';
                if (isset($payment->payment_collector_id) && $payment->payment_collector_id != null) {
                    $employee = DB::table('employees')->find($payment->payment_collector_id);
                    $fName= $employee->first_name ?? '';
                    $lName=$employee->last_name ?? '';
                    $collector = $fName.' '.$lName;
                }
                return $collector;
            })
            ->editColumn('payment_time', function ($payment) {
                return $payment->payment_time;
            })
            ->editColumn('amount', function ($payment) {
                return '<span class="kt-font-success kt-font-bold">৳ '.$payment->amount.'</span>';
            })
            ->editColumn('discount_amount', function ($payment) {
                if (isset($payment->discount_amount)){
                    return '<span class="kt-font-success kt-font-bold">৳ '.$payment->discount_amount.'</span>';
                }
                return "N/A";
            })
            ->addColumn('action', function ($payment) {
                $a = '<div class="container text-center">';
                if ($payment->status == 1){
                    $a .= '<a href="' . url("payment") . '/' . $payment->id.'" title="View details" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="la la-eye"></i></a>';
                }
                if ($payment->status == 0){
                    $a .= '<a href="' . url("payment-draft") . '/' . $payment->id.'" title="View details" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="la la-eye"></i></a>';
                }
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

        $payment2 = DB::table('payment_drafts')->select()->whereIn('client_id',$clientsIdArray);
        if ($request->filled('date_from') && $request->filled('date_to')) {
            $payment2->whereBetween('payment_date', [$request->get('date_from'),$request->get('date_to')]);
        }
        $payment2 = $payment2->get();
        foreach ($payment2 as $payment){
            $payment->status = 0;
        }

        $payment1 = DB::table('payments')->select()->whereIn('client_id',$clientsIdArray);
        if ($request->filled('date_from') && $request->filled('date_to')) {
            $payment1->whereBetween('payment_date', [$request->get('date_from'),$request->get('date_to')]);
        }
          $payment1 = $payment1->get();
        foreach ($payment1 as $payment){
            $payment->status = 1;
        }

//        $payment = Payment::select()->where('client_id',$id);

        $payment = array_merge($payment1->toArray(),$payment2->toArray());
//        dd($payment);

        return Datatables::of($payment)
            ->escapeColumns([])
//            ->addIndexColumn()
            ->editColumn('payment_date', function ($payment) {
                if (isset($payment->payment_time)) {
                    return Carbon::parse($payment->payment_date . ' ' . $payment->payment_time)->toDayDateTimeString();
                } else {
                    return Carbon::parse($payment->payment_date . ' ' . Carbon::parse($payment->created_at)->toTimeString())->toDayDateTimeString();
                }
            })
            ->editColumn('status', function ($payment) {
                if ($payment->status == 1) {
                    return '<span class="btn btn-bold btn-sm btn-font-sm  btn-label-success">Approved</span>';
                }
                if ($payment->status == 0){
                    return '<span class="btn btn-bold btn-sm btn-font-sm  btn-label-warning">Pending</span>';
                }
            })
//            ->editColumn('amount', function ($payment) {
//                if (!isset($payment->amount_final) OR $payment->amount_final == null OR $payment->discount_amount == 0 OR $payment->discount_amount == null) {
//                    return $payment->amount;
//                } else {
//                    return '<span style="white-space: nowrap;">Final: ' . $payment->amount_final .
//                        '</span><br><span style="white-space: nowrap;">Source: ' . $payment->amount .
//                        '</span><br><span style="white-space: nowrap;">Discount Percentage: ' . $payment->discount_percentage .
//                        '%</span><br><span style="white-space: nowrap;">Discount Amount: ' . $payment->discount_amount .
//                        '</span>';
//                }
//            })
            ->editColumn('amount_final', function ($payment) {
                if (!isset($payment->amount_final) OR $payment->amount_final == null OR $payment->discount_amount == 0 OR $payment->discount_amount == null) {
                    return '<span class="kt-font-success kt-font-bold">৳ '.$payment->amount.'</span>';
                } else {
//                    return '<span style="white-space: nowrap;">Final: ' . $payment->amount_final .
//                        '</span><br><span style="white-space: nowrap;">Source: ' . $payment->amount .
//                        '</span><br><span style="white-space: nowrap;">Discount Percentage: ' . $payment->discount_percentage .
//                        '%</span><br><span style="white-space: nowrap;">Discount Amount: ' . $payment->discount_amount .
//                        '</span>';
                    return '<span class="kt-font-success kt-font-bold">৳ '.$payment->amount_final.'</span>';
                }
            })

            ->editColumn('invoice', function ($payment) {
                $invoicePayments = DB::table('sales_invoice_payments')->where('payment_id', $payment->id)
                    ->orderBy('id', 'ASC')->get();
                if ($invoicePayments->count() == 1) {
                    $invoicePayment = $invoicePayments[0];
                    if (!isset($invoicePayment->invoice_id) || $invoicePayment->invoice_id == 0 ||
                        $invoicePayment->invoice_id == null) {
                        return '<p>' . 'To Balance: Paid ' . $invoicePayment->paid_to_client_balance . 'Tk of ' .
                            $payment->amount . 'Tk</p>';
                    }
                    $thisInvoice = Invoice::find($invoicePayment->invoice_id);
                    if ($thisInvoice->invoice_total == $payment->amount) {
                        return '<p style="color: blue" data-toggle="tooltip" title="Solid Payment (1 Full Payment for only 1 Invoice)">' . 'To Invoice ' . $thisInvoice->invoice_no . ': Paid ' . $invoicePayment->paid_to_invoice . 'Tk of ' . $payment->amount . 'Tk</p>';
                    } else {
                        return '<p>' . 'To Invoice ' . $thisInvoice->invoice_no . ': Paid ' . $invoicePayment->paid_to_invoice . 'Tk of ' . $payment->amount . 'Tk</p>';
                    }
                } else {
                    $string = '';
                    foreach ($invoicePayments as $invoicePayment) {
                        $thisInvoice = Invoice::find($invoicePayment->invoice_id);
                        if ($thisInvoice) {
                            $string .= '<p>' . 'To Invoice ' . $thisInvoice->invoice_no . ': Paid ' .
                                $invoicePayment->paid_to_invoice . 'Tk of ' . $payment->amount . 'Tk</p>';
                        } else {
//                            dd($invoicePayment);
                            $string .= '<p>' . 'To Balance: Paid ' . $invoicePayment->paid_to_client_balance . 'Tk of ' . $payment->amount . 'Tk</p>';
                        }
                    }
                    return $string;
                }
            })
            ->editColumn('payment_method_in_detail', function ($payment) {
                return $this->getDetailedPaymentGatewayInfoWithPic($payment, $br = true);
            })
            ->editColumn('payment_method', function ($payment) {
                if (isset($payment->payment_method)){
                    $payment_method = DB::table('coa')->find($payment->payment_method);
                    return $payment_method->coa_name;
                }
                return 'N/A';
            })
            ->editColumn('payment_collector', function ($payment) {
                $collector = '';
                if (isset($payment->payment_collector_id) && $payment->payment_collector_id != null) {
                    $employee = DB::table('employees')->find($payment->payment_collector_id);
                    $fName= $employee->first_name ?? '';
                    $lName=$employee->last_name ?? '';
                    $collector = $fName.' '.$lName;
                }
                return $collector;
            })
            ->editColumn('payment_time', function ($payment) {
                return $payment->payment_time;
            })
            ->editColumn('amount', function ($payment) {
                return '<span class="kt-font-success kt-font-bold">৳ '.$payment->amount.'</span>';
            })
            ->editColumn('discount_amount', function ($payment) {
                if (isset($payment->discount_amount)){
                    return '<span class="kt-font-success kt-font-bold">৳ '.$payment->discount_amount.'</span>';
                }
                return "N/A";
            })
            ->addColumn('client', function ($payment) {
                if (isset($payment->client_id) && $payment->client_id != null){
                    $clientName = DB::table('clients')->find($payment->client_id)->name;
                    $a = '<a href="/clients/'.$payment->client_id.'">'.$clientName.'</a>';
                }
              else{
                  $a = 'N/A';
              }
                return $a;
            })
            ->addColumn('action', function ($payment) {
                $a = '<div class="container text-center">';
                if ($payment->status == 1){
                    $a .= '<a href="' . url("payment") . '/' . $payment->id.'" title="View details" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="la la-eye"></i></a>';
                }
                if ($payment->status == 0){
                    $a .= '<a href="' . url("payment-draft") . '/' . $payment->id.'" title="View details" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="la la-eye"></i></a>';
                }
                $a .= '</div>';
                return $a;
            })
            ->make();
    }

    public function draftPayment()
    {
        $data = [
            'title' => 'draft payment',
            'subHeader' => 'draft payment list'
        ];
        return view('payments.payment_draft',$data);
    }
    public function getDraftPaymentData()
    {
        $id = Auth::user()->id;
        $payment = DB::table('payment_drafts')->select()->where('client_id',$id);
        return Datatables::of($payment)
            ->escapeColumns([])
            ->addIndexColumn()
            ->editColumn('payment_date', function ($payment) {
                if (isset($payment->payment_time)) {
                    return Carbon::parse($payment->payment_date . ' ' . $payment->payment_time)->toDayDateTimeString();
                } else {
                    return Carbon::parse($payment->payment_date . ' ' . Carbon::parse($payment->created_at)->toTimeString())->toDayDateTimeString();
                }
            })
            ->editColumn('amount', function ($payment) {
                if (!isset($payment->amount_final) OR $payment->amount_final == null OR $payment->discount_amount == 0 OR $payment->discount_amount == null) {
                    return $payment->amount;
                } else {
                    return '<span style="white-space: nowrap;">Final: ' . $payment->amount_final .
                        '</span><br><span style="white-space: nowrap;">Source: ' . $payment->amount .
                        '</span><br><span style="white-space: nowrap;">Discount Percentage: ' . $payment->discount_percentage .
                        '%</span><br><span style="white-space: nowrap;">Discount Amount: ' . $payment->discount_amount .
                        '</span>';
                }
            })
            ->editColumn('invoice', function ($payment) {
                $invoicePayments = DB::table('sales_invoice_payments')->where('payment_id', $payment->id)
                    ->orderBy('id', 'ASC')->get();
                if ($invoicePayments->count() == 1) {
                    $invoicePayment = $invoicePayments[0];
                    if (!isset($invoicePayment->invoice_id) || $invoicePayment->invoice_id == 0 ||
                        $invoicePayment->invoice_id == null) {
                        return '<p>' . 'To Balance: Paid ' . $invoicePayment->paid_to_client_balance . 'Tk of ' .
                            $payment->amount . 'Tk</p>';
                    }
                    $thisInvoice = Invoice::find($invoicePayment->invoice_id);
                    if ($thisInvoice->invoice_total == $payment->amount) {
                        return '<p style="color: blue" data-toggle="tooltip" title="Solid Payment (1 Full Payment for only 1 Invoice)">' . 'To Invoice ' . $thisInvoice->invoice_no . ': Paid ' . $invoicePayment->paid_to_invoice . 'Tk of ' . $payment->amount . 'Tk</p>';
                    } else {
                        return '<p>' . 'To Invoice ' . $thisInvoice->invoice_no . ': Paid ' . $invoicePayment->paid_to_invoice . 'Tk of ' . $payment->amount . 'Tk</p>';
                    }
                } else {
                    $string = '';
                    foreach ($invoicePayments as $invoicePayment) {
                        $thisInvoice = Invoice::find($invoicePayment->invoice_id);
                        if ($thisInvoice) {
                            $string .= '<p>' . 'To Invoice ' . $thisInvoice->invoice_no . ': Paid ' .
                                $invoicePayment->paid_to_invoice . 'Tk of ' . $payment->amount . 'Tk</p>';
                        } else {
//                            dd($invoicePayment);
                            $string .= '<p>' . 'To Balance: Paid ' . $invoicePayment->paid_to_client_balance . 'Tk of ' . $payment->amount . 'Tk</p>';
                        }
                    }
                    return $string;
                }
            })
            ->editColumn('payment_method_in_detail', function ($payment) {
                return $this->getDetailedPaymentGatewayInfoWithPic($payment, $br = true);
            })
            ->editColumn('payment_method', function ($payment) {
                if (isset($payment->payment_method)){
                    $payment_method = DB::table('coa')->find($payment->payment_method);
                    return $payment_method->coa_name;
                }
                return 'N/A';
            })
            ->editColumn('payment_collector', function ($payment) {
                $collector = '';
                if (isset($payment->payment_collector_id)) {
                    $employee = DB::table('employees')->find($payment->payment_collector_id);
                    $collector = $employee->first_name.' '.$employee->last_name;
                }
                return $collector;
            })
            ->editColumn('payment_time', function ($payment) {
                return $payment->payment_time;
            })
            ->editColumn('amount', function ($payment) {
                return '<span class="kt-font-success kt-font-bold">৳ '.$payment->amount.'</span>';
            })
            ->addColumn('action', function ($payment) {
                $a = '<div class="container text-center">';
                $a .= '<a href="' . url("payment-draft") . '/' . $payment->id.'" title="View details" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="la la-eye"></i></a>';
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

    public function getDetailedPaymentGatewayInfoWithPic($paymentObject, $br = false)
    {
        $payment = $paymentObject;
        $br = $br == true ? '<br>' : '';
        $textCenter = $br == true ? 'text-center' : '';

        if ($payment->payment_method) {
            $payment_method = DB::table('coa')->find($payment->payment_method);
            $return = $payment_method->coa_code . ' - ' . $payment_method->coa_name;
            $return .= '<div class="' . $textCenter . '">';
            if (isset($payment_method->coa_image_url) && $payment_method->coa_image_url != null) {
                $return .= $br . '<img style="height: 40px" src="' .$this->erpUrl.$payment_method->coa_image_url . '">';
            }
            $return .= '</div>';
            return $return;
        } else {
            return '';
        }
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
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        $payment->payment_date = Carbon::parse($payment->payment_date)->format('j M, Y');
        if (isset($payment->amount_final)){$payment->total_amount = $payment->amount_final;}
        else{$payment->total_amount = $payment->amount;}

        if (isset($payment->payment_method)){
            $payment_method = DB::table('coa')->find($payment->payment_method);
            $payment->payment_method = $payment_method->coa_name;
        }
        $invoicePayments = DB::table('sales_invoice_payments')->where('payment_id', $payment->id)->whereNotNull('invoice_id')
            ->orderBy('id', 'ASC')->get();
        $invoiceArray = [];
        foreach ($invoicePayments as $invoicePayment) {
            $invoice = Invoice::find($invoicePayment->invoice_id);
            $invoice->paid_to_invoice = $invoicePayment->paid_to_invoice;
            $invoiceArray[] = $invoice;
        }
        $data = [
            'title' => 'payment',
            'subHeader'=>'payment details',
            'payment'=> $payment,
            'invoiceArray'=> $invoiceArray,
        ];
        return view('payments.show',$data);
    }

    public function showPaymentDraft($id)
    {
        $payment = DB::table('payment_drafts')->find($id);
        $payment->payment_date = Carbon::parse($payment->payment_date)->format('j M, Y');
        if (isset($payment->amount_final)){$payment->total_amount = $payment->amount_final;}
        else{$payment->total_amount = $payment->amount;}

        if (isset($payment->payment_method)){
            $payment_method = DB::table('coa')->find($payment->payment_method);
            $payment->payment_method = $payment_method->coa_name;
        }
        $invoicePayments = DB::table('sales_invoice_payments')->where('payment_id', $payment->id)
            ->orderBy('id', 'ASC')->get();
        $invoiceArray = [];
        foreach ($invoicePayments as $invoicePayment) {
            $invoice = Invoice::find($invoicePayment->invoice_id);
            $invoice->paid_to_invoice = $invoicePayment->paid_to_invoice;
            $invoiceArray[] = $invoice;
        }

        $data = [
            'title' => 'Draft payment',
            'subHeader'=>'Draft payment details',
            'payment'=> $payment,
            'invoiceArray'=> $invoiceArray,
        ];
        return view('payments.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
