<?php

namespace App\Livewire\Admin;

use App\Models\ChatMessage;
use App\Models\SupportTicket;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminViewTicket extends Component
{
    public $ticket;
    public $message = "";
    public $adminMessages = [];

     // Listen for the event
     protected $listeners = ['refreshMessages' => 'loadMessages'];

    public function mount($ticketId)
    {
        $this->ticket = SupportTicket::with('support_ticket_subject')->findOrFail($ticketId);

        $this->loadMessages();
    }

    public function sendMessageAdmin()
    {
        $data = [
            'ticket_id' => $this->ticket->id,
            'user_id' => Auth::id(),
            'content' => $this->message,
        ];

        ChatMessage::create($data);

        $this->dispatch('refreshMessages');
        $this->message = "";
    }

    public function loadMessages()
    {
        $this->adminMessages = ChatMessage::where('ticket_id', $this->ticket->id)
            ->with('user')
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.admin-view-ticket');
    }
}
