<?php

namespace App\Livewire\Admin;

use App\Models\SupportTicket;
use Livewire\Component;

class AdminManageTickets extends Component
{
    public $tickets;

    public function mount()
    {
        $this->tickets = SupportTicket::with('support_ticket_subject')->get();
    }

    public function render()
    {
        return view('livewire.admin.admin-manage-tickets');
    }
}
