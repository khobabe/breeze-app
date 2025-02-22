<?php

namespace App\Livewire\User;

use App\Models\SupportTicket;
use App\Models\SupportTicketSubject;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads; 



#[Layout("layouts.users")]
class SupportTickets extends Component
{
    use WithFileUploads;
    public $subjects = []; // Define subjects

    public $ticket_subject_id;
    public $description;
    public $attachment;
    public $department;
    public $main_product;
    public $domain;

    public function mount()
    {
        // Load subjects when component is mounted
        $this->subjects = SupportTicketSubject::all();
    }

    public function createTicket()
    {
        $this->validate([
            'ticket_subject_id' => 'required|exists:support_ticket_subjects,id',
            'description' => 'required|string',
            'department' => 'required|string',
            'main_product' => 'required|string',
            'domain' => 'required|string',
        ]);

        SupportTicket::create([
            'ticket_number' => 'TICKET-' . strtoupper(uniqid()), 
            'user_id' => Auth::id(),
            'ticket_subject_id' => $this->ticket_subject_id,
            'description' => $this->description,
            'department' => $this->department,
            'main_product' => $this->main_product,
            'domain' => $this->domain,
            'status' => 'processing',
        ]);

        session()->flash('message', 'Support ticket created successfully!');

        // Reset form fields after submission
        $this->reset(['ticket_subject_id', 'description', 'department', 'main_product', 'domain']);
    }



    public function render()
    {
        $tickets = SupportTicket::where('user_id', Auth::id())->get();

        return view('livewire.user.support-tickets', compact('tickets'));
    }
}
