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
        $notice = DB::table('notices')->where('status',1)->orderByRaw('published_at DESC')->get();
        $data = [
            'title' => 'Notice',
            'subHeader'=>'Notice Board',
            'noticeArray' => $notice,
        ];
        return view('notices.index',$data);
    }

    //old
//    public function index()
//    {
//        $noticeArray = $this->noticeService->noticeArray();
//
//        $data = [
//            'title' => 'Notice',
//            'subHeader'=>'Notice Board',
//            'noticeArray' => $noticeArray,
//        ];
//        return view('notices.index',$data);
//    }

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
        $notice = DB::table('notices')->find($id);
        $data = [
            'title' => 'Notice',
            'subHeader'=>'Notice Details',
            'notice'=> $notice,
        ];
        return view('notices.show',$data);
    }

    //old
//    public function show($id)
//    {
//        $notice =$this->noticeService->noticeArray($id,null);
//        $data = [
//            'title' => 'Notice',
//            'subHeader'=>'Notice Details',
//            'notice'=> $notice,
//        ];
//        return view('notices.show',$data);
//    }

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
