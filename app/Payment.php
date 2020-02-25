<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = ['id'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function paymentMethodCOA()
    {
        return $this->belongsTo(Coa::class, 'payment_method');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function invoice()
    {
        return $this->belongsToMany(Invoice::class, 'users','payment_id');
    }

}
