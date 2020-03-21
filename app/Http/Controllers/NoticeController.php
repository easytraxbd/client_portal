<?php

namespace App\Http\Controllers;

use App\Services\FaqService;
use App\Services\NoticeService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class NoticeController extends Controller
{
    protected $noticeService;
    public function __construct(NoticeService $noticeService)
    {
        $this->middleware('auth');
        $this->noticeService = $noticeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $noticeArray = $this->noticeService->noticeArray();

        $data = [
            'title' => 'Notice',
            'subHeader'=>'Notice Board',
            'noticeArray' => $noticeArray,
        ];
        return view('notices.index',$data);
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
