<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SupportTicket extends Model
{
    protected $guarded = [];

    public function support_ticket_subject():BelongsTo
    {
        return $this->belongsTo(SupportTicketSubject::class, 'ticket_subject_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
