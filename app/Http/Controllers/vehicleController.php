<?php
//
//namespace App\Http\Controllers;
//
//use App\Invoice;
//use Carbon\Carbon;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\DB;
//use Yajra\DataTables\DataTables;
//
//class vehicleController extends Controller
//{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }
//    /**
//     * Display a listing of the resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function index()
//    {
//        $data = [
//            'title' => 'invoice',
//            'subHeader'=>'invoice list'
//        ];
//        return view('vehicles.index',$data);
//    }
//
//    public function getData()
//    {
//        $id = Auth::user()->id;
//        $vehicles = DB::table()->where('client_id',$id)
////            ->where('invoice_type', 0)
//            ->where('is_recurring_setting', '!=', 1)
//              ->select()->orderBy('id','desc');
//        return Datatables::of($invoice)
//            ->escapeColumns([])
//            ->addIndexColumn()
//            ->editColumn('date', function ($invoice) {
//                return Carbon::parse($invoice->date)->format('j M, Y g:i a');
//            })
//            ->editColumn('payment_status', function ($invoice) {
//                return $this->payment_status_label($invoice->payment_status);
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
//            ->editColumn('is_recurring', function ($invoice) {
//                if($invoice->is_recurring == 1){
//                    return '<span class="btn btn-bold btn-sm btn-font-sm  btn-label-success">Yes</span>';
//                }
//                return '<span class="btn btn-bold btn-sm btn-font-sm  btn-label-info">No</span>';
//            })
//
//            ->addColumn('action', function ($invoice) {
//                $a = '<div class="container text-center">';
//                $a .= '<a href="' . url("vehicle") . '/' . $invoice->id.'" title="View details" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="la la-eye"></i></a>';
//                $a .= '</div>';
//                return $a;
//            })
//            ->make();
//    }
//
//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function create()
//    {
//        //
//    }
//
//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */
//    public function store(Request $request)
//    {
//        //
//    }
//
//    /**
//     * Display the specified resource.
//     *
//     * @param  \App\Invoice  $invoice
//     * @return \Illuminate\Http\Response
//     */
//    public function show($id)
//    {
//        $vehicle = DB::table('vehicles')->find($id);
//
//        $data = [
//            'title' => 'vehicle',
//            'subHeader'=>'vehicles Details',
//            'vehicle'=>$vehicle,
//        ];
//        return view('vehicles.show',$data);
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  \App\Invoice  $invoice
//     * @return \Illuminate\Http\Response
//     */
//    public function edit(Invoice $invoice)
//    {
//        //
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  \App\Invoice  $invoice
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, Invoice $invoice)
//    {
//        //
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  \App\Invoice  $invoice
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy(Invoice $invoice)
//    {
//        //
//    }
//}
