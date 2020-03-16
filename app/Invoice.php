<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'sales_invoices';
    protected $guarded = ['id'];
    protected $appends = ['status'];

    public function getStatusAttribute()
    {
        if ($this->attributes['payment_status'] == 2) {
            return '<span class="btn btn-bold btn-sm btn-font-sm  btn-label-warning">Partial-Paid</span>';
        } elseif ($this->attributes['payment_status'] == 1) {
            return '<span class="btn btn-bold btn-sm btn-font-sm  btn-label-danger">Unpaid</span>';
        } elseif ($this->attributes['payment_status'] == 3) {
            return '<span class="btn btn-bold btn-sm btn-font-sm  btn-label-success">Paid</span>';
        } else {
            return '<span class="btn btn-bold btn-sm btn-font-sm  btn-label-info">N/A</span>';
        }
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

}
