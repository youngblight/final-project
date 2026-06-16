<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobRequest extends Model
{
    use HasFactory;

    /**
     * Data zinazoruhusiwa kuingizwa kwa mkupuo (Mass Assignment).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'craftsman_id',
        'customer_name',
        'customer_phone',
        'location',
        'job_description',
        'status',
        'fundi_response',
        'agreed_price',
        'rating',
        'comment',
    ];

    /**
     * Uhusiano na Mteja (User aliyetuma ombi).
     * Ombi moja linatoka kwa mteja mmoja.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Uhusiano na Fundi (Craftsman aliyetumiwa ombi).
     * Ombi moja linaenda kwa fundi mmoja.
     */
    public function craftsmen(): BelongsTo
    {
        return $this->belongsTo(Craftsmen::class, 'craftsman_id');
    }

    /**
     * Uhusiano na Malipo.
     * Kazi moja inakuwa na malipo makuu mmoja.
     */
    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class, 'job_request_id');
    }

    /**
     * Angalizo kuhusu function hii:
     * Kawaida function ya 'hasMany' ya JobRequests huwa inakaa kwenye Model ya 'Craftsmen'.
     * Kama umeamua kuiweka hapa kwa ajili ya kujihusisha yenyewe (Self-referencing), iko sawa.
     */
    public function jobRequests(): HasMany
    {
        return $this->hasMany(JobRequest::class, 'craftsman_id');
    }
}