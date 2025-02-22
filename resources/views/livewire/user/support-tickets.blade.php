<div class="flex space-x-6">
    <!-- Form Section -->
    <div class="w-2/5 p-6 bg-white rounded shadow">
        <h2 class="text-2xl font-semibold mb-4">Create Support Ticket</h2>

        <!-- Flash Message -->
        @if (session()->has('message'))
            <div class="mb-4 text-green-600">
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit.prevent="createTicket">
            @csrf

            <!-- Ticket Subject -->
            <div>
                <x-input-label for="ticket_subject_id" :value="__('Ticket Subject')" />
                <select wire:model="ticket_subject_id" id="ticket_subject_id"
                    class="block mt-1 w-full border px-3 py-2 rounded">
                    <option value="" disabled>Select a subject</option>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->ticket_subject }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('ticket_subject_id')" class="mt-2" />
            </div>

            <!-- Description -->
            <div class="mt-4">
                <x-input-label for="description" :value="__('Description')" />
                <textarea wire:model="description" id="description" class="block mt-1 w-full border px-3 py-2 rounded"></textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <!-- Attachment -->
            <div class="mt-4">
                <x-input-label for="attachment" :value="__('Attachment (Optional)')" />
                <input type="file" wire:model="attachment" id="attachment"
                    class="block mt-1 w-full border px-3 py-2 rounded" />
                <x-input-error :messages="$errors->get('attachment')" class="mt-2" />
            </div>

            <!-- Department -->
            <div class="mt-4">
                <x-input-label for="department" :value="__('Department')" />
                <x-text-input wire:model="department" id="department" class="block mt-1 w-full border px-3 py-2"
                    type="text" />
                <x-input-error :messages="$errors->get('department')" class="mt-2" />
            </div>

            <!-- Main Product -->
            <div class="mt-4">
                <x-input-label for="main_product" :value="__('Main Product')" />
                <x-text-input wire:model="main_product" id="main_product" class="block mt-1 w-full border px-3 py-2"
                    type="text" />
                <x-input-error :messages="$errors->get('main_product')" class="mt-2" />
            </div>

            <!-- Domain -->
            <div class="mt-4">
                <x-input-label for="domain" :value="__('Domain')" />
                <x-text-input wire:model="domain" id="domain" class="block mt-1 w-full border px-3 py-2"
                    type="text" />
                <x-input-error :messages="$errors->get('domain')" class="mt-2" />
            </div>

            <!-- Submit Button -->
            <div class="mt-4">
                <x-primary-button>
                    {{ __('Submit Ticket') }}
                </x-primary-button>
            </div>
        </form>
    </div>

    <!-- Display Tickets Section -->
    <div class="w-3/5 p-6 bg-white rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Your Support Tickets</h2>

        @if ($tickets->isEmpty())
            <p class="text-gray-500">No tickets found.</p>
        @else
            <ul class="space-y-2">
                @foreach ($tickets as $ticket)
                    <li class="p-3 border rounded shadow-sm">
                        <strong class="text-lg">{{ $ticket->ticket_number }}
                            {{-- {{ $ticket->ticket_subject->ticket_subject }} --}}
                        </strong>
                        <p class="text-sm mt-1"><strong>Subject:</strong>{{ $ticket->ticket_subject_id }}</p>
                        <p class="text-sm mt-1"><strong>Description:</strong>{{ $ticket->description }}</p>
                        <p class="text-sm"><strong>Status:</strong> {{ ucfirst($ticket->status) }}</p>
                        <p class="text-sm"><strong>Department:</strong> {{ $ticket->department }}</p>
                        <p class="text-sm"><strong>Main Product:</strong> {{ $ticket->main_product }}</p>
                        <p class="text-sm"><strong>Domain:</strong> {{ $ticket->domain }}</p>
                        @if ($ticket->attachment)
                            <p class="text-sm"><a href="{{ asset('storage/' . $ticket->attachment) }}"
                                    class="text-blue-600 underline">View Attachment</a></p>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
