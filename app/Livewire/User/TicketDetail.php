<?php

namespace App\Livewire\User;

use App\Models\ChatMessage;
use App\Models\SupportTicket;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.users')]
class TicketDetail extends Component
{

    public $ticket;
    public $message = "";
    public $messages = [];

    protected $listeners = ['refreshMessages' => 'loadMessages'];

    public function mount($ticketId)
    {
        $this->ticket = SupportTicket::with('support_ticket_subject')->findOrFail($ticketId);

        $this->loadMessages();
    }

    public function sendMessage()
    {
        $data = [
            'ticket_id' => $this->ticket->id,
            'user_id' => Auth::id(),
            'content' => $this->message,
        ];

        ChatMessage::create($data);

        $this->dispatch('refreshMessages');
        $this->message = '';
    }

    public function loadMessages()
    {
        $this->messages = ChatMessage::where('ticket_id', $this->ticket->id)
            ->with('user')
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function render()
    {
        return view('livewire.user.ticket-detail');
    }
}
