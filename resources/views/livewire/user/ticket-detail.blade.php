<div class="p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-semibold mb-4">My Ticket Details</h2>

    <p><strong>Ticket Number:</strong> {{ $ticket->ticket_number }}</p>
    <p><strong>Status:</strong> {{ ucfirst($ticket->status) }}</p>
    <p><strong>Department:</strong> {{ ucfirst($ticket->department) }}</p>
    <p><strong>Main Product:</strong> {{ ucfirst($ticket->main_product) }}</p>
    <p><strong>Domain:</strong> {{ $ticket->domain }}</p>
    <p><strong>Created Date:</strong> {{ $ticket->created_at->format('l, F d, Y, h:i A') }}</p>
    <p><strong>Updated Date:</strong> {{ $ticket->updated_at->format('l, F d, Y, h:i A') }}</p>

    <!-- User Information -->
    <p><strong>Submitted By:</strong> {{ $ticket->user->name }}</p>
    <p><strong>Email:</strong> {{ $ticket->user->email }}</p>
    <p><strong>Phone:</strong> {{ $ticket->user->phone }}</p>

    <p><strong>Subject:</strong> {{ $ticket->support_ticket_subject->ticket_subject }}</p>
    <p><strong>Description:</strong> {{ $ticket->description }}</p>

    @if ($ticket->attachment)
        <p><a href="{{ asset('storage/' . $ticket->attachment) }}" class="text-blue-600 underline">View Attachment</a>
        </p>
    @endif



    <!-- Chat Section -->
    <div class="mt-6">
        <h3 class="text-xl font-semibold mb-2">Chat</h3>

        <div class="border p-3 rounded h-[450px] overflow-y-auto">
            @foreach ($messages as $msg)
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
            <button wire:click="sendMessage" class="ml-2 bg-blue-600 text-white px-4 py-2 rounded">Send</button>
        </div>
    </div>
</div>
