<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content', // au 'body' au 'message' kulingana na column ya homepage form yako
    ];

    /**
     * Mteja aliyeandika maoni haya
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}