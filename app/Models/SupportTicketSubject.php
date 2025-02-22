<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SupportTicketSubject extends Model
{
    protected $fillable = ['ticket_subject', 'description'];

    public function support_tickets(): HasMany
    {
        return $this->hasMany(SupportTicket::class, 'ticket_subject_id');
    }
}
