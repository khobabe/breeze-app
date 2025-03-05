<div>
    <div class="bg-sky-50 px-3 py-2">
        <h2 class="text-2xl font-semibold mb-4 text-sky-800">My Ticket Details</h2>

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
            </div>
            <div class="w-full md:w-1/2">
                @if ($ticket->attachment)
                    <p>
                        <img src="{{ Storage::url('attachments/' . $ticket->attachment) }}" alt="Attachment"
                            class="w-48 h-auto rounded-lg shadow-md">
                    </p>
                @endif
            </div>
        </div>
    </div>
    <!-- Chat Section -->
    <div class="">
        <div x-data x-ref="messages" x-init="$watch('$wire.messages', () => {
            $nextTick(() => {
                $refs.messages.scrollTop = $refs.messages.scrollHeight;
            });
        })" class="p-3 rounded h-[430px] overflow-y-auto">
            @foreach ($messages as $msg)
                @if ($msg->user_id != auth()->id())
                    <div class="clearfix w-4/4">
                        <div class="bg-gray-300 mx-4 my-2 p-2 rounded-lg inline-block">
                            <p><b>{{ $msg->user->name }} : </b>{{ $msg->content }}</p>
                            <p class="text-xs text-gray-500">{{ $msg->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @else
                    <div class="clearfix w-4/4 text-right">
                        <div class="bg-green-300 mx-4 my-2 p-2 rounded-lg inline-block">
                            <p>{{ $msg->content }} <b>: You</b></p>
                            <p class="text-xs text-gray-500">{{ $msg->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>


        <!-- Show input and send button only if the ticket is open -->
        @if ($ticket->status !== 'closed')
            <div class="w-full flex justify-between bg-green-100">
                <textarea class="flex-grow m-2 py-2 px-4 mr-1 rounded-full border border-gray-300 resize-none" rows="1"
                    wire:model="message" placeholder="Message..." style="outline: none;"></textarea>
                <button wire:click="sendMessage" class="m-2" style="outline: none;">
                    <svg class="svg-inline--fa text-green-400 fa-paper-plane fa-w-16 w-12 h-12 py-2 mr-2"
                        aria-hidden="true" focusable="false" data-prefix="fas" data-icon="paper-plane" role="img"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="M476 3.2L12.5 270.6c-18.1 10.4-15.8 35.6 2.2 43.2L121 358.4l287.3-253.2c5.5-4.9 13.3 2.6 8.6 8.3L176 407v80.5c0 23.6 28.5 32.9 42.5 15.8L282 426l124.6 52.2c14.2 6 30.4-2.9 33-18.2l72-432C515 7.8 493.3-6.8 476 3.2z" />
                    </svg>
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
