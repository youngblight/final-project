<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_request_id',
        'amount',
        'payment_method',
        'transaction_id',
        'status',
    ];

    /**
     * Uhusiano: Malipo haya ni ya Job Request gani? 
     */
    public function jobRequest()
    {
        return $this->belongsTo(JobRequest::class);
    }
}
