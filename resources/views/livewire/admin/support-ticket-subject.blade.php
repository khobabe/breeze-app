<div class="flex space-x-6">
    <!-- Form Section -->
    <div class="w-2/5 p-6 bg-white rounded shadow">
        <h2 class="text-2xl font-semibold mb-4">Add Support Ticket Subject</h2>

        <!-- Flash Message -->
        @if (session()->has('message'))
            <div class="mb-4 text-green-600">
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit.prevent="saveSubject">
            @csrf

            <!-- Ticket Subject Input -->
            <div>
                <x-input-label for="ticket_subject" :value="__('Ticket Subject')" />
                <x-text-input wire:model="ticket_subject" id="ticket_subject" class="block mt-1 w-full border px-3 py-2"
                    type="text" name="ticket_subject" required />
                <x-input-error :messages="$errors->get('ticket_subject')" class="mt-2" />
            </div>

            <!-- Description Input -->
            <div class="mt-4">
                <x-input-label for="description" :value="__('Description (Optional)')" />
                <textarea wire:model="description" id="description"
                    class="block mt-1 w-full border px-3 py-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <!-- Submit Button -->
            <div class="mt-4">
                <x-primary-button>
                    {{ __('Submit') }}
                </x-primary-button>
            </div>
        </form>
    </div>

    <!-- Display Ticket Subjects Section -->
    <div class="w-3/5 p-6 bg-white rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Existing Ticket Subjects</h2>

        @if ($subjects->isEmpty())
            <p class="text-gray-500">No subjects added yet.</p>
        @else
            <ul class="space-y-2">
                @foreach ($subjects as $subject)
                    <li class="p-3 border rounded shadow-sm">
                        <strong class="text-lg">{{ $subject->ticket_subject }}</strong>
                        <p class="text-gray-600 text-sm mt-1">{{ $subject->description }}</p>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
