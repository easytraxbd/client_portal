<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketComment extends Model
{
    protected $guarded = ['id'];
    // relation with client
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    // relation with user
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
