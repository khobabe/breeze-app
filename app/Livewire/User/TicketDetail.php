<?php

namespace App\Livewire\User;

use App\Models\ChatMessage;
use App\Models\SupportTicket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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
        $this->ticket = SupportTicket::with(['support_ticket_subject', 'user'])->find($ticketId);

        if (!$this->ticket) {
            abort(404, 'Ticket not found');
        }

        if (!Gate::allows('view-ticket', $this->ticket)) {
            abort(403, 'Unauthorized Access');
        }

        $this->loadMessages();
    }


    public function sendMessage()
    {
        // Check if the ticket is closed
        if ($this->ticket->status === 'closed') {
            session()->flash('error', 'Chat is disabled for this ticket.');
            return;
        }
        
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
