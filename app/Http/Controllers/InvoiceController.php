<?php

namespace App\Http\Controllers;

use App\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class InvoiceController extends Controller
{
    public function __construct()
    {
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
            'title' => 'invoice',
            'subHeader'=>'invoice list'
        ];
        return view('invoices.index',$data);
    }

    public function getData()
    {
        $id = Auth::user()->id;
        $invoice = Invoice::where('client_id',$id)
//            ->where('invoice_type', 0)
            ->where('is_recurring_setting', '!=', 1)
              ->select()->orderBy('id','desc');
        return Datatables::of($invoice)
            ->escapeColumns([])
            ->addIndexColumn()
            ->editColumn('date', function ($invoice) {
                return Carbon::parse($invoice->date)->format('j M, Y g:i a');
            })
//            ->editColumn('payment_status', function ($invoice) {
//                return $this->payment_status_label($invoice->payment_status);
//            })
            ->editColumn('invoice_total', function ($invoice) {
                return '<span class="kt-font-info kt-font-bold">৳ '.$invoice->invoice_total.'</span>';
            })
            ->editColumn('invoice_total_due', function ($invoice) {
                if ($invoice->invoice_total_due > 0){
                    return '<span class="kt-font-warning kt-font-bold">৳ '.$invoice->invoice_total_due.'</span>';
                }
                return '<span class="kt-font-success kt-font-bold">৳ '.$invoice->invoice_total_due.'</span>';
            })

            ->editColumn('is_recurring', function ($invoice) {
                if($invoice->is_recurring == 1){
                    return '<span class="btn btn-bold btn-sm btn-font-sm  btn-label-success">Yes</span>';
                }
                return '<span class="btn btn-bold btn-sm btn-font-sm  btn-label-info">No</span>';
            })

            ->addColumn('action', function ($invoice) {
                $a = '<div class="container text-center">';
                if ($invoice->payment_status != 3){
                    $a .= '<a href="https://crm.easytrax.com.bd/payment?clientId='.Auth::user()->id.'" target="_blank" title="Pay now" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="far fa-credit-card"></i></a>';
                }
                $a .= '<a href="' . url("invoice") . '/' . $invoice->id.'" title="View details" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="la la-eye"></i></a>';
                $a .= '</div>';
                return $a;
            })
//
//
////            ->filter(function ($query) use ($request) {
////                if ($request->filled('payment_id')) {
////                    $query->where('id', $request->get('payment_id'));
////                }
////                if ($request->filled('bkash_payment_id')) {
////                    $query->where('bkash_payment_id', $request->get('bkash_payment_id'));
////                }
////                if ($request->filled('from_number')) {
////                    $query->where('from_number', $request->get('from_number'));
////                }
////                if ($request->filled('transaction_id')) {
////                    $query->where('transaction_id', $request->get('transaction_id'));
////                }
////                if ($request->filled('payment_gateway_source')) {
////                    $query->where('payment_gateway_source', $request->get('payment_gateway_source'));
////                }
////                if ($request->filled('db_entry_type')) {
////                    $query->where('db_entry_type', $request->get('db_entry_type'));
////                }
////                if ($request->filled('client_id')) {
////                    $query->where('client_id', $request->get('client_id'));
////                }
////                if ($request->filled('payment_collector_id')) {
////                    $query->where('payment_collector_id', $request->get('payment_collector_id'));
////                }
////                if ($request->filled('date_from')) {
////                    $query->where('payment_date', '>=', $request->get('date_from'));
////                }
////                if ($request->filled('date_to')) {
////                    $query->where('payment_date', '<=', $request->get('date_to'));
////                }
////                if ($request->filled('payment_method')) {
////                    $query->where('payment_method', $request->get('payment_method'));
////                }
////            })
            ->make();
    }

    public function payment_status_label($key)
    {
        if ($key == 1) {
            return '<span class="btn btn-bold btn-sm btn-font-sm  btn-label-danger">' . $this->payment_status()[$key] . '</span>';
        } elseif ($key == 2) {
            return '<span class="btn btn-bold btn-sm btn-font-sm  btn-label-warning">' . $this->payment_status()[$key] . '</span>';
        } elseif ($key == 3) {
            return '<span class="btn btn-bold btn-sm btn-font-sm  btn-label-success">' . $this->payment_status()[$key] . '</span>';
        } else {
            return '';
        }
    }

    public function payment_status()
    {
        return [
            1 => 'Unpaid',
            2 => 'Partial-Paid',
            3 => 'Paid'
        ];
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
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        $invoice->payment_status = $this->payment_status_label($invoice->payment_status);
        $invoiceDetails = DB::table('sales_invoice_details')->where('invoice_id',$invoice->id)->get()->toArray();
        $invoiceDetailsArray=[];
        foreach($invoiceDetails as $invoiceDetail){
            $invoiceDetailsArray[]=[
                'item' => DB::table('sales_items')->find($invoiceDetail->item_id),
            'quantity' => $invoiceDetail->quantity,
            'price' => $invoiceDetail->price,
            'discount' => $invoiceDetail->discount,
            'number_of_months' => $invoiceDetail->number_of_months,
            'vat_value' => $invoiceDetail->vat_value,
            ];
//            $bundle_ids = explode(",", $invoiceDetail->bundles);
//            $bundles = DB::table('bundles')->whereIn('id',$bundle_ids)->get();
        }

        $data = [
            'title' => 'invoice',
            'subHeader'=>'invoice Details',
            'invoice'=>$invoice,
            'invoiceDetailsArray'=>$invoiceDetailsArray,
        ];

        return view('invoices.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
