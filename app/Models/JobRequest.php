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
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Uhusiano na Fundi (Craftsman aliyetumiwa ombi).
     */
    public function craftsmen(): BelongsTo
    {
        return $this->belongsTo(Craftsmen::class, 'craftsman_id');
    }

    /**
     * Uhusiano na Ujumbe/Messages.
     * Hakikisha column ya kwenye table ya 'messages' inalingana (mfano: job_request_id au job_id).
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'job_request_id')->orderBy('created_at', 'asc');
    }

    /**
     * FUNGUO MPYA: Kuhesabu idadi ya meseji mpya ambazo bado hazojasomwa.
     * Inaangalia meseji zisizo za aliyelogin (auth) na ambazo 'is_read' ni false/0.
     */
    public function unreadMessagesCount(): int
    {
        return $this->messages()
                    ->where('sender_id', '!=', auth()->id())
                    ->where('is_read', false)
                    ->count();
    }

    /**
     * Uhusiano na Malipo.
     */
    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class, 'job_request_id');
    }

    public function jobRequests(): HasMany
    {
        return $this->hasMany(JobRequest::class, 'craftsman_id');
    }
}