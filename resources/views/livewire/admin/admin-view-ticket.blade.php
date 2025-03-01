<div class="p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-semibold mb-4">Ticket Details</h2>

    <div class="flex justify-between gap-4">
        <div class="w-full md:w-1/2">
            <p><strong>Ticket Number:</strong> {{ $ticket->ticket_number }}</p>
            <p><strong>Ticket Status:</strong> {{ ucfirst($ticket->status) }}</p>
            <p><strong>Department:</strong> {{ ucfirst($ticket->department) }}</p>
            <p><strong>Created Date:</strong> {{ $ticket->created_at->format('l, F d, Y, h:i A') }}</p>
            <p><strong>Subject:</strong> {{ $ticket->support_ticket_subject->ticket_subject }}</p>
            <p><strong>Description:</strong> {{ $ticket->description }}</p>

        </div>

        <div class="w-full md:w-1/2">
            <p><strong>Name:</strong> {{ ucfirst($ticket->user->name) }}</p>
            <p><strong>Email:</strong> {{ $ticket->user->email }}</p>
            <p><strong>Domain:</strong> {{ $ticket->domain }}</p>
            <p><strong>Main Product:</strong> {{ ucfirst($ticket->main_product) }}</p>
            <p><strong>Phone:</strong> {{ $ticket->user->phone }}</p>

            @if ($ticket->attachment)
                <p>
                    <img src="{{ Storage::url('attachments/' . $ticket->attachment) }}" alt="Attachment"
                        class="w-48 h-auto rounded-lg shadow-md">
                </p>
            @endif
        </div>
    </div>

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

        <!-- Show input and send button only if the ticket is open -->
        @if ($ticket->status !== 'closed')
            <div class="mt-3 flex">
                <input type="text" wire:model="message" class="border px-3 py-2 rounded w-full"
                    placeholder="Type your message...">
                <button wire:click="sendMessageAdmin" class="ml-2 bg-blue-600 text-white px-4 py-2 rounded">
                    Send
                </button>
            </div>
        @else
            <!-- Show a message instead of input field when the ticket is closed -->
            <div class="mt-3 p-3 bg-gray-100 rounded text-center text-gray-600">
                <p>🔒 Chat is closed as this ticket has been resolved.</p>
            </div>
        @endif
    </div>

</div>
