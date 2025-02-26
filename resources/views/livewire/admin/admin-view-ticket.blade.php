<div class="p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-semibold mb-4">Ticket Details</h2>

    <p><strong>Ticket Number:</strong> {{ $ticket->ticket_number }}</p>
    <p><strong>Subject:</strong> {{ $ticket->support_ticket_subject->ticket_subject }}</p>
    <p><strong>Description:</strong> {{ $ticket->description }}</p>
    <p><strong>Status:</strong> {{ ucfirst($ticket->status) }}</p>

    @if ($ticket->attachment)
        <p><a href="{{ asset('storage/' . $ticket->attachment) }}" class="text-blue-600 underline">View Attachment</a></p>
    @endif

    <!-- Chat Section -->
    <div class="mt-6">
        <h3 class="text-xl font-semibold mb-2">Chat</h3>

        <div class="border p-3 rounded h-[350px] overflow-y-auto">
            @foreach ($adminMessages as $msg)
                <div
                    class="mb-2 p-2 rounded 
                    {{ $msg->user_id == auth()->id() ? 'bg-blue-100 text-right' : 'bg-gray-100 text-left' }}">
                    <p class="font-bold">{{ $msg->user->name }}</p>
                    <p>{{ $msg->content }}</p>
                    <p class="text-xs text-gray-500">{{ $msg->created_at->diffForHumans() }}</p>
                </div>
            @endforeach
        </div>

        <div class="mt-3 flex">
            <input type="text" wire:model="message" class="border px-3 py-2 rounded w-full"
                placeholder="Type your message...">
            <button wire:click="sendMessageAdmin" class="ml-2 bg-blue-600 text-white px-4 py-2 rounded">Send</button>
        </div>
    </div>
</div>
