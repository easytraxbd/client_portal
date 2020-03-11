<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class OfferController extends Controller
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
            'title' => 'Offer',
            'subHeader'=>'Offer list'
        ];
        return view('offers.index',$data);
    }

    public function getData()
    {
        $id = Auth::user()->id;
        $offer = DB::table('offers')->where('client_id',$id)->select()->orderBy('id','desc');
        return Datatables::of($offer)
            ->escapeColumns([])
            ->addIndexColumn()
            ->addColumn('discount', function ($vehicle) {
                if (isset($vehicle->discount_type) && $vehicle->discount_type == 'percentage'){
                    return $vehicle->discount_value."%";
                }
                return $vehicle->discount_value." ".$vehicle->discount_value_currency;
            })
            ->addColumn('validity', function ($vehicle) {
//             if (isset($vehicle->valid_until) && Carbon::parse($vehicle->valid_until) > Carbon::now()){
//
//             }
                if (isset($vehicle->valid_until)){
                    return Carbon::parse($vehicle->valid_until)->format('j M, Y g:i a');
                }
                return "";
            })
            ->editColumn('active', function ($vehicle) {
                if ($vehicle->active == 1){
                    return '<span class="btn btn-bold btn-sm btn-font-sm  btn-label-success">Yes</span>';
                }
                return '<span class="btn btn-bold btn-sm btn-font-sm  btn-label-danger">No</span>';
            })
            ->editColumn('is_used', function ($vehicle) {
                if ($vehicle->is_used == 1){
                    return '<span class="btn btn-bold btn-sm btn-font-sm  btn-label-success">Yes</span>';
                }
                return '<span class="btn btn-bold btn-sm btn-font-sm  btn-label-info">No</span>';
            })

            ->addColumn('action', function ($offer) {
                $a = '<div class="container text-center">';
                $a .= '<a href="' . url("offer") . '/' . $offer->id.'" title="View details" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="la la-eye"></i></a>';
                $a .= '</div>';
                return $a;
            })
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
     * @param  \App\Invoice  $offer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $offer = DB::table('offers')->find($id);
dd($offer);
        $data = [
            'title' => 'offer',
            'subHeader'=>'offers Details',
            'offer'=>$offer,
        ];
        return view('offers.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $offer
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $offer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $offer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $offer)
    {
        //
    }
}
