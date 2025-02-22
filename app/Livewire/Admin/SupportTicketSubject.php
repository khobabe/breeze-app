<?php

namespace App\Livewire\Admin;

use App\Models\SupportTicketSubject as ModelsSupportTicketSubject;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SupportTicketSubject extends Component
{
    #[Validate('required|string|max:255')]
    public $ticket_subject = '';

    #[Validate('nullable|string')]
    public $description = '';

    public function saveSubject()
    {
        $this->validate();  // Uses the #[Validate] attributes

        ModelsSupportTicketSubject::create([
            'ticket_subject' => $this->ticket_subject,
            'description' => $this->description,
        ]);

        session()->flash('message', 'Support ticket subject added successfully!');

        // Reset form fields after submission
        $this->reset(['ticket_subject', 'description']);
    }

    public function render()
    {
        return view('livewire.admin.support-ticket-subject',[
            'subjects' => ModelsSupportTicketSubject::latest()->get(),
        ]);   
    }
}
