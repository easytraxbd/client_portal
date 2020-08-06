<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class VehicleController extends Controller
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
            'title' => 'vehicle',
            'subHeader'=>'vehicle list'
        ];
        return view('vehicles.index',$data);
    }

    public function getData()
    {
        $id = Auth::user()->id;
        $vehicle = DB::table('vehicles')->where('client_id',$id)->select()->orderBy('id','desc');
        return Datatables::of($vehicle)
            ->escapeColumns([])
            ->addIndexColumn()
            ->editColumn('car_reg_date', function ($vehicle) {
                if (isset($vehicle->car_reg_date)){
                    return Carbon::parse($vehicle->car_reg_date)->format('j M, Y');
                }
                return "N/A";
            })
            ->editColumn('vehicle_type', function ($vehicle) {
                if (isset($vehicle->vehicle_type)){
                    return '<span class="kt-font-info kt-font-bold">'.ucfirst($vehicle->vehicle_type).'</span>';
                }
                return "N/A";
            })

            ->addColumn('action', function ($vehicle) {
                $a = '<div class="container text-center">';
                $a .= '<a href="' . url("vehicle") . '/' . $vehicle->id.'" title="View details" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="la la-eye"></i></a>';
                $a .= '</div>';
                return $a;
            })
            ->make();
    }

    public function getDataForDistributors()
    {
        $distributorId = Auth::user()->id;
        $clientsIdArray = DB::table('clients')->where('referral_seller_client_id',$distributorId)->pluck('id');
        $vehicle = DB::table('vehicles')->whereIn('client_id',$clientsIdArray)->select()->orderBy('id','desc');
        return Datatables::of($vehicle)
            ->escapeColumns([])
            ->addIndexColumn()
            ->editColumn('car_reg_date', function ($vehicle) {
                if (isset($vehicle->car_reg_date)){
                    return Carbon::parse($vehicle->car_reg_date)->format('j M, Y');
                }
                return "N/A";
            })
            ->editColumn('vehicle_type', function ($vehicle) {
                if (isset($vehicle->vehicle_type)){
                    return '<span class="kt-font-info kt-font-bold">'.ucfirst($vehicle->vehicle_type).'</span>';
                }
                return "N/A";
            })
            ->addColumn('client', function ($vehicle) {
                if (isset($vehicle->client_id) && $vehicle->client_id != null){
                    $clientName = DB::table('clients')->find($vehicle->client_id)->name;
                    $a = '<a href="#">'.$clientName.'</a>';
                }
                else{
                    $a = 'N/A';
                }
                return $a;
            })

            ->addColumn('action', function ($vehicle) {
                $a = '<div class="container text-center">';
                $a .= '<a href="' . url("vehicle") . '/' . $vehicle->id.'" title="View details" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="la la-eye"></i></a>';
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
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehicle = DB::table('vehicles')->find($id);

        $data = [
            'title' => 'vehicle',
            'subHeader'=>'vehicles Details',
            'vehicle'=>$vehicle,
        ];
        return view('vehicles.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehicle = DB::table('vehicles')->find($id);
        $data = [
            'vehicle' => $vehicle
        ];
        return view('vehicles.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $vehicle = DB::table('vehicles')->where('id',$request->id)->update([$request->all()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }
}
