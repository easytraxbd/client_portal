<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    protected $table = 'clients';
    protected $guarded = ['id'];
}
