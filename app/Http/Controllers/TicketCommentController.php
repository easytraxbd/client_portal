<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\TicketComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketCommentController extends Controller
{
    public function store(Request $request)
    {
        // validate the uploaded file
        $request->validate([
            'comment' => 'required|string',
            'ticket_id' => 'required'
        ]);
        $data = $request->all();
        $data['comment_for'] = 2;
        $data['client_id'] = Auth::user()->id;
        $clientIdOfTicket = Ticket::find($request->ticket_id)->client_id;
        if ($clientIdOfTicket != Auth::user()->id){
            return redirect()->back()->with('error','Something went wrong');
        }
        if (TicketComment::create($data)){
            return redirect()->back()->with('success','Comment created successfully');
        }
        return redirect()->back()->with('error','Something went wrong');
    }
}
