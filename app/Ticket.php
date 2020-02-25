<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $guarded = ['id'];

    public function getStatusAttribute()
    {
        if ($this->attributes['status'] == 2) {
            return '<span class="btn btn-bold btn-sm btn-font-sm  btn-label-warning">On Hold</span>';
        } elseif ($this->attributes['status'] == 1) {
            return '<span class="btn btn-bold btn-sm btn-font-sm  btn-label-danger">Open</span>';
        } elseif ($this->attributes['status'] == 5) {
            return '<span class="btn btn-bold btn-sm btn-font-sm  btn-label-success">Resolved</span>';
        } elseif ($this->attributes['status'] == 3) {
            return '<span class="btn btn-bold btn-sm btn-font-sm  btn-label-warning">Awaiting Reply</span>';
        } elseif ($this->attributes['status'] == 4) {
            return '<span class="btn btn-bold btn-sm btn-font-sm  btn-label-warning">Escalated</span>';
        } else {
            return '<span class="btn btn-bold btn-sm btn-font-sm  btn-label-info">N/A</span>';
        }
    }
    public function getPriorityAttribute()
    {
        if ($this->attributes['priority'] == 1) {
            return '<span class="btn btn-bold btn-sm btn-font-sm  btn-label-danger">High</span>';
        } elseif ($this->attributes['priority'] == 2) {
            return '<span class="btn btn-bold btn-sm btn-font-sm  btn-label-warning">Medium</span>';
        } elseif ($this->attributes['priority'] == 3) {
            return '<span class="btn btn-bold btn-sm btn-font-sm  btn-label-info">Low</span>';
        } else {
            return '<span class="btn btn-bold btn-sm btn-font-sm  btn-label-info">N/A</span>';
        }
    }
    public function getCallTypeAttribute()
    {
        if ($this->attributes['call_type'] == 1) {
            return '<span class="kt-badge kt-badge--info kt-badge--inline kt-badge--pill">Query</span>';
        }
        elseif ($this->attributes['call_type'] == 2) {
            return '<span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill">Request</span>';
        }
        elseif ($this->attributes['call_type'] == 3) {
            return '<span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill">Complaint</span>';
        }
        else {
            return '<span class="kt-badge kt-badge--info kt-badge--inline kt-badge--pill">N/A</span>';
        }
    }
}
